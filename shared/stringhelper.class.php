<?php
class StringHelper {
	public static function returnTextForStatus($var) {
		if ($var == 1) {
			return 'Enable';
		}
		else {
			return 'Disable';
		}
	}



}
?>