<?php
require_once( plugin_dir_path( __FILE__ ) . "backend".DIRECTORY_SEPARATOR."controller.class.php");
require_once( plugin_dir_path( __FILE__ ) . "backend".DIRECTORY_SEPARATOR."menuslug.php");
require_once( plugin_dir_path( __FILE__ ) . "backend".DIRECTORY_SEPARATOR."upload.php");
require_once( plugin_dir_path( __FILE__ ) . "backend".DIRECTORY_SEPARATOR."validation.php");

add_action('admin_menu','eidir_slug_admin_menu');

class listDirectory extends EIDIR_Controller {
	function __construct() {
		parent::__construct();
	}
	public function post_listDirectory() {
		// none
	}
	public function get_listDirectory() {
		global $wpdb;
		global $reg_errors;
     	$table_name = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
  	    $rows = $wpdb->get_results("SELECT * from $table_name");
		require_once( plugin_dir_path( __FILE__ ) . "views/admin_listdirectory.php");
	}
}

class listAddDirectory extends EIDIR_Controller {
	function __construct() {
		parent::__construct();
	}
	function post_listAddDirectory() {
		global $reg_errors;
		$reg_errors = new WP_Error;
		$validation1 = new validation($reg_errors,array('title'=>'check_empty_text'),array('en'));
		$validation1->multiLanguageInputForm();
		$reg_errors=$validation1->get_reg_errors();
		if ( is_wp_error( $reg_errors ) && ! empty( $reg_errors->errors ) ) {
			require_once(ABSPATH . 'wp-admin/admin-header.php');
			require_once( plugin_dir_path( __FILE__ ) . "views/admin_addlistdirectory.php");
		}
		else {
			global $wpdb;
			$table_name1= $wpdb->prefix . EIDIR_TABLENAMEMASTER;
			$title_default = sanitize_text_field(  (isset($_POST["title-default"])? $_POST["title-default"]:''));
			$title_en = sanitize_text_field(  (isset($_POST["title-en"])? $_POST["title-en"]:''));
			$status = sanitize_text_field(  (isset($_POST["status"])? $_POST["status"]:''));
			$user = wp_get_current_user();
        	$wpdb->insert( $table_name1, 
	            array( 
	                'title_default' => $title_default,
	                'title_en' => $title_en,
	                'create_by' => $user->ID,
	                'status' => $status
	            )
	        );	      
			wp_redirect(admin_url().'admin.php?page=list_directory');
		}
	}
	function get_listAddDirectory() {
		global $reg_errors;
		require_once( plugin_dir_path( __FILE__ ) . "views/admin_addlistdirectory.php");
		
	}
}

class listDeleteDirectory extends EIDIR_Controller {
	function __construct() {
		parent::__construct();
	}
	function get_listDeleteDirectory() {
		global $wpdb;
		$idfromUrl= (isset($_GET["id"])? $_GET["id"]:'');
		if ($idfromUrl) {
			$task=(isset($_GET["task"])? $_GET["task"]:'');
			
			if ($task == "deleteall") {
				$table_name = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
	        	$wpdb->delete( $table_name, array( 
	        		'id' => $idfromUrl
	        	));
		        
		        $table_name = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
		        $wpdb->delete( $table_name, array( 
		        	'table_master' => $idfromUrl
		        ));

			}
			else if ($task == "deleteattribute") {
		        $table_name = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
		        $wpdb->delete( $table_name, array( 
		        	'id' => $idfromUrl
		        ));
		        wp_redirect(admin_url().'admin.php?page=list_directory');
		        exit();
			}
			else if ($task == "deleteimage") {
		        $table_name = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
		        $sql = "SELECT * FROM $table_name WHERE id = $idfromUrl";
		        $output=$wpdb->get_row($sql);
		        #echo "<pre>".print_r($output,true)."</pre>";
		        #exit();
		        if ($output) {
		        	$status_delete_file=unlink(get_home_path().$picture_path);
		        	$updated = $wpdb->update($table_name, array(
					 'picture_url' => NULL,
					 'picture_path' => NULL),
					array('id'=>$idfromUrl));
		        }
		        
		        wp_redirect(admin_url().'?page=picture_staff_directory&id='.$idfromUrl);
		        exit();
			}
			
		}
		wp_redirect(admin_url().'admin.php?page=list_directory');
	}
}

class listUpdateDirectory extends EIDIR_Controller {
	function __construct() {
		parent::__construct();
	}
	function post_listUpdateDirectory() {
		
		global $wpdb;
		global $reg_errors;

		$idfromUrl=$_GET["id"];
		$table_name = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
        $rows = $wpdb->get_results("SELECT * from $table_name where id = $idfromUrl");

		$reg_errors = new WP_Error;
		$validation1 = new validation($reg_errors,array('title'=>'check_empty_text'),array('en'));
		$validation1->multiLanguageInputForm();

		if( is_wp_error( $reg_errors ) && ! empty( $reg_errors->errors ) ) {		
	        require_once(ABSPATH . 'wp-admin/admin-header.php');
			require_once( plugin_dir_path( __FILE__ ) . "views/admin_updatepoll.php");
		}
		else {
			$title_default = sanitize_text_field(  (isset($_POST["title-default"])? $_POST["title-default"]:''));
			$title_en = sanitize_text_field(  (isset($_POST["title-en"])? $_POST["title-en"]:''));
			$status = sanitize_text_field(  (isset($_POST["status"])? $_POST["status"]:''));
			$table_name = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
			$updated = $wpdb->update("$table_name", array(
				 'title_default' => $title_default,
				 'status' => $status,
	             'title_en' => $title_en),
				array('id'=>$idfromUrl));
			wp_redirect(admin_url().'admin.php?page=list_directory');
			#echo $wpdb->last_query;
			
		}
		
	}
	function get_listUpdateDirectory() {
		global $wpdb;
		global $reg_errors;
		$idfromUrl=$_GET["id"];
        $table_name = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
        $rows = $wpdb->get_results("SELECT * from $table_name where id = $idfromUrl");
        require_once( plugin_dir_path( __FILE__ ) . "views/admin_updatelistdirectory.php");
	}
}

class listStaffDirectory extends EIDIR_Controller {
	function __construct() {
		parent::__construct();
	}
	public function post_listStaffDirectory() {
		// none
	}
	
	public function get_listStaffDirectory() {
		global $wpdb;
		global $reg_errors;
		global $wp;

		$image_folder= plugins_url('images/', __FILE__);
		$masterFromUrl=(isset($_GET["master"])? $_GET["master"]:'');
		$table_name1 = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
     	$table_name2 = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
     	$details = $wpdb->get_results("SELECT * from $table_name1",OBJECT_K);

     	#echo "<pre>".print_r($details,true)."</pre>";
     	$pagination = new pagination($table_name2,$wpdb);
     	if ($masterFromUrl) {
     		$rows=$pagination->query("*","where table_master = $masterFromUrl");
     	}
     	else {
     		$rows=$pagination->query("*");
     		#$sql2="SELECT * from $table_name2";
     	}
     	#$rows = $wpdb->get_results($sql2);
		require_once( plugin_dir_path( __FILE__ ) . "views/admin_liststaffdirectory.php");
	}
}

class addStaffDirectory extends EIDIR_Controller {
	function __construct() {
		parent::__construct();
	}
	function post_addStaffDirectory() {
		global $reg_errors;
		$reg_errors = new WP_Error;
		$validation1 = new validation(
			$reg_errors,
			array('position'=>'check_empty_text'),
			array('en'),
			1,
			array('name'=>'check_empty_text','email'=>'check_email'));
		$reg_errors=$validation1->multiLanguageInputForm()->singleEntityInputForm()->get_reg_errors();
		global $wpdb;
		if ( is_wp_error( $reg_errors ) && ! empty( $reg_errors->errors ) ) {
			$table_name1 = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
     		$details = $wpdb->get_results("SELECT * from $table_name1");
			require_once(ABSPATH . 'wp-admin/admin-header.php');
			require_once( plugin_dir_path( __FILE__ ) . "views/admin_addstaffdirectory.php");
		}
		else {
			$table_name1= $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
			$position_default = sanitize_text_field(  (isset($_POST["position-default"])? $_POST["position-default"]:''));
			$position_en = sanitize_text_field(  (isset($_POST["position-en"])? $_POST["position-en"]:''));
			$status = sanitize_text_field(  (isset($_POST["status"])? $_POST["status"]:''));
			$email = sanitize_text_field(  (isset($_POST["email"])? $_POST["email"]:''));
			$name = sanitize_text_field(  (isset($_POST["name"])? $_POST["name"]:''));
			$directory = sanitize_text_field(  (isset($_POST["directory"])? $_POST["directory"]:''));
			$user = wp_get_current_user();
        	$wpdb->insert( $table_name1, 
	            array( 
	                'position_default' => $position_default,
	                'position_en' => $position_en,
	                'name' => $name,
	                'email' => $email,
	                'create_by' => $user->ID,
	                'table_master' => $directory,
	                'status' => $status
	            )
	        );	      
			wp_redirect(admin_url().'admin.php?page=list_staff_directory');
			#echo $wpdb->last_query;
		}
	}
	function get_addStaffDirectory() {
		global $reg_errors;
		global $wpdb;
		$table_name1 = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
     	$details = $wpdb->get_results("SELECT * from $table_name1");
		require_once( plugin_dir_path( __FILE__ ) . "views/admin_addstaffdirectory.php");
		
	}
}

class updateStaffDirectory extends EIDIR_Controller {
	function __construct() {
		parent::__construct();
	}
	function post_updateStaffDirectory() {
		$idfromUrl=$_POST["id"];
		global $reg_errors;
		$reg_errors = new WP_Error;
		$validation1 = new validation(
			$reg_errors,
			array('position'=>'check_empty_text'),
			array('en'),
			1,
			array('name'=>'check_empty_text','email'=>'check_email'));
		$reg_errors=$validation1->multiLanguageInputForm()->singleEntityInputForm()->get_reg_errors();
		global $wpdb;
		if ( is_wp_error( $reg_errors ) && ! empty( $reg_errors->errors ) ) {
			$table_name1 = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
     		$details = $wpdb->get_results("SELECT * from $table_name1");
			require_once(ABSPATH . 'wp-admin/admin-header.php');
			require_once( plugin_dir_path( __FILE__ ) . "views/admin_updatestaffdirectory.php");
		}
		else {
			$table_name1= $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
			$position_default = sanitize_text_field(  (isset($_POST["position-default"])? $_POST["position-default"]:''));
			$position_en = sanitize_text_field(  (isset($_POST["position-en"])? $_POST["position-en"]:''));
			$status = sanitize_text_field(  (isset($_POST["status"])? $_POST["status"]:''));
			$email = sanitize_text_field(  (isset($_POST["email"])? $_POST["email"]:''));
			$name = sanitize_text_field(  (isset($_POST["name"])? $_POST["name"]:''));
			$directory = (isset($_POST["directory"])? $_POST["directory"]:'');
			$user = wp_get_current_user();
        	
	        $updated = $wpdb->update($table_name1, array(
				 'position_default' => $position_default,
	                'position_en' => $position_en,
	                'name' => $name,
	                'email' => $email,
	                'create_by' => $user->ID,
	                'table_master' => $directory,
	                'status' => $status),
				array('id'=>$idfromUrl));      
			wp_redirect(admin_url().'admin.php?page=list_staff_directory');
			#echo $wpdb->last_query;
		}
	}
	function get_updateStaffDirectory() {
		global $reg_errors;
		global $wpdb;
		$table_name1 = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
     	$details = $wpdb->get_results("SELECT * from $table_name1");
     	$idfromUrl=$_GET["id"];
     	$table_name2 = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
        $rows = $wpdb->get_results("SELECT * from $table_name2 where id = $idfromUrl");
		require_once( plugin_dir_path( __FILE__ ) . "views/admin_updatestaffdirectory.php");
		
	}
}

class pictureStaffDirectory extends EIDIR_Controller {
	function __construct() {
		parent::__construct();
	}
	public function post_pictureStaffDirectory() {
		include_once(ABSPATH . 'wp-admin/includes/media.php');
		include_once(ABSPATH . 'wp-admin/includes/file.php');


		if ($_FILES['file']) {
			$idfromUrl=$_POST["id"];
		    $allowed_file_types = array('jpg' =>'image/jpg','jpeg' =>'image/jpeg');
		    $overrides = array('test_form' => false, 'mimes' => $allowed_file_types);
		    add_filter('upload_dir', 'my_upload_dir');
		    add_filter( 'sanitize_file_name', 'my_filename_convention', 10 );
		    $file = wp_handle_upload($_FILES['file'], $overrides);
		    remove_filter('upload_dir', 'my_upload_dir');
		    remove_filter( 'sanitize_file_name', 'my_filename_convention', 10 );
		    global $wpdb;
		    $table_name1 = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
		    $file_uploaded=str_replace(get_home_path(), '', $file['file']);
		    $url_uploaded=str_replace(site_url(), '', $file['url']);
			
		    $updated = $wpdb->update($table_name1, array(
				'picture_path' => $file_uploaded,
	            'picture_url' => $url_uploaded),
				array('id'=>$idfromUrl));
	
			#echo site_url()."<br/>";
		    #echo "<pre>".print_r($file,true)."</pre>";
		    #echo "<br/>".$file_uploaded."<br/>";
		    #echo "<br/>".$url_uploaded."<br>";
		    
		}
		wp_redirect(admin_url().'admin.php?page=list_staff_directory');
	}
	
	public function get_pictureStaffDirectory() {
		global $wpdb;
		global $reg_errors;
		$idfromUrl=$_GET["id"];
		$table_name = $wpdb->prefix . EIDIR_TABLENAMEDETAIL;
     	$rows = $wpdb->get_results("SELECT * from $table_name WHERE id = $idfromUrl");
     	$image_folder= plugins_url('images/', __FILE__);
		require_once( plugin_dir_path( __FILE__ ) . "views/admin_picturestaffdirectory.php");
	}
}


?>