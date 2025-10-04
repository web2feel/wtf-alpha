# WTF Alpha Theme - Setup Complete! 🎉

## What Was Built

A minimal WordPress classic theme starter with:
- ✅ Tailwind CSS v4 for styling
- ✅ Alpine.js for interactivity  
- ✅ esbuild for JavaScript bundling
- ✅ Simple npm-based build system
- ✅ Production export capability

## Quick Start

### 1. Install Dependencies
```bash
npm install
```

### 2. Build Assets
```bash
npm run build
```

### 3. Watch for Changes (Development)
```bash
npm run watch
```

### 4. Export Production Theme
```bash
npm run export
```
Creates a clean zip file in `dist/` ready for production use.

## File Structure

### Theme Templates
- `index.php` - Main loop template
- `single.php` - Single post template
- `page.php` - Page template
- `archive.php` - Archive template
- `search.php` - Search results
- `404.php` - 404 error page
- `header.php` - Site header with Alpine.js mobile menu
- `footer.php` - Site footer
- `sidebar.php` - Sidebar widget area
- `comments.php` - Comments section
- `searchform.php` - Search form

### Template Parts (`template-parts/`)
- `content.php` - Default post content
- `content-single.php` - Single post content
- `content-search.php` - Search result item
- `content-none.php` - No results message

### PHP Includes (`inc/`)
- `class-tailwind-nav-walker.php` - Custom nav walker for Tailwind menus
- `template-tags.php` - Custom template functions
- `customizer.php` - Theme customizer settings

### Source Files (`src/`)
- `src/css/main.css` - Tailwind CSS source
- `src/js/main.js` - Alpine.js and custom JavaScript

### Build Output (`assets/`)
- `assets/css/style.css` - Compiled CSS (auto-generated)
- `assets/js/main.js` - Bundled JavaScript (auto-generated)

## Available Commands

| Command | Description |
|---------|-------------|
| `npm install` | Install dependencies |
| `npm run build` | Build CSS and JS for production (minified) |
| `npm run build:css` | Build CSS only |
| `npm run build:js` | Build JS only |
| `npm run watch` | Watch and rebuild on changes |
| `npm run watch:css` | Watch CSS only |
| `npm run watch:js` | Watch JS only |
| `npm run export` | Build and create distribution zip |

## Theme Features

### WordPress Support
- Custom logo
- Custom background
- Two navigation menu locations (primary, footer)
- Two widget areas (sidebar, footer)
- Post thumbnails
- HTML5 markup
- Responsive embeds
- Translation ready

### Tailwind CSS
- Version 4 (latest)
- Utility-first CSS
- Responsive design utilities
- Custom styles in `src/css/main.css`

### Alpine.js
- Lightweight reactive framework
- Mobile menu toggle (in header)
- Ready for custom components
- Import in `src/js/main.js`

## Customization

### Adding Custom Styles
Edit `src/css/main.css` and use Tailwind utilities or add custom CSS.

### Adding Custom JavaScript
Edit `src/js/main.js` to add Alpine.js components or vanilla JavaScript.

### Creating Custom Templates
1. Create new PHP file in theme root
2. Add template header comment
3. Use existing templates as reference

### Modifying Navigation
The theme uses a custom Tailwind nav walker in `inc/class-tailwind-nav-walker.php`.
Navigation HTML is in `header.php`.

## Production Deployment

1. Run `npm run export`
2. Upload `dist/wtf-alpha-v1.0.0.zip` to WordPress
3. Activate theme in WordPress admin

The exported zip excludes:
- node_modules
- src files  
- Development config files
- Git files
- Build scripts

Only production-ready files are included with compiled assets.

## Development Workflow

1. Make changes to PHP templates or `src/` files
2. If watching: Changes auto-rebuild
3. If not watching: Run `npm run build`
4. Refresh WordPress site to see changes
5. When ready: Run `npm run export` for production

## Browser Support

Modern browsers with ES6+ support:
- Chrome/Edge (latest)
- Firefox (latest)
- Safari (latest)
- Mobile browsers

## Next Steps

- Add custom post types in `functions.php`
- Create additional templates as needed
- Customize Tailwind styles in `src/css/main.css`
- Add Alpine.js components in `src/js/main.js`
- Configure widget areas
- Set up menus in WordPress admin

## Support

- WordPress Codex: https://codex.wordpress.org/
- Tailwind CSS Docs: https://tailwindcss.com/docs
- Alpine.js Docs: https://alpinejs.dev/

---

Built by Jinson | web2feel.com
