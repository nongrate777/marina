<?php
/**
 * Block: Blue
 */
$fields        = get_fields();
$fields_title  = $fields['title'];
$fields_desc   = $fields['description'];
$fields_photo  = $fields['image'];
?>
<section class="blue">
    <div class="container">
        <div class="blue__inner">
            <div class="blue__inner-left">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_photo)) { ?>
                    <div class="blue__inner-left_overlay">
                        <img loading="lazy"
                             src="<?php echo wp_kses_post($fields_photo['url']); ?>"
                             alt="<?php echo wp_kses_post($fields_photo['alt']); ?>"
                             decoding="async"
                             width="570"
                             height="430">
                    </div>
                <?php } ?>
            </div>
            <div class="blue__inner-right">
                <?php
                /**
                 * Headline
                 */
                if (!empty($fields_title)) { ?>
                    <h2><?php echo wp_kses_post($fields_title); ?></h2>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc)) { ?>
                    <p><?php echo wp_kses_post($fields_desc); ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
