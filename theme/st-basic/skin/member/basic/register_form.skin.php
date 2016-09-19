<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-join" class="st-mbr">
	<?php if( $w ) { ?>
	<div class="page-header">
		<h3 class="title">정보수정 <small>계정정보 수정</small></h3>
	</div>
	<ul class="page-desc">
		<li>이곳에서 <?=ST::get_mb_icon($member['mb_id'])?> <strong><?=$member['mb_name'] ?> (<?=$member['mb_nick'] ?>)</strong> 님의 계정정보를 수정할 수 있습니다.</li>
		<li>입력 항목 중 <strong class="must">*</strong> 표시가 있는 것은 반드시 입력하여 주십시요.</li>
	</ul>
	<?php } else { ?>
	<div class="page-header">
		<h3 class="title">회원가입 <small>계정정보 입력</small></h3>
	</div>
	<ul class="page-desc">
		<li>입력 항목 중 <strong class="must">*</strong> 표시가 있는 것은 반드시 입력하여 주십시요.</li>
		<li>허위로 작성된 정보일 경우 승인이 보류되거나, 계정이 임의삭제 될 수 있으므로 주의 부탁드립니다.</li>
	</ul>
	<?php } //endif ?>

	
    <script src="<?=G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?=G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form id="fregisterform" name="fregisterform" class="form-inline" action="<?=$register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?=$w ?>">
    <input type="hidden" name="url" value="<?=$urlencode ?>">
    <input type="hidden" name="agree" value="<?=$agree ?>">
    <input type="hidden" name="agree2" value="<?=$agree2 ?>">
    <input type="hidden" name="cert_type" value="<?=$member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?=$member['mb_sex'] ?>"><?php }  ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
    <input type="hidden" name="mb_nick_default" value="<?=get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?=get_text($member['mb_nick']) ?>">
    <?php }  ?>	
	
	<ul class="nav nav-tabs">
		<li class="active st-font1 bold"><a href="javascript:void();" tabindex="-1"><i class="glyphicon glyphicon-check"></i> 아이디/비밀번호</a></li>
	</ul>
	<table class="table table-striped">
	<tbody>
	<tr>
		<td class="key">아이디 <strong class="must">*</strong><strong class="sound_only">필수</strong></td>
		<td>
			<div class="key-xs-v"><strong class="must">*</strong> 아이디:</div>
			<input type="text" name="mb_id" value="<?=$member['mb_id'] ?>" id="reg_mb_id" class="form-control input-sm <?=$required ?> <?=$readonly ?>" minlength="3" maxlength="20" <?=$required ?> <?=$readonly ?>>
			<span id="msg_mb_id"></span>
			<div class="desc">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</div>
		</td>
	</tr>
	<tr>
		<td class="key">비밀번호 <strong class="must">*</strong><strong class="sound_only">필수</strong></td>
		<td>
			<div class="key-xs-v"><strong class="must">*</strong> 비밀번호:</div>
			<input type="password" name="mb_password" id="reg_mb_password" class="form-control input-sm <?=$required ?>" minlength="3" maxlength="20" <?=$required ?>>
		</td>
	</tr>
	<tr>
		<td class="key">비밀번호 확인 <strong class="must">*</strong><strong class="sound_only">필수</strong></td>
		<td>
			<div class="key-xs-v"><strong class="must">*</strong> 비밀번호 확인:</div>
			<input type="password" name="mb_password_re" id="reg_mb_password_re" class="form-control input-sm <?=$required ?>" minlength="3" maxlength="20" <?=$required ?>>
		</td>
	</tr>	
	</tbody>	
	</table>

	
	<br><br>
	<ul class="nav nav-tabs">
		<li class="active st-font1 bold"><a href="javascript:void();" tabindex="-1"><i class="glyphicon glyphicon-check"></i> 회원 개인정보</a></li>
	</ul>
	<table class="table table-striped">
	<tbody>
	<tr>
		<td class="key">이름 <strong class="must">*</strong><strong class="sound_only">필수</strong></td>
		<td>
			<div class="key-xs-v"><strong class="must">*</strong> 이름:</div>
			<input type="text" id="reg_mb_name" name="mb_name" value="<?=get_text($member['mb_name']) ?>" <?=$required ?> <?=$readonly; ?> class="form-control input-sm <?=$required ?> <?=$readonly ?>" size="10">
			<?php
			if($config['cf_cert_use']) {
				echo '<div class="visible-xs" style="height:5px"></div>';
				if($config['cf_cert_ipin'])
					echo '<button type="button" id="win_ipin_cert" class="btn btn-sm btn-default">아이핀 본인확인</button>'.PHP_EOL;
				if($config['cf_cert_hp'])
					echo '<button type="button" id="win_hp_cert" class="btn btn-sm btn-default">휴대폰 본인확인</button>'.PHP_EOL;

				echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
			}
			?>
			<?php
			if ($config['cf_cert_use'] && $member['mb_certify']) {
				if($member['mb_certify'] == 'ipin')
					$mb_cert = '아이핀';
				else
					$mb_cert = '휴대폰';
			?>
			<div id="msg_certify">
				<strong><?=$mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
			</div>
			<?php } ?>
			<?php if ($config['cf_cert_use']) { ?>
			<div class="desc">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</div>
			<?php } ?>			
		</td>
	</tr>
	<?php if ($req_nick) {  ?>
	<tr>
		<td class="key">닉네임 <strong class="must">*</strong><strong class="sound_only">필수</strong></td>
		<td>
			<div class="key-xs-v"><strong class="must">*</strong> 닉네임:</div>
			<input type="hidden" name="mb_nick_default" value="<?=isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
			<input type="text" name="mb_nick" value="<?=isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" required class="form-control input-sm required" maxlength="20">
			<span id="msg_mb_nick"></span>
			
			<div class="desc">
				공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)<br>
				닉네임을 바꾸시면 앞으로 <?=(int)$config['cf_nick_modify'] ?>일 이내에는 변경 할 수 없습니다.
			</div>			
		</td>
	</tr>
	<?php }  ?>

	<tr>
		<td class="key">E-mail <strong class="must">*</strong><strong class="sound_only">필수</strong></td>
		<td>
			<div class="key-xs-v"><strong class="must">*</strong> E-mail:</div>
			<input type="hidden" name="old_email" value="<?=$member['mb_email'] ?>">
			<input type="text" name="mb_email" value="<?=isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="form-control input-sm email required" size="70" maxlength="100">
			
			<?php if ($config['cf_use_email_certify']) {  ?>
			<div class="desc">
				<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
				<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
			</div>
			<?php }  ?>			
		</td>
	</tr>

	<?php if ($config['cf_use_homepage']) {  ?>
	<tr>
		<td class="key">홈페이지<?php if ($config['cf_req_homepage']){ ?> <strong class="must">*</strong><strong class="sound_only">필수</strong><?php } ?></td>
		<td>
			<div class="key-xs-v"><?=$config['cf_req_homepage']?'<strong class="must">*</strong> ':''; ?>홈페이지:</div>
			<input type="text" name="mb_homepage" value="<?=get_text($member['mb_homepage']) ?>" id="reg_mb_homepage" <?=$config['cf_req_homepage']?"required":""; ?> class="form-control input-sm <?=$config['cf_req_homepage']?"required":""; ?>" size="70" maxlength="255">
		</td>
	</tr>
	<?php }  ?>

	<?php if ($config['cf_use_tel']) {  ?>
	<tr>
		<td class="key">전화번호<?php if ($config['cf_req_tel']){ ?> <strong class="must">*</strong><strong class="sound_only">필수</strong><?php } ?></td>
		<td>
			<div class="key-xs-v"><?=$config['cf_req_tel']?'<strong class="must">*</strong> ':''; ?>전화번호:</div>
			<input type="text" name="mb_tel" value="<?=get_text($member['mb_tel']) ?>" id="reg_mb_tel" <?=$config['cf_req_tel']?"required":""; ?> class="form-control input-sm <?=$config['cf_req_tel']?"required":""; ?>" maxlength="20">
		</td>
	</tr>
	<?php }  ?>

	<?php if ($config['cf_use_hp'] || $config['cf_cert_hp']) {  ?>
	<tr>
		<td class="key">휴대폰번호<?php if ($config['cf_req_hp']){ ?> <strong class="must">*</strong><strong class="sound_only">필수</strong><?php } ?></td>
		<td>
			<div class="key-xs-v"><?=$config['cf_req_hp']?'<strong class="must">*</strong> ':''; ?>휴대폰번호:</div>
			<input type="text" name="mb_hp" value="<?=get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?=($config['cf_req_hp'])?"required":""; ?> class="form-control input-sm <?=($config['cf_req_hp'])?"required":""; ?>" maxlength="20">
			<?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
			<input type="hidden" name="old_mb_hp" value="<?=get_text($member['mb_hp']) ?>">
			<?php } ?>
		</td>
	</tr>
	<?php }  ?>

	<?php if ($config['cf_use_addr']) { ?>
	<tr>
		<td class="key">주소<?php if ($config['cf_req_addr']){ ?> <strong class="must">*</strong><strong class="sound_only">필수</strong><?php } ?></td>
		<td>
			<p>
				<div class="key-xs-v"><?=$config['cf_req_addr']?'<strong class="must">*</strong> ':''; ?>주소:</div>
				
				<label for="reg_mb_zip" class="sound_only">우편번호<?=$config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
				<div class="input-group input-group-sm">
					<input type="text" name="mb_zip" value="<?=$member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?=$config['cf_req_addr']?"required":""; ?> class="form-control input-sm <?=$config['cf_req_addr']?"required":""; ?>" size="8" maxlength="6" readonly="readonly">
					<span class="input-group-btn">
						<button type="button" class="btn btn-sm btn-info" onclick="onZipSearch()"><i class="fa fa-search" aria-hidden="true"></i> 우편번호</button>
					</span>
				</div>
			</p>
			<p>
				<input type="text" name="mb_addr1" value="<?=get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?=$config['cf_req_addr']?"required":""; ?> class="form-control input-sm <?=$config['cf_req_addr']?"required":""; ?>" placeholder="기본주소" size="70" readonly="readonly">
			</p>
			<p>
				<input type="text" name="mb_addr2" value="<?=get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="form-control input-sm" placeholder="상세주소" size="70">
			</p>
			<p>
				<input type="text" name="mb_addr3" value="<?=get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="form-control input-sm" placeholder="참고항목" size="70" readonly="readonly">
			</p>
			<input type="hidden" name="mb_addr_jibeon" value="<?=get_text($member['mb_addr_jibeon']); ?>">
		</td>
	</tr>
	<?php }  ?>
	</tbody>	
	</table>
	
	
	<br><br>
	<ul class="nav nav-tabs">
		<li class="active st-font1 bold"><a href="javascript:void();" tabindex="-1"><i class="glyphicon glyphicon-check"></i> 기타 개인설정</a></li>
	</ul>
	<table class="table table-striped">
	<tbody>
	<?php if ($config['cf_use_signature']) {  ?>
	<tr>
		<td class="key">서명<?php if ($config['cf_req_signature']){ ?> <strong class="must">*</strong><strong class="sound_only">필수</strong><?php } ?></td>
		<td>
			<div class="key-xs-v"><?=$config['cf_req_signature']?'<strong class="must">*</strong> ':''; ?>서명:</div>
			<textarea name="mb_signature" id="reg_mb_signature" <?=$config['cf_req_signature']?"required":""; ?> class="form-control input-area-sm<?=$config['cf_req_signature']?" required":""; ?>"><?=$member['mb_signature'] ?></textarea>
		</td>
	</tr>
	<?php }  ?>

	<?php if ($config['cf_use_profile']) {  ?>
	<tr>
		<td class="key">자기소개<?php if ($config['cf_req_profile']){ ?> <strong class="must">*</strong><strong class="sound_only">필수</strong><?php } ?></td>
		<td>
			<div class="key-xs-v"><?=$config['cf_req_profile']?'<strong class="must">*</strong> ':''; ?>자기소개:</div>
			<textarea name="mb_profile" id="reg_mb_profile" <?=$config['cf_req_profile']?"required":""; ?> class="form-control input-area-sm<?=$config['cf_req_profile']?" required":""; ?>"><?=$member['mb_profile'] ?></textarea>
		</td>
	</tr>
	<?php }  ?>

	<?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) {  ?>
	<tr>
		<td class="key">회원아이콘</td>
		<td>
			<div class="key-xs-v">회원아이콘:</div>
			<input type="file" name="mb_icon" id="reg_mb_icon" class="frm_input">
			<?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
			<img src="<?=$mb_icon_url ?>" alt="회원아이콘">
			<input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
			<label for="del_mb_icon">삭제</label>
			<?php }  ?>
			
			<div class="desc">
				이미지 크기는 가로 <?=$config['cf_member_icon_width'] ?>픽셀, 세로 <?=$config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.<br>
				gif만 가능하며 용량 <?=number_format($config['cf_member_icon_size']) ?>바이트 이하만 등록됩니다.
			</div>			
		</td>
	</tr>
	<?php }  ?>

	<tr>
		<td class="key">메일링서비스</td>
		<td>
			<div class="key-xs-v">메일링서비스:</div>
			<label class="input">
				<input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?=($w=='' || $member['mb_mailling'])?'checked':''; ?>>
				정보 메일을 받겠습니다.
			</label>
		</td>
	</tr>

	<?php if ($config['cf_use_hp']) {  ?>
	<tr>
		<td class="key">SMS 수신여부</td>
		<td>
			<div class="key-xs-v">SMS 수신여부:</div>
			<label class="input">
				<input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?=($w=='' || $member['mb_sms'])?'checked':''; ?>>
				휴대폰 문자메세지를 받겠습니다.
			</label>
		</td>
	</tr>
	<?php }  ?>

	<?php if (isset($member['mb_open_date']) && $member['mb_open_date'] <= date("Y-m-d", G5_SERVER_TIME - ($config['cf_open_modify'] * 86400)) || empty($member['mb_open_date'])) { // 정보공개 수정일이 지났다면 수정가능  ?>
	<tr>
		<td class="key">정보공개</td>
		<td>
			<input type="hidden" name="mb_open_default" value="<?=$member['mb_open'] ?>">
			<label class="input">
				<input type="checkbox" name="mb_open" value="1" <?=($w=='' || $member['mb_open'])?'checked':''; ?> id="reg_mb_open">
				다른분들이 나의 정보를 볼 수 있도록 합니다.
			</label>
			
			<div class="desc">
				정보공개를 바꾸시면 앞으로 <?=(int)$config['cf_open_modify'] ?>일 이내에는 변경이 안됩니다.
			</div>			
		</td>
	</tr>
	<?php } else {  ?>
	<tr>
		<td class="key">정보공개</td>
		<td>
			<input type="hidden" name="mb_open" value="<?=$member['mb_open'] ?>">
			
			<div class="desc">
				정보공개는 수정후 <?=(int)$config['cf_open_modify'] ?>일 이내, <?=date("Y년 m월 j일", isset($member['mb_open_date']) ? strtotime("{$member['mb_open_date']} 00:00:00")+$config['cf_open_modify']*86400:G5_SERVER_TIME+$config['cf_open_modify']*86400); ?> 까지는 변경이 안됩니다.<br>
				이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.
			</div>			
		</td>
	</tr>
	<?php }  ?>

	<?php if ($w == "" && $config['cf_use_recommend']) {  ?>
	<tr>
		<td class="key">추천인아이디</td>
		<td>
			<div class="key-xs-v">추천인아이디:</div>
			<input type="text" name="mb_recommend" id="reg_mb_recommend" class="form-control input-sm">
		</td>
	</tr>
	<?php }  ?>

	<tr>
		<td class="key">자동등록방지</td>
		<td>
			<div class="key-xs-v">자동등록방지:</div>
			<?=captcha_html(); ?>
		</td>
	</tr>
	</tbody>
	</table>
	
	
	<div class="submit-box">
		<?php if( $w ) { ?>
		<button class="btn btn-danger pull-left" onclick="return member_leave()"><i class="fa fa-blind" aria-hidden="true"></i> 회원탈퇴</button>
		<?php } ?>
		<a href="<?=G5_URL ?>" class="btn btn-default">취소</a>
		<button id="btn_submit" class="btn btn-primary" type="submit" accesskey="s"><i class="fa fa-check" aria-hidden="true"></i> <?=$w==''?'회원가입':'정보수정'; ?></button>
	</div>	
    </form>	
</div>


<script>
$(function() {
	$("#reg_zip_find").css("display", "inline-block");

	<?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
	// 아이핀인증
	$("#win_ipin_cert").click(function() {
		if(!cert_confirm())
			return false;

		var url = "<?=G5_OKNAME_URL; ?>/ipin1.php";
		certify_win_open('kcb-ipin', url);
		return;
	});

	<?php } ?>
	<?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
	// 휴대폰인증
	$("#win_hp_cert").click(function() {
		if(!cert_confirm())
			return false;

		<?php
		switch($config['cf_cert_hp']) {
			case 'kcb':
				$cert_url = G5_OKNAME_URL.'/hpcert1.php';
				$cert_type = 'kcb-hp';
				break;
			case 'kcp':
				$cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
				$cert_type = 'kcp-hp';
				break;
			case 'lg':
				$cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
				$cert_type = 'lg-hp';
				break;
			default:
				echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
				echo 'return false;';
				break;
		}
		?>

		certify_win_open("<?=$cert_type; ?>", "<?=$cert_url; ?>");
		return;
	});
	<?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f)
{
	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == "") {
		if (f.mb_password.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert("비밀번호가 같지 않습니다.");
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_re.focus();
			return false;
		}
	}

	// 이름 검사
	if (f.w.value=="") {
		if (f.mb_name.value.length < 1) {
			alert("이름을 입력하십시오.");
			f.mb_name.focus();
			return false;
		}

		/*
		var pattern = /([^가-힣\x20])/i;
		if (pattern.test(f.mb_name.value)) {
			alert("이름은 한글로 입력하십시오.");
			f.mb_name.select();
			return false;
		}
		*/
	}

	<?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
	// 본인확인 체크
	if(f.cert_no.value=="") {
		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
		return false;
	}
	<?php } ?>

	// 닉네임 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
		var msg = reg_mb_nick_check();
		if (msg) {
			alert(msg);
			f.reg_mb_nick.select();
			return false;
		}
	}

	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}

	<?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
	// 휴대폰번호 체크
	var msg = reg_mb_hp_check();
	if (msg) {
		alert(msg);
		f.reg_mb_hp.select();
		return false;
	}
	<?php } ?>

	if (typeof f.mb_icon != "undefined") {
		if (f.mb_icon.value) {
			if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
				alert("회원아이콘이 gif 파일이 아닙니다.");
				f.mb_icon.focus();
				return false;
			}
		}
	}

	if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
		if (f.mb_id.value == f.mb_recommend.value) {
			alert("본인을 추천할 수 없습니다.");
			f.mb_recommend.focus();
			return false;
		}

		var msg = reg_mb_recommend_check();
		if (msg) {
			alert(msg);
			f.mb_recommend.select();
			return false;
		}
	}

	<?=chk_captcha_js();  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
function onZipSearch() {
	if( $('#daum_juso_pagemb_zip').is(':visible') )
		$('#daum_juso_pagemb_zip').hide();
	else
		win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');
}
function member_leave()
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?"))
        location.href = "<?=G5_BBS_URL ?>/member_confirm.php?url=member_leave.php";
}
</script>