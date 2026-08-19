<?php
/**
 * Customizer settings for the Allord storefront header.
 *
 * @package AllordSweets
 */

defined( 'ABSPATH' ) || exit;

/**
 * Sanitize a checkbox value.
 *
 * @param mixed $checked Raw value.
 * @return bool
 */
function allordsweets_sanitize_checkbox( $checked ) {
	return (bool) $checked;
}

/**
 * Register editable header settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function allordsweets_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'allordsweets_header',
		array(
			'title'       => __( 'Allord Header', 'allordsweets' ),
			'description' => __( 'Logo, Topbar und Warenkorb-Verhalten des eigenen Allord Headers.', 'allordsweets' ),
			'priority'    => 25,
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_logo',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'allordsweets_header_logo',
			array(
				'label'    => __( 'Header Logo', 'allordsweets' ),
				'section'  => 'allordsweets_header',
				'settings' => 'allordsweets_header_logo',
			)
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_logo_width',
		array(
			'default'           => 350,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'allordsweets_header_logo_width',
		array(
			'label'       => __( 'Logo-Breite Desktop (px)', 'allordsweets' ),
			'section'     => 'allordsweets_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 140,
				'max'  => 600,
				'step' => 5,
			),
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_mobile_logo_width',
		array(
			'default'           => 205,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'allordsweets_header_mobile_logo_width',
		array(
			'label'       => __( 'Logo-Breite Tablet/Mobil (px)', 'allordsweets' ),
			'section'     => 'allordsweets_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 100,
				'max'  => 360,
				'step' => 5,
			),
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_language_label',
		array(
			'default'           => 'Deutsch',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'allordsweets_header_language_label',
		array(
			'label'   => __( 'Sprachtext', 'allordsweets' ),
			'section' => 'allordsweets_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_shipping_message',
		array(
			'default'           => 'Kostenloser Versand für alle Bestellungen ab 99 €',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'allordsweets_header_shipping_message',
		array(
			'label'   => __( 'Topbar Versandtext', 'allordsweets' ),
			'section' => 'allordsweets_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_cart_sidebar',
		array(
			'default'           => true,
			'sanitize_callback' => 'allordsweets_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'allordsweets_header_cart_sidebar',
		array(
			'label'       => __( 'WoodMart Warenkorb-Sidebar verwenden', 'allordsweets' ),
			'description' => __( 'Wenn aktiviert, öffnet der Warenkorb die native WoodMart Off-Canvas-Sidebar.', 'allordsweets' ),
			'section'     => 'allordsweets_header',
			'type'        => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'allordsweets_customize_register' );

/**
 * Feed editable values into the existing header template filters.
 */
function allordsweets_filter_header_language_label( $default ) {
	return get_theme_mod( 'allordsweets_header_language_label', $default );
}
add_filter( 'allordsweets_header_language_label', 'allordsweets_filter_header_language_label' );

function allordsweets_filter_header_shipping_message( $default ) {
	return get_theme_mod( 'allordsweets_header_shipping_message', $default );
}
add_filter( 'allordsweets_header_shipping_message', 'allordsweets_filter_header_shipping_message' );

/**
 * Output logo sizing selected in the Customizer.
 */
function allordsweets_header_customizer_css() {
	$desktop = min( 600, max( 140, absint( get_theme_mod( 'allordsweets_header_logo_width', 350 ) ) ) );
	$mobile  = min( 360, max( 100, absint( get_theme_mod( 'allordsweets_header_mobile_logo_width', 205 ) ) ) );
	?>
	<style id="allordsweets-header-customizer-css">
		.allord-logo img{width:min(<?php echo esc_html( (string) $desktop ); ?>px,34vw)}
		@media(max-width:1023px){.allord-mobile-logo img{width:min(<?php echo esc_html( (string) $mobile ); ?>px,31vw)}}
		@media(max-width:767px){.allord-mobile-logo img{width:min(<?php echo esc_html( (string) $mobile ); ?>px,43vw)}}
	</style>
	<?php
}
add_action( 'wp_head', 'allordsweets_header_customizer_css', 100 );
