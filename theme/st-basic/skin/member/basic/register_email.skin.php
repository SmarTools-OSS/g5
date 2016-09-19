<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="st-join" class="st-mbr">
<!--<div id="st-mbr">-->
	<div class="page-header">
		<h3 class="title">회원가입 <small>인증메일 재전송/변경</small></h3>
	</div>

	
    <p>
		인증메일을 받지 못한 경우 인증 이메일을 재전송 하거나 회원정보의 메일주소를 변경 할 수 있습니다.
    </p>
	
	<br>
	<form method="post" name="fregister_email" action="<?=G5_HTTPS_BBS_URL.'/register_email_update.php'; ?>" class="form-inline" onsubmit="return fregister_email_submit(this);">
	<input type="hidden" name="mb_id" value="<?=$mb_id; ?>">
	
	<table class="table table-striped">
	<tbody>
	<tr>
		<td class="key">E-mail <strong class="must">*</strong><strong class="sound_only">필수</strong></td>
		<td>
			<div class="key-xs-v"><strong class="must">*</strong> E-mail:</div>
			<input type="text" name="mb_email" id="reg_mb_email" required class="form-control input-sm email required" size="30" maxlength="100" value="<?=$mb['mb_email']; ?>">
		</td>
	</tr>
    <tr>
		<td class="key">자동등록방지</td>
        <td>
			<div class="key-xs-v">자동등록방지:</div>
			<?=captcha_html(); ?>
		</td>
    </tr>	
	</table>
	
	<div class="submit-box">
		<a href="<?=G5_URL ?>" class="btn btn-default">취소</a>
		<button type="submit" id="btn_submit" class="btn btn-primary" value="인증메일변경"><i class="glyphicon glyphicon-ok"></i> 인증메일 재전송/변경</button>
	</div>		
	</form>
</div>


<script>
function fregister_email_submit(f)
{
    <?=chk_captcha_js();  ?>

    return true;
}
</script>
