<?php get_header(); ?>


<?php 

$search_term=$_GET['s'];
global $wp_query;
$args = array_merge( $wp_query->query_vars, array( 'post_type' => array('post') ) );
query_posts( $args ); 




?>

<div id="main" >

<div class="wrapper">
  <section class="t3-upper-content clearfix">
      <header class="header">
				<h2 class="orange-text">Risultati della ricerca</h2>
			</header>
  </section>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); 
$page_id = $post->ID;
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'page-gallery' );
		$srcs = $image[0];?>

<div class="articlesearch fleft">
<div class="searchimage fleft">

      <?php
        print "<img src='".$srcs."' width='550' height='315' alt=''/>";
      ?>
   
  </div>
  <div class="searchtext fleft">
    <a class="harmonia bigger-text uppercase bold" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><h2><?php the_title(); ?></h2></a>
    <div class="normal-text helvetica"><?php the_excerpt(); ?></div>
  </div>



</div>
<?php endwhile; ?>
<?php else: ?>
<div class="tcenter big-text bold">
<img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/not_found.png" alt="Nessun risultato" /><br/>
<br/><br/>
<h1>HAI CERCATO: <?php print $search_term; ?></h1>
<h1 class="orange-text"><em>Non abbiamo trovato risultati che corrispondano alla tua richiesta</em></h1>

</div>
<?php endif; ?>


<?php next_posts_link('&laquo; Older Entries') ?>

<?php previous_posts_link('Newer Entries &raquo;') ?>
</div>
</div>

<?php get_footer(); ?>