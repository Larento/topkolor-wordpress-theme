<?php get_header(); ?>
<main role="main">
  <?php
  if ( have_posts() ) {
    while ( have_posts() ) {
      ?>
	    <section class="tk-section post document">
		    <div class="container">
          <?php
          the_post(); 
          the_title( '<h3>', '</h3>' );
          the_excerpt();
          ?>
		    </div>
      </section>
      <?php
    };
  };
  ?>
</main>
<?php get_footer(); ?>