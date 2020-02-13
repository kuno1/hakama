<?php
/** @var string $notification */
?>
<aside class="header-notification bg-<?php echo esc_attr( $style ) ?>">
	<div class="container">
		<div class="header-notification-text">
			<?php echo wp_kses( $notification, [
				'strong' => true,
				'a'      => [
					'href'   => true,
					'target' => [ '_blank', '_self', '_parent' ],
				],
				'i' => [
					'class' => true,
				],
			] ); ?>
		</div>
	</div>
</aside>
