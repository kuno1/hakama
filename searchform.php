<div id="search-form" class="search-form modal fade" aria-labelledby="search-form-title" aria-hidden="true"
	 data-backdrop="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<header class="modal-header">
				<h2 class="modal-title" id="search-form-title"><?php esc_html_e( 'Search Form', 'hakama' ) ?></h2>
				<button type="button" class="close" data-dismiss="modal"
						aria-label="<?php esc_attr_e( 'Cancel', 'hakama' ) ?>">
					<span aria-hidden="true">&times;</span>
				</button>
			</header>
			<div class="modal-body">

				<form action="<?php echo home_url() ?>">

					<div class="input-group mb-3">
						<input type="search" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Enter keyword...', 'hakama' ) ?>"
							   aria-label="<?php  ?>" aria-describedby="search-submit">
						<div class="input-group-append">
							<button class="btn btn-primary" type="submit" id="search-submit"><?php esc_html_e( 'Search', 'hakama' ) ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>