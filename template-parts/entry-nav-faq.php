<?php
$product_id = hakama_document_parent();
$home       = $product_id ? home_url( sprintf( '/faq/of/%d', $product_id ) ) : get_post_type_archive_link( 'faq' );
$home_is_active = $product_id ? is_post_type_archive( 'faq' ) && ! is_tax( 'faq_cat' ) : is_post_type_archive( 'faq' );
$terms = hakama_terms( $product_id );
?>
<nav class="category-nav">
	<ul class="nav nav-pills">
		<li class="nav-item">
			<a class="nav-link<?php echo $home_is_active ? ' active' : '' ?>" href="<?php echo $home ?>">
				<?php esc_html_e( 'All', 'hakama' ) ?>
			</a>
		</li>
		<?php foreach ( $terms as $term ) : ?>
			<li class="nav-item">
				<a class="nav-link<?php echo is_tax( 'faq_cat', $term->slug ) ? ' active' : '' ?>" href="<?php echo $product_id ? home_url( sprintf( '/faq/of/%d/in/%s', $product_id, $term->slug ) ) : get_term_link( $term ) ?>">
					<?php echo esc_html( $term->name ) ?>
				</a>
			</li>
		<?php endforeach; ?>
		<?php if ( is_search() ) : ?>
		<li class="nav-item">
			<a class="nav-link disabled" href="#">
				<?php esc_html_e( 'Searching:', 'hakama' ) ?>
				<?php the_search_query() ?>
			</a>
		</li>
		<?php endif ?>
	</ul>
</nav>
