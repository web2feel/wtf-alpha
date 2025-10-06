<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="min-h-screen flex flex-col">
        <a class="sr-only focus:not-sr-only" href="#primary"><?php esc_html_e('Skip to content', 'wtf-alpha'); ?></a>

        <header id="masthead" class="site-header bg-white shadow-sm">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-4">
                    <div class="site-branding">
                        <?php
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                        ?>
                            <h1 class="site-title text-2xl font-bold">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                            <?php
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) :
                            ?>
                                <p class="site-description text-sm text-gray-600">
                                    <?php echo $description; ?>
                                </p>
                            <?php endif; ?>
                        <?php } ?>
                    </div>

                    <nav id="site-navigation" class="main-navigation" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="menu-toggle lg:hidden px-2 py-2 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-md cursor-pointer z-50 relative"
                            aria-controls="primary-menu"
                            :aria-expanded="open">
                            <span class="sr-only"><?php esc_html_e('Menu', 'wtf-alpha'); ?></span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'container'      => 'div',
                            'container_class' => 'hidden lg:block',
                            'menu_class'     => 'flex',
                            'fallback_cb'    => false,
                            'walker'         => new WTF_Alpha_Tailwind_Nav_Walker(),
                        ));
                        ?>

                        <!-- Mobile menu overlay -->
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @click="open = false"
                            class="fixed inset-0 bg-black/70 z-40 lg:hidden"
                            style="display: none;"></div>

                        <!-- Mobile menu panel -->
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out  duration-300 transform"
                            x-transition:enter-start="translate-x-full"
                            x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="translate-x-0"
                            x-transition:leave-end="translate-x-full"
                            @click.away="open = false"
                            class="fixed top-0 right-0 bottom-0 w-96 max-w-full bg-white shadow-2xl z-50 lg:hidden overflow-y-auto"
                            style="display: none;">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <!-- <h2 class="text-xl font-bold text-gray-900"><?php esc_html_e('Menu', 'wtf-alpha'); ?></h2> -->
                                    <button
                                        @click="open = false"
                                        class="p-2 text-gray-600 hover:text-gray-900 rounded-md ml-auto cursor-pointer">
                                        <span class="sr-only"><?php esc_html_e('Close menu', 'wtf-alpha'); ?></span>
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class'     => 'mobile-menu flex flex-col space-y-1',
                                    'fallback_cb'    => false,
                                    'walker'         => new WTF_Alpha_Tailwind_Nav_Walker(),
                                ));
                                ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <div id="content" class="site-content flex-grow">