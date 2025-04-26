<?php

class Walker_Menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $item_url = esc_attr($item->url);

        $class_names = !empty($item->classes[0]) ? ' class="' . trim($item->classes[0]) . '"' : '';

        $output .= '<li ' . $class_names . '>';

        $classes = ($item_url == $current_url) ? ' class="current"' : '';
        $attributes = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . $classes .'>' . $item->title . '</a>';

        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}
