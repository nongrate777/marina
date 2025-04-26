<?php
/**
 * Block: Contacts
 */
$fields          = get_fields();
$fields_title    = $fields['title'];
$fields_desc     = $fields['description'];
$fields_subtitle = $fields['subtitle'];
/**
 * CSRF Token
 */
wp_nonce_field('csrf_action', 'csrf_token');
?>
<section class="contacts">
    <div class="container">
        <?php
        /**
         * Headline
         */
        if (!empty($fields_title)) { ?>
            <h1>
                <?php echo wp_kses_post($fields_title); ?>
            </h1>
        <?php }
        /**
         * Sub Headline
         */
        if (!empty($fields_subtitle)) { ?>
            <div class="contacts__subtitle">
                <?php echo wp_kses_post($fields_subtitle); ?>
            </div>
        <?php }
        /**
         * Description
         */
        if (!empty($fields_desc)) { ?>
            <div class="contacts__description">
                <?php echo wp_kses_post($fields_desc); ?>
            </div>
        <?php } ?>
        <div class="contacts__form">
            <?php
            /**
             * Form
             */
            echo do_shortcode('[contact-form-7 id="' . get_field('form_id') . '"]'); ?>
        </div>
    </div>
</section>
