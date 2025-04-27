<?php
/**
 * Block: Image Left
 */
$fields        = get_fields();
$fields_title  = isset( $fields['title'] )       ? $fields['title']       : '';
$fields_desc   = isset( $fields['description'] ) ? $fields['description'] : '';
$fields_photo  = isset( $fields['image'] )       ? $fields['image']       : '';
$fields_button = isset( $fields['button_text'] ) ? $fields['button_text'] : '';
$fields_link   = isset( $fields['button_links'] )? $fields['button_links']: '';
?>
<section class="imgleft">
    <div class="container">
        <?php
        /**
         * Headline
         */
        if (!empty($fields_title)) { ?>
        <h2>
            <?php echo wp_kses_post($fields_title); ?>
        </h2>
        <?php }
        ?>
        <div class="imgleft__inner">
            <div class="imgleft__inner-left">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_photo)) { ?>
                    <div class="imgleft__inner-left_overlay">
                        <img loading="lazy"
                             src="<?php echo wp_kses_post($fields_photo['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_photo['alt']); ?>"
                             decoding="async"
                             width="570"
                             height="370">
                    </div>
                <?php } ?>
            </div>
            <div class="imgleft__inner-right">
                <?php
                /**
                 * Description
                 */
                if (!empty($fields_desc)) { ?>
                    <div class="imgleft__inner-right-text">
                        <?php echo wp_kses_post($fields_desc); ?>
                    </div>
                <?php } ?>
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
    </div>
</section>
