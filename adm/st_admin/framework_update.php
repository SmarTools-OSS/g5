<?php
$sub_menu = "950100";
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'w');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

check_admin_token();

$res = $ST->config->write();

goto_url('./framework.php', false);
?>

