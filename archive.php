<?php get_header(); ?>
<main role="main">
  <?php
  tk_set_product_thumbnails();
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();
      the_post_thumbnail();
      ?>
        <section class="tk-section post document">
          <div class="container">
            <?php
              
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