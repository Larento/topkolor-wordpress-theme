<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title>ТОПКОЛОР</title>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://kit.fontawesome.com/fed6a4f3e8.js" crossorigin="anonymous"></script>
    <?php wp_head(); ?>  
</head>
<body <?php body_class(); ?>>
    <header class="tk-section header">
        <nav class = "tk-nav header-main-navigation">
            <div class="menu-container">
                <ul class="tk-nav-menu main-menu">
                    <li class="menu-item logo">
                        <figure></figure>
                    </li>
                    <li class="menu-item title">
                        <a href="/main">
                            <h3> <?php echo get_bloginfo(); ?> </h3> 
                        </a>
                    </li>
                    <?php tk_get_menu( 'Главное меню' ); ?>
                    <li class="menu-item login">
                        <a href="/terrazzo" <?= tk_icon('007', 'solid') ?>></a>
                    </li>
                    <li class="menu-item search">
                        <a href="/about" <?= tk_icon('002', 'solid') ?>></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>