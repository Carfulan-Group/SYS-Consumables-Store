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


// Hook in
add_filter ( 'woocommerce_billing_fields' , 'billing_fields' );

// Our hooked in function - $fields is passed via the filter!
function billing_fields ( $fields )
{
    unset( $fields[ 'billing_country' ] );

    return $fields;
}

// Hook in
add_filter ( 'woocommerce_shipping_fields' , 'shipping_fields' );

// Our hooked in function - $fields is passed via the filter!
function shipping_fields ( $fields )
{
    unset( $fields[ 'shipping_country' ] );

    return $fields;
}


// add in p.o

// Hook in
add_filter ( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields ( $fields )
{
    $fields[ 'billing' ][ 'checkout_purchase_order' ] = array (
        'label' => __ ( 'Purchase Order' , 'woocommerce' ) ,
        'placeholder' => _x ( 'Purchase Order' , 'placeholder' , 'woocommerce' ) ,
        'required' => true ,
        'class' => array ( 'form-row-wide' ) ,
        'clear' => true
    );
    return $fields;
}


add_filter ( 'woocommerce_checkout_fields' , 'remove_payment_field' );
// Our hooked in function - $fields is passed via the filter!
function remove_payment_field ( $fields )
{
    unset( $fields[ 'payment_method_cheque' ] );

    return $fields;
}


// /**
//  * Add the field to order emails
//  **/
// add_filter('woocommerce_email_order_meta_keys', 'my_woocommerce_email_order_meta_keys');

// function my_woocommerce_email_order_meta_keys( $keys ) {
// 	$keys['Purchase Order Number'] = 'checkout_purchase_order';
// 	return $keys;
// }