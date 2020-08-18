<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
      <?php the_title( '<h3>', '</h3>' ); ?>
      <h4>There will be a form here</h4>
      <form class="request-form" action="/request?success=true">
        <?php
          $style = isset($_GET['style']) ? $_GET['style'] : 'none';
          $kind = isset($_GET['kind']) ? $_GET['kind'] : 'none';
          $products = tk_get_products();
          $style_is_valid = false;
          foreach ( $products as $product ) {
            if ( $style === tk_get_product_slug($product) ) {
              $style_is_valid = true;
              $current_product = $product;
            break;
            };
          };
          if ( $style_is_valid === false ) {
            $current_product = reset($products);
            $style = tk_get_product_slug($current_product);
          };
          $product_kinds = tk_get_product_kinds($current_product);
          $kind_is_valid = false;
          foreach ( $product_kinds as $product_kind ) {
            if ( $kind === tk_get_product_kind_slug($product_kind) ) {
              $kind_is_valid = true;
            break;
            };
          };
          if ( $kind_is_valid === false ) {
            $kind = 'none';
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
                        <input type="radio" id=<?= $radio_id ?> name=<?= tk_taxonomy_name('', $product_slug) ?> value=<?= tk_get_product_kind_slug($product_kind) ?> <?php if ($radio_id === tk_taxonomy_name('', $style) . "-" . $kind) {echo "checked='checked'";}; ?>>
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