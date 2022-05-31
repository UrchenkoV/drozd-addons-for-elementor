<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter as Group_Control_Css_Filter;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background as Group_Control_Background;

/**
 * Elementor Drozd Widget.
 *
 * @since 1.0.5
 */
class Contact_Form_7 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'drozd-contact-form-7';
	}

	public function get_title() {
		return __( 'Contact Form 7', 'drozd-addons-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-mail';
	}

	public function get_categories() {
		return [ 'drozd' ];
	}

	protected function register_controls() {

		
		if ( !function_exists('wpcf7') ) {

            $this->start_controls_section(
                'drozd_global_warning',
                [
                    'label' => __('Warning', 'drozd-addons-for-elementor'),
                ]
            );

            $this->add_control(
                'drozd_global_warning_text',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => __('<strong>Contact Form 7</strong> is not installed/activated on your site. Please install and activate <strong>Contact Form 7</strong> first.', 'drozd-addons-for-elementor'),
                    'content_classes' => 'drozd-warning',
                ]
            );

            $this->end_controls_section();

        } else {

		/*
		 * =======================================
		 * CONTACT FORM
		 * =======================================
		 */
		$this->start_controls_section(
			'contact_form_settings',
			[
				'label' => __( 'Contact Form', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_list',
			[
				'label' => __( 'Select Form', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options' => drozd_select_contact_form(),
				'default' => '0',
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => __( 'Form Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'drozd-addons-for-elementor' ),
				'label_off' => __( 'Off', 'drozd-addons-for-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'form_title_text', [
				'label' => __( 'Title', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'label_block' => true,
				'condition' => [
					'form_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'form_description',
			[
				'label' => __( 'Form Description', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'drozd-addons-for-elementor' ),
				'label_off' => __( 'Off', 'drozd-addons-for-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'form_description_text', [
				'label' => __( 'Description', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => '',
				'label_block' => true,
				'condition' => [
					'form_description' => 'yes',
				],
			]
		);

		$this->end_controls_section();





		/*
		 * =======================================
		 * ERRORS
		 * =======================================
		 */
		$this->start_controls_section(
			'contact_form_errors',
			[
				'label' => __( 'Errors', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'error_messages',
			[
				'label' => __( 'Error Messages', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show' => __( 'Show', 'drozd-addons-for-elementor' ),
					'hide' => __( 'Hide', 'drozd-addons-for-elementor' ),
				],
				'selectors_dictionary' => [
					'show' => 'block',
					'hide' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'validation_errors',
			[
				'label' => __( 'Validation Errors', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show' => __( 'Show', 'drozd-addons-for-elementor' ),
					'hide' => __( 'Hide', 'drozd-addons-for-elementor' ),
				],
				'selectors_dictionary' => [
					'show' => 'block',
					'hide' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors' => 'display: {{VALUE}} !important;'
				],
			]
		);

		$this->end_controls_section();





		/* Container Style */
		$this->start_controls_section(
			'container_style',
			[
				'label' => __( 'Container', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'container_bg',
                'label' => __('Background', 'drozd-addons-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .contact-form-7',
            ]
        );

        $this->add_responsive_control(
            'form_max_width',
            [
                'label' => esc_html__('Form Max Width', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .contact-form-7' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'container_padding',
			[
				'label' => __( 'Padding', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .contact-form-7' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_margin',
			[
				'label' => __( 'Margin', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .contact-form-7' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'container_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .contact-form-7',
			]
		);

		$this->add_responsive_control(
			'container_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .contact-form-7' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'container_shadow',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .contact-form-7',
			]
		);

		$this->end_controls_section();





		/* Title and Description Style */
		$this->start_controls_section(
			'title_description_style',
			[
				'label' => __( 'Title and Description', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
                    'form_title' => 'yes',
                ],
			]
		);

		$this->add_responsive_control(
            'heading_alignment',
            [
                'label' => __('Alignment', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'drozd-addons-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'drozd-addons-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'drozd-addons-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => __('Title', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .heading .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .heading .title',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
            'description_heading',
            [
                'label' => __('Description', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
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
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .heading .description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .heading .description',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();







		/* Input and Textarea Style */
		$this->start_controls_section(
			'input_textarea_style',
			[
				'label' => __( 'Input and Textarea', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'input_textarea_controls_style' );

		$this->start_controls_tab(
			'input_normal_style',
			[
				'label' => __( 'Normal', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'input_bg',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-select' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => __( 'Text Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-select' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
            'input_spacing',
            [
                'label' => __('Spacing', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '20',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form p:not(:last-of-type) .wpcf7-form-control-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_padding',
            [
                'label' => __('Padding', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_indent',
            [
                'label' => __('Text Indent', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-select' => 'text-indent: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'input_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-select',
			]
		);

		$this->add_responsive_control(
			'input_border_radius',
			[
				'label' => __( 'Border Radius', 'drozd-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-text,  {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-select',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_shadow',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-text,  {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control.wpcf7-select',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'input_focus_style',
			[
				'label' => __( 'Focus', 'drozd-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'input_bg_focus',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input:focus, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form textarea:focus' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'input_border_type_focus',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input:focus, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form textarea:focus',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_shadow_focus',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input:focus, {{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form textarea:focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/* Labels Style */
		$this->start_controls_section(
			'labels_style',
			[
				'label' => __( 'Labels', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form label',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
    		'labels_spacing',
    		[
        		'label' => __( 'Spacing', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 100,
                		'step' => 1,
            		]
        		],
        		'size_units' => ['px', 'em', '%'],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form .wpcf7-form-control-wrap' => 'margin-top: {{SIZE}}{{UNIT}}',
        		],
    		]
		);

		$this->end_controls_section();





		/* Labels Style */
		$this->start_controls_section(
			'placeholder_style',
			[
				'label' => __( 'Placeholder', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'placeholder_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'placeholder_typography',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form-control::-webkit-input-placeholder',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();





		/* Submit Button Style */
		$this->start_controls_section(
			'submit_button_style',
			[
				'label' => __( 'Submit Button', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'button_width_type',
            [
                'label' => __('Width', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'full-width' => __('Full Width', 'drozd-addons-for-elementor'),
                    'custom' => __('Custom', 'drozd-addons-for-elementor'),
                ],
                'prefix_class' => 'drozd-contact-form-7-button-',
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label' => __('Alignment', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'drozd-addons-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'drozd-addons-for-elementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'drozd-addons-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form p:nth-last-of-type(1)' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]' => 'display:inline-block;',
                ],
                'condition' => [
                    'button_width_type' => 'custom',
                ],
            ]
        );

		$this->start_controls_tabs( 'submit_button_controls_style' );

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
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]',
			]
		);

		$this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
    		'button_margin_top',
    		[
        		'label' => __( 'Margin Top', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 100,
                		'step' => 1,
            		]
        		],
        		'size_units' => ['px', 'em', '%'],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
        		],
    		]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_shadow',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]',
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
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[
				'label' => __( 'Border Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form input[type="submit"]:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		/* Errors Style */
		$this->start_controls_section(
			'errors_style',
			[
				'label' => __( 'Errors', 'drozd-addons-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'error_messages_heading',
            [
                'label' => __('Error Messages', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'condition' => [
                    'error_messages' => 'show',
                ],
            ]
        );

        $this->add_control(
			'error_messages_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form .wpcf7-not-valid-tip' => 'color: {{VALUE}};',
				],
				'condition' => [
                    'error_messages' => 'show',
                ],
			]
		);

		$this->add_responsive_control(
    		'error_messages_margin_top',
    		[
        		'label' => __( 'Margin Top', 'drozd-addons-for-elementor' ),
       			'type' => Controls_Manager::SLIDER,
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 100,
                		'step' => 1,
            		]
        		],
        		'size_units' => ['px', 'em', '%'],
        		'selectors' => [
            		'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-form .wpcf7-not-valid-tip' => 'margin-top: {{SIZE}}{{UNIT}}',
        		],
        		'condition' => [
                    'error_messages' => 'show',
                ],
    		]
		);

		$this->add_control(
            'validation_errors_heading',
            [
                'label' => __('Validation Error', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_control(
			'validation_errors_color',
			[
				'label' => __( 'Color', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors' => 'color: {{VALUE}};',
				],
				'condition' => [
                    'validation_errors' => 'show',
                ],
			]
		);

		$this->add_control(
			'validation_errors_bg',
			[
				'label' => __( 'Background', 'drozd-addons-for-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors' => 'background: {{VALUE}};',
				],
				'condition' => [
                    'validation_errors' => 'show',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'validation_errors_border_type',
				'label' => __( 'Border Type', 'drozd-addons-for-elementor' ),
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors',
				'condition' => [
                    'validation_errors' => 'show',
                ],
			]
		);

		$this->add_responsive_control(
            'validation_errors_border_radius',
            [
                'label' => __('Border Radius', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'validation_errors_padding',
            [
                'label' => __('Padding', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_responsive_control(
            'validation_errors_margin',
            [
                'label' => __('Margin', 'drozd-addons-for-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'validation_errors' => 'show',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'validation_errors_typography',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors',
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'condition' => [
                    'validation_errors' => 'show',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'validation_errors_shadow',
				'selector' => '{{WRAPPER}} .drozd-contact-form-7-wrapper .wpcf7-validation-errors',
				'condition' => [
                    'validation_errors' => 'show',
                ],
			]
		);

		$this->end_controls_section();
        } // End else

	}

	protected function render() {

		if ( !function_exists( 'wpcf7' ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'contact-form', 'class', ['contact-form-7'] );

		if ( !empty( $settings['form_list'] ) ) : ?>

			<div class="drozd-contact-form-7-wrapper">
				<div <?php echo $this->get_render_attribute_string( 'contact-form' ); ?> >
					<?php if ( $settings['form_title'] == 'yes' || $settings['form_description'] == 'yes' ) : ?>
						<div class="heading">
							<?php if ( $settings['form_title'] === 'yes' && $settings['form_title_text'] != '' ) : ?>
								<h3 class="title"><?php echo esc_attr( $settings['form_title_text'] ); ?></h3>
							<?php endif; ?>

							<?php if ( $settings['form_description'] === 'yes' && $settings['form_description_text'] != '' ) : ?>
								<p class="description"><?php echo esc_attr( $settings['form_description_text'] ); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					
					<?php echo do_shortcode( '[contact-form-7 id="'. $settings['form_list'] .'"]', false ) ?>
				</div>
			</div>
			
		<?php endif; 

	}

	protected function _content_template() {}

}