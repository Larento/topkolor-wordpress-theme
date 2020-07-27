<?php
    function tk_scripts() {
        wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css' );
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
        foreach ( $attachments as $attachment ) {
            echo wp_get_attachment_image( $attachment );
        };
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>