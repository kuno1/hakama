<header class="entry-meta">

	<div class="entry-meta-icon">
		<?php if ( in_array( get_post_type(), [ 'faq', 'thread' ] ) ) : ?>
			<?php if ( 'private' === get_post_status() ) : ?>
				<i class="fas fa-lock" title="<?php esc_attr_e( 'Private', 'hakama' ) ?>"></i>
			<?php else : ?>
				<i class="fas fa-lock-open" title="<?php esc_attr_e( 'Public', 'hakama' ) ?>"></i>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( 'customer' === hamelp_get_accessibility() ) : ?>
			<i class="fas fa-user-lock" title="<?php esc_attr_e( 'Customer Only', 'hakama' ) ?>"></i>
		<?php endif; ?>
	</div>

	<?php if ( $term = hakama_top_category() ) : ?>
		<p class="entry-meta-top-term">
			<span class="loop-faq-term"><?php echo esc_html( $term->name ) ?></span>
		</p>
	<?php endif; ?>

	<h1 class="entry-title entry-title-divider">
		<?php the_title(); ?>
	</h1>


	<ul class="entry-meta-data text-right">
		<?php if ( 'private' === get_post_status() ) : ?>
			<li>
				<i class="fa fa-lock"></i>
				<?php esc_html_e( 'Private', 'hakama' ) ?>
			</li>
		<?php endif; ?>
		<li>
			<i class="fa fa-calendar"></i>
			<?php the_date() ?>
		</li>
		<?php if ( $updated = hakama_post_updated() ) : ?>
			<li>
				<i class="fas fa-sync-alt"></i>
				<?php echo hakama_the_date_diff( $updated ) ?>
			</li>
		<?php endif; ?>
		<?php
		$taxonomies = [
			'post' => 'post_tag',
		];
		if ( isset( $taxonomies[ get_post_type() ] ) && has_term( '', $taxonomies[ get_post_type() ] ) ): ?>
			<li>
				<i class="fa fa-tags"></i>
				<?php the_terms( get_the_ID(), $taxonomies[ get_post_type() ], '', ', ' ); ?>
			</li>
		<?php endif; ?>
		<li>
			<?php echo hakama_post_author_icon();  ?>
			<?php hakama_the_author(); ?>
		</li>
	</ul>

</header>

