<?php


class validation {
	private $reg_errors,$multiLanguageInputForm,$langs,$singleEntityInputForm;
	function __construct(
				$reg_errors,
				$multiLanguageInputForm=array(),
				$langs=array(),
				$dynamicMultiLanguageInputForm=1,
				$singleEntityInputForm=array()
				) {
		$this->reg_errors=$reg_errors;
		$this->singleEntityInputForm=$singleEntityInputForm;
		$this->multiLanguageInputForm=$multiLanguageInputForm;
		$this->langs=$langs;
	}
	public function multiLanguageInputForm() {
		foreach ($this->multiLanguageInputForm as $key => $value)  {
			$singleValue=explode(',',$value);
			foreach ($singleValue as $function2call) {
				if (method_exists($this,$function2call)) {
					foreach ($this->langs as $lang) {
						$name_attr=$key."-".$lang;
						$this->$function2call($name_attr,(isset($_POST[$name_attr])? $_POST[$name_attr]:''));
					}
					$name_attr=$key."-default";
					$this->$function2call($name_attr,(isset($_POST[$name_attr])? $_POST[$name_attr]:''));
				}
			}
		}
		return $this;
	}
	public function singleEntityInputForm() {
		foreach ($this->singleEntityInputForm as $key => $value)  {
			$singleValue=explode(',',$value);
			foreach ($singleValue as $function2call) {
				if (method_exists($this,$function2call)) {
					$this->$function2call($key,(isset($_POST[$key])? $_POST[$key]:''));
				}
			}
		}
		return $this;
	}
	public function dynamicMultiLanguageInputForm($var) {
		
		for ($x=0;$x<$var;$x++) {
			foreach ($this->langs as $lang) {
				$name_attr="attr".$x."-".$lang;
				$this->check_empty_text($name_attr,$_POST[$name_attr]);
			}
			$name_attr="attr".$x."-default";
			$this->check_empty_text($name_attr,$_POST[$name_attr]);
		}
		return $this;
	}
	protected function check_empty_text($key="",$value="") {
		if ( empty( $value)) {
			$this->reg_errors->add($key, "Required form field [$key] is missing");
		}
	}
	protected function check_email($key="",$value="") {
		if ( empty( $value)) {
			$this->reg_errors->add($key, "Required form field [$key] is missing");
		}
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
		    $this->reg_errors->add($key, "Required form field [$key] is invalid email address");
		} 
	}
	public function get_reg_errors() {
		return $this->reg_errors;
	}
	

}


?>