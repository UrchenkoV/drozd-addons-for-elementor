<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://urchenko.ru/about-us
 * @since      1.0.0
 *
 * @package    Drozd
 * @subpackage Drozd/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Drozd
 * @subpackage Drozd/admin
 * @author     Urchenko <support@urchenko.ru>
 */
class Drozd_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Register a new menu page
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

	}

	/**
	 * Register a new menu page
	 *
	 * @since    1.0.0
	 */
	public function admin_menu() {

		add_menu_page(
			esc_html__( 'Drozd', 'drozd-addons-for-elementor' ),
			'Drozd',
			'manage_options',
			'drozd-settings',
			[$this, 'drozd_admin_page_settings'],
			DROZD_PLUGINS_URL .'admin/images/drozd-logo.png',
			"25.3"
		);

	}

	public function drozd_admin_page_settings() { ?>

		<div id="drozd-settings-wrapper">
			<div class="header-bar">
				<div class="header-left">
					<div class="logo">
						<img src="<?php echo DROZD_PLUGINS_URL . 'admin/images/drozd-100.png'; ?>" alt="drozd-plugin">
					</div>
					<h2 class="title"><?php esc_html_e( 'Drozd Addons - Settings', 'drozd-addons-for-elementor' ); ?></h2>
				</div>
				<div class="header-right">

				</div>
			</div><!-- .header-bar -->

			<div class="settings-tabs">
				<ul class="drozd-tabs">
					<li>
						<a href="#general" class="active"><img src="<?php echo esc_html( DROZD_PLUGINS_URL . 'admin/images/icon-general.png' ); ?>" alt=""><span><?php esc_html_e( 'General', 'drozd-addons-for-elementor' ); ?></span></a>
					</li>
					<!-- <li>
						<a href="#elements"><img src="<?php //echo esc_html( DROZD_PLUGINS_URL . 'admin/images/icon-element.png' ); ?>" alt=""><span><?php //esc_html_e( 'Elements', 'drozd-addons-for-elementor' ); ?></span></a>
					</li> -->
				</ul>
				<?php
				include_once DROZD_PLUGIN_PATH . 'admin/partials/general.php';
				//include_once DROZD_PLUGIN_PATH . 'admin/partials/elements.php';
				?>
			</div><!-- .settings-tabs -->
		</div><!-- #drozd-settings-wrapper -->
	<?php }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Drozd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Drozd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/drozd-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Drozd_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Drozd_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/drozd-admin.js', array( 'jquery' ), $this->version, false );

	}

}
