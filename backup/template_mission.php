<?php
/**
 * Template Name: Template mission
 */

get_header(); 
$prefix = 'studio_mandelli_';
$meta_title01 = rwmb_meta( $prefix.'contact01_title'); 
$meta_title02 = rwmb_meta( $prefix.'contact02_title'); 
$meta_text01 = rwmb_meta( $prefix.'contact01'); 
$meta_text02 = rwmb_meta( $prefix.'contact02'); 
$meta_text03 = rwmb_meta( $prefix.'contact03'); 
$meta_text04 = rwmb_meta( $prefix.'contact04'); 
$meta_text03 = rwmb_meta( $prefix.'contact03'); 
$meta_text04 = rwmb_meta( $prefix.'contact04'); 

$arg870=array('type'=>'image','size'=>'big-mission');
$meta_images = rwmb_meta( $prefix.'image_contact', $arg870); 
?>
  <div id="main" class="staff">
    <div id="missionphoto"  class="fleft">
    <?php   $i=0;
    foreach ( $meta_images as $metaimage ){
      // Evito di mettere più di una immagine anche se l'utente ne inserisce più di una
      if ($i==0) {
        $image = $metaimage['url'];
        print "<img src='".$image."' />";
        }
    $i++;
    } ?>
    </div>
    <div class="contatti fleft ">
				<?php while ( have_posts() ) : the_post(); ?>
          <h2 class="orange-text harmonia uppercase"><?php the_title(); ?></h2>
          <h3 class="orange-text harmonia uppercase"><?php print $meta_title01; ?></h3>
          <p><?php print $meta_text01; ?></p>
          <h3 class="orange-text harmonia uppercase"><?php print $meta_title02; ?></h3>
          <p><?php print $meta_text02; ?></p>
          <h3 class="orange-text harmonia uppercase"><?php print $meta_title03; ?></h3>
          <p><?php print $meta_text03; ?></p>
          <h3 class="orange-text harmonia uppercase"><?php print $meta_title04; ?></h3>
          <p><?php print $meta_text04; ?></p>

				<?php endwhile; // end of the loop. ?>
    </div>
   </div>
<?php get_footer(); ?>