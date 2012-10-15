<?php 
	add_action( 'after_setup_theme', 'my_child_theme_setup' );
  /*Gestione dei labels*/
  function custom_admin_js() {
  global $pagenow;
  $var=$_GET['taxonomy'];
  $mySiteUrl = get_stylesheet_directory_uri();
    if(($pagenow=='edit-tags.php' && ($var=='block_home' || $var=='block_templates')) || ($pagenow=='post.php') ){
      echo '<script src="'.$mySiteUrl.'/sm_js/pages/replace.js"></script>' . "\n";
      //echo '<script>alert("'.$pagenow.$var.'")</script>' . "\n";
    }
  
}


	add_action('init', 'search_query_fix');
	function search_query_fix(){
		if(isset($_GET['s']) && $_GET['s']==''){
			$_GET['s']=' ';
		}
	}


add_action('admin_footer', 'custom_admin_js');
  
	function my_child_theme_setup() {
    // Add specific CSS class by filter

  function my_class_names($classes) {
	// add 'class-name' to the $classes array
  $random_bg=array('bg0','bg1','bg2','bg3','bg4','bg5','bg6','bg7','bg8','bg9','bg10','bg11','bg12','bg13',);
  $bg=array_rand($random_bg);
  
	$classes[] = $random_bg[$bg];
	// return the $classes array
	return $classes;
  }
  add_filter('body_class','my_class_names');
  
		function header_css() {
			$mySiteUrl = get_stylesheet_directory_uri();
			echo '<link rel="icon" href="'.$mySiteUrl.'/sm_img/favicon.ico" />' . "\n";
		}
		add_action('wp_head', "header_css");

		function header_js() {
			$mySiteUrl = get_stylesheet_directory_uri();
			echo '<script src="'.$mySiteUrl.'/sm_js/vendor/modernizr-2.5.3.min.js"></script>' . "\n";
			echo '<!--[if lt IE 7 ]><script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script><script defer>window.attachEvent(\'onload\',function(){CFInstall.check({mode:\'overlay\'})})</script><![endif]-->' . "\n";
			if ( !is_admin() && is_page_template('template_2.php') ){
				echo '<script src="'.$mySiteUrl.'/sm_js/libs/css3-multi-column.js"></script>' . "\n";
			}
      if ( !is_admin() && is_page_template('template_contatti.php') ){
				echo '<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>' . "\n";
        echo '<script src="'.$mySiteUrl.'/sm_js/pages/map_init.js"></script>' . "\n";
			}
		}
		add_action('wp_head', 'header_js');

		function footer_js() {
			$mySiteUrl = get_stylesheet_directory_uri();
			echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>' . "\n";
			echo '<script>window.jQuery || document.write(\'<script src="'.$mySiteUrl.'/sm_js/vendor/jquery-1.7.2.min.js"><\/script>\')</script>' . "\n";
			echo '<script src="'.$mySiteUrl.'/sm_js/libs/log.js"></script>' . "\n";
			echo '<script src="'.$mySiteUrl.'/sm_js/libs/bowser.js"></script>' . "\n";
			echo '<script src="'.$mySiteUrl.'/sm_js/main.js"></script>' . "\n";
			echo '<script src="'.$mySiteUrl.'/sm_js/libs/placeholder.js"></script>' . "\n";
      echo '<script src="'.$mySiteUrl.'/sm_js/pages/checksearch.js"></script>' . "\n";
			if ( !is_admin() && is_page_template('homepage.php') ){
				echo '<script src="'.$mySiteUrl.'/sm_js/pages/homepage.js"></script>' . "\n";
			}
			if ( !is_admin() && (is_page_template('template_2.php') || is_page_template('template_organico.php') || is_page_template('template_ambulatorio.php'))){
				echo '<script src="'.$mySiteUrl.'/sm_js/libs/jquery.cycle.all.js"></script>' . "\n";
				echo '<script src="'.$mySiteUrl.'/sm_js/pages/template_2.js"></script>' . "\n";
			}
      
      if ( !is_admin() && ('post' == get_post_type()) ){
      	echo '<script src="'.$mySiteUrl.'/sm_js/libs/jquery.cycle.all.js"></script>' . "\n";
				echo '<script src="'.$mySiteUrl.'/sm_js/pages/post.js"></script>' . "\n";
      }
      
			echo "<script>var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s)}(document,'script'));</script>" . "\n";
		}
		add_action('wp_footer', 'footer_js');

		// custom menu
		function clean_custom_menus($menuName) {
			$els = wp_get_nav_menu_items($menuName);
			$return = '';
			foreach($els as $key => $el){
				$return .= '<a href="'.$el->url.'"><span>'.$el->title.'</span></a>';
			}
			echo $return;
		}

		// page excerpt
		function add_excerpt_to_page_post_type(){
			add_post_type_support( 'page', 'excerpt' );
		};
		add_action( 'init', 'add_excerpt_to_page_post_type' );

		
		add_action( 'init', 'build_taxonomies', 0 );
		function build_taxonomies() {
    		register_taxonomy(
				'block_home',
				'page',
				array(
					'hierarchical' => true,
					'label' => 'Blocchi Homepage',
					'query_var' => true,
					'rewrite' => false
				)
			);
			register_taxonomy(
				'block_templates',
				'page',
				array(
					'hierarchical' => true,
					'label' => 'Blocchi Pagine Interne',
					'query_var' => true,
					'rewrite' => false
				)
			);
		}

	    // We are removing filters after theme setup
	    remove_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

	    // Add term page
		function block_templates_taxonomy_add_new_meta_field() {
			// this will add the custom meta field to the add new term page
			?>
			<div class="form-field">
				<label for="term_meta[class]"><?php _e( 'Colore Blocco', 'sm' ); ?></label>
				<input type="text" name="term_meta[class]" id="term_meta[class]" value="">
				<p class="description"><?php _e( 'red, orange, green, light-blue','sm' ); ?></p>
			</div>
			<div class="form-field">
				<label for="term_meta[img]"><?php _e( 'Immagine Blocco', 'sm' ); ?></label>
				<input type="text" name="term_meta[img]" id="term_meta[img]" value="">
				<p class="description"><?php _e( '/wp-content/themes/studiomandelli/sm_img/red.png','sm' ); ?></p>
			</div>
			<div class="form-field">
				<label for="term_meta[link]"><?php _e( 'Link Blocco', 'sm' ); ?></label>
				<input type="text" name="term_meta[link]" id="term_meta[link]" value="">
				<p class="description"><?php _e( 'http://www.google.it','sm' ); ?></p>
			</div>
			<div class="form-field">
				<label for="term_meta[title]"><?php _e( 'Titolo Blocco', 'sm' ); ?></label>
				<input type="text" name="term_meta[title]" id="term_meta[title]" value="">
				<p class="description"><?php _e( 'Lorem Ipsum','sm' ); ?></p>
			</div>
		<?php
		}
		add_action( 'block_templates_add_form_fields', 'block_templates_taxonomy_add_new_meta_field', 10, 2 );

		// Edit term page
		function block_templates_taxonomy_edit_meta_field($term) {
		 
			// put the term ID into a variable
			$t_id = $term->term_id;
		 
			// retrieve the existing value(s) for this meta field. This returns an array
			$term_meta = get_option( "taxonomy_$t_id" ); ?>

			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[class]"><?php _e( 'Colore Blocco', 'sm' ); ?></label></th>
				<td>
					<input type="text" name="term_meta[class]" id="term_meta[class]" value="<?php echo esc_attr( $term_meta['class'] ) ? esc_attr( $term_meta['class'] ) : ''; ?>">
					<p class="description"><?php _e( 'red, orange, green, light-blue','sm' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[img]"><?php _e( 'Immagine Blocco', 'sm' ); ?></label></th>
				<td>
					<input type="text" name="term_meta[img]" id="term_meta[img]" value="<?php echo esc_attr( $term_meta['img'] ) ? esc_attr( $term_meta['img'] ) : ''; ?>">
					<p class="description"><?php _e( '/wp-content/themes/studiomandelli/sm_img/red.png','sm' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[link]"><?php _e( 'Link Blocco', 'sm' ); ?></label></th>
				<td>
					<input type="text" name="term_meta[link]" id="term_meta[link]" value="<?php echo esc_attr( $term_meta['link'] ) ? esc_attr( $term_meta['link'] ) : ''; ?>">
					<p class="description"><?php _e( 'http://www.google.it','sm' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="term_meta[title]"><?php _e( 'Titolo Blocco', 'sm' ); ?></label></th>
				<td>
					<input type="text" name="term_meta[title]" id="term_meta[title]" value="<?php echo esc_attr( $term_meta['title'] ) ? esc_attr( $term_meta['title'] ) : ''; ?>">
					<p class="description"><?php _e( 'Lorem Ipsum','sm' ); ?></p>
				</td>
			</tr>
		<?php
		}
		add_action( 'block_templates_edit_form_fields', 'block_templates_taxonomy_edit_meta_field', 10, 2 );

		// Save extra taxonomy fields callback function.
		function save_taxonomy_block_templates( $term_id ) {
			if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_$t_id" );
				$cat_keys = array_keys( $_POST['term_meta'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['term_meta'][$key] ) ) {
						$term_meta[$key] = $_POST['term_meta'][$key];
					}
				}
				// Save the option array.
				update_option( "taxonomy_$t_id", $term_meta );
			}
		}  
		add_action( 'edited_block_templates', 'save_taxonomy_block_templates', 10, 2 );  
		add_action( 'create_block_templates', 'save_taxonomy_block_templates', 10, 2 );

		// Add term page
		function block_home_taxonomy_add_new_meta_field() {
			// this will add the custom meta field to the add new term page
			?>
			<div class="form-field">
				<label for="term_meta[link]"><?php _e( 'Link Blocco', 'sm' ); ?></label>
				<input type="text" name="term_meta[link]" id="term_meta[link]" value="">
				<p class="description"><?php _e( 'http://www.google.it','sm' ); ?></p>
			</div>
			<div class="form-field">
				<label for="term_meta[title]"><?php _e( 'Titolo Blocco', 'sm' ); ?></label>
				<input type="text" name="term_meta[title]" id="term_meta[title]" value="">
				<p class="description"><?php _e( 'Lorem Ipsum','sm' ); ?></p>
			</div>
		<?php
		}
		add_action( 'block_home_add_form_fields', 'block_home_taxonomy_add_new_meta_field', 10, 2 );

		// Edit term page
		function block_home_taxonomy_edit_meta_field($term) {
		 
			// put the term ID into a variable
			$t_id = $term->term_id;
		 
			// retrieve the existing value(s) for this meta field. This returns an array
			$term_meta = get_option( "taxonomy_$t_id" ); ?>
			<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[link]"><?php _e( 'Link Blocco', 'sm' ); ?></label></th>
				<td>
					<input type="text" name="term_meta[link]" id="term_meta[link]" value="<?php echo esc_attr( $term_meta['link'] ) ? esc_attr( $term_meta['link'] ) : ''; ?>">
					<p class="description"><?php _e( 'http://www.google.it','sm' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[title]"><?php _e( 'Titolo Blocco', 'sm' ); ?></label></th>
				<td>
					<input type="text" name="term_meta[title]" id="term_meta[title]" value="<?php echo esc_attr( $term_meta['title'] ) ? esc_attr( $term_meta['title'] ) : ''; ?>">
					<p class="description"><?php _e( 'Lorem Ipsum','sm' ); ?></p>
				</td>
			</tr>
		<?php
		}
		add_action( 'block_home_edit_form_fields', 'block_home_taxonomy_edit_meta_field', 10, 2 );

		// Save extra taxonomy fields callback function.
		function save_taxonomy_custom_meta( $term_id ) {
			if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_$t_id" );
				$cat_keys = array_keys( $_POST['term_meta'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['term_meta'][$key] ) ) {
						$term_meta[$key] = $_POST['term_meta'][$key];
					}
				}
				// Save the option array.
				update_option( "taxonomy_$t_id", $term_meta );
			}
		}  
		add_action( 'edited_block_home', 'save_taxonomy_custom_meta', 10, 2 );  
		add_action( 'create_block_home', 'save_taxonomy_custom_meta', 10, 2 );

		function cruncy_posted_on() {
			printf( __( '<span class="sep">Postato il </span><time class="entry-date" datetime="%3$s" pubdate>%4$s</time>', 'cruncy' ),
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
				get_the_author()
			);
		}

  add_action( 'init', 'create_post_type' );
  function create_post_type() {
        register_post_type( 'staff',
                array(
                        'labels' => array(
                                'name' => __( 'Staff' ),
                                'singular_name' => __( 'Staff' )
                        ),
                'public' => true,
                'has_archive' => true
                )
        );
        register_post_type( 'disciplina',
                array(
                        'labels' => array(
                                'name' => __( 'Disciplina' ),
                                'singular_name' => __( 'Disciplina' )
                        ),
                'public' => true,
                'has_archive' => true
                )
        );
  }
  
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'small-550', '550', '315', true );
  add_image_size( 'small-145', '145', '85', true );    
  add_image_size( 'big-mission', '870', '620', true );   
  add_image_size( 'big-stripe', '1170', '370', true );
  add_image_size( 'medium-side', '400', '200', true );
  add_image_size( 'page-gallery', '765', '302', true );
  add_image_size( 'lightbox-thumb', '270', '160', true );
  
		include 'demo.php';
	}
?>