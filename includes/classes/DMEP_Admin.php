<?php

class DMEP_Admin extends DMEP_Frontend_Page
{
  function __construct() {

    add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
    add_action( 'admin_post_dmep_save_dog_image', array( $this, 'save_dog_image' ) );

    //  Inherited from DMEP_Frontend_Page class
    $this->set_page_template( 'dog', DMEP_PATH .'/includes/templates/frontend_dogpages.php' );
    $this->enqueue_style( 'dog', 'dog_page_style', DMEP_URL .'/assets/css/dogpages_frontend.css' );
  }


  function register_admin_menu() {

    add_menu_page( 
      __( 'Dog Pages', 'textdomain' ), 
      __( 'DogPages', 'textdomain' ), 
      'Super Admin', 
      'dogpages', 
      function() {
        require_once DMEP_PATH .'/includes/templates/admin_dogpages.php';
      }
    );
  }


  function enqueue_scripts_styles() {

    global $current_screen;

    if( $current_screen->base == 'toplevel_page_dogpages' and $current_screen->id == 'toplevel_page_dogpages' ) {
      wp_enqueue_style( 'dogpages_admin_style', DMEP_URL .'/assets/css/dogpages_admin.css' );
      wp_enqueue_media();
      wp_enqueue_script( 'dogpages_admin_script', DMEP_URL .'/assets/js/dogpages_admin.js', [], '', true );
    }
  }


  function save_dog_image() {

    if( !isset( $_POST['save_dog_image_nonce'] ) ) {
      return;
    }

    if( !wp_verify_nonce($_POST['save_dog_image_nonce'], 'save_dog_image_nonce')) {
      return;
    }

    if( !isset( $_POST['dmep_dog_image'] ) ) {
      wp_safe_redirect( admin_url('admin.php?page=dogpages') );
      exit;
    }

    $dmep_dog_image = htmlspecialchars( strip_tags( $_POST['dmep_dog_image'] ) );
    update_option( 'dmep_dog_image'. get_current_blog_id(), $dmep_dog_image );

    if( is_null( get_page_by_path( 'dog' ) ) and $_POST['dmep_dog_image'] !== '' ) {
      //  Inherited from DMEP_Frontend_Page class
      $this->create_page( 'Dog', 'dog' );
    }

    wp_safe_redirect( admin_url('admin.php?page=dogpages') );
    exit;
  }
}