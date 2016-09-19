<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-popup">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-envelope" aria-hidden="true"></i> 쪽지 보내기</h3>
	</div>

	<form name="fmemoform" action="<?=$memo_action_url; ?>" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off">
	<div class="form-group">
		<strong>받는 회원 <small>(아이디)</small>:</strong>
		<input type="text" name="me_recv_mb_id" value="<?=$me_recv_mb_id ?>" id="me_recv_mb_id" class="form-control input-sm required" placeholder="받는 회원 (아이디)" required>
		<p class="desc"><i class="fa fa-info-circle" aria-hidden="true"></i> 여러 회원에게 보낼때는 컴마(,)로 구분하세요.</p>
	</div>
	
	<div class="form-group">
		<strong>내용:</strong>
		<textarea name="me_memo" id="me_memo" class="form-control" required></textarea>
	</div>
	
	<div class="form-group">
		<div><strong>자동등록방지:</strong></div>
		<?=captcha_html(); ?>
	</div>	
	
	
	<hr>
    <div class="actions clearfix">
		<div class="left">
			<a href="javascript:history.back()" class="btn btn-default" id="btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i> 뒤로</a>
		</div>		
		<div class="right">
			<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>	
			<button type="submit" class="btn btn-primary" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 확인</button>	
		</div>
	</div>
	</form>
</div>


<script>
$(function() {
	if( history.length <= 1 )
		$('#btn-back').addClass('disabled');
	
	$('#captcha_info').html('<i class="fa fa-info-circle" aria-hidden="true"></i> 자동등록방지 숫자를 순서대로 입력하세요.');	
});
function fmemoform_submit(f)
{
    <?=chk_captcha_js();  ?>

    return true;
}
</script>