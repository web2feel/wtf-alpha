<?php

/**
 * Custom Navigation Walker for Tailwind CSS
 *
 * @package WTF_Alpha
 */

class WTF_Alpha_Tailwind_Nav_Walker extends Walker_Nav_Menu
{

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);

        // Base classes for submenu
        $classes = array('sub-menu', 'bg-white', 'shadow-lg', 'py-0', 'min-w-64');

        // Positioning based on depth - handled by CSS but add z-index
        if ($depth === 0) {
            $classes[] = 'z-40';
        } elseif ($depth === 1) {
            $classes[] = 'z-50';
        } elseif ($depth === 2) {
            $classes[] = 'z-60';
        } else {
            // For deeper levels, adjust as needed
            $classes[] = 'z-70';
        }

        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Check if item has children
        $has_children = in_array('menu-item-has-children', $classes);

        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        if ('_blank' === $item->target && empty($item->xfn)) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = !empty($item->url) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';

        // Tailwind classes for menu items
        if ($depth === 0) {
            $atts['class'] = 'block px-4 py-2 text-gray-700 hover:text-blue-600 transition flex items-center gap-1 ';
        } else {
            $atts['class'] = 'block px-4 py-3 text-gray-700 hover:bg-gray-100 transition flex items-center justify-between';
        }

        if ($item->current) {
            $atts['class'] .= 'text-blue-600 font-semibold';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        // Add caret icon for items with children
        $caret_icon = '';
        if ($has_children) {
            if ($depth === 0) {
                // Down arrow for top-level items
                $caret_icon = '<svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
            } else {
                // Right arrow for submenu items
                $caret_icon = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= '<span>' . $args->link_before . $title . $args->link_after . '</span>';
        $item_output .= $caret_icon;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
