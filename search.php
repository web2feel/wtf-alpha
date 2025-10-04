<?php
/**
 * The template for displaying search results
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
                        <h1 class="page-title text-3xl font-bold">
                            <?php
                            printf(
                                esc_html__('Search Results for: %s', 'wtf-alpha'),
                                '<span class="text-blue-600">' . get_search_query() . '</span>'
                            );
                            ?>
                        </h1>
                    </header>

                    <?php
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'search');
                    endwhile;

                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => __('&larr; Previous', 'wtf-alpha'),
                        'next_text' => __('Next &rarr;', 'wtf-alpha'),
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
