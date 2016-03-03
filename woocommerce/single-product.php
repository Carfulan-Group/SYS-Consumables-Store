<?php

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



<section id="single-product" class="row">
<div class="col-xs-12">
	<?php
		wc_print_notices();
	?>
</div>

	<div class="col-sm-8 vertical-padding-large">
		<h3>Overview</h3>
		<?php
			// // //
			// get description (this is the short description)
			// // //
			wc_get_template( 'single-product/short-description.php' );

			// // //
			// has weight
			// // //
			if ( $product->has_weight() ) : $has_row = true; ?>
			<p>
				<hr>
				<?php _e( '<strong>Weight', 'woocommerce' ) ?>
				<?php echo " :</strong> " . $product->get_weight() . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) ); ?>
			</p>
			<?php endif;

			// // //
			// has dimensions
			// // //
			if ( $product->has_dimensions() ) : $has_row = true; ?>
				<p>
					<hr>
					<?php _e( '<strong>Dimensions', 'woocommerce' ) ?>
					<?php echo " :</strong> " . $product->get_dimensions(); ?>
				</p>
			<?php endif;

			// // //
			// has SKU
			// // //
			if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

				<hr>
			<p><?php _e( '<strong>Product Code :</strong> ', 'woocommerce' ); ?> <?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></p>

			<?php endif;

			// // //
			// display categories
			// // //
			echo $product->get_categories( ', ', '<hr><p><strong>' . _n( 'Category :</strong>', 'Categories :</strong>', $cat_count, 'woocommerce' ) . ' ', '</p>' );

			// // //
			// display tags
			// // //
			echo $product->get_tags( ', ', '<hr><p><strong>' . _n( 'Tag :</strong>', 'Tags :</strong>', $tag_count, 'woocommerce' ) . ' ', '</p>' ); ?>
	</div>

	<div class="col-sm-4 vertical-padding-large">
		<h3>Price</h3>
		<?php
			echo "<div class='single-product-price-container'>";
				wc_get_template( 'single-product/price.php' );
			echo "</div>";

			wc_get_template( 'single-product/add-to-cart/simple.php' );
		?>
	</div>
</section>

<section id="single-after-product">
	<div class="single-product-up-sells">
		<?php
			wc_get_template( 'single-product/up-sells.php' );
		?>
	</div>
</section>

<?php
	endwhile;
	endif;
	get_footer('shop');
?>
