<div class="no-content">
	
	<h3 class="no-content-title">
		<?php esc_html_e( 'Nothing found for your criteria...', 'hakama' ) ?>
	</h3>

	<ul class="no-content-list">
		<li>
			<?php esc_html_e( 'Please try searching with other keywords.', 'hakama' ) ?>
			<button data-toggle="modal" data-target="#search-form" class="btn btn-primary btn-sm">
				<?php esc_html_e( 'Search', 'hakama' ) ?>
			</button>
		</li>
		<li>
			<?php esc_html_e( 'If you are from external site, link might be wrong. Please check URL.', 'hakama' ) ?>
		</li>
		<li>
			<?php echo wp_kses_post( sprintf( __( 'In case you find any alternatives, please get our <a href="%s">support</a>.', 'hakama' ), hakama_support_page() ) ); ?>
		</li>
	</ul>
	
	<img class="no-content-img" src="<?php echo get_template_directory_uri() ?>/assets/img/not-found.jpg" alt="not found" />
	
</div><!-- //.no-content -->
