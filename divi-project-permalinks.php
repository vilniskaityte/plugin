<?php
/**
 * Plugin Name:       Divi Project Permalinks
 * Description:       Configure clean permalinks for Divi `project` post type based on category or custom slug.
 * Version:           1.6.1
 * Author:            Miss Web
 * Text Domain:       dpp
 * Domain Path:       /languages
 * Requires PHP:      7.4
 * Requires at least: 6.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'DPP_VERSION', '1.6.1' );
define( 'DPP_DIR', plugin_dir_path( __FILE__ ) );
define( 'DPP_URL', plugin_dir_url( __FILE__ ) );

// Load translations (once)
add_action( 'plugins_loaded', function(){
	load_plugin_textdomain( 'dpp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
});

// "Settings" link in Plugins list
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function( $links ){
	$links[] = '<a href="' . esc_url( admin_url( 'options-general.php?page=dpp-settings' ) ) . '">' .
	           esc_html__( 'Settings', 'dpp' ) . '</a>';
	return $links;
});

// Includes
require_once DPP_DIR . 'includes/helpers.php';
require_once DPP_DIR . 'includes/class-dpp-rewrites.php';
require_once DPP_DIR . 'includes/class-dpp-admin.php';

// Activation / Deactivation
register_activation_hook( __FILE__, function(){
	// set defaults one-time
	if ( ! is_array( get_option( 'dpp_settings' ) ) ) {
		update_option( 'dpp_settings', array(
			'default_base' => 'projects',
			'rules'        => array(),
		) );
	}
	DPP_Rewrites::register_rules();
	flush_rewrite_rules();
});

register_deactivation_hook( __FILE__, function(){
	flush_rewrite_rules();
});

// Bootstrap
add_action( 'init', array( 'DPP_Rewrites', 'init' ) );
add_action( 'admin_menu', array( 'DPP_Admin', 'menu' ) );
add_action( 'admin_init', array( 'DPP_Admin', 'settings' ) );