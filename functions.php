<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        $parent = _wp_rml_root();
        $folders = wp_rml_root_childs();
        foreach($folders as $folder) {
            if (is_rml_folder($folder) === true) {
                ?>
                <p><?php echo $folder->getName(); ?></p>
                <?php
            };
        };
        $options = wp_rml_dropdown($parent, array());
        ?>
        <select style="width:100%!important;">><?php echo $options; ?></select>
        <?php
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>