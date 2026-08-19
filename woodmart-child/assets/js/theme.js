( function () {
	'use strict';

	document.documentElement.classList.add( 'allord-js' );

	function initMobileHeader() {
		var drawer = document.getElementById( 'allord-mobile-drawer' );
		var openButton = document.querySelector( '.allord-mobile-menu-toggle' );
		var closeButton = document.querySelector( '.allord-mobile-menu-close' );
		var overlay = document.querySelector( '.allord-mobile-overlay' );

		if ( ! drawer || ! openButton || ! closeButton || ! overlay ) {
			return;
		}

		function openMenu() {
			drawer.classList.add( 'is-open' );
			overlay.classList.add( 'is-open' );
			drawer.setAttribute( 'aria-hidden', 'false' );
			openButton.setAttribute( 'aria-expanded', 'true' );
			document.body.classList.add( 'allord-menu-open' );
			closeButton.focus();
		}

		function closeMenu() {
			drawer.classList.remove( 'is-open' );
			overlay.classList.remove( 'is-open' );
			drawer.setAttribute( 'aria-hidden', 'true' );
			openButton.setAttribute( 'aria-expanded', 'false' );
			document.body.classList.remove( 'allord-menu-open' );
		}

		openButton.addEventListener( 'click', openMenu );
		closeButton.addEventListener( 'click', closeMenu );
		overlay.addEventListener( 'click', closeMenu );

		document.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' && drawer.classList.contains( 'is-open' ) ) {
				closeMenu();
				openButton.focus();
			}
		} );

		window.addEventListener( 'resize', function () {
			if ( window.innerWidth > 1023 && drawer.classList.contains( 'is-open' ) ) {
				closeMenu();
			}
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initMobileHeader );
	} else {
		initMobileHeader();
	}
}() );
