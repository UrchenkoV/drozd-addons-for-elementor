<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;

/**
 * Elementor Drozd Widget.
 *
 * @since 1.0.7
 */
class Feature_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'drozd-feature-list';
	}

	public function get_title() {
		return __( 'Feature List', 'drozd-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_categories() {
		return [ 'drozd' ];
	}

	protected function register_controls() {

		/*
		 * =======================================
		 * SETTINGS
		 * =======================================
		 */
		$this->start_controls_section(
			'feature_list_settings',
			[
				'label' => __( 'Settings', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'position_align',
			[
				'label' => __( 'Position', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'drozd-position-',
			]
		);

		$this->add_responsive_control(
			'vertical_align',
			[
				'label' => __( 'Vertical Alignment', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'top' => [
						'title' => __( 'Top', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Center', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-stretch',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'drozd-vertical-align-',
				'condition' => [
					'position_align!' => 'top',
				]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon_image_type',
			[
				'label' => __( 'Image or Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-favorite',
					],
					'image' => [
						'title' => __( 'Image', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-image',
					],
				],
				'default' => 'icon',
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_image_type' => 'image',
				]
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-bell',
					'library' => 'regular',
				],
				'condition' => [
					'icon_image_type' => 'icon',
				]
			]
		);

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title' , 'drozd-addons-for-elementor' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'list_content',
			[
				'label'   => esc_html__( 'Content', 'drozd-addons-for-elementor'),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'drozd-addons-for-elementor'),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://urchenko.ru', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'content_repeater',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'icon'    => [
							'value' => 'fas fa-bell',
							'library'	=> 'fa-solid'
						],
						'list_title' => __( 'Title #1', 'drozd-addons-for-elementor' ),
					],
					[
						'icon'    => [
							'value' => 'fas fa-check',
							'library'	=> 'fa-solid'
						],
						'list_title' => __( 'Title #2', 'drozd-addons-for-elementor' ),
					],
					[
						'icon'    => [
							'value' => 'fas fa-anchor',
							'library'	=> 'fa-solid'
						],
						'list_title' => __( 'Title #3', 'drozd-addons-for-elementor' ),
					],
				],
				'title_field' => '<i class="{{ icon.value }}" aria-hidden="true"></i> {{{ list_title }}}',
			]
		);

		$this->add_control(
			'title_tag',
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
				'separator' => 'before'
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => __( 'View', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'drozd-addons-for-elementor' ),
					'circle' => __( 'Circle', 'drozd-addons-for-elementor' ),
					'square' => __( 'Square', 'drozd-addons-for-elementor' ),
					'rhombus' => __( 'Rhombus', 'drozd-addons-for-elementor' ),
				],
				'default' => 'default',
				'prefix_class' => 'drozd-view-',
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
			'box_heading',
			[
				'label' => __( 'Box', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [
                    'image',
                ],
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-wrap',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-wrap',
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-wrap',
			]
		);

		$this->add_control(
			'list_heading',
			[
				'label' => __( 'List', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'list_margin_bottom',
			[
				'label' => __( 'Margin Bottom', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
            		'size' => 25,
        		],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => __( 'Divider', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'drozd-addons-for-elementor' ),
				'label_off' => __( 'Off', 'drozd-addons-for-elementor' ),
				'return_value' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __( 'Style', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'drozd-addons-for-elementor' ),
					'double' => __( 'Double', 'drozd-addons-for-elementor' ),
					'dotted' => __( 'Dotted', 'drozd-addons-for-elementor' ),
					'dashed' => __( 'Dashed', 'drozd-addons-for-elementor' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => __( 'Weight', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => __( 'Width', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#dddddd',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_padding_bottom',
			[
				'label' => __( 'Padding Bottom', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 25,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item:not(:last-child)' => 'padding-bottom: {{SIZE}}{{UNIT}}',
				],
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
			'box_heading_hover',
			[
				'label' => __( 'Box', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_hover',
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [
                    'image',
                ],
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-wrap:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border_type_hover',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-wrap:hover',
			]
		);

		$this->add_responsive_control(
			'box_border_radius_hover',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-wrap:hover',
			]
		);

		$this->add_control(
			'box_hover_animation',
			[
				'label' => __( 'Hover Animation', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'list_heading_hover',
			[
				'label' => __( 'List', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'list_hover_animation',
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
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item .icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'icon_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item .icon-image .icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg',
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [
                    'image',
                ],
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-item .icon-image .icon',
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
            		'size' => 40,
        		],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item .icon-image .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
            		'size' => 80,
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
					'{{WRAPPER}} .drozd-feature-list .feature-list-item .icon-image .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-item .icon-image .icon',
				'condition' => [
					'icon_view!' => 'default',
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
					'{{WRAPPER}} .drozd-feature-list .feature-list-item .icon-image .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view!' => 'default',
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
			'icon_color_hover',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item:hover .icon-image .icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_hover',
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [
                    'image',
                ],
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-item:hover .icon-image .icon',
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/* Content Style */
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_align',
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
					'{{WRAPPER}} .drozd-feature-list .feature-list-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => __( 'Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_margin_bottom',
			[
				'label' => __( 'Margin Bottom', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item .title, {{WRAPPER}} .drozd-feature-list .feature-list-item .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-item .title',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label' => __( 'Description', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-feature-list .feature-list-item .content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .drozd-feature-list .feature-list-item .content',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		// <ul> 
		$this->add_render_attribute( 'feature_list', 'class', 'feature-list-wrap' );
		if ( ! empty( $settings['box_hover_animation'] ) ) {
			$this->add_render_attribute( 'feature_list', 'class', 'elementor-animation-' . $settings['box_hover_animation'] );
		}

		// <li>
		$this->add_render_attribute( 'tag_li', 'class', 'feature-list-item' );
		if ( ! empty( $settings['list_hover_animation'] ) ) {
			$this->add_render_attribute( 'tag_li', 'class', 'elementor-animation-' . $settings['list_hover_animation'] );
		}
		?>
		<div class="drozd-feature-list">

			<ul <?php echo $this->get_render_attribute_string( 'feature_list' ) ?>>
				<?php foreach ( $settings['content_repeater'] as $index => $item ) : ?>

					<li <?php echo $this->get_render_attribute_string( 'tag_li' ) ?>>

						<div class="icon-image">
							<?php
							// Link
							if ( ! empty( $item['link']['url'] ) ) {
								$link_key = 'link_' . $index;

								$this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

								if ( $item['link']['is_external'] ) {
									$this->add_render_attribute( $link_key, 'target', '_blank' );
								}

								if ( ! empty( $item['link']['nofollow'] ) ) {
									$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
								}

							}

							if ( ! empty( $item['link']['url'] ) ) {
								echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
							}
							if ( $item['icon_image_type'] == 'icon' ) {
								echo '<span class="icon">';
								\Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
								echo '</span>';
							}
							elseif ( $item['icon_image_type'] == 'image' ) {
								echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'image' );
							}
							if ( ! empty( $item['link']['url'] ) ) {
								echo '</a>';
							}
							?>
						</div>

						<div class="content">

							<<?php echo $settings['title_tag'] ?> class="title">
							<?php
							if ( ! empty( $item['link']['url'] ) ) {
								echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
							}
							echo esc_html( $item['list_title'] );

							if ( ! empty( $item['link']['url'] ) ) {
								echo '</a>';
							}
							?>
							</<?php echo $settings['title_tag'] ?>>

							<p class="content">
								<?php echo esc_html( $item['list_content'] ); ?>
							</p>
						</div>
					</li>

				<?php endforeach; ?>
			</ul>

		</div>
		<?php

	}

	protected function _content_template() {}

}