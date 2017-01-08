<?php
/*
Plugin Name: EDDYIRWAN DIRECTORY
Plugin URI: http://www.facebook.com/eddyirwan
Version: 1
Author: Eddy Irwan
Email: eddyirwan@gmail.com
Phone: +60109826521 / +60122856521
Description: STAFF DIRECTORY for Malaysian Government Website
*/


require_once( plugin_dir_path( __FILE__ ) . "settings.php");
#require_once( plugin_dir_path( __FILE__ ) . DIRECTORY_SEPARATOR. "shared" . DIRECTORY_SEPARATOR."pagination.class.php");
#require_once( plugin_dir_path( __FILE__ ) . "shared".DIRECTORY_SEPARATOR."stringhelper.class.php");

#register_activation_hook(__FILE__, 'createDBDIR_EI');
#register_deactivation_hook( __FILE__, 'deleteDBDIR_EI' );
/*
add_action( 'wp_ajax_ei_voteThruAjax', 'ei_voteThruAjax' );
add_action( 'wp_ajax_nopriv_ei_voteThruAjax', 'ei_voteThruAjax' );
add_action( 'wp_ajax_ei_seeResultFromAjax', 'ei_seeResultFromAjax' );
add_action( 'wp_ajax_nopriv_ei_seeResultFromAjax', 'ei_seeResultFromAjax' );
add_action( 'init', 'custom_lang_found' );
*/

#add_shortcode( EIDIR_PLUGIN_NAME , 'frontend' );
/*
if (is_admin()) {
	require_once( plugin_dir_path( __FILE__ ) . "backend.php");
	function listDirectory() {	
		$instance1 = new listDirectory();
	}
	function listAddDirectory() {
		$instance1 = new listAddDirectory();
	}
	function listUpdateDirectory() {
		$instance1 = new listUpdateDirectory();
	}
	function listDeleteDirectory() {
		$instance1 = new listDeleteDirectory();
	}
	function listStaffDirectory() {	
		$instance1 = new listStaffDirectory();
	}
	function addStaffDirectory() {
		$instance1 = new addStaffDirectory();
	}
	function updateStaffDirectory() {
		$instance1 = new updateStaffDirectory();
	}
	function pictureStaffDirectory() {
		$instance1 = new pictureStaffDirectory();
	}
}
else {
	require_once( plugin_dir_path( __FILE__ ) . "frontend.php");
	
	#add_action( 'init', 'custom_lang_found' );
	function frontend($atts) {
	    ob_start();
	    $fe = new frontend($atts);
	    $fe->loadLanguageClass($atts);
	    $fe->viewByDirectory();
	    return ob_get_clean();
	}
}
*/





?>