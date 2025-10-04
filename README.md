# WTF Alpha - WordPress Theme Starter

A minimal WordPress classic theme starter with Tailwind CSS v4, Alpine.js, and esbuild.

## Features

- ⚡ **esbuild** for blazing-fast JavaScript bundling
- 🎨 **Tailwind CSS v4** for utility-first styling
- 🏔️ **Alpine.js** for reactive components
- 📱 **Responsive** and mobile-first design
- ♿ **Accessible** markup and navigation
- 🔧 **Simple build system** with npm scripts
- 📦 **Production build** system with zip export
- 🎯 **No complex tooling** - just build and go!

## Requirements

- Node.js 18+ and npm
- WordPress 6.0+
- PHP 7.4+

## Installation

1. Clone or download this theme to your WordPress themes directory
2. Navigate to the theme directory:
   ```bash
   cd wp-content/themes/wtf-alpha
   ```
3. Install dependencies:
   ```bash
   npm install
   ```

## Development

### Build Assets

Compile CSS and JavaScript:

```bash
npm run build
```

This will:
- Compile Tailwind CSS from `src/css/main.css` to `assets/css/style.css`
- Bundle Alpine.js and custom JS from `src/js/main.js` to `assets/js/main.js`

### Watch for Changes

Automatically rebuild assets when source files change:

```bash
npm run watch
```

This runs both CSS and JS watch tasks in parallel. Press Ctrl+C to stop.

You can also run them individually:
```bash
npm run watch:css    # Watch CSS only
npm run watch:js     # Watch JS only
```

## Production Build

### Build Minified Assets

Create optimized, minified assets for production:

```bash
npm run build
```

### Export Theme

Create a production-ready zip file:

```bash
npm run export
```

This will:
1. Build minified production assets
2. Create a zip file in the `dist/` directory
3. Exclude development files (node_modules, src, config files, etc.)

The zip file is ready to be uploaded to any WordPress site or theme directory.

## Project Structure

```
wtf-alpha/
├── src/                    # Source files
│   ├── css/
│   │   └── main.css       # Tailwind CSS
│   └── js/
│       └── main.js        # Alpine.js and custom JS
├── assets/                 # Compiled assets (generated)
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── main.js
├── inc/                    # PHP includes
│   ├── class-tailwind-nav-walker.php
│   ├── template-tags.php
│   └── customizer.php
├── template-parts/         # Reusable template parts
│   ├── content.php
│   ├── content-single.php
│   ├── content-none.php
│   └── content-search.php
├── functions.php           # Theme functions
├── style.css              # Theme header (required)
├── index.php              # Main template
├── header.php             # Header template
├── footer.php             # Footer template
├── single.php             # Single post template
├── page.php               # Page template
├── archive.php            # Archive template
├── search.php             # Search results template
├── 404.php                # 404 error template
├── sidebar.php            # Sidebar template
├── comments.php           # Comments template
├── searchform.php         # Search form template
└── package.json           # Dependencies and scripts
```

## Customization

### Tailwind CSS

Modify `src/css/main.css` to add custom styles. Tailwind utility classes are available throughout your templates.

### Alpine.js Components

Add your Alpine components in `src/js/main.js` or create separate component files and import them:

```javascript
import Alpine from 'alpinejs';
import myComponent from './components/myComponent';

Alpine.data('myComponent', myComponent);

window.Alpine = Alpine;
Alpine.start();
```

### PHP Templates

- Modify existing templates in the root directory
- Add custom template parts in `template-parts/`
- Extend functionality in `inc/` files

## WordPress Features

The theme includes support for:

- Custom logo
- Custom background
- Navigation menus (primary and footer)
- Widget areas (sidebar and footer)
- Post thumbnails
- HTML5 markup
- Responsive embeds
- Editor styles
- Translation ready

## Build Scripts

- `npm run build` - Build both CSS and JS for production (minified)
- `npm run build:css` - Build CSS only
- `npm run build:js` - Build JS only
- `npm run watch` - Watch and rebuild on file changes
- `npm run watch:css` - Watch CSS files only
- `npm run watch:js` - Watch JS files only
- `npm run version <version>` - Update theme version (e.g., `npm run version 1.1.0`)
- `npm run export` - Build and create distribution zip file

## Browser Support

Modern browsers with ES6+ support. Alpine.js and Tailwind CSS both support all modern browsers.

## License

GPL v2 or later

## Author

Jinson - [web2feel.com](https://web2feel.com)

## Credits

- [WordPress](https://wordpress.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Alpine.js](https://alpinejs.dev/)
- [esbuild](https://esbuild.github.io/)
