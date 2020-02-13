<?php
$topics = get_the_terms( null, 'topic' );
?>
<li class="loop-thread">
	<a class="loop-thread-link" href="<?php the_permalink(); ?>">

		<h2 class="loop-thread-title">
			<?php if ( hamethread_is_resolved() ) : ?>
				<i class="fas fa-check-circle text-success"></i>
			<?php endif; ?>
			<span class="loop-thread-text"><?php the_title() ?></span>
		</h2>


		<p class="loop-thread-meta">
			<span class="loop-meta-item">
				<?php esc_html_e( 'Author: ', 'hakama' ) ?>
				<?php the_author(); ?>
			</span>
			<?php if ( $topics && !is_wp_error( $topics ) ) : ?>
				<span class="loop-meta-item">
				<i class="fas fa-tag"></i> <?php echo esc_html( implode( ', ', array_map( function ( $term ) {
						return $term->name;
					}, $topics ) ) ) ?>
			</span>
			<?php endif; ?>
		</p>

		<?php hakama_template( 'entry-meta-data-thread' ); ?>

	</a>
</li>
