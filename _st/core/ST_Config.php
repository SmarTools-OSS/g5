<?php if (!defined('_GNUBOARD_')) exit;

require_once 'ST_Base.php';

class ST_Config extends ST_Base {
	public function __construct() {
		parent::__construct();
	}
	
	final protected function get_var_file() {
		global $config;
		return ST_DATA_PATH.'/config.var.php';
	}	
	
	protected function get_default($key) {
		$val = '';
		switch($key) {
		case 'st_bootstrap_ver':				$val = '3.3.7';				break;
		case 'st_jquery_ver':					$val = '1.12.4';			break;
		case 'st_fa_ver':							$val = '4.7.0';				break;
		case 'st_ie_warning';					$val = '7';					break;
		
		case 'is_debug':							$val = '1';					break;
		case 'is_firephp':							$val = '';					break;
		}
		return $val;
	}
	
	public function get($key) {
		return isset($this->var[$key])? $this->var[$key]: $this->get_default($key);
	}
}