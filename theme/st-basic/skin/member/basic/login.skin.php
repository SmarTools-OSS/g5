<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-login">
	<div class="panel panel-signin">
		<div class="panel-heading"><i class="glyphicon glyphicon-flash"></i> <?=$g5['title'] ?></div>
		
		<div class="panel-body">
			<form name="flogin" action="<?=$login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
			<input type="hidden" name="url" value="<?=$login_url ?>">
				
			<div class="input-group" style="margin-top:5px">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" name="mb_id" id="login_id" class="form-control required" size="20" maxLength="20" placeholder="아이디" required autofocus>
			</div>
						
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" name="mb_password" id="login_pw" class="form-control required" size="20" maxLength="20" placeholder="비밀번호" required>
			</div>
		
			<div class="login-option">
				<label class="input"><input type="checkbox" name="auto_login" id="login_auto_login"> 자동로그인</label>
			</div>
				
			<div class="alert alert-warning" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p><strong><i class="fa fa-info-circle" aria-hidden="true"></i> 회원로그인 안내</strong><br></p>
				회원아이디 및 비밀번호가 기억 안나실 때는 아이디/비밀번호 찾기를 이용하십시오.<br><br>
				아직 회원이 아니시라면 회원으로 가입 후 이용해 주십시오.
			</div>	
				
			<div class="loginbox">	
				<button type="submit" class="btn btn-lg btn-primary">로그인</button>
			</div>
			</form>
			
			<hr>
			<a href="<?=ST_JOIN_URL ?>"><h5 class="st-font1" title="회원가입" alt="회원가입"><i class="fa fa-leaf" aria-hidden="true"></i> 아직 회원이 아니세요?</h5></a>
			<a href="<?=ST_FINDPWD_URL ?>"><h5 class="st-font1" title="아이디/비밀번호 찾기" alt="아이디/비밀번호 찾기"><i class="fa fa-question-circle" aria-hidden="true"></i></i> 아이디/비밀번호를 잊으셨나요?</h5></a>
		</div>
	</div>
</div>


<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>