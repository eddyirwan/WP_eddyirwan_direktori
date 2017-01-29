<?php
class eidir_StringHelper {
	public static function returnTextForStatus($var) {
		if ($var == 1) {
			return 'Enable';
		}
		else {
			return 'Disable';
		}
	}
	public static function getUrlAndEditQueryString($key,$value) {
		$current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$current_url_without_questionmark = substr( $url, 0, strrpos( $current_url, "?"));
		$queryString = substr( $url, 1, strrpos( $current_url, "?"));
		parse_str($queryString, $queryStringInArrayFormat);
		$queryStringInArrayFormat[$key]=$value;
		return http_build_query($queryStringInArrayFormat);	
	}
	public static function getUrlAndRemoveQueryString() {
		$current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$current_url_without_questionmark = substr( $current_url, 0, strrpos( $current_url, "?"));
		return $current_url_without_questionmark;
	}



}
?>