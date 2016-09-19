<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);

// 스크랩 개수 구함
$sql_common = " from {$g5['scrap_table']} where mb_id = '{$member['mb_id']}' ";
$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$mb_scrap = $row['cnt'];
?>


<div id="st-ol">
	<strong class="mb_name"><?=ST::get_mb_icon($member['mb_id'])?> <?=$nick ?></strong><small>님, 환영합니다!</small>

	 <?php if ($is_admin == 'super' || $is_auth) {  ?>
	 <hr style="margin: 10px 0">
	 <div class="input-group input-group-sm">
		<a href="<?=G5_ADMIN_URL ?>" target="_blank" class="btn btn-sm btn-danger btn-block"><i class="fa fa-cog" aria-hidden="true"></i> 관리자 모드</a>
	</div>
	 <?php }  ?>
	
	<hr style="margin: 10px 0">
	<div class="input-group input-group-sm">
		<div class="btn-group btn-group-justified">
			<div class="btn-group btn-group-sm">
				<a href="<?=G5_BBS_URL ?>/memo.php" target="_blank" id="ol_after_memo" class="btn btn-sm btn-default win_memo">
					새 쪽지<br>
					<strong><?=$memo_not_read?>통</strong>
				</a>
			</div>
			<div class="btn-group btn-group-sm">
				<a href="<?=G5_BBS_URL?>/point.php" target="_blank" class="btn btn-sm btn-default win_point">
					포인트<br>
					<strong><?=$point ?>P</strong>
				</a>
			</div>
			<div class="btn-group btn-group-sm">
				<a href="<?=G5_BBS_URL?>/scrap.php" target="_blank" class="btn btn-sm btn-default win_scrap">
					스크랩<br>
					<strong><?=number_format($mb_scrap)?>건</strong>
				</a>
			</div>		
		</div>
	</div>
	
	<hr style="margin: 10px 0">
	<div class="btn-group btn-group-justified">
		<div class="btn-group btn-group-sm">
			<a href="<?=ST_SETTING_URL ?>" class="btn btn-sm btn-primary">정보수정</a>
		</div>
		<div class="btn-group btn-group-sm">
			<a href="<?=ST_LOGOUT_URL ?>" class="btn btn-sm btn-primary">로그아웃</a>	
		</div>
	</div>
</div>
