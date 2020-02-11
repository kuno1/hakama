<?php
/**
 * Product related functions
 *
 * @package hakama
 */

/**
 * @param null|int|WP_Post $post
 * @param null|string|int|WP_Term $topic
 *
 * @return string
 */
function hakama_support_page( $post = null, $topic = null ) {
	return hakama_child_url( $post, $topic, 'topic', 'support/%d', 'in/%s',  get_post_type_archive_link( 'thread' ) );
}

/**
 * Get docunentation URL
 *
 * @param null|int|WP_Post $post
 * @param null|string|int|WP_Term $topic
 *
 * @return string
 */
function hakama_documentation_url( $post = null, $cat = null ) {
	return hakama_child_url( $post, $cat, 'faq_cat', 'faq/of/%d', 'in/%s', get_post_type_archive_link( 'faq' ) );
}

/**
 * Get child URL
 *
 * @param null|int|WP_Post          $post
 * @param int|string|object|WP_Term $term
 * @param string                    $taxonomy
 * @param string                    $single_url
 * @param string                    $child_suffix
 * @param string                    $root         If set, this URL is used.
 *
 * @return string
 */
function hakama_child_url( $post = null, $term = null, $taxonomy = '', $single_url = '', $child_suffix = 'in/%s', $root = '' ) {
	if ( 0 !== $post ) {
		$post = get_post( $post );
	}
	if ( ! $post || 'product' !== $post->post_type ) {
		return $root ?: home_url();
	}
	if ( ! $single_url ) {
		$single_url = "{$post->post_type}/%d";
	}
	$url = untrailingslashit( home_url( sprintf( $single_url, $post->ID ) ) );
	if ( $term ) {
		if ( is_numeric( $term ) ) {
			$term = get_term_by( 'id', $term, $taxonomy );
		} elseif ( is_string( $term ) ) {
			$term = get_term_by( 'slug', $term, $taxonomy );
		} else {
			$term = get_term( $term, $taxonomy );
		}
		if ( $term && ! is_wp_error( $term ) ) {
			$url .= sprintf( '/' . ltrim( $child_suffix, '/' ), rawurlencode( $term->slug ) );
		}
	}
	return $url;
}

/**
 * Detect if current user is customer.
 *
 * @param null|int|WP_Post $post
 * @param int $user_id
 *
 * @return bool
 */
function hakama_is_customer( $post = null, $user_id = 0 ) {
	if ( ! $user_id && ! ( $user_id = get_current_user_id() ) ) {
		return false;
	}
	$product = wc_get_product( get_post( $post ) );
	// Todo prepare for recurring payment.
	return wc_customer_bought_product( '', $user_id, $product->get_id() );
}

/**
 * Get post parent
 *
 * @param null|int|WP_Post $post
 *
 * @return WP_Post
 */
function hakama_get_brand( $post = null ) {
	return get_post( get_post( $post )->post_parent );
}


/**
 * Get current product.
 *
 * @return WP_Post|null
 */
function hakama_get_current_product() {
	global $wp_query;
	$post_parent = null;
	if ( is_singular() ) {
		if ( is_singular( 'product' ) ) {
			return get_queried_object();
		}
		$post_parent = get_queried_object()->post_parent;
	} else {
		$post_parent = $wp_query->get( 'post_parent' );
	}
	if ( $post_parent ) {
		$post_parent = get_post( $post_parent );
		if ( 'product' === $post_parent->post_type ) {
			return $post_parent;
		}
	}
	return null;
}

/**
 * Get brand thumbnail
 *
 * @param null|int|WP_Post $post
 * @param string           $size
 * @return string
 */
function hakama_brand_thumbnail( $post = null, $size = 'post-thumbnail' ) {
	$brand = hakama_get_brand( $post );
	if ( ! $brand ) {
		return '';
	}
	return get_the_post_thumbnail( $brand, $size );
}

/**
 * Get brand title.
 *
 * @param null|int|WP_Post $post
 * @return string
 */
function hakama_brand_title( $post = null ) {
	return get_the_title( hakama_get_brand( $post ) );
}

/**
 * @return bool
 */
function hakama_is_ex_customer() {
	return false;
}

/**
 * Get total count of cart item.
 *
 * @return int
 */
function hakama_cart_count() {
	if ( ! function_exists( 'WC' ) ) {
		return 0;
	} else {
		return min( 99, WC()->cart->get_cart_contents_count() );
	}
}

/**
 * Display documentation button.
 *
 * @param int    $product_id
 * @param string $label
 * @param string $class
 * @param string $icon
 */
function hakama_document_link( $product_id, $label = '', $class = '', $icon = '' ) {
	if ( ! $label ) {
		$label = __( 'Documentation', 'hakama' );
	}
	$icon = $icon ? sprintf( '<i class="fa fa-%s"></i> ', esc_attr( $icon ) ) : '';
	$label = $icon . esc_html( $label );
	if ( hakama_document_exists( $product_id ) ) {
		printf(
			'<a href="%s" class="%s">%s</a>',
			hakama_documentation_url( $product_id ),
			esc_attr( $class ),
			$label
		);
	} else {
		$class = str_replace( '-primary', '-secondary', $class . ' disabled' );
		printf(
			'<a href="#" class="%s" aria-disabled="true">%s</a>',
			esc_attr( $class ),
			$label
		);
	}
}

/**
 * Detect if document exists.
 *
 * @param int $product_id
 *
 * @return bool
 */
function hakama_document_exists( $product_id ) {
	return (bool) get_posts( [
		'post_type'      => 'faq',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'post_parent'    => $product_id,
	] );
}

/**
 * Detect if user has business information.
 *
 * @param null|int|WP_Post $post
 *
 * @return bool
 */
function hakama_brand_has_business( $post = null ) {
	$post = get_post( $post );
	if ( 'brand' !== $post->post_type ) {
		return false;
	}
	$instance = \Kunoichi\Makibishi\Controller\BrandManager::get_instance();
	if ( ! method_exists( $instance, 'has_valid_gateway' ) ) {
		return false;
	}
	return $instance->has_valid_gateway( $post );
}

/**
 * Get document owner
 *
 * @param null|int|WP_Post $post
 * @return string
 */
function hakama_document_owner( $post = null ) {
	$post = get_post( $post );

	$user = get_userdata( $post->post_author );
	if ( $user->has_cap( 'edit_others_posts' ) ) {
		return 'Kunoichi INC';
	} else {
		$brand = null;
		switch ( $post->post_type ) {
			case 'product':
				$brand = get_post( $post->post_parent );
				break;
			default:
				if ( $post->post_parent ) {
					$brand = wp_get_post_parent_id( $post->post_parent );
				}
				break;
		}
		return $brand ? get_the_title( $brand ) : $user->display_name;
	}
}

/**
 * Get document title.
 *
 * @param null|WP_Post $post
 * @return string
 */
function hakama_product_title( $post = null ) {
	$post = get_post( $post );
	if ( is_singular( 'faq' ) || is_post_type_archive( 'faq' ) || is_tax( 'faq_cat' ) ) {
		$title = sprintf( '%s<small>%s</small>', get_the_title( $post ), __( 'Document', 'hakama' ) );
	} elseif ( is_singular( 'thread' ) || is_post_type_archive( 'thread' ) || is_tax( 'topic' ) ) {
		$title = sprintf( '%s<small>%s</small>', get_the_title( $post ), __( 'Support Forum', 'hakama' ) );
	} else {
		$title = get_the_title( $post );
	}
	return wp_kses_post( $title );
}

/**
 *
 *
 * @param null|int|WP_Post $post
 * @param int|null         $user
 * @return bool
 */
function hakama_can_read_post( $post = null, $user = null ) {
	$post = get_post( $post );
	if ( is_null( $user ) ) {
		$user = get_current_user_id();
	}
	return false;

}

/**
 * Get latest version
 *
 * @param null|int|WP_Post $post
 * @return string
 */
function hakama_get_latest_version( $post = null ) {
	$info = hakama_get_plugin_info( $post );
	return isset( $info['version'] ) ? $info['version'] : '';
}

/**
 * Get plugin updated.
 *
 * @param null|int|WP_Post $post
 * @return mixed|string
 */
function hakama_get_last_updated( $post = null ) {
	$info = hakama_get_plugin_info( $post );
	return ! empty( $info['last_updated'] ) ? get_date_from_gmt( $info['last_updated'] ) : '';
}

/**
 * Get latest plugin information.
 *
 * @param null|int|WP_Post $post
 * @return array
 */
function hakama_get_plugin_info( $post = null ) {
	$product = wc_get_product( $post );
	return \Kunoichi\Makibishi\Controller\FileManager::get_downloads_api_value( $product );
}
