<?php
    include_once( get_template_directory() . '/assets/php/tk-custom-class-walker-nav-menu.php' );
    add_filter( 'wp_nav_menu_items', function ( $menu ) {
        return str_replace( '<a href="#"', '<a', $menu );
    });

    function tk_styles() {
        wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css' );
    };

    function tk_scripts() {
        wp_enqueue_script( 'auto-slideshow.js', get_stylesheet_directory_uri() . '/assets/js/auto-slideshow.js' );
    };

    function tk_get_post_media() {
        $folders = wp_rml_objects();
        $pictureFolder = wp_rml_get_object_by_id( _wp_rml_root() );
        foreach ( $folders as $folder ) {
            if ( is_rml_folder( $folder ) === true ) {
                if ( $folder->getName() === get_the_title() ) {
                    $pictureFolder = $folder;
                    break;
                };
            };
        };
        return wp_rml_get_attachments( $pictureFolder->getId() );
    };

    function tk_home_slideshow() {
        $attachments = tk_get_post_media();
        ?> <div class="tk-slider"> <?php
        foreach ( $attachments as $attachment ) {
            ?> <div class="slide" style="background-image: url(<?= wp_get_attachment_image_url( $attachment, 'medium' ); ?>"></div> <?php
        };
        ?> </div> <?php
    };

    add_action( 'wp_enqueue_scripts', 'tk_styles' );
    add_action( 'wp_enqueue_scripts', 'tk_scripts' );
?>