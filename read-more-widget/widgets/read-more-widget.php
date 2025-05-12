<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Read_More_Widget extends Widget_Base {

    public function get_name() {
        return 'read_more_widget';
    }

    public function get_title() {
        return __( 'Read More Widget', 'read-more-widget' );
    }

    public function get_icon() {
        return 'eicon-toggle'; // Elementor icon
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function _register_controls() {

        // Content Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'read-more-widget' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'read-more-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'read-more-widget' ),
            ]
        );

        $this->add_control(
            'button_text_less',
            [
                'label' => __( 'Button Text (Less)', 'read-more-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read Less', 'read-more-widget' ),
            ]
        );

        $this->add_control(
            'hidden_content',
            [
                'label' => __( 'Hidden Content', 'read-more-widget' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __( 'Your hidden content goes here...', 'read-more-widget' ),
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Button Style', 'read-more-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography Controls
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'read-more-widget' ),
                'selector' => '{{WRAPPER}} .readmore-toggle-btn',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'read-more-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .readmore-toggle-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .readmore-toggle-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .readmore-toggle-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .readmore-toggle-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_width',
            [
                'label' => __( 'Border Width', 'read-more-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .readmore-toggle-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'read-more-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .readmore-toggle-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Style Controls
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => __( 'Content Style', 'read-more-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Content Typography Controls
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Content Typography', 'read-more-widget' ),
                'selector' => '{{WRAPPER}} .readmore-hidden-content',
            ]
        );

        $this->add_control(
            'content_text_color',
            [
                'label' => __( 'Content Text Color', 'read-more-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .readmore-hidden-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'read-more-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .readmore-hidden-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        ?>

        <div id="readmore-widget-<?php echo esc_attr( $widget_id ); ?>" class="readmore-widget-container">
            <div class="readmore-hidden-content" style="display: none;">
                <?php echo wp_kses_post( $settings['hidden_content'] ); ?>
            </div>
            <button class="readmore-toggle-btn" data-more="<?php echo esc_attr( $settings['button_text'] ); ?>" data-less="<?php echo esc_attr( $settings['button_text_less'] ); ?>">
                <?php echo esc_html( $settings['button_text'] ); ?>
            </button>
        </div>

        <style>
            #readmore-widget-<?php echo esc_attr( $widget_id ); ?> {
                text-align: center;
            }
            #readmore-widget-<?php echo esc_attr( $widget_id ); ?> .readmore-toggle-btn {
                padding: 10px 20px;
                border-style: solid;
                cursor: pointer;
                transition: all 0.3s ease;
                display: inline-block;
            }
            #readmore-widget-<?php echo esc_attr( $widget_id ); ?> .readmore-hidden-content {
                margin-bottom: 10px;
            }
        </style>

        <script>
            (function($){
                $(document).ready(function() {
                    var $button = $('#readmore-widget-<?php echo esc_attr( $widget_id ); ?> .readmore-toggle-btn');
                    var $container = $button.prev('.readmore-hidden-content');
                    var moreText = $button.data('more');
                    var lessText = $button.data('less');
                    
                    // Ensure content is hidden on page load
                    $container.hide();
                    $button.text(moreText);
                    
                    $button.on('click', function(){
                        $container.slideToggle(300, function() {
                            // This callback runs after the animation completes
                            $button.text($container.is(':visible') ? lessText : moreText);
                        });
                    });
                });
            })(jQuery);
        </script>

        <?php
    }
}
