<?php
	include_once( get_template_directory() . '/assets/php/tk-custom-class-walker-nav-menu.php' );

	add_filter( 'wp_nav_menu_items', function ( $menu ) {
		return str_replace( '<a href="#"', '<a', $menu );
	});

	add_theme_support( 'menus' );
	add_theme_support( 'html5', array( 'search-form' ) );

	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}

	function tk_get_bg() {
		$bgURL = "https://tkolor.com/wp-content/uploads/2020/07/BackroundOrnament.svg";
		$bg = file_get_contents($bgURL);
		console_log($bg);
		echo '<script>';
		echo "backgroundColors('. json_encode( $bg ) .')";
		echo '</script>'; 
	};

	function tk_styles() {
		wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css' );
	};

	function tk_scripts() {
		wp_enqueue_script( 'auto-slideshow.js', get_stylesheet_directory_uri() . '/assets/js/auto-slideshow.js' );
		wp_enqueue_script( 'main-navigation-searchbar.js', get_stylesheet_directory_uri() . '/assets/js/main-navigation-searchbar.js' );
		wp_enqueue_script( 'background-colors.js', get_stylesheet_directory_uri() . '/assets/js/background-colors.js' );
	};

	function fa_icon_unicode($code) {
		return "&#xf$code;";
	};

	function tk_icon($code, $type = 'solid', $position = 'before') {
		$code = fa_icon_unicode($code);
		echo "data-icon-$type-$position=$code";
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

	function tk_get_menu( $menu_name ) {
		$args = array (
			'menu' => $menu_name,
			'container' => false,
			'items_wrap' => '%3$s',
			'walker' => new tk_custom_walker_nav_menu,
		);
		wp_nav_menu( $args ); 
	}

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
	add_action( 'wp_footer', 'tk_get_bg' );
?>