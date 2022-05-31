<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;

/**
 * Elementor Drozd Widget.
 *
 * @since 1.0.8
 */
class Tooltip extends \Elementor\Widget_Base {

	public function get_name() {
		return 'drozd-tooltip';
	}

	public function get_title() {
		return __( 'Tooltip', 'drozd-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-alert';
	}

	public function get_categories() {
		return [ 'drozd' ];
	}

	protected function register_controls() {

		/*
		 * =======================================
		 * CONTENT
		 * =======================================
		 */
		$this->start_controls_section(
			'tooltip_content',
			[
				'label' => __( 'Content', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'content_type',
			[
				'label' => __( 'Content Type', 'drozd-addons-for-elementor' ),
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
					'text' => [
						'title' => __( 'Text', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-animation-text',
					],
					'shortcode' => [
						'title' => __( 'Shortcode', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-shortcode',
					],
				],
				'default' => 'image',
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
					'content_type' => 'image',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'content_type' => 'image',
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
					'content_type' => 'icon',
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
					'circle' => __( 'Circle', 'drozd-addons-for-elementor' ),
					'square' => __( 'Square', 'drozd-addons-for-elementor' ),
					'rhombus' => __( 'Rhombus', 'drozd-addons-for-elementor' ),
				],
				'default' => 'default',
				'condition' => [
					'content_type' => 'icon',
				],
				'prefix_class' => 'drozd-view-',
			]
		);

		$this->add_control(
			'main_text',
			[
				'label' => esc_html__( 'Content', 'drozd-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Enter your text here', 'drozd-addons-for-elementor'),
				'condition' => [
					'content_type' => 'text',
				],
			]
		);

		$this->add_control(
			'text_tag',
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
				'condition' => [
					'content_type' => 'text',
				],
			]
		);

		$this->add_control(
			'shortcode_content',
			[
				'label' => esc_html__( 'Shortcode', 'drozd-addons-for-elementor'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '[shortcode]', 'drozd-addons-for-elementor'),
				'condition' => [
					'content_type' => 'shortcode',
				],
			]
		);

		$this->add_control(
			'link_image',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://urchenko.ru', 'drozd-addons-for-elementor' ),
				'condition' => [
					'content_type!' => 'shortcode',
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
			'tooltip_popup_position',
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
		            '{{WRAPPER}} .drozd-tooltip .tooltip-position-left:hover .tooltip-popup' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .drozd-tooltip .tooltip-position-top:hover .tooltip-popup' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .drozd-tooltip .tooltip-position-bottom:hover .tooltip-popup' => 'animation-duration: {{SIZE}}ms;',
		            '{{WRAPPER}} .drozd-tooltip .tooltip-position-right:hover .tooltip-popup' => 'animation-duration: {{SIZE}}ms;',
		        ],
			]
		);

		$this->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'drozd-addons-for-elementor'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => esc_html__( 'Tooltip content', 'drozd-addons-for-elementor'),
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

		$this->add_responsive_control(
			'box_align',
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
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper' => 'text-align: {{VALUE}};',
				],
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
				'selector' => '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label' => __( 'Margin', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper',
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_tab_hover',
			[
				'label' => __( 'Hover', 'drozd-addons-for-elementor' ),
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
				'selector' => '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper:hover',
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
					'content_type' => 'icon',
				]
			]
		);

		$this->start_controls_tabs( 'icon_controls' );

		$this->start_controls_tab(
			'icon_control_normal',
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
					'{{WRAPPER}} .drozd-tooltip .content-wrap .icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .drozd-tooltip .content-wrap .icon',
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
            		'size' => 50,
        		],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-tooltip .content-wrap .icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .drozd-tooltip .content-wrap .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-tooltip .content-wrap .icon',
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
					'{{WRAPPER}} .drozd-tooltip .content-wrap .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_control_hover',
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
					'{{WRAPPER}} .drozd-tooltip .content-wrap .icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .drozd-tooltip .content-wrap .icon:hover',
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/* Text Style */
		$this->start_controls_section(
			'text_style',
			[
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'content_type' => 'text',
				]
			]
		);

		$this->start_controls_tabs( 'text_controls' );

		$this->start_controls_tab(
			'text_control_normal',
			[
				'label' => __( 'Normal', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-tooltip .content-wrap .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'text_control_hover',
			[
				'label' => __( 'Hover', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-tooltip .content-wrap .text:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/* Tooltip Style */
		$this->start_controls_section(
			'tooltip_style',
			[
				'label' => __( 'Tooltip', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup' => 'text-align: {{VALUE}};',
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
		            '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup' => 'width: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup' => 'max-width: {{SIZE}}{{UNIT}};',
		        ]
		    ]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tooltip_content_typography',
				'selector' => '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup',
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
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup' => 'background: {{VALUE}};',
					'{{WRAPPER}} .drozd-tooltip .arrow.tooltip-position-top .tooltip-popup:after' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .drozd-tooltip .arrow.tooltip-position-bottom .tooltip-popup:after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .drozd-tooltip .arrow.tooltip-position-left .tooltip-popup:after' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .drozd-tooltip .arrow.tooltip-position-right .tooltip-popup:after' => 'border-right-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'tooltip_content_text_shadow',
				'label' => __( 'Text Shadow', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tooltip_content_shadow',
				'selector' => '{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup',
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	 				'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .drozd-tooltip .tooltip-wrapper .tooltip-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .drozd-tooltip .arrow .tooltip-popup:after' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .drozd-tooltip .arrow.tooltip-position-left .tooltip-popup:after' => 'top: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .drozd-tooltip .arrow.tooltip-position-right .tooltip-popup:after' => 'top: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .drozd-tooltip .arrow.tooltip-position-top .tooltip-popup:after' => 'left: calc( 50% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .drozd-tooltip .arrow.tooltip-position-bottom .tooltip-popup:after' => 'left: calc( 50% - {{SIZE}}{{UNIT}} );',
				],
				'condition' => [
					'show_tooltip_arrow' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['link_image']['url'] ) ) {
			
			$this->add_render_attribute( 'link_image', 'href', $settings['link_image']['url'] );

			if ( $settings['link_image']['is_external'] ) {
				$this->add_render_attribute( 'link_image', 'target', '_blank' );
			}

			if ( ! empty( $settings['link_image']['nofollow'] ) ) {
				$this->add_render_attribute( 'link_image', 'rel', 'nofollow' );
			}
			
		}

		// <div> tooltip-wrapper
		$this->add_render_attribute( 'tooltip_wrapper', 'class', 'tooltip-wrapper' );
		if ( ! empty( $settings['box_hover_animation'] ) ) {
			$this->add_render_attribute( 'tooltip_wrapper', 'class', 'elementor-animation-' . $settings['box_hover_animation'] );
		}

		// Tooltip
		$this->add_render_attribute( 'tooltip_wrapper', 'class', 'tooltip-position-' . $settings['tooltip_popup_position'] );
		if( $settings['show_tooltip_arrow'] == 'yes' ) {
			$this->add_render_attribute( 'tooltip_wrapper', 'class',  'arrow' );
		}
		
		?>
		<div class="drozd-tooltip">

			<div <?php echo $this->get_render_attribute_string( 'tooltip_wrapper' ) ?>>
				
				<div class="content-wrap">
					<?php
					if ( ! empty( $settings['link_image']['url'] ) ) {
						echo '<a ' . $this->get_render_attribute_string( 'link_image' ) . '>';
					}
					if ( $settings['content_type'] == 'image' ) { ?>
						<div class="icon-image">
							<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
						</div>
					<?php }
					elseif ( $settings['content_type'] == 'icon' ) {
						echo '<span class="icon">';
							\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
						echo '</span>';
					}
					elseif ( $settings['content_type'] == 'text' ) { ?>
						<<?php echo $settings['text_tag']; ?> class="text">
							<?php echo $settings['main_text']; ?>
						</<?php echo $settings['text_tag']; ?> class="text">
					<?php }
					elseif ( $settings['content_type'] == 'shortcode' ) {
						echo do_shortcode( $settings['shortcode_content'] );
					}
					if ( ! empty( $settings['link_image']['url'] ) ) {
						echo '</a>';
					}
					?>
				</div>

				<span class="tooltip-popup">
					<?php echo $settings['content'] ?>
				</span>
				
			</div>

		</div>
		<?php

	}

	protected function _content_template() {}

}