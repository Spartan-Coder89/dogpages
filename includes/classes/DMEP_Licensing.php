<?php
namespace DMEP;

/**
 * Class to handle license activation, 
 * saving and checking 
 */
class DMEP_Licensing
{
  function __construct() {
    add_action( 'wp_ajax_dmep_activate_license', array( $this, 'activate_license' ) );
    add_filter( 'cron_schedules', array( $this, 'schedule_cron_job' ) );
    add_action( 'check_license_daily_event', array( $this, 'check_license_key_daily' ) );
  }

  /**
   * Check and save license key provided
   */
  function activate_license() {
    
    if( !isset( $_POST['dmep_activate_license_nonce'] ) ) {
      return;
    }

    if( !wp_verify_nonce($_POST['dmep_activate_license_nonce'], 'dmep_activate_license_nonce')) {
      return;
    }

    if( !isset( $_POST['dmep_dog_image_license'] ) ) {
      wp_safe_redirect( admin_url('admin.php?page=dogpages') );
      exit;
    }

    $dmep_dog_image_license = htmlspecialchars( strip_tags( $_POST['dmep_dog_image_license'] ) );
    $update_option = update_option( 'dmep_dog_image_license'. get_current_blog_id(), $dmep_dog_image_license );

    echo json_encode([
      'status' => 'success'
    ]);

    exit;
  }

  /**
   * Set 12 AM cron WordPress cron job 
   */
  function schedule_cron_job( $schedules ) {

    $schedules['every_midnight'] = array(
      'interval' => 86400, // 24 hours in seconds
      'display'  => __('Every Day at Midnight')
    );

    return $schedules;
  }
  
  /**
   * API call to check license
   */
  function check_license_key_daily() {
    //  Replace with API call

    $log_file = DMEP_PATH . '/license-check-log.txt';
    $message = '[' . date( 'M d, Y H:i:s' ) . "] Checked license key\n";
    file_put_contents( $log_file, $message, FILE_APPEND );
  }
}