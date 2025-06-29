<?php
$description = get_field( 'description' );
$subdesc     = get_field( 'subdesc' );
?>

<section class="testimonials">
    <div class="container">
        <div class="testimonials__inner">


            <?php if ( $description ) : ?>
                <div class="testimonials__description">
                    <?php echo wp_kses_post( wpautop( $description ) ); ?>
                </div>
            <?php endif; ?>


            <?php if ( $subdesc ) : ?>
                <div class="testimonials__subdesc">
                    <?php echo wp_kses_post( wpautop( $subdesc ) ); ?>
                </div>
            <?php endif; ?>


            <?php if ( have_rows( 'cards' ) ) : ?>
                <div class="testimonials__cards-container">
                    <?php while ( have_rows( 'cards' ) ) : the_row();


                        $name     = get_sub_field( 'name' );
                        $position = get_sub_field( 'position' );
                        $link     = get_sub_field( 'link' );
                        $photo    = get_sub_field( 'photo' );
                        $text     = get_sub_field( 'text' );


                        if ( $photo ) {
                            $photo_url = esc_url( $photo['url'] );
                            $photo_alt = esc_attr( $photo['alt'] );
                        } else {
                            $photo_url = '';
                            $photo_alt = '';
                        }
                        ?>

                        <div class="testimonials__card">

                            <?php if ( $name ) : ?>
                                <h3 class="testimonials__name">
                                    <?php echo esc_html( $name ); ?>
                                </h3>
                            <?php endif; ?>


                            <?php if ( $position ) : ?>
                                <div class="testimonials__position">
                                    <?php echo esc_html( $position ); ?>
                                </div>
                            <?php endif; ?>


                            <?php if ( $photo_url ) : ?>
                                <div class="testimonials__photo">
                                    <?php if ( $link ) : ?>
                                        <a
                                            href="<?php echo esc_url( $link ); ?>"
                                            class="testimonials__video-link"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            aria-label="<?php echo esc_attr( "Play testimonial from {$name}" ); ?>"
                                        >
                                            <img
                                                src="<?php echo $photo_url; ?>"
                                                alt="<?php echo $photo_alt; ?>"
                                                class="testimonials__photo-image"
                                            />
                                            <span class="testimonials__play-icon"></span>
                                        </a>
                                    <?php else : ?>
                                        <img
                                            src="<?php echo $photo_url; ?>"
                                            alt="<?php echo $photo_alt; ?>"
                                            class="testimonials__photo-image"
                                        />
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>


                            <?php if ( $text ) : ?>
                                <div class="testimonials__text">
                                    <?php echo wp_kses_post( wpautop( $text ) ); ?>
                                </div>
                            <?php endif; ?>

                        </div>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
