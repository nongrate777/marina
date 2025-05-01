<?php
/**
 * Block: Plan block
 */
$fields = get_fields();
$fields_title = isset($fields['title']) ? $fields['title'] : '';
$fields_plan = isset($fields['plan']) ? $fields['plan'] : [];

?>
<section class="plan">
    <div class="container">
        <div class="plan__main">
            <?php
            /**
             * Headline
             */
            if (!empty($fields_title)) { ?>
                <h2><?php echo wp_kses_post($fields_title); ?></h2>
            <?php }
            /**
             * Options
             */
            if (!empty($fields_plan)) { ?>
                <div class="plan__main-blocks">
                    <?php $i = 0; foreach ($fields_plan as $block) {
                        $i++;
                        ?>
                        <div class="plan__main-blocks-all">
                            <div class="plan__main-blocks-inner style<?php echo $i; ?>">
                                <div class="block_inner-title">
                                    <?php echo wp_kses_post($block['subtitle']); ?>
                                </div>
                                <div class="block_inner-text">
                                    <?php echo wp_kses_post($block['description']); ?>
                                </div>
                                <div class="block_inner-bottom">
                                    <?php echo wp_kses_post($block['bottom']); ?>
                                </div>
                            </div>
                            <div class="taxdome__button">
                                <a class="btn btn-lg btn-primary main-button plan"
                                   href="<?php echo wp_kses_post($block['button_links']); ?>"
                                   rel="noopener noreferrer"
                                   target="_blank"
                                   tabindex="0"
                                   aria-label="<?php echo wp_kses_post($block['button_text']); ?>">
                                    <?php echo wp_kses_post($block['button_text']); ?>
                                </a>
                            </div>
                        </div>
                    <?php }; ?>
                </div>
            <?php }; ?>
        </div>
    </div>
</section>

