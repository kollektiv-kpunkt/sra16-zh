<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if ( !is_user_logged_in() ) {
    wp_redirect( "/wp-login.php?redirect_to=" . urlencode($actual_link . "/api/v1/testimonial/view/{$uuid}") );
    exit;
}
get_header();
?>

<?php
global $wpdb;
$testimonial = $wpdb->get_row($wpdb->prepare( "SELECT * FROM `wp_testimonials` WHERE `uuid` = %s", $uuid ), ARRAY_A);

if (strlen($testimonial["testimonial"] > 125)) {
    $quotesize = 1;
} else if (strlen($testimonial["testimonial"] > 80)) {
    $quotesize = 2;
}

?>

<div class="testimonial-wrapper smallContainer"<?= ($browserAgent["browser_safari_original"]) ? " data-browser='fuckusafari'" : ""; ?>>

    <div id="testimonial-presentation-container" class="mt-36">
        <div id="testimonial-container">
            <div id="testimonial-bg-container">
                <?php
                echo file_get_contents(__DIR__ . "/../../public/testimonial-elements/bg.svg");
                ?>
            </div>
            <div id="testimonial-wrapper" class="flex justify-between">
                <div id="testimonial-img-container">
                    <div id="testimonial-img-inner">
                        <img src="<?= $testimonial["testimonial_picture"] ?>" alt="" id="testimonial-img">
                        <div id="testimonial-img-blind"></div>
                        <div id="testimonial-img-bg"></div>
                    </div>
                </div>
                <div id="testimonial-content-container" class="flex">
                    <div id="testimonial-content-inner" class="my-auto">
                        <p class="font-bold<?= ($quotesize) ? " size-{$quotesize}" : "" ?>" id="testimonial-quote"><i>«<?= $testimonial["testimonial"] ?>»</i></p>
                        <p class="testimonial-subtitle" id="testimonial-name"><b><?= $testimonial["fname"] ?> <?= $testimonial["lname"] ?></b></p>
                        <p class="testimonial-subtitle" id="testimonial-position"><?= $testimonial["position"] ?></p>
                    </p>
                    </div>
                </div>
            </div>
            <div id="testimonial-logo-container">
                <?php
                get_template_part( "templates/partials/logo" );
                ?>
            </div>
            <?php
            if ($testimonial["over18"]) : ?>
            <div id="testimonial-slogan-container">
                <p class="testimonial-slogan" id="testimonial-slogan-1">Meine Stimme</p>
                <p class="testimonial-slogan" id="testimonial-slogan-2">für deine Stimme</p>
            </div>
            <?php
            else:
            ?>
            <div id="testimonial-slogan-container">
                <p class="testimonial-slogan" id="testimonial-slogan-1">Deine Stimme</p>
                <p class="testimonial-slogan" id="testimonial-slogan-2">für meine Stimme</p>
            </div>
            <?php
            endif;
            ?>
        </div>
        <a href="#" id="testimonial-change-ds" class="sra-button mt-3">Farbschema wechseln</a>
        <a href="#" id="testimonial-download" class="sra-button sra-button-arrowdown mt-3">Testimonial herunterladen</a>
        <a href="/api/v1/testimonial/" class="sra-button sra-button-arrowback mt-3">Zurück</a>
    </div>
</div>


<?php
get_footer();
?>