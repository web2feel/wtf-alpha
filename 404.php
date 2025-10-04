<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WTF_Alpha
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto text-center">
            <div class="error-404 not-found">
                <header class="page-header mb-8">
                    <h1 class="page-title text-6xl font-bold text-gray-800 mb-4">404</h1>
                    <p class="text-2xl text-gray-600">
                        <?php esc_html_e('Oops! That page can&rsquo;t be found.', 'wtf-alpha'); ?>
                    </p>
                </header>

                <div class="page-content">
                    <p class="mb-8 text-gray-600">
                        <?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'wtf-alpha'); ?>
                    </p>

                    <div class="max-w-md mx-auto mb-8">
                        <?php get_search_form(); ?>
                    </div>

                    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <?php esc_html_e('Go to Homepage', 'wtf-alpha'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
