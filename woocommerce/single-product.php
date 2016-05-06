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

				<?php
					if ( has_post_thumbnail () )
					{
						?>
						<div class="single__product__image col-sm-3 vertical-padding">
							<img onclick="lightbox.open()" data-layzr="<?php the_post_thumbnail_url ( 'medium' ); ?>" alt="<?php the_title (); ?> Image">
							<div class="lightbox" onclick="lightbox.close()">
								<img class="lightbox__image" data-layzr="<?php the_post_thumbnail_url ( 'full' ); ?>" alt="Large <?php the_title (); ?> Image">
							</div>
						</div>

						<?php
						$overview_width = "col-sm-6";
					}
					else
					{
						$overview_width = "col-sm-9";
					}
				?>

				<div class="single__product__overview <?php echo $overview_width; ?> vertical-padding">
					<h3>Overview</h3>
					<div class="row">
						<div class="col-md-7">
							<!-- product description -->
							<p><strong>Description:</strong></p>
							<?php
								if ( get_the_content () )
								{
									the_content ();
								}
								else
								{
									echo "<p>Sorry, this product has no description.</p>";
								}
							?>
						</div>

						<!-- product meta -->
						<div class="col-md-5">
							<?php
								woocommerce_template_single_meta ();
							?>
							<!-- product compatibility -->
							<p><strong>Compatible with your:</strong></p>
							<ul class="single__product__compatible__list">
								<?php
									echo "<li>";
									the_page_groups ( "</li><li>", "</li><li>" );
									echo "</li>";
								?>
							</ul>
						</div>
					</div>
				</div>

				<div class="single__product__buy col-sm-3 vertical-padding">
					<h3>Buy</h3>
					<?php woocommerce_template_single_add_to_cart (); ?>
				</div>

			</section>
			<?php
		endwhile;
	endif;
	get_footer ( 'shop' );
?>
