<?php
if ( $post_parent = get_query_var( 'post_parent' ) ) {
	$post = get_post( $post_parent );
}
?>
<div class="no-content-faq">

	<h3 class="no-content-title">
		<?php esc_html_e( 'There\'s no support yet.', 'hakama' ) ?>
	</h3>

</div><!-- //.no-content -->
