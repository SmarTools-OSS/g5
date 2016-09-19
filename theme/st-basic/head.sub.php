<?php if (!defined('_GNUBOARD_')) exit;
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함

$ST = ST::get_instance();
$begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | ".$config['cf_title'];
}

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/

// 각 서브페이지에 헤더영역(Navbar) 출력여부 설정
$is_header = false;

// - 로그인/패스워드 찾기 페이지
if( ST::has_active_url(ST_LOGIN_URL) or ST::has_active_url(ST_FINDPWD_URL) )
	$is_header = true;

// - 게시판 비밀번호 입력 페이지 (댓글관련 포함) 
if( ST::has_active_url(G5_BBS_URL.'/password.php?w=') )
	$is_header = true;

// - 마이페이지
if( ST::has_active_url(ST_MYPAGE_URL) )
	$is_header = true;

// - 정보설정 페이지
if( ST::has_active_url(ST_SETTING_URL) )
	$is_header = true;
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?=$ST->get_head_codes()?>
		
		<!-- Default styles for this theme -->
		<title><?=$g5_head_title; ?></title>
		<link rel="stylesheet" href="<?=G5_THEME_CSS_URL?>/default.css">
		
		<?php
		$st_navbar_color_set = $ST->theme->get('st_navbar_color_set');
		$css_file = G5_THEME_PATH.'/css/colors/'.$st_navbar_color_set.'.css';
		
		if( file_exists($css_file) ) { 
		?>
		<!-- Color-set styles for this theme -->
		<link rel="stylesheet" href="<?=G5_THEME_CSS_URL?>/colors/<?=$st_navbar_color_set?>.css">
		<?php } ?>		
		
		<?php if( is_mobile() and file_exists(G5_THEME_PATH.'/css/mobile.css') ) { ?>
		<!-- Mobile-only styles for this theme -->
		<link rel="stylesheet" href="<?=G5_THEME_CSS_URL?>/mobile.css">
		<?php } ?>
		
		<?php if( file_exists(G5_THEME_PATH.'/css/style.css') ) { ?>
		<!-- User custom styles -->
		<link rel="stylesheet" href="<?=G5_THEME_CSS_URL?>/style.css">
		<?php } ?>		
		
		<!-- G5 JS framework -->
		<script>
		// 자바스크립트에서 사용하는 전역변수 선언
		var g5_url       = "<?=G5_URL ?>";
		var g5_bbs_url   = "<?=G5_BBS_URL ?>";
		var g5_is_member = "<?=isset($is_member)?$is_member:''; ?>";
		var g5_is_admin  = "<?=isset($is_admin)?$is_admin:''; ?>";
		var g5_is_mobile = "<?=G5_IS_MOBILE ?>";
		var g5_bo_table  = "<?=isset($bo_table)?$bo_table:''; ?>";
		var g5_sca       = "<?=isset($sca)?$sca:''; ?>";
		var g5_editor    = "<?=($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
		var g5_cookie_domain = "<?=G5_COOKIE_DOMAIN ?>";
		</script>
		<script src="<?=G5_JS_URL ?>/common.js"></script>
		<script src="<?=G5_JS_URL ?>/wrest.js"></script>
	
		<?php
		if( !defined('G5_IS_ADMIN') and $config['cf_add_script'] ) {
			echo '<!-- Additional JS -->'.PHP_EOL;
			echo $config['cf_add_script'];
		}
		?>
	</head>
	<body id="st-body">
		<?php if( $is_header )	include_once G5_THEME_PATH.'/head.php'?>
		