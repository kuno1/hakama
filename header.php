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
		<?php elseif ( !hakama_has_woo() || ! is_page( wc_get_page_id( 'myaccount' ) ) ) : ?>
			<li class="site-header-list">
				<a class="site-header-list-link btn btn-link" href="<?php echo hakama_login_url( $_SERVER['REQUEST_URI'] ) ?>">
					<?php esc_html_e( 'Sign In', 'hakama' ) ?>
				</a>
			</li>
			<li class="site-header-list">
				<a class="site-header-list-link btn btn-link" href="<?php echo hakama_registration_url() ?>">
					<?php esc_html_e( 'Sign Up', 'hakama' ) ?>
				</a>
			</li>
		<?php endif; ?>

			<li class="site-header-list site-header-list-search">
				<button class="btn btn-outline-light" data-toggle="modal" data-target="#search-form">
					<i class="fa fa-search"></i>
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'hakama' ) ?></span>
				</button>
			</li>

			<?php if ( hakama_has_woo() && ! is_cart() ) : ?>
			<li class="site-header-list site-header-list-cart">
				<button class="btn btn-outline-light cart-btn" data-toggle="dropdown">
					<i class="fa fa-shopping-cart"></i>
					<span class="screen-reader-text"><?php esc_html_e( 'Cart', 'hakama' ) ?></span>
					<?php if ( $count = hakama_cart_count() ) : ?>
					<span class="cart-count"><?php echo $count ?></span>
					<?php endif; ?>
				</button>
				<div class="dropdown-menu dropdown-menu-right cart-dropdown">
					<?php the_widget( 'WC_Widget_Cart' ) ?>
				</div>
			</li>
			<?php endif; ?>
		</ul>

	</nav>

</header>

<?php if ( has_nav_menu( 'global_menu' ) ) : ?>
<nav class="global-nav" role="navigation">
	<div class="container">
		<button class="global-nav-toggle">
			<i class="fa fa-bars"></i>
			<i class="fa fa-times"></i>
			<?php esc_html_e( 'Menu', 'hakama' ) ?>
		</button>
		<?php wp_nav_menu( [
			'theme_location'  => 'global_menu',
			'container_class' => 'global-nav-list',
			'menu_class'      => 'global-nav-item',
			'depth'           => 3,
		] ) ?>
	</div>
</nav>
<?php endif; ?>

<?php do_action( 'hakama_header_notification' ); ?>
