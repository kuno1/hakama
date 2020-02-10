<p class="copyright">
	&copy; <?php echo esc_html( hakama_copyright_year() ); ?> <a class="copyright-link" href="<?php echo home_url() ?>"><?php bloginfo( 'name' ) ?></a>
	<?php the_privacy_policy_link( ' / ' ); ?>
	<?php if ( $terms_of_service = wc_get_page_id( 'terms' ) ) : ?>
		/ <a href="<?php the_permalink( $terms_of_service ); ?>"><?php echo esc_html( get_the_title( $terms_of_service ) ) ?></a>
	<?php endif; ?>
</p>
