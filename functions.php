<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        $parent = _wp_rml_root();
        $options = wp_rml_dropdown($parent, array());
        ?>
        <select style="width:100%!important;">><?php echo $options; ?></select>
        <?php
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>