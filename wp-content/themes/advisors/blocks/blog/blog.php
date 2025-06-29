<?php
/**
 * Block: Blog
 * @var array $block
 */
$fields = get_fields();
$fields_title  = isset( $fields['title'] )           ? $fields['title']           : '';

?>
<section class="blog">
    <div class="container">
        <div class="blog__main">
            <?php
            $args = [
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
            ];
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();

                    $post_id    = get_the_ID();
                    $title      = get_the_title( $post_id );
                    $permalink  = get_permalink( $post_id );
                    $date       = get_the_date( 'j F Y', $post_id );
                    $author     = get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) );
                    $excerpt    = wp_trim_words( get_the_content( null, false, $post_id ), 20, '...' );

                    if ( has_post_thumbnail( $post_id ) ) {
                        $thumbnail = get_the_post_thumbnail( $post_id, 'medium', [ 'class' => 'blog__item-image' ] );
                    } else {
                        $thumbnail = '<div class="blog__item-image blog__item-image--placeholder"></div>';
                    }
                    ?>
                    <article id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class( 'blog__item' ); ?>>
                        <h3 class="blog__item-title">
                            <a href="<?php echo esc_url( $permalink ); ?>">
                                <?php echo esc_html( $title ); ?>
                            </a>
                        </h3>

                        <a href="<?php echo esc_url( $permalink ); ?>" class="blog__item-link">
                            <?php echo $thumbnail; ?>
                        </a>

                        <div class="blog__item-content">
                            <div class="blog__item-meta">
                                <time datetime="<?php echo esc_attr( get_the_date( 'c', $post_id ) ); ?>" class="blog__item-date">
                                    <?php echo esc_html( $date ); ?>
                                </time>
                                <span class="blog__item-author">
                                    by <?php echo esc_html( $author ); ?>
                                </span>
                            </div>

                            <p class="blog__item-excerpt">
                                <?php echo esc_html( $excerpt ); ?>
                            </p>


                            <div class="taxdome__button button-blog">
                                <a class="btn btn-lg btn-primary main-button"
                                   href="<?php echo esc_url( $permalink ); ?>"
                                   rel="noopener noreferrer"
                                   tabindex="0"
                                   aria-label="">
                                    Read more
                                </a>
                            </div>
                        </div>
                    </article>
                    <?php
                }
                wp_reset_postdata();
            } else {
                echo '<p class="blog__no-posts">No posts found.</p>';
            }
            ?>
        </div>
    </div>
</section>

