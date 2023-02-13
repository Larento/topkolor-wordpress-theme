<?php
namespace tk\functions;

add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args, $depth ) {
  $item_classes = $item->classes;
  foreach ( $item_classes as $class ) {
    if ( strpos( $class, 'fa-' ) !== false ) {
      $array = explode( '-', $class );
      $code = $array[1];
      $type = $array[2];
      $position = $array[3];
      $code = fa_icon_unicode($code);
      $atts[fa_icon( $code, $type, $position, true )] = $code;
    }
  }

  $classes = [
    'tk-button',
    'bg-light',
    'bg-dark',
    'size-small',
    'size-big',
    'portfolio-link'
  ];
  foreach ($classes as $class)
  {
    if ( in_array( $class, $item->classes )  )
    {
      if ( isset($atts['class']) )
      {
        $atts['class'] .= ' ' . $class;
      }
      else
      {
        $atts['class'] = $class;
      }
    }
  }
  return $atts;
}, 10, 4 );

function request_page_link_parameters( $atts, $item, $args, $depth ) { 
  if ( in_array( 'request', $item->classes ) === true ) {
    $atts['href'] = add_query_arg( ['post_id'	=> get_queried_object_id()], $atts['href'] );	
  };
  return $atts;
};

add_filter( 'nav_menu_link_attributes', get_handle('request_page_link_parameters'), 10, 4 );

add_filter( 'wp_nav_menu_items', function ( $menu ) {
  return str_replace( '<a href="#"', '<a', $menu );
} );

add_filter( 'nav_menu_item_title', function ( $title, $item, $args, $depth ) {
  if ( in_array( 'no-text', $item->classes ) === true ) {
    $title = '';
  }
  if ( in_array( 'title', $item->classes ) === true ) {
    $title = get_bloginfo();
  }
  return $title;
}, 10, 4) ;

function excerpt_more_link_all_the_time() {	
  function more_link() {
    return '';
  }

  add_filter('excerpt_more', get_handle('more_link'));

  function get_read_more_link() {
    $excerpt = get_the_excerpt();
    return '<p>' . $excerpt . '<br><a href="' . get_permalink() . '">Подробнее...</a></p>';
  }

  add_filter( 'the_excerpt', get_handle('get_read_more_link') );
}

add_action( 'after_setup_theme', get_handle('excerpt_more_link_all_the_time') );

function new_excerpt_more($more) {
  global $post;
  return '<a class="moretag" href="' . get_permalink($post->ID) . '">Подробнее...</a>';
}

add_filter( 'excerpt_more', get_handle('new_excerpt_more') );
