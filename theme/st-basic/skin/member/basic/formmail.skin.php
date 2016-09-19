<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-popup">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?=$name ?><small>님께 메일보내기</small></h3>
	</div>
	
	
    <form name="fformmail" action="./formmail_send.php" onsubmit="return fformmail_submit(this);" method="post" enctype="multipart/form-data" style="margin:0px;">
    <input type="hidden" name="to" value="<?=$email ?>">
    <input type="hidden" name="attach" value="2">
    <?php if ($is_member) { // 회원이면  ?>
    <input type="hidden" name="fnick" value="<?=get_text($member['mb_nick']) ?>">
    <input type="hidden" name="fmail" value="<?=$member['mb_email'] ?>">
    <?php }  ?>	

	
	<?php if( $is_member ) {  ?>
	<div class="form-group">
		<strong>보내는 사람:</strong>
		<div><?=$member['mb_email']?> (<?=$member['mb_nick']?>)</div>
	</div>
	<?php } else {  ?>
	<div class="form-group">
		<strong>발송자 이름:</strong>
		<input type="text" name="fnick" id="fnick" class="form-control input-sm required" placeholder="발송자 이름을 입력해 주세요" required>
	</div>
	
	<div class="form-group">
		<strong>발송자 이메일 주소:</strong>
		<input type="text" name="fmail" id="fmail" class="form-control input-sm required" placeholder="발송자 이메일 주소를 입력해 주세요" required>
	</div>
	<?php }  ?>
	
	<?php if( $is_admin ) { ?>
	<div class="form-group">
		<strong>받는 사람:</strong>
		<div><?=$email_dec?> (<?=$name?>)</div>
	</div>
	<?php } ?>			
	
	<div class="form-group">
		<strong>제목:</strong>
		<input type="text" name="subject" id="subject" class="form-control input-sm required" placeholder="이메일 제목을 입력해 주세요" required autofocus>
		<label class="input"><input type="radio" name="type" value="0" id="type_text" checked> TEXT</label>
		<label class="input"><input type="radio" name="type" value="1" id="type_html"> HTML</label>
		<label class="input"><input type="radio" name="type" value="2" id="type_both"> TEXT+HTML</label>
	</div>	
	
	<div class="form-group">
		<strong>내용:</strong>
		<textarea name="content" id="content" class="form-control" required></textarea>
	</div>	
	
	<div class="form-group">
		<strong>첨부파일 1:</strong>
		<input type="file" name="file1"  id="file1">
	</div>		
	
	<div class="form-group">
		<strong>첨부파일 2:</strong>
		<input type="file" name="file2"  id="file2">
		
		<p class="desc" style="margin-top: 5px"><i class="fa fa-info-circle" aria-hidden="true"></i> 첨부 파일은 누락될 수 있으므로 메일을 보낸 후 파일이 첨부 되었는지 반드시 확인해 주시기 바랍니다.</p>	
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
function fformmail_submit(f)
{
    <?=chk_captcha_js();  ?>

    if (f.file1.value || f.file2.value) {
        // 4.00.11
        if (!confirm("첨부파일의 용량이 큰경우 전송시간이 오래 걸립니다.\n\n메일보내기가 완료되기 전에 창을 닫거나 새로고침 하지 마십시오."))
            return false;
    }

    document.getElementById('btn_submit').disabled = true;

    return true;
}
</script>
