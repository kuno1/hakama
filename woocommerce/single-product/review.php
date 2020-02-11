<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || die();
?>
<li class="review-item" id="li-comment-<?php comment_ID(); ?>">

	<div id="comment-<?php comment_ID(); ?>">
			<p class="review-title">
				<?php echo esc_html( get_comment_meta( $comment->comment_ID, 'review_title', true ) ?: __( 'No Title', 'hakama' ) ) ?>
			</p>
			<p class="review-author">
				<?php echo esc_html( sprintf( _x( '%s', 'user-title', 'hakama' ), get_comment_author() ) ); ?>
			</p>
			<p class="review-meta">
				<?php
				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
				echo hakama_review_stars( $rating );
				?>
				<span class="review-date"><?php comment_date(); ?></span>
			</p>
			<div class="review-body">
				<?php comment_text(); ?>
			</div>
	</div>
