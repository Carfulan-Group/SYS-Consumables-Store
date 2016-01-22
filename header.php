<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500italic,500' rel='stylesheet' type='text/css'>
	<title><?php the_title(); ?> | SYS Systems Consumables Store</title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- favicons -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url(); ?>/favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?php echo site_url(); ?>/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo site_url(); ?>/favicons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php echo site_url(); ?>/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo site_url(); ?>/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo site_url(); ?>/favicons/manifest.json">
	<link rel="mask-icon" href="<?php echo site_url(); ?>/favicons/safari-pinned-tab.svg" color="#0097d8">
	<link rel="shortcut icon" href="<?php echo site_url(); ?>/favicons/favicon.ico">
	<meta name="msapplication-TileColor" content="#0097d8">
	<meta name="msapplication-TileImage" content="<?php echo site_url(); ?>/favicons/mstile-144x144.png">
	<meta name="msapplication-config" content="<?php echo site_url(); ?>/favicons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<!-- end of favicons -->
	<?php wp_head(); ?>
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</head>
<body <?php body_class(); ?>>
<header id="sys-header">
	<section id="upper-header">
		<div class="container">
			<div class="pull-left">
				<span><a href="mailto:<?php echo do_shortcode('[easy_options id="email"]'); ?>"><i class="icon-mail"></i><?php echo do_shortcode('[easy_options id="email"]'); ?></a></span>
			</div>
			<div class="pull-right">
				<span><i class="icon-phone"></i><?php echo do_shortcode('[easy_options id="phone"]'); ?></span>
			</div>
		</div>
	</section>
	<section class="container">
		<div id="lower-header">
			<a href="<?php echo site_url(); ?>">
				<img data-layzr="<?php echo get_template_directory_uri(); ?>/assets/images/sys-logo.png" id="header-logo" class="pull-left" title="SYS Systems 3D Printing" alt="SYS Systems Logo">
			</a>
			<nav id="main-menu">
				<div id="burger">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<?php wp_nav_menu( array('theme_location' => 'main-menu' ) ); ?>
			</nav>
		</div>
	</section>
</header>
<div id="shade"></div>
<main class="clear-head white container">
