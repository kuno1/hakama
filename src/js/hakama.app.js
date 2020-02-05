/**
 * Global JS app
 */

const $ = jQuery;

$( document ).ready( () => {

	// Global Nav
	const $toggle = $( '#global-nav-toggle' );
	if ( $toggle.length ) {
		$toggle.click( () => {
			$toggle.toggleClass( 'toggle' );
			$( '.global-nav' ).toggleClass( 'toggle' );
		} );
	}

	// Update cart
	const updateCart = ( event, fragments ) => {
		let total = fragments.cart_total;
		if ( !/^\d+$/.test( total ) ) {
			total = 0;
		}
		const $cart = $( '.cart-btn' );
		if ( !$cart.length ) {
			return;
		}
		let $counter = $cart.find( '.cart-count' );
		if ( !total ) {

			$counter.remove();
		} else {
			if ( !$counter.length ) {
				$counter = $( '<span class="cart-count"></span>' );
				$cart.append( $counter );
			}
			$counter.text( total );
			$counter.addClass( 'shake' );
			setTimeout( function() {
				$counter.removeClass( 'shake' );
			}, 500 );
		}
	};

	$( document.body ).on( 'added_to_cart', updateCart );
	$( document.body ).on( 'removed_from_cart', updateCart );

} );
