<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 선택삭제으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_admin) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$new_skin_url.'/style.css">', 0);
?>


<div id="st-basic">
	<div class="page-header">
		<h3 class="title">새글 <small>게시물/댓글</small></h3>
	</div>
	
	
	<div class="info clearfix">
		<div class="left">
			<span><?=$mb_id? '회원아이디': '전체'?>: <?=($mb_id)? '"'.$mb_id.'" 검색결과 - ': ''?><?=number_format($total_count) ?>개 (<?=number_format($page).'/'.number_format($total_page? $total_page: 1)?>페이지)</span>	
		</div>			
		<div class="right">
			<form name="fnew" method="get" class="form-inline">
				<?=$group_select ?>
				<label for="view" class="sound_only">검색대상</label>
				<select name="view" id="view" class="form-control input-sm">
					<option value="">전체게시물
					<option value="w">원글만
					<option value="c">댓글만
				</select>
				
				<div class="input-group input-group-sm">
					<input type="text" name="mb_id" value="<?=$mb_id ?>" id="mb_id" class="form-control input-sm required" placeholder="회원 아이디만 검색 가능" required>
					<span class="input-group-btn">
						<a href="./new.php" class="btn btn-sm btn-default btn-reset" title="리셋"><i class="fa fa-repeat" aria-hidden="true"></i></a>
						<button type="submit" value="검색" class="btn btn-sm btn-info" title="검색"><i class="fa fa-search" aria-hidden="true"></i> 검색</button>
					</span>
				</div>
			</form>
		</div>
	</div>	

	
	<form name="fnewlist" method="post" action="#" onsubmit="return fnew_submit(this);">
	<input type="hidden" name="sw"       value="move">
	<input type="hidden" name="view"     value="<?=$view; ?>">
	<input type="hidden" name="sfl"      value="<?=$sfl; ?>">
	<input type="hidden" name="stx"      value="<?=$stx; ?>">
	<input type="hidden" name="bo_table" value="<?=$bo_table; ?>">
	<input type="hidden" name="page"     value="<?=$page; ?>">
	<input type="hidden" name="pressed"  value="">	

    <table class="table table-hover">
    <thead>
    <tr>
        <?php if ($is_admin) { ?>
        <th scope="col" class="chk">
            <label for="all_chk" class="sound_only">목록 전체</label>
            <input type="checkbox" id="all_chk">
        </th>
        <?php } ?>
        <th scope="col" class="group">그룹</th>
        <th scope="col" class="board hidden-xs-v">게시판</th>
        <th scope="col" class="sbj">제목</th>
        <th scope="col" class="name hidden-xs">글쓴이</th>
        <th scope="col" class="date hidden-xs">일시</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i<count($list); $i++)
    {
        $num = $total_count - ($page - 1) * $config['cf_page_rows'] - $i;
        $gr_subject = cut_str($list[$i]['gr_subject'], 20);
        $bo_subject = cut_str($list[$i]['bo_subject'], 20);
        $wr_subject = get_text(cut_str($list[$i]['wr_subject'], 80));
    ?>
	<tr onclick="return onRowClick(event, '<?=$list[$i]['href'] ?>');">
        <?php if ($is_admin) { ?>
        <td class="chk">
            <label for="chk_bn_id_<?=$i; ?>" class="sound_only"><?=$num?>번</label>
            <input type="checkbox" name="chk_bn_id[]" value="<?=$i; ?>" id="chk_bn_id_<?=$i; ?>">
            <input type="hidden" name="bo_table[<?=$i; ?>]" value="<?=$list[$i]['bo_table']; ?>">
            <input type="hidden" name="wr_id[<?=$i; ?>]" value="<?=$list[$i]['wr_id']; ?>">
        </td>
        <?php } ?>
        <td class="group"><a href="./new.php?gr_id=<?=$list[$i]['gr_id'] ?>"><?=$gr_subject ?></a></td>
        <td class="board hidden-xs-v"><a href="./board.php?bo_table=<?=$list[$i]['bo_table'] ?>"><?=$bo_subject ?></a></td>
        <td class="sbj">
			<a href="./board.php?bo_table=<?=$list[$i]['bo_table'] ?>" class="cat visible-xs-v-inline"><?=$bo_subject ?></a>
		
			<?php if ($list[$i]['comment']) { ?><small class="comment">[댓글]</small><?php } ?>
			<a href="<?=$list[$i]['href'] ?>"><?=$wr_subject ?></a>
			
			<?php $mb_name = ST::get_mb_icon($list[$i]['mb_id'], $list[$i]['name']).' '.$list[$i]['wr_name']; ?>
			<div class="desc visible-xs">
				<?=$mb_name?>
				&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> <?=$list[$i]['datetime2'] ?>
			</div>			
		</td>
        <td class="name ellipsis hidden-xs">
			<?=$mb_name?>		
		</td>
        <td class="date hidden-xs"><?=$list[$i]['datetime2'] ?></td>
    </tr>
    <?php }  ?>

    <?php if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>	
	
	
	<?php if ($is_admin) { ?>
	<div class="actions buttons">
		<div class="left">
			<input type="submit" onclick="document.pressed=this.value" value="선택삭제" class="btn btn-sm btn-danger">
		</div>
	</div>	
	<?php } ?>
	</form>
	
	
	<div class="pages">
		<?=ST::get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "?gr_id=$gr_id&amp;view=$view&amp;mb_id=$mb_id&amp;page=")?>
	</div>	
</div>


<script>
$(function() {
	$('#gr_id').addClass('form-control input-sm');
	<?php if( $gr_id ) { ?>
	$('#gr_id option[value=<?=$gr_id ?>]').attr('selected', 'selected');
	<?php } ?>
	<?php if( $view ) { ?>
	$('#view').value('<?=$view ?>');
	<?php } ?>
});
function onRowClick (e, href) {
	<?php if ($is_admin) { ?>
	if( e.target.cellIndex==0 || e.target.cellIndex==4 || typeof e.target.cellIndex=='undefined' )
		return;	
	<?php } else { ?>
	if( e.target.cellIndex==3 || typeof e.target.cellIndex=='undefined' )
		return;	
	<?php } ?>	
	
	document.location.href = href;
}

<?php if ($is_admin) { ?>
$(function(){
    $('#all_chk').click(function(){
        $('[name="chk_bn_id[]"]').attr('checked', this.checked);
    });
});
function fnew_submit(f)
{
    f.pressed.value = document.pressed;

    var cnt = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_bn_id[]" && f.elements[i].checked)
            cnt++;
    }

    if (!cnt) {
        alert(document.pressed+"할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if (!confirm("선택한 게시물을 정말 "+document.pressed+" 하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다")) {
        return false;
    }

    f.action = "./new_delete.php";

    return true;
}
<?php } ?>
</script>
