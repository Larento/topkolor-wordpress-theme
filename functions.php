<?php
    function tk_scripts() {
        wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
    };

    function tk_home_slideshow() {
        $images = get_field('home_slideshow');
        $size = 'full'; // (thumbnail, medium, large, full or custom size)
        if( $images ): ?>
            <ul>
            <?php foreach( $images as $image_id ): ?>
                <li>
                    <?php $image_id ?>
                </li>
            <?php endforeach; ?>
            </ul> <?php
        endif;
    }

    function tk_cool_name() {
        ?>
            <h1>Wow man</h1>        
        <?php
    }

    add_action( 'wp_enqueue_scripts', "tk_scripts" );
?>