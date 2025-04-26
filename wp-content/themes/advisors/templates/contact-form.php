<?php
/**
 * Template Name: Contact form for member
 */

$user_id = get_query_var('user_id');
$user = get_user_by('ID', $user_id);
$photo = get_field('photo', 'user_' . $user_id);
$profile_url = home_url('/single-users-profile/?user_id=') . $user_id;
$back_button = get_field('back_button');
$company_name = get_field('company_name', 'user_' . $user_id);

$user_id      = get_query_var('user_id');
$user         = get_user_by('ID', $user_id);
$photo        = get_field('photo', 'user_' . $user_id);
$profile_url  = home_url('/single-users-profile/?user_id=') . $user_id;
$back_button  = get_field('back_button');
$company_name = get_field('company_name', 'user_' . $user_id);
/**
 * reCAPTCHA fields for contact form
 */
$fields = get_field('integrations', 'options');
$fields_site = $fields['google_recaptcha_site_key'];
$fields_secret = $fields['google_recaptcha_secret_key'];

/**
 * Default fields for contact form
 */
$enter_name = get_field('enter_name');
$enter_email = get_field('enter_email');
$enter_phone = get_field('enter_phone');
$reply_day = get_field('reply_day');
$reply_time = get_field('reply_time');
$zip_code = get_field('zip_code');
$message_label = get_field('message');
$send_message_label = get_field('send_message');
$contact_label = get_field('contact');
$week_days = get_field('week_days');
$week_sunday = get_field('sunday');
$week_monday = get_field('monday');
$week_tuesday = get_field('tuesday');
$week_wednesday = get_field('wednesday');
$week_thursday = get_field('thursday');
$week_friday = get_field('friday');
$week_saturday = get_field('saturday');
/**
 * Header
 */
get_header();
/**
 * CSRF Token
 */
wp_nonce_field('csrf_action', 'csrf_token');
?>
<section class="contact-form__breadcumbs">
    <div class="container">
        <div class="breadcrumbs">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            <span class="current"> / Contact <?php echo esc_html($company_name); ?></span>
        </div>
    </div>
</section>
<section class="contact-form">
    <h1><?php the_title(); ?></h1>
    <div class="container">
        <div class="contact-form__sidebar">
            <?php
            /**
             * Image
             */
            if (!empty($photo)) { ?>
                <div class="contact-form__sidebar-img">
                    <img loading="lazy"
                         src="<?php echo esc_url($photo['url']); ?>"
                         alt="<?php bloginfo('name') ?>"
                         decoding="async"
                         width="250"
                         height="250">
                </div>
            <?php } ?>
            <div class="contact-form__sidebar-content">
                <h3>
                    <a href="<?php echo esc_url($profile_url); ?>"
                       tabindex="0"
                       aria-label="<?php echo esc_html($company_name); ?>">
                        <?php echo esc_html($company_name); ?>
                    </a>
                </h3>
            </div>
            <?php
            /**
             * Button
             */
            if (!empty($back_button)) { ?>
                <div class="contact-form__sidebar-back taxdome__button-light">
                    <a href="<?php echo esc_url($profile_url); ?>"
                       tabindex="0"
                       aria-label="<?php echo esc_html($back_button); ?>">
                        <?php echo esc_html($back_button); ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="contact-form__content">
            <h2>
                <?php echo esc_html($contact_label) . ' ' . esc_html($company_name); ?>
            </h2>
            <div class="profileinner__sidebar-contact-form form-inner">
                <form id="contactForm" autocomplete="off" class="contactForm"
                      action="<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <?php wp_nonce_field('contact_form_nonce', 'contact_form_nonce'); ?>
                    <input type="hidden" name="action" value="process_contact_form">
                    <div class="half">
                        <div class="input-label"><?php echo isset($enter_name) ? esc_html($enter_name) : ''; ?></div>
                        <input type="text" id="name" name="name" required
                               placeholder="<?php echo isset($enter_name) ? esc_html($enter_name) : ''; ?>">
                    </div>
                    <div class="half">
                        <div class="input-label"><?php echo isset($enter_email) ? esc_html($enter_email) : ''; ?></div>
                        <input type="email" id="email" name="email"
                               placeholder="<?php echo isset($enter_email) ? esc_html($enter_email) : ''; ?>">
                    </div>
                    <div class="half">
                        <div class="input-label"><?php echo isset($enter_phone) ? esc_html($enter_phone) : ''; ?></div>
                        <input type="tel" id="phone" name="phone"
                               placeholder="<?php echo isset($enter_phone) ? esc_html($enter_phone) : ''; ?>">
                    </div>
                    <div class="half">
                        <div class="input-label"><?php echo isset($zip_code) ? esc_html($zip_code) : ''; ?></div>
                        <input type="text" id="zipcode" name="zipcode" required
                               placeholder="<?php echo isset($zip_code) ? esc_html($zip_code) : ''; ?>">
                    </div>
                    <div class="half">
                        <div class="input-label"><?php echo isset($reply_day) ? esc_html($reply_day) : ''; ?></div>
                        <select name="day" id="day">
                            <option value=""><?php echo isset($reply_day) ? esc_html($reply_day) : ''; ?></option>
                            <option value="<?php echo isset($week_days) ? esc_html($week_days) : ''; ?>"><?php echo isset($week_days) ? esc_html($week_days) : ''; ?></option>
                            <option value="<?php echo isset($week_sunday) ? esc_html($week_sunday) : ''; ?>"><?php echo isset($week_sunday) ? esc_html($week_sunday) : ''; ?></option>
                            <option value="<?php echo isset($week_monday) ? esc_html($week_monday) : ''; ?>"><?php echo isset($week_monday) ? esc_html($week_monday) : ''; ?></option>
                            <option value="<?php echo isset($week_tuesday) ? esc_html($week_tuesday) : ''; ?>"><?php echo isset($week_tuesday) ? esc_html($week_tuesday) : ''; ?></option>
                            <option value="<?php echo isset($week_wednesday) ? esc_html($week_wednesday) : ''; ?>"><?php echo isset($week_wednesday) ? esc_html($week_wednesday) : ''; ?></option>
                            <option value="<?php echo isset($week_thursday) ? esc_html($week_thursday) : ''; ?>"><?php echo isset($week_thursday) ? esc_html($week_thursday) : ''; ?></option>
                            <option value="<?php echo isset($week_friday) ? esc_html($week_friday) : ''; ?>"><?php echo isset($week_friday) ? esc_html($week_friday) : ''; ?></option>
                            <option value="<?php echo isset($week_saturday) ? esc_html($week_saturday) : ''; ?>"><?php echo isset($week_saturday) ? esc_html($week_saturday) : ''; ?></option>
                        </select>
                    </div>
                    <div class="half">
                        <div class="input-label"><?php echo isset($reply_time) ? esc_html($reply_time) : ''; ?></div>
                        <select name="time" id="time">
                            <option value=""><?php echo isset($reply_time) ? esc_html($reply_time) : ''; ?></option>
                            <option value="<?php echo isset($week_days) ? esc_html($week_days) : ''; ?>"><?php echo isset($week_days) ? esc_html($week_days) : ''; ?></option>
                            <option value="12:00 am">12:00 am</option>
                            <option value="1:00 am">1:00 am</option>
                            <option value="2:00 am">2:00 am</option>
                            <option value="3:00 am">3:00 am</option>
                            <option value="4:00 am">4:00 am</option>
                            <option value="5:00 am">5:00 am</option>
                            <option value="6:00 am">6:00 am</option>
                            <option value="7:00 am">7:00 am</option>
                            <option value="8:00 am">8:00 am</option>
                            <option value="9:00 am">9:00 am</option>
                            <option value="10:00 am">10:00 am</option>
                            <option value="11:00 am">11:00 am</option>
                            <option value="12:00 pm">12:00 pm</option>
                            <option value="1:00 pm">1:00 pm</option>
                            <option value="2:00 pm">2:00 pm</option>
                            <option value="3:00  pm">3:00 pm</option>
                            <option value="4:00 pm">4:00 pm</option>
                            <option value="5:00 pm">5:00 pm</option>
                            <option value="6:00 pm">6:00 pm</option>
                            <option value="7:00 pm">7:00 pm</option>
                            <option value="8:00 pm">8:00 pm</option>
                            <option value="9:00 pm">9:00 pm</option>
                            <option value="10:00 pm">10:00 pm</option>
                            <option value="11:00 pm">11:00 pm</option>
                        </select>
                    </div>
                    <div class="text-area">
                        <div class="input-label"><?php echo isset($message_label) ? esc_html($message_label) : ''; ?></div>
                        <textarea id="message"
                                  name="message"
                                  rows="1"
                                  maxlength="2000"
                                  required
                                  placeholder="<?php echo isset($message_label) ? esc_html($message_label) : ''; ?>">
                    </textarea>
                    </div>
                    <div class="g-recaptcha recaptcha" data-sitekey="<?php echo isset($fields_site) ? esc_html($fields_site) : ''; ?>"></div>
                    <div class="taxdome__button">
                        <input type="submit"
                               name="submit"
                               value="<?php echo isset($send_message_label) ? esc_html($send_message_label) : ''; ?>"
                               class="btn btn-lg btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="<?php esc_url(home_url());?>/wp-content/themes/advisors/sources/js/jquery-3.6.4.min.js"></script>
<script>
    jQuery(document).ready(function ($) {

        $('#contactForm').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize()

            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: formData,
                success: function (response) {

                    alert('Message successfully received');
                    $('#contactForm')[0].reset();
                },
                error: function (error) {

                    alert('Error');
                    console.log(error);
                }
            });
        });
    });
</script>
<style>
    .footer:before {
        display: none;
    }
</style>
<?php get_footer(); ?>


