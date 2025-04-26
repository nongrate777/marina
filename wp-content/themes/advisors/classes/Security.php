<?php
/**
 * Remove X-Powered-By
 */
add_action('init', 'jltwp_adminify_remove_powered');
function jltwp_adminify_remove_powered()
{
    if (function_exists('header_remove')) {
        header_remove('x-powered-by');
        header_remove('X-Powered-By');
    }
}
/**
 * Remove X-Redirect-By
 */
add_action('init', 'remove_x_redirect_header');
function remove_x_redirect_header() {
    if (function_exists('header_remove')) {
        header_remove('x-redirect-by');
        add_filter( 'x_redirect_by', '__return_false' );
    }
}
/**
 * Add the HTTP Strict Transport Security (HSTS) header
 */
function add_hsts_header() {
    if ( is_ssl() ) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}
add_action('template_redirect', 'add_hsts_header');
/**
 * Add necessary security headers
 */
function add_acah_headers($headers) {
    $headers['Access-Control-Allow-Methods']             = 'GET,POST';
    $headers['Access-Control-Allow-Headers']             = 'Content-Type, Authorization';
    $headers['Cross-Origin-Embedder-Policy']             = "unsafe-none; report-to='default'";
    $headers['Cross-Origin-Embedder-Policy-Report-Only'] = "unsafe-none; report-to='default'";
    $headers['Cross-Origin-Opener-Policy']               = 'unsafe-none';
    $headers['Cross-Origin-Opener-Policy-Report-Only']   = "unsafe-none; report-to='default'";
    $headers['Cross-Origin-Resource-Policy']             = 'cross-origin';
    $headers['Permissions-Policy']                       = 'accelerometer=(), autoplay=(), camera=(), cross-origin-isolated=(), display-capture=(self), encrypted-media=(), fullscreen=*, geolocation=(self), gyroscope=(), keyboard-map=(), magnetometer=(), microphone=(), midi=(), payment=*, picture-in-picture=(), publickey-credentials-get=(), screen-wake-lock=(), sync-xhr=(), usb=(), xr-spatial-tracking=(), gamepad=(), serial=()';
    $headers['Referrer-Policy']                          = 'strict-origin-when-cross-origin';
    $headers['X-Content-Security-Policy']                = 'default-src \'self\'; img-src *; media-src * data:;';
    $headers['X-Content-Type-Options']                   = 'nosniff';
    $headers['X-Frame-Options']                          = 'SAMEORIGIN';
    $headers['X-XSS-Protection']                         = '1; mode=block';
    $headers['X-Permitted-Cross-Domain-Policies']        = 'none';
    return $headers;
}
add_filter('wp_headers', 'add_acah_headers');
/**
 * Disable specific REST API endpoints.
 */
add_filter('rest_endpoints', function ($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    return $endpoints;
});
/**
 * Disable RSS feed
 */
function disable_feed() {
    wp_die( __('No feed available, please visit the <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}

add_action('do_feed', 'disable_feed', 1);
add_action('do_feed_rdf', 'disable_feed', 1);
add_action('do_feed_rss', 'disable_feed', 1);
add_action('do_feed_rss2', 'disable_feed', 1);
add_action('do_feed_atom', 'disable_feed', 1);


function enqueue_recaptcha_script() {
    if ( is_singular( 'page' ) ) {
        wp_enqueue_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_recaptcha_script' );



function advisors_block_theme_directory($template) {
    $template_dir = str_replace(ABSPATH, '', $template);
    if (strpos($template_dir, '/wp-content/themes/advisors/') === 0) {
        status_header(404);
        include get_template_directory() . '/404.php';
        exit;
    }
    return $template;
}

add_filter('template_include', 'advisors_block_theme_directory', 99);


add_action('template_redirect', 'block_user_id_access');
function block_user_id_access() {
    if (is_author()) {
        status_header(404);
        include get_template_directory() . '/404.php';
        exit;
    }
}

add_filter('wpseo_title', 'filter_wpseo_title', 10, 1);
function filter_wpseo_title($title) {
    if (is_404()) {
        return '404 Not Found';
    }
    return $title;
}

