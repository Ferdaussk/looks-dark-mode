<?php
namespace LdARkM\PageSettings;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\PageBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Page_Settings {

	const PANEL_TAB = 'new-tab';

	public function __construct() {
		add_action( 'elementor/init', [ $this, 'ldarkm_breadcrumb_add_panel_tab' ] );
		add_action( 'elementor/documents/register_controls', [ $this, 'ldarkm_breadcrumb_register_document_controls' ] );
	}

	public function ldarkm_breadcrumb_add_panel_tab() {
		Controls_Manager::add_tab( self::PANEL_TAB, esc_html__( 'Looks Dark Mode', 'looks-dark-mode' ) );
	}

	public function ldarkm_breadcrumb_register_document_controls( $document ) {
		if ( ! $document instanceof PageBase || ! $document::get_property( 'has_elements' ) ) {
			return;
		}

		$document->start_controls_section(
			'ldarkm_breadcrumb_new_section',
			[
				'label' => esc_html__( 'Settings', 'looks-dark-mode' ),
				'tab' => self::PANEL_TAB,
			]
		);

		$document->add_control(
			'ldarkm_breadcrumb_text',
			[
				'label' => esc_html__( 'Title', 'looks-dark-mode' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'looks-dark-mode' ),
			]
		);

		$document->end_controls_section();
	}
}
