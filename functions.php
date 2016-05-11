<?php

	/*
	* Add Filters
	* */
	add_filter ( 'wc_add_to_cart_message', 'custom_add_to_cart_message' );
	add_filter ( 'woocommerce_product_tabs', 'remove_review_tab', 98 );
	add_filter ( 'woocommerce_billing_fields', 'set_billing_fields' );
	add_filter ( 'woocommerce_shipping_fields', 'set_shipping_fields' );
	add_filter ( 'register_form', 'set_registration_fields' );
	add_filter ( 'registration_errors', 'check_registration_errors', 10, 3 );
	add_filter ( 'woocommerce_registration_redirect', 'after_registration_redirect' );
	add_filter ( 'woocommerce_login_redirect', 'wc_login_redirect' );
	add_filter ( 'woocommerce_enqueue_styles', '__return_empty_array' );
	add_filter ( 'woocommerce_enable_order_notes_field', '__return_false' );
	add_filter ( 'woocommerce_cart_item_thumbnail', '__return_empty_string' );
	add_filter ( 'woocommerce_available_variation', 'woocommerce_show_price_fix', 10, 3 );
	add_filter ( 'woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect_function' );
	add_filter ( 'excerpt_more', 'excerpt_more_text_mod' );
	add_filter ( 'excerpt_length', 'excerpt_length_change', 999 );

	/*
	* Add Actions
	* */
	add_action ( 'new_customer_registered', 'new_customer_registered_send_email_admin' );
	add_action ( 'wp_logout', 'redirect_after_logout' );
	add_action ( 'woocommerce_created_customer', 'add_extra_registration_fields' );
	add_action ( 'login_head', 'sys_login_logo' );
	add_action ( 'after_setup_theme', 'woocommerce_support' );
	add_action ( 'wp_enqueue_scripts', 'theme_scripts' );

	/*
	* Add Theme SupportSupport
	* */
	add_theme_support ( 'post_thumbnails' );

	/*
	* Remove Actions
	* */
	remove_action ( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
	remove_action ( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action ( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action ( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

	/*
	* includes
	* */
	include ( 'sys-product-loop.php' );

	/**
	 * Filter the excerpt "read more" string.
	 *
	 * @param string $more "Read more" excerpt string.
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
	function excerpt_more_text_mod ( $more )
	{
		return '';
	}

	/**
	 * Filter the except length to 20 characters.
	 *
	 * @param int $length Excerpt length.
	 * @return int (Maybe) modified excerpt length.
	 */
	function excerpt_length_change ( $length )
	{
		return 15;
	}

	/*
	* fix to display price on variable products where all variables have the same price
	* */
	function woocommerce_show_price_fix ( $value, $object = null, $variation = null )
	{
		if ( $value[ 'price_html' ] == '' )
		{
			$value[ 'price_html' ] = $variation->get_price_html () . '</span>';
		}

		return $value;
	}

	/*
	* Get a list of machines that work with the users groups
	* and taxonomy-machines on the current page
	*/
	function get_page_group_machines ()
	{
		/*
		* This is where we initiate out variables!
		*
		* $page_machines is the array in which the list of user accessible
		* machine names will be stored, you will want to display this
		*
		* $groups stores all of the ithinxx groups the user has
		* access to, these are set in wp-admin and have matching capabilities
		* applied to products and other pages that require restricted access
		*
		* $taxonomy_machines gets all the the machine tags applied to a post
		* the machines stored in $taxonomy_machines are not necessarily
		* available to the user
		* */
		global $page_machines;
		global $page_groups;
		$page_machines     = array ();
		$page_groups       = array ();
		$groups_user       = new Groups_User( get_current_user_id () );
		$groups            = $groups_user->__get ( 'groups' );
		$taxonomy_machines = get_the_terms ( $post->ID, 'taxonomy-machines' );

		/*
		* This function loops through all of the groups collected above
		* and within these groups, loops through all of the machine tags
		* applied to the post/product/page
		* */
		foreach ( $groups as $group )
		{
			/*
			* Loops through each machine name applied to post
			* */
			foreach ( $taxonomy_machines as $machine )
			{
				/*
				* Get the names of current ( in loop ) group and machine
				* */
				$machine_name = $machine->name;
				$group_name   = $group->name;

				/*
				* Replaces spaces with "-" and makes lowercase for comparing against $group_name_sort
				* */
				$machine_name_sort = strtolower ( $machine_name );
				$machine_name_sort = str_replace ( " ", "-", $machine_name_sort );

				/*
				* Replace spaces with "-" and makes lowercase for comparing against $machine_name_sort.
				* Also removes the part after the machine name in $group_name_sort.
				* */
				$group_name_sort = strtolower ( $group_name );
				$group_name_sort = str_replace ( " ", "-", $group_name_sort );

				if ( strpos ( $group_name_sort, '|' ) )
				{
					$group_name_sort = str_replace ( "-|-", "|", $group_name_sort );
					$group_name_sort = strstr ( $group_name_sort, '|', true );
				}

				if ( $machine_name_sort == $group_name_sort )
				{
					$page_machines[] = $machine_name;
					$page_groups[]   = $group_name;
				}
			}
		}

		/*
		* This removes all the duplicate machine values
		* stored within $page_machines so that they can
		* be loop cleanly :)
		* */
		$page_machines = array_unique ( $page_machines );
		$page_groups   = array_unique ( $page_groups );
	}

	/*
	* Displays a list separated by $split of the machines a user
	* has access to that are also assigned to the current page
	*/
	function the_page_group_machines ( $split, $split_last )
	{
		global $page_machines;
		get_page_group_machines ();
// for each $page_machine in array, display name
		$count  = 1;
		$length = count ( $page_machines );
		foreach ( $page_machines as $machines )
		{
			if ( $count == 1 )
			{
				echo $machines;
				$count = $count + 1;
			}
			elseif ( $count == $length )
			{
				echo $split_last;
				echo $machines;
			}
			else
			{
				echo $split;
				echo $machines;
				$count = $count + 1;
			}
		}
	}

	/*
	* Displays a list separated by $split of the groups a user
	* has access to that are also assigned to the current page
	*/
	function the_page_groups ( $split, $split_last )
	{
		global $page_groups;
		get_page_group_machines ();
// for each $page_machine in array, display name
		$count  = 1;
		$length = count ( $page_groups );
		foreach ( $page_groups as $groups )
		{
			if ( $count == 1 )
			{
				echo $groups;
				$count = $count + 1;
			}
			elseif ( $count == $length )
			{
				echo $split_last;
				echo $groups;
			}
			else
			{
				echo $split;
				echo $groups;
				$count = $count + 1;
			}
		}
	}

// // //
// send admin new user emails
// // //
	function new_customer_registered_send_email_admin ( $user_login )
	{
		ob_start ();
		do_action ( 'woocommerce_email_header', 'New customer registered' );
		$email_header = ob_get_clean ();
		ob_start ();
		do_action ( 'woocommerce_email_footer' );
		$email_footer = ob_get_clean ();
		wc_mail (
			get_bloginfo ( 'admin_email' ),
			get_bloginfo ( 'name' ) . ' - New customer registered',
			$email_header . '<p>The user "' . esc_html ( $user_login ) . '" made an account on the SYS Consumables Store, click <a href="' . admin_url () . 'users.php?role=customer">here</a> to set up their account.</p>' . $email_footer
		);
	}

// // //
// declare woocommerce support
// // //
	function woocommerce_support ()
	{
		add_theme_support ( 'woocommerce' );
	}

// // //
// enqueue styles and scripts
// // //
	function theme_scripts ()
	{
		wp_enqueue_style ( 'main-css', get_template_directory_uri () . '/assets/stylesheets/main.css' );
		wp_enqueue_script (
			'main-js', get_template_directory_uri () . '/assets/javascripts/build.js', array (
			'jquery'
		), '1.0.5', true
		);
	}

// // //
// register nav menus
// // //
	register_nav_menu ( 'main-menu', 'Main Menu' );
	register_nav_menu ( 'footer-menu', 'Footer Menu' );
	register_nav_menu ( 'footer-quick-links', 'Footer Quick Links' );
	register_nav_menu ( 'lower-footer-menu', 'Lower Footer Menu' );
// // //
// redirect to homepage after user registration
// // //
	function after_registration_redirect ( $redirect_to )
	{
		$redirect_to = site_url ();

		return $redirect_to;
	}

// // //
// change login logo
// // //
	function sys_login_logo ()
	{
		echo '
<style type="text/css">
h1 a
{
background-image: url(' . get_bloginfo ( 'template_directory' ) . '/assets/images/sys-logo.png) !important;
width:100%!important;
background-size:auto!important;
}
</style>';
	}

// // //
// log out redirect for WooCommerce
// // //
	function redirect_after_logout ()
	{
		wp_redirect ( home_url () );
		exit();
	}

// // //
// force users to enter first and last name when signing up
// // //
// adding Registration fields to the form
	function set_registration_fields ()
	{
		echo '
<p>
<div class="form-row form-row-wide">
<input type="text" placeholder="First Name" class="input-text" name="firstname" id="reg_firstname" size="30" value="' . esc_attr ( $_POST[ 'firstname' ] ) . '" />
</div>
</p>';
	}

// validation registration form  after submission using the filter registration_errors
	function check_registration_errors ( $reg_errors, $sanitized_user_login, $user_email )
	{
		global $woocommerce;
		extract ( $_POST ); // extracting $_POST into separate variables
		if ( $firstname == '' )
		{
			$woocommerce->add_error ( __ ( 'Please, fill in all the required fields.', 'woocommerce' ) );
		}

		return $reg_errors;
	}

// updating use meta after registration successful registration
	function add_extra_registration_fields ( $user_id )
	{
		extract ( $_POST );
		update_user_meta ( $user_id, 'first_name', $firstname );
// can also do multiple fields like that
		update_user_meta ( $user_id, 'first_name', $firstname );
		update_user_meta ( $user_id, 'billing_first_name', $firstname );
		update_user_meta ( $user_id, 'shipping_first_name', $firstname );
	}

// // //
// remove review & description tabs from products
// // //
	function remove_review_tab ( $tabs )
	{
		unset( $tabs[ 'reviews' ] );

		return $tabs;
	}

// // //
// remove fields from billing details
// // //
	function set_billing_fields ( $fields )
	{
//		unset( $fields[ 'billing_country' ] );
		unset( $fields[ 'billing_state' ] );
		unset( $fields[ 'billing_address_2' ] );

		return $fields;
	}

// // //
// remove fields from shipping details
// // //
	function set_shipping_fields ( $fields )
	{

		unset( $fields[ 'shipping_state' ] );
		unset( $fields[ 'shipping_address_2' ] );

		return $fields;
	}

// // //
// change the page user is taken to after login
// // //
	function wc_login_redirect ( $redirect_to )
	{
		$redirect_to = site_url ();

		return $redirect_to;
	}

// // //
// change the page user is taken to after registration
// // //
	function woocommerce_register_redirect ()
	{
		$redirect = site_url ();

		return $redirect;
	}

	function custom_add_to_cart_redirect_function ()
	{
		return '';
	}

	function custom_add_to_cart_message ()
	{
		$message = "<div class='clearfix'>
<p class='alert__text--left'>
<a href='" . site_url () . "'>Continue Shopping</a>
&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
<a href='" . site_url () . "/cart'>View Basket</a>
</p>

<p class='alert__text--right'>This product has been added to your shopping cart.</p>
</div>";

		return $message;
	}