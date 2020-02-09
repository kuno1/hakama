<?php
if ( ! hakama_is_transactional_page() && hakama_is_platform_page() ) {
    get_footer( 'entry' );
}
?>

<footer id="colophon" role="contentinfo" class="colophon section-footer">

	<div class="container">

		<?php if ( hakama_is_platform_page() ) : ?>
		<div class="row">

			<?php dynamic_sidebar( 'footer' ) ?>

		</div>

		<hr class="colophon-divider" />

		<?php endif; ?>

		<?php hakama_template( 'footer', 'copyright' ) ?>

	</div>

</footer>
<?php get_search_form() ?>
<?php wp_footer() ?>
</body>
</html>
