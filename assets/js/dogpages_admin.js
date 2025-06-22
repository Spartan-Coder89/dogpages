window.addEventListener('DOMContentLoaded', () => {

  let upload_image = document.getElementById('upload_image');
  let dmep_dog_image = document.getElementById('dmep_dog_image')

  upload_image.addEventListener('click', () => {

    let frame = wp.media({
      title: 'Select Video',
      button: { text: 'Select Image' },
      library : { type : 'image' },
      multiple: false
    });

    frame.on( 'select', function() {
      let selection = frame.state().get('selection').toJSON()
      console.log(selection)

      dmep_dog_image.value = selection[0].url
      upload_image.style = 'background-image: url('+ selection[0].url +')'
    })

    if ( frame ) {
      frame.open()
      return
    }

    frame.open();
  })

  document.getElementById('remove_image').addEventListener('click', () => {
    document.getElementById('dmep_dog_image').value = ''
    upload_image.style = ''
  })

})