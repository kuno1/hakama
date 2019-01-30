<?php
/** @var int $user_id */
wp_enqueue_script( 'makibishi-shop-detail' );
$js = <<<JS
	new Vue({
		el: '#brand-detail'
	});
JS;
wp_add_inline_script( 'makibishi-shop-detail', $js );
?>
<div id="brand-detail" class="seller-submission-business" style="position: relative">
	<shop-detail id="<?php echo esc_attr( $user_id ) ?>"></shop-detail>
</div>
