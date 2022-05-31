<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name:       Drozd - Addons for Elementor
 * Plugin URI:        https://urchenko.ru/drozd/
 * Description:       Set of additional elements for Elementor Page Builder
 * Version:           1.1.0
 * Author:            Urchenko
 * Author URI:        https://urchenko.ru/about-me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       drozd-addons-for-elementor
 * Domain Path:       /languages/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Defining plugin constants.
 *
 * @since 1.0.0
 */
define( 'DROZD_VERSION', '1.1.0' );
define( 'DROZD_PLUGINS_URL', plugins_url( '/', __FILE__ ) );
define( 'DROZD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Connecting files and functions
 */
require_once DROZD_PLUGIN_PATH .'public/elementor/elementor.php';
require_once DROZD_PLUGIN_PATH .'public/elementor/functions/elementor-functions.php';
require_once DROZD_PLUGIN_PATH .'public/elementor/functions/drozd-excerpt.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-drozd-activator.php
 */
function activate_drozd() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-drozd-activator.php';
	Drozd_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-drozd-deactivator.php
 */
function deactivate_drozd() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-drozd-deactivator.php';
	Drozd_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_drozd' );
register_deactivation_hook( __FILE__, 'deactivate_drozd' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-drozd.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_drozd() {

	$plugin = new Drozd();
	$plugin->run();

}
run_drozd();

