<?php get_header(); ?>
<main role="main">
  <section class="tk-section post document">
    <div class="container">
      <h3>Why hello there, 'tis an archive page!</h3>
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