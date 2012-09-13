<?php

//hook
//add_action( 'get_footer', 'front_end_form' );

//show the front end form
function front_end_form()
{
//check if the user has just submitted the module
if(isset($_COOKIE['maillistcookie'])){exit();}
//print the module
echo '<div id="ml-newsletterform" style="border-top: 5px solid #'.get_option('mail_list_form_color').' !important;">';
	echo '<div id="ml-newsletterform-container" class="clearfix">';
		echo '<p id="ml-p">';
			echo get_option('mail_list_label1');
			if(strlen(get_option('mail_list_terms_link'))>0){	
				echo '<a style="color: #'.get_option('mail_list_form_color').' !important;"target="_blank" href="'.get_option('mail_list_terms_link').'" class="ml-terms">'.get_option('mail_list_terms_anchor').'</a>';
			}
		echo '</p>';
		echo '<p id="ml-p-sent">'.get_option('mail_list_label3').'</p>';
		echo '<div id="ml-form">';
			echo '<img id="ml-img" src="'.WP_PLUGIN_URL.'/mail-list/img/ml-ajax.gif">';
			echo '<form action="" onsubmit="return subscribeMailList()">';
				echo '<input id="ml-email" type="text" autocomplete="off" value="'.get_option('mail_list_label2').'" onfocus="deleteMe(this)";>';
				echo '<input id="ml-button" type="submit" value="'.get_option('mail_list_label4').'">';
			echo '</form>';
		echo '</div>';
	echo '</div>';
echo '</div>';
}

?>
