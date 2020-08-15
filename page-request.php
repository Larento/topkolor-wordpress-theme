<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
      <?php the_title( '<h3>', '</h3>' ); ?>
      <h4>There will be a form here</h4>
      <form class="request-form" action="/request?success=true">
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
            foreach ($post_types as $post_type) {
              $post_slug = $post_type->name;
              $taxonomy_terms = get_terms([
                'taxonomy'    => $taxonomy_slug[$post_slug],
                'hide_empty'  => false,
              ]);
              ?>
                <div class=<?= '"radio-inputs $post_slug"'; ?>>
                  <?php
                    foreach ($taxonomy_terms as $taxonomy_term) {
                      $taxonomy_label = $taxonomy_term->name;
                      $current_taxonomy_slug = $taxonomy_slug[$post_slug];
                      ?>
                        <input type="radio" id=<?= $current_taxonomy_slug ?> name=<?= "kind-$current_taxonomy_slug" ?> value=<?= $current_taxonomy_slug ?>>
                        <label for=<?= $current_taxonomy_slug ?>><?= $taxonomy_label ?></label><br>
                      <?php
                    };
                  ?>
                </div>
              <?php
            };
          ?>
        </div>
      </form>
		</div>
	</section>
</main>
<?php get_footer(); ?>