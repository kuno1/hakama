<?php
/**
 * Meta related functions.
 *
 *
 */

/**
 * Do Gtag
 */
add_action( 'wp_head', function() {
	echo <<<HTML
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-KM3L6H5');</script>
<!-- End Google Tag Manager -->
HTML;
}, 1 );

/**
 * Do Gtag no script.
 */
add_action( 'hakama_after_body_tag_open', function() {
	echo <<<HTML
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KM3L6H5" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
HTML;
}, 1 );

add_filter( 'document_title_parts', function( $title ) {

	$insert = function( $array, $where, $key, $value, $before = true ) {
		$new_array = [];
		foreach ( $array as $k => $v ) {
			if ( $before && $where === $k ) {
				$new_array[ $key ] = $value;
			}
			$new_array[ $k ] = $v;
			if ( ! $before && $where === $k) {
				$new_array[ $key ] = $value;
			}
		}
		return $new_array;
	};

	//  Add "WordPress themes and plugins.".
	if ( ! is_front_page() && ! is_singular( 'product' ) ) {
		$title = $insert( $title, 'site', 'wp', _x( 'WordPress Themes & Plugins', 'document_title', 'hakama' ) );
	}
	if ( is_singular() ) {
		$category = hakama_top_category( get_queried_object() );

		switch ( get_queried_object()->post_type ) {
			case 'post':
				if ( $category ) {
					$title = $insert( $title, 'title', 'category', $category->name, false );
				}
				break;
			case 'product':
				if ( $category ) {
					$title = $insert( $title, 'title', 'category', sprintf( 'WordPress %s', $category->name ), false );
				}
				break;
		}
	}
	if ( is_category() || is_tax() || is_tag() ) {
		$term     = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
		switch ( $term->taxonomy ) {
			case 'product_cat':
			case 'product_tag':
				$title['title'] = sprintf( _x( 'List of %s', 'document_title', 'hakama' ), $title['title'] );
				break;
			default:
				$label = $taxonomy->label;
				$title = $insert( $title, 'title', 'taxonomy', $label, false );
				break;
		}
	}
	return $title;
} );
