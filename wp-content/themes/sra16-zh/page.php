<?php
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="page-header-wrapper">
        <?php
        if ( has_post_thumbnail() ) {
            $url = get_the_post_thumbnail_url();
        } else {
            $url = get_template_directory_uri(  ) . "/public/dividers/" . rand(1,13) . ".jpg";
        }
        ?>
        <div class="smallContainer page-heroine-inner pt-7">
            <div class="page-heroine-content scrollAnimation" style="transform: translateY(1rem); opacity: 0;" data-delay="250">
                <img src="<?= $url ?>">
                <div class="page-header-gradient"></div>
                <h1 class="text-5xl page-header-title mb-0"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
    <div class="smallContainer mt-12">
        <?php the_content(); ?>
    </div>

    <?php endwhile; else: ?>

      <h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
      <p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>


<?php
get_footer();
?>