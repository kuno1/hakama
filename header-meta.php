<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<?php
/**
 * hakama_after_body_tag_open
 *
 * Fires just after body tag opens.
 */
do_action( 'hakama_after_body_tag_open' );
?>
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'hakama' ); ?></a>
