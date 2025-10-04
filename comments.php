<?php
/**
 * The template for displaying comments
 *
 * @package WTF_Alpha
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mt-12 max-w-4xl mx-auto">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title text-2xl font-bold mb-6">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('One comment on &ldquo;%s&rdquo;', 'wtf-alpha'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx('%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'wtf-alpha')),
                    number_format_i18n($comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list space-y-6 mb-8">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
                'callback'    => 'wtf_alpha_comment',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => __('&larr; Older Comments', 'wtf-alpha'),
            'next_text' => __('Newer Comments &rarr;', 'wtf-alpha'),
        ));

        if (!comments_open()) :
            ?>
            <p class="no-comments text-gray-600">
                <?php esc_html_e('Comments are closed.', 'wtf-alpha'); ?>
            </p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form(array(
        'class_form'           => 'comment-form space-y-4',
        'class_submit'         => 'submit px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition cursor-pointer',
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title text-2xl font-bold mb-6">',
        'title_reply_after'    => '</h3>',
    ));
    ?>

</div>
