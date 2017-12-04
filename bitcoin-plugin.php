<?php
/*
Plugin Name: Top Coin Plugin
Plugin URI: https://huykira.net/webmaster/wordpress/plugin-lay-tin-tu-dong-tu-vnexpress-net.html
Description: Top Coin Plugin by Huy Kira
Author: Huy Kira
Version: 1.0
Author URI: http://www.huykira.net
*/
if ( !function_exists( 'add_action' ) ) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

define('BHK_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BHK_PLUGIN_RIR', plugin_dir_path(__FILE__));

require_once(BHK_PLUGIN_RIR . 'includes/widget.php');
require_once(BHK_PLUGIN_RIR . 'includes/shortcode.php');

function bhk_styles()  { 
    wp_enqueue_style( 'bhk_style', BHK_PLUGIN_URL . 'css/bhk_style.css' );
    wp_enqueue_script( 'bhk_script', BHK_PLUGIN_URL . 'js/bhk_script.js', true, 1.1, true );
}
add_action('wp_enqueue_scripts', 'bhk_styles');