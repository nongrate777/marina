<?php
/**
 * General
 */
include_once 'classes/General.php';
/**
 * Menu
 */
include_once 'classes/Walker_Menu.php';
/**
 * ACF
 */
include_once 'classes/ACF_init.php';
/**
 * Security
 */
include_once 'classes/Security.php';
/**
 * Search
 */
include_once 'classes/Ajax_Search.php';
/**
 * Messages
 */
include_once 'classes/Send_message.php';
/**
 * Sanitize
 */
include_once 'classes/Sanitize.php';
/**
 * Synchronization
 */
include_once 'classes/App.php';

function handle_review_submission() {
    if (
        isset($_POST['action']) && $_POST['action'] == 'submit_review' &&
        isset($_POST['user_id']) && isset($_POST['review_title']) &&
        isset($_POST['review']) && isset($_POST['name_or_company']) &&
        isset($_POST['email'])
    ) {
        $user_id = absint($_POST['user_id']);
        $review_title = sanitize_text_field($_POST['review_title']);
        $review_content = sanitize_textarea_field($_POST['review']);
        $name_or_company = sanitize_text_field($_POST['name_or_company']);
        $email = sanitize_email($_POST['email']);

        $review_data = array(
            'title' => $review_title,
            'content' => $review_content,
            'name_or_company' => $name_or_company,
            'email' => $email,
        );


        add_user_meta($user_id, 'user_review', $review_data);

        wp_send_json_success('Review submitted successfully');
    } else {
        wp_send_json_error('Invalid request');
    }
}

add_action('wp_ajax_submit_review', 'handle_review_submission');
add_action('wp_ajax_nopriv_submit_review', 'handle_review_submission');
