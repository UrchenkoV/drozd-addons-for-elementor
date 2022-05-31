<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Elementor_Drozd_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.6';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Drozd_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Drozd_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_frontend_scripts' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'elementor-test-extension' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Register frontend scripts
	 *
	 * @since    1.0.3
	 */
	public function register_frontend_scripts() {

		wp_register_script(
            'drozd-public-js',
            DROZD_PLUGINS_URL . 'public/js/drozd-public.js',
            array('jquery'),
            DROZD_VERSION,
            true
        );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/elements/image-box.php' );
		require_once( __DIR__ . '/elements/posts-style-1.php' );
		require_once( __DIR__ . '/elements/posts-style-2.php' );
		require_once( __DIR__ . '/elements/posts-style-3.php' );
		require_once( __DIR__ . '/elements/posts-style-4.php' );
		require_once( __DIR__ . '/elements/posts-style-5.php' );
		require_once( __DIR__ . '/elements/posts-style-6.php' );
		require_once( __DIR__ . '/elements/posts-style-7.php' );
		require_once( __DIR__ . '/elements/posts-style-8.php' );
		require_once( __DIR__ . '/elements/posts-style-9.php' );
		require_once( __DIR__ . '/elements/posts-style-10.php' );
		require_once( __DIR__ . '/elements/posts-style-11.php' );
		require_once( __DIR__ . '/elements/posts-style-12.php' );
		require_once( __DIR__ . '/elements/posts-style-13.php' );
		require_once( __DIR__ . '/elements/posts-style-14.php' );
		require_once( __DIR__ . '/elements/posts-style-15.php' );
		require_once( __DIR__ . '/elements/posts-style-16.php' );
		require_once( __DIR__ . '/elements/posts-style-17.php' );
		require_once( __DIR__ . '/elements/posts-style-18.php' );
		require_once( __DIR__ . '/elements/posts-style-19.php' );
		require_once( __DIR__ . '/elements/posts-style-20.php' );
		require_once( __DIR__ . '/elements/flip-box.php' );
		require_once( __DIR__ . '/elements/contact-form-7.php' );
		require_once( __DIR__ . '/elements/info-box.php' );
		require_once( __DIR__ . '/elements/feature-list.php' );
		require_once( __DIR__ . '/elements/tooltip.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Image_Box_1() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_1() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_3() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_4() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_5() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_6() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_7() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_8() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_9() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_10() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_11() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_12() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_13() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_14() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_15() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_16() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_17() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_18() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_19() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Posts_Style_20() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Flip_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Contact_Form_7() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Info_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Feature_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Tooltip() );

	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {

		// Include Control files
		//require_once( __DIR__ . '/controls/test-control.php' );

		// Register control
		//\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );

	}

}

Elementor_Drozd_Extension::instance();

/**
 * Create Drozd Category
 *
 * @since 1.0.0
 */
 function register_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'drozd',
		[
			'title' => __( 'Drozd Elements', 'drozd-addons-for-elementor' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'register_widget_categories' );