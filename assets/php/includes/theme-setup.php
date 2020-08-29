<?php
namespace tk\functions;

function load_styles() {
  wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css' );

  //Flickity CSS Files
  wp_enqueue_style( 'flickity.min.css', get_stylesheet_directory_uri() . '/assets/Flickity/flickity.min.css' );
  wp_enqueue_style( 'flickity-fade.css', get_stylesheet_directory_uri() . '/assets/Flickity/flickity-fade.css' );
  wp_enqueue_style( 'fullscreen.css', get_stylesheet_directory_uri() . '/assets/Flickity/fullscreen.css' );
};

function load_scripts() {
  // wp_enqueue_script( 'home-slideshow.js', get_stylesheet_directory_uri() . '/assets/js/home-slideshow.js' );
  wp_enqueue_script( 'search-form.js', get_stylesheet_directory_uri() . '/assets/js/search-form.js' );
  wp_enqueue_script( 'main-navigation-searchbar.js', get_stylesheet_directory_uri() . '/assets/js/main-navigation-searchbar.js' );
  wp_enqueue_script( 'update-text-contrast.js', get_stylesheet_directory_uri() . '/assets/js/update-text-contrast.js' );
  if (is_singular() && is_product() && is_product_kind()) {
    wp_enqueue_script( 'product-slider.js', get_stylesheet_directory_uri() . '/assets/js/product-slider.js' ); 
  }
  
  //Flickity JS Files
  wp_enqueue_script( 'flickity.pkgd.min.js', get_stylesheet_directory_uri() . '/assets/Flickity/flickity.pkgd.min.js' );
  wp_enqueue_script( 'flickity-fade.js', get_stylesheet_directory_uri() . '/assets/Flickity/flickity-fade.js' );
  wp_enqueue_script( 'fullscreen.js', get_stylesheet_directory_uri() . '/assets/Flickity/fullscreen.js' );
  wp_enqueue_script( 'bg-lazyload.js', get_stylesheet_directory_uri() . '/assets/Flickity/bg-lazyload.js' );
}
  
add_action( 'wp_enqueue_scripts', get_handle('load_styles') );
add_action( 'wp_enqueue_scripts', get_handle('load_scripts') );
add_theme_support( 'menus' );
add_theme_support( 'html5', array( 'search-form' ) );
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 140, 140, true );