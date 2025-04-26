<?php
/**
 * Block: What is
 */
$fields            = get_fields();
$fields_title      = $fields['title'];
$fields_desc       = $fields['description'];
$left_image        = $fields['left_image'];
$left_title        = $fields['left_title'];
$left_description  = $fields['left_description'];
$right_image       = $fields['right_image'];
$right_title       = $fields['right_title'];
$right_description = $fields['right_description'];
?>
<section class="whatis">
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
        /**
         * Description
         */
        if (!empty($fields_desc)) { ?>
            <p>
                <?php echo wp_kses_post($fields_desc); ?>
            </p>
        <?php } ?>
        <div class="whatis__group">
            <div class="whatis__group-left">
                <?php
                /**
                 * Image
                 */
                if (!empty($left_image)) { ?>
                    <div>
                        <img loading="lazy"
                             src="<?php echo wp_kses_post($left_image['url']); ?>"
                             alt="<?php echo wp_kses_post($left_image['alt']); ?>"
                             decoding="async"
                             width="365"
                             height="365">
                    </div>
                <?php }
                /**
                 * Headline
                 */
                if (!empty($left_title)) { ?>
                    <div class="title">
                        <?php echo wp_kses_post($left_title); ?>
                    </div>
                <?php }
                /**
                 * Description
                 */
                if (!empty($left_description)) { ?>
                    <div class="whatis__group-left_description">
                        <?php echo wp_kses_post($left_description); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="whatis__group-right">
                <?php
                /**
                 * Image
                 */
                if (!empty($right_image)) { ?>
                    <div class="whatis__group-right_overlay">
                        <img loading="lazy"
                             src="<?php echo wp_kses_post($right_image['url']); ?>"
                             alt="<?php echo wp_kses_post($right_image['alt']); ?>"
                             decoding="async"
                             width="365"
                             height="365">
                    </div>
                <?php }
                /**
                 * Headline
                 */
                if (!empty($right_title)) { ?>
                    <div class="title">
                        <?php echo wp_kses_post($right_title); ?>
                    </div>
                <?php }
                /**
                 * Description
                 */
                if (!empty($right_description)) { ?>
                    <div class="whatis__group-left_description">
                        <?php echo wp_kses_post($right_description); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
