<?php
/**
 * Template Name: SM Template 3 (Figli Struttura)
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

$arglightbox=array('type'=>'image','size'=>'lightbox-thumb');

$page_light_box_title_left = rwmb_meta( $prefix.'page_light_box_title_left');
$page_light_box_text_left = rwmb_meta( $prefix.'page_light_box_text_left');
$page_light_box_title_big = rwmb_meta( $prefix.'light_box_title_second');
$page_light_box_text_big = rwmb_meta( $prefix.'light_box_text_second');
$page_light_box_title_last = rwmb_meta( $prefix.'light_box_title_third');

$page_light_box_title_first = rwmb_meta( $prefix.'page_light_box_title_first'); 
$page_light_box_subtitle_first = rwmb_meta( $prefix.'page_light_box_subtitle_first'); 
$page_light_box_text_first = rwmb_meta( $prefix.'page_light_box_text_first');
$page_light_box_image_first = rwmb_meta( $prefix.'page_light_box_image_first',$arglightbox);

$page_light_box_title_second = rwmb_meta( $prefix.'page_light_box_title_second'); 
$page_light_box_subtitle_second = rwmb_meta( $prefix.'page_light_box_subtitle_second');  
$page_light_box_text_second = rwmb_meta( $prefix.'page_light_box_text_second');
$page_light_box_image_second = rwmb_meta( $prefix.'page_light_box_image_second',$arglightbox); 

$page_light_box_title_third = rwmb_meta( $prefix.'page_light_box_title_third');  
$page_light_box_subtitle_third = rwmb_meta( $prefix.'page_light_box_subtitle_third');   
$page_light_box_text_third = rwmb_meta( $prefix.'page_light_box_text_third');   
$page_light_box_image_third = rwmb_meta( $prefix.'page_light_box_image_third',$arglightbox);

$page_sottotitolo = rwmb_meta( $prefix.'sottotitolo');   

	$three_cols_title = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols_title', false );
	$three_cols_content = get_post_meta( $post->ID, 'studio_mandelli_page_three_cols', false );
?>
<?php while ( have_posts() ) : the_post(); ?>
	<?php
		$page_content = get_the_content();
		$page_title = get_the_title();
		$page_id = get_the_ID();
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'page-gallery' );
		$srcs = $image[0];
	?>
<?php endwhile; ?>

<div id="main" class="strutturamain" role="main">
	<div class="wrapper">
		<section class="t3-upper-content clearfix">
			<header class="header">
				<h2 class="orange-text"><?php echo $page_title; ?></h2>
				<a class="single-entry-back-link" href="<?php print site_url(); ?>/ambulatorio"> <img src="<?php print site_url(); ?>/wp-content/themes/studiomandelli/sm_img/back_ambulatorio.png" /></a>
			</header>
			<article class="content">
				<div class="d-text helvetica normal-text">
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
		<section class="lights clearfix ">
      <div class="mini-textbox fleft  ">
			<h3 class="uppercase mini-title harmonia bold"><?php print $page_light_box_title_left; ?></h3>
			<div class="d-text normal-text helvetica justify">
				<?php print $page_light_box_text_left; ?>
			</div>
      </div>
      
      <div class="light mini-image fleft">
      <?php 
      $i=0;
      foreach ($page_light_box_image_first as $img) { 
        if ($i==0){?>
          <a href="<?php print $img['full_url']; ?>" rel="lightbox"><img src="<?php print $img['url']; ?>" title="<?php print $page_light_box_text_first; ?>" width="270" height="160"/></a>
          <?php }
          $i++;} ?>
			<div class="d-text harmonia uppercase">
			<span class="bigger-text bold"><?php print $page_light_box_subtitle_first.'</span><span class="normal-text brown-text bold"> '.$page_light_box_subtitle_first; ?></span>
			</div>
      </div>
      
      <div class="light mini-image fleft">
      <?php 
      $i=0;
      foreach ($page_light_box_image_second as $img) { 
        if ($i==0){?>
          <a href="<?php print $img['full_url']; ?>" rel="lightbox"><img src="<?php print $img['url']; ?>" title="<?php print $page_light_box_text_second; ?>" width="270" height="160"/></a>
          <?php }
          $i++;} ?>
			<div class="d-text harmonia uppercase">
			<span class="bigger-text bold"><?php print $page_light_box_subtitle_second.'</span><span class="normal-text brown-text bold"> '.$page_light_box_subtitle_second; ?></span>
			</div>
      </div>
      
      <div class="light mini-image fleft">
      <?php 
      $i=0;
      foreach ($page_light_box_image_third as $img) { 
        if ($i==0){?>
          <a href="<?php print $img['full_url']; ?>" rel="lightbox"><img src="<?php print $img['url']; ?>" title="<?php print $page_light_box_text_third; ?>" width="270" height="160"/></a>
          <?php }
          $i++;} ?>
			<div class="d-text harmonia uppercase">
			<span class="bigger-text bold"><?php print $page_light_box_subtitle_third.'</span><span class="normal-text brown-text bold"> '.$page_light_box_subtitle_third; ?></span>
			</div>
      </div>
		</section>
    <?php 
    $titolo=trim($three_cols_title[0]);
    $contenuto=trim($three_cols_content[0]);
    if ($contenuto!='') { ?>
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
    <?php } ?>
    
		<section class="t2-boxes-sicurezza clearfix">
		<?php 
			for($i = 0; $i < count($writeTermList); ++$i){
      
        if ($i==0){$first='ml0';}
				$htmlBox = '<div class="box '.$first.' ';
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