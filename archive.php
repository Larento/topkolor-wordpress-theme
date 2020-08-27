<?php use \tk\functions as tk; ?>
<?php get_header(); ?>
<main role="main">
  <?php
  tk\set_product_thumbnails();
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();
      ?>
        <section class="tk-section post document slider thumbnail">
          <div class="container slider thumbnail" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)">
          </div>
        </section>
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