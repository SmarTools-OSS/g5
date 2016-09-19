<?php
$sub_menu = "950300";
include_once('./_common.php');

check_demo();

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

// 메뉴 업데이트
$sql = " update {$g5['menu_table']}
			set me_meta_title = '{$_POST['me_meta_title']}',
				me_meta_description = '{$_POST['me_meta_description']}',
				me_meta_keywords = '{$_POST['me_meta_keywords']}',
				me_meta_robots = '{$_POST['me_meta_robots']}',
				me_meta_image = '{$_POST['me_meta_image']}',
				me_addinfo = '{$_POST['me_addinfo']}'
			where me_id = {$_POST['me_id']}";
sql_query($sql);
	
alert('수정되었습니다.', './menu_option.php?me_id='.$_POST['me_id']);
?>
