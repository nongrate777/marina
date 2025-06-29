<?php
$label1 = get_field('label1');
$img1   = get_field('img1');
$link1  = get_field('link1');

$label2 = get_field('label2');
$img2   = get_field('img2');
$link2  = get_field('link2');

$label3 = get_field('label3');
$img3   = get_field('img3');
$link3  = get_field('link3');
?>
<section class="soc">
    <div class="container">
        <div class="soc__grid">

            <?php if ($label1 || $img1) { ?>
                <a class="soc__item" href="<?php echo esc_url($link1 ?: '#'); ?>" target="_blank" rel="noopener">
                    <?php if ($label1) { ?>
                        <span class="soc__label"><?php echo esc_html($label1); ?></span>
                    <?php } ?>
                    <?php if ($img1) {
                        echo wp_get_attachment_image($img1['ID'], 'medium', false, ['class' => 'soc__icon first']);
                    } ?>
                </a>
            <?php } ?>

            <?php if ($label2 || $img2) { ?>
                <a class="soc__item" href="<?php echo esc_url($link2 ?: '#'); ?>" target="_blank" rel="noopener">
                    <?php if ($label2) { ?>
                        <span class="soc__label"><?php echo esc_html($label2); ?></span>
                    <?php } ?>
                    <?php if ($img2) {
                        echo wp_get_attachment_image($img2['ID'], 'medium', false, ['class' => 'soc__icon second']);
                    } ?>
                </a>
            <?php } ?>

            <?php if ($label3 || $img3) { ?>
                <a class="soc__item" href="<?php echo esc_url($link3 ?: '#'); ?>" target="_blank" rel="noopener">
                    <?php if ($label3) { ?>
                        <span class="soc__label"><?php echo esc_html($label3); ?></span>
                    <?php } ?>
                    <?php if ($img3) {
                        echo wp_get_attachment_image($img3['ID'], 'medium', false, ['class' => 'soc__icon']);
                    } ?>
                </a>
            <?php } ?>

        </div>
    </div>
</section>
