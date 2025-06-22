<?php

abstract class DMEP_Frontend_Page
{
  function create_page( $page_title, $page_slug, $page_author = 1, $post_content = '' ) {

    wp_insert_post([
      'post_title'    => $page_title,
      'post_content'  => $post_content,
      'post_status'   => 'publish',
      'post_author'   => $page_author,
      'post_type'     => 'page',
      'post_name'     => $page_slug
    ]);
  } 


  function set_page_template( $page_slug, $template_path ) {
    
    add_filter('template_include', function( $template ) use ( $page_slug, $template_path ) {
      $template = is_page( $page_slug ) ? $template_path : $template;
      return $template;
    });
  }


  function enqueue_style( $page_slug, $handler_name, $stylesheet_path ) {

    if( $page_slug !== '' ) {
      
      add_action( 'wp_enqueue_scripts', function() use ($handler_name, $stylesheet_path) {
        wp_enqueue_style( $handler_name, $stylesheet_path );
      });
    }
  }

  
  function enqueue_script( $page_slug, $handler_name, $script_path ) {

    if( $page_slug !== '' ) {
      
      add_action( 'wp_enqueue_scripts', function() use ( $handler_name, $script_path ) {
        wp_enqueue_script( $handler_name, $script_path, [], '', true );
      });
    }
  }
}