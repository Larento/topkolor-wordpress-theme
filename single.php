<?php get_header(); ?>
<?php use \tk\functions as tk; ?>
<main role="main">
  <section class="tk-section post document slider">
    <div class="container slider">
      <?php tk\product_attachments_slider(); ?>
    </div>
  </section>
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
		<?php the_content(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>