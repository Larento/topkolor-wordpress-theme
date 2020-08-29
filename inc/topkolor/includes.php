<?php
namespace tk\functions;

function load_styles() {

  function load_style( string $vendor, string $name, $from_home = false ) {
    $type = 'css';
    $assets = $from_home ? "/" : "/assets/$vendor/$type/";
    $file = $name . $type;
    $inc = get_stylesheet_directory_uri() . $assets . $file;
    wp_enqueue_style( $file, $inc );
  }

  load_style( 'topkolor', 'style', true);
  load_style( 'flickity', 'flickity.min' );
  load_style( 'flickity', 'flickity-fade' );
  load_style( 'flickity', 'fullscreen' );
}

function load_scripts() {

  function load_script( string $vendor, string $name, $from_home = false ) {
    $type = 'js';
    $assets = $from_home ? "/" : "/assets/$vendor/$type/";
    $file = $name . $type;
    $inc = get_stylesheet_directory_uri() . $assets . $file;
    wp_enqueue_script( $file, $inc );
  }

  //load_script( 'topkolor', 'home-slideshow' );
  load_script( 'topkolor', 'search-form');
  load_script( 'topkolor', 'main-navigation-search-bar');
  load_script( 'topkolor', 'update-text-contrast');
  if (is_singular() && is_product() && is_product_kind()) {
    load_script( 'topkolor', 'product-slider');
  }
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