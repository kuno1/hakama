<li class="loop-faq">
	<a href="<?php the_permalink(); ?>" class="loop-faq-link position-relative">
		<?php if ( $term = hakama_top_category() ) : ?>
		<span class="loop-faq-term"><?php echo esc_html( $term->name ) ?></span>
		<?php endif ?>
		<h2 class="loop-faq-title">
			<?php the_title() ?>
		</h2>
		<p class="loop-meta">
			<span class="loop-meta-item"><?php the_time( get_option( 'date_format' ) ) ?></span>
			<span class="loop-meta-item" aria-label="<?php esc_attr_e( 'Comment Count', 'hakama' ) ?>">
				<i class="far fa-comment"></i> <?php echo number_format( get_comment_count( get_the_ID() )[ 'approved' ] ) ?>
			</span>
			<span class="loop-meta-item" aria-label="<?php esc_attr_e( 'Comment Count', 'hakama' ) ?>">
				<i class="fas fa-user"></i> <?php echo esc_html( hakama_document_owner() ) ?>
			</span>
		</p>
	</a>
</li>
