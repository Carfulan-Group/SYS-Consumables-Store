<?php
get_header();

if ( is_user_logged_in() ) {
	echo "<h1 class='page-title'>Hello " . $current_user->user_firstname . ", here's a list of compatible products:</h1>";
	?>
	<section id="home-products" class="vertical-padding-large">
	<div class="home-cat-selector">
		<ul>
			<li class="active" data-tab="all-cats">All</li>
			<li data-tab="model-cat">Model Materials</li>
			<li data-tab="support-cat">Support</li>
			<li data-tab="hardware-cat">Hardware</li>
		</ul>
	</div>
	<div class="home-cat-container">
		<div class="home-cat all-cats model-cat">
			<h2>Model Materials</h2>
			<?php echo do_shortcode('[product_category category="model material"]'); ?>
		</div>
		<div class="home-cat all-cats support-cat">
			<h2>Support Materials</h2>
			<?php echo do_shortcode('[product_category category="support material"]'); ?>
		</div>
		<div class="home-cat all-cats hardware-cat">
			<h2>Printing Hardware</h2>
			<?php echo do_shortcode('[product_category category="hardware"]'); ?>
		</div>
	</div>
	</section>
	<?php
} else {
	?>
	<h1 class="page-title">Welcome to the SYS Systems Consumables store</h1>
	<section id="home-login" class="vertical-padding-large">
	<p>In order to browse through a tailored list of available consumables, please log in:</p>
		<?php
		echo do_shortcode('[woocommerce_my_account]');
		?>
	</section>
<?php
}

get_footer();
?>
