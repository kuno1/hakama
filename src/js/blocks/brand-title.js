/*!
 * Render bland block
 *
 * wpdeps=wp-blocks,wp-block-editor, wp-components, hakama-i18n
 */

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { RichText, InspectorControls } = wp.blockEditor;
const { ServerSideRender, PanelBody, SelectControl, TextControl, RadioControl, ToggleControl } = wp.components;

alert( 'hoge' );

registerBlockType( 'hakama/brand-title', {

	title: __( 'Brand Title', 'hakama' ),

	icon: 'store',

	category: 'embed',

	description: __( 'Display brand title depends on post or brand data.', 'hakama' ),

	attributes: {
		title: {
			type: 'string',
			default: '',
		},
		id: {
			type: 'integer',
			default: 0,
		},
	},

	edit( { attributes, setAttributes } ) {
		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Setting', 'kbl' ) }>
						<TextControl label={ __( 'Title String', 'hakama' ) } value={ attributes.title }
							onChange={ ( title ) => setAttributes( { title } ) }
							placeholder={ __( 'Contact to %s', 'hakama' ) }
							help={ __( '%s will be replaced by brand name.', 'hakama' ) } />
						<TextControl label={ __( 'Brand ID', 'hakama' ) } value={ attributes.id } type="number"
							onChange={ ( id ) => setAttributes( { id } ) }
							help={ __( 'If not set, brand will be automatically retrieved.', 'hakama' ) } />
					</PanelBody>
				</InspectorControls>
				<div className="hakama-brand-title">
					<ServerSideRender
						block="hakama/brand-title"
						attributes={ attributes } />
				</div>
			</>
		);
	},

	save() {
		return null;
	},
} );
