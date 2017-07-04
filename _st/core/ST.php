<?php if (!defined('_GNUBOARD_')) exit;

define('ST_VER', '5.2.9.6');
define('ST_VER_DATE', '2017.07.04');

require_once ST_PATH.'/helpers/st_helper.php';
require_once 'ST_Config.php';
require_once 'ST_Theme.php';


// 싱글톤 객체 생성
class ST_Core {
	public $config, $theme;
	
    private function __clone() {}	
    private static $_instance = null;
    public static function get_instance() {
        if( !is_object(self::$_instance) )
            self::$_instance = new ST_Core();
		
        return self::$_instance;
    }
	
	
    private function __construct() {
		$this->config = new ST_Config();
		$this->theme = new ST_Theme();
	}
	
	
	public function init_access() {
		global $member;
				
		try {
			if( $this->config->get('st_use_join') and ST::has_active_url(ST_JOIN_URL) )
				throw new Exception(trim($this->config->get('st_use_join_msg')));			
			
			if( $this->config->get('st_use_mypage') and ST::has_active_url(ST_MYPAGE_URL) )
				throw new Exception(trim($this->config->get('st_use_mypage_msg')));			
			
			if( $this->config->get('st_use_new') and ST::has_active_url(G5_BBS_URL.'/new') ) {
				if( (int)$member['mb_level'] < (int)$this->config->get('st_use_new') )
					throw new Exception(trim($this->config->get('st_use_new_msg')));	
			}
			
			if( $this->config->get('st_use_connect') and ST::has_active_url(G5_BBS_URL.'/current_connect') ) {
				if( (int)$member['mb_level'] < (int)$this->config->get('st_use_connect') )
					throw new Exception(trim($this->config->get('st_use_connect_msg')));	
			}		
			
			if( $this->config->get('st_use_faq') and ST::has_active_url(G5_BBS_URL.'/faq') ) {
				if( (int)$member['mb_level'] < (int)$this->config->get('st_use_faq') )
					throw new Exception(trim($this->config->get('st_use_faq_msg')));	
			}				
			
			if( $this->config->get('st_use_qa') and ST::has_active_url(G5_BBS_URL.'/qa') ) {
				if( (int)$member['mb_level'] < (int)$this->config->get('st_use_qa') )
					throw new Exception(trim($this->config->get('st_use_qa_msg')));	
			}				
			
			if( $this->config->get('st_use_search') and ST::has_active_url(G5_BBS_URL.'/search') ) {
				if( (int)$member['mb_level'] < (int)$this->config->get('st_use_search') )
					throw new Exception(trim($this->config->get('st_use_search_msg')));	
			}
			
		} catch(Exception $e) {
			$msg = $e->getMessage()? $e->getMessage(): '올바르지 않은 접근입니다.\n지원여부 및 접속권한 확인 후, 다시 시도해 주십시요.';
			alert($msg, G5_URL);
		}
	}
	
	
	public function init_menus() {
		global $g5, $is_admin;
		
		$me_display = "me_use = '1'";
		if( $is_admin == 'super' )
			$me_display = "me_use >= '1'";
					
		$g5['me'] = array(); // 메뉴 배열
		$g5['me_active'] = NULL; // 현재 활성화된 메뉴 객체

		$sql = " select *
					from {$g5['menu_table']}
					where {$me_display}
					  and length(me_code) = '2'
					order by me_order, me_id ";
		$result = sql_query($sql, false);

		for ($i=0; $row=sql_fetch_array($result); $i++) {
			$g5['me'][$i] = $row;
			$is_active = ST::has_active_url($row['me_link'], ' active');
			if( $is_active )	$g5['me_active'] = $row;
			
			$sql2 = " select *
						from {$g5['menu_table']}
						where {$me_display}
						  and length(me_code) = '4'
						  and substring(me_code, 1, 2) = '{$row['me_code']}'
						order by me_order, me_id ";
			$result2 = sql_query($sql2);

			$g5['me'][$i]['sub_menus'] = array();
			for ($j=0; $row2=sql_fetch_array($result2); $j++) {
				$g5['me'][$i]['sub_menus'][$j] = $row2;
				
				// 가능한 하위 메뉴가 선택되도록 활서오하 메뉴 재검색
				$is_active = ST::has_active_url($row2['me_link'], ' active');
				if( $is_active )	$g5['me_active'] = $row2;
				

				$sql3 = " select *
							from {$g5['menu_table']}
							where {$me_display}
							  and length(me_code) = '6'
							  and substring(me_code, 1, 4) = '{$row2['me_code']}'
							order by me_order, me_id ";
				$result3 = sql_query($sql3);
			
				$g5['me'][$i]['sub_menus'][$j]['sub_menus'] = array();
				while ($row3 = sql_fetch_array($result3)) {
					$g5['me'][$i]['sub_menus'][$j]['sub_menus'][] = $row3;
				
					// 가능한 하위 메뉴가 선택되도록 활서오하 메뉴 재검색
					$is_active = ST::has_active_url($row3['me_link'], ' active');
					if( $is_active )	$g5['me_active'] = $row3;					
				}
			}
		}		
	}	
	
	
	public function get_head_codes() {
		global $config;
		
		$head = $this->get_meta_tags();
		$head .= $this->get_web_fonts();
		$head .= $this->get_css();
		$head .= $this->get_jquery();
		$head .= $this->get_javascript();
		return $head;
	}	
	
	
	protected function get_meta_tags() {
		global $config, $g5, $g5_head_title;

		$st_meta_title = $this->config->get('st_meta_title')? $this->config->get('st_meta_title'): $g5_head_title;
		$st_meta_description = $this->config->get('st_meta_description');
		$st_meta_keywords = $this->config->get('st_meta_keywords');
		$st_meta_author = $this->config->get('st_meta_author');
		$st_meta_robots = $this->config->get('st_meta_robots');
		$st_meta_image = $this->config->get('st_meta_image');
			
		if( !defined('_INDEX_') ) {
			$st_meta_title = $g5['me_active']['me_meta_title']? $g5['me_active']['me_meta_title']: $g5_head_title;
			$st_meta_description = $g5['me_active']['me_meta_description']? $g5['me_active']['me_meta_description']: $st_meta_description;
			$st_meta_keywords = $g5['me_active']['me_meta_keywords']? $g5['me_active']['me_meta_keywords']: $st_meta_keywords;
			$st_meta_robots = $g5['me_active']['me_meta_robots']? $g5['me_active']['me_meta_robots']: $st_meta_robots;
			$st_meta_image = $g5['me_active']['me_meta_image'];
		}			
		$g5_head_title = $st_meta_title;
		
		
		$head = '<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1';
		
		if( $this->config->get('st_user_scalable') )
			$head .= ',minimum-scale=1.0,maximum-scale=1.0,user-scalable=no';	
		$head .= '">'.PHP_EOL;
		
		$head .= '<meta name="title" content="'.$st_meta_title.'">'.PHP_EOL;				
		if( $st_meta_description ) $head .= '<meta name="description" content="'.$st_meta_description.'">'.PHP_EOL;
		if( $st_meta_keywords ) $head .= '<meta name="keywords" content="'.$st_meta_keywords.'">'.PHP_EOL;
		if( $st_meta_robots ) $head .= '<meta name="robots" content="'.$st_meta_robots.'">'.PHP_EOL;
		if( $st_meta_author ) $head .= '<meta name="author" content="'.$st_meta_author.'">'.PHP_EOL;
		$head .= '<meta name="generator" content="SmarTools Builder for G5/YC5">'.PHP_EOL;		

		$head .= '<meta property="og:type" content="website">'.PHP_EOL;
		$head .= '<meta property="og:title" content="'.$st_meta_title.'">'.PHP_EOL;
		if( $st_meta_description ) $head .= '<meta property="og:description" content="'.$st_meta_description.'">'.PHP_EOL;
		if( $st_meta_image ) $head .= '<meta property="og:image" content="'.$st_meta_image.'">'.PHP_EOL;
		
		$head .= '<meta name="twitter:card" content="summary">'.PHP_EOL;
		$head .= '<meta name="twitter:title" content="'.$st_meta_title.'">'.PHP_EOL;
		if( $st_meta_description ) $head .= '<meta name="twitter:description" content="'.$st_meta_description.'">'.PHP_EOL;
		if( $st_meta_image ) $head .= '<meta name="twitter:image" content="'.$st_meta_image.'">'.PHP_EOL;

		if( $config['cf_add_meta'] )
			$head .= $config['cf_add_meta'].PHP_EOL;		
		
		return $head;
	}
	
	
	protected function get_web_fonts() {
		$head = '';
	
		// 나눔 고딕 (Nanum Gothic)
		if( $this->config->get('st_wf_nanumG') == 'cdn-gf' )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css">'.PHP_EOL;
		elseif( $this->config->get('st_wf_nanumG') == 'cdn-jsd' )
			$head .= '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/font-nanum/1.0/nanumgothic/nanumgothic.css">'.PHP_EOL;
		
		// 나눔 바른 고딕 (Nanum Barun Gothic)
		if( $this->config->get('st_wf_nanumBG') == 'cdn-jsd' )
			$head .= '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/font-nanum/1.0/nanumbarungothic/nanumbarungothic.css">'.PHP_EOL;		
		
		// 나눔 고딕 코딩 (Nanum Gothic Coding)
		if( $this->config->get('st_wf_nanumGC') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/nanumgothiccoding.css">'.PHP_EOL;

		// 나눔 명조 (Nanum Myeongjo)
		if( $this->config->get('st_wf_nanumM') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/nanummyeongjo.css">'.PHP_EOL;
		
		// 나눔 펜 스크립트 (Nanum Pen Script)
		if( $this->config->get('st_wf_nanumPS') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/nanumpenscript.css">'.PHP_EOL;
	
		// 제주 고딕 (Jeju Gothic)
		if( $this->config->get('st_wf_jejuG') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/jejugothic.css">'.PHP_EOL;
	
		// 제주 한라산 (Jeju Hallasan)
		if( $this->config->get('st_wf_jejuH') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/jejuhallasan.css">'.PHP_EOL;
		
		// 제주 명조 (Jeju Myeongjo)
		if( $this->config->get('st_wf_jejuM') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/jejumyeongjo.css">'.PHP_EOL;
	
		// KoPub 바탕 (KoPub Batang)
		if( $this->config->get('st_wf_kopubB')=='cdn-gf' )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/kopubbatang.css">'.PHP_EOL;
		elseif( $this->config->get('st_wf_kopubB') == 'cdn-jsd' )
			$head .= '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/font-kopub/1.0/kopubbatang.css">'.PHP_EOL;		
		
		// KoPub 돋움 (KoPub Dotum)
		if( $this->config->get('st_wf_kopubD')=='cdn-jsd' )
			$head .= '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/font-kopub/1.0/kopubdotum.css">'.PHP_EOL;			
		
		// 본고딕 (Noto Sans KR)
		if( $this->config->get('st_wf_notosansKR')=='cdn-gf' )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/notosanskr.css">'.PHP_EOL;
		elseif( $this->config->get('st_wf_notosansKR')=='cdn-jsd' )
			$head .= '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/font-notosans-kr/1.0.0-v1004/NotoSansKR-full.css">'.PHP_EOL;
		
		// 한나체 (Hanna)
		if( $this->config->get('st_wf_hanna') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/hanna.css">'.PHP_EOL;
		
		// Open Sans
		if( $this->config->get('st_wf_engOpenSans') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans">';
		
		// Josefin Slab (Josefin Slab)
		if( $this->config->get('st_wf_engJosefinS') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Josefin+Slab">';
		
		// Arvo (Arvo)
		if( $this->config->get('st_wf_engJosefinS') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Arvo">';
		
		// Lato (Lato)
		if( $this->config->get('st_wf_engLato') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato">';
		
		// Vollkorn (Vollkorn)
		if( $this->config->get('st_wf_engVollkorn') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Vollkorn">';
		
		// Abril Fatface (Abril Fatface)
		if( $this->config->get('st_wf_engAbril') )
			$head .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Abril+Fatface">';				
		
		return ($head)? '<!-- Web Fonts -->'.PHP_EOL.$head: '';
	}
	
	
	protected function get_css() {
		$head = '';
		
		if( $this->config->get('st_bootstrap_ver') ) {
		$head .= '<!-- Bootstrap -->
		<link rel="stylesheet" href="'.ST_URL.'/assets/bootstrap/'.$this->config->get('st_bootstrap_ver').'/css/bootstrap.min.css">
		';
		}
		
		if( $this->config->get('st_fa_ver') ) {
		$head .= '<!-- Font Awesome -->
		<link rel="stylesheet" href="'.ST_URL.'/assets/font-awesome/'.$this->config->get('st_fa_ver').'/css/font-awesome.min.css">
		';
		}
		
		if( $this->config->get('st_jquery_ui_ver') ) {
		$head .= '<!-- jQuery UI -->
		<link rel="stylesheet" href="'.ST_URL.'/assets/jquery-ui/'.$this->config->get('st_jquery_ui_ver').'/jquery-ui.min.css">
		<link rel="stylesheet" href="'.ST_URL.'/assets/jquery-ui/'.$this->config->get('st_jquery_ui_ver').'/jquery-ui.theme.min.css">
		';	
		}			

		$head .= '<!-- ST CSS framework for Bootstrap 3.x -->
		<link rel="stylesheet" href="'.ST_URL.'/assets/smartools/default.css?ver='.G5_CSS_VER.'">
		';
		
		if( is_mobile() ) {
		$head .= '<!-- ST CSS framework for mobile only -->
		<link rel="stylesheet" href="'.ST_URL.'/assets/smartools/mobile.css?ver='.G5_CSS_VER.'">
		';
		}
		return $head;
	}		
	
	
	protected function get_jquery() {
		$head = '';

		if( $this->config->get('st_jquery_ver') ) {
		$head .= '<!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
		<script src="'.ST_URL.'/assets/jquery/'.$this->config->get('st_jquery_ver').'/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="'.ST_URL.'/assets/bootstrap/'.$this->config->get('st_bootstrap_ver').'/js/bootstrap.min.js"></script>
		';			
		}
		
		if( $this->config->get('st_jquery_ui_ver') ) {
		$head .= '<!-- jQuery UI -->
		<script src="'.ST_URL.'/assets/jquery-ui/'.$this->config->get('st_jquery_ui_ver').'/jquery-ui.min.js"></script>
		';	
		}
		return $head;
	}
	
	
	protected function get_javascript() {		
		$head = '		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->		
		';		
			
		if( $this->config->get('st_placeholders_ver') ) {
		$head .= '
		<!--[if lte IE 9]>
		<script src="'.ST_URL.'/assets/Placeholders.js/'.$this->config->get('st_placeholders_ver').'/placeholders.min.js"></script>
		<![endif]-->
		';	
		}
		
		if( (int)$this->config->get('st_ie_warning') and (($this->config->get('st_ie_warning_index') and defined('_INDEX_')) or !$this->config->get('st_ie_warning_index')) ) {
		$head .= '
		<!--[if lte IE '.$this->config->get('st_ie_warning').']>
		<script>
		window.onload = function() { 
			var ans = confirm("이 웹사이트는 최소한 Internet Explorer '.($this->config->get('st_ie_warning')+1).' 이상에서 원활하게 동작합니다.\n\nInternet Explorer를 최신버전으로 업데이트 하시거나, 구글 크롬(또는 파이어폭스) 등의 최신 웹브라우저를 이용하시면 보다 쾌적한 웹서핑이 가능합니다.\n지금 구글 크롬을 설치해 보시겠습니까?"); 
			if( ans ) window.document.location = "http://www.google.com/chrome";
		}		
		</script>
		<![endif]-->
		';
		}
		
		$head .= '		
		<!-- ST JS framework -->
		<script src="'.ST_URL.'/assets/smartools/default.js?ver='.G5_JS_VER.'"></script>
		';
		return $head;
	}	
}