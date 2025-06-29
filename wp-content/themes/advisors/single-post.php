<?php
/**
 * Шаблон одиночной записи (Post)
 * Файл: single.php (или single-post.php)
 */

get_header(); ?>
<section class="single-post">
    <div class="container">
        <main class="post">

            <?php
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post();
                    $post_id   = get_the_ID();
                    $title     = get_the_title();
                    $permalink = get_permalink();
                    $date      = get_the_date( 'j F Y' );
                    $author    = get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) );
                    ?>

                    <article id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class( 'single-post__article' ); ?>>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="single-post__thumbnail">
                                <?php the_post_thumbnail( 'large', array( 'class' => 'single-post__image' ) ); ?>
                            </div>
                        <?php endif; ?>

                        <header class="single-post__header">
                            <h1 class="single-post__title"><?php echo esc_html( $title ); ?></h1>
                            <div class="single-post__meta" style="margin-bottom: 20px">
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="single-post__date">
                                    <?php echo esc_html( $date ); ?>
                                </time>
                                <span class="single-post__author">by <?php echo esc_html( $author ); ?></span>
                            </div>
                        </header>

                        <div class="single-post__content">
                            <?php the_content(); ?>
                        </div>

                    </article>



                    <?php
                } // конец цикла while
                wp_reset_postdata();
            } else {
                echo '<p class="single-post__no-content">No posts</p>';
            }
            ?>

        </main>
    </div>
</section>
<?php get_footer(); ?>
