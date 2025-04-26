<?php
/**
 * Template Name: Login/Register Template
 */
get_header();

/**
 * Login/Register page default fields
 */
$fields           = get_fields();
$login            = $fields['login'];
$register         = $fields['register'];
$enter_email      = $fields['enter_email'];
$confirm_email    = $fields['confirm_email'];
$create_password  = $fields['create_password'];
$confirm_password = $fields['confirm_password'];
$create_button    = $fields['create'];

/**
 * reCAPTCHA fields for contact form
 */
$fields = get_field('integrations', 'options');
$fields_site = $fields['google_recaptcha_site_key'];
$fields_secret = $fields['google_recaptcha_secret_key'];

$args = array(
    'echo' => true,
    'redirect' => site_url($_SERVER['REQUEST_URI']),
    'form_id' => 'loginform',
    'label_username' => __('Username or Email Address'),
    'label_password' => __('Password'),
    'label_log_in' => __('Log In'),
    'id_username' => 'user_login',
    'id_password' => 'user_pass',
    'id_submit' => 'wp-submit',
    'remember' => false,
    'lost_password' => true
);

/**
 * Login redirect
 */
if (isset($_POST['wp-submit'])) {
    if (is_user_logged_in()) {
        wp_redirect(home_url('/edit-user-profile/'));
        exit;
    }
}

/**
 * Function to check subscription status via API
 */
function check_subscription_status($email) {
    $api_url = 'https://app.taxdome.com/api/v1/guest/subscription_statuses?email=' . urlencode($email);
    $api_key = '4e19b268ae9d77fded81d58841890348a0e97c86b946e8b956ce700201e884381992fe571707243f89e6f29d2d603e1d5deecec9b336923d787a7decef728c1b:5addd8c9cb8f17725583278d0b438719a11ef50f529eb0939d99329661c1d6ab55b69fd40888c83c130ca616fdcbd65d2ee18d51a24ce962d2f11c965e05b4a9';

    $response = wp_remote_get($api_url, array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode($api_key)
        )
    ));

    if (is_wp_error($response)) {
        return false; // API request failed
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    return isset($data['subscription_status']) && $data['subscription_status'] === 'active';
}

/**
 * Process registration form submission
 */
if (isset($_POST['user_email']) && isset($_POST['user_pass'])) {
    $email = sanitize_email($_POST['user_email']);
    if (check_subscription_status($email)) {
        // Proceed with registration
        wp_create_user($email, $_POST['user_pass'], $email);
        wp_redirect(home_url('/edit-user-profile/'));
        exit;
    } else {
        // Redirect to Start Free Trial page
        wp_redirect(home_url('/start-free-trial/'));
        exit;
    }
}
?>
    <section class="contact-form__breadcumbs">
        <div class="container">
            <div class="breadcrumbs">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="current"> / <?php the_title(); ?></span>
            </div>
        </div>
    </section>
    <section class="login-page">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <div id="primary" class="content-area">
                <div id="main" class="site-main" role="main">
                    <div class="login-register-tabs">
                        <div id="login" class="tab-content active profileinner__sidebar-contact-form">
                            <h3><?php echo isset($login) ? esc_html($login) : ''; ?></h3>
                            <?php wp_login_form($args); ?>
                        </div>
                        <div id="register" class="tab-content profileinner__sidebar-contact-form">
                            <h3><?php echo isset($register) ? esc_html($register) : ''; ?></h3>
                            <form id="register-form" method="post" class="register-form" onsubmit="return validateForm();">
                                <?php wp_nonce_field('register', 'register_nonce'); ?>
                                <div class="flex-input">
                                    <label for="user_email"><span>* </span><?php echo isset($enter_email) ? esc_html($enter_email) : ''; ?></label>
                                    <input type="text" name="user_email" id="user_email" required placeholder="<?php echo isset($enter_email) ? esc_html($enter_email) : ''; ?>"/>
                                </div>
                                <div class="flex-input">
                                    <label for="confirm_user_email"><span>* </span><?php echo isset($confirm_email) ? esc_html($confirm_email) : ''; ?></label>
                                    <input type="text" name="confirm_user_email" id="confirm_user_email" required placeholder="<?php echo isset($confirm_email) ? esc_html($confirm_email) : ''; ?>"/>
                                </div>
                                <div class="flex-input">
                                    <label for="user_pass"><span>* </span><?php echo isset($create_password) ? esc_html($create_password) : ''; ?></label>
                                    <input type="password" name="user_pass" id="user_pass" required placeholder="<?php echo isset($create_password) ? esc_html($create_password) : ''; ?>"/>
                                </div>
                                <div class="flex-input">
                                    <label for="confirm_user_pass"><span>* </span><?php echo isset($confirm_password) ? esc_html($confirm_password) : ''; ?></label>
                                    <input type="password" name="confirm_user_pass" id="confirm_user_pass" required placeholder="<?php echo isset($confirm_password) ? esc_html($confirm_password) : ''; ?>"/>
                                </div>
                                <p id="error-message" style="color: red;"></p>

                                <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/edit-user-profile/')); ?>"/>
                                <!--<div class="g-recaptcha recaptcha" data-sitekey="<?php //echo isset($fields_site) ? esc_html($fields_site) : ''; ?>"></div>-->
                                <input type="submit" value="<?php echo isset($create_button) ? esc_html($create_button) : ''; ?>" onclick="return validateForm();"/>
                            </form>
                        </div>
                    </div>
                    <ul class="tabs">
                        <li class="active disbled" data-tab="login">Already have an account? <span><?php echo isset($login) ? esc_html($login) : ''; ?></span></li>
                        <li data-tab="register">Don't have account? <span><?php echo isset($register) ? esc_html($register) : ''; ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tabs = document.querySelectorAll('.tabs li');
            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    var activeTab = document.querySelector('.tabs li.active');
                    activeTab.classList.remove('active');
                    activeTab.classList.remove('disbled');
                    this.classList.add('active');
                    this.classList.add('disbled');

                    var activeContent = document.querySelector('.tab-content.active');
                    activeContent.classList.remove('active');

                    var targetContentId = this.getAttribute('data-tab');
                    var targetContent = document.getElementById(targetContentId);
                    targetContent.classList.add('active');
                });
            });

            // Change the action of the login form
            var loginForm = document.getElementById('loginform');
            if (loginForm) {
                loginForm.action = '<?php echo esc_url(home_url('taxdome-auth.php')); ?>';
            }
        });


    </script>
    <style>
        .footer:before {
            display: none;
        }
    </style>
<?php get_footer(); ?>
