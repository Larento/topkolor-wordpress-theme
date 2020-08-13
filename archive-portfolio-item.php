<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
    <?php 
      if ( have_posts() ) {
        while ( have_posts() ) {
          the_post(); 
          the_title( '<h3>', '</h3>' );
		      the_content();
        };
      };
    ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>