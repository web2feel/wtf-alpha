#!/usr/bin/env node

/**
 * Update theme version in both package.json and style.css
 * Usage: node update-version.js <new-version>
 * Example: node update-version.js 1.1.0
 */

const fs = require('fs');
const path = require('path');

// Get the new version from command line arguments
const newVersion = process.argv[2];

if (!newVersion) {
  console.error('❌ Error: Please provide a version number');
  console.log('Usage: node update-version.js <version>');
  console.log('Example: node update-version.js 1.1.0');
  process.exit(1);
}

// Validate version format (basic semver)
const versionRegex = /^\d+\.\d+\.\d+$/;
if (!versionRegex.test(newVersion)) {
  console.error('❌ Error: Invalid version format. Use semantic versioning (e.g., 1.0.0)');
  process.exit(1);
}

try {
  // Update package.json
  const packagePath = path.join(__dirname, 'package.json');
  const packageJson = JSON.parse(fs.readFileSync(packagePath, 'utf8'));
  const oldVersion = packageJson.version;
  packageJson.version = newVersion;
  fs.writeFileSync(packagePath, JSON.stringify(packageJson, null, 2) + '\n');
  console.log(`✅ Updated package.json: ${oldVersion} → ${newVersion}`);

  // Update style.css
  const stylePath = path.join(__dirname, 'style.css');
  let styleContent = fs.readFileSync(stylePath, 'utf8');
  const versionLineRegex = /^Version:\s*.+$/m;
  
  if (!versionLineRegex.test(styleContent)) {
    console.error('❌ Error: Could not find Version line in style.css');
    process.exit(1);
  }
  
  styleContent = styleContent.replace(versionLineRegex, `Version: ${newVersion}`);
  fs.writeFileSync(stylePath, styleContent);
  console.log(`✅ Updated style.css: ${oldVersion} → ${newVersion}`);

  console.log(`\n🎉 Version updated successfully to ${newVersion}!`);
  console.log('\nNext steps:');
  console.log('1. Update CHANGELOG.md with your changes');
  console.log('2. Run: npm run build');
  console.log('3. Run: npm run export');
  console.log(`4. Commit your changes: git commit -am "Bump version to ${newVersion}"`);

} catch (error) {
  console.error('❌ Error updating version:', error.message);
  process.exit(1);
}
