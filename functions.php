<?php
// // //
// add filters
// // //
add_filter('woocommerce_product_tabs', 'remove_review_tab', 98);
add_filter('woocommerce_billing_fields', 'set_billing_feilds');
add_filter('register_form', 'set_registration_fields');
add_filter('registration_errors', 'check_registration_errors', 10, 3);
add_filter('woocommerce_registration_redirect', 'after_registration_redirect');
add_filter('woocommerce_shipping_fields', 'set_shipping_fields');
add_filter('woocommerce_email_order_meta_keys', 'purchase_order_custom_field_order_meta_keys');
// add_filter('woocommerce_checkout_fields', 'set_checkout_fields');
add_filter('woocommerce_login_redirect', 'wc_login_redirect');
add_filter('woocommerce_enqueue_styles', '__return_empty_array');
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
add_filter( 'woocommerce_cart_item_thumbnail', '__return_empty_string' );
add_filter('woocommerce_available_variation', 'woocommerce_show_price_fix', 10, 3);

// // //
// add actions
// // //
add_action( 'init', 'machines' );
add_action('woocommerce_after_order_notes', 'purchase_order_custom_field');
add_action('woocommerce_checkout_update_user_meta', 'purchase_order_custom_field_update_user_meta');
add_action('woocommerce_checkout_process', 'purchase_order_custom_field_process');
add_action('woocommerce_checkout_update_order_meta', 'purchase_order_custom_field_update_order_meta');
add_action('new_customer_registered', 'new_customer_registered_send_email_admin');
add_action('wp_logout', 'redirect_after_logout');
add_action('woocommerce_created_customer', 'add_extra_registration_fields');
add_action('login_head', 'sys_login_logo');
add_action('after_setup_theme', 'woocommerce_support');
add_action('wp_enqueue_scripts', 'theme_scripts');

// // //
// remove actions
// // //
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

// // //
// fix to display price on variable products where all variables have the same price
// // //
function woocommerce_show_price_fix ($value, $object = null, $variation = null)
{
    if ($value['price_html'] == '')
    {
        $value['price_html'] =  $variation->get_price_html() . '</span>';
    }

    return $value;
};

// // //
// send admin new user emails
// // //
function new_customer_registered_send_email_admin($user_login) {
    ob_start();
    do_action('woocommerce_email_header', 'New customer registered');
    $email_header = ob_get_clean();
    ob_start();
    do_action('woocommerce_email_footer');
    $email_footer = ob_get_clean();

    woocommerce_mail(
    get_bloginfo('admin_email'),
    get_bloginfo('name').' - New customer registered',
    $email_header.'<p>The user "'.esc_html( $user_login ).'" made an account on the SYS Consumables Store, click <a href="' . admin_url() . '">here</a> to set up their account.</p>'.$email_footer
);
}

// // //
// declare woocommerce support
// // //
function woocommerce_support()
{
    add_theme_support('woocommerce');
}

// // //
// enqueue styles and scripts
// // //
function theme_scripts()
{
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/stylesheets/main.css');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/javascripts/build.js', array(
        'jquery'
    ), '1.0.5', true);
}

// // //
// register nav menus
// // //
register_nav_menu('main-menu', 'Main Menu');
register_nav_menu('footer-menu', 'Footer Menu');
register_nav_menu('footer-quick-links', 'Footer Quick Links');
register_nav_menu('lower-footer-menu', 'Lower Footer Menu');

// // //
// redirect to homepage after user registration
// // //
function after_registration_redirect($redirect_to)
{
    $redirect_to = site_url();
    return $redirect_to;
}

// // //
// change login logo
// // //
function sys_login_logo()
{
    echo '
<style type="text/css">
    h1 a
    {
        background-image: url(' . get_bloginfo('template_directory') . '/assets/images/sys-logo.png) !important;
        width:100%!important;
        background-size:auto!important;
    }
</style>';
}

// // //
// log out redirect for WooCommerce
// // //
function redirect_after_logout()
{
    wp_redirect(home_url());
    exit();
}

// // //
// force users to enter first and last name when signing up
// // //

// adding Registration fields to the form
function set_registration_fields()
{
    echo '
    <p>
        <div class="form-row form-row-wide">
            <input type="text" placeholder="First Name" class="input-text" name="firstname" id="reg_firstname" size="30" value="' . esc_attr($_POST['firstname']) . '" />
        </div>
    </p>';

}


// validation registration form  after submission using the filter registration_errors
function check_registration_errors($reg_errors, $sanitized_user_login, $user_email)
{
    global $woocommerce;
    extract($_POST); // extracting $_POST into separate variables
    if ($firstname == '') {
        $woocommerce->add_error(__('Please, fill in all the required fields.', 'woocommerce'));
    }
    return $reg_errors;
}

// updating use meta after registration successful registration

function add_extra_registration_fields($user_id)
{
    extract($_POST);
    update_user_meta($user_id, 'first_name', $firstname);

    // can also do multiple fields like that
    update_user_meta($user_id, 'first_name', $firstname);
    update_user_meta($user_id, 'billing_first_name', $firstname);
    update_user_meta($user_id, 'shipping_first_name', $firstname);
}

// // //
// remove review & description tabs from products
// // //
function remove_review_tab($tabs)
{

    unset($tabs['reviews']);

    return $tabs;
}

// // //
// remove fields from billing details
// // //
function set_billing_feilds($fields)
{
    unset($fields['billing_country']);
    unset($fields['billing_state']);
    unset($fields['billing_address_2']);

    return $fields;
}

// // //
// remove fields from shipping fields
// // //
function set_shipping_fields($fields)
{
    unset($fields['shipping_country']);

    add_filter('woocommerce_registration_redirect', 'woocommerce_register_redirect');
    return $fields;
}

// // //
// change the page user is taken to after login
// // //
function wc_login_redirect($redirect_to)
{
    $redirect_to = site_url();
    return $redirect_to;
}

// // //
// change the page user is taken to after registration
// // //
function woocommerce_register_redirect($redirect)
{
    $redirect = site_url();
    return $redirect;
}

// // //
// add p.o field to checkout
// // //
function purchase_order_custom_field( $checkout ) {

	echo '<div id="purchase_order_custom_field">';

	// // //
    // output the p.o field
    // // //
	woocommerce_form_field( 'purchase_order', array(
		'type' 			=> 'text',
		'required' 		=> true,
        'class' 		=> array('col-sm-4'),
		'label' 		=> __('Purchase Order Number'),
		'placeholder' 	=> __('P.O'),
    ), $checkout->get_value( 'purchase_order' ));

	echo '</div>';

}

// // //
// Process the checkout
// // //
function purchase_order_custom_field_process() {
	global $woocommerce;

		if (!$_POST['purchase_order']){
            wc_add_notice( sprintf( __( "Please enter a purchase order number.", "English" ) ) ,'error' );
        }

}

// // //
// save p.o value to user
// // //
function purchase_order_custom_field_update_user_meta( $user_id ) {
	if ($user_id && $_POST['purchase_order']) update_user_meta( $user_id, 'purchase_order', esc_attr($_POST['purchase_order']) );
}

// // //
// save p.o to order
// // //
function purchase_order_custom_field_update_order_meta( $order_id ) {
	if ($_POST['purchase_order']) update_post_meta( $order_id, 'Purchase Order', esc_attr($_POST['purchase_order']));
}

// // //
// add p.o to order emails
// // //
function purchase_order_custom_field_order_meta_keys( $keys ) {
	$keys[] = 'Purchase Order';
    echo "<h2>Additional Information</h2><li class='remove_p_height'>";
	return $keys;
    echo "</li>";
}

// // //
// adds machine taxonomy, this is for filtering on the shop page
// // //
function machines() {

    $labels = array(
        'name'                    => _x( 'Machines', 'Machines', 'machines' ),
        'singular_name'            => _x( 'Machine', 'Machine', 'machines' ),
        'search_items'            => __( 'Search Machines', 'machines' ),
        'popular_items'            => __( 'Popular Machines', 'machines' ),
        'all_items'                => __( 'All Machines', 'machines' ),
        'parent_item'            => __( 'Parent Machine', 'machines' ),
        'parent_item_colon'        => __( 'Parent Machine', 'machines' ),
        'edit_item'                => __( 'Edit Machine', 'machines' ),
        'update_item'            => __( 'Update Machine', 'machines' ),
        'add_new_item'            => __( 'Add New Machine', 'machines' ),
        'new_item_name'            => __( 'New Machine Name', 'machines' ),
        'add_or_remove_items'    => __( 'Add or remove Machines', 'machines' ),
        'choose_from_most_used'    => __( 'Choose from most used machines', 'machines' ),
        'menu_name'                => __( 'Machine', 'machines' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => false,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'taxonomy-slug', array( 'product' ), $args );
}