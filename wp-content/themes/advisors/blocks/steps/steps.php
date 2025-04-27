<?php
/**
 * Block: Get block
 */
$fields = get_fields();
$fields_title  = isset( $fields['title'] )           ? $fields['title']           : '';
$fields_blocks = isset( $fields['blocks'] )          ? $fields['blocks']          : [];
$fields_button = isset( $fields['button_text'] )     ? $fields['button_text']     : '';
$fields_link   = isset( $fields['button_links'] )    ? $fields['button_links']    : '';
?>
<section class="steps">
    <div class="container">
        <div class="steps__main">
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
            if (!empty($fields_blocks)) { ?>
            <ul class="steps__main-blocks">
                <?php $i = 1; foreach ($fields_blocks as $block) { ?>
                    <li class="block_inner">
                        <div class="block_inner-text">
                            <p><?php echo wp_kses_post($block['description']); ?></p>
                        </div>
                    </li>
                <?php }; ?>
            </ul>
            <?php };
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
    </div>
</section>

