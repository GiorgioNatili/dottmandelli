<?php
/**
 * The template for displaying content in the single.php template
 */
// Aggiunge un controllo per le dimensioni immagine

$arg550=array('type'=>'image','size'=>'small-550');
$arg145=array('type'=>'image','size'=>'small-145');
$prefix = 'studio_mandelli_';
    $meta_images = rwmb_meta( $prefix.'blog_post_gallery_id', $arg550); 
    $meta_thumb = rwmb_meta( $prefix.'blog_post_gallery_id', $arg145); 
?>


<!--ccontent-single.php-->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="single-entry-header">
		<h2 class="single-entry-title harmonia"><?php the_title(); ?></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="single-entry-meta">
			<?php cruncy_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
    	<?php
		$cat = get_the_category();
		$catName = $cat[0]->name;
		$link = get_category_link($cat[0]->term_id);
	?>
	<a class="single-entry-back-link" href="<?php echo $link; ?>"> <img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/backtoblog.png" /></a>
	</header><!-- .entry-header -->
  <div class="gallerycontainer">
  <div id="post-gallery" class="left-col-post">
    <div class="slide-container">
      <?php
    foreach ( $meta_images as $metaimage ){
      // Evito di mettere più di una immagine anche se l'utente ne inserisce più di una
      // 
        $image = $metaimage['url'];
        print "<img src='".$image."' />";
    }
    ?>
    </div>
   
  </div>
   <nav class="thumb-nav">
      <?php
      $j=0;
    foreach ( $meta_thumb as $metathumb ){
      // Evito di mettere più di una immagine anche se l'utente ne inserisce più di una
      // 
        if ($j==0){$active='attivo';}else{$active='';}
        $thumb = $metathumb['url'];
        print "<img class='".$j."th goto ".$active."' src='".$thumb."' />";
        $j++;
    }
    ?>
    </nav>
  </div>
	<div class="single-entry-content helvetica">
		<?php the_content(); 
    $posttags = get_the_tags();
    ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
    <div class="tagcontainer harmonia uppercase azure-text"><img alt='tags'src='<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/tags.png'/><?php if ($posttags) {
  foreach($posttags as $tag) {
    echo '<a href="'. get_tag_link($tag->id) .'">' . $tag->name . '</a> '; 
  }
} 
?> </div>
<div class="sharesocial harmonia uppercase azure-text fleft"> Condividi su: 
<a href='http://www.facebook.com/share.php?u=<?php print get_permalink(); ?>' target="_blank"><img alt='Facebook'src='<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/fb.png'/></a>
<a href="http://twitter.com/share?url=<?php print get_permalink(); ?>&text=<?php print the_title(); ?>&count=horizontal" target="_blank" rel="nofollow"><img alt='Twitter'src='<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/tw.png'/></a>
</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->

