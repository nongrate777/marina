<?php
/**
 * Template Name: Search by location
 */
get_header();
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
        <div class="location-page__main">
            <?php
            the_content(); ?>
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
