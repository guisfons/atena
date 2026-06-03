# Atena Theme — Case Study

> **Custom WordPress Theme** · Educational/Institutional Platform · PHP 8 · Modular Architecture

![WordPress](https://img.shields.io/badge/WordPress-6.0+-21759B?logo=wordpress&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php&logoColor=white)
![ACF Pro](https://img.shields.io/badge/ACF-Pro-00A0D2)

<!-- TODO: Add screenshot of the Atena theme homepage here -->

---

## 1. Project Overview

Atena is a versatile, custom WordPress theme developed for an educational or institutional client. It features a modular architecture that allows administrators to construct complex page layouts using pre-defined, styled components managed through Advanced Custom Fields Pro, offering the flexibility of a page builder without the associated performance penalties.

<!-- TODO: Add screenshot of the modular page components in action here -->

---

## 2. The Problem

Institutional websites often suffer from rigid templates that cannot accommodate diverse content needs across different departments or programs. Conversely, giving editors a full page builder often leads to inconsistent design and broken layouts. The challenge was to provide layout flexibility while strictly enforcing the brand's design system.

---

## 3. The Solution & Architecture

The Atena theme utilizes ACF's Flexible Content field to create a modular block system. Editors can stack different section types (e.g., hero banners, text columns, image galleries, feature grids) to build pages, while the theme's PHP templates dictate exactly how those blocks are rendered.

### Architecture

- **ACF Flexible Content:** Serves as the core page-building engine, providing a curated list of layout modules.
- **Template Partials:** Each ACF layout module corresponds to a specific PHP file in `template-parts/`, ensuring clean separation of logic and presentation.
- **Centralized Asset Management:** Scripts and styles are conditionally loaded only when their corresponding modules are present on the page, optimizing performance.

---

## 4. Technologies Used

- **CMS & Backend:** WordPress 6.0+, PHP 8.0+, MySQL
- **Content Management:** ACF Pro (Flexible Content)
- **Styling:** Custom CSS/SCSS

---

## 5. Design Process & UI/UX

The design system was translated into a series of distinct, reusable modules. The admin experience was carefully crafted with clear labeling and intuitive controls within the ACF interface, making it easy for non-technical users to visualize the page structure as they build it.

<!-- TODO: Add screenshot of the ACF Flexible Content admin interface here -->

---

## 6. Project Outcomes

- **Controlled Flexibility:** Editors have the freedom to build diverse pages without compromising the site's design integrity.
- **Performance:** Bypassing heavy commercial page builders results in a significantly faster, more efficient website.
- **Scalability:** New layout modules can be developed and added to the flexible content system as the institution's needs evolve, without disrupting existing pages.
