<?php
$subscribers = hakama_thread_subscribers();

?>
<p class="loop-thread-meta">
	<span class="loop-meta-item">
		<?php esc_html_e( 'Published', 'hakama' ) ?>
		<?php echo hakama_the_date_diff( get_post()->post_date ) ?>
	</span>
	<?php if ( $updated = hakama_post_updated() ) : ?>
		<span class="loop-meta-item">
			<?php esc_html_e( 'Updated: ', 'hakama' ) ?>
			<?php echo hakama_the_date_diff( $updated ) ?>
		</span>
	<?php endif; ?>
	<span class="loop-meta-item" aria-label="<?php esc_attr_e( 'Comment Count', 'hakama' ) ?>">
		<i class="far fa-comment"></i> <?php echo number_format( get_comment_count( get_the_ID() )[ 'approved' ] ) ?>
	</span>
	<?php if ( $subscribers ) : ?>
		<span class="loop-meta-item" aria-label="<?php esc_attr_e( 'Subscribers', 'hakama' ) ?>">
			<i class="fas fa-users"></i> <?php echo number_format( count( $subscribers ) ) ?>
		</span>
	<?php endif; ?>
</p>

<div class="loop-icon">
	<?php if ( 'private' === get_post_status() ) : ?>
		<i class="fas fa-user-lock" title="<?php esc_attr_e( 'Private', 'hakama' ) ?>"></i>
	<?php endif; ?>
</div>
