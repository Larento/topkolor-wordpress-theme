<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
		<?php the_content(); ?>
		<?= var_dump(tk_get_current_product()) ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
