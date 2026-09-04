# Ray Health

A custom WordPress theme built for the PharmacyMentor Front-End Developer Take-Home Task.

The implementation converts the provided Figma design into a lightweight, responsive WordPress theme using semantic HTML, vanilla CSS, and minimal JavaScript.

## Live Demo

https://rayhealthtest.freedev.app/

## Built Sections

The required sections from the task have been implemented:

- Top navigation
- Hero section
- Four treatment category cards
- How it works section

The optional product cards and FAQ accordion were not implemented because the task prioritises completing the required scope to a high standard within the available time.

## Theme Structure

```text
ray-health/
├── style.css
├── functions.php
├── index.php
├── front-page.php
├── header.php
├── footer.php
├── screenshot.png
├── README.md
├── template-parts/
│   ├── hero.php
│   ├── categories.php
│   └── how-it-works.php
└── assets/
    ├── css/
    │   └── main.css
    ├── js/
    │   └── main.js
    └── images/
```

## Installation

1. Install a fresh WordPress installation.
2. Copy the `ray-health` folder into:

   `wp-content/themes/`

3. In WordPress, go to **Appearance → Themes**.
4. Activate **Ray Health**.
5. Set the required WordPress site settings.
6. Configure the primary navigation menu.
7. Add/configure the treatment categories and their associated content/images.
8. Visit the homepage.

No page builder or pre-built marketplace theme is required.

## Setup and Build

No build tool or package manager is required.

The theme uses:

- PHP for WordPress templates
- Vanilla CSS for styling
- Vanilla JavaScript for lightweight interactions
- WordPress template hierarchy
- WordPress enqueue functions for theme assets

CSS and JavaScript are loaded through `functions.php`.

## Responsive Behaviour

The original Figma design was provided as a desktop layout. Responsive behaviour was therefore implemented with CSS breakpoints and layout adaptations for smaller screens.

The layout is designed to work from approximately 320px wide through large desktop screens.

Key responsive decisions include:

- Navigation adapts to smaller screen widths.
- Hero content and media stack on smaller screens.
- Treatment cards move from a row into a responsive layout.
- The How It Works steps adapt for smaller screens.
- Spacing and typography scale to maintain readability on mobile.

## Performance

Images were optimised where appropriate, including converting the main hero image to WebP.

The hero image is treated as the main above-the-fold image and is loaded with high priority. Below-the-fold images use appropriate loading behaviour.

CSS was minified to reduce transfer size.

The implementation avoids heavy JavaScript libraries and unnecessary dependencies.

## Lighthouse

Latest Lighthouse run: Mobile

| Category | Score |
|---|---:|
| Performance | 85 |
| Accessibility | 95 |
| Best Practices | 100 |
| SEO | 92 |

Lighthouse scores can vary between runs because performance measurements depend on the test environment and network conditions.

### Current performance notes

The main remaining Lighthouse observations are related to the hosting environment and browser measurement rather than large application dependencies. The free hosting environment can affect caching and loading metrics.

The implementation already addresses the main controllable items by:

- Using an optimised WebP hero image
- Providing explicit image dimensions where applicable
- Using high priority loading for the hero image
- Minifying CSS
- Keeping JavaScript lightweight
- Avoiding unnecessary libraries

## Accessibility

The theme uses semantic HTML elements such as:

- `header`
- `nav`
- `main`
- `section`
- `article`
- `footer`

Additional accessibility considerations include:

- Meaningful image alt text
- Decorative images use empty alt attributes
- Keyboard-focus styles are visible
- Native links are used for navigation
- ARIA labels are used where additional context is useful

The implementation targets WCAG 2.1 AA principles.

## WordPress Code Quality

The theme follows the WordPress template hierarchy and separates reusable homepage sections into template parts.

Dynamic output is escaped using appropriate WordPress functions such as:

- `esc_html()`
- `esc_url()`
- `esc_attr()`

Theme assets are registered/enqueued through `functions.php`.

Treatment category content is retrieved through WordPress taxonomy and term metadata rather than hard-coding every category card directly into the template.

## Assumptions and Trade-offs

### Required scope first

The task explicitly prioritises the required sections over optional features. The implementation therefore focuses on the navigation, hero, treatment categories, and How It Works sections rather than expanding the page unnecessarily.

### Desktop-first design reference

Because the supplied Figma design was desktop-only, mobile and tablet layouts were interpreted based on the desktop design while maintaining usability and readability.

### Lightweight implementation

Vanilla CSS and JavaScript were chosen instead of introducing a framework or large dependency because the page does not require one.

### Content management

Treatment categories use WordPress taxonomy data and term metadata so the category content can be managed through WordPress rather than requiring changes to the template for every category.

## Future Improvements

With more time, I would consider:

- Adding the optional product cards section
- Adding the accessible FAQ accordion
- Improving server-side caching on production hosting
- Further image optimisation and responsive image sizing
- Adding more extensive automated accessibility and cross-browser testing
- Adding additional editable theme settings where they provide clear value

## Development Notes

The project was intentionally kept small and focused on the quality of the required scope.

The implementation uses a custom WordPress theme without Elementor, Divi, WPBakery, or another page builder.
