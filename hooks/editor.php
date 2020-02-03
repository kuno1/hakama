<?php
/**
 * Editor related functions
 *
 * @package hakama
 */

/**
 * Allow gutenberg to edit.
 *
 * @param bool   $can_edit
 * @param string $post_type
 * @return bool
 */
add_filter( 'gutenberg_can_edit_post_type', function( $can_edit, $post_type ) {
	switch ( $post_type ) {
		case 'page':
		case 'post':
			return true;
			break;
		default:
			return $can_edit;
			break;
	}
}, 10, 2 );

/**
 * Remove header and sidebar from admin screen.
 *
 * @param string $page
 */
add_action( 'admin_enqueue_scripts', function( $page ) {
	$screen = get_current_screen();
	if ( ! current_user_can( 'edit_others_posts' ) ) {
		wp_enqueue_style( 'hakama-editor' );
		// Render admin header.
		add_action( 'admin_footer', function() {
			if ( ! current_user_can( 'edit_others_posts' ) ) {
				hakama_template( 'header-admin' );
			}
		} );
	}
} );


/**
 * Change admin style for post editor.
 *
 * @param mixed  $result
 * @param string $option
 * @param WP_User $user
 * @return mixed
 */
add_filter( 'get_user_option_admin_color', function( $result, $option, $user ) {
	return 'midnight';
}, 10, 3 );

/**
 * Add admin body class.
 */
add_filter( 'admin_body_class', function( $classes ) {
	$screen = get_current_screen();
	if ( 'post' !== $screen->base ) {
		return $classes;
	}
	$classes = array_filter( explode( ' ', $classes ) );
	global $post;
	$classes[] = 'editing-post';
	$classes[] = 'editing-type-' . $post->post_type;
	$template = get_page_template_slug( $post->ID );
	if ( $template ) {
		$classes[] = 'editing-in-' . str_replace( '.php', '', $template );
	}
	return implode( ' ', $classes );
} );

/**
 * Load editor style.
 */
add_action( 'enqueue_block_editor_assets', function() {
	$version = wp_get_theme()->get( 'Version' );
	// Default editor styles.
	wp_enqueue_style( 'hakama-block-editor-style' );
	// Register block styles.
	wp_enqueue_script( 'hakama-block-style' );
} );

/**
 * Add Blocks for editor.
 */
add_action( 'init', function() {
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	foreach ( [
		'section'   => [],
		'container' => [],
		'blogs'     => [
			'attributes' => [
				'category' => [
					'type'    => 'int',
					'default' => 0,
				],
				'limit' => [
					'type'    => 'int',
					'default' => 3,
				],
			],
			'render_callback' => function( $attributes = [], $content = '' ) {
				return hakama_avoid_the_content( hakama_template( 'block', 'blogs', $attributes, false ) );
			}
		],
	] as $block => $setting ) {
		$block_name = "hakama/{$block}";
		$default = [];
		foreach ( [
			'style'  => 'css',
			'script' => 'js',
		] as $asset => $dir ) {
			$rel_path = "/assets/{$dir}/block/{$block}.{$dir}";
			$path = get_template_directory() . $rel_path;
			if ( ! file_exists( $path ) ) {
				continue;
			}
			$handle  = "hakama-block-{$block}";
			$version = filemtime( $path );
			$url     = get_template_directory_uri() . $rel_path;
			if ( 'style' === $asset ) {
				wp_register_style( $handle, $url, [], $version );
			} else {
				wp_register_script( $handle, $url, [ 'wp-i18n', 'wp-editor', 'wp-blocks', 'wp-components' ], $version );
			}
			$default[ 'editor_' . $asset ] = $handle;
		}
		register_block_type( $block_name, array_merge( $default, $setting ) );
	}
} );
