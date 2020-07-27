<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        $parent = _wp_rml_root();
        $folders = wp_rml_objects();
        //$pictureFolder = wp_rml_get_object_by_id($parent);
        foreach ( $folders as $folder ) {
            if ( is_rml_folder($folder) === true ) {
                if ( $folder->getName() === get_the_title() ) {
                    $pictureFolder = $folder;
                    break;
                };
            };
        };
        ?>
        <p><?php echo $pictureFolder; ?></p>
        <?php
        $options = wp_rml_dropdown($parent, array());
        ?>
        <select style="width:100%!important;">><?php echo $options; ?></select>
        <?php
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>