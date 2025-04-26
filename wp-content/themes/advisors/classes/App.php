<?php
class App
{
    protected static $instance = null;
    private $api_url = 'https://app.taxdome.com/api/v1/guest/subscription_statuses';
    private $api_username = '4e19b268ae9d77fded81d58841890348a0e97c86b946e8b956ce700201e884381992fe571707243f89e6f29d2d603e1d5deecec9b336923d787a7decef728c1b';
    private $api_password = '5addd8c9cb8f17725583278d0b438719a11ef50f529eb0939d99329661c1d6ab55b69fd40888c83c130ca616fdcbd65d2ee18d51a24ce962d2f11c965e05b4a9';

    public static function instance(): ?App
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        add_action('init', [$this, 'check_user_subscription']);
    }

    public function check_user_subscription()
    {
        if (!is_user_logged_in()) {
            return;
        }

        $user = wp_get_current_user();
        $email = $user->user_email;

        $response = $this->get_subscription_status($email);

        if (is_wp_error($response)) {
            return;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($data['subscription_status'])) {
            update_user_meta($user->ID, 'subscription_status', $data['subscription_status']);
        }
    }

    public function is_subscription_valid($email)
    {
        $response = $this->get_subscription_status($email);

        if (is_wp_error($response)) {
            return true;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($data['subscription_status'])) {
            return !empty($data['subscription_status']);
        }

        return true;
    }

    private function get_subscription_status($email)
    {
        $url = add_query_arg('email', $email, $this->api_url);

        $args = [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->api_username . ':' . $this->api_password),
            ],
        ];

        $response = wp_remote_get($url, $args);

        return $response;
    }
}

App::instance();
