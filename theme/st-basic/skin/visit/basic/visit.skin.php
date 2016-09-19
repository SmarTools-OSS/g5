<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $is_admin;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$visit_skin_url.'/style.css">', 0);
?>


<section id="st-visit">
	<table border="0">
	<tr>
		<td class="title">접속자집계: </td>
		<td class="tags">
			<div class="subject">오늘</div>
			<div class="count"><?=number_format($visit[1]) ?></div>
			<div class="subject">어제</div>
			<div class="count"><?=number_format($visit[2]) ?></div>
			<br class="visible-xs-v">
			<div class="subject">최대</div>
			<div class="count"><?=number_format($visit[3]) ?></div>
			<div class="subject">전체</div>
			<div class="count"><?=number_format($visit[4]) ?></div>
			<br class="visible-xs-v">
			 <?php if ($is_admin == "super") {  ?><a href="<?=G5_ADMIN_URL ?>/visit_list.php"><i class="fa fa-cog" aria-hidden="true"></i> 상세보기</a><?php } ?>
		</td>	
	</tr>
	</table>
</section>