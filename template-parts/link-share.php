<?php
if ( 'publish' !== get_post_status() ) {
	return;
}
?>

<div class="share-this">
	<h4 class="share-this-title"><?php esc_html_e( 'Share This', 'hakama' ) ?></h4>
	<p class="share-this-buttons">
		<?php
		$permalink = rawurlencode( get_permalink() );
		$tile      = rawurlencode( get_the_title() );
		foreach ( [
			[ 'facebook-f', 'Facebook', add_query_arg( [
				'u' => $permalink
			], 'https://www.facebook.com/sharer/sharer.php' ) ],
			[ 'twitter', 'Twitter', add_query_arg( [
				'url'      => $permalink,
				// 'via'      => '', // If brand can register their twitter account, add here.
				'hashtags' => 'wordpress',
				'related'  => 'kunoichiwp',
			], 'https://twitter.com/intent/tweet?url=https%3A%2F%2Fparse.com' ) ],
			[ 'linkedin-in', 'LinkedIn', add_query_arg([
				'mini'   => 'true',
				'url'    => $permalink,
				'title'  => $title,
				'source' => 'kunoichiwp.com',
			], 'https://www.linkedin.com/shareArticle' ) ],
			[ 'get-pocket', 'Pocket', add_query_arg( [
				'url'   => $permalink,
				'title' => $title,
			], 'https//getpocket.com/edit' ) ],
			[ 'bold', __( 'Hatena Bookmark', 'hakama' ), add_query_arg( [
				'url' => $permalink,
			], 'https://b.hatena.ne.jp/add?mode=confirm&url' ) ],
			[ 'reddit-alien',  'Reddit', add_query_arg( [
				'url'   => $permalink,
				'title' => $title,
			], 'http://www.reddit.com/submit' ) ],
		] as list( $icon, $label, $url ) ) : ?>
			<a class="share-this-link" rel="noopener noreferrer" target="_blank" href="<?php echo esc_url( $url ) ?>" title="<?php echo esc_attr( $label ) ?>">
				<i class="fa<?php echo 'bold' === $icon ? 's' : 'b' ?> fa-<?php echo esc_attr( $icon ) ?>"></i>
			</a>
		<?php endforeach; ?>
	</p>
</div>
