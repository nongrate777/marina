<?php
/**
 * Block: Search by location
 */
$fields = get_fields();
$fields_country = $fields['country'];
$fields_country_link = $fields['country_link'];
$fields_all = $fields['all_services'];
$fields_regions = $fields['regions'];

?>
<div class="locations">
    <?php if (!empty($fields_country) && !empty($fields_country_link)) {
        ?>
        <div class="locations__country">
            <a href="/search_results/?location=<?php echo $fields_country_link; ?>">
                <?php echo $fields_country; ?>
            </a>
            <a href="/search_results/?location=<?php echo $fields_country_link; ?>" class="all_services">
                <?php echo $fields_all; ?>
            </a>
        </div>
    <?php }
    ?>
    <div class="locations__regions">
        <?php if (!empty($fields_regions)) {
            foreach ($fields_regions as $region) { ?>
                <div class="locations__regions-item">
                    <a href="/search_results/?location=<?php echo $region['region']; ?>">
                        <?php echo wp_kses_post($region['region']); ?>
                    </a>
                </div>
            <?php }
        } ?>
    </div>
</div>
