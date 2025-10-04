# Version Management Guide

## How Version Numbers Work

The theme version is stored in **two files** that must stay in sync:

1. **`package.json`** - Line 3: `"version": "1.0.0"`
2. **`style.css`** - Line 7: `Version: 1.0.0`

- WordPress reads the version from `style.css` to display in the admin
- The export script reads from `package.json` to name the zip file

## Method 1: Using the Version Update Script (Recommended)

I've created a helper script that updates both files automatically.

### Usage:

```bash
npm run version 1.1.0
```

Or directly:

```bash
node update-version.js 1.1.0
```

### Example:

```bash
# Update to version 1.1.0
npm run version 1.1.0

# Output:
# ✅ Updated package.json: 1.0.0 → 1.1.0
# ✅ Updated style.css: 1.0.0 → 1.1.0
# 🎉 Version updated successfully to 1.1.0!
```

The script will:
- ✅ Update `package.json`
- ✅ Update `style.css`
- ✅ Validate version format (must be X.Y.Z format)
- ✅ Show you next steps

## Method 2: Manual Update

If you prefer to update manually:

### 1. Update package.json

```json
{
  "name": "wtf-alpha",
  "version": "1.1.0",  ← Change this
  ...
}
```

### 2. Update style.css

```css
/*
Theme Name: WTF Alpha
...
Version: 1.1.0  ← Change this
...
*/
```

## Version Numbering Guide

Use **Semantic Versioning** (MAJOR.MINOR.PATCH):

- **MAJOR** (1.0.0 → 2.0.0) - Breaking changes, major redesign
- **MINOR** (1.0.0 → 1.1.0) - New features, backwards compatible
- **PATCH** (1.0.0 → 1.0.1) - Bug fixes, small tweaks

### Examples:

```bash
# Bug fix release
npm run version 1.0.1

# New feature release
npm run version 1.1.0

# Major update
npm run version 2.0.0
```

## Complete Release Workflow

When you're ready to release a new version:

### 1. Update the version
```bash
npm run version 1.1.0
```

### 2. Update CHANGELOG.md
Add your changes:
```markdown
## Version 1.1.0 - 2024-01-15
- Added new feature X
- Fixed bug in Y
- Improved Z
```

### 3. Build the theme
```bash
npm run build
```

### 4. Create distribution zip
```bash
npm run export
```

This creates: `dist/wtf-alpha-v1.1.0.zip` (version from package.json)

### 5. Commit your changes (if using Git)
```bash
git add .
git commit -m "Release version 1.1.0"
git tag v1.1.0
git push origin main --tags
```

## Where Version Appears

After updating the version, it will show up in:

1. **WordPress Admin** - Appearance → Themes (reads from style.css)
2. **Export filename** - `dist/wtf-alpha-v1.1.0.zip` (reads from package.json)
3. **Theme details** - When you view theme info in WordPress

## Troubleshooting

### "Version mismatch" error

If package.json and style.css have different versions:
1. Use `npm run version X.Y.Z` to sync them
2. Or manually update both files to match

### "Invalid version format" error

Version must be in X.Y.Z format (semantic versioning):
- ✅ Valid: `1.0.0`, `1.2.3`, `2.0.0`
- ❌ Invalid: `1.0`, `v1.0.0`, `1.0.0-beta`

For pre-release versions, manually edit the files if needed.

## Quick Reference

| Command | Description |
|---------|-------------|
| `npm run version 1.1.0` | Update version to 1.1.0 |
| `npm run build` | Build assets |
| `npm run export` | Create zip file with version number |

---

**Pro Tip:** Always update the version before running `npm run export` so your zip file has the correct version number in its filename!
