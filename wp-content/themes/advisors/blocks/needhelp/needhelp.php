<?php
/**
 * Block: Need help
 */
$fields        = get_fields();
$fields_title  = $fields['title'];
$fields_desc   = $fields['description'];
$fields_button = $fields['button'];
$fields_link   = $fields['button_link'];
$fields_image  = $fields['image'];
?>
<section class="needhelp">
    <div class="container">
        <div class="needhelp__inner">
            <div class="needhelp__inner-left">
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
                <?php }
                /**
                 * Button
                 */
                if (!empty($fields_button) && !empty($fields_link)) { ?>
                    <div class="taxdome__button">
                        <a  class="btn btn-lg btn-primary"
                            href="<?php echo wp_kses_post($fields_link); ?>"
                            rel="noopener noreferrer"
                            tabindex="0"
                            aria-label="<?php echo wp_kses_post($fields_button); ?>">
                            <?php echo wp_kses_post($fields_button); ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="needhelp__inner-right">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields_image)) { ?>
                    <div>
                        <img  loading="lazy"
                              src="<?php echo wp_kses_post($fields_image['url']); ?>"
                              alt="<?php echo wp_kses_post($fields_image['alt']); ?>"
                              decoding="async"
                              width="520"
                              height="410">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
