<?php

class ei_Localization extends localization{
	public static $name = "Name: ";
	public static $email = "Email: ";
	public static $position = "Position: ";
	public static $department = "Department: ";
	public static $telefon = "Telephone: ";
	public static $faks = "Fax: ";
	public static $select_pleaseChoose = "Please choose";
	public static $select_text = "Department";
	public static $select_button = "View";

	public static final function _output($keyword='xxx') {
		if (property_exists('ei_pollLocalization', $keyword)) {
			echo self::$$keyword;
		}
	}


}
?>	