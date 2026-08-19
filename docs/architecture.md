# Architecture

## Goal

Create a custom Allord Sweets storefront while keeping WoodMart as an updateable technical base and WooCommerce as the data/commerce engine.

## Layering

```text
WooCommerce data and commerce logic
        ↓
WoodMart parent theme / selected technical features
        ↓
WoodMart Child custom presentation layer
        ↓
Allord Sweets storefront
```

## Custom presentation scope

The child theme will own the visible design of:

- global header and mobile navigation
- global footer
- shop/catalog archives
- category, tag and search archives
- product cards
- single-product pages
- responsive layout and design tokens

## Data boundary

The repository must not contain live WooCommerce data. Products, customers, orders, inventory, coupons, analytics and settings remain in the WordPress/WooCommerce database.

## Update strategy

- Never modify `/wp-content/themes/woodmart/` directly.
- Keep custom code in the child theme.
- Use WooCommerce hooks and public functions where practical.
- Add template overrides only when required for layout control.
- Review overridden WooCommerce templates after major WooCommerce updates.
- Test parent-theme, WooCommerce and WordPress updates on staging before production.

## Git workflow

- `main` is the stable source of truth.
- Each change starts on a fresh `feature/*` branch.
- Test browser behavior and responsive layouts before merge.
- Merge only reviewed/tested work into `main`.
- Avoid force-pushes or destructive resets on shared/stable branches.

## Initial implementation order

1. Child-theme foundation and asset loading
2. Header / mobile header
3. Footer
4. Shop/catalog and product-card system
5. Single-product layout
6. Homepage content integration
7. Responsive and accessibility QA
8. Performance and update-compatibility QA
