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
 * Sanitize desktop menu background mode.
 *
 * @param string $value Raw value.
 * @return string
 */
function allordsweets_sanitize_menu_background_type( $value ) {
	$allowed = array( 'transparent', 'color', 'image' );
	return in_array( $value, $allowed, true ) ? $value : 'transparent';
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
			'description' => __( 'Logo, Topbar, Desktop-Menü und Warenkorb-Verhalten des eigenen Allord Headers.', 'allordsweets' ),
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
		'allordsweets_header_menu_width',
		array(
			'default'           => 760,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'allordsweets_header_menu_width',
		array(
			'label'       => __( 'Menü-Breite Desktop (px)', 'allordsweets' ),
			'description' => __( 'Die Hauptmenüpunkte werden innerhalb dieser Breite gleichmäßig verteilt.', 'allordsweets' ),
			'section'     => 'allordsweets_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 480,
				'max'  => 1200,
				'step' => 10,
			),
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_menu_background_type',
		array(
			'default'           => 'transparent',
			'sanitize_callback' => 'allordsweets_sanitize_menu_background_type',
		)
	);
	$wp_customize->add_control(
		'allordsweets_header_menu_background_type',
		array(
			'label'   => __( 'Menü-Hintergrund', 'allordsweets' ),
			'section' => 'allordsweets_header',
			'type'    => 'select',
			'choices' => array(
				'transparent' => __( 'Transparent', 'allordsweets' ),
				'color'       => __( 'Farbe', 'allordsweets' ),
				'image'       => __( 'Bild', 'allordsweets' ),
			),
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_menu_background_color',
		array(
			'default'           => '#fbfaf7',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'allordsweets_header_menu_background_color',
			array(
				'label'   => __( 'Menü-Hintergrundfarbe', 'allordsweets' ),
				'section' => 'allordsweets_header',
			)
		)
	);

	$wp_customize->add_setting(
		'allordsweets_header_menu_background_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'allordsweets_header_menu_background_image',
			array(
				'label'       => __( 'Menü-Hintergrundbild', 'allordsweets' ),
				'description' => __( 'Wird verwendet, wenn bei Menü-Hintergrund „Bild“ gewählt ist.', 'allordsweets' ),
				'section'     => 'allordsweets_header',
				'settings'    => 'allordsweets_header_menu_background_image',
			)
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
 * Output Customizer CSS for header sizing and desktop menu background.
 */
function allordsweets_header_customizer_css() {
	$desktop         = min( 600, max( 140, absint( get_theme_mod( 'allordsweets_header_logo_width', 350 ) ) ) );
	$mobile          = min( 360, max( 100, absint( get_theme_mod( 'allordsweets_header_mobile_logo_width', 205 ) ) ) );
	$menu_width      = min( 1200, max( 480, absint( get_theme_mod( 'allordsweets_header_menu_width', 760 ) ) ) );
	$background_type = allordsweets_sanitize_menu_background_type( get_theme_mod( 'allordsweets_header_menu_background_type', 'transparent' ) );
	$background      = sanitize_hex_color( get_theme_mod( 'allordsweets_header_menu_background_color', '#fbfaf7' ) );
	$background      = $background ? $background : '#fbfaf7';
	$background_img  = esc_url_raw( get_theme_mod( 'allordsweets_header_menu_background_image', '' ) );
	?>
	<style id="allordsweets-header-customizer-css">
		.allord-logo img{width:min(<?php echo esc_html( (string) $desktop ); ?>px,34vw)}
		.allord-primary-menu{width:min(100%,<?php echo esc_html( (string) $menu_width ); ?>px)}
		<?php if ( 'color' === $background_type ) : ?>
		.allord-desktop-nav{background-color:<?php echo esc_html( $background ); ?>;background-image:none}
		<?php elseif ( 'image' === $background_type && $background_img ) : ?>
		.allord-desktop-nav{background-color:<?php echo esc_html( $background ); ?>;background-image:url('<?php echo esc_url( $background_img ); ?>');background-repeat:no-repeat;background-position:center;background-size:cover}
		<?php else : ?>
		.allord-desktop-nav{background-color:transparent;background-image:none}
		<?php endif; ?>
		@media(max-width:1023px){.allord-mobile-logo img{width:min(<?php echo esc_html( (string) $mobile ); ?>px,31vw)}}
		@media(max-width:767px){.allord-mobile-logo img{width:min(<?php echo esc_html( (string) $mobile ); ?>px,43vw)}}
	</style>
	<?php
}
add_action( 'wp_head', 'allordsweets_header_customizer_css', 100 );
