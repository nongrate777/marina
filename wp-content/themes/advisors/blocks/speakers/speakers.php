<?php
/**
 * Block Speakers
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
$fields_speaker = isset($fields['speaker']) ? $fields['speaker'] : [];
?>
<section class="speakers">
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
    <div class="container">
        <div class="speakers__left">
            <?php
            /**
             * Description
             */
            if (!empty($fields_desc)) { ?>
                <div class="speakers__description">
                    <?php echo wp_kses_post($fields_desc); ?>
                </div>
            <?php }
            /**
             * Block
             */
            if (!empty($fields_block)) { ?>
                <div class="speakers__left-block">
                    <?php echo wp_kses_post($fields_block); ?>
                </div>
            <?php }
            ?>
        </div>
        <div class="speakers__right">
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
    <div class="container">
        <?php
        if (!empty($fields_speaker)) { ?>
            <div class="speakers__speaker-blocks">
                <?php $i = 0;
                foreach ($fields_speaker as $block) {
                    $i++;
                    ?>
                    <div class="speakers__speaker-blocks-all">
                        <div class="speakers__speaker-blocks-inner style<?php echo $i; ?>">
                            <div class="block_inner-title">
                                <?php echo wp_kses_post($block['name']); ?>
                            </div>
                            <div class="block_inner-text">
                                <?php echo wp_kses_post($block['position']); ?>
                            </div>
                            <div class="block_inner-social">
                                <a href="#"><?php echo wp_kses_post($block['social']); ?></a>
                            </div>
                            <img loading="lazy"
                                 src="<?php echo wp_kses_post($block['photo']['url']); ?>"
                                 alt="<?php echo wp_kses_post($block['photo']['alt']); ?>"
                                 decoding="async"
                            >
                        </div>
                    </div>
                <?php }; ?>
            </div>
        <?php }; ?>
    </div>
</section>
