<?php

function my_theme_enqueue_styles() {

    $parent_style = 'Divi-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

/***ADDS DIVI BUILDER TO CUSTOM POSTS */
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_et_builder_post_types( $post_types ) {
    $post_types[] = 'speaker';

    return $post_types;
}
add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );

// Update Dashboard CSS
function admin_style() {
wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');




?>
