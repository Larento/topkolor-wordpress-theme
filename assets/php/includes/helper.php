<?php
namespace tk\functions;

include_once( get_template_directory() . '/assets/php/includes/custom-walker-nav-menu.php' );

add_action( 'footer_debug', function() {
  echo 'Nothin';
} );

function footer_debug() {
  ?>
    <pre style='color: white;'> 
      <?php do_action('footer_debug'); ?>
    </pre>
  <?php
}

function fa_icon_unicode($code) {
  return "&#x$code;";
}

function fa_icon( $code, $type, $position, $only_attr = false ) {
  $code = fa_icon_unicode($code);
  if ( $only_attr === false ) {
    return "data-icon-$type-$position=$code";
  }
  if ( $only_attr === true ) {
    return "data-icon-$type-$position";
  }
}

function get_menu($menu_name) {
  $args = [
    'menu'        => $menu_name,
    'container'   => false,
    'items_wrap'  => '%3$s',
    'walker'      => new \tk\classes\custom_walker_nav_menu,
  ];
  wp_nav_menu($args); 
}