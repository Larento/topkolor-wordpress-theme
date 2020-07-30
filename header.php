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
        <nav class = "tk-nav header-main-navigation">
            <div class="menu-container">
                <ul class="tk-nav-menu main-menu">
                    <li class="menu-item logo"></li>
                    <li class="menu-item title"></li>
                    <?php tk_get_menu( 'Главное меню' ); ?>
                    <li class="menu-item login">
                        <a href="/terrazzo" data-icon='&#xf086;'></a>
                    </li>
                    <li class="menu-item search">
                        <a href="/about" data-icon='&#xf086;'></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>