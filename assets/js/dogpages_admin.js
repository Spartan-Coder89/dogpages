window.addEventListener('DOMContentLoaded', () => {

  let upload_image = document.getElementById('upload_image');
  let dmep_dog_image = document.getElementById('dmep_dog_image')

  /**
   * Image upload
   */
  upload_image.addEventListener( 'click', () => {

    let frame = wp.media({
      title: 'Select Video',
      button: { text: 'Select Image' },
      library : { type : 'image' },
      multiple: false
    });

    frame.on( 'select', function() {
      let selection = frame.state().get('selection').toJSON()

      dmep_dog_image.value = selection[0].url
      upload_image.style = 'background-image: url('+ selection[0].url +')'
    })

    if( frame ) {
      frame.open()
      return
    }

    frame.open();
  })

  /**
   * Remove current selected image
   */
  document.getElementById( 'remove_image' ).addEventListener( 'click', () => {
    document.getElementById( 'dmep_dog_image' ).value = ''
    upload_image.style = ''
  })

  /**
   * Activate license
   */
  document.getElementById('activate_license').addEventListener('submit', async (e) => {

    e.preventDefault();

    document.getElementById('activate_license').classList.remove('show');

    let license_display_text = document.getElementById( 'license_display_text' )
    let license_prompt = document.getElementById( 'license_prompt' )
    let loading_gif = document.querySelector( '#loading img' )
    let success_icon = document.querySelector( '#loading svg' )
    let form_data = new FormData();
    
    form_data.append( 'action', ajax_obj.action );
    form_data.append( 'dmep_activate_license_nonce', ajax_obj.nonce );
    form_data.append( 'dmep_dog_image_license', document.getElementById('dmep_dog_image_license').value );

    let response = await fetch(ajax_obj.url, {
      method: 'POST',
      body: form_data
    })

    if( !response.ok ) {
      throw new Error( `HTTP error! status: ${ response.status }` )
    }

    loading_gif.classList.add('show')

    let data = await response.json()

    if ( data.status === 'success' ) {

      setTimeout(() => {
        loading_gif.classList.remove('show')
        success_icon.classList.add('show')
  
        setTimeout(() => {
          license_prompt.classList.remove('show')
          license_display_text.value = document.getElementById('dmep_dog_image_license').value
        }, 1000)
  
      }, 2000)
    }
  })

})