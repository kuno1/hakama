<?php
/**
 * String test utility.
 *
 * @package hakama
 */

/**
 * Sample test case.
 */
class StringTest extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	public function test_sting() {
		$this->assertEquals( 'This will be trimmed', hakama_trim( ' This will be trimmed.' ) );
		$this->assertEquals( 'This will also be trimmed', hakama_trim( ' This will be trimmed. ' ) );
		$this->assertEquals( "First Line\nSecond Line", hakama_trim( " First Line\n  Second Line  " ) );
	}
}
