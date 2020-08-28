<?php
namespace tk\functions;
use \tk\functions as tk;
//External files
	include_once( get_template_directory() . '/assets/php/tk-custom-class-walker-nav-menu.php' );

	function styles() {
		wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . '/style.css' );

		//Flickity CSS Files
		wp_enqueue_style( 'flickity.min.css', get_stylesheet_directory_uri() . '/assets/Flickity/flickity.min.css' );
		wp_enqueue_style( 'flickity-fade.css', get_stylesheet_directory_uri() . '/assets/Flickity/flickity-fade.css' );
		wp_enqueue_style( 'fullscreen.css', get_stylesheet_directory_uri() . '/assets/Flickity/fullscreen.css' );
	};

	function scripts() {
		// wp_enqueue_script( 'home-slideshow.js', get_stylesheet_directory_uri() . '/assets/js/home-slideshow.js' );
		wp_enqueue_script( 'search-form.js', get_stylesheet_directory_uri() . '/assets/js/search-form.js' );
		wp_enqueue_script( 'main-navigation-searchbar.js', get_stylesheet_directory_uri() . '/assets/js/main-navigation-searchbar.js' );
		wp_enqueue_script( 'update-text-contrast.js', get_stylesheet_directory_uri() . '/assets/js/update-text-contrast.js' );
		if (is_singular() && tk\is_product() && tk\is_product_kind()) {
			wp_enqueue_script( 'product-slider.js', get_stylesheet_directory_uri() . '/assets/js/product-slider.js' );
		};
		
		//Flickity JS Files
		wp_enqueue_script( 'flickity.pkgd.min.js', get_stylesheet_directory_uri() . '/assets/Flickity/flickity.pkgd.min.js' );
		wp_enqueue_script( 'flickity-fade.js', get_stylesheet_directory_uri() . '/assets/Flickity/flickity-fade.js' );
		wp_enqueue_script( 'fullscreen.js', get_stylesheet_directory_uri() . '/assets/Flickity/fullscreen.js' );
		wp_enqueue_script( 'bg-lazyload.js', get_stylesheet_directory_uri() . '/assets/Flickity/bg-lazyload.js' );

		//Wheelzoom JS
		//wp_enqueue_script( 'wheelzoom.js', get_stylesheet_directory_uri() . '/assets/Wheelzoom/wheelzoom.js' );
	};
		
	add_action( 'wp_enqueue_scripts', get_handle('styles') );
	add_action( 'wp_enqueue_scripts', get_handle('scripts') );
	

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
				$code = tk\fa_icon_unicode($code);
				$atts[tk\fa_icon($code, $type, $position, true)] = $code;
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

	function request_page_link_parameters( $atts, $item, $args, $depth ) { 
		if ( in_array('request', $item->classes) === true ) {
			$atts['href'] = add_query_arg( ['post_id'	=> get_queried_object_id()], $atts['href'] );	
		};
		return $atts;
	};

	add_filter( 'nav_menu_link_attributes', get_handle('request_page_link_parameters'), 10, 4 );

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

	function excerpt_more_link_all_the_time() {

		// Remove More Link from get_the_excerpt()	
		function more_link() {
			return '';
		}
		add_filter('excerpt_more', get_handle('more_link'));
	
		//Force read more link on all excerpts
		function get_read_more_link() {
			$excerpt = get_the_excerpt();
			return '<p>' . $excerpt . '<br><a href="' . get_permalink() . '">Подробнее...</a></p>';
		}
		add_filter( 'the_excerpt', get_handle('get_read_more_link') );
		
	}
	add_action( 'after_setup_theme', get_handle('excerpt_more_link_all_the_time') );

	function new_excerpt_more($more) {
		global $post;
		return '<a class="moretag" href="' . get_permalink($post->ID) . '">Подробнее...</a>';
	};

	add_filter( 'excerpt_more', get_handle('new_excerpt_more') );

//Helping functions
	function footer_debug() {
		return 'Nothin';
	};

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
	};

	function get_menu( $menu_name ) {
		$args = array (
			'menu' => $menu_name,
			'container' => false,
			'items_wrap' => '%3$s',
			'walker' => new \tk\classes\custom_walker_nav_menu,
		);
		wp_nav_menu( $args ); 
	};

//Elements
	function icon($code, $type = 'solid', $position = 'before') {
		echo fa_icon($code, $type, $position);
	};

	function home_slideshow() {
		$attachments = tk\post_media('Оформление');
		?> <div class="tk-slider homepage"> <?php
		foreach ( $attachments as $attachment ) {
			$URL = wp_get_attachment_image_url( $attachment, 'full' );
			?> <div class="slide" style="background-image: url('<?= $URL ?>')"></div> <?php
		};
		?> </div> <?php
	};

	function product_attachments_slider() {
		$attachments = tk\product_media();
		?> <div class="tk-slider product"> <?php
		if ( is_array($attachments) ) {
			foreach ( $attachments as $attachment ) {
				?> <div class="slide"> <?php
					echo wp_get_attachment_image( $attachment, 'large' );
				?> </div> <?php
			};
		};
		?> </div> <?php
	};
?>