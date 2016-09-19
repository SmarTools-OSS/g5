<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>


<div id="st-basic">
	<?php if( !$board['bo_content_head'] ) { ?>
	<div class="page-header">
		<h3 class="title"><?=$board['bo_subject']?> <small>목록</small></h3>
		<span class="sr-only">목록</span>
	</div>
	<?php } ?>
	

	<div class="actions info">
		<div class="left">
			<span><?=$sca? $sca: '전체'?>: <?=($stx)? '"'.$stx.'" 검색결과 - ': ''?><?=number_format($total_count) ?>개 (<?=number_format($page).'/'.number_format($total_page? $total_page: 1)?>페이지)</span>	
		</div>			
		<div class="right">
			<?php if ($admin_href) { ?><a href="<?=$admin_href ?>" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-cog" aria-hidden="true"></i> 관리</a><?php } ?>
			<?php if ($rss_href) { ?><a href="<?=$rss_href ?>" class="btn btn-sm btn-default"><i class="fa fa-rss" aria-hidden="true"></i> RSS</a><?php } ?>
			<?php if ($is_category) { ?>
			<div class="btn-group">
				<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=$sca? $sca: '전체'?> <span class="caret"></span></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<?=$category_option ?>
				</ul>
			</div>
			<?php } ?>					
			<?php if ($write_href) { ?><a href="<?=$write_href.($sca? '&sca='.$sca: '')?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a><?php } ?>	
		</div>
	</div>
	
	
	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
	<input type="hidden" name="bo_table" value="<?=$bo_table ?>">
	<input type="hidden" name="sfl" value="<?=$sfl ?>">
	<input type="hidden" name="stx" value="<?=$stx ?>">
	<input type="hidden" name="spt" value="<?=$spt ?>">
	<input type="hidden" name="sca" value="<?=$sca ?>">
	<input type="hidden" name="sst" value="<?=$sst ?>">
	<input type="hidden" name="sod" value="<?=$sod ?>">
	<input type="hidden" name="page" value="<?=$page ?>">
	<input type="hidden" name="sw" value="">
		
	<table class="table table-hover">
		<caption><?=$board['bo_subject'] ?> 목록</caption>
		<thead>
		<tr>
			<th scope="col" class="num hidden-xs">번호</th>
			<?php if ($is_checkbox) { ?>
			<th scope="col" class="chk">
				<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
				<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
			</th>
			<?php } ?>
			<th scope="col" class="sbj">제목</th>
			<th scope="col" class="name hidden-xs-v">글쓴이</th>
			<th scope="col" class="hit hidden-xs-v"><?=subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></th>
			<?php if ($is_good) { ?><th scope="col" class="good hidden-xs-v"><?=subject_sort_link('wr_good', $qstr2, 1) ?>추천</a></th><?php } ?>
			<?php if ($is_nogood) { ?><th scope="col" class="nogood hidden-xs-v"><?=subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천</a></th><?php } ?>
			<th scope="col" class="date"><?=subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</a></th>
		</tr>
		</thead>
		<tbody>
		<?php for ($i=0; $i<count($list); $i++) { ?>
		<tr onclick="return onRowClick(event, '<?=$list[$i]['href'] ?>');"<?php if ($list[$i]['is_notice']) echo ' class="notice"'?>>
			<td class="num hidden-xs">
			<?php
			if ($list[$i]['is_notice']) // 공지사항
				echo '<span class="label label-primary"><i class="fa fa-bell" aria-hidden="true" title="공지"></i></span>';
			else if ($wr_id == $list[$i]['wr_id'])
				echo '<span class="current">&gt;&gt;</span>';
			else
				echo $list[$i]['num'];
			 ?>
			</td>
			<?php if ($is_checkbox) { ?>
			<td class="chk">
				<label for="chk_wr_id_<?=$i ?>" class="sound_only"><?=$list[$i]['subject'] ?></label>
				<input type="checkbox" name="chk_wr_id[]" value="<?=$list[$i]['wr_id'] ?>" id="chk_wr_id_<?=$i ?>">
			</td>
			<?php } ?>
			<td class="sbj">
				<?php if ($list[$i]['is_notice']) { // 공지?>
				<span class="visible-xs-inline-block"><span class="label label-primary"><i class="fa fa-bell" aria-hidden="true" title="공지"></i></span>&nbsp;</span>
				<?php } elseif ($wr_id == $list[$i]['wr_id']) { ?>
				<span class="visible-xs-inline-block"><span class="current">&gt;&gt;</span>&nbsp;</span>
				<?php } ?>				
				<?php if ($list[$i]['icon_secret']) { // 비밀글?>
				<span class="label label-warning"><i class="fa fa-lock" aria-hidden="true" title="비밀글"></i></span>&nbsp;
				<?php } ?>			
				<?php
				echo $list[$i]['icon_reply'];
				if ($is_category && $list[$i]['ca_name']) {
				 ?>
				<a href="<?=$list[$i]['ca_name_href'] ?>" class="cat"><?=$list[$i]['ca_name'] ?></a>
				<?php } ?>

				<a href="<?=$list[$i]['href'] ?>"><?=$list[$i]['subject'] ?></a>
				<?php
				if (!empty($list[$i]['icon_file'])) echo '<span class="icon" title="첨부파일"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>';
				if (!empty($list[$i]['icon_link'])) echo '<span class="icon" title="링크"><i class="fa fa-link" aria-hidden="true"></i></span>';
				if (!empty($list[$i]['icon_hot'])) echo '<span class="icon icon-hot" title="이슈"><i class="fa fa-heart" aria-hidden="true"></i></span>';
				 ?>
				<?php if ($list[$i]['comment_cnt']) { ?><small class="comment">[<?=$list[$i]['comment_cnt']; ?>]</small><?php } ?>
				<?php if ($list[$i]['icon_new']) { ?><small class="new">new</small><?php } ?>
				 
				<?php $mb_name = ST::get_mb_icon($list[$i]['mb_id'], $list[$i]['name']).' '.$list[$i]['wr_name']; ?>
				<?php $mb_menu = $board['bo_use_sideview']? ST::get_mb_menu($list[$i]['mb_id'], $list[$i]['wr_name']): ''; ?>
				<div class="desc visible-xs-v">
					<?php if( $mb_menu ) { ?>
					<div class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">					
							<?=$mb_name?>
						</a>
						<?=$mb_menu?>
					</div>				
					<?php } else { ?>
					<?=$mb_name?>
					<?php } ?>
					&nbsp;&nbsp;<i class="fa fa-check" aria-hidden="true"></i> <?=number_format($list[$i]['wr_hit']) ?>
					<?php if ($is_good) { ?>&nbsp;&nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i> <?=$list[$i]['wr_good'] ?><?php } ?>
					<?php if ($is_nogood) { ?>&nbsp;&nbsp;<i class="fa fa-thumbs-down" aria-hidden="true"></i> <?=$list[$i]['wr_nogood'] ?><?php } ?>
				</div>
			</td>
			<td class="hidden-xs-v">
				<?php if( $mb_menu ) { ?>
				<div class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">					
						<div class="name ellipsis"><?=$mb_name?></div>
					</a>
					<?=$mb_menu?>
				</div>
				<?php } else { ?>
				<div class="name ellipsis">
					<?=$mb_name?>
				</div>		
				<?php } ?>
			</td>
			<td class="hidden-xs-v"><?=$list[$i]['wr_hit'] ?></td>
			<?php if ($is_good) { ?><td class="hidden-xs-v"><?=$list[$i]['wr_good'] ?></td><?php } ?>
			<?php if ($is_nogood) { ?><td class="hidden-xs-v"><?=$list[$i]['wr_nogood'] ?></td><?php } ?>
			<td><?=$list[$i]['datetime2'] ?></td>
		</tr>
		<?php } ?>
		<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
		</tbody>
	</table>	

	
	<div class="actions button">
		<div class="left">
			<a href="<?='./board.php?bo_table='.$bo_table?>" class="btn btn-sm btn-default">처음목록</a>
			<?php if ($is_checkbox) { ?>
			<input type="submit" name="btn_submit" value="선택삭제" class="btn btn-sm btn-danger" onclick="document.pressed=this.value">
			<input type="submit" name="btn_submit" value="선택복사" class="btn btn-sm btn-danger" onclick="document.pressed=this.value">
			<input type="submit" name="btn_submit" value="선택이동" class="btn btn-sm btn-danger" onclick="document.pressed=this.value">
			<?php } ?>
		</div>

		<?php if ($write_href) { ?>
		<div class="right">
			<a href="<?=$write_href.($sca? '&sca='.$sca: '')?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a>
		</div>
		<?php } ?>
	</div>
	</form>
		
		
	<?php if($is_checkbox) { ?>
	<noscript>
	<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
	</noscript>
	<?php } ?>

	<!-- 페이지 이동 -->
	<div class="pages">
		<?=ST::get_paging($config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&amp;page=')?>
	</div>

	<!-- 게시판 검색 시작 { -->
	<fieldset id="search" class="search">
		<form name="fsearch" method="get" class="form-inline">
		<input type="hidden" name="bo_table" value="<?=$bo_table ?>">
		<input type="hidden" name="sca" value="<?=$sca ?>">
		<input type="hidden" name="sop" value="and">
		<label for="sfl" class="sound_only">검색대상</label>
		<select name="sfl" id="sfl" class="form-control input-sm">
			<option value="wr_subject"<?=get_selected($sfl, 'wr_subject', true); ?>>제목</option>
			<option value="wr_content"<?=get_selected($sfl, 'wr_content'); ?>>내용</option>
			<option value="wr_subject||wr_content"<?=get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
			<option value="mb_id,1"<?=get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
			<option value="mb_id,0"<?=get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
			<option value="wr_name,1"<?=get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
			<option value="wr_name,0"<?=get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
		</select>
		
		<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
		<div class="input-group input-group-sm">
			<input type="text" name="stx" value="<?=stripslashes($stx) ?>" id="stx" class="form-control input-sm input-search required" maxlength="20" placeholder="검색어" required>
			<span class="input-group-btn">
				<a href="<?='./board.php?bo_table='.$bo_table?>" class="btn btn-sm btn-default btn-reset" title="리셋"><i class="fa fa-repeat" aria-hidden="true"></i></a>
				<button type="submit" value="검색" class="btn btn-sm btn-info" title="검색"><i class="fa fa-search" aria-hidden="true"></i> 검색</button>
			</span>
		</div>
		</form>
	</fieldset>
	<!-- } 게시판 검색 끝 -->	
</div>


<script>
function onRowClick (e, href) {
	<?php if ($is_checkbox) { ?>
	if( e.target.cellIndex==1 || typeof e.target.cellIndex=='undefined' )
		return;
	<?php } else { ?>
	if( e.target.cellIndex==3 || typeof e.target.cellIndex=='undefined' )
		return;	
	<?php } ?>
	
	document.location.href = href;
}

<?php if ($is_category) { ?>
$(function() {
	$('#bo_cate_on').parent().addClass('active');
});
<?php } ?>

<?php if ($is_checkbox) { ?>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./adm_move.php";
    f.submit();
}
<?php } ?>
</script>