<?php
/**
 * Post related functions
 */

/**
 * Get related pages link.
 *
 * @param int|WP_Post|null $post
 * @return array
 */
function hakama_page_link( $post = null ) {
	$post = get_post( $post );
	$posts = [];
	if ( $post->post_parent  ) {
		if ( 'publish' === get_post_status( $post->post_parent ) ) {
			$posts[] = get_post( $post->post_parent );
		}
		$posts = array_merge( $posts, get_posts( [
			'post_type'   => $post->post_type,
			'post_parent' => $post->post_parent,
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'suppress_filters' => false,
			'post__not_in' => [ $post->ID ],
		] ) );
	}
	$posts = array_merge( $posts, get_posts( [
		'post_type'   => $post->post_type,
		'post_parent' => $post->ID,
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'suppress_filters' => false,
	] ) );
	return $posts;
}

/**
 * Get loop type
 *
 * @param null $post
 * @return string
 */
function hakama_loop_type( $post = null ) {
	$post = get_post( $post );
	$string = '';
	switch ( $post->post_type ) {
		case 'product':
			$categories = get_the_terms( $post, 'product_cat' );
			if ( $categories && ! is_wp_error( $categories ) ) {
				return current( $categories )->name;
			} else {
				return __( 'Product', 'hakama' );
			}
			break;
		case 'faq':
			return __( 'Document', 'hakama' );
			break;
		case 'thread':
			return __( 'Support', 'hakama' );
			break;
		case 'brand':
			return __( 'Brand', 'makibishi' );
			break;
		case 'post':
			return __( 'Blog', 'hakama' );
			break;
		default:
			return '';
			break;
	}
}

/**
 * Display loop type
 *
 * @param string $before
 * @param string $after
 * @param null|int|WP_Post $post
 */
function hakama_the_loop_type( $before = '', $after = '', $post = null ) {
	$string = hakama_loop_type( $post );
	if ( $string ) {
		echo $before . esc_html( $string ) . $after;
	}
}
