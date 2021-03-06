<?php
	get_header ();

	// // //
	// check if user is logged in
	// // //
	if ( is_user_logged_in () )
	{
?>

<?php

	// // //
	// get user id
	// // //
	$groups_user = new Groups_User( get_current_user_id () );

	// // //
	// if users has access to My Consumables group
	// // //
	if ( $groups_user->can ( 'My Consumables' ) )
	{
?>

<div class="page-title">
	<h1>Hello <?php echo $current_user->first_name; ?>,</h1>
	<?php
		$my_products = array ();
		$my_groups   = array ();

		query_posts ( array ( 'post_type' => 'product', 'posts_per_page' => '-1' ) );
		while ( have_posts () ): the_post ();
			get_page_group_machines ();
			foreach ( $page_machines as $machine )
			{
				$my_products[] = $machine;
			}
			foreach ( $page_groups as $group )
			{
				$my_groups[] = $group;
			}
		endwhile;

		$my_products = array_unique ( $my_products );
		$my_groups   = array_unique ( $my_groups );
	?>
	<h5>Here are some products compatible with your <?php
			$count = 1;
			$all   = count ( $my_products );
			if ( $all < 4 )
			{
				foreach ( $my_products as $product )
				{
					if ( $count == 1 )
					{
						echo $product;
						$count++;
					}
					elseif ( $count == $all )
					{
						echo " and ";
						echo $product;
						$count++;
					}
					else
					{
						echo ", ";
						echo $product;
						$count++;
					}
				}
			}
			else
			{
				echo "machines";
			}
		?>:</h5>
</div>

<section id="home-products" class="vertical-padding-large">
	<?php wc_print_notices (); ?>
	<section class="row">

		<div class="home-cat-selector col-lg-7">
			<ul>
				<li class="active" onclick="catSelect(this)" data-tab="all-cats">All</li>
				<li onclick="catSelect(this)" data-tab="model-cat">Model Materials</li>
				<li onclick="catSelect(this)" data-tab="support-cat">Support</li>
				<li onclick="catSelect(this)" data-tab="parts-accessories-cat">Parts</li>
			</ul>
		</div>
		<div class="home-search col-lg-5">
			<select class="home-search-select" onchange="filterByMachine(this)">
				<option selected="selected" value="0">All Machines</option>
				<?php
					foreach ( $my_groups as $group )
					{
						echo '<option value="' . $group . '">' . $group . '</option>';
					}
				?>
			</select>
			<input type="text" class="home__search__input" placeholder="Search" onkeyup="search.hideShow(this)">
		</div>
	</section>
	<div class="home-cat-container">
		<div class="home-cat all-cats model-cat">
			<h2 class="home__cat__title">Model Materials</h2>
			<?php
				sysProductLoop ( 'model-material', -1 );
			?>
		</div>
		<div class="home-cat all-cats support-cat">
			<h2 class="home__cat__title">Support Materials</h2>
			<?php
				sysProductLoop ( 'support-material', -1 );
			?>
		</div>
		<div class="home-cat all-cats parts-accessories-cat">
			<h2 class="home__cat__title">Parts &amp; Accessories</h2>
			<?php
				sysProductLoop ( 'parts-accessories', -1 );
			?>
		</div>
	</div>
	<?php
		}

		// // //
		// if user account has not been set up yet
		// // //
		else
		{
		echo "<h1 class='page-title'>Hello " . $current_user->user_firstname . "</h1>";
	?>
	<section id="home-products" class="vertical-padding-large">
		<?php wc_print_notices (); ?>

		<div class="row">
			<div class="col-md-6 col-sm-6">
				<p>Thanks for registering with SYS Systems. This is where consumables compatible with your machine/s will be displayed once our staff tailor your account.</p>
				<p>While you're waiting, why not finish setting up your account
					<a href="<?php echo site_url (); ?>/my-account/edit-address/billing/">here.</a>
				</p>
			</div>
			<div class="col-md-4 col-md-push-2 col-sm-6">
				<div class="alert alert-info">
					<h6>Need Help?</h6>
					<p>If you require our assistance, please get in touch using the details below:
					</p>
					<br>
					<p>
						<a href="mailto:<?php echo do_shortcode ( '[easy_options id="email"]' ); ?>">
							<i class="icon-mail"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo do_shortcode ( '[easy_options id="email"]' ); ?>
						</a>
					</p>
					<p>
						<a href="tel:<?php echo do_shortcode ( '[easy_options id="phone"]' ); ?>">
							<i class="icon-phone"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo do_shortcode ( '[easy_options id="phone"]' ); ?>
						</a>
					</p>
				</div>
				<h6>Opening Hours:</h6>
				<table class="table-hover">
					<tr>
						<td>Monday - Thursday</td>
						<td>8:00 - 4:30</td>
					</tr>
					<tr>
						<td>Friday</td>
						<td>8:00 - 4:00</td>
					</tr>
					<tr>
						<td>Saturday - Sunday</td>
						<td>Closed</td>
					</tr>
				</table>
			</div>


			<?php
				}
			?>
	</section>
	<?php
		}

		// // //
		// if user isn't logged in
		// // //
		else
		{
			?>
			<h1 class="page-title">SYS Systems Consumables Store</h1>
			<section id="home-login" class="vertical-padding-large">
				<?php
					echo do_shortcode ( '[woocommerce_my_account]' );
				?>
			</section>
			<?php
		}

		get_footer ();
	?>
