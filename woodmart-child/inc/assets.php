<?php
/**
 * Front-end assets.
 *
 * @package AllordSweets
 */

defined( 'ABSPATH' ) || exit;

function allordsweets_enqueue_assets() {
	$version = ALLORDSWEETS_THEME_VERSION;

	wp_enqueue_style(
		'allordsweets-child',
		get_stylesheet_uri(),
		array( 'woodmart-style' ),
		$version
	);

	$styles = array(
		'global',
		'header',
		'header-mobile-fix',
		'footer',
		'shop',
		'product-card',
		'single-product',
		'responsive',
	);

	foreach ( $styles as $style ) {
		wp_enqueue_style(
			'allordsweets-' . $style,
			ALLORDSWEETS_THEME_URI . '/assets/css/' . $style . '.css',
			array( 'allordsweets-child' ),
			$version
		);
	}

	wp_enqueue_script(
		'allordsweets-theme',
		ALLORDSWEETS_THEME_URI . '/assets/js/theme.js',
		array(),
		$version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'allordsweets_enqueue_assets', 1000 );
