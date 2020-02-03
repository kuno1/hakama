<?php
/**
 * Block related functions.
 *
 * @package hakama
 */

/**
 * Enable block library
 */
add_action( 'after_setup_theme', function() {
	if ( class_exists( 'Kunoichi\BlockLibrary' ) ) {
		\Kunoichi\BlockLibrary::enable();
	}
} );

/**
 * Add templates for post list.
 */
add_filter( 'kbl_post_list_templates', function( $templates ) {
	return array_merge( $templates, [
		'card' => __( 'Card List', 'hakama' ),
		'circle' => __( 'Circle List', 'hakama' ),
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
				if ( 'circle' !== $block['attrs']['template'] ) {
					break;
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
