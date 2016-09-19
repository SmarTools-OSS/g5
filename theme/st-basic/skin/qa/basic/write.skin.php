<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);

// DHTML 에디터 미 사용 시, 태그 처리
if( is_mobile() or (!is_mobile() and !$is_dhtml_editor) ) {
	$editor_html = ST::editor_html('qa_content', $content);
	$editor_js = '';
	$editor_js .= ST::get_editor_js('qa_content');
	$editor_js .= ST::chk_editor_js('qa_content');	
}
?>


<div id="st-write">
	<?php if( !$qaconfig['qa_include_head'] and !$qaconfig['qa_content_head'] ):?>
	<div class="page-header">
		<h3 class="title">1:1 문의 <small>등록</small></h3>
		<span class="sr-only">등록</span>
	</div>
	<?php endif?>
	
	
    <form name="fwrite" id="fwrite" action="<?=$action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?=$w ?>">
    <input type="hidden" name="qa_id" value="<?=$qa_id ?>">
    <input type="hidden" name="sca" value="<?=$sca ?>">
    <input type="hidden" name="stx" value="<?=$stx ?>">
    <input type="hidden" name="page" value="<?=$page ?>">
		
	<?php if ($category_option) { ?>
	<div class="row">
		<div class="col-xs-6 col-xs-v12 col-input">
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">분&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;류</span>
				<select name="qa_category" id="qa_category" class="form-control input-sm" required>
					<option value="">선택하세요</option>
					<?=$category_option ?>
				</select>	
			</div>
		</div>
	</div>	
	<?php } ?>
	
	<div class="row">
		<?php if ($is_email) { ?>
		<div class="col-xs-6 col-xs-v12 col-input">
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">이&nbsp;메&nbsp;일</span>
				<input type="text" name="qa_email" id="qa_email" value="<?=get_text($write['qa_email']); ?>" class="form-control input-sm email <?=$req_email?>" maxlength="100" title="이메일" <?=$req_email?>>
			</div>
			<div class="options"><label class="input input-sub"><input type="checkbox" name="qa_email_recv" value="1" <?php if($write['qa_email_recv']) echo 'checked="checked"'; ?>> 답변메일받기</label></div>
		</div>
		<?php } ?>
	
		<?php if ($is_hp) { ?>
		<div class="col-xs-6 col-xs-v12 col-input">
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">휴&nbsp;대&nbsp;폰</span>
				<input type="text" name="qa_hp" id="qa_hp" value="<?=get_text($write['qa_hp']); ?>" class="form-control input-sm telnum <?=$req_hp?>" maxlength="15" title="휴대폰" <?=$req_hp?>>
			</div>
			<?php if($qaconfig['qa_use_sms']) { ?>
			<div class="options"><label class="input input-sub"><input type="checkbox" name="qa_sms_recv" value="1" <?php if($write['qa_sms_recv']) echo 'checked="checked"'; ?>> 답변등록 SMS알림 수신</label></div>
			<?php } ?>
		</div>
		<?php } ?>
	</div>		
		
	<div class="row">
		<div class="col-xs-12 col-input">
			<div id="autosave_wrapper" class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목</span>
				<input type="text" name="qa_subject" id="qa_subject" value="<?=get_text($write['qa_subject']); ?>" class="form-control input-sm required" maxlength="255" title="제목" placeholder="제목을 입력해 주세요" required>		
			</div>		
			
			<?php
			$option = '';
			$option_hidden = '';
			$option = '';

			if ($is_dhtml_editor) {
				$option_hidden .= '<input type="hidden" name="qa_html" value="1">';
			} else {
				$option .= "\n".'<label class="input"><input type="checkbox" id="qa_html" name="qa_html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'> HTML</label>';
			}

			echo $option_hidden;
			?>
			<div class="options"><?=$option ?></div>
		</div>
	</div>

	
	<div class="editbox">
		<?=$editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
	</div>
	
	
	<div class="row">
	<?php for ($i=1; $i<=2; $i++) { ?>	
		<div class="col-xs-12 col-input">	
			<div class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">파일 #<?=$i ?></span>
				<?php
				if($w == 'u' && $write['qa_file'.$i])
					$msg = $write['qa_source'.$i];
				else
					$msg = $upload_max_filesize.' 이하의 파일만 업로드 가능';
				?>				
				<input type="text" class="form-control input-sm input-file" placeholder="<?=$msg?>" readonly>
				<span class="input-group-btn">
					<span class="btn btn-primary btn-file">
						<i class="glyphicon glyphicon-folder-open"></i> &nbsp;파일선택<input type="file" name="bf_file[<?=$i?>]">
					</span>
				</span>
			</div>	
			<?php if($w == 'u' && $write['qa_file'.$i]) { ?>
			<label class="input"><input type="checkbox" id="bf_file_del<?=$i ?>" name="bf_file_del[<?=$i?>]" value="1"> 이 첨부파일을 삭제</label>
			<?php } ?>			
		</div>
	<?php } ?>
	</div>	
	
	
	<hr style="margin-bottom: 10px">
	<div class="text-right">
        <a href="<?=$list_href; ?>" class="btn btn-sm btn-default">취소</a>
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
	$('#qa_content').css({minWidth: 100});
	
	$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
		$(this).parent().parent().parent().find('.input-file').addClass('placeholder').val(label)
	});
});	

function html_auto_br(obj)
{
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "2";
		else
			obj.value = "1";
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
			"subject": f.qa_subject.value,
			"content": f.qa_content.value
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
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.qa_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_qa_content) != "undefined")
			ed_qa_content.returnFalse();
		else
			f.qa_content.focus();
		return false;
	}

	<?php if ($is_hp) { ?>
	var hp = f.qa_hp.value.replace(/[0-9\-]/g, "");
	if(hp.length > 0) {
		alert("휴대폰번호는 숫자, - 으로만 입력해 주십시오.");
		return false;
	}
	<?php } ?>

	document.getElementById("btn_submit").disabled = "disabled";

	} catch(e) {
		console.log(e);
		return false;
	}	
	return true;
}	
</script>
