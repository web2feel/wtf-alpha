<?php
/**
 * Template part for displaying search results
 *
 * @package WTF_Alpha
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-8 pb-8 border-b border-gray-200'); ?>>
    <header class="entry-header mb-4">
        <?php the_title('<h2 class="entry-title text-2xl font-bold mb-2"><a href="' . esc_url(get_permalink()) . '" class="hover:text-blue-600 transition">', '</a></h2>'); ?>

        <div class="entry-meta text-sm text-gray-600">
            <?php wtf_alpha_posted_on(); ?>
        </div>
    </header>

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>

    <footer class="entry-footer mt-4">
        <a href="<?php the_permalink(); ?>" class="text-blue-600 hover:text-blue-800 font-semibold">
            <?php esc_html_e('Read more &rarr;', 'wtf-alpha'); ?>
        </a>
    </footer>
</article>
