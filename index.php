<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
		<?php the_content(); ?>
		<code> <?php echo get_the_terms(get_the_ID(), 'product_style'); ?> </code>
		
		</div>
	</section>
</main>
<?php get_footer(); ?>
