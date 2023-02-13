<?php
namespace tk\functions;

include_once( get_template_directory() . '/inc/topkolor/custom-walker-nav-menu.php' );

function footer_debug() {
  ?>
    <pre> 
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

function no_index() {
  $URL = $_SERVER['REQUEST_URI'];
  if ( is_page_disabled($URL) )
  {
    ?>
      <meta name='robots' content='noindex, nofollow' />
    <?php
  }
}