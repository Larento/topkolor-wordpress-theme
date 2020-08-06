<?php
	include_once( get_template_directory() . '/assets/php/tk-custom-class-walker-nav-menu.php' );

	

	add_filter( 'wp_nav_menu_items', function ( $menu ) {
		return str_replace( '<a href="#"', '<a', $menu );
	});

	add_theme_support( 'menus' );
	add_theme_support( 'html5', array( 'search-form' ) );

	function tk_styles() {
		wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css' );
	};

	function tk_scripts() {
		//wp_enqueue_script( 'auto-slideshow.js', get_stylesheet_directory_uri() . '/assets/js/auto-slideshow.js' );
		wp_enqueue_script( 'main-navigation-searchbar.js', get_stylesheet_directory_uri() . '/assets/js/main-navigation-searchbar.js' );
		wp_enqueue_script( 'update-text-contrast.js', get_stylesheet_directory_uri() . '/assets/js/update-text-contrast.js' );
	};

	add_action( 'wp_enqueue_scripts', 'tk_styles' );
	add_action( 'wp_enqueue_scripts', 'tk_scripts' );

	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}

	function fa_icon_unicode($code) {
		return "&#x$code;";
	};

	function fa_icon($code, $type, $position) {
		$code = fa_icon_unicode($code);
		return "data-icon-$type-$position=$code";
	}

	function tk_icon($code, $type = 'solid', $position = 'before') {
		echo fa_icon($code, $type, $position);
	};

	function tk_get_post_media() {
		$folders = wp_rml_objects();
		$picture_folder = wp_rml_get_object_by_id( _wp_rml_root() );
		foreach ( $folders as $folder ) {
			if ( is_rml_folder( $folder ) === true ) {
				if ( $folder->getName() === get_the_title() ) {
					$picture_folder = $folder;
					break;
				};
			};
		};
		return wp_rml_get_attachments( $picture_folder->getId() );
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
			?> <div class="slide" style="background-image: url(<?= wp_get_attachment_image_url( $attachment, '' ); ?>"></div> <?php
		};
		?> </div> <?php
	};

	add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
		if ( in_array( 'fa-', $item->classes ) === true ) {
			$atts['data-icon-solid-after'] = 'zoinks';
		};
		//$item_classes = $item->classes;
		//foreach ( $item_classes as $class ) {
		//	if ( strpos($class, 'fa-') === true ) {
		//		$array = explode('-', $class);
		//		$code = $array[1];
		//		$type = $array[2];
		//		$position = $array[3];
		//		$code = fa_icon_unicode($code);
		//		$atts[fa_icon($code, $type, $position)] = $code;
		//	};
		//};
    return $atts;
	}, 10, 3 );
?>