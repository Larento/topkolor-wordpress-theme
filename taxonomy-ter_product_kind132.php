<?php use \tk\functions as tk; ?>
<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
    <h3>Это архив для стилей</h3>
		</div>
	</section>
	<?php
  if ( have_posts() ) {
    while ( have_posts() ) {
      ?>
	    <section class="tk-section post document">
		    <div class="container">
          <?php
          the_post(); 
          the_title( '<h3>', '</h3>' );
          the_content();
          ?>
		    </div>
      </section>
      <?php
    };
  };
  ?>
</main>
<?php get_footer(); ?>