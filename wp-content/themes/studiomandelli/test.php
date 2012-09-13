<?php
/**
 * Template Name: second test template
 * Description: Full-with width dynamic post gallery
 */

?>
<?php if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<article class="project-item">
		<aside>
			<div id="project_slideshow">
				<div id="slides">
					<div id="spaziatore"></div>
					<ul>
					<?php
					$images = get_post_meta( $post->ID, 'cruncy_custom_meta_screenshot', false );
					foreach ( $images as $att )
					{
					    // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
					    $src = wp_get_attachment_image_src( $att, 'full' );
					    $srcs = $src[0];
					    $srcw = $src[1];
					    $srch = $src[2];
					    $ratio = 680/$src[1];
					    $nh=$src[2]*$ratio;
					    // Show image
					    echo "<li><img src='{$srcs}' width='680' height='{$nh}' alt=''/></li>";
					}


					?>
					</ul>
				</div>
				<span class="shadow"></span>
			</div>
		</aside>
		<section>
			<header>
				<nav class="project-inner-nav">
					<a class="prev" href="#">Previous</a>
					<a class="next" href="#">Next</a>
					<a class="close" href="#">Close</a>
				</nav>
				<h2><?php the_title(); ?></h2>
			</header>
			<div class="d-text">
				<h3>Compiti svolti:</h3>
				<div class="task">
					<?php the_content(); ?>
				</div>
				<h3>Tecnologie e software utilizzati:</h3>
				
				<ul class="tools">
					<?php
						$terms = get_the_terms( $post->ID, 'tech' );
												
						if ( $terms && ! is_wp_error( $terms ) ) : 
						
							$writeTermList = array();
						
							foreach ( $terms as $term ) {
								$localName = $term->name;
								$t_id = $term->term_id;
								$term_meta = get_option( "taxonomy_$t_id");
								if($term_meta["priority"]==""){
									$term_meta["priority"]=1000;
								}

								$writeTermList[] = array($term_meta["priority"],$localName,$term_meta["class"],$term_meta["link"]);

							}

							function bestPriority($a, $b)
							{
							    if ($a[0] == $b[0]) {
							    	return 0;
							    }
							    return ($a[0] < $b[0]) ? -1 : 1;
							}
								
							usort($writeTermList, "bestPriority");
							foreach ($writeTermList as $item) {
								$localHtml = '<li><a title="'.$item[1].'" class="'.$item[2].'" href="'.$item[3].'" target="_blank">'.$item[1].'</a></li>';
								echo $localHtml;
							}
					?>
					<?php endif; ?>
				</ul>
			</div>
			<footer>
				<?php
					$link = get_post_meta( $post->ID, 'project_link', false );
				?>
				<a href="<?php echo $link[0]; ?>">Visita il sito &raquo;</a>
			</footer>
		</section>
	</article>
		
	<?php endwhile; // end of the loop. ?>
<?php } else { ?>
	This is not visible;
<?php } ?>