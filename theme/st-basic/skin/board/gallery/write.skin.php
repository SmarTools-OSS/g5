<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

// DHTML 에디터 미 사용 시, 태그 처리
if( is_mobile() or (!is_mobile() and !$is_dhtml_editor) ) {
	$editor_html = ST::editor_html('wr_content', $content);
	$editor_js = '';
	$editor_js .= ST::get_editor_js('wr_content');
	$editor_js .= ST::chk_editor_js('wr_content');	
}
?>


<div id="st-write">
	<?php if( !$board['bo_content_head'] ) { ?>
	<div class="page-header">
		<h3 class="title"><?=$board['bo_subject']?> <small>쓰기</small></h3>
		<span class="sr-only">쓰기</span>
	</div>
	<?php } ?>
	
	
   <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?=$action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?=$width; ?>">
    <input type="hidden" name="uid" value="<?=get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?=$w ?>">
    <input type="hidden" name="bo_table" value="<?=$bo_table ?>">
    <input type="hidden" name="wr_id" value="<?=$wr_id ?>">
    <input type="hidden" name="sca" value="<?=$sca ?>">
    <input type="hidden" name="sfl" value="<?=$sfl ?>">
    <input type="hidden" name="stx" value="<?=$stx ?>">
    <input type="hidden" name="spt" value="<?=$spt ?>">
    <input type="hidden" name="sst" value="<?=$sst ?>">
    <input type="hidden" name="sod" value="<?=$sod ?>">
    <input type="hidden" name="page" value="<?=$page ?>">
	
	<?php if ($is_category) { ?>
	<div class="row">
		<div class="col-xs-6 col-xs-v12 col-input">
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">분&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;류</span>
				<select name="ca_name" id="ca_name" class="form-control input-sm required" title="분류" required>
					<option value="">선택하세요</option>
					<?=$category_option ?>
				</select>	
			</div>
		</div>
	</div>	
	<?php } ?>
	
	<div class="row">
		<?php if ($is_name) { ?>
		<div class="col-xs-6 col-xs-v12 col-input">
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">이&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;름</span>
				<input type="text" name="wr_name" id="wr_name" value="<?=$name ?>" class="form-control input-sm required" maxlength="20" title="이름" placeholder="이름을 입력해 주세요" required>
			</div>
		</div>
		<?php } ?>
		<?php if ($is_password) { ?>
		<div class="col-xs-6 col-xs-v12 col-input">
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">비밀번호</span>
				<input type="password" name="wr_password" id="wr_password" class="form-control input-sm <?=$password_required ?>" maxLength="20" title="비밀번호" placeholder="비밀번호를 입력해 주세요" <?=$password_required ?>>
			</div>
		</div>
		<?php } ?>
		<?php if ($is_email) { ?>
		<div class="col-xs-6 col-xs-v12 col-input">
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">이&nbsp;메&nbsp;일</span>
				<input type="text" name="wr_email" id="wr_email" value="<?=$email ?>" class="form-control input-sm" maxlength="100" title="이메일" placeholder="이메일 주소를 입력해 주세요">
			</div>
		</div>
		<?php } ?>
		<?php if ($is_homepage) { ?>
		<div class="col-xs-6 col-xs-v12 col-input">
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">홈페이지</span>
				<input type="text" name="wr_homepage" id="wr_homepage" value="<?=$homepage ?>" class="form-control input-sm" title="홈페이지" placeholder="홈페이지 주소를 입력해 주세요">
			</div>
		</div>
		<?php } ?>		
	</div>	
	
	<div class="row">
		<div class="col-xs-12 col-input">
			<div id="autosave_wrapper" class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목</span>
				<input type="text" name="wr_subject" id="wr_subject" value="<?=$subject ?>" class="form-control input-sm required" maxlength="255" title="제목" placeholder="제목을 입력해 주세요"  required>
				
				<?php /***if ($is_member) { // 임시 저장된 글 기능 - 차후 추가 예정?>
				<script src="<?=G5_JS_URL; ?>/autosave.js"></script>
				<?php if($editor_content_js) echo $editor_content_js; ?>
				<button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?=$autosave_count; ?></span>)</button>
				<div id="autosave_pop">
					<strong>임시 저장된 글 목록</strong>
					<div><button type="button" class="autosave_close"><img src="<?=$board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
					<ul></ul>
					<div><button type="button" class="autosave_close"><img src="<?=$board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
				</div>
				<?php } ***/?>				
			</div>		
			
			<?php
			$option = '';
			$option_hidden = '';
			if ($is_notice || $is_html || $is_secret || $is_mail) {
				$option = '';
				if ($is_notice) {
					$option .= "\n".'<label class="input"><input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".' 공지</label>&nbsp;&nbsp;';
				}

				if ($is_html) {
					if ($is_dhtml_editor) {
						$option_hidden .= '<input type="hidden" value="html1" name="html">';
					} else {
						$option .= "\n".'<label class="input"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".' HTML</label>&nbsp;&nbsp;';
					}
				}

				if ($is_secret) {
					if ($is_admin || $is_secret==1) {
						$option .= "\n".'<label class="input"><input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".' 비밀글</label>&nbsp;&nbsp;';
					} else {
						$option_hidden .= '<input type="hidden" name="secret" value="secret">';
					}
				}

				if ($is_mail) {
					$option .= "\n".'<label class="input"><input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".' 답변메일받기</label>&nbsp;&nbsp;';
				}
			}
			echo $option_hidden;
			?>		
			<div class="options"><?=$option ?></div>			
		</div>
	</div>	

	
	<div class="editbox">
		<?php if($write_min || $write_max) { ?>
		<!-- 최소/최대 글자 수 사용 시 -->
		<p id="char_count_desc">이 게시판은 최소 <strong><?=$write_min; ?></strong>글자 이상, 최대 <strong><?=$write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
		<?php } ?>
		<?=$editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
		<?php if($write_min || $write_max) { ?>
		<!-- 최소/최대 글자 수 사용 시 -->
		<div id="char_count_wrap"><span id="char_count"></span>글자</div>
		<?php } ?>
	</div>		
	
	
	<div class="row">
	<?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
		<div class="col-xs-12 col-input">	
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">링크 #<?=$i ?></span>
				<input type="text" name="wr_link<?=$i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?=$i ?>" class="form-control input-sm" maxlength="100">
			</div>
		</div>
	 <?php } ?>
	 </div>

	 
	<div class="row">
	<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
		<div class="col-xs-12 col-input">	
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">파일 #<?=$i+1 ?></span>
				<?php
				if($w == 'u' && $file[$i]['file'])
					$msg = $file[$i]['source'].' ('.$file[$i]['size'].')';
				else
					$msg = $upload_max_filesize.' 이하의 파일만 업로드 가능';
				?>				
				<input type="text" class="form-control input-sm input-file" placeholder="<?=$msg?>" readonly>
				<span class="input-group-btn">
					<span class="btn btn-primary btn-file">
						<i class="glyphicon glyphicon-folder-open"></i> &nbsp;파일선택<input type="file" name="bf_file[]">
					</span>
				</span>
			</div>
			<?php if ($is_file_content) { ?>
			<input type="text" name="bf_content[]" value="<?=($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" placeholder="파일 설명을 입력해주세요." class="form-control input-sm" style="margin-top: 5px;">
			<?php } ?>			
			<?php if($w == 'u' && $file[$i]['file']) { ?>
			<label class="input"><input type="checkbox" id="bf_file_del<?=$i ?>" name="bf_file_del[<?=$i;  ?>]" value="1"> 이 첨부파일을 삭제</label>
			<?php } ?>			
		</div>
	<?php } ?>
	</div>


	<?php if ($is_guest) { //자동등록방지  ?>
	<div class="row">
		<div class="col-xs-12 col-input">	
			<?=$captcha_html ?>
		</div>
	</div>
	<?php } ?>	
	 
	 
	<hr style="margin-bottom: 10px">
	<div class="text-right">
        <a href="./board.php?bo_table=<?=$bo_table ?>" class="btn btn-sm btn-default">취소</a>
		<button type="submit" id="btn_submit" accesskey="s" class="btn btn-sm btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 작성완료</button>
	</div>
    </form>
</div>


<script>
$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [numFiles, label]);
});
$(document).ready( function() {
	$('#wr_content').css({minWidth: 100});
	
	$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
		$(this).parent().parent().parent().find('.input-file').addClass('placeholder').val(label)
	});
});	

<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?=$write_min; ?>); // 최소
var char_max = parseInt(<?=$write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
	$("#wr_content").on("keyup", function() {
		check_byte("wr_content", "char_count");
	});
});

<?php } ?>
function html_auto_br(obj)
{
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "html2";
		else
			obj.value = "html1";
	}
	else
		obj.value = "";
}

function fwrite_submit(f)
{
	try {
	
	<?=$editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});

	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어 있습니다.");
		f.wr_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어 있습니다.");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}

	if (document.getElementById("char_count")) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(check_byte("wr_content", "char_count"));
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			}
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}

	<?=$captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

	document.getElementById("btn_submit").disabled = "disabled";
	
	} catch(e) {
		console.log(e);
		return false;
	}
	return true;
}
</script>
