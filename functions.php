<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        if (function_exists('wp_rml_dropdown')) {
            ?> <p>[folder-gallery fid="8" orderby="rml"]</p> <?php;
        } else {
            echo "<p>Deez nuts!</p>";
        };
        ?> <p><?php wp_rml_dropdown('Root', [1, 2]); ?></p> <?php
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>