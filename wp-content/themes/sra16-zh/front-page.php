<?php
get_header();
?>

<?php
get_template_part( "templates/partials/heroine" );
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="argumente">
        <div class="smallContainer mt-16">
            <?php the_content(); ?>
        </div>
    </div>

    <?php endwhile; else: ?>

      <h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
      <p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>


<?php
get_footer();
?>