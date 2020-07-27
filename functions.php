<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        wp_rml_dropdown('Root', [1, 2]); ?>
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>