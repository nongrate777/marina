<?php
/**
* Template Name: Single User Profile
*/
get_header();
the_content();
global $wpdb;
/**
 * Users fields
 */
$user_id            = get_query_var('user_id');
$user               = get_user_by('ID', $user_id);
$field              = get_field('integrations', 'options');
$map_apikey         = $field['google_map_apikey'];
$industry           = get_field('industry', 'user_' . $user_id);
$work_remotely      = get_field('work_remotely', 'user_' . $user_id);
$company_name       = get_field('company_name', 'user_' . $user_id);
$visit_website      = get_field('visit_website', 'user_' . $user_id);
$appointment        = get_field('appointment', 'user_' . $user_id);
$phone_number       = get_field('phone_number', 'user_' . $user_id);
$location           = get_field('location', 'user_' . $user_id);
$location_country   = get_field('location_country', 'user_' . $user_id);
$location_state     = get_field('location_state', 'user_' . $user_id);
$location_city      = get_field('location_city', 'user_' . $user_id);
$location_address   = get_field('location_address', 'user_' . $user_id);
$location_zipcode   = get_field('location_zipcode', 'user_' . $user_id);
$photo              = get_field('photo', 'user_' . $user_id);
$about_me           = get_field('about_me', 'user_' . $user_id);
$slogan             = get_field('slogan', 'user_' . $user_id);
$year_established   = get_field('year_established', 'user_' . $user_id);
$hours_of_operation = get_field('hours_of_operation', 'user_' . $user_id);
$payments           = get_field('payments', 'user_' . $user_id);
$credentials        = get_field('credentials', 'user_' . $user_id);
$awards             = get_field('awards', 'user_' . $user_id);
$industry_more      = get_field('industry_more', 'user_' . $user_id);
$certificate        = get_field('certificate', 'user_' . $user_id);
$field_vimeo        = get_field('vimeo', 'user_' . $user_id);
$field_youtube      = get_field('youtube', 'user_' . $user_id);
/**
 * reCAPTCHA fields for contact form
 */
$fields = get_field('integrations', 'options');
$fields_site = $fields['google_recaptcha_site_key'];
$fields_secret = $fields['google_recaptcha_secret_key'];
/**
 * Checking the correctness of the user id
 */
$user_id_raw = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$user_id = sanitize_text_field($user_id_raw);

$user_exists = get_user_by('ID', $user_id);

if (!$user_exists || !is_numeric($user_id)) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    include get_template_directory() . '/404.php';
    exit;
}
/**
* Default content fields
*/
$appointment_label  = get_field('appointment');
$website_label      = get_field('website');
$phone_label        = get_field('phone_number');
$about_label        = get_field('about');
$connection_label   = get_field('make_a_connection');
$connection_label2  = get_field('is_accepting_messages');
$send_message       = get_field('send_message');
$location_label     = get_field('location_label');
$established_label  = get_field('established');
$company_label      = get_field('company');
$contact_label      = get_field('contact');
$share_label        = get_field('share');
$tags_label         = get_field('tags_label');
$review             = get_field('review');
$mob_contact        = get_field('mob_contact');
$mob_share          = get_field('mob_share');
$mob_tags           = get_field('mob_tags');
$mob_contact_url    = get_field('mob_contact_url');
$mob_share_url      = get_field('mob_share_url');
$mob_tags_url       = get_field('mob_tags_url');
$back               = get_field('back');
$company_name_label = get_field('company_name');
$work_label         = get_field('work_remotely');
$information_label  = get_field('contact_information');
$hours_label        = get_field('hours_label');
$industry_label     = get_field('industry_label');
$credentials_label  = get_field('credentials_label');
$awards_label       = get_field('awards_label');
$payments_label     = get_field('payments_label');

/**
* Default fields for contact form in sidebar
*/
$enter_name         = get_field('enter_name');
$enter_email        = get_field('enter_email');
$enter_phone        = get_field('enter_phone');
$reply_day          = get_field('reply_day');
$reply_time         = get_field('reply_time');
$zip_code           = get_field('zip_code');
$message_label      = get_field('message');
$send_message_label = get_field('send_message');
$week_days          = get_field('week_days');
$week_sunday        = get_field('sunday');
$week_monday        = get_field('monday');
$week_tuesday       = get_field('tuesday');
$week_wednesday     = get_field('wednesday');
$week_thursday      = get_field('thursday');
$week_friday        = get_field('friday');
$week_saturday      = get_field('saturday');

/**
* Location for Google API
*/
$locations_google  = $location_country . ', ' . $location_state . ', ' . $location_city . ', ' . $location_address . ', ' . $location_zipcode;
$locations         = [$location_country, $location_state, $location_city, $location_address, $location_zipcode];

$tags = $wpdb->get_results("SELECT DISTINCT meta_value FROM wp_usermeta WHERE meta_key = 'industry'", ARRAY_A);
?>
<section class="contact-form__breadcumbs">
    <div class="container">
        <div class="breadcrumbs profiles">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            <span class="current"> / Profile details page</span>
        </div>
    </div>
</section>
<section class="profileinner">
    <h1>
        <?php if (!empty($company_name)) {
            echo esc_html($company_name);
        } ?>
    </h1>
    <div class="container">
        <!--<div class="profileinner__breadcumbs">
            <?php
/*            $breadcumbs_country = $breadcumbs_state = $breadcumbs_city = $breadcumbs_industry = '';
            if(!empty($location_country)) {
                $breadcumbs_country = $location_country . ' / ';
            }
            if(!empty($location_state)) {
                $breadcumbs_state = $location_state . ' / ';
            }
            if(!empty($location_city)) {
                $breadcumbs_city = $location_city . ' / ';
            }
            if(!empty($industry)) {
                $breadcumbs_industry = $industry . ' / ';
            }
            $breadcumbs_user = '<a href="' . esc_url(home_url()) . '">Home</a> / ' . $breadcumbs_country . $breadcumbs_state . $breadcumbs_city . $breadcumbs_industry . esc_html($company_name);
            echo $breadcumbs_user;
            */?>
        </div>-->
        <?php
        /**
         * if user exists
         */
        if ($user) { ?>
            <div class="profileinner__sidebar">
                <div class="profileinner__sidebar-member order1">
                    <div class="profileinner__sidebar-member-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="240" height="240" viewBox="-11 50 327.846 318.144">
                            <defs>
                                <style>
                                    .a {
                                        fill: none;
                                        stroke-width: 15px;
                                        stroke: rgba(255, 255, 255, 1);
                                        object-fit: cover;
                                        stroke-linejoin: round;

                                    }
                                </style>
                                <clipPath id="image">
                                    <path transform="translate(80) scale(1.4) rotate(30)" d="M172.871,0a28.906,28.906,0,0,1,25.009,14.412L245.805,97.1a28.906,28.906,0,0,1,0,28.989L197.88,208.784A28.906,28.906,0,0,1,172.871,223.2H76.831a28.906,28.906,0,0,1-25.009-14.412L3.9,126.092A28.906,28.906,0,0,1,3.9,97.1L51.821,14.412A28.906,28.906,0,0,1,76.831,0Z"></path>
                                </clipPath>
                            </defs>
                            <image clip-path="url(#image)" width="140%" height="140%" x="-25%" y="-5%" xlink:href="<?php echo esc_url($photo['url']); ?>" preserveAspectRatio="xMidYMid meet" style="object-fit: cover;"></image>
                            <path class="a" d="M172.871,0a28.906,28.906,0,0,1,25.009,14.412L245.805,97.1a28.906,28.906,0,0,1,0,28.989L197.88,208.784A28.906,28.906,0,0,1,172.871,223.2H76.831a28.906,28.906,0,0,1-25.009-14.412L3.9,126.092A28.906,28.906,0,0,1,3.9,97.1L51.821,14.412A28.906,28.906,0,0,1,76.831,0Z" transform="translate(80) scale(1.4) rotate(30)"></path>
                        </svg>
                    </div>
                    <div class="profileinner__sidebar-member-content">
                        <?php
                        /**
                         * Remote badge
                         */
                        if (!empty($work_remotely)) { ?>
                            <div class="profile__single-content-work <?php echo esc_attr(str_replace([' ', '&'], ['_', ''], strtolower($work_remotely))); ?>">
                                <div class="icon-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-check">
                                        <path fill="currentColor" d="M473 80L191 362l-124-124c-9-9-24-9-33 0s-9 24 0 33l145 145c9 9 24 9 33 0l312-312c9-9 9-24 0-33s-24-9-33 0z"></path>
                                    </svg>
                                </div>
                                <?php echo esc_html($work_remotely); ?>
                            </div>
                        <?php }
                        /**
                         * Industry
                         */
                        if (!empty($industry)) { ?>
                            <div class="profileinner__single-content-industry">
                                <?php echo esc_html($industry); ?>
                            </div>
                        <?php }
                        /**
                         * Location
                         */
                        if (!empty($locations)) { ?>
                            <div class="profileinner__single-content-location">
                                <?php if(!empty($location_country)) { echo $location_country; }
                                if(!empty($location_state)) { echo ', ' . $location_state; }
                                if(!empty($location_city)) { echo ', ' . $location_city; } ?>
                                <?php /*echo esc_html(implode(', ', array_diff($locations, ['']))); */?>
                            </div>
                        <?php } ?>
                        <div class="profileinner__single-content-more">
                            <div class="view-profile taxdome__button-light">
                                <a href="/search_results"
                                   tabindex="0"
                                   aria-label="<?php echo esc_html($back); ?>">
                                    <?php echo esc_html($back); ?>
                                </a>
                            </div>
                            <div class="view-profile taxdome__button-light">
                                <?php
                                $review_url = home_url('/send-review/?user_id=') . $user_id;
                                ?>
                                <a href="<?php echo esc_html($review_url); ?>"
                                   tabindex="0"
                                   aria-label="<?php echo esc_html($review); ?>">
                                    <?php echo esc_html($review); ?>
                                </a>
                            </div>
                            <?php
                            /**
                             * Mobile buttons
                             */
                            if (wp_is_mobile()) { ?>
                            <div class="profileinner__single-content-more for-mobile">
                                <div class="view-profile taxdome__button-light">
                                    <a href="<?php echo esc_html($mob_contact_url); ?>"
                                       tabindex="0"
                                       aria-label="<?php echo esc_html($mob_contact); ?>">
                                        <?php echo esc_html($mob_contact); ?>
                                    </a>
                                </div>
                                <div class="view-profile taxdome__button-light one-half">
                                    <a href="<?php echo esc_html($mob_tags_url); ?>"
                                       tabindex="0"
                                       aria-label="<?php echo esc_html($mob_tags); ?>">
                                        <?php echo esc_html($mob_tags); ?>
                                    </a>
                                </div>
                                <div class="view-profile taxdome__button-light one-half">
                                    <a href="<?php echo esc_html($mob_share_url); ?>"
                                       tabindex="0"
                                       aria-label="<?php echo esc_html($mob_share); ?>">
                                        <?php echo esc_html($mob_share); ?>
                                    </a>
                                </div>
                            </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="profileinner__sidebar-contact order2" id="contacts">
                    <?php
                    /**
                     * Contacts
                     */
                    /**
                     * CSRF Token
                     */
                    wp_nonce_field('csrf_action', 'csrf_token');

                    if (!empty($contact_label)) { ?>
                        <div class="profileinner__sidebar-contact-title">
                            <?php echo esc_html($contact_label) . ' ' . esc_html($company_name); ?>
                        </div>
                    <?php } ?>
                    <div class="profileinner__sidebar-contact-form">
                        <form id="contactForm" autocomplete="off" action="<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>" method="post">
                            <?php wp_nonce_field('contact_form_nonce', 'contact_form_nonce'); ?>
                            <input type="hidden" name="action" value="process_contact_form">
                            <label><?php echo isset($enter_name) ? esc_html($enter_name) : ''; ?></label>
                            <input type="text" id="name" name="name" required placeholder="<?php echo isset($enter_name) ? esc_html($enter_name) : ''; ?>">
                            <label><?php echo isset($enter_email) ? esc_html($enter_email) : ''; ?></label>
                            <input type="email" id="email" name="email" required placeholder="<?php echo isset($enter_email) ? esc_html($enter_email) : ''; ?>">
                            <label><?php echo isset($enter_phone) ? esc_html($enter_phone) : ''; ?></label>
                            <input type="tel" id="phone" name="phone" placeholder="<?php echo isset($enter_phone) ? esc_html($enter_phone) : ''; ?>">
                            <label><?php echo isset($reply_day) ? esc_html($reply_day) : ''; ?></label>
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
                            <label><?php echo isset($reply_time) ? esc_html($reply_time) : ''; ?></label>
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
                                <option value="3:00  pm">3:00  pm</option>
                                <option value="4:00 pm">4:00 pm</option>
                                <option value="5:00 pm">5:00 pm</option>
                                <option value="6:00 pm">6:00 pm</option>
                                <option value="7:00 pm">7:00 pm</option>
                                <option value="8:00 pm">8:00 pm</option>
                                <option value="9:00 pm">9:00 pm</option>
                                <option value="10:00 pm">10:00 pm</option>
                                <option value="11:00 pm">11:00 pm</option>
                            </select>
                            <label><?php echo isset($zip_code) ? esc_html($zip_code) : ''; ?></label>
                            <input type="text" id="zipcode" name="zipcode" required placeholder="<?php echo isset($zip_code) ? esc_html($zip_code) : ''; ?>">
                            <label><?php echo isset($message_label) ? esc_html($message_label) : ''; ?></label>
                            <textarea id="message" name="message" rows="4" cols="50" required maxlength="2000" placeholder="<?php echo isset($message_label) ? esc_html($message_label) : ''; ?>"></textarea>
                            <!--<div class="g-recaptcha recaptcha" data-sitekey="<?php /*echo isset($fields_site) ? esc_html($fields_site) : ''; */?>"></div>-->
                            <div class="taxdome__button">
                                <input type="submit" name="submit" value="<?php echo isset($send_message_label) ? esc_html($send_message_label) : ''; ?>" class="btn btn-lg btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="profileinner__sidebar-contact order3" id="share">
                    <?php
                    /**
                     * Share
                     */
                    if (!empty($share_label)) { ?>
                        <div class="profileinner__sidebar-contact-title">
                            <?php echo esc_html($share_label); ?>
                        </div>
                    <?php } ?>
                    <div class="profileinner__sidebar-contact-share">
                        <div class="soclinks">
                            <div class="soclinks-fb">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer"></a>
                            </div>
                            <div class="soclinks-x">
                            </div>
                            <div class="soclinks-in">
                                <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profileinner__sidebar-contact order4" id="socials">
                    <?php
                    /**
                     * Industry block
                     */
                    if (!empty($tags_label)) { ?>
                        <div class="profileinner__sidebar-contact-title">
                            <?php echo esc_html($tags_label); ?>
                        </div>
                    <?php } ?>
                    <?php
                    if (!empty($tags)) { ?>
                        <div class="profileinner__sidebar-contact-taxonomy">
                            <?php foreach ($tags as $tag) { ?>
                                <div class="sep">
                                    <a href="/search_results/?service=<?= $tag['meta_value']; ?>"
                                       tabindex="0"
                                       aria-label="<?= $tag['meta_value']; ?>">
                                        <?= $tag['meta_value']; ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="profileinner__main">
                <div class="profileinner__single">
                    <?php
                    /**
                     * Badges
                     */
                    if(!empty($certificate)) { ?>
                        <div class="profileinner__single-certificate"></div>
                    <?php } ?>
                    <div class="profileinner__more">
                        <div class="profileinner__connection">
                            <img loading="lazy"
                                 alt="<?php bloginfo('name') ?>"
                                 decoding="async"
                                 width="24"
                                 height="24"
                                 src="data:image/jpg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4RDoRXhpZgAATU0AKgAAAAgABAE7AAIAAAAKAAAISodpAAQAAAABAAAIVJydAAEAAAAUAAAQzOocAAcAAAgMAAAAPgAAAAAc6gAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGlsaXl1c2hpbgAABZADAAIAAAAUAAAQopAEAAIAAAAUAAAQtpKRAAIAAAADMzAAAJKSAAIAAAADMzAAAOocAAcAAAgMAAAIlgAAAAAc6gAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADIwMjM6MTE6MjYgMTY6NTI6NDMAMjAyMzoxMToyNiAxNjo1Mjo0MwAAAGkAbABpAHkAdQBzAGgAaQBuAAAA/+ELHGh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8APD94cGFja2V0IGJlZ2luPSfvu78nIGlkPSdXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQnPz4NCjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iPjxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+PHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9InV1aWQ6ZmFmNWJkZDUtYmEzZC0xMWRhLWFkMzEtZDMzZDc1MTgyZjFiIiB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iLz48cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0idXVpZDpmYWY1YmRkNS1iYTNkLTExZGEtYWQzMS1kMzNkNzUxODJmMWIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyI+PHhtcDpDcmVhdGVEYXRlPjIwMjMtMTEtMjZUMTY6NTI6NDMuMzAwPC94bXA6Q3JlYXRlRGF0ZT48L3JkZjpEZXNjcmlwdGlvbj48cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0idXVpZDpmYWY1YmRkNS1iYTNkLTExZGEtYWQzMS1kMzNkNzUxODJmMWIiIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyI+PGRjOmNyZWF0b3I+PHJkZjpTZXEgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj48cmRmOmxpPmlsaXl1c2hpbjwvcmRmOmxpPjwvcmRmOlNlcT4NCgkJCTwvZGM6Y3JlYXRvcj48L3JkZjpEZXNjcmlwdGlvbj48L3JkZjpSREY+PC94OnhtcG1ldGE+DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgIDw/eHBhY2tldCBlbmQ9J3cnPz7/2wBDAAcFBQYFBAcGBQYIBwcIChELCgkJChUPEAwRGBUaGRgVGBcbHichGx0lHRcYIi4iJSgpKywrGiAvMy8qMicqKyr/2wBDAQcICAoJChQLCxQqHBgcKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKir/wAARCAAkACsDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD6E1jWdP0DS5tR1i6jtLSEZeSQ/oB1JPYDk15+nxO8SeIcv4F8D3d9Z/wXt/MtuknuoPBHuG/Co/GVtF4m+NPh3w5q/wA+lW9m9/8AZm+7cSgsACO+AucemfWvUFVUQKihVUYAAwAKS1V2N6Ox5mfGvxI0lDNrvw+W5t1PzNpt4ruB6hAWJ4+ldX4Q8daJ41s5JdHmZZoTie0nXZNCf9pf6jIroq8t8f2cPh74k+EvEWkIIb/UL8WF2kfH2mJ8Alh3I9fp6CqW6T6iezaPUqK4jSfiPbXXxL1XwbfokNzbuDZyqeJ12Bip9GGT9QO2Oe3pdE+4dWuxxnxD8INr1nbaxpmoLpWs6MWntL1zhFGMsr/7Jx749xkVx3hz9oLT7jSV/t/Tbp9QRiso0yLzE2AD94QxG0EnGMnp716prmh2PiPSJdM1VJJLSYjzI45Wj3gHOCVIOPaotC8M6N4Zsza6Bp0FjG33jEvzN7sxyWP1JoWl10G9bHDf8Lts9QQx+GvC2v6rd/wxi1CLn/aYFiB74rDv7u60LUl8efFSaCK/gRl0XQLeQN5ZPc88n1bkDr1wo63xT4d+Il2zjwz4xtYIWyBHcWao4H/XRVbP1CivJPEHwL8eywzaneX9rrV9n5kW6d5XHqGkVc49M/Spv1H5Mw/h02qeLfjVY6l8zXD3jXty6jhEBy30H8I+oFfWleW/AuwttM8N3NnPoN1pWtQuBevdQOrTgk7GUsOmOMDoRnvmvUq0doxUVsZq7k5PcKKKKkoKKKKACiiigD//2Q==" />
                            <?php
                            /**
                             * Connections
                             */
                            if(!empty($connection_label) && !empty($connection_label2) && !empty($send_message)) {
                                $message_url = home_url('/contact-user/?user_id=') . $user_id;
                                $message_text = '<b>' . $connection_label . '</b> ' . $company_name . ' ' . $connection_label2 . ': ' . '<a href="' . $message_url . '">' . $send_message . '</a>';
                                echo $message_text;
                            }
                            ?>
                        </div>
                        <?php
                        /**
                         * Slogan
                         */
                        if (!empty($slogan)) { ?>
                            <div class="profileinner__more-slogan">
                                <?php echo esc_html($slogan); ?>
                            </div>
                        <?php }
                        /**
                         * About
                         */
                        if (!empty($about_label && !empty($about_me))) { ?>
                            <div class="profileinner__more-about">
                                <?php echo esc_html($about_label) . ' ' . esc_html($company_name); ?>
                            </div>
                        <?php }
                        if (!empty($about_me)) { ?>
                            <div class="profileinner__more-aboutme">
                                <?php echo $about_me; ?>
                            </div>
                        <?php }
                        /**
                         * Video Frame : Vimeo
                         */
                        if(!empty($field_vimeo)) { ?>
                            <div class="profileinner__more-vimeo">
                                <iframe src = "https://player.vimeo.com/video/<?php echo $field_vimeo; ?>"
                                        width="640"
                                        height="360"
                                        allow="autoplay; fullscreen; picture-in-picture"
                                        frameborder="0"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        <?php
                        }
                        /**
                         * Video Frame : Youtube
                         */
                        if(!empty($field_youtube)){ ?>
                             <div class="profileinner__more-youtube">
                                 <iframe width="560"
                                         height="315"
                                         src="https://www.youtube.com/embed/<?php echo $field_youtube; ?>"
                                         title="YouTube video player"
                                         frameborder="0"
                                         allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                         allowfullscreen>
                                 </iframe>
                             </div>
                        <?php }
                        /**
                         * Details
                         */
                        if (!empty($year_established) || !empty($hours_of_operation) || !empty($hours_of_operation) || !empty($payments) || !empty($credentials) || !empty($awards)) { ?>
                            <div class="profileinner__more-company">
                                <?php echo esc_html($company_label); ?>
                            </div>
                        <?php }
                         if (!empty($established_label) && !empty($year_established)) { ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label">
                                    <?php echo esc_html($established_label); ?>
                                </span>
                                <?php echo esc_html($year_established); ?>
                            </div>
                        <?php }
                        /**
                         * Hours
                         */
                         if (!empty($hours_label) && !empty($hours_of_operation)) { ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label">
                                    <?php echo esc_html($hours_label); ?>
                                </span>
                                <?php echo esc_html($hours_of_operation); ?>
                            </div>
                        <?php }
                        /**
                         * Payment
                         */
                        if (!empty($payments_label) && !empty($payments)) {
                            ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label">
                                    <?php echo esc_html($payments_label); ?>
                                </span>
                                <?php echo esc_html($payments); ?>
                            </div>
                        <?php }
                        /**
                         * Credentials
                         */
                        if (!empty($credentials_label) && !empty($credentials)) {
                            ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label">
                                    <?php echo esc_html($credentials_label); ?>
                                </span>
                                <?php echo esc_html($credentials); ?>
                            </div>
                        <?php }
                        /**
                         * Awards
                         */
                        if (!empty($awards_label) && !empty($awards)) {
                            ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label">
                                    <?php echo esc_html($awards_label); ?>
                                </span>
                                <?php echo esc_html($awards); ?>
                            </div>
                        <?php }
                        /**
                         * Additionals
                         */
                        if (!empty($information_label)) { ?>
                            <div class="profileinner__more-information">
                                <?php echo esc_html($information_label); ?>
                            </div>
                        <?php }
                        /**
                         * Industry
                         */
                        if (!empty($industry_label) && !empty($industry_more)) { ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label">
                                    <?php echo esc_html($industry_label); ?>
                                </span>
                                <?php echo $industry_more; ?>
                            </div>
                        <?php }
                        /**
                         * Work status
                         */
                        if (!empty($work_label) && !empty($work_remotely)) {
                            ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label">
                                    <?php echo esc_html($work_label); ?>
                                </span>
                                <?php echo $work_remotely; ?>
                            </div>
                        <?php }
                        if (!empty($company_name_label) && !empty($company_name)) {
                            ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label"><?php echo esc_html($company_name_label); ?></span>
                                <?php echo $company_name; ?>
                            </div>
                        <?php }
                        /**
                         * Website
                         */
                        if (!empty($website_label) && !empty($visit_website)) {
                            ?>
                            <div class="profileinner__more-website">
                                <span class="table-label">
                                    <?php echo esc_html($website_label); ?>
                                </span>
                                <a href="<?php echo esc_html($visit_website); ?>"
                                   target="_blank"
                                   rel="nofollow noopener noreferrer"
                                   tabindex="0"
                                   aria-label="<?php echo esc_html($visit_website); ?>">
                                    <?php echo esc_html($visit_website); ?>
                                </a>
                            </div>
                        <?php }
                        /**
                         * Appointment
                         */
                        if (!empty($appointment_label) && !empty($appointment)) { ?>
                            <div class="profileinner__more-appointment">
                                <span class="table-label">
                                    <?php echo esc_html($appointment_label); ?>
                                </span>
                                <a href="<?php echo esc_html($appointment); ?>"
                                   target="_blank"
                                   rel="nofollow noopener noreferrer"
                                   tabindex="0"
                                   aria-label="<?php echo esc_html($appointment); ?>">
                                    <?php echo esc_html($appointment); ?>
                                </a>
                            </div>
                        <?php }
                        /**
                         * Phone
                         */
                        if (!empty($phone_label) && !empty($phone_number)) {?>
                            <div class="profileinner__more-phone">
                                <span class="table-label">
                                    <?php echo esc_html($phone_label); ?>
                                </span>
                                <span class="phone-number" onclick="togglePhoneNumber(this)">
                                     <span class="show-number">
                                         Show phone number
                                     </span>
                                     <span class="actual-number"><?php echo esc_html($phone_number); ?></span>
                                </span>
                            </div>
                        <?php }
                        /**
                         * Location
                         */
                        if (!empty($locations) && !empty($location_label)) { ?>
                            <div class="profileinner__more-location">
                                <span class="table-label"><?php echo esc_html($location_label); ?></span>
                                <?php echo esc_html(implode(', ', array_diff($locations, ['']))); ?>
                            </div>
                            <div class="profileinner__more-map" id="map"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <p>User not found</p>
        <?php } ?>
    </div>
</section>
<?php
echo '<script>';
echo 'document.title = "' . esc_html($company_name) . '\'s profile - taxdome.com";';
echo '</script>';
get_footer();
?>
<script>
    function initMap() {
        var geocoder = new google.maps.Geocoder();
        var address = "<?php echo esc_js($location); ?>";
        var mapOptions = {
            zoom: 12,
            center: {lat: 0, lng: 0}
        };
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        geocoder.geocode({'address': address}, function (results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                console.error('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($map_apikey); ?>&callback=initMap"></script>
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
<script>
    function togglePhoneNumber(element) {
        var showNumber = element.querySelector('.show-number');
        var actualNumber = element.querySelector('.actual-number');

        if (showNumber.style.display !== 'none') {
            showNumber.style.display = 'none';
            actualNumber.style.display = 'inline';
        } else {
            showNumber.style.display = 'inline';
            actualNumber.style.display = 'none';
        }
    }
</script>
<style>
    @media screen and (max-width: 991.98px) {
        .footer:before {
            display: none;
        }
    }
</style>
