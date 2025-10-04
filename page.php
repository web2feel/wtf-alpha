<?php
/**
 * The template for displaying pages
 *
 * @package WTF_Alpha
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-8">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-xl max-w-4xl mx-auto'); ?>>
                <header class="entry-header mb-8">
                    <?php the_title('<h1 class="entry-title text-4xl font-bold">', '</h1>'); ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail mb-8">
                        <?php the_post_thumbnail('large', array('class' => 'rounded-lg w-full')); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links mt-8">' . esc_html__('Pages:', 'wtf-alpha'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </article>

            <?php
            // If comments are open or there's at least one comment
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
