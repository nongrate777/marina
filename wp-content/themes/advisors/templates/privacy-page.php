<?php
/**
 * Template Name: Privacy Policy
 */
get_header();
/**
 * Block: Default fields
 */
$fields          = get_field('footer', 'options');
$last_updated    = $fields['last_updated'];
?>
<section class="location-page">
    <div class="container">
        <div class="profile__top-back">
            <div class="breadcrumbs">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="current"> / <?php the_title(); ?></span>
            </div>
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="location-page__main terms-main">
            <?php
            the_content(); ?>
            <div class="last-update">
                <?php if(!empty($last_updated  )) {echo $last_updated;} ?>
                <span><?php echo get_the_modified_date('F, Y'); ?></span>
            </div>
        </div>
    </div>
</section>
<script>
    var parentElement = document.querySelector('.location-page__main');
    var parentHeight = parentElement.clientHeight;
    parentElement.classList.add('dynamic-height');
</script>
<?php
get_footer();
?>
