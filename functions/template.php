<?php
/**
 * Template functions
 *
 * @hakama
 */

/**
 * Get date diff.
 *
 * @param string $date
 * @param string $from
 * @return int
 */
function hakama_date_diff( $date, $from = '' ) {
	if ( ! $from ) {
		$from = date_i18n( 'Y-m-d H:i:s' );
	}
	return strtotime( $from ) - strtotime( $date );
}

/**
 * Display date diff like "2 years ago"
 *
 * @param string $date
 * @param string $from
 * @return string
 */
function hakama_the_date_diff( $date, $from = '' ) {
	$diff = (int) hakama_date_diff( $date, $from );
	if ( 0 > $diff ) {
		return __( 'Just Now', 'hakama' );
	}
	$diff = $diff / 60;
	$days = $diff / 60 / 24;
	if ( $diff < 60 ) {
		return sprintf( _n( __( '%d minute ago', 'hakama' ), __( '%d minutes ago', 'hakama' ), $diff, 'hakama' ), $diff );
	} elseif ( $days < 1 ) {
		$hour = floor( $diff / 60 );
		return sprintf( _n( __( '%d hour ago', 'hakama' ), __( '%d hours ago', 'hakama' ), $hour, 'hakama' ), $hour / 60 );
	} elseif ( $days < 30 ) {
		return sprintf( _n( __( '%d day ago', 'hakama' ), __( '%d days ago', 'hakama' ), $days, 'hakama' ), $days );
	} elseif ( $days < 365 ) {
		$month = max( 1, floor( $days / 30.5 ) );
		return sprintf( _n( __( '%d month ago', 'hakama' ), __( '%d months ago', 'hakama' ), $month, 'hakama' ), $month );
	} else {
		$year = floor( $days / 365 );
		return sprintf( _n( __( '%d year ago', 'hakama' ), __( '%d years ago', 'hakama' ), $year, 'hakama' ), $year );
	}
}

/**
 * Get template part.
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
function hakama_template_group( $prefix = '' ) {
	if ( is_singular( 'faq' ) || is_post_type_archive( 'faq' ) || is_tax( 'faq_cat' ) ) {
		// FAQ.
		return $prefix . 'faq';
	} elseif ( is_singular( 'thread' ) || is_post_type_archive( 'thread' ) || is_tax( 'topic' ) ) {
		// Thead
		return $prefix . 'support';
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
