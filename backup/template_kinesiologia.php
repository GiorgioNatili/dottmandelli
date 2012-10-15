<?php
/**
 * Template Name: Template KINESIOLOGIA
 */

get_header(); 

$prefix = 'studio_mandelli_';
$site_url=site_url();
    $meta_subtitle = rwmb_meta( $prefix.'sottotitolo'); 
?>


<?php 
$terms = get_the_terms( $post->ID, 'block_templates' );

if ( $terms && ! is_wp_error( $terms ) ){ 
						
	$writeTermList = array();
						
	foreach ( $terms as $term ) {
		$localDesc = $term->description;
		$localSlug = $term->slug;
		$t_id = $term->term_id;
		$term_meta = get_option( "taxonomy_$t_id");

		$writeTermList[] = array($term_meta["class"],$term_meta["img"],$term_meta["title"],$localDesc,$term_meta["link"]);

	}
}

$arglightbox=array('type'=>'image','size'=>'lightbox-thumb');

$page_light_box_title_left = rwmb_meta( $prefix.'page_light_box_title_left');
$page_light_box_text_left = rwmb_meta( $prefix.'page_light_box_text_left');
$page_light_box_title_big = rwmb_meta( $prefix.'light_box_title_second');
$page_light_box_text_big = rwmb_meta( $prefix.'light_box_text_second');
$page_light_box_title_last = rwmb_meta( $prefix.'light_box_title_third');

$page_light_box_title_first = rwmb_meta( $prefix.'page_light_box_title_first'); 
$page_light_box_subtitle_first = rwmb_meta( $prefix.'page_light_box_subtitle_first'); 
$page_light_box_text_first = rwmb_meta( $prefix.'page_light_box_text_first');
$page_light_box_image_first = rwmb_meta( $prefix.'page_light_box_image_first',$arglightbox);

$page_light_box_title_second = rwmb_meta( $prefix.'page_light_box_title_second'); 
$page_light_box_subtitle_second = rwmb_meta( $prefix.'page_light_box_subtitle_second');  
$page_light_box_text_second = rwmb_meta( $prefix.'page_light_box_text_second');
$page_light_box_image_second = rwmb_meta( $prefix.'page_light_box_image_second',$arglightbox); 

$page_light_box_title_third = rwmb_meta( $prefix.'page_light_box_title_third');  
$page_light_box_subtitle_third = rwmb_meta( $prefix.'page_light_box_subtitle_third');   
$page_light_box_text_third = rwmb_meta( $prefix.'page_light_box_text_third');   
$page_light_box_image_third = rwmb_meta( $prefix.'page_light_box_image_third',$arglightbox);

$page_sottotitolo = rwmb_meta( $prefix.'sottotitolo');   

?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php
		$page_content = get_the_content();
		$page_title = get_the_title();
		$page_id = get_the_ID();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'page-gallery' );
		$srcs = $image[0];
	?>
<?php endwhile; ?>

<div id="main" class="organico" role="main">
		<section class="t3-upper-content clearfix ml10">
      
      <?php $overwrite_gal=rwmb_meta( $prefix.'overwrite_gallery');  
  //gestisco l'immagine
  if ($overwrite_gal=='si') { ?>
  <aside class="t2-feat-image">
    <div class="feat-image">
  <?php 
    $featured_image=wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'page-gallery');
     $featured=$featured_image[0];
    echo "<img src='".$featured."' width='765' height='302' alt=''/>";
    ?>
    </div>
  </aside>
    <?php 
    } else { ?>  
    <aside id="t2-gallery">  
      <div class="slide-container">
<?php
 
  $images = get_post_meta( $post->ID, 'studio_mandelli_page_gallery_id', false );

  
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
      <?php } // fine gestione featured/gallery
      
      	$three_cols_title = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols_title', false );
	$three_cols_content = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols', false );
      ?>
			<article class="content ml30">
        <header class="page-entry-header">
          <h2 class="single-entry-title harmonia violet-text"><?php print the_title(); ?></h2>
        </header>
        <div class="harmonia biggerplus-text violet-text subtitle"><h3><?php print $meta_subtitle; ?></h3></div>
				<div class="d-text helvetica normal-text">
					<?php echo $page_content; ?>
				</div>
			</article>

		</section>
    
		<section class="lights clearfix ">
      <div class="mini-textbox fleft  ">
			<h3 class="uppercase mini-title harmonia bold"><?php print $page_light_box_title_left; ?></h3>
			<div class="d-text normal-text helvetica justify">
				<?php print $page_light_box_text_left; ?>
			</div>
      </div>
      
      <div class="light mini-image fleft">
      <?php 
      $i=0;
      foreach ($page_light_box_image_first as $img) { 
        if ($i==0){?>
          <a href="<?php print $img['full_url']; ?>" rel="lightbox"><img src="<?php print $img['url']; ?>" title="<?php print $page_light_box_text_first; ?>"/></a>
          <?php }
          $i++;} ?>
			<div class="d-text harmonia uppercase">
			<span class="bigger-text bold"><?php print $page_light_box_subtitle_first.'</span><span class="normal-text brown-text bold"> '.$page_light_box_subtitle_first; ?></span>
			</div>
      </div>
      
      <div class="light mini-image fleft">
      <?php 
      $i=0;
      foreach ($page_light_box_image_second as $img) { 
        if ($i==0){?>
          <a href="<?php print $img['full_url']; ?>" rel="lightbox"><img src="<?php print $img['url']; ?>" title="<?php print $page_light_box_text_second; ?>"/></a>
          <?php }
          $i++;} ?>
			<div class="d-text harmonia uppercase">
			<span class="bigger-text bold"><?php print $page_light_box_subtitle_second.'</span><span class="normal-text brown-text bold"> '.$page_light_box_subtitle_second; ?></span>
			</div>
      </div>
      
      <div class="light mini-image fleft">
      <?php 
      $i=0;
      foreach ($page_light_box_image_third as $img) { 
        if ($i==0){?>
          <a href="<?php print $img['full_url']; ?>" rel="lightbox"><img src="<?php print $img['url']; ?>" title="<?php print $page_light_box_text_third; ?>"/></a>
          <?php }
          $i++;} ?>
			<div class="d-text harmonia uppercase">
			<span class="bigger-text bold"><?php print $page_light_box_subtitle_third.'</span><span class="normal-text brown-text bold"> '.$page_light_box_subtitle_third; ?></span>
			</div>
      </div>
		</section>
    <!-- box opzionale-->
    <?php 
    
    $activate_3col=rwmb_meta( $prefix.'activate_text');
    $optional_3col=rwmb_meta( $prefix.'optional_text');
    
    if ($activate_3col=='si') { ?>
    <section class="t2-three-col-widget optional-box clearfix">
			<div class="d-text helvetica">
				<?php 
        $strlen=strlen($optional_3col);
        $strchunk=$strlen/3;
        $intstr=intval($strchunk)+1;
        $column=str_split($optional_3col,$intstr);
        ?>
        <div class="text-column">
        <?php print $column[0];?>
        </div>
        
        <div class="text-column">
        <?php print $column[1];?>
        </div>
        
        <div class="text-column last">
        <?php print $column[2];?>
        </div>
			</div>
		</section>
    <?php } ?>
    
    <div class="boxheader harmonia bold normal-text">
      <div class="halfless fleft pink-text uppercase" style="padding-left:10px;"><?php print $page_light_box_title_big; ?></div>
      <div class="halfless fleft tright uppercase brown-text"style="padding-right:10px;"><?php print $page_light_box_title_last; ?></div>
    </div>
		<section class="t2-boxes kisio clearfix">
		<div class="box first fleft box-text helvetica normal-text justify">
      
        <?php print $page_light_box_text_big; ?>
      
    </div>
    
    <?php 
    $first='first-box';
    $last='last-box';
    
    
    
			for($i = 0; $i < count($writeTermList); ++$i){
        if ($i==5 || $i==2){ $htmlBox = '<div class="box '.$first.' ';} 
        else if ($i==1 || $i==4) { $htmlBox = '<div class="box '.$last.' ';} 
        else{ $htmlBox = '<div class="box '; }
      
        $htmlBox .= $writeTermList[$i][0];
				$htmlBox .= '">';
				$htmlBox .= '<div class="box-icon">';
				$htmlBox .= '<img src="'.$writeTermList[$i][1].'" alt="" width="104" height="70"/>';
				$htmlBox .= '</div>';
				$htmlBox .= '<div class="box-container">';
				$htmlBox .= '<h4 class="harmonia">'.$writeTermList[$i][2].'</h4>';
				$htmlBox .= '<div class="d-text">';
				$htmlBox .= $writeTermList[$i][3];
				$htmlBox .= '</div>';
				$htmlBox .= '<div class="leggi"><a class="more" href="'.site_url().$writeTermList[$i][4].'">LEGGI</a></div>';
				$htmlBox .= '</div>';
				$htmlBox .= '</div>';
				echo $htmlBox;
			}
		?>
		</section>
</div>

<?php get_footer(); ?>