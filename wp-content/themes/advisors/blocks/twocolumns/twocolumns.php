<?php
/**
 * Block: Two columns
 */
$fields                  = get_fields();
$fields_title_left       = $fields['title_left'];
$fields_title_right      = $fields['title_right'];
$fields_desc_left        = $fields['description_left'];
$fields_desc_right       = $fields['description_right'];
$fields_photo_left       = $fields['image_left'];
$fields_photo_right      = $fields['image_right'];
$fields_button_left      = $fields['button_left'];
$fields_button_left_link = $fields['button_left_link'];
$fields_bottom_right     = $fields['bottom_right'];
?>
<section class="twocolumns">
    <div class="container">
        <div class="twocolumns__inner">
            <div class="twocolumns__inner-left">
                <?php
                /**
                 * Headline
                 */
                if (!empty($fields_title_left)) { ?>
                    <h3>
                        <?php echo wp_kses_post($fields_title_left); ?>
                    </h3>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc_left)) { ?>
                    <div class="twocolumns__inner-left-description">
                        <?php echo wp_kses_post($fields_desc_left); ?>
                    </div>
                <?php }
                /**
                 * Buttons
                 */
                if (!empty($fields_button_left_link) && !empty($fields_button_left)) { ?>
                    <div class="twocolumns__inner-left-button taxdome__button">
                        <a class="btn btn-lg btn-primary"
                           href="<?php echo wp_kses_post($fields_button_left_link); ?>"
                           tabindex="0"
                           aria-label="<?php echo wp_kses_post($fields_button_left); ?>">
                            <?php echo wp_kses_post($fields_button_left); ?>
                        </a>
                    </div>
                <?php } ?>
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_photo_left)) { ?>
                    <div class="twocolumns__inner-left-image img-left">
                        <img loading="lazy"
                             src="<?php echo wp_kses_post($fields_photo_left['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_photo_left['alt']); ?>"
                             decoding="async"
                             width="450"
                             height="250">
                    </div>
                <?php } ?>
            </div>
            <div class="twocolumns__inner-right">
                <?php
                /**
                 * Headline
                 */
                if (!empty($fields_title_right)) { ?>
                    <h3>
                        <?php echo wp_kses_post($fields_title_right); ?>
                    </h3>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc_right)) { ?>
                    <div class="twocolumns__inner-right-description">
                        <?php echo wp_kses_post($fields_desc_right); ?>
                    </div>
                <?php }
                /**
                 * Notice
                 */
                if (!empty($fields_bottom_right)) { ?>
                    <div class="twocolumns__inner-right-bottom">
                        <?php echo wp_kses_post($fields_bottom_right); ?>
                    </div>
                <?php } ?>
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_photo_right)) { ?>
                    <div class="twocolumns__inner-right-image img-right">
                        <img loading="lazy"
                             src="<?php echo wp_kses_post($fields_photo_right['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_photo_right['alt']); ?>"
                             decoding="async"
                             width="450"
                             height="250">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
