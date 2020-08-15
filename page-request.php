<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
		<?php the_title( '<h3>', '</h3>' ); ?>
    <h4>There will be a form here</h4>
    <form action="/request?success=true">
      <div class="style">
        <p>Стиль изделия:</p>
        <?php
          $post_types = get_post_types( ['description'  => 'Product',], 'objects' );
          $taxonomy_slug = [];
          foreach ( $post_types as $post_type ) {
            $post_slug = $post_type->name;
            $post_label = $post_type->labels->all_items;
            $taxonomy_slug[$post_slug] = tk_taxonomy_name('', $post_slug);
            ?>
              <input type="radio" id=<?= $post_slug ?> name="style" value=<?= $post_slug ?>>
              <label for=<?= $post_slug ?>><?= $post_label ?></label><br>
            <?php
          };
        ?>
      </div>

      <div class="kind">
        <p>Вид изделия:</p>
        <?php
          foreach ($post_types as $post_number => $post_type) {
            ?>
              <span><?= $post_number ?></span>
              <br>
            <?php
            $taxonomy_terms = get_terms($taxonomy_slug[$post_type->name]);
            foreach ($taxonomy_terms as $taxonomy_number => $taxonomy_term) {
              ?>
              <span><?= $taxonomy_number ?></span>
              <span><?= $taxonomy_term->name ?></span>
              <br>
              <?php
            };
          };
        ?>
      </div>
    </form>
		</div>
	</section>
</main>
<?php get_footer(); ?>