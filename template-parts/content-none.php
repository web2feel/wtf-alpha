<?php
/**
 * Template part for displaying a message when posts are not found
 *
 * @package WTF_Alpha
 */
?>

<section class="no-results not-found">
    <header class="page-header mb-8">
        <h1 class="page-title text-3xl font-bold">
            <?php esc_html_e('Nothing Found', 'wtf-alpha'); ?>
        </h1>
    </header>

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) :
            ?>
            <p class="mb-4">
                <?php
                printf(
                    wp_kses(
                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wtf-alpha'),
                        array('a' => array('href' => array()))
                    ),
                    esc_url(admin_url('post-new.php'))
                );
                ?>
            </p>
        <?php elseif (is_search()) : ?>
            <p class="mb-4">
                <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wtf-alpha'); ?>
            </p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p class="mb-4">
                <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wtf-alpha'); ?>
            </p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>
