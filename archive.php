<?php
/**
 * The template for displaying archive pages
 *
 * @package WTF_Alpha
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-2/3">
                <?php if (have_posts()) : ?>

                    <header class="page-header mb-8">
                        <?php
                        the_archive_title('<h1 class="page-title text-3xl font-bold mb-4">', '</h1>');
                        the_archive_description('<div class="archive-description text-gray-600">', '</div>');
                        ?>
                    </header>

                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', get_post_type());
                    endwhile;

                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => __('&larr; Previous', 'wtf-alpha'),
                        'next_text' => __('Next &rarr;', 'wtf-alpha'),
                        'class'     => 'pagination flex justify-center space-x-2 mt-8',
                    ));

                else :
                    get_template_part('template-parts/content', 'none');
                endif;
                ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
