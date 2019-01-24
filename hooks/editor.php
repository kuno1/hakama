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
