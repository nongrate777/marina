<?php
/**
 * Block: Four columns
 */
$fields        = get_fields();
$fields_title  = $fields['title'];
$fields_desc   = $fields['desc'];
$fields_desc1  = $fields['description1'];
$fields_photo1 = $fields['image1'];
$fields_desc2  = $fields['description2'];
$fields_photo2 = $fields['image2'];
$fields_desc3  = $fields['description3'];
$fields_photo3 = $fields['image3'];
$fields_desc4  = $fields['description4'];
$fields_photo4 = $fields['image4'];
?>
<section class="fourblue">
    <div class="fourblue__back">
        <div class="container">
            <div class="fourblue__header">
                <?php
                /**
                 * Headline
                 */
                if (!empty($fields_title)) { ?>
                    <h2>
                        <?php echo wp_kses_post($fields_title);
                        ?>
                    </h2>
                <?php }
                /**
                 * Description
                 */
                if (!empty($fields_desc)) { ?>
                    <span class="fourblue__header-desc">
                    <?php echo wp_kses_post($fields_desc); ?>
                </span>
                <?php } ?>
            </div>
            <div class="fourblue__inner">
                <div class="fourblue__inner-item">
                    <?php
                    /**
                     * Image
                     */
                    if (!empty($fields_photo1)) { ?>
                        <div class="fourblue__inner-item-image">
                            <img loading="lazy"
                                 src="<?php echo wp_kses_post($fields_photo1['url']); ?>"
                                 alt="<?php echo wp_kses_post($fields_photo1['alt']); ?>"
                                 decoding="async"
                                 width="140"
                                 height="150">
                        </div>
                    <?php }
                    /**
                     * Description
                     */
                    if (!empty($fields_desc1)) { ?>
                        <div class="fourcolumns__inner-item-description">
                            <?php echo wp_kses_post($fields_desc1); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="fourblue__inner-item">
                    <?php
                    /**
                     * Image
                     */
                    if (!empty($fields_photo2)) { ?>
                        <div class="fourblue__inner-item-image">
                            <img loading="lazy"
                                 src="<?php echo wp_kses_post($fields_photo2['url']); ?>"
                                 alt="<?php echo wp_kses_post($fields_photo2['alt']); ?>"
                                 decoding="async"
                                 width="140"
                                 height="150">
                        </div>
                    <?php }
                    /**
                     * Description
                     */
                    if (!empty($fields_desc2)) { ?>
                        <div class="fourblue__inner-item-description">
                            <?php echo wp_kses_post($fields_desc2); ?>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="fourblue__inner-item">
                    <?php
                    /**
                     * Image
                     */
                    if (!empty($fields_photo3)) { ?>
                        <div class="fourblue__inner-item-image">
                            <img loading="lazy"
                                 src="<?php echo wp_kses_post($fields_photo3['url']); ?>"
                                 alt="<?php echo wp_kses_post($fields_photo3['alt']); ?>"
                                 decoding="async"
                                 width="140"
                                 height="150">
                        </div>
                    <?php }
                    /**
                     * Description
                     */
                    if (!empty($fields_desc3)) { ?>
                        <div class="fourblue__inner-item-description">
                            <?php echo wp_kses_post($fields_desc3); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="fourblue__inner-item">
                    <?php
                    /**
                     * Image
                     */
                    if (!empty($fields_photo4)) { ?>
                        <div class="fourblue__inner-item-image">
                            <img loading="lazy"
                                 src="<?php echo wp_kses_post($fields_photo4['url']); ?>"
                                 alt="<?php echo wp_kses_post($fields_photo4['alt']); ?>"
                                 decoding="async"
                                 width="140"
                                 height="150">
                        </div>
                    <?php }
                    /**
                     * Description
                     */
                    if (!empty($fields_desc4)) { ?>
                        <div class="fourblue__inner-item-description">
                            <?php echo wp_kses_post($fields_desc4); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .taxdome-intro-wrapper{
        height: 860px;
    }
</style>
