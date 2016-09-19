<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-mypage" class="st-mbr">
	<?php include_once 'mypage_header.skin.php'?>


	<ul class="nav nav-tabs">
		<li class="active bold"><a href="javascript:void();"><i class="fa fa-tachometer" aria-hidden="true"></i> 나의 계정</a></li>
	</ul>
	<table class="table table-striped">
	<tbody>
	<tr>
		<td class="key">이름 (닉네임)</td>
		<td>
			<div class="key-xs-v">이름 (닉네임):</div>
			<?=$mb_icon?> <?=$member['mb_name'] ?> (<?=$member['mb_nick'] ?>)
		</td>
	</tr>
	<tr>
		<td class="key">권한 / 포인트</td>
		<td>
			<div class="key-xs-v">권한 / 포인트:</div>
			Lv <?=number_format($member['mb_level'])?> / <?=number_format($member['mb_point'])?>P
		</td>
	</tr>			
	<tr>
		<td class="key">이메일 주소</td>
		<td>
			<div class="key-xs-v">이메일 주소:</div>
			<?=$member['mb_email']? ST::get_hidden_email_addr($member['mb_email']): '미등록'?> (메일수신: <?=$member['mb_mailling']? 'Y': 'N'?>)
		</td>
	</tr>	
	<tr>
		<td class="key">휴대폰 번호</td>
		<td>
			<div class="key-xs-v">이메일 주소:</div>
			<?=$member['mb_hp']? ST::get_hidden_hp_num($member['mb_hp']): '미등록'?> (SMS수신: <?=$member['mb_sms']? 'Y': 'N'?>)
		</td>
	</tr>		
	<tr>
		<td class="key">정보 공개</td>
		<td><?=$member['mb_open']? '예': '아니오'?></td>
	</tr>		
	<tr>
		<td class="key">회원가입일</td>
		<td>
			<div class="key-xs-v">회원가입일:</div>
			<?=$member['mb_datetime'] ?>
		</td>
	</tr>			
	<tr>
		<td class="key">최근접속일</td>
		<td>
			<div class="key-xs-v">최근접속일:</div>
			<?=$member['mb_today_login'] ?> (<?=$member['mb_login_ip'] ?>)
		</td>
	</tr>			
	</tbody>
	</table>
	
	
	<div class="submit-box">
		<a href="<?=ST_SETTING_URL ?>" class="btn btn-danger"><i class="fa fa-cog" aria-hidden="true"></i> 정보수정</a>
	</div>	
</div>