<?php
/**
 * The Template for displaying all single posts.
 */


get_header(); 

$prefix = 'studio_mandelli_';
    $meta_mails = rwmb_meta( $prefix.'staff_mail', $args = array(), $post_id = null ); 
    $meta_images = rwmb_meta( $prefix.'staff_image', 'type=image'); 
    $i=0;
    foreach ( $meta_images as $metaimage ){
      // Evito di mettere più di una immagine anche se l'utente ne inserisce più di una
      // 
      if ($i==0){
        $image = $metaimage['full_url'];
        //$image = $metaimage['url']; Se ho impostato una size per l'immagine con 'url' mi viene restituita di quella grandezza (default: thumbnail)
      }
    }
?>
<!--single.php-->
<div id="main" class="entry-detail" role="main">
	<section id="single-post">
		<?php while ( have_posts() ) : the_post(); 
        
        ?>

			<?php get_template_part( 'content', 'disciplina' ); ?>

		<?php endwhile; // end of the loop. ?>
	</section>
</div>

<?php get_footer(); ?>