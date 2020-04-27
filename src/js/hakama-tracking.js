/*!
 * wpdeps=jquery
 */

/* global HakamaTracking: false */

const $ = jQuery;

const done = [];
for ( let i = 0; i <= 10; i++ ) {
	done[ i * 10 ] = ! i;
}

/**
 * Record scroll length.
 *
 * @param {Number} ratio
 */
function recordScroll( ratio ) {
	try {
		ga( 'send', 'event', {
			eventCategory: 100 > ratio ? 'scroll' : 'read',
			eventAction: `${ HakamaTracking.type }/${ HakamaTracking.parent }/${ HakamaTracking.id }`,
			eventLabel: ratio,
			nonInteraction: 100 > ratio,
		} );
	} catch ( err ) {
		window.console && console.log( err );
	}
}

const $main = $( '.entry-content' );
if ( $main.length ) {
	// Get positions.
	const start = $main.offset().top;
	const total = $main.height();

	// Get start scroll.
	recordScroll( 0 );

	$( window ).scroll( function() {
		const border = Math.floor( window.innerHeight / 2 );
		const current = $( window ).scrollTop();
		if ( current + border - start < 0 ) {
			return;
		}

		const ratio = Math.min( 10, Math.floor( ( current - start + border ) / total * 10 ) ) * 10;
		if ( ! done[ ratio ] ) {
			done[ ratio ] = true;
			$( window ).trigger( 'hakama.scrolled', [ ratio ] );
			recordScroll( ratio );
		}
	} );
}
