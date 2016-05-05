<?php
	/*
	* SYS loop__product loop
	*
	* We need this so that we can add whatever we like in terms of classes, data attributes etc
	* */

	function sysProductLoop ( $category_name, $number_posts )
	{
		if ( empty( $number_posts ) )
		{
			$number_posts = -1;
		}

		$args = array (
			'showposts'   => $number_posts,
			'product_cat' => $category_name,
			'post_type'   => 'product'
		);

		$loop = new WP_Query( $args );

		if ( $loop->have_posts () )
		{
			?>
			<section class="loop__products masonry__grid">
				<?php
					while ( $loop->have_posts () )
					{
						$loop->the_post ();

						// gets the loop__product info
						$product       = new WC_Product( get_the_ID () );
						$product_price = $product->get_price_html ();

						// gets the group info
						$groups      = new Groups_Post_Access();
						$groups_post = $groups->get_read_post_capabilities ( get_the_ID () );

						?>
						<div class="loop__product masonry__item"<?php
							// adds all groups applied to loop__product to the attribute 'data-machines'
							if ( !empty( $groups ) )
							{
								$x = 0;
								echo 'data-machines="';
								foreach ( $groups_post as $group )
								{
									if ( $x > 0 )
									{
										echo " ";
									}
									else
									{
										$x++;
									}
									$group_sort = strtolower ( str_replace ( ' ', '-', $group ) );
									echo $group_sort;
								}
								echo '"';
							}
						?>>
							<a href="<?php the_permalink (); ?>" class="loop__product__link">

								<?php
									// if loop__product has image
									if ( get_the_post_thumbnail () )
									{

										// get loop__product image
										$url = wp_get_attachment_image_src ( get_post_thumbnail_id ( $post->ID ), 'medium' );
										?>

										<div class="loop__product__image__container">
											<img src="<?php echo $url[ 0 ]; ?>" alt="<?php the_title (); ?> image" class="loop__product__image">
										</div>

										<?php
									}
								?>

								<div class="loop__product__header">
									<div class="row">
										<div class="col-xs-7">
											<h2 class="loop__product__title"><?php the_title (); ?></h2>
										</div>
										<div class="col-xs-5">
											<p class="loop__product__price"><?php echo $product_price; ?></p>
										</div>
									</div>
								</div>

								<?php
									if ( get_the_excerpt () )
									{
										$x = get_the_excerpt ();
										echo '<p class="loop__product__excerpt">' . $x . '</p>';
									}
								?>
							</a>
						</div>
						<?php
					} // END | While $loop->have_posts();
				?>
			</section>
			<?php
		} // END | If $loop->have_posts()

		// to make sure that any wp_query's after don't use the same $args
		wp_reset_query ();
	}