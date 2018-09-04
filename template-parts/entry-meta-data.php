<ul class="entry-meta-data">
	<li>
		<?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
		<?php the_author_posts_link(); ?>
	</li>
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
	<?php if ( current_user_can( 'edit_post', get_the_ID() ) ) : ?>
		<li>
			<i class="fa fa-edit"></i> <?php edit_post_link() ?>
		</li>
	<?php endif; ?>
</ul>
