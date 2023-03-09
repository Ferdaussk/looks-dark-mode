<?php
namespace LdARkM\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')){ 
	exit; 
} // Exit if accessed directly

class LdARkMWidget extends Widget_Base{

	public function get_name(){
		return esc_html__('LooksDarkMode', 'looks-dark-mode');
	}
	public function get_title(){
		return esc_html__('Looks Dark Mode', 'looks-dark-mode');
	}
	public function get_icon(){
		return 'ldarkm-social-share-icon eicon-adjust';
	}
	public function get_categories(){
		return ['bwdthebest_general_category'];
	}
	public function get_keywords() {
		return ['social', 'shares', 'social-share', 'social-media', 'media', 'plugins', 'developer', 'elementor'];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_ldarkms',
			array(
				'label' => esc_html__( 'Content Settings', 'looks-dark-mode' ),
			)
		);
		$this->add_control(
			'ldarkm_presets_style',
			[
				'label' => esc_html__( 'Select Style', 'looks-dark-mode' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__( 'Style 1', 'looks-dark-mode' ),
					'style2' => esc_html__( 'Style 2', 'looks-dark-mode' ),
					'style3' => esc_html__( 'Style 3', 'looks-dark-mode' ),
					'style4' => esc_html__( 'Style 4', 'looks-dark-mode' ),
					'style5' => esc_html__( 'Style 5', 'looks-dark-mode' ),
					'style6' => esc_html__( 'Style 6', 'looks-dark-mode' ),
					'style7' => esc_html__( 'Style 7', 'looks-dark-mode' ),
					'style8' => esc_html__( 'Style 8', 'looks-dark-mode' ),
					'style9' => esc_html__( 'Style 9', 'looks-dark-mode' ),
					'style10' => esc_html__( 'Style 10', 'looks-dark-mode' ),
					'style11' => esc_html__( 'Style 11', 'looks-dark-mode' ),
					'style12' => esc_html__( 'Style 12', 'looks-dark-mode' ),
					'style13' => esc_html__( 'Style 13', 'looks-dark-mode' ),
					'style14' => esc_html__( 'Style 14', 'looks-dark-mode' ),
					'style15' => esc_html__( 'Style 15', 'looks-dark-mode' ),
					'style16' => esc_html__( 'Style 16', 'looks-dark-mode' ),
					'style17' => esc_html__( 'Style 17', 'looks-dark-mode' ),
					'style18' => esc_html__( 'Style 18', 'looks-dark-mode' ),
					'style19' => esc_html__( 'Style 19', 'looks-dark-mode' ),
					'style20' => esc_html__( 'Style 20', 'looks-dark-mode' ),
					'style21' => esc_html__( 'Style 21', 'looks-dark-mode' ),
				],
			]
		);
		$this->add_control(
			'ldarkm_default_color_type',
			[
				'label' => esc_html__( 'Select Action', 'looks-dark-mode' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => [
					'dark' => esc_html__( 'Dark', 'looks-dark-mode' ),
					'light' => esc_html__( 'Light', 'looks-dark-mode' ),
				],
        'prefix_class' => 'my-prefix-',
        'selectors' => [
            '{{WRAPPER}} .my-prefix-my_select_control' => 'color: #000000;',
        ],
			]
		);
		$this->add_control(
			'my_switcher_control',
			[
				'label' => __( 'My Switcher Control', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'plugin-domain' ),
				'label_off' => __( 'Off', 'plugin-domain' ),
				'return_value' => 'yes',
				'default' => 'no',
				'prefix_class' => 'my-prefix-',
				'selectors' => [
					'{{WRAPPER}} .my-prefix-my_ferdaussk .test_class' => 'color: green; !important',
				],
			]
		);
	
		$this->add_control(
			'ldarkm_color',
			[
				'label' => esc_html__( 'Text Color', 'looks-dark-mode' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} body.dark' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_control(
			'ldarkm_types',
			[
				'label' => esc_html__( 'Select Type', 'looks-dark-mode' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => esc_html__( 'Both', 'looks-dark-mode' ),
					'text' => esc_html__( 'Text', 'looks-dark-mode' ),
					'icon' => esc_html__( 'Icon', 'looks-dark-mode' ),
				],
			]
		);
		$this->add_control(
			'ldarkm_main_title_dark',
			[
				'label' => esc_html__( 'Dark', 'looks-dark-mode' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Dark' , 'looks-dark-mode' ),
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
					'ldarkm_types' => ['text', 'both'],
				],
			]
		);
		$this->add_control(
			'ldarkm_main_title_light',
			[
				'label' => esc_html__( 'Light', 'looks-dark-mode' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Light' , 'looks-dark-mode' ),
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
					'ldarkm_types' => ['text', 'both'],
				],
			]
		);
		$this->add_control(
			'ldarkm_dark_icons',
			[
				'label' => esc_html__( 'Dark Icon', 'looks-dark-mode' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-moon',
					'library' => 'fa-solid',
				],
				'condition' => [
					'ldarkm_types' => ['icon', 'both'],
				],
			]
		);
		$this->add_control(
			'ldarkm_light_icons',
			[
				'label' => esc_html__( 'Light Icon', 'looks-dark-mode' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-moon',
					'library' => 'fa-solid',
				],
				'condition' => [
					'ldarkm_types' => ['icon', 'both'],
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render(){
		$settings = $this->get_settings_for_display();
		echo '<div class="ldarkm_common_style ldarkm_'.$settings['ldarkm_presets_style'].'">';
		?>
			<nav class="ldarkm_dark_root">
				<div class="test_class">Name Ferdaussk from best</div>
				<ul>
					<li>
						<div class="dark-button button_action"><?php echo $settings['ldarkm_main_title_dark']; 
							\Elementor\Icons_Manager::render_icon( $settings['ldarkm_dark_icons'], [ 'aria-hidden' => 'true' ] );?>
							</div>
					</li>
					<li>
						<div class="light-button button_action" hidden="hidden"><?php echo $settings['ldarkm_main_title_light']; 
							\Elementor\Icons_Manager::render_icon( $settings['ldarkm_light_icons'], [ 'aria-hidden' => 'true' ] );?>
							</div>
					</li>
				</ul>
			</nav>
		</div>
		<?php
	}
}
