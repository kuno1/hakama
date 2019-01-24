<header class="entry-meta">
	<h1 class="entry-title">
		<?php if ( 'private' === get_post_status() ) : ?>
			<i class="fa fa-lock entry-title-private"></i>
		<?php endif; ?>
		<?php the_title(); ?>
		<?php if ( 'customer' === hamelp_get_accessibility() ) : ?>
		<small class="entry-title-label">
			<?php esc_html_e( 'Customer Only', 'hakama' ) ?>
		</small>
		<?php endif; ?>
	</h1>
	
	<?php hakama_template( 'entry-meta-data' ) ?>
	
</header>

