<?php
  function wporg_custom_post_type() {
      register_post_type('wporg_product',
        array(
          'labels' => array(
            'name'          => __('Products', 'textdomain'),
            'singular_name' => __('Product', 'textdomain'),
          ),
            'public'      => true,
            'has_archive' => true,
        ),
      );
    };

    add_action('init', 'wporg_custom_post_type');
?>