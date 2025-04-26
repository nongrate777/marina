<?php
/**
 * Template Name: Edit user profile
 */

get_header();
$fields_default = get_field('editprofile', 'options');

// Check if the user is logged in
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    // Check if the current user has the right to edit their profile
    if (current_user_can('edit_user', $user_id)) {

        // Processing the profile editing form
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_profile_nonce']) && wp_verify_nonce($_POST['edit_profile_nonce'], 'edit_profile_nonce')) {

            // Define an array of fields
            $fields = array(
                'industry',
                'work_remotely',
                'company_name',
                'visit_website',
                'appointment',
                'phone_number',
                'location',
                'location_country',
                'location_state',
                'location_city',
                'location_address',
                'location_zipcode',
                'photo',
                'about_me',
                'slogan',
                'year_established',
                'credentials',
                'payments',
                'hours_of_operation',
                'awards',
                'industry_more',
                'certificate',
                'vimeo',
                'youtube'
            );

            // Update user meta fields
            foreach ($fields as $field) {
                if ($field === 'photo') {
                    // Handling image upload
                    if (!empty($_FILES['photo']['tmp_name'])) {
                        $file = $_FILES['photo'];
                        $upload_overrides = array('test_form' => false);

                        $file_contents = file_get_contents($file['tmp_name']);
                        $upload_info = wp_upload_bits($file['name'], null, $file_contents, $upload_overrides);

                        if (!$upload_info['error']) {
                            $attachment_id = wp_insert_attachment(array(
                                'post_mime_type' => $file['type'],
                                'post_title' => preg_replace('/\.[^.]+$/', '', $file['name']),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            ), $upload_info['file']);

                            if (!is_wp_error($attachment_id)) {
                                require_once(ABSPATH . 'wp-admin/includes/image.php');
                                $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload_info['file']);
                                wp_update_attachment_metadata($attachment_id, $attachment_data);
                                update_field($field, $attachment_id, 'user_' . $user_id);
                            } else {
                                echo 'Error uploading photo: ' . $attachment_id->get_error_message();
                            }
                        } else {
                            echo 'Error uploading photo: ' . $upload_info['error'];
                        }


                        update_field($field, $attachment_id, 'user_' . $user_id);
                    }
                } elseif (isset($_POST[$field])) {
                    update_field($field, sanitize_text_field($_POST[$field]), 'user_' . $user_id);
                }
            }

            echo 'Profile updated successfully!';
        }

        // Get values of custom fields
        $fields = array(
            'industry',
            'work_remotely',
            'company_name',
            'visit_website',
            'appointment',
            'phone_number',
            'location',
            'location_country',
            'location_state',
            'location_city',
            'location_address',
            'location_zipcode',
            'photo',
            'about_me',
            'slogan',
            'year_established',
            'credentials',
            'payments',
            'hours_of_operation',
            'awards',
            'industry_more',
            'certificate',
            'vimeo',
            'youtube'
        );
        if (isset($_POST['user_email'])) {
            $user_email = sanitize_email($_POST['user_email']);
            if (!empty($user_email) && is_email($user_email)) {
                wp_update_user(array('ID' => $user_id, 'user_email' => $user_email));
            }
        }

        if (isset($_POST['user_pass'])) {
            $user_pass = $_POST['user_pass'];
            if (!empty($user_pass)) {
                wp_set_password($user_pass, $user_id);
            }
        }

        if (isset($_POST['user_login'])) {
            $user_login = sanitize_user($_POST['user_login']);
            if (!empty($user_login)) {
                wp_update_user(array('ID' => $user_id, 'user_login' => $user_login));
            }
        }
        ?>
        <section class="edit-profile">
            <div class="container">
                <div class="edit-profile__main">
                    <h1>
                        <?php the_title(); ?>
                    </h1>
                    <div class="profileinner__sidebar-contact-form edit-profile__main-inner">
                        <?php

                        // Display the notification if the user is deactivated
                        if (get_user_meta($user_id, 'deactivated', true)) {
                            if (!empty($fields_default['warning'])) { ?>
                                <div class="notice notice-warning">
                                    <p><?php echo $fields_default['warning'];?></p>
                            <?php }
                            ?>
                            </div>
                        <?php }
                        ?>
                        <form id="editProfileForm" action="<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>"
                              method="post" enctype="multipart/form-data">
                            <div class="edit-profile__main-item">
                                <label for="user_login">Username</label>
                                <br>
                                <input type="text" id="user_login" name="user_login" value="<?php echo esc_attr($current_user->user_login); ?>">
                            </div>
                            <div class="edit-profile__main-item">
                                <label for="user_email">Email</label>
                                <br>
                                <input type="email" id="user_email" name="user_email" value="<?php echo esc_attr($current_user->user_email); ?>">
                            </div>
                            <div class="edit-profile__main-item">
                                <label for="user_pass">Password</label>
                                <br>
                                <input type="password" id="user_pass" name="user_pass">
                            </div>
                            <?php wp_nonce_field('edit_profile_nonce', 'edit_profile_nonce'); ?>
                            <?php
                            /**
                             * Fields
                             */
                            foreach ($fields as $field) :
                                if ($field === 'photo') : ?>
                                    <div class="edit-profile__main-item">
                                        <label for="photo">Photo</label>
                                        <br>
                                        <input type="file" id="photo" name="photo" accept="image/*">
                                        <?php
                                        /**
                                         * User Avatar
                                         */
                                        $photo_url = wp_get_attachment_image_url(get_field($field, 'user_' . $user_id), 'thumbnail');
                                        if ($photo_url) { ?>
                                            <img loading="lazy"
                                                 src="<?php echo esc_url($photo_url); ?>"
                                                 alt="User Photo"
                                                 decoding="async"
                                                 width="100"
                                                 height="100">
                                        <?php } ?>
                                    </div>
                                <?php else : ?>
                                    <div class="edit-profile__main-item">
                                        <label for="<?php echo esc_attr($field); ?>">
                                            <?php echo esc_html(ucwords(str_replace('_', ' ', $field))); ?>
                                        </label>
                                        <br>
                                        <input type="text"
                                               id="<?php echo esc_attr($field); ?>"
                                               name="<?php echo esc_attr($field); ?>"
                                               value="<?php echo esc_attr(get_field($field, 'user_' . $user_id)); ?>">
                                    </div>
                                <?php endif;
                            endforeach; ?>
                            <div class="taxdome__button">
                                <input type="submit" name="submit" value="Save Changes">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
    } else {
        echo 'You do not have permission to edit this profile.';
    }
} else {
    echo 'Please log in to edit your profile.';
}

get_footer();
?>
