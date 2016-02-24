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

// // //
// change login logo
// // //
function custom_loginlogo ()
{
    echo '
<style type="text/css">
	h1 a
	{
		background-image: url(' . get_bloginfo ( 'template_directory' ) . '/assets/images/sys-logo.png) !important;
		width:100%!important;
		background-size:auto!important;}
</style>';
}

add_action ( 'login_head' , 'custom_loginlogo' );

// // //
// log out redirect for WooCommerce
// // //
add_action ( 'wp_logout' , 'go_home' );
function go_home ()
{
    wp_redirect ( home_url () );
    exit();
}

// // //
// force users to enter first and last name when signing up
// // //

// adding Registration fields to the form
add_filter ( 'register_form' , 'adding_custom_registration_fields' );
function adding_custom_registration_fields ()
{
    echo '
	<p>
		<div class="form-row form-row-wide">
			<input type="text" placeholder="First Name" class="input-text" name="firstname" id="reg_firstname" size="30" value="'
         . esc_attr ( $_POST[ 'firstname' ] ) . '" />
		</div>
	</p>';

}

// validation registration form  after submission using the filter registration_errors
add_filter ( 'registration_errors' , 'registration_errors_validation' , 10 , 3 );
function registration_errors_validation ( $reg_errors , $sanitized_user_login , $user_email )
{
    global $woocommerce;
    extract ( $_POST ); // extracting $_POST into separate variables
    if ($firstname == '') {
        $woocommerce->add_error ( __ ( 'Please, fill in all the required fields.' , 'woocommerce' ) );
    }
    return $reg_errors;
}

// updating use meta after registration successful registration
add_action ( 'woocommerce_created_customer' , 'adding_extra_reg_fields' );

function adding_extra_reg_fields ( $user_id )
{
    extract ( $_POST );
    update_user_meta ( $user_id , 'first_name' , $firstname );

    // can also do multiple fields like that
    update_user_meta ( $user_id , 'first_name' , $firstname );
    update_user_meta ( $user_id , 'billing_first_name' , $firstname );
    update_user_meta ( $user_id , 'shipping_first_name' , $firstname );
}

// // //
// remove review & description tabs from products
// // //
add_filter ( 'woocommerce_product_tabs' , 'sb_woo_remove_reviews_tab' , 98 );
function sb_woo_remove_reviews_tab ( $tabs )
{

    unset( $tabs[ 'reviews' ] );
    unset( $tabs[ 'description' ] );

    return $tabs;
}

// // //
// remove fields from billing details
// // //
function billing_fields ( $fields )
{
    unset( $fields[ 'billing_country' ] );
    unset( $fields[ 'billing_state' ] );
    unset( $fields[ 'billing_address_2' ] );

    return $fields;
}

add_filter ( 'woocommerce_billing_fields' , 'billing_fields' );

// // //
// remove fields from shipping fields
// // //
function shipping_fields ( $fields )
{
    unset( $fields[ 'shipping_country' ] );

    return $fields;
}

add_filter ( 'woocommerce_shipping_fields' , 'shipping_fields' );

// // //
// add in purchase order field
// // //
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

add_filter ( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// // //
// change the page user is taken to after login
// // //
function wc_login_redirect( $redirect_to )
{
    $redirect_to = site_url();
    return $redirect_to;
}

add_filter('woocommerce_login_redirect', 'wc_login_redirect');

// // //
// change the page user is taken to after registration
// // //
function woocommerce_register_redirect( $redirect ) {
     $redirect = 'http://google.com/';
     return $redirect;
}

add_filter('woocommerce_registration_redirect', 'woocommerce_register_redirect');
