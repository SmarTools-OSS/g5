<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>


<div id="st-view" class="ans">
	<header class="info">
		<h4 class="subject"><i class="fa fa-reply" aria-hidden="true"></i> 답변: <?=get_text($answer['qa_subject']); ?></h4>
		<div class="desc">
			작성일시: <span class="sound_only">작성일</span><strong><?=date("Y-m-d H:i:s", strtotime($view['qa_datetime'])) ?></strong>
		</div>		
	</header>
	
	<div class="actions buttons">
		<div class="left">
			<?php if($answer_update_href) { ?>
			<a href="<?=$answer_update_href; ?>" class="btn btn-sm btn-danger">답변수정</a>
			<?php } ?>
			<?php if($answer_delete_href) { ?>
			<a href="<?=$answer_delete_href; ?>" class="btn btn-sm btn-danger" onclick="del(this.href); return false;">답변삭제</a>
			<?php } ?>		
		</div>
		<div class="right">
			<a href="<?=$rewrite_href; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> 추가질문</a>	
		</div>
	</div>

	<div class="content">
		<div class="text">
			<?=conv_content($answer['qa_content'], $answer['qa_html']); ?>
		</div>
	</div>	
</div>
