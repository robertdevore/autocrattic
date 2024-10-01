# Autocrattic plugin for WordPress

![Autocrattic Version](https://img.shields.io/badge/Version-1.3-green.svg)
![MIT License](https://img.shields.io/badge/License-MIT-blue.svg)

Autocrattic is a WordPress plugin that automatically replaces specific hosting provider names with "WordPress®" across various areas of your site, including post content, titles, and widgets. It offers a settings page where you can easily manage the list of hostnames to replace.

*This plugin is in no way affiliated with Automattic, WordPress, the WordPress Fondation, Matt Mullenweg or WooCommerce, Inc.*

## Features

- Replaces custom hosting provider names with "WordPress®" in:
  - Post content (`the_content`)
  - Post titles (`the_title`)
  - Widget text content (`widget_text_content`)
- Comes with a settings page for easy configuration of hostnames to replace.
- Preloaded with the top 50 hosting provider names for immediate use.
- Secure, localized, and properly escaped for safety and flexibility.

## Installation

1. Download the plugin from [GitHub](https://github.com/robertdevore/autocrattic).
2. Unzip the plugin folder.
3. Upload the unzipped folder to `/wp-content/plugins/` using an FTP client.
4. Activate the plugin through the **Plugins** menu in WordPress.

## Usage

1. Go to **Settings** -> **Autocrattic** to customize the list of hosting providers you want to replace.
2. By default, the plugin replaces popular hosting company names with "WordPress®" across post content, titles, and widget text.
3. Modify the list of hostnames by adding or removing entries in the settings page (separate names by commas).

### Example

If you add "GoDaddy, Bluehost" to the settings, the plugin will replace any occurrence of these names with "WordPress®" across your site's content.

## Security

Autocrattic is built with security in mind:
- **Sanitization**: All input is sanitized using `sanitize_textarea_field` before saving.
- **Escaping**: Output is properly escaped using `esc_html()` and `esc_textarea()` to prevent XSS attacks.
- **Nonces**: WordPress’s built-in nonces are used to secure form submissions.

## Localization

Autocrattic is fully translation-ready and uses localization functions throughout. To contribute a translation, please follow the instructions in the **Contributing** section below.

## Changelog

### v1.0
- Initial release

## Contributing

Contributions are welcome to improve the Autocrattic plugin! Here's how you can get involved:

1. Fork this repository.
2. Create a new branch: `git checkout -b feature/your-feature-name`.
3. Make your changes and commit them: `git commit -m 'Add new feature'`.
4. Push to the branch: `git push origin feature/your-feature-name`.
5. Submit a pull request to the `main` branch.

Please ensure your changes follow WordPress coding standards and that any public-facing text is localized using `__()` or `_e()`.

### Reporting Issues

Found a bug? Have a feature request? Please [open an issue](https://github.com/robertdevore/autocrattic/issues) on GitHub, and I'll look into it as soon as possible.

## License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for more details.

## Author

Created by **Robert DeVore**. If you have any questions, feel free to contact me through the [GitHub Issues](https://github.com/your-repo/autocrattic/issues).

## Disclaimer

It's been stated above but should be said again so there is no confusion:

**This plugin is in no way affiliated with Automattic, WordPress, the WordPress Fondation, Matt Mullenweg or WooCommerce, Inc.**
