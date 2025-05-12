<?php
/*
Plugin Name: Read More Widget
Description: Custom Read More / Read Less Elementor Widget
Version: 2.0
Author: Sheikh Abdul Fahad
Text Domain: read-more-widget
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Hook into Elementor and register the widget
add_action( 'elementor/widgets/widgets_registered', function( $widgets_manager ) {
    require_once( __DIR__ . '/widgets/read-more-widget.php' );
    $widgets_manager->register( new \Elementor\Read_More_Widget() );
});
