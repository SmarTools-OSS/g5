<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// ST 상수 모음 시작
define('ST_URL', G5_URL.'/_st');
define('ST_PATH', G5_PATH.'/_st');
define('ST_DATA_PATH', G5_DATA_PATH.'/_st');
define('ST_DATA_URL', G5_DATA_URL.'/_st');

define('ST_ADMIN_URL', G5_ADMIN_URL);
define('ST_JOIN_URL', G5_BBS_URL.'/register.php');
define('ST_LOGIN_URL', G5_BBS_URL.'/login.php');
define('ST_FINDPWD_URL', G5_BBS_URL.'/password_lost.php');
define('ST_LOGOUT_URL', G5_BBS_URL.'/logout.php');
define('ST_MYPAGE_URL', G5_URL.'/mypage');
define('ST_SETTING_URL', G5_BBS_URL.'/member_confirm.php?url=register_form.php');
define('ST_SEARCH_URL', G5_BBS_URL.'/search.php');

// ST 전용 테이블명
$g5['st_prefix'] = 'st_';
$g5['st_menu'] = $g5['st_prefix'].'menu';


// ST 코어 초기화
require_once ST_PATH.'/core/ST.php';
$ST = ST::get_instance();

// 개발자 옵션 초기화
ini_set("display_errors", $ST->config->get('st_display_errors'));
require_once ST_PATH.'/libraries/FirePHP.php';

FB::info('/extend/_st.extend.php - ST Core initilized!');
FB::log($ST, '- ST Instance: ');

// 접근제어 수행
$ST->init_access();

// 메뉴 초기화
$ST->init_menus();
FB::log($g5['me_active']? $g5['me_active']: 'NULL', '- g5[me_active]: ');
?>