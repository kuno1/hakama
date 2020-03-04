<aside class="submission">

	<div class="container">

		<!-- Begin MailChimp Signup Form -->
		<div id="mc_embed_signup">
			<form action="https://shop.us16.list-manage.com/subscribe/post?u=e2aa2cbd602e36d7517c43838&amp;id=59e214a3bb"
				  method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
				  target="_blank" novalidate>
				<div id="mc_embed_signup_scroll">

					<h2 class="submission-title">
						<?php esc_html_e( 'News Letter', 'hakama' ) ?>
					</h2>

					<p class="submission-lead">
						<?php esc_html_e( 'Subscribe to our newsletter and keep up-to-date.', 'hakama' ) ?>
					</p>

					<div class="form-group row">
                        <label for="mce-EMAIL" class="col col-sm-2 col-form-label">E-mail</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="mce-EMAIL" name="EMAIL"
								   placeholder="email@example.com"/>
						</div>
					</div>
                    <div class="form-group row">
						<label for="mce-LANGUAGE" class="col col-sm-2 col-form-label">
							<?php esc_html_e( 'Language', 'hakama' ) ?>
						</label>
                        <div class="col-sm-3">
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


					<div class="form-group row">
						<?php
						$cols = [
							[
								'mce-FNAME',
                                sprintf(
									'<input type="text" value="" aria-label="%1$s" placeholder="%1$s" name="FNAME" class="form-control" id="mce-FNAME" />',
									__( 'First Name', 'hakama' )
                                ),
							],
							[
								'mce-LNAME',
								sprintf(
									'<input type="text" value="" aria-label="%1$s" placeholder="%1$s" name="LNAME" class="form-control" id="mce-LNAME" />',
									__( 'Last Name', 'hakama' )
								),
							],
						];
						if ( hakama_is_jp() ) {
							$cols = array_reverse( $cols );
						}
						?>
						<label for="<?php echo esc_attr( $cols[0][0] ) ?>" class="col-12 col-sm-2 col-form-label">
							<?php esc_html_e( 'Name', 'hakama' ) ?>
						</label>
						<?php
						array_map( function ( $col ) {
							list( $id, $input ) = $col;
							printf( '<div class="col-6 col-sm-5">%s</div>', $input );
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
								class="btn btn-primary">
							<?php echo esc_html_x( 'Subscribe', 'email-submit', 'hakama' ) ?>
						</button>
					</div>
				</div>
			</form>
		</div>

	</div>

</aside>
<!--End mc_embed_signup-->
