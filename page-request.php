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
  foreach ($products as $product_number=>$product) {
    $product_local_types[$product_number]['slug'] = tk_get_product_slug($product);
    $product_local_types[$product_number]['label'] = tk_get_product_label($product);
    $product_kinds = tk_get_product_kinds($product);
    foreach ( $product_kinds as $product_kind_number=>$product_kind) {
      $product_local_types[$product_number]['kinds'][$product_kind_number]['slug'] = tk_get_product_kind_slug($product_kind);
      $product_local_types[$product_number]['kinds'][$product_kind_number]['label'] = tk_get_product_kind_label($product_kind);
    };
  };
?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
      <?php the_title( '<h3>', '</h3>' ); ?>
      <form class="request-form" action="/request?success=true" method="post">
        <fieldset>
          <legend><h4>Выберите продукцию</h4></legend>
          <div class="style">
            <label for="style_select">Стиль изделия:</label>
            <select id="style_select">
              <?php
                foreach ( $products as $product ) {
                  ?>
                    <option value=<?= tk_get_product_slug($product); ?>><?= tk_get_product_label($product) ?></option>
                  <?php
                };
              ?>
            </select>
          </div>
          <div class="kind">
            <label for="kind_select">Вид изделия:</label>
            <select id="kind_select">
              <option value=<?= tk_get_product_kind_slug($product_kind) ?>><?= tk_get_product_kind_label($product_kind) ?></option>
            </select>
          </div>
        </fieldset>
      </form>
		</div>
	</section>
</main>
<?php get_footer(); ?>