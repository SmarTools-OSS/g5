<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// DHTML 에디터 미 사용 시, 태그 처리
if( is_mobile() or (!is_mobile() and !$is_dhtml_editor) ) {
	$editor_html = ST::editor_html('qa_content', $content);
	$editor_js = '';
	$editor_js .= ST::get_editor_js('qa_content');
	$editor_js .= ST::chk_editor_js('qa_content');	
}
?>


<div id="st-write" class="ans">
    <?php if($is_admin) { // 관리자이면 답변등록?>
    <h4><i class="fa fa-reply" aria-hidden="true"></i> 답변등록</h4>

    <form name="fanswer" method="post" action="./qawrite_update.php" onsubmit="return fwrite_submit(this);" autocomplete="off">
    <input type="hidden" name="qa_id" value="<?=$view['qa_id']; ?>">
    <input type="hidden" name="w" value="a">
    <input type="hidden" name="sca" value="<?=$sca ?>">
    <input type="hidden" name="stx" value="<?=$stx; ?>">
    <input type="hidden" name="page" value="<?=$page; ?>">
    <?php
    $option = '';
    $option_hidden = '';
    $option = '';

    if ($is_dhtml_editor) {
        $option_hidden .= '<input type="hidden" name="qa_html" value="1">';
    } else {
        $option .= "\n".'<input type="checkbox" id="qa_html" name="qa_html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="qa_html">html</label>';
    }

    echo $option_hidden;
    ?>
	
	<div class="row">
		<div class="col-xs-12 col-input">
			<div id="autosave_wrapper" class="input-group input-group-sm">
				<span class="input-group-addon input-group-addon-sm">제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목</span>
				<input type="text" name="qa_subject" value="" id="qa_subject" class="form-control input-sm" maxlength="255" placeholder="제목을 입력해 주세요"  required>
			</div>
			
			 <?php if ($option) { ?>
			<div class="options"><?=$option ?></div>
			<?php } ?>
		</div>
	</div>
	
	<div class="editbox">
		<?=$editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
	</div>

    <div class="text-right">
		<button type="submit" id="btn_submit" accesskey="s" class="btn btn-sm btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 답변쓰기</button>
    </div>
    </form>
	
    <?php } else { ?>
    <p class="msg"><i class="fa fa-info-circle" aria-hidden="true"></i> 고객님의 문의에 대한 답변을 준비 중입니다.</p>
    <?php } ?>	
</div>


<?php if($is_admin) { ?>
<script>
$(document).ready( function() {
	$('#qa_content').css({minWidth: 100});
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

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
</script>
<?php } ?>	
