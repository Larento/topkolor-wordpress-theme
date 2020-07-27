<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        if (function_exists('wp_rml_dropdown')) {
            echo "<p>Got im'</p>";
        } else {
            echo "<p>Deez nuts!</p>";
        };
        ?> <p><?php wp_rml_dropdown('Root', [1, 2]); ?></p> <?php
    };

    add_action( 'wp_head', 'tk_home_slideshow' );

    function tk_cool_name() {
        ?>
            <h1>Wow man</h1>        
        <?php
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>