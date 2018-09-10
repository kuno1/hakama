<aside class="submission">

	<div class="container">

		<!-- Begin MailChimp Signup Form -->
		<div id="mc_embed_signup">
			<form action="https://shop.us16.list-manage.com/subscribe/post?u=e2aa2cbd602e36d7517c43838&amp;id=59e214a3bb"
				  method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
				  target="_blank" novalidate>
				<div id="mc_embed_signup_scroll">
					<h2 class="submission-title">
						<i class="far fa-envelope-open"></i><br/>
						<?php esc_html_e( 'Join Newsletter for Early Access!', 'hakama' ) ?>
					</h2>
					<p class="submission-lead">
						<?php esc_html_e( 'Get interested? Please subscribe news letter and get updated!', 'hakama' ) ?>
					</p>

					<div class="form-row">
						<div class="form-group col">
							<label for="mce-EMAIL"><?php esc_html_e( 'Email', 'hakama' ) ?></label>
							<input type="email" class="form-control" id="mce-EMAIL" name="EMAIL"
								   placeholder="email@example.com"/>
						</div>
						<div class="form-group col">
							<label for="mce-LANGUAGE"><?php esc_html_e( 'Language', 'hakama' ) ?></label>
							<select id="mce-LANGUAGE" name="LANGUAGE" class="form-control">
								<?php foreach ( [
									[ '日本語', 'ja' ],
									[ 'English', 'en_US' ],
								] as $index => list( $label, $value ) ) : ?>
									<option value="<?php echo esc_attr( $value ) ?>" <?php selected( $value, get_user_locale() ) ?>>
										<?php echo esc_html( $label ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="form-row">
						<?php
						$cols = [
							[
								'mce-FNAME',
								__( 'First Name', 'hakama' ),
								'<input type="text" value="" placeholder="John" name="FNAME" class="form-control" id="mce-FNAME" />'
							],
							[
								'mce-LNAME',
								__( 'Last Name', 'hakama' ),
								'<input type="text" value="" placeholder="Doe" name="LNAME" class="form-control" id="mce-LNAME" />'
							],
						];
						if ( hakama_is_jp() ) {
							rsort( $cols );
						}
						array_map( function ( $col ) {
							list( $id, $label, $input ) = $col;
							printf( '<div class="form-group col"><label for="%s">%s</label>%s</div>', esc_attr( $id ), esc_html( $label ), $input );
						}, $cols );
						?>
					</div><!-- //.row -->

					<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
					</div>
					<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
																							  name="b_e2aa2cbd602e36d7517c43838_59e214a3bb"
																							  tabindex="-1" value="">
					</div>
					<div class="submission-submit text-center clear">
						<button type="submit" name="subscribe"
								id="mc-embedded-subscribe"
								class="btn btn-outline-light btn-lg">
							<i class="far fa-hand-pointer"></i>
							<?php esc_html_e( 'Subscribe!', 'hakama' ) ?>
						</button>
					</div>
				</div>
			</form>
		</div>

	</div>

</aside>
<!--End mc_embed_signup-->
