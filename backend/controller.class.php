<?php
class EIDIR_Controller{
	#var $function_name_get,$function_name_post;
	function __construct() {
		$function_name_get = 'get_'.get_called_class();
		$function_name_post = 'post_'.get_called_class();
   		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   			if (method_exists(get_called_class(),$function_name_post)) {
   				$this->$function_name_post();
   			}
   			else {

   			}
   		}
   		else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
   			if (method_exists(get_called_class(),$function_name_get)) {
   				$this->$function_name_get();
   			}
   			else {

   			}
   		}
	}
}
?>