<?php
/**
 * Template Name: SM Template 3 (Figli Struttura)
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

<div id="main" role="main">
	<div class="wrapper">
		<section class="t3-upper-content clearfix">
			<header class="header">
				<h2><?php echo $page_title; ?></h2>
				<a class="back yellow-gradient ie9fix roundeight" href="/?page_id=8"><span>Torna a <strong>Ambulatorio</strong></span></a>
			</header>
			<article class="content">
				<div class="d-text">
					<?php echo $page_content; ?>
				</div>
			</article>
			<aside id="t3-feat-image">
				<div>
					<?php
						echo "<img src='".$srcs."' width='765' height='302' alt=''/>";
					?>
				</div>
			</aside>
		</section>
		<section class="t3-lightbox clearfix">
			<article class="content">
				<h4><?php echo $page_light_box_title_left[0]; ?></h4>
				<p><?php echo $page_light_box_text_left[0]; ?></p>
			</article>
			<div class="gallery">
				<!--<a href="#" class="g-item">-->
					<figure class="g-item">
						<?php
							$fsrc = wp_get_attachment_image_src( $page_light_box_image_first[0], 'full' );
	    					$fsrcs = $fsrc[0];
	    					echo "<img src='{$fsrcs}' width='270' height='160' alt=''/>";
						?>
						<figcaption>
							<p><em><?php echo $page_light_box_title_first[0]; ?></em><strong><?php echo $page_light_box_subtitle_first[0]; ?></strong></p>
							<p class="hidden"><?php echo $page_light_box_text_first[0]; ?></p>
						</figcaption>
					</figure>
				<!--</a>-->
				<!--<a href="#" class="g-item">-->
					<figure class="g-item">
						<?php 
							$ssrc = wp_get_attachment_image_src( $page_light_box_image_second[0], 'full' );
	    					$ssrcs = $ssrc[0];
	    					echo "<img src='{$ssrcs}' width='270' height='160' alt=''/>";
						?>
						<figcaption>
							<p><em><?php echo $page_light_box_title_second[0]; ?></em><strong><?php echo $page_light_box_subtitle_second[0]; ?></strong></p>
							<p class="hidden"><?php echo $page_light_box_text_second[0]; ?></p>
						</figcaption>
					</figure>
				<!--</a>-->
				<!--<a href="#" class="g-item">-->
					<figure class="g-item">
						<?php 
							$tsrc = wp_get_attachment_image_src( $page_light_box_image_third[0], 'full' );
	    					$tsrcs = $tsrc[0];
	    					echo "<img src='{$tsrcs}' width='270' height='160' alt=''/>";
						?>
						<figcaption>
							<p><em><?php echo $page_light_box_title_third[0]; ?></em><strong><?php echo $page_light_box_subtitle_third[0]; ?></strong></p>
							<p class="hidden"><?php echo $page_light_box_text_third[0]; ?></p>
						</figcaption>
					</figure>
				<!--</a>-->
			</div>
		</section>
    
    
		<section class="t2-boxes large clearfix">
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