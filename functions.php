<?php
    function tk_scripts() {
        wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css' );
    };

    function tk_home_slideshow() {
        $parent = _wp_rml_root();
        $folders = wp_rml_objects();
        $pictureFolder = wp_rml_get_object_by_id( $parent );
        foreach ( $folders as $folder ) {
            if ( is_rml_folder( $folder ) === true ) {
                if ( $folder->getName() === get_the_title() ) {
                    $pictureFolder = $folder;
                    break;
                };
            };
        };
        $attachments = wp_rml_get_attachments( $pictureFolder->getId() );
        $image_url = 'https://tkolor.com/wp-content/uploads/2020/07/4_2-scaled.jpg';
        $attachment_id = attachment_url_to_postid( $image_url );
        foreach ( $attachments as $attachment ) {
            echo "<script>console.log( $attachment )</script>";
            wp_get_attachment_image($attachment, 'thumbnail');
        };
        echo "<script>console.log( $attachment_id )</script>";

        /*?>
        <p><?php echo $pictureFolder->getName(); ?></p>
        <?php
        $options = wp_rml_dropdown($parent, array());
        ?>
        <select style="width:100%!important;">><?php echo $options; ?></select>
        <?php*/
    };

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>