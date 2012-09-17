<?php
/**
 * Template Name: Template contatti
 */

get_header(); 
$prefix = 'studio_mandelli_';
$meta_title01 = rwmb_meta( $prefix.'contact01_title'); 
$meta_title02 = rwmb_meta( $prefix.'contact02_title'); 
$meta_text01 = rwmb_meta( $prefix.'contact01'); 
$meta_text02 = rwmb_meta( $prefix.'contact02'); 
?>
  <div id="main" class="staff">
    <div id="mappaitin"  class="fleft"></div>
    <div class="contatti fleft ">
				<?php while ( have_posts() ) : the_post(); ?>
          <h2 class="uppercase harmonia"><?php the_title(); ?></h2>
          <h3 class="uppercase harmonia"><?php print $meta_title01; ?></h3>
          <p class="helvetica"><?php print $meta_text01; ?></p>
          <h3 class="uppercase harmonia"><?php print $meta_title02; ?></h3>
          <p class="helvetica"><?php print $meta_text02; ?></p>

				<?php endwhile; // end of the loop. ?>
    </div>
   </div>
<?php get_footer(); ?>