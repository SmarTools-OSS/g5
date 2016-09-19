<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);
?>


<div id="st-basic">
	<?php if( !$qaconfig['qa_include_head'] and !$qaconfig['qa_content_head'] ):?>
	<div class="page-header">
		<h3 class="title">1:1 문의 <small>목록</small></h3>
		<span class="sr-only">목록</span>
	</div>
	<?php endif?>
	

	<div class="actions info">
		<div class="left">
			<span><?=$sca? $sca: '전체'?>: <?=($stx)? '"'.$stx.'" 검색결과 - ': ''?><?=number_format($total_count) ?>개 (<?=number_format($page).'/'.number_format($total_page? $total_page: 1)?>페이지)</span>	
		</div>			
		<div class="right">
			<?php if ($admin_href) { ?><a href="<?=$admin_href ?>" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-cog" aria-hidden="true"></i> 관리</a><?php } ?>
			<?php if ($rss_href) { ?><a href="<?=$rss_href ?>" class="btn btn-sm btn-default"><i class="fa fa-rss" aria-hidden="true"></i> RSS</a><?php } ?>
			<?php if ($category_option) { ?>
			<div class="btn-group">
				<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=$sca? $sca: '전체'?> <span class="caret"></span></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<?=$category_option ?>
				</ul>
			</div>
			<?php } ?>					
			<?php if ($write_href) { ?><a href="<?=$write_href.($sca? '?sca='.$sca: '')?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> 문의등록</a><?php } ?>	
		</div>
	</div>
		
	
    <form name="fqalist" id="fqalist" action="./qadelete.php" onsubmit="return fqalist_submit(this);" method="post">
    <input type="hidden" name="stx" value="<?=$stx; ?>">
    <input type="hidden" name="sca" value="<?=$sca; ?>">
    <input type="hidden" name="page" value="<?=$page; ?>">
		
	<table class="table table-hover">
		<caption><?=$board['bo_subject'] ?> 목록</caption>
		<thead>
		<tr>
			<th scope="col" class="num hidden-xs">번호</th>
            <?php if ($is_checkbox) { ?>
            <th scope="col" class="chk">
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
			<th scope="col" class="sbj">제목</th>
			<th scope="col" class="name hidden-xs-v">글쓴이</th>
			<th scope="col" class="status">상태</a></th>
			<th scope="col" class="date hidden-xs-v">등록일</a></th>
		</tr>
		</thead>
		<tbody>
		<?php for ($i=0; $i<count($list); $i++) { ?>
		<tr onclick="return onRowClick(event, '<?=$list[$i]['view_href'] ?>');">
			<td class="num hidden-xs"><?=$list[$i]['num']; ?></td>
            <?php if ($is_checkbox) { ?>
            <td class="chk">
                <label for="chk_qa_id_<?=$i ?>" class="sound_only"><?=$list[$i]['subject']; ?></label>
                <input type="checkbox" name="chk_qa_id[]" value="<?=$list[$i]['qa_id'] ?>" id="chk_qa_id_<?=$i ?>">				
            </td>
            <?php } ?>
			<td class="sbj">
				<a href="<?=$list_href.'?sca='.$list[$i]['category']?>" class="cat"><?=$list[$i]['category'] ?></a>

				<a href="<?=$list[$i]['view_href'] ?>"><?=$list[$i]['subject'] ?></a>
				<?php
				if (!empty($list[$i]['icon_file'])) echo '<span class="icon" title="첨부파일"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>';
				 ?>
				
				<?php $mb_name = ST::get_mb_icon($list[$i]['mb_id']).' '.$list[$i]['qa_name']; ?>
				<div class="desc visible-xs-v">
					<?=$mb_name?>
					&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> <?=$list[$i]['date'] ?>
				</div>
			</td>
			<td class="hidden-xs-v">
				<div class="name ellipsis">
					<?=$mb_name?>
				</div>
			</td>
			<td class="status"><?=($list[$i]['qa_status'] ? '<span class="label label-success">답변완료</span>' : '<span class="label label-warning">답변대기</span>'); ?></td>
			<td class="hidden-xs-v"><?=$list[$i]['date']; ?></td>
		</tr>
		<?php } ?>
		<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
		</tbody>
	</table>	

	
	<div class="actions buttons">
		<div class="left">
			<?php if ($list_href) { ?><a href="<?=$list_href?>" class="btn btn-sm btn-default">처음목록</a><?php } ?>
			<?php if ($is_checkbox) { ?>
			<input type="submit" name="btn_submit" value="선택삭제" class="btn btn-sm btn-danger" onclick="document.pressed=this.value">
			<?php } ?>
		</div>
		
		<?php if ($write_href) { ?>
		<div class="right">
			<a href="<?=$write_href.($sca? '?sca='.$sca: '')?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> 문의등록</a>
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
		<?=preg_replace('/(\.php)(&amp;|&)/i', '$1?', ST::get_paging($qaconfig['qa_page_rows'], $page, $total_page, './qalist.php'.$qstr.'&amp;page=')); ?>
	</div>

	<!-- 게시판 검색 시작 { -->
	<fieldset id="search" class="search">
		<form name="fsearch" method="get" class="form-inline">
			<input type="hidden" name="sca" value="<?=$sca ?>">
			<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
			
			<div class="input-group input-group-sm">
				<input type="text" name="stx" value="<?=stripslashes($stx) ?>" id="stx" class="form-control input-sm input-search required" maxlength="20" placeholder="검색어" required>
				<span class="input-group-btn">
					<a href="<?=$list_href?>" class="btn btn-sm btn-default btn-reset" title="리셋"><i class="fa fa-repeat" aria-hidden="true"></i></a>
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
	<?php } ?>
	
	document.location.href = href;
}

<?php if ($category_option) { ?>
$(function() {
	$('#bo_cate_on').parent().addClass('active');
});
<?php } ?>

<?php if ($is_checkbox) { ?>
function all_checked(sw) {
    var f = document.fqalist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]")
            f.elements[i].checked = sw;
    }
}
function fqalist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
            return false;
    }

    return true;
}
<?php } ?>
</script>