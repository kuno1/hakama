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
 * Get documentation root.
 *
 * @return string
 */
function hakama_documentation_top_page() {
	return get_post_type_archive_link( 'faq' );
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

/**
 * Get author's brand.
 *
 * @return WP_Post
 */
function hakama_get_author_brand( $post = null ) {
	$post   = get_post( $post );
	if ( 'brand' === get_post_type( $post->post_parent ) ) {
		$brand = get_post( $post->post_parent );
		if ( $brand ) {
			return $brand;
		}
	}
	$brands = \Kunoichi\Makibishi\Models\Brand::get_brands( $post->post_author );
	foreach ( $brands as $brand ) {
		return $brand;
	}
	return null;
}

/**
 * Get brand link.
 *
 * @param null|int|WP_Post $post
 *
 * @return string
 */
function hakama_get_author_brand_link( $post = null ) {
	if ( hakama_author_is_admin( $post ) ) {
		return 'Kunoichi';
	} else {
		$brand = hakama_get_author_brand( $post );
		return ! $brand ? '' : sprintf( '<a href="%s">%s</a>', get_permalink( $brand ), get_the_title( $brand ) );
	}
}

/**
 * Get avatar for post author.
 *
 * @param null|int|WP_Post $post
 */
function hakama_post_author_icon( $post = null ) {
	$post           = get_post( $post );
	if ( hakama_author_is_admin( $post ) ) {
		return sprintf( '<img src="%s/assets/img/kunoichi-girl-thumbnail.png" alt="Kunoichi" class="avatar"/>', get_stylesheet_directory_uri() );
	}
	$brand          = hakama_get_author_brand( $post );
	$thumbnail_size = get_option( 'thumbnail_size_w', 150 );
	$avatar         = get_avatar( $post->post_author, $thumbnail_size );
	if ( ! $brand ) {
		return $avatar;
	}
	$thumbnail = get_the_post_thumbnail( $brand, 'thumbnail', [
		'class' => 'avatar',
	] );
	return $thumbnail ?: $avatar;
}

/**
 * Display the author's name.
 *
 * @param null|int|WP_Post $post
 */
function hakama_the_author( $post = null ) {
	$post = get_post( $post );
	$brand_link = hakama_get_author_brand_link();
	if ( $brand_link ) {
		echo wp_kses_post( sprintf( __( '%1$s from %2$s', 'hakama' ), get_the_author_posts_link(), $brand_link ) );
	} else {
		the_author_posts_link();
	}
}

/**
 * Get top categories.
 *
 * @param null|int|WP_Post $post
 * @return WP_Term
 */
function hakama_top_category( $post = null ) {
	$post = get_post( $post );
	$result = null;
	switch ( $post->post_type ) {
		case 'product':
			$taxonomies = [ 'product_cat' ];
			break;
		case 'post':
			$taxonomies = [ 'category' ];
			break;
		case 'thread':
			$taxonomies = [ 'topic' ];
			break;
		case 'faq':
			$taxonomies = [ 'faq_cat' ];
			break;
		default:
			$taxonomies = get_post_taxonomies( $post );
			break;
	}
	foreach ( $taxonomies as $taxonomy ) {
		$terms = get_the_terms( $post, $taxonomy );
		if ( ! $terms || is_wp_error( $terms ) ) {
			continue;
		}
		foreach ( $terms as $term ) {
			$result = $term;
			break 2;
		}
	}
	return $result;
}

/**
 * Get subscribers.
 *
 * @param null|int|WP_Post $post
 * @return int[]
 */
function hakama_thread_subscribers( $post = null ) {
	if ( ! class_exists( '\Hametuha\Thread\Hooks\SupportNotification' ) ) {
		return [];
	}
	return \Hametuha\Thread\Hooks\SupportNotification::get_instance()->get_subscribers( $post );
}

/**
 * Get latest updated time.
 *
 * @param null|int|WP_Post $post
 * @return string
 */
function hakama_post_updated( $post = null ) {
	$post = get_post( $post );
	$updated = get_post_modified_time( 'Y-m-d H:i:s', false, $post );
	if ( function_exists( 'hamethread_get_latest_comment_date' ) ) {
		$comment_updated = hamethread_get_latest_comment_date( $post );
		if ( $comment_updated && $comment_updated > $updated ) {
			$updated = $comment_updated;
		}
	}
	return $post->post_date < $updated ? $updated : '';
}
