<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$connect_skin_url.'/style.css">', 0);
?>


<div id="st-basic">
	<div class="page-header">
		<h3 class="title">현재접속자</h3>
	</div>
	
	
    <table class="table table-hover">
    <thead>
    <tr>
        <th scope="col" class="num hidden-xs-v">번호</th>
        <th scope="col" class="name">이름</th>
        <th scope="col">위치</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i<count($list); $i++) {
        //$location = conv_content($list[$i]['lo_location'], 0);
        $location = $list[$i]['lo_location'];
        // 최고관리자에게만 허용
        // 이 조건문은 가능한 변경하지 마십시오.
        if ($list[$i]['lo_url'] && $is_admin == 'super') $display_location = "<a href=\"".$list[$i]['lo_url']."\">".$location."</a>";
        else $display_location = $location;
    ?>
        <tr>
            <td class="num hidden-xs-v"><?=$list[$i]['num'] ?></td>
            <td class="name"><?=$list[$i]['name'] ?></td>
            <td><?=$display_location ?></td>
        </tr>
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"3\" class=\"empty_table\">현재 접속자가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>	
</div>
