<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-popup" class="st-mbr scrap">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-bookmark" aria-hidden="true"></i> 스크랩 하기</h3>
	</div>
	
	
    <form name="f_scrap_popin" action="./scrap_popin_update.php" method="post">
    <input type="hidden" name="bo_table" value="<?=$bo_table ?>">
    <input type="hidden" name="wr_id" value="<?=$wr_id ?>">

	<div class="form-group">
		<div><strong>게시물 제목:</strong></div>
		<?=get_text(cut_str($write['wr_subject'], 255)) ?>
	</div>
	
	<div class="form-group">
		<strong>댓글:</strong>
		<textarea name="wr_content" id="wr_content" class="form-control" required><?=$content ?></textarea>
		<p class="desc"><i class="fa fa-info-circle" aria-hidden="true"></i> 스크랩을 하시면서 감사 혹은 격려의 댓글을 남기실 수 있습니다.</p>
	</div>
	
	
	<hr>
	<div class="text-right">
		<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>
		<button type="submit" class="btn btn-primary" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 확인</button>	
	</div>		
	</form>	
</div>
