<?php
	/**
	 * Customer new account email
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
	 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
	 * as little as possible, but it does happen. When this occurs the version of the template file will.
	 * be bumped and the readme will list any important changes.
	 *
	 * @see        http://docs.woothemes.com/document/template-structure/
	 * @author        WooThemes
	 * @package    WooCommerce/Templates/Emails
	 * @version     1.6.4
	 */

	if ( !defined ( 'ABSPATH' ) )
	{
		exit; // Exit if accessed directly
	}

?>

<?php do_action ( 'woocommerce_email_header', $email_heading, $email ); ?>

<p>Thanks for registering on our consumables store,</p>

<p>If you're seeing this and don't remember signing up for an account don't be alarmed! We set up accounts for all of our new customers so we can tailor them to the machines you own and ensure you don't purchase the wrong parts.</p>

<p>You can visit the store
	<a href="<?php echo site_url (); ?>">here</a> and log in using your email address and the password below:</p>


<?php if ( 'yes' === get_option ( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>

	<p><?php printf ( __ ( "Password: <strong>%s</strong>", 'woocommerce' ), esc_html ( $user_pass ) ); ?></p>

<?php endif; ?>

<?php do_action ( 'woocommerce_email_footer', $email ); ?>

<?php do_action ( 'new_customer_registered', $user_login ); ?>
