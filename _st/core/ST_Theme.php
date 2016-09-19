<?php if (!defined('_GNUBOARD_')) exit;

require_once 'ST_Base.php';

class ST_Theme extends ST_Base {
	public function __construct() {
		parent::__construct();
	}
	
	final protected function get_var_file() {
		global $config;
		$var_file = ST_DATA_PATH.'/themes/'.$config['cf_theme'].'/theme.var.php';		// 운영설정 파일
		if( !file_exists($var_file) )
			$var_file = G5_THEME_PATH.'/theme.var.php';	// 테마 기본값 파일
		return $var_file;
	}
	
	public function get_file_url() {
		global $config;
		return ST_DATA_URL.'/themes/'.$config['cf_theme'].'/files';
	}
	
	public function get_file_path() {
		global $config;
		return ST_DATA_PATH.'/themes/'.$config['cf_theme'].'/files';
	}	
	
	public function write($var_file = NULL, $files_dir = '/files') {
		global $config;
		$var_file = ST_DATA_PATH.'/themes/'.$config['cf_theme'].'/theme.var.php';		
		return parent::write($var_file);
	}	
}