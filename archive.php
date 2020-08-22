<?php get_header(); ?>
<main role="main">
  <?php
  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();
      ?>
        <a href=<?= the_permalink() ?>>
          <section class="tk-section post document">
            <div class="container">
              <?php
                the_title( '<h3>', '</h3>' );
                the_excerpt();
              ?>
            </div>
          </section>
        </a>
      <?php
    };
  };
  ?>
</main>
<?php get_footer(); ?>