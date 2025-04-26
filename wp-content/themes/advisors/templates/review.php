<?php
/**
 * Template Name: Review for user
 */
$user_id             = get_query_var('user_id');
$user                = get_user_by('ID', $user_id);
$photo               = get_field('photo', 'user_' . $user_id);
$profile_url         = home_url('/single-users-profile/?user_id=') . $user_id;
$company_name        = get_field('company_name', 'user_' . $user_id);
$back_button         = get_field('back_button');
$share_label         = get_field('share');
/**
 * Default fields for sending form
 */
$enter_your_name     = get_field('enter_your_name');
$enter_email_address = get_field('enter_email_address');
$enter_your_review   = get_field('enter_your_review');
$enter_title         = get_field('enter_title');
$send_message_label  = get_field('send_message_label');
$contact_label       = get_field('contact');
/**
 * reCAPTCHA fields for contact form
 */
$fields = get_field('integrations', 'options');
$fields_site = $fields['google_recaptcha_site_key'];
$fields_secret = $fields['google_recaptcha_secret_key'];
/**
 * Header
 */
get_header();
?>
    <section class="send-review">
        <div class="container">
            <div class="send-review__sidebar">
                <?php
                /**
                 * Image
                 */
                if (!empty($photo)) { ?>
                    <img loading="lazy"
                         alt="<?php echo esc_html($contact_label) . ' ' . esc_html($user->display_name); ?>"
                         src="<?php echo esc_url($photo['url']); ?>"
                         decoding="async"
                         width="215"
                         height="215">
                <?php }
                /**
                 * Back
                 */
                if (!empty($back_button)) { ?>
                    <div class="send-review__sidebar-back taxdome__button">
                        <a href="<?php echo esc_url($profile_url); ?>"
                           tabindex="0"
                           aria-label="<?php echo esc_html($back_button); ?>">
                            <?php echo esc_html($back_button); ?>
                        </a>
                    </div>
                <?php } ?>
                <div class="send-review__sidebar-contact">
                    <?php
                    /**
                     * Share
                     */
                    if (!empty($share_label)) { ?>
                        <div class="send-review__sidebar-contact-title">
                            <?php echo esc_html($share_label); ?>
                        </div>
                    <?php } ?>
                    <div class="send-review__sidebar-contact-share">
                        <div class="soclinks">
                            <div class="soclinks-fb">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">Share</a>
                            </div>
                            <div class="soclinks-x">
                                Post
                            </div>
                            <div class="soclinks-in">
                                <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">Share</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="send-review__content">
                <h3>
                    <a href="<?php echo esc_url($profile_url); ?>"
                       tabindex="0"
                       aria-label="<?php echo esc_html($company_name); ?>">
                        <?php echo esc_html($company_name); ?>
                    </a>
                </h3>
                <div class="send-review__sidebar-contact-form form-inner">
                    <form id="contactForm" action="" method="post">
                        <?php if (!empty($enter_title)) { ?>
                            <input type="text" name="review_title" placeholder="<?php echo esc_attr($enter_title); ?>">
                        <?php }
                        if (!empty($enter_your_review)) { ?>
                            <textarea name="review" maxlength="2000" placeholder="<?php echo esc_attr($enter_your_review); ?>"></textarea>
                        <?php }
                        if (!empty($enter_your_name)) { ?>
                            <input type="text" name="name_or_company" placeholder="<?php echo esc_attr($enter_your_name); ?>">
                        <?php }
                        if (!empty($enter_email_address)) { ?>
                            <input type="email" name="email" placeholder="<?php echo esc_attr($enter_email_address); ?>">
                        <?php }
                        if (!empty($enter_email_address)) { ?>
                            <div class="g-recaptcha recaptcha" data-sitekey="<?php echo isset($fields_site) ? esc_html($fields_site) : ''; ?>"></div>
                        <div class="taxdome__button">
                            <button type="submit" ><?php echo esc_html($send_message_label); ?></button>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $('#contactForm').submit(function (e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {
                        action: 'submit_review',
                        user_id: <?php echo esc_js($user_id); ?>,
                        review_title: $('#review_title').val(),
                        review: $('#review').val(),
                        name_or_company: $('#name_or_company').val(),
                        email: $('#email').val(),
                    },
                    success: function (response) {
                        alert(response.data);
                        $('#contactForm')[0].reset();
                    },
                    error: function (error) {
                        alert('Error submitting review');
                        console.log(error);
                    },
                });
            });
        });
    </script>
<?php
get_footer();
