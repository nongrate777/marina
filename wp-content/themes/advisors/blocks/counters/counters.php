<?php
/**
 * Block: Counters
 */
$fields          = get_fields();
$fields_btn      = $fields['button'];
$fields_btn_link = $fields['button_link'];
$fields_title    = $fields['title'];
$fields_desc     = $fields['description'];
?>
<section class="counters">
    <div class="container">
        <div class="counters__inner">
            <?php
            /**
             * Headline
             */
            if (!empty($fields_title)) { ?>
                <h2>
                    <?php echo wp_kses_post($fields_title); ?>
                </h2>
            <?php } ?>
        </div>
        <div class="counters__bottom">
            <?php
            /**
             * Options
             */
            if (!empty($fields['counter'])) {
                foreach ($fields['counter'] as $index => $item) {
                    ?>
                    <div class="counters__bottom-item">
                        <h2 class="counter-id-<?php echo esc_attr($index); ?>">
                            <?php echo wp_kses_post($item['number']); ?>
                        </h2>
                        <p>
                            <?php echo wp_kses_post($item['desc']); ?>
                        </p>
                    </div>
                <?php }
            } ?>
        </div>
        <?php
        /**
         * Button
         */
        if (!empty($fields_btn && $fields_btn_link)) { ?>
            <div class="taxdome__button">
                <a  class="btn btn-lg btn-primary"
                    href="<?php echo wp_kses_post($fields_btn_link); ?>"
                    rel="noopener noreferrer"
                    target="_blank"
                    tabindex="0"
                    aria-label="<?php echo wp_kses_post($fields_btn); ?>">
                    <?php echo wp_kses_post($fields_btn); ?>
                </a>
            </div>
        <?php } ?>
    </div>
</section>
