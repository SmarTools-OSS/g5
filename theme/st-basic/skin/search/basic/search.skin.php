<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);

$gr_str = '전체 분류';
$group_select = '<select name="gr_id" id="gr_id" class="form-control select-cat"><option value="">전체 분류';
$sql = " select gr_id, gr_subject from {$g5['group_table']} order by gr_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$selected = get_selected($_GET['gr_id'], $row['gr_id']);
    $group_select .= "<option value=\"".$row['gr_id']."\"".$selected.">".$row['gr_subject']."</option>";
	
	if( $selected )
		$gr_str = $row['gr_subject'];
}
$group_select .= '</select>';
?>


<div id="st-search">
	<div class="well well-sm text-center">		
		<h4><?=$gr_str ?>: "<?=$stx ?>" 검색결과 <br class="visible-xs"><small> - 게시판: <span class="sch_on"><?=$board_count ?>개</span> / 게시물: <span class="sch_on"><?=number_format($total_count) ?>개</span>&nbsp;&nbsp;(<?=number_format($page) ?>/<?=number_format($total_page? $total_page: 1) ?>페이지)</small></h4>		
		<hr>
	
		<form name="fsearch" onsubmit="return fsearch_submit(this);" method="get" class="form-inline text-center">
			<div class="form-group">
				<?=$group_select ?>
				
				<select name="sfl" id="sfl" class="form-control select-cat">
					<option value="wr_subject||wr_content"<?=get_selected($_GET['sfl'], "wr_subject||wr_content") ?>>제목+내용</option>
					<option value="wr_subject"<?=get_selected($_GET['sfl'], "wr_subject") ?>>제목</option>
					<option value="wr_content"<?=get_selected($_GET['sfl'], "wr_content") ?>>내용</option>
					<option value="mb_id"<?=get_selected($_GET['sfl'], "mb_id") ?>>회원아이디</option>
					<option value="wr_name"<?=get_selected($_GET['sfl'], "wr_name") ?>>이름</option>
				</select>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<input type="text" name="stx" value="<?=$text_stx ?>" id="stx" required class="form-control" placeholder="검색어를 입력해 주세요.">
					<div class="input-group-btn">			
						<button class="btn btn-info" type="submit"><i class="fa fa-search" aria-hidden="true"></i> 검색</button>						
					</div>
				</div>
			</div>

			<div class="form-group text-right">
				&nbsp;&nbsp;&nbsp;
				<label class="input"><input type="radio" value="and" <?=($sop == "and") ? "checked" : ""; ?> id="sop_and" name="sop"> AND</label>
				&nbsp;&nbsp;
				<label class="input"><input type="radio" value="or" <?=($sop == "or") ? "checked" : ""; ?> id="sop_or" name="sop"> OR</label>
			</div>
		</form>		
	</div>
	
	
	<div class="cat">
		<?php
		if ($stx) {
			if ($board_count) {
		 ?>
		<ul class="bbs">
			<li><a href="?<?=$search_query ?>&amp;gr_id=<?=$gr_id ?>" <?=$sch_all ?>>전체게시판</a></li>
			<?=$str_board_list; ?>
		</ul>
		<?php
			} else {
		 ?>
		<div class="empty"><i class="fa fa-info-circle" aria-hidden="true"></i> 검색된 자료가 없습니다.</div>
		<?php } }  ?>	
	</div>
	
	
	<div class="res">
		<?php if ($stx && $board_count) { ?><section class="sch_res_list"><?php }  ?>
		<?php
		$k=0;
		for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {
		 ?>
			<div class="header">
				<h4><a href="./board.php?bo_table=<?=$search_table[$idx] ?>&amp;<?=$search_query ?>"><?=$bo_subject[$idx] ?></a> <small>게시판 검색결과</small></h4>
			</div>
			<ul>
			<?php
			for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) {
				if ($list[$idx][$i]['wr_is_comment'])
				{
					$comment_def = '<span class="cmt_def">[댓글] </span>';
					$comment_href = '#c_'.$list[$idx][$i]['wr_id'];
				}
				else
				{
					$comment_def = '';
					$comment_href = '';
				}
			 ?>
				<li>
					<span class="title">
						<a href="<?=$list[$idx][$i]['href'] ?><?=$comment_href ?>"><i class="fa fa-book" aria-hidden="true"></i> <?=$comment_def ?><?=$list[$idx][$i]['subject'] ?></a>
						<small>&nbsp;&nbsp;<a href="<?=$list[$idx][$i]['href'] ?><?=$comment_href ?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> 새창</a></small>
					</span>						
					<p class="desc"><?=$list[$idx][$i]['content'] ?></p>
					
					<span class="user"><i class="fa fa-<?=$list[$idx][$i]['mb_id']? 'user': 'tint'?>" title="<?=$list[$idx][$i]['mb_id']? '회원': '비회원'?>" aria-hidden="true"></i> <?=$list[$idx][$i]['wr_name']?></span>
					<?php //echo $list[$idx][$i]['name'] ?>
					<span class="datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> <?=$list[$idx][$i]['wr_datetime'] ?></span>
				</li>
			<?php }  ?>
			</ul>
			<div class="more"><a href="./board.php?bo_table=<?=$search_table[$idx] ?>&amp;<?=$search_query ?>"><strong><?=$bo_subject[$idx] ?></strong> 결과 더보기 <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></div>

			<br><br>
		<?php }  ?>
		<?php if ($stx && $board_count) {  ?></section><?php }  ?>

		<?=$write_pages ?>	
	</div>
</div>


<script>
$(function() {
	$('#st-search ul.bbs li a').addClass('btn btn-default');
	$('#st-search ul.bbs li a .cnt_cmt').each(function(index) {
		$(this).html(' <small>[' + $(this).html() + ']</small>');
	});
});	
function fsearch_submit(f)
{
	if (f.stx.value.length < 2) {
		alert("검색어는 두글자 이상 입력하십시오.");
		f.stx.select();
		f.stx.focus();
		return false;
	}

	// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
	var cnt = 0;
	for (var i=0; i<f.stx.value.length; i++) {
		if (f.stx.value.charAt(i) == ' ')
			cnt++;
	}

	if (cnt > 1) {
		alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
		f.stx.select();
		f.stx.focus();
		return false;
	}

	f.action = "";
	return true;
}	
</script>
