<?php
/**
 * Breadcrumb
 *
 * @package hakama
 */

defined( 'ABSPATH' ) || die();

// Check if library exists.
if ( ! class_exists( '\Kunoichi\BootstraPress\Breadcrumb' ) ) {
	return;
}
\Kunoichi\BootstraPress\Breadcrumb::display();
