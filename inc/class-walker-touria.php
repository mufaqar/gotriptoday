<?php
class Touria_Walker_Nav_Menu extends Walker_Nav_Menu {
    // Start level
    function start_lvl(&$output, $depth = 0, $args = []) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"touria-dd-menu\">\n";
    }

    // Start element
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        $class_names = join(' ', array_filter($classes));

        $class_names = $class_names ? ' class="touria-dd ' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $icon = '';
        if ($has_children) {
            $icon = ($depth == 0) ? ' <i class="ti ti-chevron-down"></i>' : ' <i class="ti ti-chevron-right"></i>';
        }

        $attributes  = ' href="' . esc_attr($item->url) . '"';
        $item_output = '<a' . $attributes . '>';
        $item_output .= apply_filters('the_title', $item->title, $item->ID);
        $item_output .= $icon . '</a>';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    // End element
    function end_el(&$output, $item, $depth = 0, $args = []) {
        $output .= "</li>\n";
    }

    // End level
    function end_lvl(&$output, $depth = 0, $args = []) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}