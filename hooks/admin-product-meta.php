<?php
/**
 * Add product meta data
 *
 * @package hakama
 */


add_action( 'add_meta_boxes', function( $post_type ) {
	if ( 'product' === $post_type ) {
		 add_meta_box( 'hakama-product-meta', __( 'WordPress Requirements', 'hakama' ), function( $post ) {
		 	wp_nonce_field( 'hakama_product_meta', '_hakamaproductnonce', false );
		 	printf( '<p class="description">%s</p>', esc_html__( 'Enter required version. No minor version required. e.g. 4.9', 'hakama' ) );
		 	foreach ( [
		 		'_required_wp_version'  => [
					__( 'Required WordPress Version', 'hakama' ),
					'e.g. 4.9',
				],
				'_tested_up_to'         => [
					__( 'Tested Up To', 'hakama' ),
					'e.g. 4.9 ',
				],
				'_required_php_version' => [
					__( 'Required PHP Version', 'hakama' ),
					'e.g. 5.4',
				],
			] as $key => list( $label, $placeholder ) ) {
		 		$text = <<<'HTML'
				<p>
					<label for="%1$s">%2$s</label>
					<input type="text" name="%1$s" id="%1$s" value="%4$s" placeholder="%3$s" class="widefat" />
				</p>
HTML;
				$value = get_post_meta( $post->ID, $key, true );
				printf( $text, $key, esc_html( $label ), esc_attr( $placeholder ), esc_attr( $value ) );
			}
		 }, $post_type, 'side', 'high' );
		 
		 // Demo Setting.
		add_meta_box( 'hakama-product-demo', __( 'Demo Setting', 'hakama' ), function( $post ) {
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
	if ( ! isset( $_REQUEST['_hakamaproductnonce'] ) || ! wp_verify_nonce( $_REQUEST['_hakamaproductnonce'], 'hakama_product_meta' ) ) {
		return;
	}
	foreach ( [
		'_required_wp_version',
		'_tested_up_to',
		'_required_php_version',
		'_demo_url'
	] as $key ) {
		update_post_meta( $post_id, $key, $_REQUEST[ $key ] );
	}
}, 10, 2 );
