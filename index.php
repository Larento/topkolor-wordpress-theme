<?php get_header(); ?>
<main role="main">
  <section class="tk-section hero">
    <div class="tk-slider">
    <?php tk_home_slideshow(); ?>
    </div>
    <h1>Превращаем камень в искусство</h1>
      <button class="tk-button">
        <span>Cool</span>
      </button>
  </section>
  <section class="tk-section commerce">
  <?php the_content(); ?>
  </section>
</main>
<?php get_footer(); ?>
