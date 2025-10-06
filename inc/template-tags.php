<?php
/**
 * Custom template tags for this theme
 *
 * @package WTF_Alpha
 */

if (!function_exists('wtf_alpha_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function wtf_alpha_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            esc_html_x('Posted on %s', 'post date', 'wtf-alpha'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>';
    }
endif;

if (!function_exists('wtf_alpha_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function wtf_alpha_posted_by() {
        $byline = sprintf(
            esc_html_x('by %s', 'post author', 'wtf-alpha'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>';
    }
endif;

if (!function_exists('wtf_alpha_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function wtf_alpha_entry_footer() {
        // Categories
        $categories_list = get_the_category_list(esc_html__(', ', 'wtf-alpha'));
        if ($categories_list) {
            printf('<span class="cat-links inline-flex items-center mr-4 break-all"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>' . esc_html__('Categories: ', 'wtf-alpha') . '%1$s</span>', $categories_list);
        }

        // Tags
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'wtf-alpha'));
        if ($tags_list) {
            printf('<span class="tags-links inline-flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>' . esc_html__('Tags: ', 'wtf-alpha') . '%1$s</span>', $tags_list);
        }

        // Comments
        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link ml-4">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wtf-alpha'),
                        array('span' => array('class' => array()))
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    __('Edit <span class="screen-reader-text">%s</span>', 'wtf-alpha'),
                    array('span' => array('class' => array()))
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link ml-4">',
            '</span>'
        );
    }
endif;

if (!function_exists('wtf_alpha_comment')) :
    /**
     * Custom comment output
     */
    function wtf_alpha_comment($comment, $args, $depth) {
        $tag = ('div' === $args['style']) ? 'div' : 'li';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('comment bg-gray-50 p-4 rounded-lg', $comment); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <footer class="comment-meta mb-4 flex items-start">
                    <div class="comment-author vcard mr-3">
                        <?php
                        if (0 != $args['avatar_size']) {
                            echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'rounded-full'));
                        }
                        ?>
                    </div>
                    <div class="comment-metadata flex-1">
                        <b class="fn"><?php echo get_comment_author_link($comment); ?></b>
                        <div class="text-sm text-gray-600">
                            <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>" class="hover:text-gray-900">
                                <time datetime="<?php comment_time('c'); ?>">
                                    <?php
                                    printf(
                                        esc_html__('%1$s at %2$s', 'wtf-alpha'),
                                        get_comment_date('', $comment),
                                        get_comment_time()
                                    );
                                    ?>
                                </time>
                            </a>
                            <?php edit_comment_link(esc_html__('Edit', 'wtf-alpha'), '<span class="edit-link ml-2">', '</span>'); ?>
                        </div>
                    </div>
                </footer>

                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation text-sm text-yellow-700 bg-yellow-50 p-2 rounded mb-4">
                        <?php esc_html_e('Your comment is awaiting moderation.', 'wtf-alpha'); ?>
                    </p>
                <?php endif; ?>

                <div class="comment-content prose prose-sm max-w-none">
                    <?php comment_text(); ?>
                </div>

                <?php
                comment_reply_link(array_merge($args, array(
                    'add_below' => 'div-comment',
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<div class="reply mt-3">',
                    'after'     => '</div>',
                )));
                ?>
            </article>
        <?php
    }
endif;
