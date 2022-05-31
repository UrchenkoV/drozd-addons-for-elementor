<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;

/**
 * Elementor Drozd Widget.
 *
 * @since 1.0.6
 */
class Info_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'drozd-info-box';
	}

	public function get_title() {
		return __( 'Info Box', 'drozd-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'drozd' ];
	}

	protected function register_controls() {

		/*
		 * =======================================
		 * IMAGE
		 * =======================================
		 */
		$this->start_controls_section(
			'info_box_image',
			[
				'label' => __( 'Image', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image_type',
			[
				'label' => __( 'Image or Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'image' => [
						'title' => __( 'Image', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-image',
					],
					'icon' => [
						'title' => __( 'Icon', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-favorite',
					],
				],
				'default' => 'image',
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'image_type' => 'image',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'image_type' => 'image',
				]
			]
		);

		$this->add_control(
			'link_image',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://urchenko.ru', 'drozd-addons-for-elementor' ),
				'condition' => [
					'image_type' => 'image',
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-bell',
					'library' => 'regular',
				],
				'condition' => [
					'image_type' => 'icon',
				]
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => __( 'View', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'drozd-addons-for-elementor' ),
					'stacked' => __( 'Stacked', 'drozd-addons-for-elementor' ),
					'framed' => __( 'Framed', 'drozd-addons-for-elementor' ),
				],
				'default' => 'default',
				'condition' => [
					'image_type' => 'icon',
				],
				'prefix_class' => 'drozd-view-',
			]
		);

		$this->add_control(
			'icon_shape',
			[
				'label' => __( 'Shape', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'drozd-addons-for-elementor' ),
					'square' => __( 'Square', 'drozd-addons-for-elementor' ),
				],
				'default' => 'circle',
				'condition' => [
					'image_type' => 'icon',
					'icon_view!' => 'default',
				],
				'prefix_class' => 'drozd-shape-',
			]
		);

		$this->end_controls_section();





		/*
		 * =======================================
		 * CONTENT
		 * =======================================
		 */
		$this->start_controls_section(
			'info_box_content',
			[
				'label' => __( 'Content', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title' , 'drozd-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title_margin_bottom',
			[
				'label' => __( 'Margin Bottom', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .content {{CURRENT_ITEM}}' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .content {{CURRENT_ITEM}}, .drozd-info-box .info-box-wrap .content {{CURRENT_ITEM}} a' => 'color: {{VALUE}}',
				],
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .content {{CURRENT_ITEM}}',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://urchenko.ru', 'drozd-addons-for-elementor' ),
			]
		);

		$repeater->add_control(
			'title_size',
			[
				'label' => __( 'HTML Tag', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'text_repeater',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'Title #1', 'drozd-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();





		/*
		 * =======================================
		 * BUTTON
		 * =======================================
		 */
		$this->start_controls_section(
			'button',
			[
				'label' => __( 'Button', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_button',
			[
				'label' => __( 'Button', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'drozd-addons-for-elementor' ),
				'label_off' => __( 'Off', 'drozd-addons-for-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'button_text', [
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Your text' , 'drozd-addons-for-elementor' ),
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://urchenko.ru', 'drozd-addons-for-elementor' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'show_button' => 'yes',
				]
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Icon Position', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before' => __( 'Before', 'drozd-addons-for-elementor' ),
					'after' => __( 'After', 'drozd-addons-for-elementor' ),
				],
				'condition' => [
					'show_button' => 'yes',
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .icon-position-before .button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .icon-position-after .button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_button' => 'yes',
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_css_id',
			[
				'label' => __( 'Button ID', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'drozd-addons-for-elementor' ),
				'label_block' => false,
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'drozd-addons-for-elementor' ),
				'separator' => 'before',
				'condition' => [
					'show_button' => 'yes',
				],

			]
		);

		$this->end_controls_section();





		/*
		 * =======================================
		 * RIBBON
		 * =======================================
		 */
		$this->start_controls_section(
			'ribbon',
			[
				'label' => __( 'Ribbon', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_ribbon',
			[
				'label' => __( 'Ribbon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'drozd-addons-for-elementor' ),
				'label_off' => __( 'Off', 'drozd-addons-for-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'ribbon_position',
			[
				'label' => __( 'Position', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ribbon_text', [
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Popular' , 'drozd-addons-for-elementor' ),
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap.ribbon:after' => 'content: "{{SIZE}}";',
				],
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->end_controls_section();





		/*
		 * =======================================
		 * TOOLTIP
		 * =======================================
		 */
		$this->start_controls_section(
			'tooltip',
			[
				'label' => __( 'Tooltip', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_tooltip',
			[
				'label' => __( 'Tooltip', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'drozd-addons-for-elementor' ),
				'label_off' => __( 'Off', 'drozd-addons-for-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'tooltip_icon',
			[
				'label' => esc_html__( 'Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-question-circle',
					'library' => 'regular',
				],
				'condition' => [
					'show_tooltip' => 'yes',
				]
			]
		);

		$this->add_control(
			'tooltip_position',
			[
				'label' => __( 'Position', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'right',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_hover_position',
			[
				'label' => __( 'Hover Position', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'right',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
					'right' => [
						'title' => __( 'Right', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_animation_duration',
			[
				'label' => esc_html__( 'Animation Duration', 'drozd-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 100,
				'default' => 300,
				'label_block' => false,
				'selectors' => [
		            '{{WRAPPER}} .drozd-info-box.tooltip-position-left #drozd-tooltip:hover .content-tooltip' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .drozd-info-box.tooltip-position-top #drozd-tooltip:hover .content-tooltip' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .drozd-info-box.tooltip-position-bottom #drozd-tooltip:hover .content-tooltip' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .drozd-info-box.tooltip-position-right #drozd-tooltip:hover .content-tooltip' => 'animation-duration: {{SIZE}}ms;',
		        ],
		        'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_content',
			[
				'label' => esc_html__( 'Content', 'drozd-addons-for-elementor'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Tooltip content', 'drozd-addons-for-elementor'),
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->end_controls_section();





		/* Box style */
		$this->start_controls_section(
			'box',
			[
				'label' => __( 'Box', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'box_controls' );

		$this->start_controls_tab(
			'box_tab_normal',
			[
				'label' => __( 'Normal', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'box_bg',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap',
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap',
			]
		);

		$this->add_control(
			'box_link',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://urchenko.ru', 'drozd-addons-for-elementor' ),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_tab_hover',
			[
				'label' => __( 'Hover', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'box_bg_hover',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap:hover',
			]
		);

		$this->add_control(
			'box_hover_animation',
			[
				'label' => __( 'Hover Animation', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/* Icon Style */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Icon', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'image_type' => 'icon',
				]
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
            		'size' => 45,
        		],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .icon-image .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
            		'size' => 90,
        		],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .icon-image .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_rotate',
			[
				'label' => __( 'Rotate', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .icon-image .icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_width',
			[
				'label' => __( 'Border Width', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .icon-image .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view' => 'framed',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .icon-image .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => __( 'Primary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.drozd-view-stacked .drozd-info-box .info-box-wrap .icon-image .icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.drozd-view-framed .drozd-info-box .info-box-wrap .icon-image .icon, {{WRAPPER}}.drozd-view-default .drozd-info-box .info-box-wrap .icon-image .icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => __( 'Secondary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.drozd-view-framed .drozd-info-box .info-box-wrap .icon-image .icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.drozd-view-stacked .drozd-info-box .info-box-wrap .icon-image .icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => __( 'Hover', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'primary_color_hover',
			[
				'label' => __( 'Primary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.drozd-view-stacked .drozd-info-box .info-box-wrap .icon-image .icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.drozd-view-framed .drozd-info-box .info-box-wrap .icon-image .icon:hover, {{WRAPPER}}.drozd-view-default .drozd-info-box .info-box-wrap .icon-image .icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color_hover',
			[
				'label' => __( 'Secondary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.drozd-view-framed .drozd-info-box .info-box-wrap .icon-image .icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.drozd-view-stacked .drozd-info-box .info-box-wrap .icon-image .icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/* Button Style */
		$this->start_controls_section(
			'butotn_style',
			[
				'label' => __( 'Button', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button' => 'yes',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'button_text_shadow',
				'label' => __( 'Text Shadow', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_controls_style' );

		$this->start_controls_tab(
			'button_normal_style',
			[
				'label' => __( 'Normal', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_type',
			[
				'label' => __( 'Background Type', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'classic',
				'options' => [
					'classic' => [
						'title' => __( 'Classic', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-barcode',
					],
				],
			]
		);

		$this->add_control(
			'button_bg_classic',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button' => 'background: {{VALUE}};',
				],
				'condition' => [
					'button_bg_type' => 'classic',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_gradiend',
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button',
				'condition' => [
					'button_bg_type' => 'gradient',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow',
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_style',
			[
				'label' => __( 'Hover', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_type_hover',
			[
				'label' => __( 'Background Type', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'classic',
				'options' => [
					'classic' => [
						'title' => __( 'Classic', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-barcode',
					],
				],
			]
		);

		$this->add_control(
			'button_bg_classic_hover',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'button_bg_type_hover' => 'classic',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_gradient_hover',
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button:hover',
				'condition' => [
					'button_bg_type_hover' => 'gradient',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_type_hover',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow_hover',
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap .button-wrapper .button:hover',
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' => __( 'Hover Animation', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/* Ribbon Style */
		$this->start_controls_section(
			'ribbon_style',
			[
				'label' => __( 'Ribbon', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ribbon_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap:after' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ribbon_bg',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box .info-box-wrap:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap:after',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'ribbon_text_shadow',
				'label' => __( 'Text Shadow', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap:after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ribbon_shadow',
				'selector' => '{{WRAPPER}} .drozd-info-box .info-box-wrap:after',
			]
		);

		$this->end_controls_section();





		/* Tooltip Style */
		$this->start_controls_section(
			'tooltip_style',
			[
				'label' => __( 'Tooltip', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_tooltip' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tooltip_tabs' );

		$this->start_controls_tab(
			'tooltip_tab_normal',
			[
				'label' => __( 'Normal', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'tooltip_icon_heading',
			[
				'label' => __( 'Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tooltip_icon_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} #drozd-tooltip i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_icon_size',
			[
				'label' => __( 'Size', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #drozd-tooltip i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tooltip_content_heading',
			[
				'label' => __( 'Content', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tooltip_text_align',
			[
				'label' => __( 'Alignment', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} #drozd-tooltip .content-tooltip' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_content_width',
		    [
		        'label' => __( 'Tooltip Width', 'drozd-addons-for-elementor'),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		        	'size' => '150'
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1000,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} #drozd-tooltip .content-tooltip' => 'width: {{SIZE}}{{UNIT}};',
		        ]
		    ]
		);
		$this->add_responsive_control(
			'tooltip_content_max_width',
		    [
		        'label' => __( 'Tooltip Max Width', 'drozd-addons-for-elementor'),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		        	'size' => '150'
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1000,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} #drozd-tooltip .content-tooltip' => 'max-width: {{SIZE}}{{UNIT}};',
		        ]
		    ]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tooltip_content_typography',
				'selector' => '{{WRAPPER}} #drozd-tooltip .content-tooltip',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'tooltip_content_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} #drozd-tooltip .content-tooltip' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltip_content_bg',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} #drozd-tooltip .content-tooltip' => 'background: {{VALUE}};',
					'{{WRAPPER}} .drozd-info-box.arrow.tooltip-position-top #drozd-tooltip .content-tooltip:after' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .drozd-info-box.arrow.tooltip-position-bottom #drozd-tooltip .content-tooltip:after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .drozd-info-box.arrow.tooltip-position-left #drozd-tooltip .content-tooltip:after' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .drozd-info-box.arrow.tooltip-position-right #drozd-tooltip .content-tooltip:after' => 'border-right-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'tooltip_content_text_shadow',
				'label' => __( 'Text Shadow', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} #drozd-tooltip .content-tooltip',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tooltip_content_shadow',
				'selector' => '{{WRAPPER}} #drozd-tooltip .content-tooltip',
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #drozd-tooltip .content-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tooltip_margin',
			[
				'label' => esc_html__( 'Margin', 'drozd-addons-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 				'{{WRAPPER}} #drozd-tooltip .content-tooltip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'tooltip_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} #drozd-tooltip .content-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'show_tooltip_arrow',
			[
				'label' => __( 'Arrow', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'drozd-addons-for-elementor' ),
				'label_off' => __( 'Off', 'drozd-addons-for-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_responsive_control(
			'tooltip_arrow_size',
			[
				'label' => __( 'Arrow Size', 'drozd-addons-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 100,
		                'step' => 1,
		            ]
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-info-box.arrow #drozd-tooltip .content-tooltip:after' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .drozd-info-box.arrow.tooltip-position-left #drozd-tooltip .content-tooltip:after' => 'top: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .drozd-info-box.arrow.tooltip-position-right #drozd-tooltip .content-tooltip:after' => 'top: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .drozd-info-box.arrow.tooltip-position-top #drozd-tooltip .content-tooltip:after' => 'left: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .drozd-info-box.arrow.tooltip-position-bottom #drozd-tooltip .content-tooltip:after' => 'left: calc( 50% - {{SIZE}}{{UNIT}} );',
				],
				'condition' => [
					'show_tooltip_arrow' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tooltip_tab_hover',
			[
				'label' => __( 'Hover', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'tooltip_icon_color_hover',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} #drozd-tooltip i:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_render_attribute( 'button_link', 'href', $settings['button_link']['url'] );

			if ( $settings['button_link']['is_external'] ) {
				$this->add_render_attribute( 'button_link', 'target', '_blank' );
			}

			if ( ! empty( $settings['button_link']['nofollow'] ) ) {
				$this->add_render_attribute( 'button_link', 'rel', 'nofollow' );
			}

			if ( ! empty( $settings['button_css_id'] ) ) {
				$this->add_render_attribute( 'button_link', 'id', $settings['button_css_id'] );
			}

			$this->add_render_attribute( 'button_link', 'class', 'button' );
			$this->add_render_attribute( 'button_link', 'class', 'icon-position-' . $settings['icon_position'] );

			if ( ! empty( $settings['button_hover_animation'] ) ) {
				$this->add_render_attribute( 'button_link', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
			}
			
		}

		if ( ! empty( $settings['link_image']['url'] ) ) {
			
			$this->add_render_attribute( 'link_image', 'href', $settings['link_image']['url'] );

			if ( $settings['link_image']['is_external'] ) {
				$this->add_render_attribute( 'link_image', 'target', '_blank' );
			}

			if ( ! empty( $settings['link_image']['nofollow'] ) ) {
				$this->add_render_attribute( 'link_image', 'rel', 'nofollow' );
			}
			
		}

		// <div> drozd-info-box
		$this->add_render_attribute( 'drozd_info_box', 'class', 'drozd-info-box' );

		// <div> info-box-wrap
		$this->add_render_attribute( 'info_box_wrap', 'class', 'info-box-wrap' );
		if ( ! empty( $settings['box_hover_animation'] ) ) {
			$this->add_render_attribute( 'info_box_wrap', 'class', 'elementor-animation-' . $settings['box_hover_animation'] );
		}

		// Ribbon
		if( $settings['show_ribbon'] == 'yes' ) {
			$this->add_render_attribute( 'info_box_wrap', 'class',  'ribbon' );
			$this->add_render_attribute( 'info_box_wrap', 'class', 'ribbon-position-' . $settings['ribbon_position'] );
		}

		// Tooltip
		if( $settings['show_tooltip'] == 'yes' ) {
			$this->add_render_attribute( 'drozd_info_box', 'class',  'tooltip' );
			$this->add_render_attribute( 'drozd_info_box', 'class', 'icon-position-' . $settings['tooltip_position'] );
			$this->add_render_attribute( 'drozd_info_box', 'class', 'tooltip-position-' . $settings['tooltip_hover_position'] );
			if( $settings['show_tooltip_arrow'] == 'yes' ) {
				$this->add_render_attribute( 'drozd_info_box', 'class',  'arrow' );
			}
		}

		// Box Link
		if ( ! empty( $settings['box_link']['url'] ) ) {

			$this->add_render_attribute( 'link_box', 'href', $settings['box_link']['url'] );

			if ( $settings['box_link']['is_external'] ) {
				$this->add_render_attribute( 'link_box', 'target', '_blank' );
			}

			if ( ! empty( $settings['box_link']['nofollow'] ) ) {
				$this->add_render_attribute( 'link_box', 'rel', 'nofollow' );
			}
			
		}
		
		?>
		<div <?php echo $this->get_render_attribute_string( 'drozd_info_box' ) ?>>

			<?php if( !empty( $settings['box_link']['url'] ) ) {
				echo '<a ' . $this->get_render_attribute_string( 'link_box' ) . '>';
			} ?>

			<?php if( $settings['show_tooltip'] == 'yes' ) : ?>
				<div id="drozd-tooltip">
					<span class="drozd-tooltip">
						<?php \Elementor\Icons_Manager::render_icon( $settings['tooltip_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
					<div class="content-tooltip">
						<?php echo $settings['tooltip_content'] ?>
					</div>
				</div>
			<?php endif; ?>

			<div <?php echo $this->get_render_attribute_string( 'info_box_wrap' ) ?>>
				
				<div class="icon-image">
					<?php
					if ( $settings['image_type'] == 'image' ) {
						if ( ! empty( $settings['link_image']['url'] ) ) {
						echo '<a ' . $this->get_render_attribute_string( 'link_image' ) . '>';
					}
						echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
					if ( ! empty( $settings['link_image']['url'] ) ) {
						echo '</a>';
					}
					}
					elseif ( $settings['image_type'] == 'icon' ) {
						echo '<span class="icon">';
							\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
						echo '</span>';
					}
					?>
				</div>

				<div class="content">
				<?php foreach ( $settings['text_repeater'] as $index => $item ) : ?>

					<<?php echo $item['title_size'] ?> class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
						<?php
						if ( ! empty( $item['link']['url'] ) ) {
							$link_key = 'link_' . $index;

							$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

							if ( $item['link']['is_external'] ) {
								$this->add_render_attribute( $link_key, 'target', '_blank' );
							}

							if ( $item['link']['nofollow'] ) {
								$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
							}

							echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
						}

						echo esc_html( $item['list_title'] );

						if ( !empty( $item['link']['url'] ) ) : ?>
							</a>
						<?php endif; ?>

					</<?php echo $item['title_size'] ?>>

				<?php endforeach; ?>
				</div>

				<?php if ( $settings['show_button'] == 'yes' ) : ?>
				<div class="button-wrapper">
					<a <?php echo $this->get_render_attribute_string( 'button_link' ) ?>>
						<?php if( !empty( $settings['button_icon'] != '' ) && $settings['icon_position'] == 'before' ) : ?>
							<span class="button-icon">
								<?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>

						<span class="button-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
						
						<?php if( $settings['icon_position'] == 'after' ) : ?>
							<span class="button-icon">
								<?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>
					</a>
				</div>
				<?php endif; ?>
				
			</div>

			<?php if( !empty( $settings['box_link']['url'] ) ) {
				echo '</a>';
			} ?>

		</div>
		<?php

	}

	protected function _content_template() {}

}