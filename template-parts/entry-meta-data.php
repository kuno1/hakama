<ul class="entry-meta-data">
	<li>
		<?php echo hakama_post_author_icon();  ?>
		<?php hakama_the_author(); ?>
	</li>
	<?php if ( 'private' === get_post_status() ) : ?>
		<li>
			<i class="fa fa-lock"></i>
			<?php esc_html_e( 'Private', 'hakama' ) ?>
		</li>
	<?php endif; ?>
	<?php if ( hamethread_is_resolved() ) : ?>
		<li class="entry-meta-data-resolved">
			<i class="fa fa-check-circle"></i>
			<?php esc_html_e( 'Resolved', 'hakama' ) ?>
		</li>
	<?php endif; ?>
	<li>
		<i class="fa fa-calendar"></i>
		<?php the_date() ?>
	</li>
	<?php foreach ( [ 'post_tag',  'faq_cat', 'topc' ] as $taxonomy ) : ?>
		<?php if ( has_term( '', $taxonomy ) ) : ?>
			<li class="entry-tags">
				<i class="fa fa-tags"></i>
				<?php the_terms( get_the_ID(), $taxonomy, '', '' ); ?>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
