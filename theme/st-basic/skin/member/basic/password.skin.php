<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$delete_str = "";
if ($w == 'x') $delete_str = "댓";
if ($w == 'u') $g5['title'] = $delete_str."글 수정";
else if ($w == 'd' || $w == 'x') $g5['title'] = $delete_str."글 삭제";
else $g5['title'] = $g5['title'];

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-confirm">
	<div class="panel panel-default panel-password">
		<div class="panel-heading">
			<h4><?=$g5['title'] ?></h4>
		</div>
		
		<form name="fboardpassword" action="<?=$action;  ?>" method="post">
		<input type="hidden" name="w" value="<?=$w ?>">
		<input type="hidden" name="bo_table" value="<?=$bo_table ?>">
		<input type="hidden" name="wr_id" value="<?=$wr_id ?>">
		<input type="hidden" name="comment_id" value="<?=$comment_id ?>">
		<input type="hidden" name="sfl" value="<?=$sfl ?>">
		<input type="hidden" name="stx" value="<?=$stx ?>">
		<input type="hidden" name="page" value="<?=$page ?>">				
		<div class="panel-body">
			<p>
				<?php if ($w == 'u') { ?>
				<strong>작성자만 글을 수정할 수 있습니다.</strong>
				작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 수정할 수 있습니다.
				<?php } else if ($w == 'd' || $w == 'x') {  ?>
				<strong>작성자만 글을 삭제할 수 있습니다.</strong>
				작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 삭제할 수 있습니다.
				<?php } else {  ?>
				<strong><span class="label label-warning" style="position:relative; top:-3px;"><i class="fa fa-lock" aria-hidden="true" title="비밀글"></i></span> 비밀글 기능으로 보호된 글입니다.</strong>
				작성자와 관리자만 열람하실 수 있습니다. 본인이라면 비밀번호를 입력하세요.
				<?php }  ?>
			</p>
			
			<br>
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">비밀번호</span>
				<input type="password" name="wr_password" id="wr_password" class="form-control input-sm" maxlength="20" placeholder="비밀번호를 입력해 주세요" required autofocus>
			</div>			
		</div>
		<div class="panel-footer clearfix">
			<button type="button" class="btn btn-default pull-left" onclick="history.back()"><i class="fa fa-arrow-left" aria-hidden="true"></i> 뒤로</button>
			<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 확인</button>
		</div>
		</form>	
	</div>
</div>