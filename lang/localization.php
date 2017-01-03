<?php
class localization {
	public static final function _dynamicOutput($row,$lang,$preVar) {
		if ($lang == "default") {
			$lang=$preVar.'_default';
        }
        else {
            $lang=$preVar.'_'.$this->lang;
        }
        echo $row->$lang;
	}

}
?>