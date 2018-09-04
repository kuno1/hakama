<?php
/**
 * Help center related functions
 *
 * @package hakama
 */


/**
 * Get term list
 *
 * @param int $product_id
 * @return array
 */
function hakama_terms( $product_id = 0 ) {
	if ( ! $product_id ) {
		$terms = get_terms( [
			'taxonomy'    => 'faq_cat',
			'hide_emepty' => true,
		] );
		return $terms && ! is_wp_error( $terms ) ? $terms : [];
	} else {
		// Get all faq's.
		global $wpdb;
		$query = <<<SQL
			SELECT ID FROM {$wpdb->posts}
			WHERE post_type = 'faq'
			  AND post_status = 'publish'
			  AND post_parent = %d
SQL;
		$ids = implode( ', ', $wpdb->get_col( $wpdb->prepare( $query, $product_id ) ) );
		if ( ! $ids ) {
			return [];
		}
		$query = <<<SQL
			SELECT t.*, tt.* FROM {$wpdb->terms} AS t
			INNER JOIN {$wpdb->term_taxonomy} AS tt
			ON tt.term_id = t.term_id
			WHERE tt.taxonomy = 'faq_cat'
			  AND tt.term_taxonomy_id IN (
				SELECT term_taxonomy_id FROM {$wpdb->term_relationships}
				WHERE object_id IN ({$ids})
			)
SQL;
		return array_map( function( $term ) {
			return new WP_Term( $term );
		}, $wpdb->get_results( $query ) );
	}
}

