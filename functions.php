<?php
//External files
	include_once( get_template_directory() . '/assets/php/tk-custom-class-walker-nav-menu.php' );

	function tk_styles() {
		wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css' );

		//Flickity CSS Files
		//wp_enqueue_style( 'flickity.min.css', get_stylesheet_directory_uri() . '/assets/Flickity/flickity.min.css' );
		//wp_enqueue_style( 'flickity-fade.css', get_stylesheet_directory_uri() . '/assets/Flickity/flickity-fade.css' );
		//wp_enqueue_style( 'fullscreen.css', get_stylesheet_directory_uri() . '/assets/Flickity/fullscreen.css' );
	};

	function tk_scripts() {
		// wp_enqueue_script( 'home-slideshow.js', get_stylesheet_directory_uri() . '/assets/js/home-slideshow.js' );
		wp_enqueue_script( 'searchform.js', get_stylesheet_directory_uri() . '/assets/js/searchform.js' );
		wp_enqueue_script( 'main-navigation-searchbar.js', get_stylesheet_directory_uri() . '/assets/js/main-navigation-searchbar.js' );
		wp_enqueue_script( 'update-text-contrast.js', get_stylesheet_directory_uri() . '/assets/js/update-text-contrast.js' );
		if ( is_page_template( '/page-request.php' ) ) {
			wp_enqueue_script( 'request-form.js', get_stylesheet_directory_uri() . '/assets/js/request-form.js' );
		};
		
		//Flickity JS Files
		//wp_enqueue_script( 'flickity.pkgd.min.js', get_stylesheet_directory_uri() . '/assets/Flickity/flickity.pkgd.min.js' );
		//wp_enqueue_script( 'flickity-fade.js', get_stylesheet_directory_uri() . '/assets/Flickity/flickity-fade.js' );
		//wp_enqueue_script( 'fullscreen.js', get_stylesheet_directory_uri() . '/assets/Flickity/fullscreen.js' );
		//wp_enqueue_script( 'bg-lazyload.js', get_stylesheet_directory_uri() . '/assets/Flickity/bg-lazyload.js' );
	};

	add_action( 'wp_enqueue_scripts', 'tk_styles' );
	add_action( 'wp_enqueue_scripts', 'tk_scripts' );

	add_theme_support( 'menus' );
	add_theme_support( 'html5', array( 'search-form' ) );
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 140, 140, true );

//Filters for links
	add_filter('nav_menu_link_attributes', function ( $atts, $item, $args, $depth ) {
		$item_classes = $item->classes;
		foreach ( $item_classes as $class ) {
			if ( strpos($class, 'fa-') !== false ) {
				$array = explode('-', $class);
				$code = $array[1];
				$type = $array[2];
				$position = $array[3];
				$code = fa_icon_unicode($code);
				$atts[fa_icon($code, $type, $position, true)] = $code;
			};
		};
		if ( in_array('tk-button', $item->classes) === true ) {
			if ( isset($atts['class']) === true ) {
				$atts['class'] .= ' tk-button';
			} else {
				$atts['class'] = 'tk-button';
			};
			if ( in_array('hollow', $item->classes) === true ) {
				$atts['class'] .= ' hollow';
			};
		};
		return $atts;
	}, 10, 4);

	function tk_request_page_link_parameters( $atts, $item, $args, $depth ) { 
		if ( in_array('request', $item->classes) === true ) {
			if (tk_is_product() === true) {
				$style = tk_get_product_slug( tk_get_current_product() );
			} else {
				$style = 'none';
			};
			if (tk_is_product_kind() === true) {
				if ( is_post_type_archive() === true ) {
					$kind = 'none';
				} else {
					$kind = tk_get_product_kind_slug( tk_get_current_product_kind() );
				};
			} else {
				$kind = 'none';
			};
			$atts['href'] .= "?style=$style&kind=$kind";
		};
		return $atts;
	};

	add_filter( 'nav_menu_link_attributes', 'tk_request_page_link_parameters', 10, 4 );

	add_filter('wp_nav_menu_items', function ( $menu ) {
		return str_replace( '<a href="#"', '<a', $menu );
	});

	add_filter('nav_menu_item_title', function ( $title, $item, $args, $depth ) {
		if ( in_array('no-text', $item->classes) === true ) {
			$title = '';
		};
		if ( in_array('title', $item->classes) === true ) {
			$title = get_bloginfo();
		};
		return $title;
	}, 10, 4);

	function new_excerpt_more($more) {
		global $post;
		return '<a class="moretag" href="' . get_permalink($post->ID) . '">Подробнее...</a>';
	};

	add_filter('excerpt_more', 'new_excerpt_more');

//Helping functions
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}

	function fa_icon_unicode($code) {
		return "&#x$code;";
	};

	function fa_icon($code, $type, $position, $only_attr = false) {
		$code = fa_icon_unicode($code);
		if ( $only_attr === false ) {
			return "data-icon-$type-$position=$code";
		};
		if ( $only_attr === true ) {
			return "data-icon-$type-$position";
		};
	}

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
	};

//Elements
	function tk_icon($code, $type = 'solid', $position = 'before') {
		echo fa_icon($code, $type, $position);
	};

	function tk_home_slideshow() {
		$attachments = tk_get_post_media();
		?> <div class="tk-slider homepage"> <?php
		foreach ( $attachments as $attachment ) {
			?> <div class="slide" style="background-image: url('<?= wp_get_attachment_image_url( $attachment, '' ); ?>')"></div> <?php
		};
		?> </div> <?php
	};
?>