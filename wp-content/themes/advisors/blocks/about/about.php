<?php
/**
 * Block: About
 */
$fields          = get_fields();
$fields_btn      = $fields['button'];
$fields_btn_link = $fields['button_link'];
$fields_title    = $fields['title'];
$fields_desc     = $fields['description'];
?>
<section class="about">
    <div class="container">
        <div class="taxdome-intro-wrapper">
            <canvas id="taxdome-gradient-canvas"></canvas>
        </div>
        <div class="about__inner">
            <div class="breadcrumbs">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="current"> / <?php the_title(); ?></span>
            </div>
            <div class="about__inner-left">
                <?php
                /**
                 * Title
                 */
                if (!empty($fields_title)) { ?>
                    <h1><?php echo wp_kses_post($fields_title); ?></h1>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc)) { ?>
                    <p><?php echo wp_kses_post($fields_desc); ?></p>
                <?php }
                /**
                 * Button
                 */
                if (!empty($fields_btn && $fields_btn_link)) { ?>
                    <div class="taxdome__button">
                        <a  class="btn btn-lg btn-primary mobile-about"
                            href="<?php echo wp_kses_post($fields_btn_link); ?>"
                            rel="noopener noreferrer"
                            target="_blank"
                            aria-label="<?php echo wp_kses_post($fields_btn); ?>"
                            tabindex="0">
                            <?php echo wp_kses_post($fields_btn); ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="about__inner-right">
                <?php
                /**
                 * Image
                 */
                if (!empty($fields['image'])) { ?>
                    <div class="about__inner-right_overlay">
                        <img loading="lazy"
                             decoding="async"
                             src="<?php echo wp_kses_post($fields['image']['url']); ?>"
                             alt="<?php echo wp_kses_post($fields['image']['alt']); ?>"
                             width="570"
                             height="500">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<style>
    .footer::before{
         background: none;
     }
</style>
