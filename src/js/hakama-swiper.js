/*!
 * Enable swiper
 */

const $ = jQuery;

/* global Swiper:false */

$( document ).ready( () => {
	// Carousel for post list blocks.
	if ( $( '.post-circle-container' ).length ) {
		new Swiper( '.post-circle-container', {
			direction: 'horizontal',
			slidesPerView: 3,
			spaceBetween: 40,
			breakpoints: {
				768: {
					slidesPerView: 5,
				},
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		} );
	}

	// Post page gallery.
	const $galleries = $( '.product-gallery-thumbnails-container' );
	if ( $galleries.length ) {
		new Swiper( '.product-gallery-thumbnails-container', {
			direction: 'horizontal',
			spaceBetween: 20,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		} );

		let timer = null;

		const startTimer = function( $gallery ) {
			if ( timer ) {
				clearInterval( timer );
			}
			timer = setInterval( function() {
				// Get current.
				let $next = $gallery.find( '.current' ).next();
				if ( ! $next.length ) {
					$next = $( $gallery.find( 'a' ).get( 0 ) );
				}
				setThumbnail( $next );
			}, 3000 );
		};

		const setThumbnail = function( $target ) {
			$target.parents( '.product-gallery-thumbnails' ).find( 'a' ).removeClass( 'current' );
			$target.addClass( 'current' );
			const $img = $( $target.attr( 'href' ) );
			$img.parents( '.product-gallery-screen' ).find( '.product-gallery-item' ).removeClass( 'current' );
			$img.addClass( 'current' );
		};

		// Click event.
		$( '.product-gallery-thumbnail' ).click( function( e ) {
			e.preventDefault();
			setThumbnail( $( this ) );
			startTimer( $( this ).parents( '.product-gallery-thumbnails-container' ) );
		} );

		// Timer.
		$galleries.each( function( index, gallery ) {
			startTimer( $( gallery ) );
		} );
	}

} );
