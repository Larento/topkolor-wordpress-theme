<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
    <?php tk_product_attachments_slider(); ?>
		<?php the_content(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>