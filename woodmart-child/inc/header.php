<?php
/**
 * Header helpers and WooCommerce integration.
 *
 * @package AllordSweets
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the storefront logo URL.
 */
function allordsweets_get_header_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id ) {
		$logo = wp_get_attachment_image_url( $custom_logo_id, 'full' );
		if ( $logo ) {
			return $logo;
		}
	}

	return apply_filters(
		'allordsweets_header_logo_url',
		'https://allordsweets-sfpzmssqad.live-website.com/wp-content/uploads/2026/08/lo-2048x695-1.png'
	);
}

/**
 * Render a registered Allord navigation with safe fallbacks.
 *
 * @param bool $mobile Whether this is the mobile navigation.
 */
function allordsweets_render_header_menu( $mobile = false ) {
	$preferred = $mobile ? 'allordsweets-mobile' : 'allordsweets-primary';
	$location  = '';

	if ( has_nav_menu( $preferred ) ) {
		$location = $preferred;
	} elseif ( $mobile && has_nav_menu( 'allordsweets-primary' ) ) {
		$location = 'allordsweets-primary';
	} elseif ( has_nav_menu( 'main-menu' ) ) {
		$location = 'main-menu';
	}

	if ( $location ) {
		wp_nav_menu(
			array(
				'theme_location' => $location,
				'container'      => false,
				'menu_class'     => $mobile ? 'allord-mobile-menu' : 'allord-primary-menu',
				'fallback_cb'    => false,
				'depth'          => 3,
			)
		);
		return;
	}

	echo '<ul class="' . esc_attr( $mobile ? 'allord-mobile-menu' : 'allord-primary-menu' ) . '">';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 2,
		)
	);
	echo '</ul>';
}

/**
 * Get the wishlist URL while remaining compatible with optional plugins.
 */
function allordsweets_get_wishlist_url() {
	if ( function_exists( 'woodmart_get_wishlist_page_url' ) ) {
		$url = woodmart_get_wishlist_page_url();
		if ( $url ) {
			return $url;
		}
	}

	if ( function_exists( 'YITH_WCWL' ) && YITH_WCWL() ) {
		$url = YITH_WCWL()->get_wishlist_url();
		if ( $url ) {
			return $url;
		}
	}

	return home_url( '/wishlist/' );
}

/**
 * Static SVG icon set used by the header.
 *
 * @param string $name Icon name.
 * @return string
 */
function allordsweets_header_icon( $name ) {
	$icons = array(
		'menu' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>',
		'close' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>',
		'heart' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>',
		'cart' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 4h2l2.4 10.1a2 2 0 0 0 2 1.5h7.8a2 2 0 0 0 1.9-1.4L21 8H7M10 20a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm9 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>',
		'chevron' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 10l5 5 5-5"/></svg>',
		'search' => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Return current WooCommerce cart values.
 *
 * @return array
 */
function allordsweets_get_cart_data() {
	$data = array(
		'count'    => 0,
		'subtotal' => '0,00&nbsp;&euro;',
		'url'      => home_url( '/warenkorb/' ),
	);

	if ( function_exists( 'wc_get_cart_url' ) ) {
		$data['url'] = wc_get_cart_url();
	}

	if ( function_exists( 'WC' ) && WC()->cart ) {
		$data['count']    = WC()->cart->get_cart_contents_count();
		$data['subtotal'] = WC()->cart->get_cart_subtotal();
	}

	return $data;
}

/**
 * Render the shared cart summary markup.
 */
function allordsweets_render_cart_summary() {
	$cart = allordsweets_get_cart_data();
	?>
	<a class="allord-cart-summary" href="<?php echo esc_url( $cart['url'] ); ?>" aria-label="<?php esc_attr_e( 'Warenkorb öffnen', 'allordsweets' ); ?>">
		<span class="allord-header-icon allord-cart-icon" aria-hidden="true">
			<?php echo allordsweets_header_icon( 'cart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span class="allord-cart-count"><?php echo esc_html( (string) $cart['count'] ); ?></span>
		</span>
		<span class="allord-cart-total"><?php echo wp_kses_post( $cart['subtotal'] ); ?></span>
	</a>
	<?php
}

/**
 * Keep cart count and subtotal current after AJAX add-to-cart operations.
 *
 * @param array $fragments WooCommerce fragments.
 * @return array
 */
function allordsweets_cart_fragments( $fragments ) {
	ob_start();
	allordsweets_render_cart_summary();
	$fragments['a.allord-cart-summary'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'allordsweets_cart_fragments' );
