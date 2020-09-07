<?php
/**
 * Cart progress template
 *
 * @package hakama
 */

if ( ! hakama_has_woo() || ! ( is_cart() || is_checkout() || is_order_received_page() ) ) {
	return;
}
?>

<div class="cart-progress">

	<ol class="cart-progress-nav">
		<li class="cart-progress-item<?php echo is_cart() ? ' active' : '' ?>">
			<i class="cart-progress-icon fas fa-shopping-cart"></i>
			<span class="cart-progress-label"><?php esc_html_e( 'Checking Cart', 'hakama' ) ?></span>
			<span class="cart-progress-dot"></span>
		</li>
		<li class="cart-progress-item<?php echo ( is_checkout() && ! is_order_received_page() ) ? ' active' : '' ?>">
			<i class="cart-progress-icon fas fa-cash-register"></i>
			<span class="cart-progress-label"><?php esc_html_e( 'Checkout', 'hakama' ) ?></span>
			<span class="cart-progress-dot"></span>
		</li>
		<li class="cart-progress-item<?php echo is_order_received_page() ? ' active' : '' ?>">
			<i class="cart-progress-icon fas fa-luggage-cart"></i>
			<span class="cart-progress-label"><?php esc_html_e( 'Order Received', 'hakama' ) ?></span>
			<span class="cart-progress-dot"></span>
		</li>
	</ol>

</div>

