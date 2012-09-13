<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header(); ?>
<!--category.php-->
<div id="main" class="category-archive" role="main">
	<section id="archive">
  		<header class="single-entry-header">
		<h2 class="single-entry-title harmonia"><?php the_title(); ?></h2>
		<?php if ( have_posts() ) : ?>


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
	</header>

		<?php twentyeleven_content_nav( 'nav-above' ); ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				/* Include the Post-Format-specific template for the content.
				 * If you want to overload this in a child theme then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'category-content', get_post_format() );
			?>

		<?php endwhile; ?>

		<?php twentyeleven_content_nav( 'nav-below' ); ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h2>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>
	</section>
</div>

<?php /*get_sidebar();*/ ?>
<?php get_footer(); ?>
