<?php
class Ajax_Search
{
    protected static $instance = null;

    public static function instance(): ?Ajax_Search
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct()
    {
        add_action('wp_ajax_search', [$this, 'getSearchUsers']);
        add_action('wp_ajax_nopriv_search', [$this, 'getSearchUsers']);
    }

    public function getSearchUsers(): void
    {
        global $wpdb;

        $service = filter_input(INPUT_POST, 'service');
        $location = filter_input(INPUT_POST, 'location');

        if (empty($service) && empty($location)) {
            $this->return404();
        }

        $result = [];

        if (!empty($service)) {
            $sql = $wpdb->prepare(
                "SELECT DISTINCT meta_value FROM wp_usermeta WHERE meta_key = 'industry' AND meta_value LIKE %s LIMIT 0, 5",
                '%' . $wpdb->esc_like($service) . '%'
            );
            $result = $wpdb->get_results($sql, ARRAY_A);
        }

        if (!empty($location)) {
            $sql = $wpdb->prepare(
                "SELECT DISTINCT meta_value FROM wp_usermeta WHERE (meta_key = 'location_city' OR meta_key = 'location_zipcode' OR meta_key = 'location_country' OR meta_key = 'location_state') AND meta_value LIKE %s LIMIT 0, 5",
                '%' . $wpdb->esc_like($location) . '%'
            );
            $result = $wpdb->get_results($sql, ARRAY_A);
        }

        if (empty($result)) {
            $this->return404();
        }

        wp_send_json_success($result);
    }

    private function return404(): void
    {
        status_header(404);
        include get_template_directory() . '/404.php';
        exit;
    }
}

Ajax_Search::instance();
