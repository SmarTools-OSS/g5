<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$mode_str = '';
switch($mode) {
case 'bbs': $mode_str = '게시물'; break;
case 'comment': $mode_str = '댓글'; break;
}

// 회원 아이콘
$mb_icon = ST::get_mb_icon($member['mb_id']);

// 새 쪽지 개수
$sql = " select count(*) as cnt from {$g5['memo_table']} where me_recv_mb_id = '{$member['mb_id']}' and me_read_datetime = '0000-00-00 00:00:00' ";
$row = sql_fetch($sql);
$mb_memo = $row['cnt'];

// 스크랩 개수
$sql_common = " from {$g5['scrap_table']} where mb_id = '{$member['mb_id']}' ";
$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$mb_scrap = $row['cnt'];
?>

<div class="page-header clearfix">
	<h3 class="pull-left title"><span class="title-mypage" onclick="location.href='<?=ST_MYPAGE_URL?>'" style="cursor:pointer">마이페이지</span> <small><?=$mode_str?></small></h3>
	
	<div class="pull-right btn-group btn-group-sm">
		<a class="btn btn-sm btn-default<?=$mode=='bbs'? ' active': ''?>" href="<?=ST_MYPAGE_URL.'?mode=bbs'?>">게시물</a>
		<a class="btn btn-sm btn-default<?=$mode=='comment'? ' active': ''?>" href="<?=ST_MYPAGE_URL.'?mode=comment'?>">댓글</a>
	</div>
</div>
<ul class="page-desc">
	<li>이 곳은 <?=$mb_icon?> <strong><?=$member['mb_name'] ?> (<?=$member['mb_nick'] ?>)</strong> 님을 위한 공간으로, 회원님의 활동내역을 실시간으로 확인하실 수 있습니다.</li>
	<li>회원님의 권한은 <strong>Lv <?=number_format($member['mb_level']) ?></strong> 이며,
		<a href="<?=G5_BBS_URL ?>/memo.php" target="_blank" id="ol_after_memo" class="btn btn-sm btn-default win_memo">새 쪽지: <strong><?=number_format($mb_memo)?>통</strong></a>
		<a href="<?=G5_BBS_URL ?>/point.php" target="_blank" class="btn btn-sm btn-default win_point">포인트: <strong><?=number_format($member['mb_point']) ?>P</strong></a>		
		<a href="<?=G5_BBS_URL ?>/scrap.php" target="_blank" class="btn btn-sm btn-default win_scrap">스크랩: <strong><?=number_format($mb_scrap)?>건</strong></a>
		입니다.
	</li>
</ul>
	