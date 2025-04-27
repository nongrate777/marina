<?php
/**
 * Block: Services
 */
$fields = get_fields();
if (!is_array($fields)) {
    $fields = [];
}
$fields_title = isset($fields['title']) ? $fields['title'] : '';
$fields_desc = isset($fields['description']) ? $fields['description'] : '';
$fields_button = isset($fields['button']) ? $fields['button'] : '';
$fields_link = isset($fields['button_link']) ? $fields['button_link'] : '';
$fields_image = isset($fields['image']) ? $fields['image'] : '';
$fields_block = isset($fields['block']) ? $fields['block'] : '';
?>
<section class="services">
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
        <div class="services__description">
            <?php echo wp_kses_post($fields_desc); ?>
        </div>
    <?php }
    ?>
    <div class="container">
        <div class="services__left">
            <?php
            /**
             * Block
             */
            if (!empty($fields_block)) { ?>
                <div class="services__left-block">
                    <?php echo wp_kses_post($fields_block); ?>
                </div>
            <?php }
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
        <div class="services__right">
            <?php
            /**
             * Image
             */
            if (!empty($fields_image)) { ?>
                <img loading="lazy"
                     src="<?php echo wp_kses_post($fields_image['url']); ?>"
                     alt="<?php echo wp_kses_post($fields_image['alt']); ?>"
                     decoding="async"
                >
            <?php } ?>
        </div>
    </div>
</section>
