<?php
/**
 * Block: Bluefour
 */
$fields        = get_fields();
$fields_title  = $fields['title'];
$fields_desc1  = $fields['description1'];
$fields_photo1 = $fields['image1'];
$fields_desc2  = $fields['description2'];
$fields_photo2 = $fields['image2'];
$fields_desc3  = $fields['description3'];
$fields_photo3 = $fields['image3'];
$fields_desc4  = $fields['description4'];
$fields_photo4 = $fields['image4'];
$fields_bottom = $fields['text_bottom'];
?>
<section class="bluefour">
    <div class="container">
        <?php
        /**
         * Headline
         */
        if (!empty($fields_title)) { ?>
            <h2><?php echo wp_kses_post($fields_title); ?></h2>
        <?php } ?>
        <div class="bluefour__inner">
            <div class="bluefour__inner-item">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_photo1)) { ?>
                    <div class="bluefour__inner-item-image">
                        <img loading="lazy"
                             decoding="async"
                             src="<?php echo wp_kses_post($fields_photo1['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_photo1['alt']); ?>"
                             width="170"
                             height="180">
                    </div>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc1)) { ?>
                    <div class="bluefour__inner-item-description">
                        <?php echo wp_kses_post($fields_desc1); ?>
                    </div>
                <?php }
                ?>
            </div>
            <div class="bluefour__inner-item">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_photo2)) { ?>
                    <div class="bluefour__inner-item-image">
                        <img loading="lazy"
                             decoding="async"
                             src="<?php echo wp_kses_post($fields_photo2['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_photo2['alt']); ?>"
                             width="170"
                             height="180">
                    </div>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc2)) { ?>
                    <div class="bluefour__inner-item-description">
                        <?php echo wp_kses_post($fields_desc2); ?>
                    </div>
                <?php }
                ?>
            </div>
            <div class="bluefour__inner-item">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_photo3)) { ?>
                    <div class="bluefour__inner-item-image">
                        <img loading="lazy"
                             decoding="async"
                             src="<?php echo wp_kses_post($fields_photo3['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_photo3['alt']); ?>"
                             width="170"
                             height="180">
                    </div>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc3)) { ?>
                    <div class="bluefour__inner-item-description">
                        <?php echo wp_kses_post($fields_desc3); ?>
                    </div>
                <?php }
                ?>
            </div>
            <div class="bluefour__inner-item">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_photo4)) { ?>
                    <div class="bluefour__inner-item-image">
                        <img loading="lazy"
                             decoding="async"
                             src="<?php echo wp_kses_post($fields_photo4['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_photo4['alt']); ?>"
                             width="170"
                             height="180">
                    </div>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc4)) { ?>
                    <div class="bluefour__inner-item-description">
                        <?php echo wp_kses_post($fields_desc4); ?>
                    </div>
                <?php }
                ?>
            </div>
        </div>
        <?php
        /**
         * Note
         */
        if (!empty($fields_bottom)) { ?>
            <div class="bluefour__bottom">
                <?php echo wp_kses_post($fields_bottom); ?>
            </div>
        <?php } ?>
    </div>
</section>
