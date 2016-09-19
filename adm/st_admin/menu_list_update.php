<?php
$sub_menu = "950300";
include_once('./_common.php');

check_demo();

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

check_admin_token();

// 이전 메뉴정보 삭제
$sql = " delete from {$g5['menu_table']} ";
sql_query($sql);

$group_code = null;
$primary_code = null;
$count = count($_POST['code']);

for ($i=0; $i<$count; $i++)
{
    $_POST = array_map_deep('trim', $_POST);

    $code = $_POST['code'][$i];
    $me_name = $_POST['me_name'][$i];
    $me_link = $_POST['me_link'][$i];

    if(!$code || !$me_name || !$me_link)
        continue;

	$code_len = strlen($code);
	
	// 1단 메뉴 
	if( $code_len == 2 ) {
        $sql = " select MAX(SUBSTRING(me_code,1,2)) as max_me_code
                    from {$g5['menu_table']}
                    where LENGTH(me_code) = '2' ";
        $row = sql_fetch($sql);

        $me_code = base_convert($row['max_me_code'], 36, 10);
        $me_code += 36;
        $me_code = base_convert($me_code, 10, 36);

        $primary_code = $me_code;		
	}
	// 2단 메뉴 
	elseif( $code_len == 4 ) {
		$primary_code = substr($primary_code, 0, 2);		
        $sql = " select MAX(SUBSTRING(me_code,3,2)) as max_me_code
                    from {$g5['menu_table']}
                    where SUBSTRING(me_code,1,2) = '{$primary_code}' ";
        $row = sql_fetch($sql);

        $sub_code = base_convert($row['max_me_code'], 36, 10);
        $sub_code += 36;
        $sub_code = base_convert($sub_code, 10, 36);
		
		$me_code = $primary_code.$sub_code;
        $primary_code = $me_code;		
	}
	// 3단 메뉴
	elseif( $code_len == 6 ) {
		$primary_code = substr($primary_code, 0, 4);		
        $sql = " select MAX(SUBSTRING(me_code,5,2)) as max_me_code
                    from {$g5['menu_table']}
                    where SUBSTRING(me_code,1,4) = '{$primary_code}' ";
        $row = sql_fetch($sql);

        $sub_code = base_convert($row['max_me_code'], 36, 10);
        $sub_code += 36;
        $sub_code = base_convert($sub_code, 10, 36);
		
		$me_code = $primary_code.$sub_code;
        $primary_code = $me_code;		
	}

    // 메뉴 등록
    $sql = " insert into {$g5['menu_table']}
                set me_code = '$me_code',
                    me_name = '$me_name',
                    me_link = '$me_link',
                    me_target = '{$_POST['me_target'][$i]}',
                    me_order = '{$_POST['me_order'][$i]}',
                    me_use = '{$_POST['me_use'][$i]}',
                    me_mobile_use = '{$_POST['me_mobile_use'][$i]}',
                    me_meta_title = '{$_POST['me_meta_title'][$i]}',
                    me_meta_description = '{$_POST['me_meta_description'][$i]}',
                    me_meta_keywords = '{$_POST['me_meta_keywords'][$i]}',
                    me_meta_robots = '{$_POST['me_meta_robots'][$i]}',
                    me_meta_image = '{$_POST['me_meta_image'][$i]}',
                    me_addinfo = '{$_POST['me_addinfo'][$i]}' ";
    sql_query($sql);
}

goto_url('./menu_list.php');
?>
