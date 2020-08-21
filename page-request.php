<?php // Setting style and kind varibles from HTTP GET
  $params = [
    'style' => 'none',
    'kind'  => 'none'
  ];
  foreach ($params as $param_name=>$param_value) {
    if ( isset($_GET[$param_name]) === true ) {
      if ( is_array($_GET[$param_name]) === true ) {
        $params[$param_name] = reset($_GET[$param_name]);
      } else {
        $params[$param_name] = $_GET[$param_name];
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
  $form_data[0] = $params;
  $form_data[1] = $product_local_types;
  function tk_set_contact_form() {
    global $form_data;
    wp_enqueue_script( 'request-form.js', get_stylesheet_directory_uri() . '/assets/js/request-form.js', [], false, true );
    wp_localize_script('request-form.js', 'formData', $form_data );
  };
  add_action( 'wp_enqueue_scripts', 'tk_set_contact_form' );
?>
<?php get_header(); ?>
<main role="main">
	<section class="tk-section post document">
		<div class="container">
      <?php the_title( '<h3>', '</h3>' ); ?>
      <form class="request-form" action="/request?success=true" method="post">
        <fieldset id="product-select">
          <legend><h4>Выбор продукции</h4></legend>
          <div class="style">
            <label for="style-select">Стиль изделия:</label>
            <select id="style-select">
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
            <label for="kind-select">Вид изделия:</label>
            <select id="kind-select">
            </select>
          </div>
        </fieldset>
        <fieldset id="description">
          <legend><h4>Описание работы</h4></legend>
        </fieldset>
        <fieldset id="attachment">
          <legend><h4>Прикрепить файлы</h4></legend>
        </fieldset>
        <fieldset id="contact-info">
        <legend><h4>Контактная информация</h4></legend>
        </fieldset>
      </form>
		</div>
	</section>
</main>
<?php get_footer(); ?>
