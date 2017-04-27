<?php
function my_theme_enqueue_styles() {

    $parent_style = 'Divi-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( 'Divi', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'Divi' ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function wptuts_scripts_with_jquery()
{
    wp_register_script( 'child-custom', get_template_directory_uri() . '/js/child-custom.js', array( 'jquery' ) , true );
    wp_enqueue_script( 'child-custom' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_with_jquery' );

?>
