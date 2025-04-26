<?php
/**
 * Block: 404
 */
$fields       = get_field('404', 'options');
$fields_title = $fields['title'];
$fields_desc  = $fields['description'];
$fields_link  = $fields['link'];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    if (!empty($fields_title)) {
        echo '<title>' . esc_html($fields_title) . '</title>';
        echo '<meta property="og:title" content="' . esc_html($fields_title) . '" class="yoast-seo-meta-tag">';
    }
    wp_head();
    ?>
</head>
<body>
<div class="page-404 nopage">
    <?php
    /**
     * Headline
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
     * link
     */
    if (!empty($fields_link)) { ?>
        <p><?php echo $fields_link; ?></p>
    <?php } ?>
</div>
<style>
    .nopage {
        text-align: center;
        padding: 117px 0
    }

    .nopage h1 {
        font-size: 100px
    }

    .nopage p {
        font-size: 18px
    }
</style>
<?php wp_footer(); ?>
</body>
</html>
