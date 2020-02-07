<?php
$topics      = get_the_terms( null, 'topic' );
$subscribers = hakama_thread_subscribers();
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
			<?php if ( $topics && ! is_wp_error( $topics ) ) : ?>
			<span class="loop-meta-item">
				<i class="fas fa-tag"></i> <?php echo esc_html( implode( ', ', array_map( function( $term ) {
					return $term->name;
				}, $topics ) ) ) ?>
			</span>
			<?php endif; ?>
		</p>

		<p class="loop-thread-meta">
			<span class="loop-meta-item">
				<?php esc_html_e( 'Published', 'hakama' ) ?>
				<?php the_time( get_option( 'date_format' ) ) ?>
			</span>
			<?php if ( true ) ?>
			<span class="loop-meta-item">

			</span>
			<?php ?>
			<span class="loop-meta-item" aria-label="<?php esc_attr_e( 'Comment Count', 'hakama' ) ?>">
				<i class="far fa-comment"></i> <?php echo number_format( get_comment_count( get_the_ID() )['approved'] ) ?>
			</span>
			<?php if ( $subscribers ) : ?>
				<span class="loop-meta-item" aria-label="<?php esc_attr_e( 'Subscribers', 'hakama' ) ?>">
				<i class="fas fa-users"></i> <?php echo number_format( count( $subscribers ) ) ?>
			</span>
			<?php endif; ?>
		</p>

		<div class="loop-icon">
			<?php if ( 'private' === get_post_status() ) : ?>
			<i class="fas fa-user-lock"></i>
			<?php endif; ?>
		</div>
	</a>
</li>
