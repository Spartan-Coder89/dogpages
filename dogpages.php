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

/**
 * Redirect to DogPages on first install
 * to prompt for license code
 */
if( !is_multisite() and get_option( 'is_first_time_install' ) === false ) {
  
  update_option( 'is_first_time_install', true );
  
  register_activation_hook( __FILE__, function() {
    wp_safe_redirect( admin_url('admin.php?page=dogpages') );
  });
}

/**
 * Schedule license checking event 
 * on plugin activation
 */
register_activation_hook( __FILE__, function() {

  if( !wp_next_scheduled( 'check_license_daily_event' ) ) {
    wp_schedule_event( strtotime('tomorrow 00:00'), 'every_midnight', 'check_license_daily_event' );
  }
});

/**
 * Clear scheduled license checking event 
 * on plugin activation
 */
register_deactivation_hook( __FILE__, function() {
  wp_clear_scheduled_hook( 'check_license_daily_event' );
});


define( 'DMEP_PATH', plugin_dir_path(__FILE__) );
define( 'DMEP_URL', plugins_url( '', __FILE__ ) );

spl_autoload_register( function ( $class ) {

  if( strpos( $class, 'DMEP\\' ) !== 0 ) {
    return;
  }

  $relative_class = substr( $class, strlen('DMEP\\') );
  require_once plugin_dir_path(__FILE__) .'includes/classes/' . $relative_class . '.php';
});

add_action('plugins_loaded', function() {
  new DMEP\DMEP_Admin;
  new DMEP\DMEP_Licensing;
});