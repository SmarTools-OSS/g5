<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-popup" class="st-mbr scrap">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-bookmark" aria-hidden="true"></i> 내 스크랩</h3>
	</div>
	<ul class="page-desc">
		<li>현재 회원님의 스크랩은 <strong><?=number_format(count($list))?>건</strong> 입니다.
	</ul>
	
	
	<ul class="nav nav-tabs">
		<li class="active bold"><a href="javascript:void();">스크랩 목록</a></li>
	</ul>		
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col" class="num">번호</th>
            <th scope="col" class="board">게시판</th>
            <th scope="col">제목</th>
            <th scope="col" class="date">보관일시</th>
            <th scope="col" class="mgr">삭제</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i=0; $i<count($list); $i++) {  ?>
        <tr>
            <td class="num"><?=$list[$i]['num'] ?></td>
            <td class="board"><a href="<?=$list[$i]['opener_href'] ?>" target="_blank" onclick="opener.document.location.href='<?=$list[$i]['opener_href'] ?>'; return false;"><?=$list[$i]['bo_subject'] ?></a></td>
            <td><a href="<?=$list[$i]['opener_href_wr_id'] ?>" target="_blank" onclick="opener.document.location.href='<?=$list[$i]['opener_href_wr_id'] ?>'; return false;"><?=$list[$i]['subject'] ?></a></td>
            <td class="date"><?=$list[$i]['ms_datetime'] ?></td>
            <td class="mgr"><a href="<?=$list[$i]['del_href'];  ?>" class="btn btn-sm btn-danger" onclick="del(this.href); return false;">삭제</a></td>
        </tr>
        <?php }  ?>

        <?php if ($i == 0) echo "<tr><td colspan=\"5\" class=\"text-center\">자료가 없습니다.</td></tr>";  ?>
        </tbody>
        </table>
    </div>
	
	
	<hr>
	<div class="text-right">
		<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>	
	</div>		
</div>
