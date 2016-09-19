<?php
$sub_menu = "950200";
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'w');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

check_admin_token();

$res = $ST->theme->write();

goto_url('./theme.php', false);
?>
