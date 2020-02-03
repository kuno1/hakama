/*!
 * Enable swiper
 */

const $ = jQuery;

/* global Swiper:false */

$( document ).ready( () => {
	new Swiper( '.swiper-container', {
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
} );
