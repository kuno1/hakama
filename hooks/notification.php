<?php
/**
 * Notification
 *
 * @package hakama
 */

/**
 * Register option for notification.
 */
add_action( 'admin_init', function() {
	add_settings_field( 'hakama_site_notice', __( 'Notification', 'hakama' ), function() {
		?>
			<input type="text" class="regulart-text" style="box-sizing: border-box; width: 100%;"
				id="hakama_site_notice" name="hakama_site_notice" value="<?php echo esc_attr( get_option( 'hakama_site_notice', '' ) ) ?>"
				placeholder="<?php esc_attr_e( 'e.g. This site is a demo of our service.', 'hakama' ) ?>" />
			<p class="description">
				<?php esc_html_e( 'This strings will be shown on every page. Only anchor(a), icon(i) and strong tag will work.', 'hakama' ) ?>
			</p>
		<?php
	}, 'reading', 'default' );
	register_setting( 'reading', 'hakama_site_notice' );


	add_settings_field( 'hakama_site_notice_style', __( 'Notification Style', 'hakama' ), function() {
		?>
		<select name="hakama_site_notice_style" id="hakama_site_notice_style">
			<?php foreach ( [
					'primary'   => __( 'Primary', 'hakama' ),
					'secondary' => __( 'Secondary', 'hakama' ),
					'info'      => __( 'Infomation', 'hakama' ),
					'success'   => __( 'Success', 'hakama' ),
					'warning'   => __( 'Warning', 'hakama' ),
					'danger'    => __( 'Danger', 'hakama' ),
			] as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ) ?>" <?php selected( $value, get_option( 'hakama_site_notice_style' ) ) ?>>
					<?php echo esc_html( $label ) ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php
	}, 'reading', 'default' );
	register_setting( 'reading', 'hakama_site_notice_style' );
} );

/**
 * Render notification if enabled.
 */
add_action( 'hakama_header_notification', function() {
	$notification = get_option( 'hakama_site_notice', '' );
	if ( ! $notification ) {
		return;
	}
	hakama_template( 'header-notification', '', [
		'notification' => $notification,
		'style'        => get_option( 'hakama_site_notice_style', 'primary' )
	] );
} );
