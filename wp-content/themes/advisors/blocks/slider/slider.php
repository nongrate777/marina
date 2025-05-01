<?php
/**
 * Block: Slider block
 */
$fields = get_fields();
$fields_title  = isset( $fields['title'] )           ? $fields['title']           : '';

?>
<section class="slider">
    <div class="container">
        <div class="slider__main">
            <?php
            /**
             * Headline
             */
            if (!empty($fields_title)) { ?>
                <h2><?php echo wp_kses_post($fields_title); ?></h2>
            <?php }
            ?>
            <div class="slider__main-content">
                <?php echo do_shortcode('[metaslider id="983"]'); ?>
            </div>
        </div>
    </div>
</section>

