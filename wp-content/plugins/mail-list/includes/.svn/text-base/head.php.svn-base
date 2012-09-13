<?php

//hooks
wp_enqueue_script('jquery');
add_action( 'wp_head', 'head_embed' );
add_action( 'admin_head', 'mail_list_admin_head' );

//writing in frontend head
function head_embed()
{
	echo '<script type="text/javascript">';
	echo 'var blog_url = \''.get_bloginfo('wpurl').'\'';
	echo '</script>'."\n";
	echo '<script type="text/javascript" src="'.WP_PLUGIN_URL.'/mail-list/js/functions.js"></script>';
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.WP_PLUGIN_URL.'/mail-list/css/style.css" />';

}

//writing in backend head
function mail_list_admin_head()
{
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.WP_PLUGIN_URL.'/mail-list/css/style.css" />';
	
	//tinymce
	echo '<script type="text/javascript" src="'.WP_PLUGIN_URL.'/mail-list/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>';
	echo '<script type="text/javascript">';
	echo 'tinyMCE.init({';
	echo 'theme : "advanced",';
    echo 'mode : "textareas",';
    echo 'plugins : "autoresize"';
	echo'});';
	echo'</script>';	
	
}

?>
