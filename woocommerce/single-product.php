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

<section id="single-product" class="row vertical-padding">

	<div class="col-xs-12">
		<?php
			wc_print_notices();
		?>
	</div>

	<div class="col-sm-6 col-sm-push-3 vertical-padding">
		<h3>Overview</h3>
		<?php the_content(); ?>
	</div>

    <div class="col-sm-3 col-sm-pull-6 vertical-padding">
        <h3>Details</h3>
        <?php woocommerce_template_single_meta(); ?>
    </div>

	<div class="col-sm-3 vertical-padding">
		<h3>Cart</h3>
		<?php
			woocommerce_template_single_add_to_cart();
		?>
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
