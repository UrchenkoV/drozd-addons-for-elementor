<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;
use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter as Group_Control_Css_Filter;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;

/**
 * Elementor Drozd Widget.
 *
 * @since 1.0.0
 */
class Flip_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'drozd-flip-box';
	}

	public function get_title() {
		return __( 'Flip Box', 'drozd-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-flip-box';
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
			'flip_box_settings',
			[
				'label' => __( 'Settings', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'flip_box_type',
			[
				'label' => __( 'Flipbox Type', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'animate-left' => __( 'Flip Left', 'drozd-addons-for-elementor' ),
					'animate-right' => __( 'Flip Right', 'drozd-addons-for-elementor' ),
					'animate-top' => __( 'Flip Top', 'drozd-addons-for-elementor' ),
					'animate-bottom' => __( 'Flip Bottom', 'drozd-addons-for-elementor' ),
					'animate-in' => __( 'Zoom In', 'drozd-addons-for-elementor' ),
					'animate-out' => __( 'Zoom Out', 'drozd-addons-for-elementor' ),
				],
				'default' => 'animate-left',
				'prefix_class' => 'drozd-',
			]
		);

		$this->start_controls_tabs( 'settings_controls' );

		$this->start_controls_tab(
			'settings_front',
			[
				'label' => __( 'Front', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'icon_type_front',
			[
				'label' => __( 'Icon Type', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'drozd-addons-for-elementor' ),
					'image' => __( 'Image', 'drozd-addons-for-elementor' ),
					'icon' => __( 'Icon', 'drozd-addons-for-elementor' ),
				],
				'default' => 'icon',
			]
		);

		$this->add_control(
			'icon_front',
			[
				'label' => esc_html__( 'Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-bell',
					'library' => 'regular',
				],
				'condition' => [
					'icon_type_front' => 'icon',
				]
			]
		);

		$this->add_control(
			'image_front',
			[
				'label' => esc_html__( 'Image', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type_front' => 'image',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_front',
				'default' => 'full',
				'condition' => [
					'icon_type_front' => 'image',
				]
			]
		);

		$this->add_responsive_control(
    		'image_resizer_front',
    		[
        		'label' => __( 'Image Resizer', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
        		'default' => [
            		'size' => 100,
        		],
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 500,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .icon-image img' => 'width: {{SIZE}}px;',
        		],
        		'condition' => [
					'icon_type_front' => 'image',
				]
    		]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'settings_back',
			[
				'label' => __( 'Back', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'icon_type_back',
			[
				'label' => __( 'Icon Type', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'drozd-addons-for-elementor' ),
					'image' => __( 'Image', 'drozd-addons-for-elementor' ),
					'icon' => __( 'Icon', 'drozd-addons-for-elementor' ),
				],
				'default' => 'icon',
			]
		);

		$this->add_control(
			'icon_back',
			[
				'label' => esc_html__( 'Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-bell',
					'library' => 'regular',
				],
				'condition' => [
					'icon_type_back' => 'icon',
				]
			]
		);

		$this->add_control(
			'image_back',
			[
				'label' => esc_html__( 'Image', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type_back' => 'image',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_back',
				'default' => 'full',
				'condition' => [
					'icon_type_back' => 'image',
				]
			]
		);

		$this->add_responsive_control(
    		'image_resizer_back',
    		[
        		'label' => __( 'Image Resizer', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
        		'default' => [
            		'size' => 100,
        		],
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 500,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .icon-image img' => 'width: {{SIZE}}px;',
        		],
        		'condition' => [
					'icon_type_back' => 'image',
				]
    		]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
		  'image_type',
		  	[
		   	'label'       	=> esc_html__( 'Image Type', 'drozd-addons-for-elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'default',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'default' 	=> esc_html__( 'Default', 'drozd-addons-for-elementor' ),
		     		'circle'  	=> esc_html__( 'Circle', 'drozd-addons-for-elementor' ),
		     		'radius' 	=> esc_html__( 'Radius', 'drozd-addons-for-elementor' ),
		     	],
		     	'prefix_class' => 'drozd-image-',
		     	'condition' => [
		     		'icon_type_back' => 'image'
		     	]
		  	]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}}.drozd-image-radius .icon-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
		     		'image_type' => 'radius'
		     	]
			]
		);

		$this->end_controls_section();





		/*
		 * =======================================
		 * CONTENT
		 * =======================================
		 */
		$this->start_controls_section(
			'flip_box_content',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .alignment' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'content_controls' );

		$this->start_controls_tab(
			'content_front',
			[
				'label' => __( 'Front', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'title_front', [
				'label' => __( 'Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Front Title' , 'drozd-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'text_front',
			[
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'This is front side content.', 'drozd-addons-for-elementor' ),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_back',
			[
				'label' => __( 'Back', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'title_back', [
				'label' => __( 'Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Back Title' , 'drozd-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'text_back',
			[
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'This is back side content.', 'drozd-addons-for-elementor' ),
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/*
		 * =======================================
		 * LINK
		 * =======================================
		 */
		$this->start_controls_section(
			'flip_box_link',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'link_type',
			[
				'label' => __( 'Link Type', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'drozd-addons-for-elementor' ),
					'box' => __( 'Box', 'drozd-addons-for-elementor' ),
					'title' => __( 'Title', 'drozd-addons-for-elementor' ),
					'button' => __( 'Button', 'drozd-addons-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'drozd-addons-for-elementor' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'link_type!' => 'none',
				]
			]
		);

		$this->add_control(
			'button_text', [
				'label' => __( 'Button Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Your text' , 'drozd-addons-for-elementor' ),
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Button Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'link_type' => 'button',
				],
			]
		);

		$this->end_controls_section();




		/* Main Style */
		$this->start_controls_section(
			'main_style',
			[
				'label' => __( 'Main Style', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'front_bg',
			[
				'label' => __( 'Front Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'back_bg',
			[
				'label' => __( 'Back Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .alignment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front, {{WRAPPER}} .drozd-flip-box .flip-box-wrap .back',
			]
		);

		$this->add_responsive_control(
			'content_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_shadow',
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front, {{WRAPPER}} .drozd-flip-box .flip-box-wrap .back',
			]
		);

		$this->end_controls_section();





		/* Icon Style */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Icon Style', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type_front' => 'icon',
				]
			]
		);

		$this->start_controls_tabs( 'icon_controls_style' );

		$this->start_controls_tab(
			'icon_front_style',
			[
				'label' => __( 'Front', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'icon_front_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .icon-image i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
    		'icon_front_size',
    		[
        		'label' => __( 'Icon Size', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
       			'default' => [
            		'size' => 41,
        		],
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 150,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .icon-image i' => 'font-size: {{SIZE}}px;',
        		],
    		]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_type_front',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .icon-image',
			]
		);

		$this->add_responsive_control(
			'icont_border_radius_front',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .icon-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding_front',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_back_style',
			[
				'label' => __( 'Back', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'icon_back_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .icon-image i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
    		'icon_back_size',
    		[
        		'label' => __( 'Icon Size', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
       			'default' => [
            		'size' => 41,
        		],
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 150,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .icon-image i' => 'font-size: {{SIZE}}px;',
        		],
    		]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_type_back',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .icon-image',
			]
		);

		$this->add_responsive_control(
			'icont_border_radius_back',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .icon-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding_back',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .icon-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();







		/* Style content */
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'content_controls_style' );

		$this->start_controls_tab(
			'content_front_style',
			[
				'label' => __( 'Front', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'front_heading_title',
			[
				'label' => __( 'Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_front_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_front_typography',
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .heading',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'front_heading_text',
			[
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_front_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_front_typography',
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .front .content p',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_back_style',
			[
				'label' => __( 'Back', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'back_heading_title',
			[
				'label' => __( 'Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_back_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_back_typography',
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .heading',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'back_heading_text',
			[
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_back_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_back_typography',
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .content p',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
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
					'link_type' => 'button',
				]
			]
		);

		$this->start_controls_tabs( 'button_controls_style' );

		$this->start_controls_tab(
			'button_style_normal',
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
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .button' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => __( 'Margin', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .button',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
    		'button_icon_size',
    		[
        		'label' => __( 'Icon Size', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 50,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back a i' => 'font-size: {{SIZE}}px;',
        		],
        		'condition' => [
					'button_icon!' => '',
				]
    		]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover',
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
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_hover',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-flip-box .flip-box-wrap .back .button:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}
		?>
		<div class="drozd-flip-box">
			<div class="flip-box-wrap">
				<?php
				if ( $settings['link_type'] == 'box' ) {
					echo '<a ' . $this->get_render_attribute_string( 'link' ) . ' class="flip-box-wrap-link">';
				}
				?>
				<div class="front">
					<div class="alignment">
						<?php if( 'none' !== $settings['icon_type_front'] ) : ?>
						<div class="icon-image">
							<?php
							if ( $settings['icon_type_front'] == 'icon' ) {
								\Elementor\Icons_Manager::render_icon( $settings['icon_front'], [ 'aria-hidden' => 'true' ] );
							}
							elseif ( $settings['icon_type_front'] == 'image' ) {
								echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_front', 'image_front' );
							}
							?>
						</div>
						<?php endif; ?>
						
						<h2 class="heading"><?php echo $settings['title_front'] ?></h2>

						<?php if ( !empty( $settings['text_front'] ) ) : ?>
						<div class="content">
							<p><?php echo $settings['text_front'] ?></p>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="back">
					<div class="alignment">
						<?php if( 'none' !== $settings['icon_type_back'] ) : ?>
						<div class="icon-image">
							<?php
							if ( $settings['icon_type_back'] == 'icon' ) {
								\Elementor\Icons_Manager::render_icon( $settings['icon_back'], [ 'aria-hidden' => 'true' ] );
							}
							elseif ( $settings['icon_type_back'] == 'image' ) {
								echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_back', 'image_back' );
							}
							?>
						</div>
						<?php endif; ?>
						<?php
						if ( $settings['link_type'] == 'title' ) {
							echo '<a ' . $this->get_render_attribute_string( 'link' ) . ' class="wrap-heading-link">';
						}
						?>
						<h2 class="heading"><?php echo $settings['title_back'] ?></h2>
						<?php
						if ( $settings['link_type'] == 'title' ) {
							echo '</a>';
						}
						?>
						<?php if ( !empty( $settings['text_back'] ) ) : ?>
						<div class="content">
							<p><?php echo $settings['text_back'] ?></p>
						</div>
						<?php endif; ?>
						<?php
						if ( $settings['link_type'] == 'button' ) {
							echo '<a class="button" ' . $this->get_render_attribute_string( 'link' ) . '>';
							echo $settings['button_text'];
							\Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
							echo '</a>';
						}
						?>
					</div>
				</div>
				<?php
				if ( $settings['link_type'] == 'box' ) {
					echo '</a>';
				}
				?>
			</div>
		</div>
		<?php

	}

	protected function _content_template() {}

}