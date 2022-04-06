<?php
global $specialClass;
$specialClass="testimonial";
get_header();
?>

<?php
global $wpdb;
$uuid = $_GET["uuid"];
$testimonial = $wpdb->get_row($wpdb->prepare( "SELECT * FROM `wp_testimonials` WHERE `uuid` = %s", $uuid ), ARRAY_A);

if (strlen($testimonial["testimonial"] < 120)) {
    $quotesize = 3;
} else if (strlen($testimonial["testimonial"] < 150)) {
    $quotesize = 2;
} else if (strlen($testimonial["testimonial"] < 200)) {
    $quotesize = 1;
}

?>


<div id="testimonial-container">
    <div id="testimonial-bg-container">
        <?php
        echo file_get_contents(__DIR__ . "/../../public/testimonial-elements/bg.svg");
        ?>
    </div>
    <div id="testimonial-wrapper" class="flex justify-between">
        <div id="testimonial-img-container">
            <img src="<?= $testimonial["testimonial_picture"]?>" alt="" srcset="">
        </div>
        <div id="testimonial-content-container" class="flex">
            <div id="testimonial-content-inner" class="my-auto p-4">
                <p class="font-bold mb-4 size-<?= $quotesize ?>" id="testimonial-quote"><i>«<?= $testimonial["testimonial"]?>»</i></p>
                <p class="text-3xl mb-0"><b><?= $testimonial["fname"] ?> <?= $testimonial["lname"] ?></b></p>
                <p class="text-3xl mt-2"><?= $testimonial["position"] ?></p>
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
            <p class="testimonial-slogan">Meine Stimme</p>
            <p class="testimonial-slogan">für deine Stimme</p>
        </div>
    <?php
    else:
    ?>
        <div id="testimonial-slogan-container">
            <p class="testimonial-slogan">Deine Stimme</p>
            <p class="testimonial-slogan">für meine Stimme</p>
        </div>
    <?php
    endif;
    ?>
</div>

<?php
get_footer();
?>