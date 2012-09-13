<?php
/**
 * Template Name: full width test template
 * Description: Full-with width dynamic post gallery
 */

get_header(); ?>
<section id="work-container" class="closed"></section>
<div id="main" role="main">
	<?php 
		//$query = new WP_Query( array( 'in_homepage' => 'true' ) );
		$query = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'page', 'meta_key' => 'display_in_home', 'meta_value' => 'true', 'orderby'=>'menu_order' ) );
		//echo "<pre>";
		//print_r($query);
		//echo "</pre>";
		while ( $query->have_posts() ) : $query->the_post();
			$localId = get_the_ID();
			$html = "";
			$html .= '<div class="entry" id="'.$localId.'">';
			$html .= '<a class="link" href="#" data-permalink="'.get_permalink($localId).'"><img src="/wp-content/themes/croccante/cruncy_img/trasp.png" alt=""/></a>';
			$html .= '<img src="';
			$html .= wp_get_attachment_url( get_post_thumbnail_id( $localId ) );
			$html .= '" with="220" height="160" alt="'.get_the_title().'" title="'.get_the_title().'"/>';
			$html .= '<div class="overlay">';
			$html .= '<h3>'.get_the_title().'</h3>';
			$html .= get_the_excerpt();
			$html .= '<div class="arrow"></div>';
			$html .= '</div>';
			$html .= '</div>';
			echo $html;
		endwhile;
		//while ( $query->have_posts() ) : $query->the_post();
   		//	get_template_part( 'content', 'page' );
		//endwhile;
	?>
</div>

<?php
/****
		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
*****/
?>
<?php get_footer(); ?>