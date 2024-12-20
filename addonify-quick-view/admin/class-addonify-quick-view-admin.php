<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://addonify.com
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and other required variables.
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/admin
 * @author     Addodnify <info@addonify.com>
 */
class Addonify_Quick_View_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Default settings_page_slug
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $settings_page_slug = 'addonify-quick-view';


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param string $plugin_name       The name of this plugin.
	 * @param string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}


	/**
	 * Define admin menu item for the plugin page.
	 *
	 * @since 1.0.0
	 */
	public function add_menu_callback() {

		global $admin_page_hooks;

		$parent_menu_slug = array_search( 'addonify', $admin_page_hooks, true );

		if ( ! $parent_menu_slug ) {

			add_menu_page(
				'Addonify Settings',
				'Addonify',
				'manage_options',
				$this->settings_page_slug,
				array( $this, 'get_settings_screen_contents' ),
				'dashicons-superhero',
				70
			);

			add_submenu_page(
				$this->settings_page_slug,
				'Addonify Quick View Settings',
				'Quick View',
				'manage_options',
				$this->settings_page_slug,
				array( $this, 'get_settings_screen_contents' ),
				0
			);
		} else {

			add_submenu_page(
				$parent_menu_slug,
				'Addonify Quick View Settings',
				'Quick View',
				'manage_options',
				$this->settings_page_slug,
				array( $this, 'get_settings_screen_contents' ),
				0
			);
		}
	}


	/**
	 * Add settings link to plugin actions.
	 *
	 * @since    1.0.0
	 *
	 * @param array $links Plugin actions.
	 */
	public function custom_plugin_link_callback( $links ) {

		$action_links = array(
			'<a href="admin.php?page=' . $this->settings_page_slug . '">' . esc_html__( 'Settings', 'addonify-quick-view' ) . '</a>',
		);

		return array_merge( $action_links, $links );
	}


	/**
	 * Show row meta on the plugin screen.
	 *
	 * @since 1.2.13
	 *
	 * @param mixed $links Plugin Row Meta.
	 * @param mixed $file  Plugin Base file.
	 *
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {

		if ( ADDONIFY_QUICK_VIEW_BASENAME !== $file ) {
			return $links;
		}

		$row_meta = array(
			'docs'    => '<a href="https://docs.addonify.com/kb/quick-view/" aria-label="' . esc_attr__( 'View Addonify Quick View documentation', 'addonify-quick-view' ) . '" target="_blank">' . esc_html__( 'Documentation', 'addonify-quick-view' ) . '</a>',
			'github'  => '<a href="https://github.com/addonify/addonify-quick-view" aria-label="' . esc_attr__( 'View Addonify Quick View GitHub link', 'addonify-quick-view' ) . '" target="_blank">' . esc_html__( 'GitHub', 'addonify-quick-view' ) . '</a>',
			'support' => '<a href="https://wordpress.org/support/plugin/addonify-quick-view/" aria-label="' . esc_attr__( 'Visit community forums', 'addonify-quick-view' ) . '" target="_blank">' . esc_html__( 'Community support', 'addonify-quick-view' ) . '</a>',
		);

		return array_merge( $links, $row_meta );
	}

	/**
	 * Get contents from settings page templates and print it
	 *
	 * @since    1.0.0
	 */
	public function get_settings_screen_contents() {
		?>
		<div id="addonify-quick-view-app"></div>
		<?php
	}

	/**
	 * Check if the pro version is active
	 *
	 * @since 1.0.0
	 */
	public static function is_pro_active() {
		return class_exists( 'Addonify_Quick_View_Pro' );
	}
}
