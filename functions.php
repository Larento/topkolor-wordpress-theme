<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        $folders = wp_rml_dropdown();
        echo "<script>console.log('wowsers')</script>";
    };

    function tk_cool_name() {
        ?>
            <h1>Wow man</h1>        
        <?php
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>