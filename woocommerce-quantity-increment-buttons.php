<?php
/**
 * Plugin Name: Quantity Increment Buttons for WooCommerce
 * Plugin URI: https://www.woothemes.com/
 * Description: Adds Quantity Increment buttons that were depreciated as of WooCommerce 2.3
 * Version: 1.0.0
 * Author: Nick Verwymeren, WooThemes, Bryce Adams
 * Author URI: https://www.nickv.codes
 * Text Domain: wc-quantity-increment-buttons
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Quantity_Increment_Buttons' ) ) :

/**
 * WooCommerce_Quantity_Increment main class.
 */
class WC_Quantity_Increment_Buttons {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * Instance of this class.
	 *
	 * @var object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin.
	 */
	private function __construct() {


		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Checks with WooCommerce is installed.
		if ( self::is_wc_version_gte_2_3() ) {

			$this->includes();

		} else {
			add_action( 'admin_notices', array( $this, 'woocommerce_missing_notice' ) );
		}

	}

	/**
	 * Return an instance of this class.
	 *
	 * @return object A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @return void
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'wc-quantity-increment-buttons' );

		load_textdomain( 'wc-quantity-increment-buttons', trailingslashit( WP_LANG_DIR ) . 'woocommerce-quantity-increment/woocommerce-quantity-increment-' . $locale . '.mo' );
		load_plugin_textdomain( 'wc-quantity-increment-buttons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Helper method to get the version of the currently installed WooCommerce
	 *
	 * @since 1.0.0
	 * @return string woocommerce version number or null
	 */
	private static function get_wc_version() {
		return defined( 'WC_VERSION' ) && WC_VERSION ? WC_VERSION : null;
	}

	/**
	 * Returns true if the installed version of WooCommerce is 2.3 or greater
	 *
	 * @since 1.0.0
	 * @return boolean true if the installed version of WooCommerce is 2.3 or greater
	 */
	public static function is_wc_version_gte_2_3() {
		return self::get_wc_version() && version_compare( self::get_wc_version(), '2.3', '>=' );
	}

	/**
	 * Includes.
	 *
	 * @return void
	 */
	public function includes() {
		require_once 'includes/class-wc-quantity-increment-buttons.php';
	}

	/**
	 * WooCommerce fallback notice.
	 *
	 * @return string
	 */
	public function woocommerce_missing_notice() {
		echo '<div class="error"><p>' . sprintf( __( 'WooCommerce Quantity Increment requires the %s 2.3 or higher to work!', 'wc-quantity-increment-buttons' ), '<a href="http://www.woothemes.com/woocommerce/" target="_blank">' . __( 'WooCommerce', 'wc-quantity-increment-buttons' ) . '</a>' ) . '</p></div>';
	}

}

add_action( 'plugins_loaded', array( 'WC_Quantity_Increment_Buttons', 'get_instance' ), 0 );

endif;