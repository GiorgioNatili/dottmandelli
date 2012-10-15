<?php
/**
 * Template Name: SM Template 1 (Home)
 * Description: Full-with width dynamic post gallery
 */

get_header(); ?>

<div id="main" class="theme-1" role="main">
	<div class="wrapper">
<?php 
$terms = get_the_terms( $post->ID, 'block_home' );
												
if ( $terms && ! is_wp_error( $terms ) ){ 
						
	$writeTermList = array();
						
	foreach ( $terms as $term ) {
		$localDesc = $term->description;
		$localSlug = $term->slug;
		$t_id = $term->term_id;
		$term_meta = get_option( "taxonomy_$t_id");

		$writeTermList[$localSlug] = array($term_meta["title"],$localDesc,$term_meta["link"]);

	}
}
?>
		<article class="block-1 home-block">
			<h3 class="harmonia"><?php echo $writeTermList["blocco-verde"][0]; ?></h3>
			<div class="d-text">
				<p class="helvetica"><?php echo $writeTermList["blocco-verde"][1]; ?></p>
			</div>
			<a href='<?php echo $writeTermList["blocco-verde"][2]; ?>' class="more">LEGGI</a>
		</article>
		<article class="block-2 home-block">
			<h3 class="harmonia"><?php echo $writeTermList["blocco-lilla"][0]; ?></h3>
			<div class="d-text">
				<p class="helvetica"><?php echo $writeTermList["blocco-lilla"][1]; ?></p>
			</div>
			<a href='<?php echo $writeTermList["blocco-lilla"][2]; ?>' class="more">LEGGI</a>
		</article>
		<article class="block-3 home-block">
			<h3 class="harmonia"><?php echo $writeTermList["blocco-viola"][0]; ?></h3>
			<div class="d-text">
				<p class="helvetica"><?php echo $writeTermList["blocco-viola"][1]; ?></p>
			</div>
			<a href="<?php echo $writeTermList["blocco-viola"][2]; ?>" class="more">LEGGI</a>
		</article>
		<article class="block-4 home-block">
			<h3 class="harmonia"><?php echo $writeTermList["blocco-giallo"][0]; ?></h3>
			<div class="d-text">
				<p class="helvetica"><?php echo $writeTermList["blocco-giallo"][1]; ?></p>
			</div>
			<a href='<?php echo $writeTermList["blocco-giallo"][2]; ?>' class="more">LEGGI</a>
		</article>
		<article class="block-5 home-block">
			<h3 class="harmonia"><?php echo $writeTermList["blocco-nero"][0]; ?></h3>
			<div class="d-text">
				<p class="helvetica"><?php echo $writeTermList["blocco-nero"][1]; ?></p>
			</div>
			<a href='<?php echo $writeTermList["blocco-nero"][2]; ?>' class="more">LEGGI</a>
		</article>
		<article class="block-6 home-block">
			<h3 class="harmonia"><?php echo $writeTermList["blocco-rosso"][0]; ?></h3>
			<div class="d-text">
				<p class="helvetica"><?php echo $writeTermList["blocco-rosso"][1]; ?></p>
			</div>
			<a href='<?php echo $writeTermList["blocco-rosso"][2]; ?>' class="more">LEGGI</a>
		</article>
		<article class="block-7 home-block">
			<h3 class="harmonia"><?php echo $writeTermList["blocco-turchese"][0]; ?></h3>
			<div class="d-text">
				<p class="helvetica"><?php echo $writeTermList["blocco-turchese"][1]; ?></p>
			</div>
			<a href='<?php echo $writeTermList["blocco-turchese"][2]; ?>' class="more">LEGGI</a>
		</article>
		<article class="block-8 home-block">
			<h3 class="harmonia"><?php echo $writeTermList["blocco-blu"][0]; ?></h3>
			<div class="d-text">
				<p class="helvetica"><?php echo $writeTermList["blocco-blu"][1]; ?></p>
			</div>
			<a href='<?php echo $writeTermList["blocco-blu"][2]; ?>' class="more">LEGGI</a>
		</article>
	</div>
</div>

<?php get_footer(); ?>