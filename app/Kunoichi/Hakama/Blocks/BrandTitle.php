<?php

namespace Kunoichi\Hakama\Blocks;


use Kunoichi\Hakama\Pattern\KunoichiBlockBase;

class BrandTitle extends KunoichiBlockBase {

	protected function filter_attributes( $args ) {
		$args['attributes'] = [
			'id' => [
				'type'    => 'integer',
				'default' => 0,
			],
			'title' => [
				'type'    => 'string',
				'default' => '',
			],
		];
		return $args;
	}

	public function render_callback( $attributes = [], $content = '' ) {
		$attributes = wp_parse_args( $attributes, [
			'id'    => 0,
			'title' => __( 'Contact to %s', 'hakama' ), // translators: %s is brand name.
		] );
		$id    = $attributes['id'];
		if ( ! $id ) {
			if ( is_singular() ) {
				$post = get_queried_object();
				// Check post parent.
				if ( $post->post_parent && 'brand' === get_post_type( $post->post_parent ) ) {
					$id = $post->post_parent;
				}
				// Check query vars.
				if ( $product_id = filter_input( INPUT_GET, 'product-id' ) ) {
					$product_parent = wp_get_post_parent_id( $product_id );
					if ( 'brand' === get_post_type( $product_parent ) ) {
						$id = $product_parent;
					}
				}
			} elseif ( $this->is_rest() ) {
				// Retrieve random brand.
				foreach ( get_posts( [
					'post_type'   => 'brand',
					'post_status' => 'publish',
					'meta_query' => [
						[
							'key'     => '_thumbnail_id',
							'value'   => '0',
							'compare' => '>'
						],
					],
				] ) as $post ) {
					$id = $post->ID;
				}
			}
		}
		$brand = $id ? get_post( $id ) : null;
		if ( ! $brand || 'brand' !== $brand->post_type ) {
			$brand = null;
		}
		if ( ! $brand && $this->is_rest() ) {
			return $this->get_placeholder_for_editor( __( 'No Brand Found', 'hakama' ), __( 'Specify brand ID or else brand will be automatically retrieved. If no brand, simply ignored.', 'hakama' ) );
		}
		return self::render_html( $brand, $attributes['title'] );
	}

	/**
	 * Get brand content.
	 *
	 * @param \WP_Post $brand
	 * @param string $title
	 * @return string
	 */
	public static function render_html( $brand, $title = '' ) {
		if ( ! $title ) {
			$title = __( 'Contact to %s', 'hakama' );
		}
		ob_start();
		?>
		<div class="brand-title-block">
			<?php if ( has_post_thumbnail( $brand ) ) : ?>
				<?php echo get_the_post_thumbnail( $brand, 'post-thumbnail', [ 'class' => 'brand-title-block-img' ] ) ?>
			<?php endif; ?>
			<h2 class="brand-title-block-text"><?php echo esc_html( sprintf( $title, get_the_title( $brand ) ) ) ?></h2>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}
