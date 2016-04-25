<!DOCTYPE html>
<html <?php language_attributes (); ?>>

<head>
	<title><?php the_title (); ?> | <?php bloginfo ( $name ); ?></title>
	<meta charset="<?php bloginfo ( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo ( 'pingback_url' ); ?>">
	<!-- favicons -->
	<link rel="icon" type="image/x-icon" href="<?php echo site_url (); ?>/favicons/favicon.ico">
	<meta name="msapplication-TileColor" content="#0097d8">
	<meta name="theme-color" content="#0097d8">
	<!-- end of favicons -->
	<?php wp_head (); ?>
</head>

<body id="body">
<div id="smoothstate" class="m-scene">
	<div <?php body_class (); ?>>
		<header id="sys-header">
			<section id="upper-header">
				<div class="container">
					<div class="pull-left">
                    <span><a href="mailto:<?php echo do_shortcode ( '[easy_options id="email"]' ); ?>"><i
								class="icon-mail"></i><?php echo do_shortcode ( '[easy_options id="email"]' ); ?>
						</a></span>
					</div>
					<div class="pull-right">
						<span><i class="icon-phone"></i><?php echo do_shortcode ( '[easy_options id="phone"]' ); ?></span>
					</div>
				</div>
			</section>
			<section class="container">
				<div id="lower-header">
					<a href="<?php echo site_url (); ?>">
						<img src="<?php echo get_template_directory_uri (); ?>/assets/images/sys-logo-left-half.png" id="header-logo" class="pull-left loading" title="SYS Systems 3D Printing" alt="SYS Systems Logo Left Half">
						<img src="<?php echo get_template_directory_uri (); ?>/assets/images/sys-logo-right-half.png" id="header-logo" class="pull-left" title="SYS Systems 3D Printing" alt="SYS Systems Logo Right Half">
					</a>
					<nav id="main-menu">
						<?php

							if ( is_user_logged_in () )
								// // //
								// check if user is logged in
								// // //
							{
								?>
								<div id="burger">
									<span></span>
									<span></span>
									<span></span>
								</div>
								<?php
								wp_nav_menu ( array ( 'theme_location' => 'main-menu' ) );
							}

						?>
					</nav>
				</div>
			</section>
		</header>
		<div id="shade"></div>

		<main class="clear-head white container transit fade">