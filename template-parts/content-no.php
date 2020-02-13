<div class="no-content">

	<h1 class="no-content-title text-center">
		404
		<small>Page Not Found</small>
	</h1>

	<div class="entry-content no-content-entry">
		<p class="text-center">
			<img src="<?php echo get_template_directory_uri() ?>/assets/img/kunoichi-girl-thumbnail.png" alt="" width="50" height="50" class="no-content-img" />
		</p>
		<p class="text-center">
			<?php esc_html_e( 'Nothing found for your criteria.', 'hakama' ) ?>
		</p>
		<p class="text-center">
			<?php esc_html_e( 'If you are from external site, the link might be wrong.', 'hakama' ); ?><br />
			<?php esc_html_e( 'Please check URL.', 'hakama' ) ?>
		</p>
		<p class="text-center">
			<?php esc_html_e( 'Also please try search with other keywords.', 'hakama' ) ?>
		</p>
		<p class="text-center mb-5">
			<?php echo wp_kses_post( sprintf( __( 'In case you cannnot find any alternatives, please get our <a href="%s">support</a>.', 'hakama' ), hakama_support_page() ) ); ?>
		</p>

		<figure class="wp-block-pullquote has-background has-light-background-color is-style-solid-color mb-5">
			<blockquote>
				<p><?php esc_html_e( 'There will always, one can assume, be need for some selling. But the aim of marketing is to make selling superfluous.', 'hakama' ) ?></p>
				<cite>Peter F Drucker</cite>
			</blockquote>
		</figure>

		<div class="alignwide has-light-background-color">
			<?php get_search_form() ?>
		</div>
	</div>

</div><!-- //.no-content -->
