<?php
/**
 * Template Name: Template PRENOTAZIONE
 * Description: Full-with width dynamic post gallery
 */

get_header(); 

$prefix = 'studio_mandelli_';

    $meta_subtitle = rwmb_meta( $prefix.'sottotitolo'); 
?>


<?php 
$meta_lun_open = rwmb_meta( $prefix.'lun_open'); 
$meta_lun_close = rwmb_meta( $prefix.'lun_close'); 
$meta_mar_open = rwmb_meta( $prefix.'mar_open'); 
$meta_mar_close = rwmb_meta( $prefix.'mar_close'); 
$meta_mer_open = rwmb_meta( $prefix.'mer_open'); 
$meta_mer_close = rwmb_meta( $prefix.'mer_close'); 
$meta_gio_open = rwmb_meta( $prefix.'gio_open'); 
$meta_gio_close = rwmb_meta( $prefix.'gio_close'); 
$meta_ven_open = rwmb_meta( $prefix.'ven_open'); 
$meta_ven_close = rwmb_meta( $prefix.'ven_close'); 
$argimage=array('type'=>'image','size'=>'page-gallery');
$meta_img = rwmb_meta( $prefix.'blog_post_gallery_id',$argimage); 
?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php
		$page_content = get_the_content();
		$page_title = get_the_title();
		$page_id = get_the_ID();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'blog_post_gallery_id' );
		$srcs = $image[0];
	?>
<?php endwhile; ?>

<div id="main" class="organico" role="main">
		<section class="t3-upper-content clearfix ml10">
      
      <aside id="t2-gallery">
				<div class="slide-container">
<?php
 
  
  $images = get_post_meta( $post->ID, 'studio_mandelli_page_gallery_id', false );
	$three_cols_title = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols_title', false );
	$three_cols_content = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols', false );
  
	foreach ( $images as $att )
	{
	    // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
	    $src = wp_get_attachment_image_src( $att, 'page-gallery' );
	    $srcs = $src[0];
	    //$srcw = $src[1];
	    //$srch = $src[2];
	    //$ratio = 680/$src[1];
	    //$nh=$src[2]*$ratio;
	    // Show image
	    echo "<img src='".$srcs."' width='765' height='302' alt=''/>";
	}
  
   $featured_image=wp_get_attachment_image_src($post->ID, 'page-gallery');
	
?>
				</div>
			</aside>
			<article class="content ml30">
        <header class="page-entry-header">
          <h2 class="single-entry-title red-text harmonia"><?php print the_title(); ?></h2>
        </header>
        <div class="harmonia biggerplus-text red-text subtitle"><h3><?php print $meta_subtitle; ?></h3></div>
				<div class="d-text helvetica normal-text">
					<?php echo $page_content; ?>
				</div>
			</article>
    
		</section>
    <section class="t2-prenotazione clearfix">
    <div class="fleft mini-title">
			<h4 class="harmonia red-text uppercase">ORARI DI APERTURA</h4>
    </div>
			<div class="fleft mini-title uppercase big-margin tright brown-text">
				<h4 class="harmonia bold"><?php print $meta_subtitle; ?></h4>
			</div>
		</section>
		
		<section class="t2-boxes large clearfix">
		<div class="full-day-box fleft">
      <div class="day-box"><img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/lun.jpg" /></div>
      <div class="hour-box">
        <div class="day_open harmonia"><?php print $meta_lun_open; ?></div>
        <div class="day_close harmonia"><?php print $meta_lun_close; ?></div>
      </div>
    </div>
    
    <div class="full-day-box fleft">
      <div class="day-box"><img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/mar.jpg" /></div>
      <div class="hour-box">
        <div class="day_open harmonia"><?php print $meta_mar_open; ?></div>
        <div class="day_close harmonia"><?php print $meta_mar_close; ?></div>
      </div>
    </div>
    
    <div class="full-day-box fleft">
      <div class="day-box"><img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/mer.jpg" /></div>
      <div class="hour-box">
        <div class="day_open harmonia"><?php print $meta_mer_open; ?></div>
        <div class="day_close harmonia"><?php print $meta_mer_close; ?></div>
      </div>
    </div>
    
    <div class="full-day-box fleft">
      <div class="day-box"><img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/gio.jpg" /></div>
      <div class="hour-box">
        <div class="day_open harmonia"><?php print $meta_gio_open; ?></div>
        <div class="day_close harmonia"><?php print $meta_gio_close; ?></div>
      </div>
    </div>
    
    <div class="full-day-box fleft last">
      <div class="day-box"><img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/ven.jpg" /></div>
      <div class="hour-box">
        <div class="day_open harmonia"><?php print $meta_ven_open; ?></div>
        <div class="day_close harmonia"><?php print $meta_ven_close; ?></div>
      </div>
    </div>
		</section>
</div>

<?php get_footer(); ?>