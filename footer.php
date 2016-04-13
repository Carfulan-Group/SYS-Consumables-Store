</main>
<footer>
	<section id="upper-footer" class="container">
		<div class="row">
			<div id="footer-contact" class="col-md-3 col-sm-6">
				<h6>Contact Us</h6>
				<?php
					echo do_shortcode ( '[easy_options id="address"]' );
					echo "Call: ";
					echo do_shortcode ( '[easy_options id="phone"]' );
				?>
			</div>
			<div class="col-md-3 col-md-push-6 col-sm-6 footer-menu">
				<h6>Quick Links</h6>
				<?php wp_nav_menu ( array ( 'theme_location' => 'footer-quick-links' ) );
					if ( is_user_logged_in () ) : ?>
						<a href="<?php echo wp_logout_url (); ?>">Log Out</a>
						<?php
					endif;
				?>
			</div>
		</div>
	</section>
	<section id="lower-footer">
		<section class="container">
			<div class="row">
				<div id="lower-footer-menu" class="col-sm-8">
					<p>&copy; <?php echo do_shortcode ( '[easy_options id="company_name"]' );
							echo " ";
							echo date ( Y ); ?></p>
					<?php wp_nav_menu ( array ( 'theme_location' => 'lower-footer-menu' ) ); ?>
				</div>
				<div id="lower-footer-carfulan" class="col-sm-4">
					<a href="http://carfulan.com" title="Visit the Carfulan Group" target="_blank">
						<p>A Carfulan Group Company</p>
						<img src="<?php echo get_template_directory_uri (); ?>/assets/images/carfulan-group-logo.png" alt="Carfulan Group Logo">
					</a>
				</div>
			</div>
		</section>
	</section>
</footer>

<?php wp_footer (); ?>
</div> <!-- end of body class -->
</div> <!-- end of #smoothstate -->
</body>
</html>