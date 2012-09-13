<?php

//hook
register_activation_hook(WP_PLUGIN_DIR.'/cy-framework/main.php','cy_framework_create_table');

//create prefix+mail_list_table
function cy_framework_create_table(){
	global $wpdb;$table_name=$wpdb->prefix . "cy_framework_table";
	$sql = "CREATE TABLE $table_name (
	  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  email VARCHAR(100) DEFAULT '' NOT NULL,
	  hash VARCHAR(32) DEFAULT '' NOT NULL
	);";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}

?>
