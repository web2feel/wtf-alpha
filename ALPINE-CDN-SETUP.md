# Alpine.js CDN Setup

## Overview
This theme now uses Alpine.js from CDN instead of bundling it, resulting in significant performance improvements.

## Implementation Details

### CDN Source
- **URL**: https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js
- **Version**: 3.14.0
- **Size**: ~47KB (~15KB gzipped)
- **Loading**: Deferred for optimal performance

### Files Modified

#### 1. functions.php
Added Alpine.js CDN script enqueue:
```php
wp_enqueue_script(
    'alpinejs',
    'https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js',
    array(),
    '3.14.0',
    true
);
```

Added defer attribute filter:
```php
function wtf_alpha_defer_alpinejs($tag, $handle) {
    if ('alpinejs' === $handle) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
```

#### 2. src/js/main.js
Removed Alpine.js import and initialization. Now contains only custom theme JavaScript.

#### 3. assets/js/main.js
Rebuilt without Alpine.js bundle:
- Old size: 108KB
- New size: 104B
- Reduction: 99.9%

## Performance Benefits

1. **Smaller Bundle**: Custom JS reduced from 108KB to 104B
2. **Better Caching**: Alpine.js CDN cached across multiple sites
3. **Faster Delivery**: Served from CDN edge servers worldwide
4. **Reduced Server Load**: Less bandwidth usage from your server
5. **Simpler Builds**: No Alpine.js compilation needed

## Usage in Theme

Alpine.js directives work exactly as before:
- `x-data` - Define component data
- `x-show` - Toggle visibility
- `x-if` - Conditional rendering
- `@click` - Event listeners
- And all other Alpine.js features

Example from header.php:
```html
<nav x-data="{ open: false }">
    <button @click="open = !open">
        Menu
    </button>
    <div x-show="open">
        <!-- Mobile menu -->
    </div>
</nav>
```

## Updating Alpine.js Version

To update Alpine.js to a newer version:
1. Edit `functions.php`
2. Update the CDN URL version number
3. Update the version parameter in `wp_enqueue_script()`

Example:
```php
wp_enqueue_script(
    'alpinejs',
    'https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js',
    array(),
    '3.15.0',
    true
);
```

## Optional: Remove Alpine.js from package.json

Since Alpine.js is now loaded from CDN, you can optionally remove it from package.json dependencies:

```bash
npm uninstall alpinejs
```

This will reduce node_modules size and installation time.

## Fallback Considerations

For production sites, consider:
1. Using SRI (Subresource Integrity) for security
2. Adding a local fallback if CDN is unavailable
3. Monitoring CDN uptime

Example with SRI:
```php
wp_enqueue_script(
    'alpinejs',
    'https://cdn.jsdelivr.net/npm/alpinejs@3.14.0/dist/cdn.min.js',
    array(),
    '3.14.0',
    true
);

add_filter('script_loader_tag', function($tag, $handle) {
    if ('alpinejs' === $handle) {
        $tag = str_replace(' src', ' defer integrity="sha384-..." crossorigin="anonymous" src', $tag);
    }
    return $tag;
}, 10, 2);
```

## Testing

To verify Alpine.js is working:
1. Load your site in a browser
2. Open browser console
3. Check for Alpine initialization
4. Test interactive elements (mobile menu, etc.)
5. Verify no JavaScript errors

## Support

Alpine.js Documentation: https://alpinejs.dev/
CDN Provider: https://www.jsdelivr.com/package/npm/alpinejs
