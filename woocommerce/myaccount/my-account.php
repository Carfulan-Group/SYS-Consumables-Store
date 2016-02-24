<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices(); ?>

<p class="myaccount_user">
	<span class="intro">
	<?php
		echo "<h3 style='margin:0;padding:0;'>Hello " . $current_user->user_firstname . "</h3><small>not " . $current_user->user_firstname . "? <a href='" . wp_logout_url() . "'>sign out.</a></small>"
	?> </span><br> <?php
	printf( __( '<br>From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
		wc_customer_edit_account_url()
	);

	?>
	<br><br>
</p>

<?php do_action( 'woocommerce_before_my_account' ); ?>


<div class="row">
	<div class="col-sm-6">
		<?php wc_get_template( 'myaccount/my-address.php' ); ?>
	</div>

	<div class="col-sm-6">
		<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>
		<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>
	</div>
</div>






<?php do_action( 'woocommerce_after_my_account' ); ?>
