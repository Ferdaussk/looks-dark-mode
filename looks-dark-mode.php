<?php
/**
 * Plugin Name: Looks Dark Mode
 * Description: Looks Dark Mode plugin with 23+ types of  Share Effects for Elementor.
 * Plugin URI:  https://bwdplugins.com/plugins/looks-dark-mode
 * Version:     1.0
 * Author:      Best WP Developer
 * Author URI:  https://bestwpdeveloper.com/
 * Text Domain: looks-dark-mode
 * Elementor tested up to: 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once ( plugin_dir_path(__FILE__) ) . '/includes/requires-check.php';

final class Final_LDARKM_Share{ 

	const VERSION = '1.0';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		// Load translation
		add_action( 'ldarkm_init', array( $this, 'ldarkm_loaded_textdomain' ) );

		// ldarkm_init Plugin
		add_action( 'plugins_loaded', array( $this, 'ldarkm_init' ) );
	}

	public function ldarkm_loaded_textdomain() {
		load_plugin_textdomain( 'looks-dark-mode' );
	}

	public function ldarkm_init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			// elementor activation check
			add_action( 'admin_notices','ldarkm_share_register_required_plugins');
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'ldarkm_admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'ldarkm_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'ldarkm_plugin_boots.php' );
	}

	public function ldarkm_admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'looks-dark-mode' ),
			'<strong>' . esc_html__( 'Looks Dark Mode', 'looks-dark-mode' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'looks-dark-mode' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'looks-dark-mode') . '</p></div>', $message );
	}

	public function ldarkm_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'looks-dark-mode' ),
			'<strong>' . esc_html__( 'Looks Dark Mode', 'looks-dark-mode' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'looks-dark-mode' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'looks-dark-mode') . '</p></div>', $message );
	}
}

// Instantiate looks-dark-mode.
new Final_LDARKM_Share();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );