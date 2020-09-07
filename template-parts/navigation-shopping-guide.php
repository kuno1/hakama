<?php
/**
 * Cart progress template
 *
 * @package hakama
 */

if ( ! hakama_has_woo() || ! ( is_cart() || is_checkout() || is_order_received_page() ) ) {
	return;
}
$path = get_theme_mod( 'path_to_shopping_guide' );
if ( ! $path ) {
	return;
}
$url = home_url( $path );
?>

<a class="shopping-guide-nav" href="<?php echo esc_url( $url ) ?>">
	<i class="fas fa-flag"></i>
	<?php esc_html_e( 'Shoppin Guide', 'hakama' ) ?>
</a>
