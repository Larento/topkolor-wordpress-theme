<?php use \tk\functions as tk; ?> 
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
		<nav class = "container header-main-navigation">
			<div class="search-bar">
				<button class="search-button-dummy" type="button">
					<a class="no-text" <?= tk\icon('f00d', 'solid') ?>></a>
				</button>
				<?php get_search_form(); ?>
				<button class="search-button-close" type="button">
    			<a class="no-text" <?= tk\icon('f00d', 'solid') ?>></a>
  			</button>
			</div>
			<ul class="main-menu">
				<?php tk\get_menu( 'Header Main Menu' ); ?>
			</ul>
		</nav>
	</header>