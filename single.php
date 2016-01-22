<?php get_header();

if ( have_posts() ){
	while ( have_posts() ){
		the_post();
		?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php
	}
}

get_footer(); ?>
