<?php
namespace LdARkM;

use LdARkM\PageSettings\Page_Settings;
define( "LDARKM_ASFSK_ASSETS_PUBLIC_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "LDARKM_ASFSK_ASSETS_ADMIN_DIR_FILE", plugin_dir_url( __FILE__ ) . "assets/admin" );

class ClassLdARkMBoots {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function ldarkm_admin_editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'ldarkm_admin_editor_scripts_as_a_module' ], 10, 2 );
	}

	public function ldarkm_admin_editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'ldarkm_the_dark-mode_editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}
		return $tag;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/looks-dark-mode-widget.php' );
	}

	public function ldarkm_register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		// From PowerPack
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\LdARkMWidget() );
	}

	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/ldarkm-manager.php' );
		new Page_Settings();
	}

	// Register Category
	function ldarkm_add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'bwdthebest_general_category',
			[
				'title' => esc_html__( 'BWD General Group', 'looks-dark-mode' ),
				'icon' => 'eicon-person',
			]
		);
	}

	public function ldarkm_all_assets_for_the_public(){
		wp_enqueue_script('ldarkm-the-jquery','https://code.jquery.com/jquery-3.5.1.slim.min.js', ['jquery'], '1.0', true);
		$all_css_js_file = array(
			'ldarkm-dark-mode-style-decorating' => array('ldarkm_path_define'=>LDARKM_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/decorating.css'),
			'ldarkm-dark-mode-style' => array('ldarkm_path_define'=>LDARKM_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/css/style.css'),

			'ldarkm-dark-mode-js' => array('ldarkm_path_define'=>LDARKM_ASFSK_ASSETS_PUBLIC_DIR_FILE . '/js/script.js'),
		);
		foreach($all_css_js_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['ldarkm_path_define'], null, '1.0', 'all');
			wp_enqueue_script( $handle, $fileinfo['ldarkm_path_define'], ['jquery'], '1.0', true);
		}
	}

	public function ldarkm_all_assets_for_elementor_editor_admin(){
		$all_css_js_file = array(
			'ldarkm_dark-mode_admin_icon_css' => array('ldarkm_path_admin_define'=>LDARKM_ASFSK_ASSETS_ADMIN_DIR_FILE . '/icon.css'),
		);

		foreach($all_css_js_file as $handle => $fileinfo){
			wp_enqueue_style( $handle, $fileinfo['ldarkm_path_admin_define'], null, '1.0', 'all');
		}
	}

	public function __construct() {
		// For public assets
		add_action('wp_enqueue_scripts', [$this, 'ldarkm_all_assets_for_the_public']);

		// For Elementor Editor
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'ldarkm_all_assets_for_elementor_editor_admin']);
		
		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'ldarkm_add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'ldarkm_register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'ldarkm_admin_editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
ClassLdARkMBoots::instance();