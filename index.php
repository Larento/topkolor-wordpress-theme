<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
		<?php the_content(); ?>
		<code> <?php echo tk_post_type_name($product_types['Терраццо']['slug']) ?> </code>
		<code> <?php echo get_post_type_archive_link( tk_post_type_name($product_types['Терраццо']['slug']) ) ?> </code>
		</div>
	</section>
</main>
<?php get_footer(); ?>
