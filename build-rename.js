#!/usr/bin/env node

const fs = require("fs");
const path = require("path");
const { execSync } = require("child_process");
const readline = require("readline");

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout,
});

// Helper function to ask questions
function question(query) {
  return new Promise((resolve) => rl.question(query, resolve));
}

// Helper function to convert string to different cases
function toCases(str) {
  // Convert to slug (kebab-case)
  const slug = str
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "");

  // Convert to function name (snake_case)
  const snakeCase = slug.replace(/-/g, "_");

  // Convert to constant/namespace (Snake_Case with caps)
  const namespaceCase = snakeCase
    .split("_")
    .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
    .join("_");

  // Convert to title case for theme name
  const titleCase = slug
    .split("-")
    .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
    .join(" ");

  return { slug, snakeCase, namespaceCase, titleCase };
}

// File and directory patterns to exclude from processing
const excludeFromProcessing = [
  "node_modules",
  ".git",
  "dist",
  ".DS_Store",
  "Thumbs.db",
  "build-export.js",
  "build-rename.js",
  "update-version.js",
];

// Files that should be processed for text replacement
const processableExtensions = [".php", ".css", ".json", ".md", ".txt"];

// Function to check if file should be processed
function shouldProcessFile(filePath) {
  const ext = path.extname(filePath);
  const basename = path.basename(filePath);

  // Skip if in exclude list
  if (excludeFromProcessing.includes(basename)) {
    return false;
  }

  // Skip if in excluded directory
  const parts = filePath.split(path.sep);
  for (const part of parts) {
    if (excludeFromProcessing.includes(part)) {
      return false;
    }
  }

  // Only process files with specific extensions
  return processableExtensions.includes(ext);
}

// Function to replace text in file
function replaceInFile(filePath, replacements) {
  if (!shouldProcessFile(filePath)) {
    return false;
  }

  try {
    let content = fs.readFileSync(filePath, "utf8");
    let modified = false;

    for (const [search, replace] of replacements) {
      if (content.includes(search)) {
        content = content.split(search).join(replace);
        modified = true;
      }
    }

    if (modified) {
      fs.writeFileSync(filePath, content, "utf8");
      return true;
    }
  } catch (error) {
    console.error(`Error processing ${filePath}:`, error.message);
  }

  return false;
}

// Function to recursively process directory
function processDirectory(dir, replacements, stats = { files: 0, modified: 0 }) {
  const items = fs.readdirSync(dir);

  for (const item of items) {
    const fullPath = path.join(dir, item);
    const stat = fs.statSync(fullPath);

    if (stat.isDirectory()) {
      // Skip excluded directories
      if (!excludeFromProcessing.includes(item)) {
        processDirectory(fullPath, replacements, stats);
      }
    } else if (stat.isFile()) {
      stats.files++;
      if (replaceInFile(fullPath, replacements)) {
        stats.modified++;
      }
    }
  }

  return stats;
}

async function main() {
  console.log("🎨 WordPress Theme Renaming Tool\n");
  console.log("This tool will create a renamed production build of your theme.\n");

  // Get current theme info
  const packageJson = JSON.parse(fs.readFileSync("./package.json", "utf8"));
  const currentName = packageJson.name;
  const currentVersion = packageJson.version;

  console.log(`Current theme: ${currentName} (v${currentVersion})\n`);

  // Ask for new theme name
  const newThemeInput = await question("Enter new theme name (e.g., 'My Awesome Theme'): ");

  if (!newThemeInput || newThemeInput.trim() === "") {
    console.log("❌ Theme name cannot be empty");
    rl.close();
    process.exit(1);
  }

  const newTheme = toCases(newThemeInput.trim());
  const oldTheme = {
    slug: currentName,
    snakeCase: currentName.replace(/-/g, "_"),
    namespaceCase: "WTF_Alpha",
    titleCase: "WTF Alpha",
  };

  console.log("\n📋 Conversion preview:");
  console.log(`  Text Domain:      ${oldTheme.slug} → ${newTheme.slug}`);
  console.log(`  Functions:        ${oldTheme.snakeCase} → ${newTheme.snakeCase}`);
  console.log(`  Namespace:        ${oldTheme.namespaceCase} → ${newTheme.namespaceCase}`);
  console.log(`  Theme Name:       ${oldTheme.titleCase} → ${newTheme.titleCase}\n`);

  const confirm = await question("Continue with these changes? (yes/no): ");

  if (confirm.toLowerCase() !== "yes" && confirm.toLowerCase() !== "y") {
    console.log("❌ Cancelled");
    rl.close();
    process.exit(0);
  }

  rl.close();

  console.log("\n🚀 Starting build process...\n");

  // Step 1: Build assets
  console.log("📦 Building assets...");
  try {
    execSync("npm run build", { stdio: "inherit" });
  } catch (error) {
    console.error("❌ Build failed:", error.message);
    process.exit(1);
  }

  // Step 2: Create temp directory
  const tempDir = path.join(__dirname, "temp-build");
  const outputDir = path.join(__dirname, "dist");

  console.log("\n📁 Creating temporary build directory...");

  // Remove temp directory if it exists
  if (fs.existsSync(tempDir)) {
    fs.rmSync(tempDir, { recursive: true, force: true });
  }
  fs.mkdirSync(tempDir, { recursive: true });

  // Create output directory if it doesn't exist
  if (!fs.existsSync(outputDir)) {
    fs.mkdirSync(outputDir, { recursive: true });
  }

  // Step 3: Copy files to temp directory
  console.log("📋 Copying theme files...");

  const excludePatterns = [
    "node_modules",
    "src",
    "dist",
    ".git",
    ".gitignore",
    ".env",
    "package.json",
    "package-lock.json",
    "build-export.js",
    "build-rename.js",
    "update-version.js",
    ".DS_Store",
    "Thumbs.db",
    ".vscode",
    ".idea",
    "temp-build",
    "SETUP.md",
    "VERSIONING.md",
    "ALPINE-CDN-SETUP.md",
  ];

  function copyRecursive(src, dest) {
    const stat = fs.statSync(src);

    if (stat.isDirectory()) {
      const basename = path.basename(src);
      if (excludePatterns.includes(basename)) {
        return;
      }

      if (!fs.existsSync(dest)) {
        fs.mkdirSync(dest, { recursive: true });
      }

      const items = fs.readdirSync(src);
      for (const item of items) {
        if (!excludePatterns.includes(item)) {
          copyRecursive(path.join(src, item), path.join(dest, item));
        }
      }
    } else {
      const basename = path.basename(src);
      if (!excludePatterns.includes(basename)) {
        fs.copyFileSync(src, dest);
      }
    }
  }

  copyRecursive(__dirname, tempDir);

  // Step 4: Process files in temp directory
  console.log("\n🔄 Renaming theme references...");

  const replacements = [
    // Order matters - more specific first
    [oldTheme.titleCase, newTheme.titleCase],
    [oldTheme.namespaceCase, newTheme.namespaceCase],
    [oldTheme.snakeCase, newTheme.snakeCase],
    [oldTheme.slug, newTheme.slug],
  ];

  const stats = processDirectory(tempDir, replacements);

  console.log(`✅ Processed ${stats.files} files, modified ${stats.modified} files\n`);

  // Step 5: Create zip file
  const zipFileName = `${newTheme.slug}-v${currentVersion}.zip`;
  const zipFilePath = path.join(outputDir, zipFileName);

  console.log("🗜️  Creating zip archive...");

  // Remove existing zip if it exists
  if (fs.existsSync(zipFilePath)) {
    fs.unlinkSync(zipFilePath);
  }

  try {
    // Create zip from temp directory
    const zipCommand = `cd "${tempDir}" && zip -r "${zipFilePath}" . -x "*.DS_Store" "Thumbs.db"`;
    execSync(zipCommand, { stdio: "inherit" });

    // Clean up temp directory
    console.log("\n🧹 Cleaning up...");
    fs.rmSync(tempDir, { recursive: true, force: true });

    console.log("\n✨ Theme renamed and exported successfully!\n");
    console.log(`📁 Location: dist/${zipFileName}`);
    console.log(`📊 Version: ${currentVersion}`);
    console.log(`🎨 New theme name: ${newTheme.titleCase}`);
    console.log(`📝 Text domain: ${newTheme.slug}\n`);

    // Get file size
    const zipStats = fs.statSync(zipFilePath);
    const fileSizeInMB = (zipStats.size / (1024 * 1024)).toFixed(2);
    console.log(`📦 Size: ${fileSizeInMB} MB\n`);
  } catch (error) {
    console.error("❌ Export failed:", error.message);
    // Clean up temp directory on error
    if (fs.existsSync(tempDir)) {
      fs.rmSync(tempDir, { recursive: true, force: true });
    }
    process.exit(1);
  }
}

main().catch((error) => {
  console.error("❌ Error:", error.message);
  rl.close();
  process.exit(1);
});
