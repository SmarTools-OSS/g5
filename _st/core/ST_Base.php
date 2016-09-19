<?php if (!defined('_GNUBOARD_')) exit;

abstract class ST_Base {
	protected $var = array();
	public function __construct() {
		$this->initialize();
	}
	
	protected function initialize() {
		$var_file = $this->get_var_file();
		if( file_exists($var_file) ) {
			include_once $var_file;
			$this->var = $var;
		}
	}	
	
	abstract protected function get_var_file();
	
	public function get($key) {
		return isset($this->var[$key])? $this->var[$key]: NULL;
	}		
		
	public function write($var_file = NULL, $files_dir = '/files') {
		$var_file = $var_file? $var_file: $this->get_var_file();
		$var_path = dirname($var_file);
		ST::mkdir($var_path);
		
		// 첨부파일 삭제처리
		foreach($_POST as $key => $val) {
			if( strpos($key, 'del_') === 0 ) {
				$key = str_replace('del_', '', $key);				
				@unlink($var_path.$files_dir.'/'.$this->get($key));
				unset($_POST[$key]);
				continue;
			}			
		}			
		
		// 일반 설정값 처리
		if( !$fp = @fopen($var_file, 'w') )
			return -1;
		
		fwrite($fp, '<?php if (!defined(\'_GNUBOARD_\')) exit;'.PHP_EOL.PHP_EOL);		
		foreach($_POST as $key => $val) {
			if( strpos($key, 'st_') !== 0 )
				continue;
			
			fwrite($fp, '$var[\''.$key.'\'] = "'.$val.'";'.PHP_EOL);
		}
			
		// 첨부파일 처리
		foreach($_FILES as $key => $val) {
			$attach_file = $var_path.$files_dir.'/'.$val['name'];
			if( file_exists($attach_file) )
				@unlink($attach_file);
			else {
				@mkdir(dirname($attach_file), G5_DIR_PERMISSION);
				@chmod(dirname($attach_file), G5_DIR_PERMISSION);				
			}			
			
            move_uploaded_file($val['tmp_name'], $attach_file);
            chmod($attach_file, 0755);			
            //chmod($attach_file, G5_FILE_PERMISSION);  // 이따금씩 pcfg_openfile: unable to check htaccess file, ensure it is readable,... 발생하여 403 (Forbidden) 오류발생 원인... 흠!!
			
			if( file_exists($attach_file) ) {
				fwrite($fp, '$var[\''.$key.'\'] = "'.$val['name'].'";'.PHP_EOL);
			}
		}
		fclose($fp);
	}	
}