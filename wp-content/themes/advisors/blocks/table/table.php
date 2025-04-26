<?php
/**
 * Block: Table
 */
$fields        = get_fields();
$fields_title  = $fields['title'];
$fields_desc   = $fields['description'];
?>
<section class="table">
    <div class="container">
        <div class="table__inner">
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
                <p>
                    <?php echo wp_kses_post($fields_desc); ?>
                </p>
            <?php } ?>
        </div>
    </div>
</section>
