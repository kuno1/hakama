<?php
global $product;
$files = \Kunoichi\Makibishi\Controller\FileManager::get_latest_downloads( $product );
if ( ! $files ) {
	return;
}
?>
<div class="product-files widget widget-product">

	<h2 class="widget-title widget-product-title">
		<i class="fa fa-file-archive"></i>
		<?php esc_html_e( 'Files', 'hakama' ) ?>
	</h2>
	
	<ul>
		<?php foreach ( $files as $file ) : /** @var WC_Product_Download $file */ ?>
		<li><?= esc_html( $file->get_name() ) ?></li>
		<?php endforeach; ?>
	</ul>
</div>
