<?php
/**
 * Template Name: Contacts
 */
get_header();
?>
    <div class="container">
        <h1><?php the_title(); ?></h1>
    </div>
<?php
the_content(); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var textarea = document.querySelector('textarea[name="your-message"]');
            var maxLength = 2000;

            textarea.addEventListener('input', function() {
                var message = this.value;
                if (message.length > maxLength) {
                    this.value = message.slice(0, maxLength);
                }
            });
        });
    </script>
<?php
get_footer();
