<?php
	$args = array( 'numberposts' => '1', 'post_type'=>'post' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		$last_post['title'] = $recent["post_title"];
		$last_post['content'] = $recent["post_excerpt"];
		$last_post['link'] = get_permalink($recent["ID"]);
		$last_post['ID'] = $recent["ID"];
	}
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), 'single-post-thumbnail' );
	$last_post['image'] =$image[0];
?>

<div id="fat-footer">
	<div class="wrapper">
		<div class="left_content">
			<h4>ULTIME NOTIZIE</h4>
			<article>
				<div class="wrapper">
					<div class="footer-last-post-image roundten" style="background-image: url(<?php echo($last_post['image']) ?>)">
						<h3 class="title roundtenblbr"><span><?php echo($last_post['title']); ?></span></h3>
					</div>
					<div class="footer-last-post-content">
						<div class="d-text">
							<?php echo($last_post['content']); ?>
						</div>
						<a href="<?php echo($last_post['link']); ?>" class="more">LEGGI</a>
					</div>
				</div>
			</article>
			<div class="follow-us">
				<a href="#" class="footer_fb ir">Facebook</a>
				<a href="#" class="footer_tt ir">Twitter</a>
			</div>
		</div>
		<div class="right_content">
			<h4>CONTATTACI <span>hai dubbi o domande? vuoi inviarci la tua opnione?</span></h4>
			<?php echo do_shortcode( '[contact-form-7 id="85" title="Modulo di contatto footer"]' );  ?>
		</div>
	</div>
</div>