<?php
require_once(__DIR__ . "/vendor/autoload.php");


$db = new pdo("sqlite:" . __DIR__ . "/db/sra16-zh.db");
global $db;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/* SRA16 ZH */
function sra_scripts() {
    wp_enqueue_style( 'fa', get_template_directory_uri() . "/lib/font-awesome/css/font-awesome.min.css", [], "1.0.3" );
    wp_enqueue_style( 'glowCookies', get_template_directory_uri() . "/lib/glowCookies/glowCookies.css", [], "1.0.3" );
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/dist/theme.css', [], "1.0.3" );
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/dist/fonts/fonts.css', [], "1.0.3" );
    wp_enqueue_script( 'glowCookies', get_template_directory_uri() . "/lib/glowCookies/glowCookies.js", array(), "1.0.3", true );
    wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/style.css', [], "1.0.3" );
    wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.js', array(), "1.0.1", true );
}
add_action( 'wp_enqueue_scripts', 'sra_scripts' );

function sra_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'sra_theme_support' );


/* Element Shortcode */
function sra_element_shortcode($atts) {
    $args = shortcode_atts( array(
        "elem" => "",
    ), $atts, "sra-element" );
    ob_start();
    get_template_part("templates/elements/{$args['elem']}", "", $atts);
    return ob_get_clean();
}

add_shortcode('sra-element', 'sra_element_shortcode');