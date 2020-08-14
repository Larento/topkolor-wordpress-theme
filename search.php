<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
    <h3>Результаты поиска</h3>
    <?php get_search_form(); ?>
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
          the_excerpt();
          ?>
		    </div>
      </section>
      <?php
    };
  } else {
    ?>
	    <section class="tk-section post document">
		    <div class="container">
          <h4>К сожалению, по данному запросу ничего не найдено.</h4>
		    </div>
      </section>
      <?php
  };
  ?>
</main>
<?php get_footer(); ?>