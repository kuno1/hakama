<?php
/**
 * Widgets related files.
 *
 * @package hakama
 */

// Register sidebars.
add_action( 'widgets_init', function() {
	register_sidebar( [
		'name' => __( 'Sidebar', 'hakama' ),
		'id'   => 'sidebar',
		'description' => __( 'Displayed as sidebar.', 'hakama' ),
		'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s"><div class="sidebar-widget-inner">',
		'after_widget' => "</div></aside>",
		'before_title' => '<h2 class="widget-title sidebar-widget-title">',
		'after_title' => "</h2>\n",
	] );
	
	register_sidebar( [
		'name' => __( 'Footer', 'hakama' ),
		'id'   => 'footer',
		'description' => __( 'Displayed on footer. Limit 4 widgets.', 'hakama' ),
		'before_widget' => '<aside id="%1$s" class="col-xs-12 col-sm-6 col-md-3 widget footer-widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title footer-widget-title">',
		'after_title' => "</h2>\n",
	] );
	
} );