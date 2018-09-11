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
		] ) );
	}
	$posts = array_merge( $posts, get_posts( [
		'post_type'   => $post->post_type,
		'post_parent' => $post->ID,
		'post_status' => 'publish',
		'posts_per_page' => -1,
	] ) );
	return $posts;
}
