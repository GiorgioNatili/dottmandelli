<?php
/**
 * The template for displaying content in the single.php template
 */
// Aggiunge un controllo per le dimensioni immagine

$arg550=array('type'=>'image','size'=>'small-550');

$prefix = 'studio_mandelli_';

    $meta_images = rwmb_meta( $prefix.'blog_post_gallery_id', $arg550); 
?>


<!--ccontent-single.php-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="blog-title harmonia uppercase petrol-text"><div class="lego-title fleft"><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></div></div>
    <?php if ( 'post' == get_post_type() ) : ?>
		<div class="blog-entry-meta azure-text uppercase bold">
			<?php cruncy_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
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

		<?php the_excerpt(); 
    $posttags = get_the_tags();
    ?>
    <div class="tagcontainer harmonia uppercase azure-text"><img alt='tags'src='<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/tags.png'/><?php if ($posttags) {
      foreach($posttags as $tag) {
        echo ' '.$tag->name.'&nbsp; ' ; 
      }
    } 
    ?> </div>
    <div class="sharesocial harmonia uppercase azure-text fleft"> Condividi su: 
<a href='http://www.facebook.com/share.php?u=<?php print get_permalink(); ?>'><img alt='Facebook'src='<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/fb.png'/></a>
<a href="http://twitter.com/share?url=<?php print get_permalink(); ?>&text=<?php print the_title(); ?>&count=horizontal" target="_blank" rel="nofollow"><img alt='Twitter'src='<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/tw.png'/></a>
</div>
  </div>


</article><!-- #post-<?php the_ID(); ?> -->