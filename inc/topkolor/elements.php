<?php

namespace tk\functions;

function icon($code, $type = 'solid', $position = 'before')
{
  echo fa_icon($code, $type, $position);
}

function home_slideshow()
{
  $attachments = post_media('Оформление');
?>
  <div class="tk-slider homepage">
    <?php
    foreach ($attachments as $attachment) {
      $URL = wp_get_attachment_image_url($attachment, 'full');
    ?>
      <div class="slide" style="background-image: url('<?= $URL ?>')"></div>
    <?php
    }
    ?>
  </div>
  <div class="container breadcrumbs">
    <div class="wrapper">
      <!--h4 class="description">Сейчас на фото:</h4-->
      <svg class="progress-ring" height="50" width="50">
        <circle class="ring" stroke="white" stroke-width="4" fill="transparent" r="18" cx="25" cy="25" />
      </svg>
      <?php
      foreach ($attachments as $attachment) {
        $original_ID = \wp_attachment_is_shortcut($attachment, true);
        $folder_ID = \wp_attachment_folder($original_ID);
        $folder = \wp_rml_get_object_by_id($folder_ID);
        $folder_path = urldecode($folder->getPath());
        $products = get_products();
        $URL = '';
        foreach ($products as $product) {
          foreach ($product->taxonomy->kinds as $kind) {
            if ($kind->folderID === $folder_ID) {
              $URL = $product->url_slug . "/" . $kind->slug;
            }
          }
        }
      ?>
        <div class="breadcrumb">
          <a class="portfolio-link" href=<?= "/" . $URL . "/" ?>><?= preg_replace('@/@', ' / ', $folder_path) ?></a>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
<?php
}

function portfolio_browser()
{
?>
  <section id="portfolio" class="tk-section portfolio">
    <div class="container card">
      <div class="container navigation">
        <?php dropdown_checkbox("Выберите стили", get_checkbox_styles()); ?>
        <?php dropdown_checkbox("Выберите виды изделий", get_checkbox_kinds()); ?>
        <a class="close no-text" <?= icon('f00d', 'solid', 'after') ?>></a>
      </div>
      <div class="container main">
        <?php gallery(); ?>
      </div>
    </div>
  </section>
<?php
}


function dropdown_checkbox($initial_label, $list_members)
{
?>
  <div class="dropdown-checkbox <?= $list_members[0]->checkbox_name ?>">
    <div class="panel-container">
      <div class="panel">
        <span class="current-selection"><?= $initial_label ?></span>
        <div class="arrow-container">
          <svg class="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
            <path d="M 4.21875 10.78125 L 2.78125 12.21875 L 15.28125 24.71875 L 16 25.40625 L 16.71875 24.71875 L 29.21875 12.21875 L 27.78125 10.78125 L 16 22.5625 Z" />
          </svg>
        </div>
      </div>
    </div>
    <div class="list-container">
      <ul class="list">
        <?php
        foreach ($list_members as $member) {
          add_option($member->label, $member->checkbox_name, $member->checkbox_value);
        }
        ?>
      </ul>
    </div>
  </div>
<?php
}

function add_option($label, $checkbox_name, $checkbox_value)
{
?>
  <li>
    <label>
      <div class="checkbox-container">
        <input type="checkbox" name=<?= $checkbox_name ?> value=<?= $checkbox_value ?>>
        <div class="checkmark">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
          </svg>
        </div>
        <span class="option-label"><?= $label ?></span>
      </div>
    </label>
  </li>
<?php
}

function get_checkbox_styles()
{
  $name = "styles";
  $styles = [];
  $products = get_products();

  foreach ($products as $product) {
    $style = json_decode(json_encode([
      "label" => $product->archive_name,
      "checkbox_name" => $name,
      "checkbox_value" => $product->url_slug,
    ]));
    $styles[] = $style;
  }
  return $styles;
}

function get_checkbox_kinds()
{
  $name = "kinds";
  $kinds = [];
  $products = get_products();

  //For simplicity, assuming that all products (styles of products) have same options (kinds) available.
  foreach ($products[0]->taxonomy->kinds as $kind) {
    $kind = json_decode(json_encode([
      "label" => $kind->label,
      "checkbox_name" => $name,
      "checkbox_value" => $kind->slug,
    ]));
    $kinds[] = $kind;
  }
  return $kinds;
}

function gallery()
{
?>
  <div class="gallery">
    <div class="categories-container"></div>
    <?= lightbox() ?>
  </div>
<?php
}

function lightbox()
{
?>
  <div class="lightbox">
    <div class="controls-container">
      <?php foreach (["prev", "next"] as $id) {
      ?>
        <a id=<?= $id ?>>
          <svg class="arrow" xmlns="http://www.w3.org/2000/svg" , viewBox="0 0 32 32">
            <path d="M 4.21875 10.78125 L 2.78125 12.21875 L 15.28125 24.71875 L 16 25.40625 L 16.71875 24.71875 L 29.21875 12.21875 L 27.78125 10.78125 L 16 22.5625 Z">
          </svg>
        </a>
      <?php
      }
      ?>
    </div>
  </div>
<?php
}

function product_attachments_slider()
{
  $attachments = product_media();
?>
  <div class="tk-slider product">
    <?php
    if (is_array($attachments)) {
      foreach ($attachments as $attachment) {
    ?>
        <div class="slide">
          <?php
          echo wp_get_attachment_image($attachment, 'large');
          ?>
        </div>
    <?php
      }
    }
    ?>
  </div>
<?php
}
