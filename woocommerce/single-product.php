<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


	get_header('shop');

	if ( have_posts() ):
		while ( have_posts() ):
			the_post();

			woocommerce_breadcrumb();
?>

<h1 class="page-title">
	<?php the_title(); ?>
</h1>

<section id="single-product" class="product row vertical-padding">

	<div class="col-xs-12">
		<?php wc_print_notices(); ?>
	</div>

	<div class="col-sm-6 col-sm-push-3 vertical-padding">
		<h3>Overview</h3>
		<?php
		$x = get_the_content();
		if ( $x != '' )
		{
			the_content();
		} else {
			echo "Sorry, this product has no description.";
		}

		?>
	</div>

    <div class="col-sm-3 col-sm-pull-6 vertical-padding">
        <h3>Details</h3>
        <?php woocommerce_template_single_meta(); ?>
    </div>

	<div class="col-sm-3 vertical-padding">
		<h3>Buy</h3>
		<?php woocommerce_template_single_add_to_cart(); ?>
	</div>

</section>

<section id="single-after-product">
	<div class="single-product-up-sells">
		<?php
			woocommerce_output_related_products();
		?>
	</div>
</section>

<?php
	endwhile;
	endif;
	get_footer('shop');
?>
