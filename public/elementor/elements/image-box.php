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

/**
 * Elementor Drozd Widget.
 *
 * @since 1.0.0
 */
class Image_Box_1 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'drozd-image-box-1';
	}

	public function get_title() {
		return __( 'Image Box', 'drozd-addons-for-elementor' );
	}

	public function get_icon() {
		return 'drozd-icon-image-box-1';
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
			'drozd_image_box_settings',
			[
				'label' => __( 'Image', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'drozd_image_position',
			[
				'label' => __( 'Image Position', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
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
				'prefix_class' => 'drozd-position-%s',
				'default' => 'top',
				'devices' => [ 'desktop', 'tablet' ],

			]
		);

		$this->add_control(
			'drozd_image_box_img_or_icon',
			[
				'label' => __( 'Image or Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'none' => [
						'title' => __( 'None', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-ban',
					],
					'number' => [
						'title' => __( 'Number', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-number-field',
					],
					'icons' => [
						'title' => __( 'Icon', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-favorite',
					],
					'image' => [
						'title' => __( 'Image', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-image',
					],
				],
				'default' => 'image',
			]
		);

		$this->add_control(
			'image_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'top' => [
						'title' => __( 'Top', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'drozd-vertical-alignment-',
				'condition' => [
					'drozd_image_position!' => 'top',
					'drozd_image_box_img_or_icon!' => 'none',
				]

			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .img-icon-num' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'drozd_image_box_img_or_icon!' => 'none',
				],
			]
		);

		/**
		 * Condition: 'drozd_image_box_img_or_icon' => 'image'
		 */
		$this->add_control(
			'drozd_image_box_image',
			[
				'label' => esc_html__( 'Image', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'drozd_image_box_img_or_icon' => 'image',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'drozd_image_box_img_or_icon' => 'image',
				]
			]
		);

		/**
		 * Condition: 'drozd_image_box_img_or_icon' => 'icon'
		 */
		$this->add_control(
			'drozd_image_box_icon',
			[
				'label' => esc_html__( 'Icon', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'drozd_image_box_img_or_icon' => 'icons',
				]
			]
		);

		$this->add_control(
			'drozd_image_box_icon_view',
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
					'drozd_image_box_img_or_icon' => 'icons',
				],
				'prefix_class' => 'drozd-view-',
			]
		);

		$this->add_control(
			'drozd_image_box_icon_shape',
			[
				'label' => __( 'Shape', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'drozd-addons-for-elementor' ),
					'square' => __( 'Square', 'drozd-addons-for-elementor' ),
				],
				'default' => 'circle',
				'condition' => [
					'drozd_image_box_icon_view!' => 'default',
					'drozd_image_box_icon[value]!' => '',
					'drozd_image_box_img_or_icon' => 'icons',
				],
				'prefix_class' => 'drozd-shape-',
			]
		);

		/**
		 * Condition: 'drozd_image_box_img_or_icon' => 'number'
		 */
		$this->add_control(
			'drozd_image_box_number',
			[
				'label' => esc_html__( 'Number', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'drozd_image_box_img_or_icon' => 'number',
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
			'drozd_image_box_content',
			[
				'label' => __( 'Content', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'drozd_image_box_title',
			[
				'label' => __( 'Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'This is the heading', 'drozd-addons-for-elementor' ),
				'placeholder' => __( 'Enter your title', 'drozd-addons-for-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'drozd_image_box_description',
			[
				'label' => __( 'Description', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your description here', 'drozd-addons-for-elementor' ),
				'default' => __( 'Type your description here', 'drozd-addons-for-elementor' ),

			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => __( 'Text', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'List item', 'drozd-addons-for-elementor' ),
				'default' => __( 'List item' , 'drozd-addons-for-elementor' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'drozd_image_box_list_text_bottom_space',
			[
				'label' => __( 'Spacing', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .content .drozd-list-items {{CURRENT_ITEM}}' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'drozd_image_box_list_text_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .content .drozd-list-items {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .drozd-image-box-v1 .content .drozd-list-items {{CURRENT_ITEM}}',
			]
		);

		$this->add_control(
			'drozd_image_box_list_text_repeater',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => __( 'List item #1', 'drozd-addons-for-elementor' ),
					],
					[
						'list_title' => __( 'List item #2', 'drozd-addons-for-elementor' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'drozd-addons-for-elementor' ),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		/*
		 * =======================================
		 * STYLE
		 * =======================================
		 */
		/* Style image */
		$this->start_controls_section(
			'section_image_box_image',
			[
				'label' => __( 'Image', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'drozd_image_box_img_or_icon' => 'image',
				]
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => __( 'Width', 'drozd-addons-for-elementor' ) . ' (px)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);




		$this->start_controls_tabs( 'image_controls' );

		$this->start_controls_tab(
			'image_colors_normal',
			[
				'label' => __( 'Normal', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .drozd-image-box-v1 .image img',
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' => __( 'Opacity', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .image img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .image img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'image_colors_hover',
			[
				'label' => __( 'Hover', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'image_hover_animation',
			[
				'label' => __( 'Hover Animation', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .drozd-image-box-v1 .image img:hover',
			]
		);

		$this->add_control(
			'image_opacity_hover',
			[
				'label' => __( 'Opacity', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .image img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();




		/* Style icon */
		$this->start_controls_section(
			'section_image_box_icon',
			[
				'label' => __( 'Icon', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'drozd_image_box_img_or_icon' => 'icons',
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
					'{{WRAPPER}} .drozd-image-box-v1 .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
            		'size' => 23,
        		],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'drozd_image_box_icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .icon .drozd-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .icon .drozd-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'drozd_image_box_icon_view' => 'framed',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .icon .drozd-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'drozd_image_box_icon_view!' => 'default',
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
			'primary_color',
			[
				'label' => __( 'Primary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.drozd-view-stacked .drozd-image-box-v1 .drozd-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.drozd-view-framed .drozd-image-box-v1 .drozd-icon, {{WRAPPER}}.drozd-view-default .drozd-image-box-v1 .drozd-icon' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'drozd_image_box_icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.drozd-view-framed .drozd-image-box-v1 .icon .drozd-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.drozd-view-stacked .drozd-image-box-v1 .icon .drozd-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
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
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.drozd-view-stacked .drozd-image-box-v1 .drozd-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.drozd-view-framed .drozd-image-box-v1 .drozd-icon:hover, {{WRAPPER}}.drozd-view-default .drozd-image-box-v1 .drozd-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'drozd_image_box_icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.drozd-view-framed .drozd-image-box-v1 .icon .drozd-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.drozd-view-stacked .drozd-image-box-v1 .icon .drozd-icon:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_animation',
			[
				'label' => __( 'Hover Animation', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();




		/* Style number */
		$this->start_controls_section(
			'section_image_box_number',
			[
				'label' => __( 'Number', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'drozd_image_box_img_or_icon' => 'number',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .drozd-image-box-v1 .number .number',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
    		'number_width_height',
    		[
        		'label' => __( 'Width and Height', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
        		'default' => [
            		'size' => 50,
        		],
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 300,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-image-box-v1 .number .number' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
        		],
    		]
		);

		$this->add_responsive_control(
			'number_rotate',
			[
				'label' => __( 'Rotate', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .number .number' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);

		$this->add_responsive_control(
			'number_margin',
			[
				'label' => __( 'Margin', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .number .number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);





		$this->start_controls_tabs( 'number_controls' );

		$this->start_controls_tab(
			'number_controls_normal',
			[
				'label' => __( 'Normal', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => __( 'Primary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .number .number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'number_controls_hover',
			[
				'label' => __( 'Hover', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'number_hover_color',
			[
				'label' => __( 'Primary Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1:hover .number .number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'number_hover_animation',
			[
				'label' => __( 'Hover Animation', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();




		/* Style content */
		$this->start_controls_section(
			'drozd_section_image_box_style',
			[
				'label' => __( 'Content', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
					'justify' => [
						'title' => __( 'Justified', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'top' => [
						'title' => __( 'Top', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'drozd-addons-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'drozd-text-vertical-alignment-',
				'condition' => [
					'drozd_image_position!' => 'top',
					'drozd_image_box_img_or_icon!' => 'none',
				]

			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .content .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .drozd-image-box-v1 .content .title',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'description_bottom_space',
			[
				'label' => __( 'Spacing', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .content .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-image-box-v1 .content .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .drozd-image-box-v1 .content .description',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

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
		// Classes
		if ( $settings['drozd_image_box_img_or_icon'] == 'image' ) {
			$ini_class = 'image';
		} elseif ( $settings['drozd_image_box_img_or_icon'] == 'icons' ) {
			$ini_class = 'icon';
		} elseif ( $settings['drozd_image_box_img_or_icon'] == 'number' ) {
			$ini_class = 'number';
		} else {
			$ini_class = 'none';
		}

		$icon_animation = '';
		if ( ! empty( $settings['icon_hover_animation'] ) ) {
			$icon_animation = ' elementor-animation-' . $settings['icon_hover_animation'];
		}
		$image_animation = '';
		if ( ! empty( $settings['image_hover_animation'] ) ) {
			$image_animation = 'elementor-animation-' . $settings['image_hover_animation'];
		}
		$number_animation = '';
		if ( ! empty( $settings['number_hover_animation'] ) ) {
			$number_animation = 'elementor-animation-' . $settings['number_hover_animation'];
		}

		?>
		<div class="drozd-image-box-v1">
			<div class="img-icon-num <?php echo esc_attr( $ini_class .' '. $image_animation .' '. $number_animation ); ?>">
				<?php
				if ( ! empty( $settings['link']['url'] ) ) {
					echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>';
				}
				if ( $settings['drozd_image_box_img_or_icon'] == 'image' ) {
					echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'drozd_image_box_image' );
				} elseif ( $settings['drozd_image_box_img_or_icon'] == 'icons' ) {
					echo '<span class="drozd-icon' . $icon_animation . '">';
					\Elementor\Icons_Manager::render_icon( $settings['drozd_image_box_icon'], [ 'aria-hidden' => 'true' ] );
					echo '</span>';
				} elseif ( $settings['drozd_image_box_img_or_icon'] == 'number' ) {
					echo '<span class="number">' . $settings['drozd_image_box_number'] . '</span>';
				}
				if ( ! empty( $settings['link']['url'] ) ) {
					echo '</a>';
				}
				?>
			</div>
			<div class="content">
				<?php if ( ! empty( $settings['link']['url'] ) ) { echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>'; } ?>
				<h3 class="title"><?php echo $settings['drozd_image_box_title'] ?></h3>
				<?php if ( ! empty( $settings['link']['url'] ) ) { echo '</a>'; } ?>
				<p class="description"><?php echo $settings['drozd_image_box_description'] ?></p>
				<ul class="drozd-list-items">
				<?php
				foreach ( $settings['drozd_image_box_list_text_repeater'] as $index => $item ) :
				?>
					<li class="drozd-list-item elementor-repeater-item-<?php echo $item['_id']; ?>">
						<?php
						echo $item['list_title'];
						?>
					</li>
				<?php
				endforeach;
				?>
				</ul>
			</div>
		</div>
		<?php

	}

	protected function _content_template() {}

}
