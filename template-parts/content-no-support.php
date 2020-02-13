<?php

hakama_template( 'header', hakama_template_group() );
hakama_template( 'entry-nav', hakama_template_group() );

$product = hakama_get_current_product();

?>

<div class="no-content">

	<h1 class="no-content-title text-center">
		204
		<small>No Content</small>
	</h1>

	<p class="text-center">
		<?php if ( $product && has_post_thumbnail( $product ) ) : ?>
			<img src="<?php echo get_the_post_thumbnail_url( $product, 'thumbnail' ) ?>" alt="" class="no-content-img" />
		<?php else : ?>
			<img src="<?php echo get_template_directory_uri() ?>/assets/img/kunoichi-girl-thumbnail.png" alt="160" width="160" height="50" class="no-content-img" />
		<?php endif; ?>
	</p>

	<p class="text-center">
		<?php esc_html_e( 'There is no content.', 'hakama' ); ?><br />
		<?php esc_html_e( 'Start new thread and get supported.', 'hakama' ) ?>
	</p>
</div>

<div class="entry">



</div>
