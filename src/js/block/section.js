/**
 * Block Section
 *
 * @package hakama
 */

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks, PanelColorSettings, InspectorControls } = wp.editor;
const { Fragment } = wp.element;

registerBlockType( 'hakama/section', {

	title: __( 'Section Block', 'hakama' ),

	icon: 'excerpt-view',

	category: 'layout',

	keywords: [ 'section', 'layout' ],

	attributes: {
		backgroundColor: {
			type: 'string',
			default: 'transparent',
		},
	},

	edit( { attributes, setAttributes, className } ) {
		return (
			<Fragment>
				<InspectorControls>
					<PanelColorSettings
						title={ __( 'Color Settings', 'hakama' ) }
						initialOpen={ false }
						colorSettings={ [
							{
								value: attributes.backgroundColor,
								onChange: ( value ) => setAttributes( { backgroundColor: value } ),
								label: __( 'Background Color', 'hakama' ),
							},
						] }
					>
					</PanelColorSettings>
				</InspectorControls>
				<div className={ className } style={ { backgroundColor: attributes.backgroundColor } }>
					<InnerBlocks templateLock={ false } />
				</div>
			</Fragment>
		);
	},

	save( { className, attributes } ) {
		return (
			<section className={ className } style={ { backgroundColor: attributes.backgroundColor } }>
				<InnerBlocks.Content />
			</section>
		);
	},

} );
