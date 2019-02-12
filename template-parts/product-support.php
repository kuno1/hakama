<?php
/** @var WC_Product $product */
global $product;
?>
<div class="product-support widget widget-product">

	<h2 class="widget-title widget-product-title">
		<i class="fa fa-file-signature"></i> <?php esc_html_e( 'Documentation', 'hakama' ) ?>
	</h2>
	
	<?php if ( $terms = hakama_terms( $product->get_id() ) ) : ?>
		<ul class="product-support-list nav flex-column  nav-pills">
			<?php foreach ( $terms as $term ) : ?>
				<li class="nav-item">
					<a href="<?php echo hakama_documentation_url( $product->get_id(), $term ) ?>"
					   class="btn btn-outline-secondary btn-block">
						<?php echo esc_html( $term->name ) ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p class="text-muted"><?php esc_html_e( 'This product has no document!', 'hakama' ) ?></p>
	<?php endif; ?>

	<h2 class="widget-title widget-product-title">
		<i class="fa fa-life-ring"></i>
		<?php esc_html_e( 'Support Forum', 'hakama' ) ?>
	</h2>
	<ul class="product-support-list nav flex-column  nav-pills">
		<li class="nav-item">
			<a href="<?php echo hakama_support_page( $product->get_id() ) ?>"
			   class="btn btn-outline-secondary btn-block text-center">
				<?php esc_html_e( 'See Support Forum', 'hakama' ) ?>
			</a>
			<div class="description text-muted mt-1">
				<?php esc_html_e( 'Every customer can make new thread to get support.', 'hakama' ) ?>
			</div>
		</li>
	</ul>

	<h2 class="widget-title widget-product-contact">
		<i class="far fa-envelope"></i>
		<?php esc_html_e( 'Contact Author', 'hakama' ) ?>
	</h2>
	
	<a href="<?php echo add_query_arg( [ 'product-id' => get_the_ID() ], home_url( 'contact-author' ) ); ?>" class="btn btn-block btn-outline-secondary"><?php esc_html_e( 'Contact', 'hakama' ) ?></a>
	
	<p class="description text-muted mt-1">
		<?php esc_html_e( 'Do you have something to ask plugin/theme to? Feel free to contact.', 'hakama' ) ?>
	</p>
	
</div>
