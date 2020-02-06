/*!
 * Register block styles.
 */

const { registerBlockStyle, unregisterBlockStyle } = wp.blocks;
const { __ } = wp.i18n;

wp.domReady( function() {
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

	for ( const suffix of [ '', 'outlined' ] ) {
		for ( const theme of [ 'primary', 'secondary', 'danger', 'warning', 'success', 'info', 'light', 'dark', 'white' ] ) {
			registerBlockStyle( 'core/button', {
				name: theme + '-' + suffix,
				label: [ theme, suffix ].map( ( text ) => {
					return text.charAt( 0 ).toUpperCase() + text.slice( 1 );
				} ).join( ' ' ),
			} );
		}
	}

	// Buttons

	unregisterBlockStyle( 'core/button', 'outline' );
	unregisterBlockStyle( 'core/button', 'fill' );

	// Group
	registerBlockStyle( 'core/group', {
		name: 'bordered',
		label: __( 'Bordered', 'hakama' ),
	} );
} );

