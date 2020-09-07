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
<div class="row mt-4 justify-content-end">
	<p class="col-6 text-center">
		<a class="btn btn-link btn-sm" href="<?php echo wc_get_page_permalink( 'shop' ) ?>">
			<i class="far fa-arrow-alt-circle-left"></i>
			<?php esc_html_e( 'Continue Shopping', 'hakama' ) ?>
		</a>
	</p>
</div>
