<?php
/**
 * Custom Header template for Allord Sweets.
 *
 * @package AllordSweets
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action( 'woodmart_after_body_open' ); ?>

	<div class="wd-page-wrapper website-wrapper">
		<?php if ( ! function_exists( 'woodmart_needs_header' ) || woodmart_needs_header() ) : ?>
			<header id="allord-site-header" class="allord-site-header" role="banner">
				<div class="allord-topbar">
					<div class="allord-container allord-topbar-inner">
						<div class="allord-language" aria-label="<?php esc_attr_e( 'Sprache', 'allordsweets' ); ?>">
							<span><?php echo esc_html( apply_filters( 'allordsweets_header_language_label', 'Deutsch' ) ); ?></span>
							<span class="allord-language-chevron"><?php echo allordsweets_header_icon( 'chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						</div>
						<div class="allord-shipping-message">
							<?php echo esc_html( apply_filters( 'allordsweets_header_shipping_message', 'Kostenloser Versand für alle Bestellungen ab 99 €' ) ); ?>
						</div>
						<div class="allord-topbar-spacer" aria-hidden="true"></div>
					</div>
				</div>

				<div class="allord-header-main">
					<div class="allord-container allord-header-main-inner">
						<div class="allord-header-main-spacer" aria-hidden="true"></div>

						<a class="allord-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<img src="<?php echo esc_url( allordsweets_get_header_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						</a>

						<div class="allord-header-actions">
							<a class="allord-header-action allord-wishlist-link" href="<?php echo esc_url( allordsweets_get_wishlist_url() ); ?>" aria-label="<?php esc_attr_e( 'Wunschliste', 'allordsweets' ); ?>">
								<span class="allord-header-icon"><?php echo allordsweets_header_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							</a>
							<?php allordsweets_render_cart_summary(); ?>
						</div>
					</div>
				</div>

				<nav class="allord-desktop-nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'allordsweets' ); ?>">
					<div class="allord-container allord-desktop-nav-inner">
						<?php allordsweets_render_header_menu( false ); ?>
					</div>
				</nav>

				<div class="allord-mobile-header">
					<div class="allord-container allord-mobile-header-inner">
						<button class="allord-mobile-menu-toggle" type="button" aria-expanded="false" aria-controls="allord-mobile-drawer">
							<span class="allord-header-icon"><?php echo allordsweets_header_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<span class="allord-visually-hidden"><?php esc_html_e( 'Menü öffnen', 'allordsweets' ); ?></span>
						</button>

						<a class="allord-mobile-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo esc_url( allordsweets_get_header_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						</a>

						<div class="allord-mobile-actions">
							<a class="allord-header-action allord-wishlist-link" href="<?php echo esc_url( allordsweets_get_wishlist_url() ); ?>" aria-label="<?php esc_attr_e( 'Wunschliste', 'allordsweets' ); ?>">
								<span class="allord-header-icon"><?php echo allordsweets_header_icon( 'heart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							</a>
							<?php allordsweets_render_cart_summary(); ?>
						</div>
					</div>
				</div>
			</header>

			<div id="allord-mobile-drawer" class="allord-mobile-drawer" aria-hidden="true">
				<div class="allord-mobile-drawer-head">
					<span class="allord-mobile-drawer-title"><?php esc_html_e( 'Menü', 'allordsweets' ); ?></span>
					<button class="allord-mobile-menu-close" type="button" aria-label="<?php esc_attr_e( 'Menü schließen', 'allordsweets' ); ?>">
						<span class="allord-header-icon"><?php echo allordsweets_header_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					</button>
				</div>

				<div class="allord-mobile-search">
					<?php
					if ( function_exists( 'get_product_search_form' ) ) {
						get_product_search_form();
					} else {
						get_search_form();
					}
					?>
				</div>

				<nav class="allord-mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'allordsweets' ); ?>">
					<?php allordsweets_render_header_menu( true ); ?>
				</nav>

				<div class="allord-mobile-drawer-footer">
					<span><?php echo esc_html( apply_filters( 'allordsweets_header_shipping_message', 'Kostenloser Versand für alle Bestellungen ab 99 €' ) ); ?></span>
				</div>
			</div>
			<button class="allord-mobile-overlay" type="button" tabindex="-1" aria-label="<?php esc_attr_e( 'Menü schließen', 'allordsweets' ); ?>"></button>

			<?php if ( function_exists( 'woodmart_page_top_part' ) ) : ?>
				<?php woodmart_page_top_part(); ?>
			<?php endif; ?>
		<?php endif; ?>
