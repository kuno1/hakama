/*!
 * Register block styles.
 */

const { registerBlockStyle } = wp.blocks;
const { __ } = wp.i18n;

//
// Headings
//
registerBlockStyle( 'core/heading', {
	name: 'overline',
	label: __( 'Over Line', 'hakama' ),
} );
registerBlockStyle( 'core/heading', {
	name: 'separator',
	label: __( 'Separator', 'hakama' ),
} );
registerBlockStyle( 'core/heading', {
	name: 'underline',
	label: __( 'Underline', 'hakama' ),
} );
registerBlockStyle( 'core/heading', {
	name: 'pipe',
	label: __( 'Pipe', 'hakama' ),
} );
