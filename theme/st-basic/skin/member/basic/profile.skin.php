<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-popup" class="st-mbr profile">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-user" aria-hidden="true"></i> <?=$g5['title'] ?></h3>
	</div>
	
	
	<table class="table-info" border="0">
	<tr>
		<?php $mb_name = ST::get_mb_icon($mb['mb_id']).' '.$mb['mb_nick']; ?>
		<td class="key">- 닉네임:</td>
		<td><strong><?=$mb_name ?></strong></td>
	</tr>
	<tr>
		<td class="key">- 회원권한:</td>
		<td><strong>Lv <?=$mb['mb_level'] ?></strong></td>
	</tr>
	<tr>
		<td class="key">- 보유포인트:</td>
		<td><strong><?=number_format($mb['mb_point']) ?>P</strong></td>
	</tr>
	<?php if ($mb_homepage) {  ?>
	<tr>
		<td class="key">- 홈페이지:</td>
		<td><strong><a href="<?=$mb_homepage ?>" target="_blank"><?=$mb_homepage ?></a></strong></td>
	</tr>
	<?php }  ?>
	<tr>
		<td class="key">- 회원가입일:</td>
		<td><strong><?=($member['mb_level'] >= $mb['mb_level']) ?  substr($mb['mb_datetime'],0,10) ." (".number_format($mb_reg_after)." 일)" : "알 수 없음";  ?></strong></td>
	</tr>
	<tr>
		<td class="key">- 최종접속일:</td>
		<td><strong><?=($member['mb_level'] >= $mb['mb_level']) ? $mb['mb_today_login'] : "알 수 없음"; ?></strong></td>
	</tr>
	<tr>
		<td class="key">- 자기소개:</td>
		<td></td>
	</tr>
	</table>
	
	<div class="panel panel-default" style="margin-top: 5px;">
		<div class="panel-body">
			<?=$mb_profile ?>
		</div>
	</div>	
	
	
	<hr>
    <div class="actions clearfix">
		<div class="right">
			<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>		
		</div>
	</div>
</div>