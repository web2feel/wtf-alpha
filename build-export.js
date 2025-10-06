const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

// Read package.json for version
const packageJson = JSON.parse(fs.readFileSync('./package.json', 'utf8'));
const themeName = packageJson.name;
const version = packageJson.version;

const outputDir = path.join(__dirname, 'dist');
const zipFileName = `${themeName}-v${version}.zip`;
const zipFilePath = path.join(outputDir, zipFileName);

console.log('📦 Starting theme export...');

// Create dist directory if it doesn't exist
if (!fs.existsSync(outputDir)) {
  fs.mkdirSync(outputDir, { recursive: true });
}

// Files and directories to exclude from the zip
const excludeItems = [
  'node_modules/*',
  'src/*',
  'dist/*',
  '.git/*',
  '.gitignore',
  '.env*',
  'package.json',
  'package-lock.json',
  'build-export.js',
  'update-version.js',
  '.DS_Store',
  'Thumbs.db',
  '*.log',
  '.vscode/*',
  '.idea/*',
  // Uncomment below to exclude developer documentation from production
   'SETUP.md',
   'VERSIONING.md',
   'ALPINE-CDN-SETUP.md',
  // 'README.md',
];

try {
  // Remove existing zip if it exists
  if (fs.existsSync(zipFilePath)) {
    fs.unlinkSync(zipFilePath);
  }

  console.log('🗜️  Creating zip archive...');
  
  // Build the exclude arguments
  const excludeArgs = excludeItems.map(item => `-x "${item}"`).join(' ');
  
  // Create zip file of current directory
  const zipCommand = `zip -r "${zipFilePath}" . ${excludeArgs}`;
  
  execSync(zipCommand, { stdio: 'inherit' });
  
  console.log(`✅ Theme exported successfully!`);
  console.log(`📁 Location: dist/${zipFileName}`);
  console.log(`📊 Version: ${version}`);
  
  // Get file size
  const stats = fs.statSync(zipFilePath);
  const fileSizeInMB = (stats.size / (1024 * 1024)).toFixed(2);
  console.log(`📦 Size: ${fileSizeInMB} MB`);
  
} catch (error) {
  console.error('❌ Export failed:', error.message);
  process.exit(1);
}
