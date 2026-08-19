<?php
/**
 * Theme setup and WordPress registrations.
 *
 * @package AllordSweets
 */

defined( 'ABSPATH' ) || exit;

function allordsweets_child_setup() {
	load_child_theme_textdomain( 'allordsweets', ALLORDSWEETS_THEME_DIR . '/languages' );

	register_nav_menus(
		array(
			'allordsweets-primary' => __( 'Allord Primary Menu', 'allordsweets' ),
			'allordsweets-mobile'  => __( 'Allord Mobile Menu', 'allordsweets' ),
			'allordsweets-footer'  => __( 'Allord Footer Menu', 'allordsweets' ),
		)
	);
}
add_action( 'after_setup_theme', 'allordsweets_child_setup', 20 );
