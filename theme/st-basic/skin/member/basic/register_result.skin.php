<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="st-join" class="st-mbr">
	<div class="page-header">
		<h3 class="title">회원가입 <small>완료</small></h3>
	</div>


    <p>
        <strong><?=get_text($mb['mb_name']); ?></strong>님의 회원가입을 진심으로 환영합니다!
    </p>
	
    <?php if ($config['cf_use_email_certify']) {  ?>
	<br>
    <p>
        회원 가입 시 입력하신 이메일 주소로 인증메일이 발송되었습니다.<br>
        발송된 인증메일을 확인하신 후 인증처리를 하시면 사이트를 원활하게 이용하실 수 있습니다.
    </p>
	
	<table class="table table-striped">
	<tbody>
	<tr>
		<td class="key">아이디</td>
		<td>
			<div class="key-xs-v">아이디:</div>
			<strong class="must"><?=$mb['mb_id'] ?></strong>
		</td>
	</tr>
	<tr>
		<td class="key">이메일 주소</td>
		<td>
			<div class="key-xs-v">이메일 주소:</div>
			<strong class="must"><?=$mb['mb_email'] ?></strong>
		</td>
	</tr>
	</table>

    <p>
        이메일 주소를 잘못 입력하셨다면, <a href="./login.php">로그인</a> 시도 후 변경이 가능합니다.
    </p>
    <?php }  ?>	
	
	<br>
    <p>
        회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.<br>
        아이디, 비밀번호 분실시에는 회원가입시 입력하신 이메일 주소를 이용하여 찾을 수 있습니다.
    </p>

    <p>
        회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.<br>
        감사합니다.
    </p>	
	
	<div class="submit-box">
		<a href="<?=G5_URL ?>/" class="btn btn-default"><i class="fa fa-home" aria-hidden="true"></i> 메인으로</a>
	</div>		
</div>
