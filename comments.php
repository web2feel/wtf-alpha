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
    $commenter = wp_get_current_commenter();
    $req       = get_option('require_name_email');
    $aria_req  = ($req ? " aria-required='true'" : '');
    $html_req  = ($req ? " required='required'" : '');
    
    $comment_args = array(
        'class_form'           => 'comment-form space-y-6',
        'class_submit'         => 'submit px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition cursor-pointer font-medium shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2',
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title text-2xl font-bold mb-6">',
        'title_reply_after'    => '</h3>',
        'cancel_reply_before'  => '<span class="ml-2">',
        'cancel_reply_after'   => '</span>',
        'cancel_reply_link'    => '<span class="text-sm text-gray-600 hover:text-gray-900">' . esc_html__('Cancel reply', 'wtf-alpha') . '</span>',
        'label_submit'         => esc_html__('Post Comment', 'wtf-alpha'),
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        'submit_field'         => '<div class="form-submit pt-2">%1$s %2$s</div>',
        'comment_field'        => '<div class="comment-form-comment">
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__('Comment', 'wtf-alpha') . ' <span class="text-red-500">*</span></label>
            <textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required="required" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y" placeholder="' . esc_attr__('Write your comment here...', 'wtf-alpha') . '"></textarea>
        </div>',
        'fields'               => array(
            'author' => '<div class="comment-form-author">
                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__('Name', 'wtf-alpha') . ($req ? ' <span class="text-red-500">*</span>' : '') . '</label>
                <input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="' . esc_attr__('Your name', 'wtf-alpha') . '" />
            </div>',
            'email'  => '<div class="comment-form-email">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__('Email', 'wtf-alpha') . ($req ? ' <span class="text-red-500">*</span>' : '') . '</label>
                <input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="' . esc_attr__('your.email@example.com', 'wtf-alpha') . '" />
                <p id="email-notes" class="text-xs text-gray-500 mt-1">' . esc_html__('Your email address will not be published.', 'wtf-alpha') . '</p>
            </div>',
            'url'    => '<div class="comment-form-url">
                <label for="url" class="block text-sm font-medium text-gray-700 mb-2">' . esc_html__('Website', 'wtf-alpha') . '</label>
                <input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="' . esc_attr__('https://yourwebsite.com (optional)', 'wtf-alpha') . '" />
            </div>',
            'cookies' => '<div class="comment-form-cookies-consent flex items-start gap-3">
                <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                <label for="wp-comment-cookies-consent" class="text-sm text-gray-700">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'wtf-alpha') . '</label>
            </div>',
        ),
    );
    
    comment_form($comment_args);
    ?>

</div>
