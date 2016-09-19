<?php if (!defined('_GNUBOARD_')) exit;


class ST {	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// ST Core 헬퍼
	public static function get_instance() {
		return ST_Core::get_instance();
	}


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// UI 헬퍼
	public static function is_active_url($url, $active_code=' class="active"', $query_string = true) {
		if( ST::get_uri($url, $query_string) ==  ST::current_uri($query_string) )
			return $active_code;
		return '';
	}
	
	public static function has_active_url($url, $active_code=' class="active"', $query_string = true) {
		$uri = ST::get_uri($url, $query_string);
		$cur_uri = ST::current_uri($query_string);
		if( !$uri or !$cur_uri )
			return '';
		
		$pos = strpos($cur_uri, $uri);		
		if( $pos !== false and $pos == 0 )
			return $active_code;
		
		// - 게시판 글쓰기/수정 페이지
		$g5_uri = preg_replace('/w=(\w+)&bo_table=/', 'bo_table=', $cur_uri);
		$g5_uri = str_replace('/bbs/write.php?bo_table=', '/bbs/board.php?bo_table=', $g5_uri);
		$pos = strpos($g5_uri, $uri);
		if( $pos !== false and $pos == 0 )
			return $active_code;		
		
		// - 게시판 비밀번호 페이지 (게시물, 댓글 등 여러 경우의 w 파라미터에 대해 일괄 처리)
		$g5_uri = preg_replace('/w=(\w+)&bo_table=/', 'w=s&bo_table=', $cur_uri);
		$g5_uri = str_replace('/bbs/password.php?w=s&bo_table=', '/bbs/board.php?bo_table=', $g5_uri);		
		$pos = strpos($g5_uri, $uri);
		if( $pos !== false and $pos == 0 )
			return $active_code;				
		
		// - 회원가입 메뉴: 회원가입폼/가입결과/인증메일 재전송/변경 페이지
		$g5_uri = preg_replace('/\/bbs\/register_(\w+).php/', '/bbs/register.php', $cur_uri);
		$pos = strpos($g5_uri, $uri);
		if( $pos !== false and $pos == 0 )
			return $active_code;
		
		// - QnA 쓰기
		$g5_uri = str_replace('/bbs/qawrite.php', '/bbs/qalist.php', $cur_uri);		
		$pos = strpos($g5_uri, $uri);
		if( $pos !== false and $pos == 0 )
			return $active_code;			
		
		// - QnA 읽기
		$g5_uri = str_replace('/bbs/qaview.php', '/bbs/qalist.php', $cur_uri);		
		$pos = strpos($g5_uri, $uri);
		if( $pos !== false and $pos == 0 )
			return $active_code;
		
		return '';
	}	
	
	public static function get_mb_icon($mb_id, $list_name = NULL) 
	{
		global $config;
		global $g5;
		global $bo_table, $sca, $is_admin, $member;

		$mb_icon = '<i class="fa fa-tint" title="비회원"></i>';
		if( $mb_id ) {
			if( $config['cf_use_member_icon'] ) {
				if( !$list__name ) {
					$mb_dir = substr($mb_id,0,2);
					$icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_id.'.gif';

					if (file_exists($icon_file)) {
						$icon_file_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb_id.'.gif';
						$list_name = '<img src="'.$icon_file_url.'" width="'.$config['cf_member_icon_width'].'" height="'.$config['cf_member_icon_height'].'" class="mb_icon">';
					}		
				}		
				
				preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $list_name, $mb_icon);
				if( $mb_icon )
					$mb_icon = $mb_icon[0].' width="'.$config['cf_member_icon_width'].'" height="'.$config['cf_member_icon_height'].'" class="mb_icon">';
				else
					$mb_icon = '<i class="fa fa-user" title="회원"></i>';			
			}
			else {
				$mb_icon = '<i class="fa fa-user" title="회원"></i>';
			}
		}
		return $mb_icon;
	}
	
	public static function get_mb_menu($mb_id, $name='', $email='', $homepage='')
	{
		global $config;
		global $g5;
		global $bo_table, $sca, $is_admin, $member;

		$email_enc = new str_encrypt();
		$email = $email_enc->encrypt($email);
		$homepage = set_http(clean_xss_tags($homepage));

		$name     = get_text($name, 0, true);
		$email    = get_text($email);
		$homepage = get_text($homepage);

		$tmp_menu = '<ul class="dropdown-menu mb_menu">'.PHP_EOL;
		if($mb_id)
			$tmp_menu .= "<li><a href=\"".G5_BBS_URL."/memo_form.php?me_recv_mb_id=".$mb_id."\" onclick=\"win_memo(this.href); return false;\">쪽지보내기</a></li>\n";
		if($email)
			$tmp_menu .= "<li><a href=\"".G5_BBS_URL."/formmail.php?mb_id=".$mb_id."&amp;name=".urlencode($name)."&amp;email=".$email."\" onclick=\"win_email(this.href); return false;\">메일보내기</a></li>\n";
		if($homepage)
			$tmp_menu .= "<li><a href=\"".$homepage."\" target=\"_blank\">홈페이지</a></li>\n";
		if($mb_id)
			$tmp_menu .= "<li><a href=\"".G5_BBS_URL."/profile.php?mb_id=".$mb_id."\" onclick=\"win_profile(this.href); return false;\">자기소개</a></li>\n";
		if($bo_table) {
			if($mb_id)
				$tmp_menu .= "<li><a href=\"".G5_BBS_URL."/board.php?bo_table=".$bo_table."&amp;sca=".$sca."&amp;sfl=mb_id,1&amp;stx=".$mb_id."\">아이디로 검색</a></li>\n";
			else
				$tmp_menu .= "<li><a href=\"".G5_BBS_URL."/board.php?bo_table=".$bo_table."&amp;sca=".$sca."&amp;sfl=wr_name,1&amp;stx=".$name."\">이름으로 검색</a></li>\n";
		}
		if($mb_id)
			$tmp_menu .= "<li><a href=\"".G5_BBS_URL."/new.php?mb_id=".$mb_id."\">전체게시물</a></li>\n";
		if($is_admin == "super" && $mb_id) {
			$tmp_menu .= "<li><a href=\"".G5_ADMIN_URL."/member_form.php?w=u&amp;mb_id=".$mb_id."\" target=\"_blank\">회원정보변경</a></li>\n";
			$tmp_menu .= "<li><a href=\"".G5_ADMIN_URL."/point_list.php?sfl=mb_id&amp;stx=".$mb_id."\" target=\"_blank\">포인트내역</a></li>\n";
		}		
		$tmp_menu .= '</ul>'.PHP_EOL;

		return $tmp_menu;
	}	
	
	public static function get_paging($write_pages, $cur_page, $total_page, $url, $add="")
	{
		$url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

		$str = '';
		if ($cur_page > 1) {
			$str .= '<a href="'.$url.'1'.$add.'" class="btn btn-sm btn-default btn-first" title="처음"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>'.PHP_EOL;
		}

		$start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
		$end_page = $start_page + $write_pages - 1;

		if ($end_page >= $total_page) $end_page = $total_page;

		if ($start_page > 1) $str .= '<a href="'.$url.($start_page-1).$add.'" class="btn btn-sm btn-default btn-prev">이전</a>'.PHP_EOL;

		if ($total_page > 1) {
			for ($k=$start_page;$k<=$end_page;$k++) {
				if ($cur_page != $k)
					$str .= '<a href="'.$url.$k.$add.'" class="btn btn-sm btn-default btn-prev">'.$k.'<span class="sound_only">페이지</span></a>'.PHP_EOL;
				else
					$str .= '<span class="sound_only">열린</span><span class="btn btn-sm btn-default btn-current disabled"><strong>'.$k.'</strong></span><span class="sound_only">페이지</span>'.PHP_EOL;
			}
		}

		if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).$add.'" class="btn btn-sm btn-default btn-next">다음</a>'.PHP_EOL;

		if ($cur_page < $total_page) {
			$str .= '<a href="'.$url.$total_page.$add.'" class="btn btn-sm btn-default btn-last" title="맨끝"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>'.PHP_EOL;
		}

		if ($str)
			return '<nav class="st-pagination">'.$str.'</nav>';
		else
			return '';
	}	
	
	public static function editor_html($id, $content)
	{
		return "<textarea id=\"$id\" name=\"$id\" style=\"width:100%; min-height:200px; resize:vertical;\" maxlength=\"65536\" class=\"form-control\">$content</textarea>";
	}

	// textarea 로 값을 넘긴다. javascript 반드시 필요
	public static function get_editor_js($id)
	{
		return "var {$id}_editor = document.getElementById('{$id}');\n";
	}

	//  textarea 의 값이 비어 있는지 검사
	public static function chk_editor_js($id)
	{
		return "if (!{$id}_editor.value) { alert(\"내용을 입력해 주십시오.\"); {$id}_editor.focus(); return false; }\n";
	}
	
	public static function isIE($max_ver) {
		if( preg_match('/(?i)msie [5-'.$max_ver.']/',$_SERVER['HTTP_USER_AGENT']) )
			return true;
	}
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// URL 핸들링 관련 헬퍼
	
	/**
	 * 특정 URL에서 URI를 추출한다.
	 *
	 * @param	string	$url				쿼리 스트링 포함여부
	 * @param	string	$query_string	쿼리 스트링 포함여부
	 * @return	string URI 문자열
	 */	
	public static function get_uri($url, $query_string = true) {
		$uri = parse_url($url, PHP_URL_PATH);
		if( $query_string ) {
			$query = parse_url($url, PHP_URL_QUERY);
			$uri .= ($query)? '?'.$query: '';
		}			
		return $uri;
	}		
	
	/**
	 * 현재 페이지의 URI를 되돌린다.
	 *
	 * @param	string	$query_string	쿼리 스트링 포함여부
	 * @return	string URI 문자열
	 */	
	public static function current_uri($query_string = true) {
		return $query_string? $_SERVER['REQUEST_URI']: strtok($_SERVER["REQUEST_URI"], '?');
	}	
	
	/**
	 * 현재 페이지의 URL을 되돌린다.
	 *
	 * @param	string	$query_string	쿼리 스트링 포함여부
	 * @return	string URL 문자열
	 */	
	public static function current_url($query_string = true) {
		$protocol = isset($_SERVER["HTTPS"])? 'https://' : 'http://';
		return $protocol.$_SERVER['HTTP_HOST'].ST::current_uri($query_string);
	}
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// 문자열 처리 헬퍼
	public static function get_addinfo($addinfo, $delimiter1 = '|', $delimiter2 = '==') {
		$arrAddInfo = array();
		foreach (explode($delimiter1, trim($addinfo)) as $pair) {
			list($_key, $_value) = explode($delimiter2, trim($pair));
			$arrAddInfo[trim($_key)] = trim($_value);
		}
		return $arrAddInfo;		
	}
	
	public static function get_hidden_email_addr($email_addr, $ch = '*') {
		$email = explode('@', $email_addr);
		$len = floor(strlen($email[0])/2);
		return substr($email[0], 0, $len).str_repeat($ch, $len).'@'.$email[1];
	}	
	
	public static function get_hidden_hp_num($hp_num, $ch = 'x') {
		return preg_replace('/([0-9]+)-([0-9]+)-([0-9]+)/', '\\1-'.$ch.$ch.$ch.$ch.'-\\3', $hp_num);
	}
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// 파일시스템 관련 헬퍼
	
	/**
	 * 특정 경로에서 디렉토리를 검색한다.
	 *
	 * @param	string		$path				검색할 경로
	 * @param	string		$recursion		순환검색 여부
	 * @return	array		디렉토리 목록 배열
	 */	
	public static function scan_dir($path, $recursion = FALSE ) {
		$res = array(); 
		$chdir = scandir($path); 
		foreach( $chdir as $key => $value ) 
		{ 
			if( !in_array($value,array('.', '..')) ) 
			{
				$pathname = $path.DIRECTORY_SEPARATOR.$value;
				if( is_dir($pathname) ) 
				{ 
					if( $recursion )
						$res[$value] = NC::scan_dir($pathname, $recursion);
					else
						$res[] = $value;
				}
			} 
		} 
		return $res;
	}
	
	/**
	 * 특정 경로에서 파일을 검색한다.
	 *
	 * @param	string		$path				검색할 경로
	 * @param	string		$file_ext			대상 파일 확장자 (예 - '.php')
	 * @param	string		$recursion		순환검색 여부
	 * @return	array		파일목록 배열
	 */	
	public static function scan_files($path, $file_ext = NULL, $recursion = FALSE ) {
		$res = array(); 
		$chdir = scandir($path); 
		foreach( $chdir as $key => $value )  
		{
			$pathname = $path.DIRECTORY_SEPARATOR.$value;
			if( is_dir($pathname) ) 
			{ 
				if( $recursion )
					$res[$value] = NC::scan_dir($pathname, $file_ext, $recursion);
			}
			else 
			{
				if( $file_ext ) {
					if( $file_ext == '.'.pathinfo($pathname, PATHINFO_EXTENSION) )
						$res[] = $value;
				}				
				else {
					$res[] = $value;
				}
			}
		} 
		return $res;
	}
	
	/**
	 * 경로명에 해당하는 디렉토리를 생성한다.
	 *
	 * @param	string		$path			생성할 디렉토리 전체 경로명
	 * @param	string		$chmod		생성된 디렉토리에 적용할 권한
	 * @return	boolean	성공 시 TRUE, 오류 시 FALSE
	 */		
	public static function mkdir($path, $chmod = 0755) {
		if( !file_exists($path) or !is_dir($path) ) {
			$mask = umask(0);
			$res = @mkdir($path, $chmod, TRUE);
			umask($mask);
			return $res;
		}
		@chmod($path, $chmod);
		return TRUE;
	}	
}