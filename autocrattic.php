<?php
/**
 * The plugin bootstrap file
 *
 * @package Autocrattic
 * @author  Robert DeVore <me@robertdevore.com>
 * @license MIT https://en.wikipedia.org/wiki/MIT_License
 * @link    https://robertdevore.com
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Autocrattic
 * Plugin URI:        https://robertdevore.com
 * Description:       A plugin that replaces specific hosting provider names with "WordPress®" in the post content.
 * Version:           1.0.0
 * Author:            Robert DeVore
 * Author URI:        https://robertdevore.com
 * License:           MIT
 * License URI:       https://en.wikipedia.org/wiki/MIT_License
 * Text Domain:       autocrattic
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    wp_die();
}

/**
 * Current plugin version.
 */
define( 'AUTOCRATTIC_VERSION', '1.0.0' );


/**
 * Create the settings page for the Autocrattic plugin.
 */
function autocrattic_create_menu() {
    add_menu_page(
        esc_attr__( 'Autocrattic Settings', 'autocrattic' ),
        esc_attr__( 'Autocrattic', 'autocrattic' ),
        'manage_options',
        'autocrattic-settings',
        'autocrattic_settings_page',
        '',
        99
    );
}
add_action( 'admin_menu', 'autocrattic_create_menu' );

/**
 * Register the settings for the Autocrattic plugin.
 */
function autocrattic_register_settings() {
    register_setting(
        'autocrattic-settings-group', 
        'autocrattic_replacements', 
        [
            'sanitize_callback' => 'sanitize_textarea_field'
        ]
    );

    add_settings_section(
        'autocrattic_settings_section',
        esc_attr__( 'Replace Hostnames', 'autocrattic' ),
        null,
        'autocrattic-settings'
    );

    add_settings_field(
        'autocrattic_replacements_field',
        esc_attr__( 'Hostnames to Replace', 'autocrattic' ),
        'autocrattic_textarea_callback',
        'autocrattic-settings',
        'autocrattic_settings_section'
    );
}
add_action( 'admin_init', 'autocrattic_register_settings' );

/**
 * Callback function to render the textarea field for hostnames.
 */
function autocrattic_textarea_callback() {
    $default_hosts = 'WP Engine, Hostinger, Newfold Digital Group, GoDaddy, SiteGround, Cloudflare, Amazon Web Services (AWS), Google Cloud, Liquid Web, A2 Hosting, InMotion Hosting, Kinsta, Namecheap, EIG, Hetzner Online, DreamHost, Wix, Squarespace, Flywheel, Pagely, TMDHosting, Media Temple, FastComet, Pressable, HostGator, Bluehost, GreenGeeks, Nexcess, ScalaHosting, WPX Hosting, BigScoots, Pantheon, WebFaction, DigitalOcean, OVHcloud, Vultr, Linode, AccuWeb Hosting, HostPapa, InterServer, WP-Optimize, Rocket.net, Cloudways, JustHost, EasyWP, Greengeeks, Network Solutions, StableHost, DreamHost, NameSilo, TurnKey Internet';

    // Retrieve the saved option, fallback to default if not set.
    $hosts = get_option( 'autocrattic_replacements', $default_hosts );

    // Display the textarea field with proper escaping.
    echo '<textarea name="autocrattic_replacements" rows="10" cols="50" class="large-text">' . esc_textarea( $hosts ) . '</textarea>';
}

/**
 * Render the Autocrattic settings page.
 */
function autocrattic_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Autocrattic Settings', 'autocrattic' ); ?></h1>
        <form method="post" action="options.php">
            <?php
            // Security field for general settings.
            settings_fields( 'autocrattic-settings-group' );

            // Output the settings section and fields.
            do_settings_sections( 'autocrattic-settings' );

            // Submit button.
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Filter text content in posts, titles, widgets, etc., and replace hostnames with "WordPress®".
 *
 * @param string $text The original content.
 * @return string The filtered content with hostnames replaced by "WordPress®".
 */
function autocrattic_filter_text( $text ) {
    // Retrieve the list of hostnames to replace.
    $replacements = get_option( 'autocrattic_replacements' );
    if ( ! $replacements ) {
        return $text;
    }

    // Convert the list to an array, ensuring each entry is trimmed.
    $hosts = array_map( 'trim', explode( ',', $replacements ) );

    // Escape and replace each host with "WordPress®".
    foreach ( $hosts as $host ) {
        $text = str_replace( esc_html( $host ), esc_html( 'WordPress®' ), $text );
    }

    return $text;
}
add_filter( 'the_content', 'autocrattic_filter_text' );
add_filter( 'the_title', 'autocrattic_filter_text' );
add_filter( 'widget_text_content', 'autocrattic_filter_text' );
