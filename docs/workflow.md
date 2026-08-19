# Development & Deployment Workflow

This document defines how changes are handled for the Allord Sweets theme.

## 1. Development

All new work is created on a fresh `feature/*` branch. The `main` branch remains the stable source of truth.

Current first phase branch:

`feature/phase-1-foundation`

## 2. What belongs in GitHub

Commit only custom theme source code and project documentation.

Do not commit:

- WordPress database exports
- customer or order data
- `wp-config.php`
- `.env` files
- passwords, API keys or certificates
- WordPress uploads
- backups or cache files

## 3. Before testing on WordPress

1. Keep a current backup or restore point.
2. Prefer a staging/test site rather than the live shop.
3. WoodMart parent theme must remain installed.
4. The child theme folder must use the expected WordPress structure.
5. Do not overwrite the WoodMart parent theme.

## 4. Testing checklist

After every deployment, check at minimum:

- homepage loads without PHP errors
- WordPress admin remains accessible
- WooCommerce shop loads
- a product page loads
- add-to-cart still works
- cart and checkout still open
- desktop, tablet and mobile layout
- browser console has no new critical errors

## 5. Promotion to main

Only after testing:

1. review the feature branch changes
2. merge the tested feature into `main`
3. use `main` as the deployable stable version

## 6. Rollback rule

If a new deployment causes a problem, restore the previously tested theme version rather than editing the WoodMart parent theme or live database to work around the problem.
