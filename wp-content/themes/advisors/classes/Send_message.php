<?php
class Send_message
{
    protected static $instance = null;

    public static function instance(): ?Send_message
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function init()
    {
        add_action('wp_ajax_process_contact_form', array($this, 'process_contact_form'));
        add_action('wp_ajax_nopriv_process_contact_form', array($this, 'process_contact_form'));
    }

    public function process_contact_form()
    {
        if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_nonce') || !wp_verify_nonce($_POST['csrf_token'])) {
            wp_send_json_error('Nonce verification failed');
        }


        $name    = sanitize_text_field($_POST['name']);
        $email   = sanitize_email($_POST['email']);
        $phone   = sanitize_text_field($_POST['phone']);
        $day     = sanitize_text_field($_POST['day']);
        $time    = sanitize_text_field($_POST['time']);
        $zipcode = sanitize_text_field($_POST['zipcode']);
        $message = sanitize_textarea_field($_POST['message']);

        $user_id = get_query_var('user_id');
        $user = get_user_by('ID', $user_id);
        $user_email = $user->user_email;

        $to      = $user_email;
        $subject = 'New Contact Form Submission';
        $headers = array('Content-Type: text/html; charset=UTF-8');

        $body = "Name: $name <br>";
        $body .= "Email: $email <br>";
        $body .= "Phone: $phone <br>";
        $body .= "Day: $day <br>";
        $body .= "Time: $time <br>";
        $body .= "Zip Code: $zipcode <br>";
        $body .= "Message: $message <br>";

        wp_mail($to, $subject, $body, $headers);

        wp_send_json_success('Message successfully received');
    }
}


Send_message::instance()->init();
