<?php
/**
 * Block: Right photo
 */
$fields        = get_fields();
$fields_title  = $fields['title'];
$fields_desc   = $fields['description'];
$fields_image  = $fields['image'];
?>
<section class="rightphoto">
    <div class="container">
        <div class="rightphoto__inner">
            <div class="rightphoto__inner-left">
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
            </div>
            <div class="rightphoto__inner-right">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_image)) { ?>
                    <div class="rightphoto__inner-right_overlay">
                        <img loading="lazy"
                             src="<?php echo wp_kses_post($fields_image['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_image['alt']); ?>"
                             decoding="async"
                             width="520"
                             height="375">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
