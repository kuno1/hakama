<?php  ?>

<header class="entry-meta entry-meta-thread">
	<h1 class="entry-title entry-title-with-icon">
		<?php if ( hamethread_is_resolved() ) : ?>
			<span class="entry-title-icon text-success">
				<i class="fas fa-check-circle"></i>
				<span><?php esc_html_e( 'Resolved', 'hakama' ) ?></span>
			</span>
		<?php endif; ?>
		<?php the_title(); ?>
	</h1>


	<div class="entry-meta-author">
		<?php echo hakama_post_author_icon();  ?>

		<?php esc_html_e( 'Author: ', 'hakama' ) ?><?php hakama_the_author(); ?>
	</div>
	<div class="text-right">
		<?php hakama_template( 'entry-meta-data', 'thread' ) ?>
	</div>

</header>

