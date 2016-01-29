<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>
<p>Here you can edit your account details, please leave details you do not wish to change.</p>
<form class="edit-account" action="" method="post">

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
<div class="row">

	<div class="col-sm-6">
	<h2>Change Details</h2>
		<p class="form-row form-row-first">
			<input type="text" placeholder="First Name" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</p>
		<p class="form-row form-row-last">
			<input type="text" placeholder="Last Name" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</p>
		<div class="clear"></div>

		<p class="form-row form-row-wide">
			<input type="email" placeholder="Email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</p>
	</div>

	<div class="col-sm-6">
	<h2>Change Password</h2>
		<fieldset>

			<p class="form-row form-row-wide">
				<input type="password" placeholder="Current Password" class="input-text" name="password_current" id="password_current" />
			</p>
			<p class="form-row form-row-wide">
				<input type="password" placeholder="New Password" class="input-text" name="password_1" id="password_1" />
			</p>
			<p class="form-row form-row-wide">
				<input type="password" placeholder="Confirm New Password" class="input-text" name="password_2" id="password_2" />
			</p>
		</fieldset>
	</div>

</div>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</form>
