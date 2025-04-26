<?php
/**
 * Block: Image Left
 */
$fields        = get_fields();
$fields_title  = $fields['title'];
$fields_desc   = $fields['description'];
$fields_photo  = $fields['image'];
?>
<section class="imgleft">
    <div class="container">
        <div class="imgleft__inner">
            <div class="imgleft__inner-left">
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
                    <div class="imgleft__inner-left">
                        <?php echo wp_kses_post($fields_desc); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="imgleft__inner-right">
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
        </div>
    </div>
</section>
