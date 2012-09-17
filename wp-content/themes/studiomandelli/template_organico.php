<?php
/**
 * Template Name: Template ORGANICO
 * Description: Full-with width dynamic post gallery
 */

get_header(); 

$prefix = 'studio_mandelli_';
    $page_sottotitolo = rwmb_meta( $prefix.'sottotitolo');   
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
$page_light_box_title_left = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_title_left', false );
$page_light_box_text_left = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_text_left', false );

$page_light_box_title_first = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_title_first', false );
$page_light_box_subtitle_first = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_subtitle_first', false );
$page_light_box_text_first = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_text_first', false );
$page_light_box_image_first = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_image_first', false );

$page_light_box_title_second = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_title_second', false );
$page_light_box_subtitle_second = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_subtitle_second', false );
$page_light_box_text_second = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_text_second', false );
$page_light_box_image_second = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_image_second', false );

$page_light_box_title_third = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_title_third', false );
$page_light_box_subtitle_third = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_subtitle_third', false );
$page_light_box_text_third = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_text_third', false );
$page_light_box_image_third = get_post_meta( $post->ID, 'studio_mandelli_page_light_box_image_third', false );
?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php
		$page_content = get_the_content();
		$page_title = get_the_title();
		$page_id = get_the_ID();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'single-post-thumbnail' );
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
	    $src = wp_get_attachment_image_src( $att, 'full' );
	    $srcs = $src[0];
	    //$srcw = $src[1];
	    //$srch = $src[2];
	    //$ratio = 680/$src[1];
	    //$nh=$src[2]*$ratio;
	    // Show image
	    echo "<img src='".$srcs."' width='765' height='302' alt=''/>";
	}
  
   $featured_image=wp_get_attachment_image_src($post->ID, 'full');
	
?>
				</div>
			</aside>
<?php } // fine gestione featured/gallery
$three_cols_title = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols_title', false );
	$three_cols_content = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols', false );

?>
			<article class="content ml30">
        <header class="page-entry-header">
          <h2 class="single-entry-title harmonia blu-text"><?php print the_title(); ?></h2>
        </header>
        <div class="harmonia biggerplus-text blu-text subtitle"><h3><?php print $meta_subtitle; ?></h3></div>
				<div class="d-text helvetica normal-text">
					<?php echo $page_content; ?>
				</div>
			</article>

		</section>
    
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
		
		<section class="t2-boxes large clearfix">
		<?php 
    $first='first-box';
    $last='last-box';
    
			for($i = 0; $i < count($writeTermList); ++$i){
        if ($i==0 || $i==3){ $htmlBox = '<div class="box '.$first.' ';} 
        else if ($i==2 || $i==5) { $htmlBox = '<div class="box '.$last.' ';} 
        else{ $htmlBox = '<div class="box '; }
      
        $htmlBox .= $writeTermList[$i][0];
				$htmlBox .= '">';
				$htmlBox .= '<div class="box-icon">';
				$htmlBox .= '<img src="'.$writeTermList[$i][1].'" alt="" width="104" height="70"/>';
				$htmlBox .= '</div>';
				$htmlBox .= '<div class="box-container">';
				$htmlBox .= '<h4>'.$writeTermList[$i][2].'</h4>';
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