<?php
/**
 * Template part for displaying single post content
 *
 * @package WTF_Alpha
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('prose lg:prose-xl max-w-4xl mx-auto'); ?>>
    <header class="entry-header mb-8">
        <?php the_title('<h1 class="entry-title text-4xl font-bold mb-4">', '</h1>'); ?>

        <div class="entry-meta text-sm text-gray-600 flex flex-wrap gap-4 mb-6">
            <?php
            wtf_alpha_posted_on();
            wtf_alpha_posted_by();
            ?>
        </div>

        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail mb-6">
                <?php the_post_thumbnail('large', array('class' => 'rounded-lg w-full')); ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links mt-8">' . esc_html__('Pages:', 'wtf-alpha'),
            'after'  => '</div>',
        ));
        ?>
    </div>

    <footer class="entry-footer mt-8 pt-6 border-t border-gray-200">
        <?php wtf_alpha_entry_footer(); ?>
    </footer>
</article>
