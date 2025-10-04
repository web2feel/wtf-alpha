    </div><!-- #content -->

    <footer id="colophon" class="site-footer bg-gray-100 mt-auto">
        <?php if (is_active_sidebar('footer-1')) : ?>
            <div class="footer-widgets">
                <div class="container mx-auto px-4 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="site-info py-6 border-t border-gray-200">
            <div class="container mx-auto px-4 text-center text-sm text-gray-600">
                <p>
                    &copy; <?php echo date('Y'); ?> 
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-gray-900">
                        <?php bloginfo('name'); ?>
                    </a>
                    <?php
                    printf(
                        esc_html__('| Theme by %s', 'wtf-alpha'),
                        '<a href="https://web2feel.com" class="hover:text-gray-900">Jinson</a>'
                    );
                    ?>
                </p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
