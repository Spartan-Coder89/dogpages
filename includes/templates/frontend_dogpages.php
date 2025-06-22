<?php 
  if( get_header() !== false ) {
    get_header(); 
  }
  
  $dmep_dog_image = get_option( 'dmep_dog_image'. get_current_blog_id() );
  $set_image = $dmep_dog_image !== '' ? 'style="background-image: url('. $dmep_dog_image .')"' : '';
?>

<main id="dmep_content">
  <div class="wrap">
    <div class="img_view" <?php echo $set_image; ?>></div>
    <div class="details">
      <h2>Doggo of the Year</h2>
      <p>
        This year’s top dog? Meet Baxter, a dog who saved his family from a fire, volunteers at a children’s hospital, 
        and still finds time to chase squirrels like it’s his full-time job. Equal parts hero and goofball, Baxter has earned the title 
        of Dog of the Year by being paws-itively amazing—and yes, he accepted his award with a tail wag and a face full of peanut butter.
      </p>
    </div>
  </div>
</main>

<?php 
  if( get_footer() !== false ) {
    get_footer();
  }
?>