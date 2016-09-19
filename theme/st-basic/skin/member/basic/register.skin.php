<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-join" class="st-mbr">
	<div class="page-header">
		<h3 class="title">회원가입 <small>이용약관 및 동의</small></h3>
	</div>
	<ul class="page-desc">
		<li>회원가입을 원하실 경우, 아래의 서비스이용약관 및 개인정보취급방침을 확인하신 후 동의하여 주십시요.</li>
		<li>서비스를 이용함으로써 귀하는 본 약관에 동의하게 되므로, 본 약관을 주의 깊게 읽어보시기 바랍니다.</li>
	</ul>
			

	<form  name="fregister" id="fregister" action="<?=$register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
	<ul class="nav nav-tabs">
		<li class="active st-font1 bold"><a href="javascript:void();"><i class="glyphicon glyphicon-check"></i> 서비스이용약관</a></li>
	</ul>
	<div class="policy-box">
		<textarea class="form-control" readonly="readonly"><?=get_text($config['cf_stipulation']) ?></textarea>
	</div>	
	<div class="agree-box">
		<label class="input"><input type="checkbox" name="agree" value="1"> 서비스이용약관에 동의합니다.</label>
	</div>

	
	<ul class="nav nav-tabs">
		<li class="active st-font1 bold"><a href="javascript:void();"><i class="glyphicon glyphicon-check"></i> 개인정보취급방침</a></li>
	</ul>
	<div class="policy-box">
		<textarea class="form-control" readonly="readonly"><?=get_text($config['cf_privacy']) ?></textarea>
	</div>
	<div class="agree-box">
		<label class="input"><input type="checkbox" name="agree2" value="1"> 개인정보취급방침에 동의합니다.</label>
	</div>
			
	
	<div class="submit-box">
		<input type="button" value="취소" class="btn btn-default" onclick="javascript :history.back()">
		<button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i> 다음으로</button>
	</div>
	</form>
</div>


<script>
function fregister_submit(f)
{
	if (!f.agree.checked) {
		alert("서비스이용약관에 동의하셔야 회원가입 하실 수 있습니다.");
		f.agree.focus();
		return false;
	}

	if (!f.agree2.checked) {
		alert("개인정보취급방침에 동의하셔야 회원가입 하실 수 있습니다.");
		f.agree2.focus();
		return false;
	}

	return true;
}
</script>
	