<?php
/**
 * Post loop for KBL Post list.
 */

?>
<li class="post-list-item">
	<a href="<?php the_permalink(); ?>" class="post-list-link">
        <div class="post-list-thumbnail">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'thumbnail', [ 'class' => 'post-list-img', ] ); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri() ?>/assets/icon/kunoichi-dammy.svg" alt="" class="post-list-img" width="60" height="60" />
            <?php endif; ?>
        </div>
        <div class="post-list-body">

            <p class="post-list-category">
                <?php if ( $term = hakama_top_category() ) : ?>
                <span class="post-list-term"><?php echo esc_html( $term->name ) ?></span>
                <?php endif; ?>
                <?php if ( wp_get_post_parent_id( null ) ) : ?>
                    <span class="post-list-brand"><?php echo esc_html( hakama_brand_title() ) ?></span>
                <?php endif; ?>
            </p>

            <p class="post-list-title"><?php the_title() ?></p>

            <div class="post-list-meta">
                <span class="post-list-date"><?php the_time(get_option('date_format')) ?></span>
                <span class="post-list-author">
                    <i class="fas fa-user"></i> <?php echo esc_html(hakama_document_owner()) ?>
                </span>
            </div>
        </div>
	</a>
    <i class="fas fa-chevron-right"></i>
</li>
