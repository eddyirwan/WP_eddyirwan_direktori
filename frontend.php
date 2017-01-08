<?php

require_once( plugin_dir_path( __FILE__ ) . "backend".DIRECTORY_SEPARATOR."validation.php");
require_once( plugin_dir_path( __FILE__ ) . "lang".DIRECTORY_SEPARATOR."localization.php");
class frontend {
    function __construct($atts=array()) {
        global $wpdb;
        $this->table_name1 = $wpdb->prefix . EIDIR_TABLENAMEMASTER;
        $this->table_name2 = $wpdb->prefix . TABLENAMEDETAIL;
        $this->lang = "default";
    }
    

    public function viewByDirectory() {
        global $wpdb;
        $pagination = new pagination($this->table_name2,$wpdb);
        $details = $wpdb->get_results("SELECT * from $this->table_name1",OBJECT_K);
        $filter=intval(isset($_GET["filter"])? $_GET["filter"]:'');
        if ($filter) {
     		$rows=$pagination->query("*","where table_master = $filter");
  	    	
     	}
     	else {
     		$rows=$pagination->query("*");
     		
     	}
     	$image_folder= plugins_url('images/', __FILE__);
        require_once( plugin_dir_path( __FILE__ ) . "views/liststaffdirectory.php");
    }
    
    public function loadLanguageClass($atts) {
    	if (is_array($atts)) {
    		if (array_key_exists('lang',$atts)) {
            	require_once( plugin_dir_path( __FILE__ ) . "lang".DIRECTORY_SEPARATOR.$atts['lang'].".php");
            	$this->lang=$atts['lang']; 
        	}
        	else {
        		require_once( plugin_dir_path( __FILE__ ) . "lang".DIRECTORY_SEPARATOR."default.php"); 
            	$this->lang = "default";
        	}
    	}
        else {
            require_once( plugin_dir_path( __FILE__ ) . "lang".DIRECTORY_SEPARATOR."default.php"); 
            $this->lang = "default";
        }
    }

}



?>