<?php get_header(); ?>
<?php // Setting style and kind varibles from HTTP GET
  $params = [
    'style' => 'none',
    'kind'  => 'none'
  ];
  foreach ($params as $param_name=>$param_value) {
    if ( isset($_GET[$param_name]) === true ) {
      if ( is_array($_GET[$param_name]) === true ) {
        $param_value = reset($_GET[$param_name]);
      } else {
        $param_value = $_GET[$param_name];
      };
    };
  };
  $products = tk_get_products();
  $current_product = reset($products);
  $style_is_valid = false;
  foreach ( $products as $product ) {
    if ( $params['style'] === tk_get_product_slug($product) ) {
      $style_is_valid = true;
      $current_product = $product;
    break;
    };
  };
  if ( $style_is_valid === false ) {
    $params['style'] = 'none';
  };
  $product_kinds = tk_get_product_kinds($current_product);
  $kind_is_valid = false;
  foreach ( $product_kinds as $product_kind ) {
    if ( $params['kind'] === tk_get_product_kind_slug($product_kind) ) {
      $kind_is_valid = true;
    break;
    };
  };
  if ( $kind_is_valid === false ) {
    $params['kind'] = 'none';
  };

  foreach ($products as $product) {
    //$product_types[$product]['name'] = 1;
    $product_slug = tk_get_product_slug($product);
    foreach (tk_get_product_kinds($product) as $product_kind) {
      $radio_id = tk_taxonomy_name('', $product_slug) . "-" . tk_get_product_kind_slug($product_kind);
    };
  };
?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
      <?php the_title( '<h3>', '</h3>' ); ?>
      <h4>There will be a form here</h4>
      <form class="request-form" action="/request?success=true" method="post">
        <fieldset>
          <legend>Выберите продукцию</legend>
          <div class="style">
            <select name="" id="">
            <?php
              foreach ( $products as $product ) {
                $product_slug = tk_get_product_slug($product);
                ?>
                  <option value=<?= $product_slug ?>><?= tk_get_product_label($product) ?></option>
                <?php
              };
            ?>
            </select>


            <p>Стиль изделия:</p>
            
          </div>

        </fieldset>


        
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