<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
		<?php the_content(); ?>
		<code> <?php echo get_post_type_archive_link( "portfolio_item" ) ?> </code>
		<code> <?php echo var_export($tk_register) ?> </code>
		</div>
	</section>
</main>
<?php get_footer(); ?>
