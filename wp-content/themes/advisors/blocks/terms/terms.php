<?php
/**
 * Block: Terms
 */
$fields       = get_fields();
$fields_title = $fields['title'];
$fields_desc  = $fields['description'];
?>
<div class="terms">
    <?php
    /**
     * Description
     */
    if (!empty($fields_desc)) { ?>
        <div class="terms__inner">
            <?php echo wp_kses_post($fields_desc); ?>
        </div>
    <?php } ?>
</div>
