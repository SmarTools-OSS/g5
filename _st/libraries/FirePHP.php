<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if( ST::get_instance()->config->get('st_firephp') ) {
	require_once 'FirePHP/lib/FirePHPCore/fb.php';
}
else {
	class FirePHP {}
	
	class FB {
		public static function setEnabled($Enabled) {}
		public static function getEnabled() {}  
		public static function setObjectFilter($Class, $Filter) {}
		public static function setOptions($Options) {}
		public static function getOptions() {}
		public static function send() {}
		public static function group($Name, $Options=null) {}
		public static function groupEnd() {}
		public static function log($Object, $Label=null) {} 
		public static function info($Object, $Label=null) {} 
		public static function warn($Object, $Label=null) {} 
		public static function error($Object, $Label=null) {} 
		public static function dump($Key, $Variable) {} 
		public static function trace($Label) {} 
		public static function table($Label, $Table) {} 
	}	
}