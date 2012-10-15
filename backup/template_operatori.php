<?php
/**
 * Template Name: Template staff: operatori
 */

get_header(); 
$prefix = 'studio_mandelli_';


query_posts( 'post_type=staff&meta_key=studio_mandelli_staff_categoria&meta_value=category01'); 
?>
  <div id="main" class="staff">
  <header class="staff-entry-header">
		<h2 class="single-entry-title harmonia"><?php the_title(); ?></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="single-entry-meta">
			<?php cruncy_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	<a class="single-entry-back-link" href="<?php print site_url(); ?>/organico"> <img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/backorganico.png" /></a>
	</header>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'staff' ); ?>


				<?php endwhile; // end of the loop. ?>
   </div>
<?php get_footer(); ?>