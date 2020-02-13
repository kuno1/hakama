<?php

namespace Kunoichi\Hakama\Pattern;


use Hametuha\WpBlockCreator\Pattern\AbstractBlock;

/**
 * Block Base
 *
 * @package hakama
 */
abstract class KunoichiBlockBase extends AbstractBlock {

	protected $prefix = 'hakama';

	protected function get_script() {
		return 'hakama-block-' . $this->get_block_base();
	}

	protected function get_block_name() {
		return 'hakama/' . $this->get_block_base();
	}


}
