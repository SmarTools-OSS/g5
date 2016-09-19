<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($kind == "recv") {
    $kind_str = "보낸";
    $kind_date = "받은";
}
else {
    $kind_str = "받는";
    $kind_date = "보낸";
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-popup" class="st-mbr">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-envelope" aria-hidden="true"></i> <?=$g5['title'] ?></h3>
	</div>
	<div class="head-desc">
		<?php $mb_name = ST::get_mb_icon($mb['mb_id']).' '.$mb['mb_nick']; ?>
		- <?=$kind_str ?>사람:&nbsp;&nbsp;&nbsp;<strong><?=$mb_name ?></strong><br>
		- <?=$kind_date ?>시간:&nbsp;&nbsp;&nbsp;<strong><?=$memo['me_send_datetime'] ?></strong>
	</div>

	<br>
	<div class="panel panel-default">
		<div class="panel-body">
			<?=conv_content($memo['me_memo'], 0) ?>
		</div>
	</div>

	<hr>
    <div class="actions clearfix">
		<div class="left">
			<a href="javascript:history.back()" class="btn btn-default" id="btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> 뒤로</a>
			<?php if($prev_link) {  ?>
			<a href="<?=$prev_link ?>" class="btn btn-default"><i class="fa fa-angle-left" aria-hidden="true"></i> 이전쪽지</a>
			<?php }  ?>
			<?php if($next_link) {  ?>
			<a href="<?=$next_link ?>" class="btn btn-default">다음쪽지 <i class="fa fa-angle-right" aria-hidden="true"></i></a>
			<?php }  ?>
		</div>
		<div class="right">
			<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>				
			<?php if ($kind == 'recv') {  ?><a href="./memo_form.php?me_recv_mb_id=<?=$mb['mb_id'] ?>&amp;me_id=<?=$memo['me_id'] ?>" class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i> 답장</a><?php }  ?>			
		</div>
    </div>
</div>


<script>
$(function() {
	if( history.length <= 1 )
		$('#btn-back').addClass('disabled');
});
</script>
