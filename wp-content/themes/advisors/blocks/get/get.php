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
<section class="get">
    <div class="container">
        <div class="get__main">
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
            <ul class="get__main-blocks">
                <?php foreach ($fields_blocks as $block) { ?>
                    <li class="block_inner">
                        <img src="<?php echo wp_kses_post($block['image']['url']); ?>" alt="<?php echo wp_kses_post($block['image']['alt']); ?>" >
                        <div class="block_inner-text">
                            <h3><?php echo wp_kses_post($block['subtitle']); ?></h3>
                            <p><?php echo wp_kses_post($block['description']); ?></p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <?php }
            ?>
        </div>
    </div>
</section>

