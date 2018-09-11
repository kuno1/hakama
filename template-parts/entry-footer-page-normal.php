

<footer class="entry-footer">
	
	<?php if ( $pages = hakama_page_link() ) : ?>
	
	<h2 class="entry-footer-title"><?php esc_html_e( 'Related Pages', 'hakama' ); ?></h2>
	
	<ul class="loop-list loop-list-with-sidebar related-page">
		<?php
		foreach ( $pages as $post ) {
			setup_postdata( $post );
			hakama_template( 'loop', get_post_type() );
		}
		wp_reset_postdata();
		?>
	</ul>
	
	<?php endif; ?>
	
</footer>
