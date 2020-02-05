<?php get_header( 'meta' ); ?>

<header class="site-header" role="banner">

	<div class="container site-header-container">

		<div class="site-header-brand">
			<a href="<?php echo home_url() ?>" rel="home" class="site-header-brand-link" title="<?php bloginfo( 'name' ) ?>">
				<img class="site-header-logo-symbol"
					 src="<?php echo get_template_directory_uri() ?>/src/img/kunoichi-logo.svg"
					 alt="<?php bloginfo( 'name' ); ?>" width="50" height="50" />
				<img class="site-header-logo-type"
					 src="<?php echo get_template_directory_uri() ?>/src/img/kunoichi-type.svg"
					 alt="<?php bloginfo( 'description' ); ?>" width="300" height="50" />
			</a>
		</div>

		<nav class="site-header-nav">
			<ul class="site-header-lists">

				<li class="site-header-list site-header-list-left site-header-menu">
					<button class="site-header-button" id="global-nav-toggle">
						<i class="fas fa-bars"></i>
						<i class="fas fa-times"></i>
						<span class="site-header-label"><?php esc_html_e( 'Search Products', 'hakama' ) ?></span>
					</button>
				</li>

				<li class="site-header-list site-header-list-left site-header-list-search">
					<button class="site-header-button" data-toggle="modal" data-target="#search-form">
						<i class="fa fa-search"></i>
						<span class="site-header-label"><?php esc_html_e( 'Search Products', 'hakama' ) ?></span>
					</button>
				</li>

				<?php if ( is_user_logged_in() ) : ?>
					<li class="site-header-list">
						<a class="site-header-button" href="<?php echo hakama_account_url(); ?>">
							<?php echo get_avatar( get_current_user_id(), 30, '', hakama_short_name(), [ 'class' => 'site-header-avatar' ] ) ?>
							<span class="site-header-label"><?php printf( __( 'Howdy, %s!', 'hakama' ), hakama_short_name() ) ?></span>
						</a>
					</li>
				<?php elseif ( !hakama_has_woo() || !is_page( wc_get_page_id( 'myaccount' ) ) ) : ?>
					<li class="site-header-list site-header-list-login">
						<a class="site-header-button"
						   href="<?php echo hakama_login_url( $_SERVER[ 'REQUEST_URI' ] ) ?>">
							<?php esc_html_e( 'Sign In', 'hakama' ) ?>
						</a>
					</li>
					<li class="site-header-list site-header-list-signup">
						<a class="site-header-button" href="<?php echo hakama_registration_url() ?>">
							<?php esc_html_e( 'Sign Up', 'hakama' ) ?>
						</a>
					</li>
				<?php endif; ?>


				<?php if ( hakama_has_woo() && !is_cart() ) : ?>
					<li class="site-header-list site-header-list-cart">
						<a class="site-header-button" href="<?php echo wc_get_cart_url() ?>">
							<span class="screen-reader-text"><?php esc_html_e( 'Cart', 'hakama' ) ?></span>
							<i class="fa fa-shopping-cart"></i>
							<?php if ( $count = hakama_cart_count() ) : ?>
								<span class="site-header-count"><?php echo $count ?></span>
							<?php endif; ?>
						</a>
					</li>
				<?php endif; ?>
			</ul>

		</nav>

	</div>

</header>

<?php if ( has_nav_menu( 'global_menu' ) ) : ?>
<nav class="global-nav" role="navigation">
	<div class="container">
		<?php wp_nav_menu( [
			'theme_location'  => 'global_menu',
			'container_class' => 'global-nav-list',
			'menu_class'      => 'global-nav-item',
			'depth'           => 2,
		] ) ?>
	</div>
</nav>
<?php endif; ?>

<?php do_action( 'hakama_header_notification' ); ?>
