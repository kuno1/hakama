<header class="hakama-admin-header">
	<h1 class="hakama-admin-header-text"><?php bloginfo( 'name' ) ?></h1>
	<?php if ( $back_link = hakama_admin_back_link() ) : ?>
	<a class="hakama-admin-header-back hakama-admin-header-btn" href="<?php echo esc_url( $back_link ) ?>">
		<span class="dashicons dashicons-arrow-left-alt2"></span>
		<span class="screen-reader-text"><?php esc_html_e( 'Back to List', 'hakama' ) ?></span>
	</a>
	<?php endif; ?>
	<a class="hakama-admin-header-menu hakama-admin-header-btn" href="<?php echo esc_url( hakama_admin_dashboard_link() ) ?>">
		<span class="dashicons dashicons-dashboard"></span>
		<span class="screen-reader-text"><?php esc_html_e( 'Dashboard', 'hakama' ) ?></span>
	</a>
</header>
