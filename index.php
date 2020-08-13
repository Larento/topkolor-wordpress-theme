<?php get_header(); ?>

<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<h3><?php get_the_title(); ?></h3>
		<?php the_content(); ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
