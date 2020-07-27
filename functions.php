<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
    ?> <p> <?php wp_rml_get_parent_id(10); ?> </p> <?php
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>