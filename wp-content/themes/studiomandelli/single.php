<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); 
?>
<!--single.php-->
<div id="main" class="entry-detail" role="main">
	<section id="single-post">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

		<?php endwhile; // end of the loop. ?>
	</section>
</div>

<?php get_footer(); ?>