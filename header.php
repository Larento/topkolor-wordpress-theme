<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title>ТОПКОЛОР</title>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php wp_head(); ?>  
</head>
<body <?php body_class(); ?>>
    <header class="tk_section header">
        <nav>
        <?php wp_nav_menu( array( 'items_wrap' => '%3$s' ) ); ?>
        </nav>
    </header>