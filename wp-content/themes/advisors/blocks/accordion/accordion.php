<?php
/**
 * Block: Accordion
 */
$fields       = get_fields();
$fields_title = $fields['title'];
$fields_acc   = $fields['accordion'];
?>
<section class="accordion">
    <div class="accordion__inner">
        <div class="container">
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
            if (!empty($fields_acc)) {
                foreach ($fields_acc as $faq) { ?>
                    <div class="accordion__faq">
                        <div class="accordion__question">
                            <?php echo wp_kses_post($faq['question']); ?>
                        </div>
                        <div class="accordion__answer content">
                            <?php echo $faq['answer']; ?>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</section>
