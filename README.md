# Basic Business Theme

A minimal, open-source WordPress theme for basic business websites. It features a full-width layout, custom homepage with a hero section, services showcase, business types section, and a built-in waitlist/contact form that saves submissions to the WordPress admin dashboard.

## Features
- **Full-Width Design**: No sidebars, perfect for modern business sites.
- **Custom Homepage Template**: Includes hero banner, services grid/slider (responsive), business types cards, and form.
- **Responsive Layout**: Mobile-friendly with media queries for stacking and sliders.
- **Waitlist Form**: Custom form that stores entries as a Custom Post Type (CPT) in the admin (WP Admin > Waitlist Entries).
- **JavaScript Enhancements**: Header scroll effects, mobile menu, slider for mobile, smooth scrolling, parallax.
- **No Plugins Required**: Everything is built-in.
- **Customizable**: Easy to change colors, images, and content via code edits.

## Installation
1. Download the theme files and place them in a folder named `basic-business-theme` inside your WordPress site's `wp-content/themes/` directory.
2. Log in to your WordPress admin dashboard.
3. Go to **Appearance > Themes** and activate "Basic Business Theme".
4. Create a new page (Pages > Add New), set the template to "Business Homepage", publish it, and set it as your static front page (Settings > Reading > Your homepage displays > A static page).
5. Upload and replace placeholder images (e.g., logo, background, globe) via the Media Library and update URLs in the code.
6. Customize the navigation menu (Appearance > Menus) and assign it to the "Primary Menu" location.

## Usage
- **Homepage Sections**:
  - **Hero**: Edit title, description, and CTA in `page-business-homepage.php`. Replace background and globe images.
  - **Services Showcase**: Update cards with your services. On mobile, it uses a slider.
  - **Business Types**: Update cards with your target audience segments.
  - **Waitlist Form**: Submissions appear in WP Admin > Waitlist Entries. Each entry is a post with name as title and details in content.
- **Other Pages**: Use the default `page.php` for standard pages like About or Contact.
- **Blog/Fallback**: `index.php` handles blog posts or fallback content.

## Customization
- **Colors and Fonts**: Edit `:root` variables in the `<style>` block of `page-business-homepage.php` (or move to `style.css` for global).
- **Add More Sections**: Extend `page-business-homepage.php` with new `<section>` elements.
- **Form Enhancements**: In `functions.php`, uncomment `wp_mail()` to send email notifications. Add reCAPTCHA by integrating Google's API.
- **Menus**: Use WordPress's built-in menu system for the primary nav.
- **Images**: All image URLs are placeholders; replace with your own.
- **Performance**: Minify CSS/JS if deploying to production.

## Development
- **License**: GPLv2 or later. Feel free to fork, modify, and redistribute.
- **Contributing**: Submit pull requests via GitHub (if hosted there). Report issues in the repo.
- **Testing**: Tested on WordPress 6.0+. Ensure PHP 7.4+.
- **Known Issues**: Basic form lacks advanced spam protection—add if needed.

## Credits
- Built with inspiration from standard WP themes and custom requirements.
- Fonts: Poppins via Google Fonts.
- Images: Use Unsplash placeholders; replace with licensed assets.

## Support
For questions, check WordPress forums or contact the author. This theme is provided "as is" without warranty.

© 2025 Edgar Odey for eoAgency - https://eoagency.vercel.app. Licensed under GPLv2.