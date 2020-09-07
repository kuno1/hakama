<?php

namespace Kunoichi\Hakama\Customizers;


use Kunoichi\ThemeCustomizer\CustomizerSetting;

class ShoppingNavigation extends CustomizerSetting {

	protected $panel_id = 'woocommerce';

	protected $section_id = 'hakama-display';

	protected function section_setting() {
		return [
			'title' => __( 'Display Setting', 'hakama' ) . '[Kunoichi]',
		];
	}

	protected function get_fields() {
		return [
			'path_to_shopping_guide' => [
				'label'       => __( 'Shopping Guide Path', 'ku-mag' ),
				'description' => __( 'Enter shopping guide page path with relative url.', 'ku-mag' ),
				'type'    => 'text',
				'default' => '',
				'input_attr' => [
					'placeholder' => 'e.g. /faq/page'
				],
			],
		];
	}
}
