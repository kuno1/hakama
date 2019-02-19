/**
 * Description
 */

/*global hoge: true*/

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { ServerSideRender } = wp.components;



registerBlockType( 'hakama/blogs', {

  title: __( 'Blog Posts', 'hakama' ),

  icon: 'format-aside',

  category: 'embed',

  keywords: [ 'blogs', 'posts' ],

  attributes: {
    category: {
      type: 'number',
      default: 0,
    },
    limit: {
      type: 'number',
      default: 3,
    },
  },

  edit({attributes, setAttributes, className}){
    return (
      <ServerSideRender block="hakama/blogs" attributes={ attributes }></ServerSideRender>
    );
  },

  save(){
    return null;
  }

} );
