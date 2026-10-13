<p align="center">
  <img src="https://img.shields.io/badge/Inverys_CMS-Theme-d97706?style=for-the-badge" alt="Inverys CMS Theme">
  <img src="https://img.shields.io/badge/Version-1.0.0-22c55e?style=for-the-badge" alt="Version 1.0.0">
  <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="MIT License">
  <img src="https://img.shields.io/badge/Dark_Theme-09090b?style=for-the-badge" alt="Dark Theme">
</p>

# :art: Ember

A dark theme for [Inverys CMS](https://github.com/tklmn/inverys-cms) with warm amber accents on a true-black base. Lightweight, and a good starting point for building your own themes.

---

## :sparkles: Features

| | Feature | Description |
|---|---|---|
| :new_moon: | **Dark by Default** | True-black base (`#09090b`) with Zinc surface layers |
| :paintbrush: | **Accent Color** | Customizable accent color — nav hover, links, breadcrumbs |
| :bubbles: | **Glassmorphism Nav** | Frosted glass navigation with `backdrop-filter` blur |
| :framed_picture: | **Logo Upload** | Upload a custom logo or display the site name |
| :label: | **Tagline** | Optional tagline next to the logo |
| :bread: | **Breadcrumbs** | Integrated into page header with slash separators |
| :mag: | **Search Toggle** | Show/hide the search icon in navigation |
| :bust_in_silhouette: | **Profile Toggle** | Show/hide the profile link for logged-in users |
| :iphone: | **Responsive** | Mobile-first with hamburger menu and smooth slide animation |
| :wheelchair: | **Accessible** | ARIA labels, skip-to-content link, semantic HTML |
| :pencil2: | **Editable** | Theme files can be edited via the CMS admin theme editor |

---

## :zap: Quick Start

### Option A: Marketplace

1. Go to **Extensions > Themes > Marketplace**
2. Click **Install** on *Ember*
3. Click **Activate**

### Option B: ZIP Upload

1. Download the latest release as ZIP
2. Go to **Extensions > Themes > Upload Package**
3. Select the ZIP file and click **Install**
4. Activate the theme in **Extensions > Themes**

### Option C: Composer

```bash
composer config repositories.ember-theme vcs https://github.com/tklmn/inverys-cms-theme-ember
composer require inverys/ember-theme
```

The CMS auto-discovers Composer packages with type `inverys-theme`. Activate the theme in **Extensions > Themes**.

---

## :wrench: Theme Settings

Customize in **Backend > Themes > Customize**:

### :art: Colors

| Setting | Description | Default |
|---------|-------------|---------|
| **Accent Color** | Primary accent color for links, hover, and active states | `#d97706` (amber) |

### :star2: Branding

| Setting | Description | Default |
|---------|-------------|---------|
| **Logo** | Upload a custom logo image | Site name as text |
| **Tagline** | Short text next to the logo | `Built with Inverys CMS` |
| **Footer Text** | Custom footer text | Copyright with year and site name |

### :jigsaw: Layout

| Setting | Description | Default |
|---------|-------------|---------|
| **Show Page Title** | Display the page title header | Enabled |
| **Show Breadcrumbs** | Display breadcrumb navigation | Enabled |

### :compass: Navigation

| Setting | Description | Default |
|---------|-------------|---------|
| **Show Search** | Search icon in the navigation bar | Enabled |
| **Show Profile Link** | Profile icon for logged-in users | Enabled |
| **Show Logout Button** | Logout icon for logged-in users | Enabled |

---

## :open_file_folder: File Structure

```
ember/
├── theme.json               # Theme manifest with settings schema
├── composer.json             # Composer package definition
└── views/
    ├── page.blade.php        # Page template (all pages including home)
    └── layouts/
        ├── app.blade.php         # Base layout with CSS custom properties
        ├── navigation.blade.php  # Glassmorphism navigation (desktop + mobile)
        └── footer.blade.php      # Footer
```

---

## :hammer_and_wrench: Customization

### CSS Custom Properties

The theme uses CSS custom properties for easy customization:

```css
--accent           /* Accent color from theme settings */
--surface-0        /* Deepest background (#09090b) */
--surface-1        /* Navigation, header, footer (#111113) */
--surface-2        /* Cards, code blocks (#18181b) */
--surface-3        /* Elevated elements (#1f1f23) */
--border           /* Subtle borders (rgba white 6%) */
--text-primary     /* Headings, bold (#fafafa) */
--text-secondary   /* Body text (#a1a1aa) */
--text-muted       /* Hints, labels (#52525b) */
```

### CSS Class Hooks

```css
.s-nav-link        /* Navigation links */
.s-card            /* Card elements with hover animation */
.s-header          /* Page header */
.s-footer          /* Footer */
.s-icon-btn        /* Icon buttons in navigation */
.s-breadcrumb      /* Breadcrumb container */
```

### Custom CSS

Add custom CSS via **Backend > Themes > Customize > Custom CSS**. Styles are injected after the theme's base styles.

### Template Support

The theme supports both `container` and `full_width` page templates. Full-width pages remove the max-width constraint for edge-to-edge layouts.

---

## :page_facing_up: Requirements

- **Inverys CMS** 1.0 or newer

## :handshake: Author

**Tom Kilimann** — [tkilimann@icloud.com](mailto:tkilimann@icloud.com)

## :scroll: License

MIT
