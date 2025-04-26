<?php
/**
 * Block: Banner
 */
$fields = get_fields();
$fields_title  = isset( $fields['title'] )           ? $fields['title']           : '';
$fields_desc   = isset( $fields['description'] )     ? $fields['description']     : '';
$fields_desc2  = isset( $fields['description_two'] ) ? $fields['description_two'] : '';
$fields_button = isset( $fields['button_text'] )     ? $fields['button_text']     : '';
$fields_link   = isset( $fields['button_link'] )     ? $fields['button_link']     : '';
?>
<section class="banner">
    <div class="container">
        <div class="banner__main">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png">
            <?php
            /**
             * Headline
             */
            if (!empty($fields_title)) { ?>
                <h1><?php echo wp_kses_post($fields_title); ?></h1>
            <?php }
            /**
             * Description
             */
            if (!empty($fields_desc)) { ?>
                <p><?php echo wp_kses_post($fields_desc); ?></p>
            <?php }
            if (!empty($fields_desc2)) { ?>
                <div class="banner__main-description"><?php echo wp_kses_post($fields_desc2); ?></div>
            <?php }
            ?>
        </div>
        <?php
        /**
         * Video
         */
        ?>
        <div class="banner__search tab__container">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner.png">
        </div>
    </div>
    <?php
    /**
     * Button
     */
    if (!empty($fields_button && $fields_link)) { ?>
        <div class="taxdome__button">
            <a class="btn btn-lg btn-primary main-button"
               href="<?php echo wp_kses_post($fields_link); ?>"
               rel="noopener noreferrer"
               target="_blank"
               tabindex="0"
               aria-label="<?php echo wp_kses_post($fields_button); ?>">
                <?php echo wp_kses_post($fields_button); ?>
            </a>
        </div>
    <?php } ?>
</section>

