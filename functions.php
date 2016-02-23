<?php

// declare woocommerce support
add_action ( 'after_setup_theme' , 'woocommerce_support' );
function woocommerce_support ()
{
    add_theme_support ( 'woocommerce' );
}

// remove woocommerce stylingz
add_filter ( 'woocommerce_enqueue_styles' , '__return_empty_array' );

// styles and scripts
function theme_scripts ()
{
    // wp_enqueue_style( 'main-css', get_template_directory_uri() . '/assets/stylesheets/main.css' );
    wp_enqueue_script (
        'main-js' , get_template_directory_uri () . '/assets/javascripts/build.js' , array ( 'jquery' ) , '1.0.0' , true
    );
}

add_action ( 'wp_enqueue_scripts' , 'theme_scripts' );

// menus
register_nav_menu ( 'main-menu' , 'Main Menu' );
register_nav_menu ( 'footer-menu' , 'Footer Menu' );
register_nav_menu ( 'footer-quick-links' , 'Footer Quick Links' );
register_nav_menu ( 'lower-footer-menu' , 'Lower Footer Menu' );