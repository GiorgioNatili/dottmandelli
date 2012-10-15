<?php
/**
 * Template Name: template ambulatorio
 * Description: Full-with width dynamic post gallery
 */
    $prefix = 'studio_mandelli_';
get_header(); ?>

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
?>
<div id="main" role="main">
	<div class="wrapper">
		<section class="t2-upper-content clearfix">
      
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
			<article class="content">
				<h2 class="harmonia"><?php the_title(); ?></h2>
				<div class="d-text helvetica" style="font-size:1.2em">
					<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

					<?php endwhile; ?>
				</div>
			</article>
		</section>
		<section class="t2-three-col-widget optional-box clearfix" style="padding-bottom:20px;">
			<h3><?php echo $three_cols_title[0]; ?></h3>
      
			<div class="d-text helvetica">
      <?php 
        $strlen=strlen($three_cols_content[0]);
        $strchunk=$strlen/3;
        $intstr=intval($strchunk)+1;
        $column=str_split($three_cols_content[0],$intstr);
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

     
    <?php 

    $activate_3col=rwmb_meta( $prefix.'activate_text');
    $optional_3col=rwmb_meta( $prefix.'page_three_cols');
    
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
		<section class="t2-boxes-ambulatorio clearfix">
		<?php 
			for($i = 0; $i < count($writeTermList); ++$i){
				$htmlBox = '<div class="box ';
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
</div>

<?php get_footer(); ?>