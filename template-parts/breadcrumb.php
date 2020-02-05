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
?>
<div class="breadcrumb-wrapper">
	<?php \Kunoichi\BootstraPress\Breadcrumb::display(); ?>
</div>
