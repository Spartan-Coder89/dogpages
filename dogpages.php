<?php

/**
 * Plugin Name: Dog Pages
 * Description: Allows users to create a page to a site by uploading a picture of a dog.
 * Version: 0.1
 * Author: Simon Jiloma
 * Network: true
 */

if ( ! function_exists( 'add_action' ) ) {
	exit;
}

spl_autoload_register( function ( $class ) {
  if ( $class !== 'WP_Site_Health' and $class !== 'WP_Automatic_Updater' ) {
    require_once plugin_dir_path(__FILE__) .'includes/classes/' . $class . '.php';
  }
});

define( 'DMEP_PATH', plugin_dir_path(__FILE__) );
define( 'DMEP_URL', plugins_url( '', __FILE__ ) );

add_action('plugins_loaded', function() {
  new DMEP_Licensing;
  new DMEP_Admin;
});