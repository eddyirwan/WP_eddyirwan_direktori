<?php
define("EIDIR_TABLENAMEMASTER","ei_directorylist");
define("EIDIR_TABLENAMEDETAIL","ei_directorylist_detail");
define("EIDIR_APPS_NAME", "EI DIRECTORY");
define("EIDIR_PLUGIN_NAME", "def");
define("EIDIR_PAGINATION", "5");
define("EIDIR_PAGINATION_SORT", "DESC");

/* please dont touch */

function createDBDIR_EIDIR() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name1 = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
	$table_name2 = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
	$sql1 = "CREATE TABLE $table_name1 (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		created_time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
		status smallint(5) NOT NULL,
		title_default varchar(150) NOT NULL,
		title_en varchar(150) NOT NULL,
		create_by bigint(20) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	$sql2 = "CREATE TABLE $table_name2 (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		table_master mediumint(9) NOT NULL,
		name varchar(50) NOT NULL,
		position_default varchar(50) NOT NULL,
		position_en varchar(50) NOT NULL,
		email varchar(150) NOT NULL,
		telephone_default varchar(50) NOT NULL,
		telephone_en varchar(50) NOT NULL,
		fax_default varchar(50) NOT NULL,
		fax_en varchar(50) NOT NULL,
		create_by bigint(20) NOT NULL,
		status smallint(5) NOT NULL,
		picture_path varchar(500) NULL,
		picture_url varchar(500) NULL,
		UNIQUE KEY id (id),
		ADD KEY `table_master` (`table_master`),
  		ADD KEY `picture_path` (`picture_path`),
  		ADD KEY `picture_url` (`picture_url`),
  		ADD KEY `status` (`status`),
		INDEX table_master (table_master)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta($sql1);
	dbDelta($sql2);
	   
}

function deleteDBDIR_EIDIR() {
	global $wpdb;
    $table_name1 = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
	$table_name2 = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;

    $wpdb->query("DROP TABLE IF EXISTS $table_name1");
    $wpdb->query("DROP TABLE IF EXISTS $table_name2");
	
}

?>