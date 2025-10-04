<?php
/**
 * Template part for displaying posts
 *
 * @package WTF_Alpha
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-12 pb-8 border-b border-gray-200 last:border-0'); ?>>
    <header class="entry-header mb-4">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title text-4xl font-bold mb-4">', '</h1>');
        else :
            the_title('<h2 class="entry-title text-2xl font-bold mb-2"><a href="' . esc_url(get_permalink()) . '" class="hover:text-blue-600 transition">', '</a></h2>');
        endif;
        ?>

        <div class="entry-meta text-sm text-gray-600 flex flex-wrap gap-4">
            <?php
            wtf_alpha_posted_on();
            wtf_alpha_posted_by();
            ?>
        </div>
    </header>

    <?php if (has_post_thumbnail() && !is_singular()) : ?>
        <div class="post-thumbnail mb-4">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large', array('class' => 'rounded-lg w-full')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content prose max-w-none">
        <?php
        if (is_singular()) :
            the_content();
        else :
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="inline-block mt-2 text-blue-600 hover:text-blue-800 font-semibold">
                <?php esc_html_e('Read more &rarr;', 'wtf-alpha'); ?>
            </a>
            <?php
        endif;

        wp_link_pages(array(
            'before' => '<div class="page-links mt-4">' . esc_html__('Pages:', 'wtf-alpha'),
            'after'  => '</div>',
        ));
        ?>
    </div>

    <footer class="entry-footer mt-4">
        <?php wtf_alpha_entry_footer(); ?>
    </footer>
</article>
