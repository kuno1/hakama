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
	foreach ( get_post_taxonomies( $post ) as $taxonomy ) {
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
