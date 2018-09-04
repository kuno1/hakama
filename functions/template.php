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
 * Get template group name.
 *
 * @return string
 */
function hakama_template_group() {
	if ( is_singular( 'faq' ) || is_post_type_archive( 'faq' ) || is_tax( 'faq_cat' ) ) {
		return 'faq';
	} elseif ( is_singular( 'thread' ) || is_post_type_archive( 'thread' ) || is_tax( 'topic' ) ) {
		return 'thread';
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
	return (string) apply_filters( 'hakama_copyright_year', date_i18n( 'Y' ) );
}

/**
 * Get archive title
 */
function hakama_archive_title() {
	$title = '';
	if  ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'hakama' ), post_type_archive_title( '', false ) );
	} else {
		$title = get_the_archive_title();
	}
	echo esc_html( $title );
}

/**
 * Render pagination
 *
 * @param null|WP_Query $query
 */
function hakama_pagination( $query = null ) {
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}
	$big = 999999999; // need an unlikely integer
	
	$pagination = paginate_links( [
		'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'  => '?paged=%#%',
		'current' => max( 1, $query->get('paged') ),
		'total'   => $query->max_num_pages
	] );
	if ( ! $pagination ) {
		return;
	}
	$pagination = implode( "\n", array_map( function( $line ) {
		$classes = [ 'page-item' ];
		if ( false !== strpos( $line, 'current' ) ) {
			$classes[] = 'active';
		}
		if ( false !== strpos( $line, 'dots' ) ) {
			$classes[] = 'disabled';
		}
		
		$line = str_replace( 'page-numbers', 'page-link', $line );
		return sprintf( '<li class="%s">%s</li>', implode( ' ', $classes ), $line );
	}, explode( "\n", $pagination ) ) );
	
	echo sprintf( '<nav aria-label="%s"><ul class="pagination">%s</ul></nav>', esc_attr__( 'Pagination.', 'hakama' ), $pagination );
}
