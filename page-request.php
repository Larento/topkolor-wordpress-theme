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
            $products = tk_get_products();
            foreach ( $products as $product ) {
              $product_slug = tk_get_product_slug($product);
              ?>
                <input type="radio" id=<?= $product_slug ?> name="style" value=<?= $product_slug ?>>
                <label for=<?= $product_slug ?>><?= tk_get_product_label($post_type) ?></label><br>
              <?php
            };
          ?>
        </div>
        <div class="kind">
          <p>Вид изделия:</p>
          <?php
            foreach ($products as $product) {
              $product_slug = tk_get_product_slug($product);
              $taxonomy_terms = get_terms([
                'taxonomy'    => tk_taxonomy_name('', $product_slug),
                'hide_empty'  => false,
              ]);
              ?>
                <div class="radio-inputs <?= $product_slug ?>">
                  <?php
                    foreach ($taxonomy_terms as $taxonomy_term) {
                      $taxonomy_term_label = $taxonomy_term->name;
                      $taxonomy_term_slug = $taxonomy_term->slug;
                      $current_taxonomy_slug = $taxonomy_slug[$post_slug];
                      $button_name = $current_taxonomy_slug . "-" . $taxonomy_term_slug;
                      ?>
                        <input type="radio" id=<?= $button_name ?> name=<?= $current_taxonomy_slug ?> value=<?= $taxonomy_term_slug ?>>
                        <label for=<?= $button_name ?>><?= $taxonomy_term_label ?></label><br>
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