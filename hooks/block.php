<?php
/**
 * Block related functions.
 *
 * @package hakama
 *
 */

// Original blocks.
// Register blocks assets.
\Hametuha\WpBlockCreator::register( [
	'namespace' => "Kunoichi\\Hakama\\Blocks",
	'dir' => get_template_directory() . '/app/Kunoichi/Hakama/Blocks',
	'scripts' => get_template_directory() . '/assets/js/blocks',
	'styles' => get_template_directory() . '/assets/css/blocks',
	'prefix' => 'hakama-block-',
] );

/**
 * Enable block library
 */
add_action( 'after_setup_theme', function() {
	// Color setting.
	if ( class_exists( 'Kunoichi\BootstraPress\Css\Extractor' ) ) {
		$extractor = new Kunoichi\BootstraPress\Css\Extractor( get_template_directory() . '/assets/css/style.css' );
		$pallets = $extractor->get_color_palette();
		if ( ! $pallets ) {
			return;
		}
		$colors = [];
		foreach ( $pallets as $slug => $color ) {
			$colors[] = [
				'name' => ucfirst( $slug ),
				'slug' => $slug,
				'color' => $color,
			];
		}
		add_theme_support( 'editor-color-palette', $colors );
	}
	// Align Wide
	add_theme_support( 'align-wide' );
	// Icons
	if ( class_exists( 'Kunoichi\Icon\Manager' ) ) {
		Kunoichi\Icon\Manager::register( [
			'dashicons' => false,
		] );
	}
	// Block Library
	if ( class_exists( 'Kunoichi\BlockLibrary' ) ) {
		\Kunoichi\BlockLibrary::enable();
	}
} );

/**
 * Grab colors.
 */
add_filter( 'bootstrapress_themes', function( $themes ) {
	$themes[] = 'pink';
	return $themes;
} );

/**
 * Add templates for post list.
 */
add_filter( 'kbl_post_list_templates', function( $templates ) {
	return array_merge( $templates, [
		'card' => __( 'Card List', 'hakama' ),
		'circle' => __( 'Circle List', 'hakama' ),
		'product' => __( 'Product List', 'hakama' ),
	] );
} );

/**
 * Change class name.
 */
add_filter( 'kbl_post_list_class_name', function( $class, $attributes ) {
	$class[] = 'post-' . ( $attributes['template'] ?: 'list' );
	switch ( $attributes['template'] ) {
		case 'circle':
			$class[] = 'swiper-wrapper';
			break;
		default:
			// Do nothing.
			break;
	}
	return $class;
}, 10, 2 );

/**
 * Change Post list pre
 */
add_filter( 'kbl_post_list_pre', function( $pre, $attributes ) {
	switch ( $attributes[ 'template' ] ) {
		case '':
		case 'default':
			return '<ul class="post-list">';
		case 'product':
			return '<ul class="product-list">';
		default:
			return $pre;
	}
}, 10, 2 );

/**
 * Change Post list after
 */
add_filter( 'kbl_post_list_after', function( $after, $attributes ) {
	switch ( $attributes[ 'template' ] ) {
		case '':
		case 'product':
		case 'default':
			return '</ul>';
		default:
			return $after;
	}
}, 10, 2 );

/**
 * Load block related assets.
 */
add_action( 'wp_head', function() {
	if ( is_singular() ) {
		if ( has_block( 'kunoichi/posts', get_queried_object() ) ) {
			// Is this swiper.
			wp_enqueue_script( 'swiper-helper' );
			wp_enqueue_style( 'swiper-custom' );
		}
	}
} );

/**
 * Change markup of slider.
 */
add_filter( 'render_block', function( $block_content, $block ) {
	if ( is_singular() ) {
		switch ( $block['blockName'] ) {
			case 'kunoichi/posts':
				if ( ! isset( $block['attrs']['template'] ) || ( 'circle' !== $block['attrs']['template'] ) ) {
					break	;
				}
				// Remove button.
				list( $items, $button ) = explode( '<div class="kbl-post-list-button">', $block_content );
//				$items = $items . '</div>';
				$button = preg_replace( '#</div>$#u', '', '<div class="kbl-post-list-button">' . $button );
				// Wrap slider.
				$block_content = <<<HTML
<!-- Slider main container -->
<div class="post-circle-container swiper-container">

	{$items}

    <div class="swiper-pagination post-circle-pagination"></div>
    <div class="swiper-button-prev post-circle-prev"></div>
    <div class="swiper-button-next post-circle-next"></div>
</div>
{$button}
HTML;
				break;
		}
	}
	return $block_content;
}, 10, 2 );

/**
 * Change image size of cards.
 */
add_filter( 'kbl_link_card_size', function () {
	return 'large';
} );

/**
 * Alert styles.
 */
add_filter( 'kbl_alert_styles', function( $styles ) {
	$styles = [];
	foreach ( [ '', '-outlined' ] as $suffix ) {
		foreach ( [ 'primary', 'secondary', 'warning', 'success', 'info', 'danger', 'dark', 'light' ] as $theme ) {
			$name = $theme.$suffix;
			$styles[ $name ] = implode( ' ', array_map( 'ucfirst', explode( '-', $name ) ) );
		}
	}
	return [
		'styles' => $styles,
	];
} );
