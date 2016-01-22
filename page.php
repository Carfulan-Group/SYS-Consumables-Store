<?php get_header();

if ( have_posts() ){
	while ( have_posts() ){
		the_post();
		?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<section class="vertical-padding-large">
			<?php the_content(); ?>
		</section>
		<?php
	}
}

get_footer(); ?>
