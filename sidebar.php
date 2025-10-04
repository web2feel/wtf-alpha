<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WTF_Alpha
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area lg:w-1/3">
    <div class="sticky top-4">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside>
