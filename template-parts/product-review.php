<?php

$product = hakama_get_current_product();
if ( ! $product ) {
	return;
}
$rating = hakama_get_rating_counts( $product );
$total = 0;
foreach ( $rating as $count ) {
	$total += $count;
}
if ( ! $total ) {
	return;
}
?>

<h3 class="product-buy-subtitle has-text-align-center">
	<?php esc_html_e( 'Product Reviews', 'hakama' ) ?>
</h3>

<div class="review-summary">
	<div class="review-summary-rating">
		<?php woocommerce_template_single_rating() ?>
	</div>
	<div class="review-summary-graph">
		<table class="review-summary-graph-table">
			<?php for ( $rate = 5; $rate > 0; $rate-- ) :
				$count = $rating[ $rate ];
				$ratio = $count ? floor( $count / $total * 100 ) : 0;
			?>
				<tr>
					<th class="text-warning">
						★<?php echo $rate ?>
					</th>
					<td>
						<div class="review-summary-graph-bar">
							<div class="review-summary-graph-bar-inner" style="width: <?php echo (int) $ratio ?>%;"></div>
						</div>
					</td>
					<td class="review-summary-ratio">
						<?php echo number_format( $ratio ) ?>%
					</td>
				</tr>
			<?php endfor; ?>
		</table>
	</div>
</div>

