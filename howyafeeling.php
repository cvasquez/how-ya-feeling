<?php
/**
 * @package How_Ya_Feeling
 * @version 0.1
 */
/*
Plugin Name: How Ya Feeling
Plugin URI:
Description: This plugin gives the ability for users to choose an emotional response to posts.
Author: Chris Vasquez
Version: 0.1
Author URI:
*/

// Adding custom css
	function theme_name_scripts() {
		wp_enqueue_style( 'fontello', trailingslashit( plugin_dir_url( __FILE__ ) ) . "stylesheets/fontello.css" );
		wp_enqueue_style( 'how_ya_feeling', trailingslashit( plugin_dir_url( __FILE__ ) ) . "stylesheets/screen.css" );
	}

	add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


// Dashboard Tab
	function how_ya_feeling_menu() {
		add_menu_page( 'How Ya Feeling', 'How Ya Feeling', 'manage_options', 'hyf-dashboard', 'how_ya_feeling_dashboard');
	}

	function how_ya_feeling_init() {
		wp_enqueue_style( 'fontello', trailingslashit( plugin_dir_url( __FILE__ ) ) . "stylesheets/fontello.css" );
		wp_enqueue_style( 'how_ya_feeling', trailingslashit( plugin_dir_url( __FILE__ ) ) . "stylesheets/screen.css" );
	}

	function how_ya_feeling_dashboard(){
		if( !current_user_can( 'manage_options' )) {
			wp_die( __( 'You cannot do this.' ));
		}
		$how_ya_feeling_dashboard_template = include('how_ya_feeling_dashboard.html');
		return $how_ya_feeling_dashboard_template;
	}

// Plugin Options Menu
	function how_ya_feeling_options_menu() {
		add_submenu_page( 'hyf-dashboard', 'How Ya Feeling - Options', 'Options', 'manage_options', 'hyf-options', 'how_ya_feeling_options');
	}

	function how_ya_feeling_options(){
		if( !current_user_can( 'manage_options' )) {
			wp_die( __( 'You cannot do this.' ));
		}
		$how_ya_feeling_options_template = include('how_ya_feeling_options.html');
		return $how_ya_feeling_options_template;
	}

	add_action( 'admin_menu', 'how_ya_feeling_menu');
	add_action( 'admin_menu', 'how_ya_feeling_options_menu');
	add_action( 'admin_init', 'how_ya_feeling_init');


// Generate Shortcode
	add_shortcode("how_ya_feeling", "how_ya_feeling_handler");

	function how_ya_feeling_handler() {
		$shortcode_output = how_ya_feeling_function();
		return $shortcode_output;
	}

	function how_ya_feeling_function() {
		$how_ya_feeling_template = include('how_ya_feeling.html');
		return $how_ya_feeling_template;
	}

?>
