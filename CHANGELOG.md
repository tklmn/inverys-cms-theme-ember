# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.0.0] - 2026-10-13

### Added
- Minimal dark theme on a true-black base (`#09090b`) with Zinc surface layers and warm amber accents, built on the core's Tailwind v4 frontend stylesheet.
- CSS custom properties for all colors (`--accent`, `--surface-*`, `--text-*`, `--border`) and class hooks (`.s-nav-link`, `.s-card`, `.s-header`, `.s-footer`, `.s-icon-btn`, `.s-breadcrumb`) for easy customization.
- Theme settings: accent color, logo (via the CMS's shared logo partial with dark mode version and bundled wordmark), tagline, footer text, toggles for page title, breadcrumbs, search, profile link and logout button.
- Glassmorphism navigation with `backdrop-filter`: items that do not fit on the line move into "More", only one dropdown is open at a time, the menu button takes over below 1024 px, and plugin navigation hooks (such as the language switcher) appear in the header.
- Mobile menu with an animated hamburger button; the collapsed menu is inert, so its links are not reachable with the Tab key.
- Page template for all pages including the home page, with page-builder blocks, breadcrumbs with slash separators, `container` and `full_width` templates and SEO meta tags; the home page and pages that start with a hero block get no second page header.
- Scroll-to-top button, skip-to-content link and ARIA labels on all interactive elements; labels are translatable.
- Custom CSS from the theme customizer, injected after the theme's base styles.
- Editable in the CMS theme editor (`editable: true`).
- Available in the Inverys marketplace (catalog [`tklmn/inverys-marketplace`](https://github.com/tklmn/inverys-marketplace)), as Composer package (`inverys-theme` type) and as ZIP upload.
- Release package: every release gets `<slug>-<version>.zip` with its SHA-256 checksum attached (workflow), the file marketplace catalogs point to.
- Update source (`repository` in `theme.json`): the CMS checks for new releases and installs them.

### Security
- Works under the CMS's strict, nonce-based Content Security Policy: inline scripts carry `@cspNonce`, no inline event handlers.
- Security policy (`SECURITY.md`) with coordinated vulnerability reporting, and a CycloneDX SBOM under `sbom/` (no third-party runtime dependencies).
