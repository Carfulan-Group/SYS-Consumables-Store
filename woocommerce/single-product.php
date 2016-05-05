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
	 * @see        http://docs.woothemes.com/document/template-structure/
	 * @author        WooThemes
	 * @package    WooCommerce/Templates
	 * @version     1.6.4
	 */

	if ( !defined ( 'ABSPATH' ) )
	{
		exit; // Exit if accessed directly
	}

	get_header ( 'shop' );

	if ( have_posts () ):
		while ( have_posts () ):
			the_post ();

			woocommerce_breadcrumb ();
			?>

			<h1 class="page-title">
				<?php the_title (); ?>
			</h1>

			<section id="single-product" class="product row vertical-padding">

				<div class="col-xs-12 single__product__alert">
					<?php wc_print_notices (); ?>
				</div>

				<div class="col-sm-6 col-sm-push-3 vertical-padding">
					<h3>Overview</h3>
					<?php

						if ( !empty( $get_the_content ) )
						{
							echo $some_content;
						}
						else
						{
							echo "Sorry, this product has no description.";
						}

					?>
				</div>

				<div class="col-sm-3 col-sm-pull-6 vertical-padding">
					<h3>Details</h3>
					<?php
						woocommerce_template_single_meta ();
					?>
					<p><strong>Compatible with your:</strong></p>
					<ul>
						<?php
							echo "<li>";
							the_page_group_machines ( "</li><li>", "</li><li>" );
							echo "</li>";
						?>
					</ul>
				</div>

				<div class="col-sm-3 vertical-padding">
					<h3>Buy</h3>
					<?php woocommerce_template_single_add_to_cart (); ?>
				</div>

			</section>

			<section id="single-after-product">
				<h3 class="related-products-heading">Also compatible with your <?php

						/*
						 * The function get_available_machines_options (); has already been run above with
						 * the_available_machine_options(); This is why the array $page_machines is happy to work!
						 * */

						$count = 1;
						$all   = count ( $page_machines );
						if ( $all < 4 )
						{
							foreach ( $page_machines as $product )
							{
								if ( $count == 1 )
								{
									echo $product;
									$count++;
								}
								elseif ( $count == $all )
								{
									echo " and " . $product;
									$count++;
								}
								else
								{
									echo ", " . $product;
									$count++;
								}
							}
						}
						else
						{
							echo "machines";
						}
					?>:</h3>
				<?php

					$machines_tax = "";
					$count        = 0;

					foreach ( $page_machines as $tax )
					{

						if ( $count > 0 )
						{
							$machines_tax = strtolower ( $machines_tax . ',' . $tax );
						}
						else
						{
							$machines_tax = strtolower ( $machines_tax . $tax );
							$count++;
						}
					}

					/*
					 * Below is where we display our related products, only products with the
					 * same taxonomy-machines as the current product and current category will be shown.
					 * */

					$product_categories = array (
						'parts-accessories',
						'model-material',
						'support-material'
					);

					foreach ( $product_categories as $category )
					{
						$args = array (
							'post_type'         => 'product',
							'taxonomy-machines' => $machines_tax,
							'product_cat'       => $category,
							'posts_per_page'    => 4,
							'orderby'           => 'rand'
						);

						$loop = new WP_Query( $args );
						if ( $loop->have_posts () )
						{
							?>
							<div class="products">
								<h4 class="col-xs-12"><?php
										if ( $category == "parts-accessories" )
										{
											echo "Parts &amp; Accessories";
										}
										else
										{
											echo ucwords ( str_replace ( '-', ' ', $category ) );
										} ?></h4>
								<?php
									while ( $loop->have_posts () )
									{
										$loop->the_post ();
										wc_get_template_part ( 'content', 'product' );
									}
								?>
							</div> <!-- end .products -->
							<?php
						} // end if $loop->$have_posts
						wp_reset_query (); // Remember to reset

					} // end foreach category
				?>
			</section>
			<?php
		endwhile;
	endif;
	get_footer ( 'shop' );
?>
