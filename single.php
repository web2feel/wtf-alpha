<?php
/**
 * The template for displaying single posts
 *
 * @package WTF_Alpha
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-2/3">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'single');

                    // Post navigation
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'wtf-alpha') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'wtf-alpha') . '</span> <span class="nav-title">%title</span>',
                        'class'     => 'post-navigation flex justify-between my-8',
                    ));

                    // If comments are open or there's at least one comment
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile;
                ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
get_footer();
