<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
      <?php the_title( '<h3>', '</h3>' ); ?>
      <h4>There will be a form here</h4>
      <form class="request-form" action="/request?success=true">
        <?php
          $style = $_GET['style'];
          $kind = $_GET['kind'];
          $products = tk_get_products();
          $product_kinds = tk_get_product_kinds();
          $style_is_valid = false;
          $kind_is_valid = false;
          foreach ( $products as $product ) {
            if ( $style === tk_get_product_slug($product) ) {
              $style_is_valid = true;
            };
          };
          if ( $style_is_valid === false ) {
            $style = tk_get_product_slug(reset($products));
          };
          foreach ( $product_kinds as $product_kind ) {
            if ( $kind === tk_get_product_kind_slug($product_kind) ) {
              $kind_is_valid = true;
            };
          };
          if ( $kind_is_valid === false ) {
            $kind = tk_get_product_kind_slug(reset($product_kinds));
          };
        ?>
        <div class="style">
          <p>Стиль изделия:</p>
          <?php
            foreach ( $products as $product ) {
              $product_slug = tk_get_product_slug($product);
              ?>
                <input type="radio" id=<?= $product_slug ?> name="style" value=<?= $product_slug ?> <?php if ($product_slug === $style) {echo "checked='checked'";}; ?>>
                <label for=<?= $product_slug ?>><?= tk_get_product_label($product) ?></label><br>
              <?php
            };
          ?>
        </div>
        <div class="kind">
          <p>Вид изделия:</p>
          <?php
            foreach ($products as $product) {
              $product_slug = tk_get_product_slug($product);
              ?>
                <div class="radio-inputs <?= $product_slug ?>">
                  <?php
                    foreach (tk_get_product_kinds($product) as $product_kind) {
                      $radio_id = tk_taxonomy_name('', $product_slug) . "-" . tk_get_product_kind_slug($product_kind);
                      ?>
                        <input type="radio" id=<?= $radio_id ?> name=<?= tk_taxonomy_name('', $product_slug) ?> value=<?= tk_get_product_kind_slug($product_kind) ?>>
                        <label for=<?= $radio_id ?>><?= tk_get_product_kind_label($product_kind) ?></label><br>
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