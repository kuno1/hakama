<?php
if ( ! hakama_is_transactional_page() ) {
    get_footer( 'entry' );
}
?>

<footer id="colophon" role="contentinfo" class="colophon section-footer">

	<div class="container">

		<div class="row">

			<?php dynamic_sidebar( 'footer' ) ?>

		</div>

		<hr class="colophon-divider" />

		<?php hakama_template( 'footer', 'copyright' ) ?>

	</div>

</footer>
<?php get_search_form() ?>
<?php wp_footer() ?>
</body>
</html>
