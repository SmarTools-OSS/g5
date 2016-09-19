<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-confirm">
	<div class="panel panel-default panel-password">
		<div class="panel-heading">
			<h4><?=$g5['title'] ?></h4>
		</div>
		

		<form name="fmemberconfirm" action="<?=$url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post">
		<input type="hidden" name="mb_id" value="<?=$member['mb_id'] ?>">
		<input type="hidden" name="w" value="u">			
		
		<div class="panel-body">
			<p>
				<strong>비밀번호를 한번 더 입력해주세요.</strong>
				<?php if ($url == 'member_leave.php') { ?>
				비밀번호를 입력하시면 회원탈퇴가 완료됩니다.
				<?php }else{ ?>
				회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.
				<?php }  ?>
			</p>
			
			<br>
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">비밀번호</span>
				<input type="password" name="mb_password" id="confirm_mb_password" class="form-control input-sm" maxlength="20" placeholder="비밀번호를 입력해 주세요" required autofocus>
			</div>					
		</div>
		<div class="panel-footer clearfix">
			<button type="button" class="btn btn-default pull-left" onclick="history.back()"><i class="fa fa-arrow-left" aria-hidden="true"></i> 뒤로</button>
			<button type="submit" class="btn btn-primary" id="btn_submit"><i class="fa fa-check" aria-hidden="true"></i> 확인</button>
		</div>
		</form>			
	</div>
</div>


<script>
function fmemberconfirm_submit(f)
{
    document.getElementById("btn_submit").disabled = true;

    return true;
}
</script>
