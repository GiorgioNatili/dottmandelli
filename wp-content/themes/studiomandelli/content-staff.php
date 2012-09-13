<?php
/**
 * The template for displaying content in the single.php template
 */
// Aggiunge un controllo per le dimensioni immagine

$arg550=array('type'=>'image','size'=>'small-550');
$argfile=array('type'=>'file');
$prefix = 'studio_mandelli_';

    $meta_images = rwmb_meta( $prefix.'staff_image', $arg550); 
    $meta_files = rwmb_meta( $prefix.'staff_file', $argfile); 
?>


<!--ccontent-single.php-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="staffcontainer-foto">
  <div class="staff-foto left-col-post">

      <?php
      $i=0;
    foreach ( $meta_images as $metaimage ){
      // Evito di mettere più di una immagine anche se l'utente ne inserisce più di una
      if ($i==0) {
        $image = $metaimage['url'];
        print "<img src='".$image."' />";
        }
    $i++;
    }
    ?>
   
  </div>
   
  </div>
	<div class="single-entry-content helvetica">
    <div class="staff-title helvetica uppercase petrol-text"><h2><?php the_title(); ?></h2></div>
		<?php the_content(); ?>
    <?php
      $i=0;
    foreach ( $meta_files as $metafile ){
      // Evito di mettere più di una immagine anche se l'utente ne inserisce più di una
      if ($i==0) {
        $file = $metafile['url'];
        print "<div class='staff-file'><a href='".$file."' /><img src='".site_url()."/wp-content/themes/studiomandelli/sm_img/download.png' /></a></div>";
        }
    $i++;
    }
    ?>
  </div>


</article><!-- #post-<?php the_ID(); ?> -->