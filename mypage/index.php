<?php
include_once('./_common.php');

if ($is_guest)
    alert('회원만 이용하실 수 있습니다.', G5_URL);

$g5['title'] = get_text($member['mb_nick']).' 님의 마이페이지';
include_once(G5_PATH.'/head.sub.php');

$pg_file = $member_skin_path.'/mypage';
$mode = trim($_REQUEST['mode']);
if( $mode ) {
	$pg_file .= '_'.$mode;
}
$pg_file .= '.skin.php';

if( file_exists($pg_file) )
	include_once($pg_file);
else
	include_once($member_skin_path.'/mypage.skin.php');

include_once(G5_PATH.'/tail.sub.php');
?>