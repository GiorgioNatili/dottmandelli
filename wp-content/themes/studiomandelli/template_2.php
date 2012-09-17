<?php
/**
 * Template Name: SM Template 2 (Ambulatorio)
 * Description: Full-with width dynamic post gallery
 */

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
			<aside id="t2-gallery">
				<div class="slide-container">
<?php
 
  
  $images = get_post_meta( $post->ID, 'studio_mandelli_page_gallery_id', false );
	$three_cols_title = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols_title', false );
	$three_cols_content = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols', false );
  
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
			<article class="content">
				<h2 class="harmonia"><?php the_title(); ?></h2>
				<div class="d-text helvetica">
					<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

					<?php endwhile; ?>
				</div>
			</article>
		</section>
		<section class="t2-three-col-widget clearfix">
			<h3><?php echo $three_cols_title[0]; ?></h3>
			<div class="d-text">
				<?php echo $three_cols_content[0]; ?>
			</div>
		</section>
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
				$htmlBox .= '<a class="more" href="'.$writeTermList[$i][4].'">LEGGI</a>';
				$htmlBox .= '</div>';
				$htmlBox .= '</div>';
				echo $htmlBox;
			}
		?>
		</section>
		
	</div>
</div>

<?php get_footer(); ?>