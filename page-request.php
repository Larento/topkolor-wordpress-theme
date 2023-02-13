<?php use \tk\functions as tk; ?>
<?php get_header(); ?>
<main role="main">
  <section class="tk-section post document">
    <div class="container">
      <?php the_title('<h3>', '</h3>'); ?>
      <form class="request-form" method="post">
        <fieldset id="product-select">
          <legend>
            <h4>Выбор продукции</h4>
          </legend>
          <div class="style">
            <label for="style-select">Стиль изделия:</label>
            <select id="style-select">
              <?php
              foreach (tk\get_products() as $product) {
              ?>
                <option value=<?= $product->slug ?>><?= $product->label ?></option>
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
          <legend>
            <h4>Описание работы</h4>
          </legend>
        </fieldset>
        <fieldset id="attachment">
          <legend>
            <h4>Прикрепить файлы</h4>
          </legend>
        </fieldset>
        <fieldset id="contact-info">
          <legend>
            <h4>Контактная информация</h4>
          </legend>
        </fieldset>
        <input type="submit" value="">
      </form>
    </div>
  </section>
</main>
<?php get_footer(); ?>