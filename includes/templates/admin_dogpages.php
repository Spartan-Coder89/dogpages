<?php 
  $dmep_dog_image = get_option( 'dmep_dog_image'. get_current_blog_id() );
  $set_image = $dmep_dog_image !== '' ? 'style="background-image: url('. $dmep_dog_image .')"' : '';
  $dmep_dog_image_license = get_option( 'dmep_dog_image_license'. get_current_blog_id() );
?>

<div id="content_wrap">

  <form id="content_container" method="POST" action="<?php echo admin_url( 'admin-post.php?action=dmep_save_dog_image' ); ?>">
    <div id="upload_image" <?php echo $set_image; ?>>
      <input type="hidden" id="dmep_dog_image" name="dmep_dog_image" value="<?php echo get_option( 'dmep_dog_image'. get_current_blog_id() ); ?>">
    </div>

    <p class="note">Click image to update</p>

    <div class="actions">
      <button type="button" class="button button-primary save_button" id="remove_image">
        <svg fill="#000000" width="800px" height="800px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <title>remove</title>
          <path d="M11.188 4.781c6.188 0 11.219 5.031 11.219 11.219s-5.031 11.188-11.219 11.188-11.188-5-11.188-11.188 5-11.219 11.188-11.219zM11.25 17.625l3.563 3.594c0.438 0.438 1.156 0.438 1.594 0 0.406-0.406 0.406-1.125 0-1.563l-3.563-3.594 3.563-3.594c0.406-0.438 0.406-1.156 0-1.563-0.438-0.438-1.156-0.438-1.594 0l-3.563 3.594-3.563-3.594c-0.438-0.438-1.156-0.438-1.594 0-0.406 0.406-0.406 1.125 0 1.563l3.563 3.594-3.563 3.594c-0.406 0.438-0.406 1.156 0 1.563 0.438 0.438 1.156 0.438 1.594 0z"></path>
        </svg>
        Remove
      </button>
      <button type="submit" class="button button-primary save_button">
        <svg fill="#000000" width="800px" height="800px" viewBox="-6.5 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <title>save</title>
          <path d="M12.188 4.469v4.656h2.438l-4.875 5.875-4.875-5.875h2.563v-4.656h4.75zM16.313 12l2.844 4.5c0.156 0.375 0.344 1.094 0.344 1.531v8.656c0 0.469-0.375 0.813-0.813 0.813h-17.844c-0.469 0-0.844-0.344-0.844-0.813v-8.656c0-0.438 0.156-1.156 0.313-1.531l2.844-4.5c0.156-0.406 0.719-0.75 1.125-0.75h1.281l1.313 1.594h-2.625l-2.531 4.625c-0.031 0-0.031 0.031-0.031 0.063 0 0.063 0 0.094-0.031 0.125h16.156v-0.125c0-0.031-0.031-0.063-0.031-0.094l-2.531-4.594h-2.625l1.313-1.594h1.25c0.438 0 0.969 0.344 1.125 0.75zM7.469 21.031h4.594c0.406 0 0.781-0.375 0.781-0.813 0-0.406-0.375-0.781-0.781-0.781h-4.594c-0.438 0-0.813 0.375-0.813 0.781 0 0.438 0.375 0.813 0.813 0.813z"></path>
        </svg>
        Save Image
      </button>
    </div>

    <input type="hidden" name="save_dog_image_nonce" value="<?php echo wp_create_nonce( 'save_dog_image_nonce' ); ?>">
  </form>

  <div id="license_display">
    <p>Your license key:</p>
    <input type="text" id="license_display_text" value="<?php echo $dmep_dog_image_license ?>" readonly>
  </div>

  <div id="license_prompt" <?php echo $dmep_dog_image_license !== false ? '' : 'class="show"' ?>>
    <div id="loading">
      <svg fill="#000000" width="80px" height="80px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 Z M12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 Z M15.2928932,8.29289322 L10,13.5857864 L8.70710678,12.2928932 C8.31658249,11.9023689 7.68341751,11.9023689 7.29289322,12.2928932 C6.90236893,12.6834175 6.90236893,13.3165825 7.29289322,13.7071068 L9.29289322,15.7071068 C9.68341751,16.0976311 10.3165825,16.0976311 10.7071068,15.7071068 L16.7071068,9.70710678 C17.0976311,9.31658249 17.0976311,8.68341751 16.7071068,8.29289322 C16.3165825,7.90236893 15.6834175,7.90236893 15.2928932,8.29289322 Z"/>
      </svg>
      <img src="<?php echo DMEP_URL .'/assets/imgs/loading.gif'; ?>" alt="">
    </div>

    <form id="activate_license" class="show" method="POST" action="<?php echo admin_url( 'admin-post.php?action=dmep_activate_license' ); ?>">
      <div class="form_control">
        <label for="dmep_dog_image_license">Enter license key:</label>
        <input type="text" name="dmep_dog_image_license" id="dmep_dog_image_license">
      </div>
      <button type="submit" class="button-primary">Activate License</button>
    </form>
  </div>

</div>