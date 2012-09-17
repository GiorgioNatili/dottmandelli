<?php
/**
 * The template for displaying content in the single.php template
 */
// Aggiunge un controllo per le dimensioni immagine

$argbig=array('type'=>'plupload_image','size'=>'big-stripe');
$argside=array('type'=>'plupload_image','size'=>'medium-side');

$prefix = 'studio_mandelli_';
    $meta_title =rwmb_meta($prefix.'second_title');
    $meta_side_title =rwmb_meta($prefix.'side_title');
    $meta_side_text =rwmb_meta($prefix.'side_text');
    $meta_images = rwmb_meta( $prefix.'disciplina_big', $argbig); 
    $meta_img01 = rwmb_meta( $prefix.'disciplina_image01', $argside); 
    $meta_sub01 =rwmb_meta($prefix.'disciplina_subt01');
    $meta_img02 = rwmb_meta( $prefix.'disciplina_image02', $argside); 
    $meta_sub02 =rwmb_meta($prefix.'disciplina_subt02');
?>


<!--ccontent-single.php-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="blog-entry-header">
		<h2 class="single-entry-title harmonia pink-text"><?php the_title(); ?></h2>
    <a class="single-entry-back-link" href="<?php print site_url(); ?>/disciplina"> <img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/discipline.png" /></a>
    </header>
  <div class="disciplina-foto">

      <?php
    foreach ( $meta_images as $metaimage ){
        $image = $metaimage['url'];
        print "<img src='".$image."' />";
        }

    ?>
  
  </div>
	<div class="disciplina-entry-content helvetica normal-text fleft">
    <div class="staff-title helvetica uppercase pink-text"><h2 class="pink-text"><?php print $meta_title; ?></h2></div>
		<?php the_content(); ?>
  </div>
  <aside class="fleft sidecol">
    <div class="sidebox">
      <h3 class="helvetica uppercase"><?php print $meta_side_title; ?></h3>
      <p class="helvetica">
        <?php print $meta_side_text; ?>
      </p>
    </div>
    <div class="sidebox">
    <?php
    foreach ( $meta_img01 as $img01 ){
        $image01 = $img01['url'];
        print "<img src='".$image01."' />";
        }
    ?>
    <h3 class="helvetica uppercase"><?php print $meta_sub01; ?></h3>
    </div>
    <div class="sidebox">
    <?php
    foreach ( $meta_img02 as $img02 ){
        $image02 = $img02['url'];
        print "<img src='".$image02."' />";
        }
    ?>
    <h3 class="helvetica uppercase"><?php print $meta_sub02; ?></h3>
    </div>
  </aside>


</article><!-- #post-<?php the_ID(); ?> -->