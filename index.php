<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
		<?php the_content(); ?>
		<?php
			$product = tk_get_current_product();
			$bruh = tk_get_current_product_kind($product);
			$bruh = tk_get_product_label($product);
			echo var_dump($bruh); 
		?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
