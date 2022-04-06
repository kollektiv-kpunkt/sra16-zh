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

<?php
get_footer();
?>