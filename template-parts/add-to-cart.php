<?php
$product = get_query_var(  'product-id' );
if ( is_numeric( $product ) ) {
	$product = get_post( $product );
} else {
	$product = hakama_get_current_product();
}
if ( ! $product ) {
	return;
}

?>
<div class="product-add-to-cart">
	<header class="product-header product-add-to-cart-header">
		<h2 class="product-title product-add-to-cart-title"><?php the_title() ?></h2>
		<?php if ( $category = hakama_top_category() ) : ?>
			<div class="add-to-cart-type product-type">
				<?php echo esc_html( $category->name ) ?>
			</div>
		<?php endif; ?>
		<?php woocommerce_template_loop_price(); ?>
	</header>

	<div class="product-add-to-cart-meta">
		<h3 class="f-serif has-text-align-center is-style-separator">
			<?php esc_html_e( 'Downloadable Files', 'hakama' ) ?>
		</h3>
		<p class="text-center">
			<?php
			$files = class_exists( 'Kunoichi\Makibishi\Controller\FileManager' )
				? \Kunoichi\Makibishi\Controller\FileManager::get_downloads( $product->ID )
				: [];
			if ( $files ) : ?>
				<?php foreach ( $files as $file ) : /** @var WC_Product_Download $file */ ?>
					<span class="product-file"><?= esc_html( $file->get_name() ) ?></span>
				<?php endforeach; ?>
			<?php else : ?>

			<?php endif; ?>
		</p>
	</div>

	<div class="product-add-to-cart-buttons">

		<?php woocommerce_template_single_add_to_cart() ?>

	</div>

	<footer class="product-add-to-cart-footer">

		<p class="product-meta-paragraph text-center">
			<?php foreach ( [
					[ '_required_wp_version', esc_html__( 'Required WordPress Version', 'hakama' ), __( ' and over', 'hakama' ) ],
					[ '_tested_up_to', esc_html__( 'Tested Up To', 'hakama' ), '.x' ],
					[ '_required_php_version', esc_html__( 'Required PHP Version', 'hakama' ), __( ' and over', 'hakama' ) ],
				] as $index => list( $key, $label, $suffix ) ) {
				if ( $index ) {
					echo '<span class="product-meta-divider"></span>';
				}
				if ( !( $value = get_post_meta( $product->ID, $key, true ) ) ) {
					$value = '---';
				}

				printf( '<span>%s</span>', esc_html( implode( ' ', [ $label, $value, $suffix ] ) ) );
			} ?>
		</p>

	</footer>
</div>
