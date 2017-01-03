<?php
class ei_localization extends localization{
	public static $name = "Nama: ";
	public static $email = "Emel: ";
	public static $position = "Jawatan: ";
	public static $department = "Bahagian: ";
	public static $telefon = "Telefon: ";
	public static $faks = "Faks: ";
	public static $select_pleaseChoose = "Sila Pilih";
	public static $select_text = "Bahagian";
	public static $select_button = "Papar";
	public static final function _output($keyword='xxx') {
		if (property_exists('ei_localization', $keyword)) {
			echo self::$$keyword;
		}
		
	}

}
?>	