/**
 * Block Section
 *
 * @package hakama
 */

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.editor;


registerBlockType( 'hakama/container', {

  title: __( 'Container', 'hakama' ),

  icon: 'archive',

  category: 'layout',

  keywords: [ 'container', 'layout' ],

  edit({attributes, setAttributes, className}){
    console.log( className );
    return (
        <div className={className}>
          <InnerBlocks templateLock={false}/>
        </div>
    )
  },

  save({className, attributes}){
    return (
      <div className={className}>
        <InnerBlocks.Content />
      </div>
    )
  }

} );
