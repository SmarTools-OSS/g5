<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>


<div id="st-ol">
	<form name="foutlogin" action="<?=$outlogin_action_url ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">
	<input type="hidden" name="url" value="<?=$outlogin_url ?>">
	
	<div class="input-group input-group-sm">
		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		<input type="text" name="mb_id" class="form-control input-sm required" maxlength="20" placeholder="아이디" required>
	</div>
	
	<div class="input-group input-group-sm">
		<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		<input type="password" name="mb_password" id="login_pw" class="form-control input-sm required" size="20" maxLength="20" placeholder="비밀번호" required>
	</div>	
	
	<div class="input-group input-group-sm">
		<label class="input" style="margin: 0"><input type="checkbox" name="auto_login" value="1" id="auto_login"> 자동로그인</label>	
	</div>
	
	<hr style="margin: 0 0 10px">
	<div class="btn-group btn-group-justified">
		<div class="btn-group" style="width:15%">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="<?=ST_JOIN_URL ?>"><i class="fa fa-leaf" aria-hidden="true"></i> 회원가입</a></li>
				<li><a href="<?=ST_FINDPWD_URL ?>"><i class="fa fa-question-circle" aria-hidden="true"></i> 아이디/비밀번호 찾기</a></li>
			</ul>
		</div>
		<div class="btn-group" style="width:80%">
			<button type="submit" class="btn btn-primary">로그인</button>					
		</div>
	</div>
    </form>
</div>


<script>
$(function() {
    $("#auto_login").click(function(){
        if ($(this).is(":checked")) {
            if(!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                return false;
        }
    });
});

function fhead_submit(f)
{
    return true;
}
</script>
