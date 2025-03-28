<?php
/**
 * Addonify - Quick View For WooCommerce
 *
 * @package           Addonify_Quick_View
 * @author            Addonify
 * @copyright         2024 Addonify
 * @license           GPL-2.0-or-later
 *
 * Plugin Name:       Addonify - Quick View For WooCommerce
 * Plugin URI:        https://addonify.com/downloads/woocommerce-quick-view/
 * Description:       Addonify WooCommerce Quick View plugin adds functionality to have a WooCommerce product quick preview on a modal window.
 * Version:           2.0.4
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Tested up to:      6.8
 * Author:            Addonify
 * Author URI:        https://addonify.com
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       addonify-quick-view
 * Domain Path:       /languages
 * Requires Plugins:  woocommerce
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ADDONIFY_QUICK_VIEW_VERSION', '2.0.4' );
define( 'ADDONIFY_QUICK_VIEW_BASENAME', plugin_basename( __FILE__ ) );
define( 'ADDONIFY_QUICK_VIEW_DB_INITIALS', 'addonify_qv_' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-addonify-quick-view-activator.php
 */
function activate_addonify_quick_view() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-addonify-quick-view-activator.php';
	Addonify_Quick_View_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-addonify-quick-view-deactivator.php
 */
function deactivate_addonify_quick_view() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-addonify-quick-view-deactivator.php';
	Addonify_Quick_View_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_addonify_quick_view' );
register_deactivation_hook( __FILE__, 'deactivate_addonify_quick_view' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-addonify-quick-view.php';

/**
 * Load composer dependencies.
 *
 * - mobiledetect URL http://mobiledetect.net/
 */
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * Load the admin vue app.
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/app.php';

if ( ! function_exists( 'addonify_quick_view_run' ) ) {
	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function addonify_quick_view_run() {

		if ( class_exists( 'WooCommerce' ) ) {
			$plugin = new Addonify_Quick_View();
			$plugin->run();
		} elseif ( version_compare( get_bloginfo( 'version' ), '6.5', '<' ) ) {
			add_action(
				'admin_notices',
				function () {
					?>
					<div class="notice notice-error">
						<p><?php echo esc_html__( 'Addonify Quick View is enabled but not effective. It requires WooCommerce in order to work.', 'addonify-quick-view-pro' ); ?></p>
					</div>
					<?php
				}
			);
		}
	}

	add_action( 'plugins_loaded', 'addonify_quick_view_run' );
}
