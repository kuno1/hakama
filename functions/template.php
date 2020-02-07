<?php
/**
 * Template functions
 *
 * @hakama
 */

/**
 *
 *
 * @param string $slug
 * @param string $suffix
 * @param array $args
 * @param bool $echo
 *
 * @return string
 */
function hakama_template( $slug, $suffix = '', $args = [], $echo = true ) {
	$slug = 'template-parts/' . ltrim( $slug, '/' );
	global $wp_query;
	$old_vars = $wp_query->query_vars;
	if ( $args ) {
		$wp_query->query_vars = array_merge( (array) $old_vars, $args );
	}
	ob_start();
	get_template_part( $slug, $suffix );
	$content = ob_get_contents();
	ob_end_clean();
	if ( $echo ) {
		echo $content;
	}
	if ( $args ) {
		$wp_query->query_vars = $old_vars;
	}
	return $content;
}

/**
 * Trim html of short code.
 *
 * @param string $string
 * @param string $glue
 *
 * @return string
 */
function hakama_trim( $string, $glue = "\n" ) {
	return implode( "\n", array_filter( array_map( function( $line ) {
		return trim( $line );
	}, explode( "\n", $string ) ) ) );
}

/**
 * Get template group name.
 *
 * @return string
 */
function hakama_template_group() {
	if ( is_singular( 'faq' ) || is_post_type_archive( 'faq' ) || is_tax( 'faq_cat' ) ) {
		// FAQ.
		return 'support';
	} elseif ( is_singular( 'thread' ) || is_post_type_archive( 'thread' ) || is_tax( 'topic' ) ) {
		// Thead
		return 'support';
	} else {
		return '';
	}
}

/**
 * Get copy right year.
 *
 * @return string
 */
function hakama_copyright_year() {
	/**
	 * hakama_copyright_year
	 *
	 * Copyright year. Default, current year.
	 * @param string $year
	 * @return string
	 */
	return (string) apply_filters( 'hakama_copyright_year', 2018 );
}

/**
 * Get archive title
 */
function hakama_archive_title() {
	$title = '';
	if ( is_search() ) {
		$title = sprintf( __( 'Search results for "%s"', 'hakama' ), get_search_query() );
	} elseif ( is_home() ) {
		$title = __( 'Blog' );
	} elseif  ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'hakama' ), post_type_archive_title( '', false ) );
	} else {
		$title = get_the_archive_title();
	}
	echo esc_html( $title );
}

/**
 * Trim each line and remove empty line to avoid 'the_content' filter.
 *
 * @param string $string
 *
 * @return string
 */
function hakama_avoid_the_content( $string ) {
	return implode( "\n", array_filter( array_map( 'trim', explode( "\n", $string ) ) ) );
}

/**
 * Render pagination
 *
 * @param null|WP_Query $query
 */
function hakama_pagination( $query = null ) {
	if ( class_exists( 'Kunoichi\BootstraPress\PageNavi' ) ) {
		\Kunoichi\BootstraPress\PageNavi::pagination();
	}
}
