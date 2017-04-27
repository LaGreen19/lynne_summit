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


//Custom post types function
function create_custom_post_types() {
//create a case study custom post type
    register_post_type( 'speakers',
        array(
            'labels' => array(
                'name' => __( 'Speakers' ),
                'singular_name' => __( 'speaker' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array(
               'slug' => 'speakers'
             ),
        )
    );
}
add_action( 'init', 'create_custom_post_types' );

// Divi Builder on custom post types by https://wpcolt.com
add_filter('et_builder_post_types', 'divicolt_post_types');
add_filter('et_fb_post_types','divicolt_post_types' ); // Enable Divi Visual Builder on the custom post types
function divicolt_post_types($post_types)
{
    foreach (get_post_types() as $post_type) {
        if (!in_array($post_type, $post_types) and post_type_supports($post_type, 'editor')) {
            $post_types[] = $post_type;
        }
    }
    return $post_types;
}
add_action('add_meta_boxes', 'divicolt_add_meta_box');
function divicolt_add_meta_box()
{
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'editor') and function_exists('et_single_settings_meta_box')) {
            $obj= get_post_type_object( $post_type );
            add_meta_box('et_settings_meta_box', sprintf(__('Divi %s Settings', 'Divi'), $obj->labels->singular_name), 'et_single_settings_meta_box', $post_type, 'side', 'high');
        }
    }
}
add_action('admin_head', 'divicolt_admin_js');
function divicolt_admin_js()
{
    $s = get_current_screen();
    if (!empty($s->post_type) and $s->post_type != 'page' and $s->post_type != 'post') {
        ?>
        <script>
            jQuery(function ($) {
                $('#et_pb_layout').insertAfter($('#et_pb_main_editor_wrap'));
            });
        </script>
        <?php
    }
}
?>
