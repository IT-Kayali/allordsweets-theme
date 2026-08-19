# Allord Sweets Theme

Custom presentation layer for the Allord Sweets WooCommerce shop.

## Architecture

This project uses a hybrid setup:

- **WoodMart parent theme** stays installed and updateable.
- **WoodMart Child** contains all custom presentation code.
- **WooCommerce** remains the source of truth for products, customers, orders, stock, prices and checkout data.
- **Elementor** is optional and intended mainly for content/landing pages, not as a hard dependency of the shop UI.

## Planned custom areas

- Header and mobile header
- Footer
- WooCommerce shop/catalog archives
- Product cards
- Single-product layout
- Category/search/tag archive presentation
- Responsive behavior for desktop, tablet and mobile

## Development rules

1. Never edit the WoodMart parent theme directly.
2. Prefer WooCommerce hooks/functions over copying core templates unnecessarily.
3. Keep custom modules isolated so changes in one area do not unintentionally affect another.
4. Keep `main` stable. Development happens on fresh `feature/*` branches and is merged after testing.
5. Never commit customer/order data, database dumps, credentials, `wp-config.php`, backups or production secrets.
6. Before production deployment, test changes on staging and keep a recoverable backup.

## Repository ownership

Maintained by IT-Kayali for the Allord Sweets implementation.
