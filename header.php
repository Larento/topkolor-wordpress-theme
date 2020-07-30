<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title>ТОПКОЛОР</title>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php wp_head(); ?>  
</head>
<body <?php body_class(); ?>>
    <header class="tk-section header">
        <nav>
            <div>
                <?php $args = array (
                    'menu_class' => 'tk-nav-menu main-menu', 
                    'menu_id' => '', 
                    'item-wrap' => '<ul class="">%3$s</ul>', 
                    'container' => false,
                );
                wp_nav_menu( $args ); ?>
            </div>
        </nav>
    </header>