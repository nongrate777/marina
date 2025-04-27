<?php
/**
 * Block: Happy
 */
$fields = get_fields();
$fields_title  = isset( $fields['title'] )           ? $fields['title']           : '';
$fields_brands = isset( $fields['brands'] )          ? $fields['brands']          : [];
$fields_button = isset( $fields['button_text'] )     ? $fields['button_text']     : '';
$fields_link   = isset( $fields['button_links'] )    ? $fields['button_links']    : '';
?>
<section class="happy">
    <div class="container">
        <div class="happy__main">
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
            if (!empty($fields_brands)) { ?>
            <ul class="happy__main-brands">
                <?php foreach ($fields_brands as $brand) { ?>
                    <li class="brands_inner">
                        <img src="<?php echo wp_kses_post($brand['brand']['url']); ?>" alt="<?php echo wp_kses_post($brand['brand']['alt']); ?>" >
                    </li>
                <?php } ?>
            </ul>
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
    </div>
</section>

