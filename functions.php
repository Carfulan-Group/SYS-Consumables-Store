<?php
// // //
// declare woocommerce support
// // //
add_action ( 'after_setup_theme' , 'woocommerce_support' );
function woocommerce_support ()
{
    add_theme_support ( 'woocommerce' );
}

// // //
// remove woocommerce styling
// // //
add_filter ( 'woocommerce_enqueue_styles' , '__return_empty_array' );

// // //
// enqueue styles and scripts
// // //
function theme_scripts ()
{
    wp_enqueue_style( 'main-css', get_template_directory_uri() . '/assets/stylesheets/main.css' );
    wp_enqueue_script (
        'main-js' , get_template_directory_uri () . '/assets/javascripts/build.js' , array ( 'jquery' ) , '1.0.0' , true
    );
}

add_action ( 'wp_enqueue_scripts' , 'theme_scripts' );

// // //
// register nav menus
// // //
register_nav_menu ( 'main-menu' , 'Main Menu' );
register_nav_menu ( 'footer-menu' , 'Footer Menu' );
register_nav_menu ( 'footer-quick-links' , 'Footer Quick Links' );
register_nav_menu ( 'lower-footer-menu' , 'Lower Footer Menu' );

// // //
// remove cross-sells from cart page
// // //
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' , 10 );

// // //
// redirect to homepage after user registration
// // //
add_filter('woocommerce_registration_redirect', 'ps_wc_registration_redirect');
function ps_wc_registration_redirect( $redirect_to ) {
     $redirect_to = site_url();
     return $redirect_to;
}
