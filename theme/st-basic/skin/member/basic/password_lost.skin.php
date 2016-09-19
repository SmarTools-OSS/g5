<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-confirm">
	<div class="panel panel-default panel-password">
		<div class="panel-heading">
			<h4>아이디/비밀번호 찾기</h4>
		</div>
		
		<form name="fpasswordlost" action="<?=$action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">	
		<div class="panel-body">
			<p>
				회원가입 시 등록하신 이메일 주소를 입력해 주세요.<br>
				해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.
			</p>
			
			<br>
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">E-mail 주소</span>
				<input type="text" name="mb_email" id="mb_email" class="form-control input-sm" placeholder="이메일 주소를 입력해 주세요" required autofocus>		
			</div>			
		</div>
		<div class="panel-footer">		
			<?=captcha_html();  ?>
			<hr style="margin-top:0; margin-bottom:10px">
			<div class="clearfix">
				<button type="button" class="btn btn-default pull-left" onclick="history.back()"><i class="fa fa-arrow-left" aria-hidden="true"></i> 뒤로</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 확인</button>
			</div>
		</div>
		</form>	
	</div>
</div>


<script>
function fpasswordlost_submit(f)
{
    <?=chk_captcha_js();  ?>

    return true;
}

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>