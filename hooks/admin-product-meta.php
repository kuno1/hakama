<?php
/**
 * Add product meta data
 *
 * @package hakama
 */


add_action( 'add_meta_boxes', function( $post_type ) {
	if ( 'product' === $post_type ) {
		 // Demo Setting.
		add_meta_box( 'hakama-product-demo', __( 'Demo Setting', 'hakama' ), function( $post ) {
		    wp_nonce_field( 'hakama_product_meta', '_hakamaproductnonce', false );
			?>
			<p class="description">
				<?php esc_html_e( 'Enter demo URL for your theme/plugin.', 'hakama' ) ?>
			</p>
			<p class="description">
				<label for="demo_url">
					<?php esc_html_e( 'Demo URL', 'hakama' ) ?>
				</label><br/>
				<input id="demo_url" name="_demo_url" type="url" class="widefat" value="<?php echo esc_attr( get_post_meta( $post->ID, '_demo_url', true ) ) ?>" />
			</p>
			<?php
		}, $post_type, 'side', 'high' );
	}
} );


/**
 * Save post meta for product.
 *
 * @param int     $post_id
 * @param WP_Post $post
 */
add_action( 'save_post', function( $post_id, $post ) {
    if ( ( 'product' !== $post->post_type ) || ! wp_verify_nonce( filter_input( INPUT_POST, '_hakamaproductnonce' ), 'hakama_product_meta' ) ) {
        return;
    }
	foreach ( [
		'_demo_url'
	] as $key ) {
		update_post_meta( $post_id, $key, $_REQUEST[ $key ] );
	}
}, 10, 2 );
