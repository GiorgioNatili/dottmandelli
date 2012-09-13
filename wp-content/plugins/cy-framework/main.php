<?php
/*
Plugin Name: Cruncy Framework
Plugin URI: http://www.ilcroccante.it/
Description: Custom Framework for Wordpress
Version: 0.1
Author: Giovanni Battista Brescia
Author URI: http://www.ilcroccante.it/
License: GPLv2 or later
*/

/*  Copyright 2012  Giovanni Battista Brescia (email : skill83@gmail.com)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

//embedding external files
//require_once('includes/activation.php');//create the table
//require_once('includes/menu_data.php');//menu data page
require_once('includes/menu_options.php');//menu options page
//require_once('includes/menu_send.php');//menu send page
//require_once('includes/front_form.php');//menu send page
require_once('includes/head.php');//menu send page
//require_once('includes/menu_export.php');//export email address
//require_once('includes/menu_import.php');//export email address
//require_once('includes/credits.php');//function to show the credits

//options initialization
//if(strlen(get_option('mail_list_label1'))==0){update_option('mail_list_label1',"Join the mailing list");}
//if(strlen(get_option('mail_list_label2'))==0){update_option('mail_list_label2',"email address");}
//if(strlen(get_option('mail_list_label3'))==0){update_option('mail_list_label3',"You are now subscribed to the mailing list");}
//if(strlen(get_option('mail_list_label4'))==0){update_option('mail_list_label4',"Submit");}
//if(strlen(get_option('mail_list_terms_anchor'))==0){update_option('mail_list_terms_anchor',"Terms");}
//if(strlen(get_option('mail_list_terms_link'))==0){update_option('mail_list_terms_link',"");}
//if(strlen(get_option('mail_list_form_color'))==0){update_option('mail_list_form_color',"EB0000");}

//pattern (=== Form Builder ===)
//add_menu_page($form_name, $form_name, 'manage_options', 'form','form_main');
//add_submenu_page('form', $form_name.' - Setup', 'Setup', 'manage_options', 'form', 'form_main');
//add_submenu_page('form', $form_name.' - Form Builder', 'Form Builder', 'manage_options', 'form&zf=form_edit', 'form_main');

//menu creation
add_action( 'admin_menu', 'cruncy_menu' );
function cruncy_menu() {
	$form_name='CY Framework';
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_menu_page($form_name, $form_name, 'manage_options', 'cyframework','cy_framework_options',plugins_url().'/cy-framework/img/icon16.png');
	//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	add_submenu_page('cyframework', $form_name.' - Options', 'Options', 'manage_options', 'cyframework', 'cy_framework_options');
	//add_submenu_page('cyframework', $form_name.' - Send', 'Send', 'manage_options', 'mail_list_send', 'mail_list_send');
	
	//add_submenu_page('cyframework', $form_name.' - Data', 'Data', 'manage_options', 'mail_list_data', 'mail_list_data');
	//add_submenu_page('cyframework', $form_name.' - Import', 'Import', 'manage_options', 'mail_list_import', 'mail_list_import');
	//add_submenu_page('cyframework', $form_name.' - Export', 'Export', 'manage_options', 'mail_list_export', 'mail_list_export');
}

?>
