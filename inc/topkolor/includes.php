<?php
namespace tk\functions;

function load_params( string $type, string $vendor, string $name, bool $from_home ) {
  $asset = $from_home ? "/" : "/assets/$vendor/$type/";
  $handle = "$vendor-$name";
  $path = get_stylesheet_directory_uri() . $asset . "$name.$type";
  return [
    'type'    => $type,
    'handle'  => $handle,
    'path'    => $path,
  ];
}

function load_style( string $vendor, string $name, bool $from_home = false ) {
  $params = load_params( 'css', $vendor, $name, $from_home );
  wp_register_style( $params['handle'], $params['path'] );
  wp_enqueue_style( $params['handle'] );
}

function load_script( string $vendor, string $name, bool $from_home = false ) {
  $params = load_params( 'js', $vendor, $name, $from_home );
  wp_register_script( $params['handle'], $params['path'] );
  wp_enqueue_script( $params['handle'] );
}

function load_styles() {
  load_style( 'topkolor', 'style', true);
  load_style( 'flickity', 'flickity.min' );
  load_style( 'flickity', 'flickity-fade' );
  load_style( 'flickity', 'fullscreen' );
}

function load_scripts() {
  //load_script( 'topkolor', 'home-slideshow' );
  load_script( 'topkolor', 'search-form');
  load_script( 'topkolor', 'main-navigation-search-bar');
  load_script( 'topkolor', 'update-text-contrast');
  if (is_singular() && is_product() && is_product_kind()) {
    load_script( 'topkolor', 'product-slider');
  }
  //if ( is_page_template('page-request.php') ) {
    load_script( 'topkolor', 'request-form' );
  //}

  load_script( 'flickity', 'flickity.pkgd.min');
  load_script( 'flickity', 'flickity-fade');
  load_script( 'flickity', 'fullscreen');
  load_script( 'flickity', 'bg-lazyload');
}
  
add_action( 'wp_enqueue_scripts', get_handle('load_styles') );
add_action( 'wp_enqueue_scripts', get_handle('load_scripts') );
add_theme_support( 'menus' );
add_theme_support( 'html5', array( 'search-form' ) );
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 140, 140, true );