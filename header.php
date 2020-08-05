<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title> <?php bloginfo(); ?> </title>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/fed6a4f3e8.js" crossorigin="anonymous"></script>
	<?php wp_head(); ?>  
</head>
<body <?php body_class(); ?>>
	<header class="tk-section header">
		<nav class = "header-main-navigation">
			<!--div class="menu-container"-->
				<?php get_search_form(); ?>
				<ul class="main-menu">
					<li class="menu-item title">
						<a href="/"> <?php bloginfo(); ?> </a>
					</li>
					<?php tk_get_menu( 'Header Main Menu' ); ?>
					<li class="menu-item login">
						<a <?= tk_icon('007', 'solid') ?>></a>
					</li>
					<li class="menu-item search">
						<a <?= tk_icon('002', 'solid') ?>></a>
					</li>
				</ul>
			<!--/div-->
		</nav>
	</header>