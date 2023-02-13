<?php
namespace tk\functions;

function plugin_inactive_warning(){
  if( get_transient('plugin_inactive_warning') ){
    ?>
      <div class="warning notice is-dismissible">
        <p><strong>Warning</strong>: TOPKOLOR Plugin is not active! Trying to activate...</p>
      </div>
    <?php
    delete_transient('plugin_inactive_warning');
  }
}

function no_plugin_error(){
  if( get_transient('no_plugin_error') ){
    ?>
      <div class="error notice is-dismissible">
        <p><strong>Fatal error</strong>: TOPKOLOR Plugin is not installed! Theme can't be activated!</p>
      </div>
    <?php
    delete_transient('no_plugin_error');
  }
}

function plugin_activated(){
  if( get_transient('plugin_activated') ){
    ?>
      <div class="success notice is-dismissible">
        <p><strong>Success</strong>: TOPKOLOR Plugin is activated!</p>
      </div>
    <?php
    delete_transient('plugin_activated');
  }
}

add_action( 'admin_notices', __NAMESPACE__ . '\plugin_inactive_warning' );
add_action( 'admin_notices', __NAMESPACE__ . '\no_plugin_error' );
add_action( 'admin_notices', __NAMESPACE__ . '\plugin_activated' );

add_action( 'after_setup_theme', function() {
  $plugin_slug = 'topkolor-wordpress-plugin';
  $plugin_subfolder = "${plugin_slug}/${plugin_slug}.php";
  $plugin_path = $_SERVER['DOCUMENT_ROOT'] . "/app/plugins/" . $plugin_subfolder;
  $is_core_plugin_active = is_plugin_active($plugin_subfolder);
  $is_theme_setup = true;
  if ( !$is_core_plugin_active ) {
    set_transient('plugin_inactive_warning', true, 5);
    if ( !file_exists($plugin_path) ) {
      set_transient('no_plugin_error', true, 5);
      $is_theme_setup = false;
    } else {
      set_transient('plugin_activated', true, 5);
      activate_plugin($plugin_subfolder);
    }
  }
  if ( $is_theme_setup ) {
    include_once( get_template_directory() . '/inc/topkolor/includes.php' );
    include_once( get_template_directory() . '/inc/topkolor/filters.php' );
    include_once( get_template_directory() . '/inc/topkolor/helpers.php' );
    include_once( get_template_directory() . '/inc/topkolor/elements.php' );
  }
} );

add_action( 'footer_debug', function() {
});

add_action( 'template_redirect', function() {
  $URL = $_SERVER['REQUEST_URI'];
  if ( is_page_disabled($URL) )
  {    
    wp_redirect( home_url() );
    exit();
  }
});