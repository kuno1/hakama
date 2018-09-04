<?php get_header( 'meta' ); ?>

<header class="site-header" role="banner">
	
	<div class="site-header-brand">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo() ?>
		<?php else : ?>
			<a class="custom-logo-link" href="<?php echo home_url() ?>" rel="home">
				<span class="site-header-brand-text"><?php bloginfo( 'name' ) ?></span>
			</a>
		<?php endif; ?>
	</div>
	
	<nav class="site-header-nav">
		<ul class="site-header-lists">
		
		<?php if ( is_user_logged_in() ) : ?>
			<li class="site-header-list">
				<a class="site-header-list-link btn btn-link" href="<?php echo hakama_account_url(); ?>">
					<?php echo get_avatar( get_current_user_id(), 24, '', hakama_short_name(), [ 'class' => 'site-header-avatar' ] ) ?>
					<span class="d-none d-md-inline"><?php printf( __( 'Howdy, %s!', 'hakama' ), hakama_short_name() ) ?></span>
				</a>
			</li>
		<?php else : ?>
			<li class="site-header-list">
				<a class="site-header-list-link btn btn-link" href="<?php echo hakama_login_url( $_SERVER['REQUEST_URI'] ) ?>">
					<?php esc_html_e( 'Sign In', 'hakama' ) ?>
				</a>
			</li>
			<li class="site-header-list">
				<a class="site-header-list-link btn btn-link" href="<?php echo wp_registration_url() ?>">
					<?php esc_html_e( 'Sign Up', 'hakama' ) ?>
				</a>
			</li>
		<?php endif; ?>
		
			<li class="site-header-list site-header-list-search">
				<button class="btn btn-outline-light">
					<i class="fa fa-search"></i>
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'hakama' ) ?></span>
				</button>
			</li>
		
			<li class="site-header-list site-header-list-cart">
				<button class="btn btn-outline-light">
					<i class="fa fa-shopping-cart"></i>
					<span class="screen-reader-text"><?php esc_html_e( 'Cart', 'hakama' ) ?></span>
				</button>
			</li>
		</ul>
		
	</nav>
	
</header>

<?php do_action( 'hakama_header_notification' ); ?>

<?php if ( has_nav_menu( 'global_menu' ) ) : ?>
<nav class="global-nav" role="navigation">
	<div class="container">
		<button class="global-nav-toggle">
			<i class="fa fa-bars"></i>
			<i class="fa fa-times"></i>
			<?php esc_html_e( 'Menu', 'hakama' ) ?>
		</button>
		<?php wp_nav_menu( [
			'location'        => 'global_menu',
			'container_class' => 'global-nav-list',
			'menu_class'      => 'global-nav-item',
			'depth'           => 3,
		] ) ?>
	</div>
</nav>
<?php endif; ?>

