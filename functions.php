<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        $folders = wp_rml_structure();
        ?>
            <p> <?php gettype(5) ?> wawawewa</p>
        <?php
    }

    function tk_cool_name() {
        ?>
            <h1>Wow man</h1>        
        <?php
    }

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>