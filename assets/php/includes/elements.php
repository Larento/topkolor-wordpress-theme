<?php
namespace tk\functions;

function icon($code, $type = 'solid', $position = 'before') {
  echo fa_icon($code, $type, $position);
}

function home_slideshow() {
  $attachments = post_media('Оформление');
  ?> 
    <div class="tk-slider homepage"> 
  <?php
  foreach ( $attachments as $attachment ) {
    $URL = wp_get_attachment_image_url( $attachment, 'full' );
    ?> 
      <div class="slide" style="background-image: url('<?= $URL ?>')"></div>
    <?php
  }
  ?> 
    </div>
  <?php
}

function product_attachments_slider() {
  $attachments = product_media();
  ?> 
    <div class="tk-slider product">
  <?php
  if ( is_array($attachments) ) {
    foreach ( $attachments as $attachment ) {
      ?> 
        <div class="slide">
      <?php
      echo wp_get_attachment_image( $attachment, 'large' );
      ?>
        </div>
      <?php
    }
  }
  ?>
    </div>
  <?php
}