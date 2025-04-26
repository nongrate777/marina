<?php

if (!defined('ABSPATH')) {
    exit;
}

if (strpos($_SERVER['REQUEST_URI'], '/wp-content/themes/advisors/') === 0) {
    header('HTTP/1.0 404 Not Found');
    include get_template_directory() . '/404.php';
    exit;
}
