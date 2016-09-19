<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$mb_id = $member['mb_id'];
$sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b, {$g5['group_table']} c where a.bo_table = b.bo_table and b.gr_id = c.gr_id and b.bo_use_search = 1 ";
$sql_common .= " and a.wr_id = a.wr_parent and a.mb_id = '{$mb_id}' ";

$gr_id = isset($_GET['gr_id']) ? substr(preg_replace('#[^a-z0-9_]#i', '', $_GET['gr_id']), 0, 10) : '';
if ($gr_id) {
    $sql_common .= " and b.gr_id = '$gr_id' ";
}

$sql_order = " order by a.bn_id desc ";

$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = G5_IS_MOBILE ? $config['cf_mobile_page_rows'] : $config['cf_new_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$group_select = '<label for="gr_id" class="sound_only">그룹</label><select name="gr_id" id="gr_id" class="form-control input-sm"><option value="">전체그룹';
$sql = " select gr_id, gr_subject from {$g5['group_table']} order by gr_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $group_select .= "<option value=\"".$row['gr_id']."\">".$row['gr_subject'];
}
$group_select .= '</select>';

$list = array();
$sql = " select a.*, b.bo_subject, b.bo_mobile_subject, c.gr_subject, c.gr_id {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $tmp_write_table = $g5['write_prefix'].$row['bo_table'];

    if ($row['wr_id'] == $row['wr_parent']) {

        // 원글
        $comment = "";
        $comment_link = "";
        $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
        $list[$i] = $row2;

        $name = get_sideview($row2['mb_id'], get_text(cut_str($row2['wr_name'], $config['cf_cut_name'])), $row2['wr_email'], $row2['wr_homepage']);
        // 당일인 경우 시간으로 표시함
        $datetime = substr($row2['wr_datetime'],0,10);
        $datetime2 = $row2['wr_datetime'];
        if ($datetime == G5_TIME_YMD) {
            $datetime2 = substr($datetime2,11,5);
        } else {
            $datetime2 = substr($datetime2,5,5);
        }

    } 
	else {

        // 코멘트
        $comment = '[코] ';
        $comment_link = '#c_'.$row['wr_id'];
        $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
        $row3 = sql_fetch(" select mb_id, wr_name, wr_email, wr_homepage, wr_datetime from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
        $list[$i] = $row2;
        $list[$i]['wr_id'] = $row['wr_id'];
        $list[$i]['mb_id'] = $row3['mb_id'];
        $list[$i]['wr_name'] = $row3['wr_name'];
        $list[$i]['wr_email'] = $row3['wr_email'];
        $list[$i]['wr_homepage'] = $row3['wr_homepage'];

        $name = get_sideview($row3['mb_id'], get_text(cut_str($row3['wr_name'], $config['cf_cut_name'])), $row3['wr_email'], $row3['wr_homepage']);
        // 당일인 경우 시간으로 표시함
        $datetime = substr($row3['wr_datetime'],0,10);
        $datetime2 = $row3['wr_datetime'];
        if ($datetime == G5_TIME_YMD) {
            $datetime2 = substr($datetime2,11,5);
        } else {
            $datetime2 = substr($datetime2,5,5);
        }

    }


    $list[$i]['gr_id'] = $row['gr_id'];
    $list[$i]['bo_table'] = $row['bo_table'];
    $list[$i]['name'] = $name;
    $list[$i]['comment'] = $comment;
    $list[$i]['href'] = G5_BBS_URL.'/board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row2['wr_id'].$comment_link;
    $list[$i]['datetime'] = $datetime;
    $list[$i]['datetime2'] = $datetime2;

    $list[$i]['gr_subject'] = $row['gr_subject'];
    $list[$i]['bo_subject'] = ((G5_IS_MOBILE && $row['bo_mobile_subject']) ? $row['bo_mobile_subject'] : $row['bo_subject']);
    $list[$i]['wr_subject'] = $row2['wr_subject'];
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-mypage">
	<?php include_once 'mypage_header.skin.php'?>
	
	<div class="actions">
		<div class="right">
			<form name="fnew" method="get" class="form-inline">		
				<input type="hidden" name="mode" value="bbs">
				<div class="input-group input-group-sm">
					<?=$group_select ?>
					<span class="input-group-btn">
						<a href="<?=ST_MYPAGE_URL?>?mode=bbs" class="btn btn-sm btn-default btn-reset" title="리셋"><i class="fa fa-repeat" aria-hidden="true"></i></a>
						<button type="submit" value="검색" class="btn btn-sm btn-info" title="검색"><i class="fa fa-search" aria-hidden="true"></i> 검색</button>
					</span>
				</div>
			</form>
		</div>
	</div>	
	
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
        <td class="group"><a href="./?mode=bbs&gr_id=<?=$list[$i]['gr_id'] ?>"><?=$gr_subject ?></a></td>
        <td class="board hidden-xs-v"><a href="<?=G5_BBS_URL?>/board.php?bo_table=<?=$list[$i]['bo_table'] ?>"><?=$bo_subject ?></a></td>
        <td class="sbj">
			<a href="<?=G5_BBS_URL?>/board.php?bo_table=<?=$list[$i]['bo_table'] ?>" class="cat visible-xs-v-inline"><?=$bo_subject ?></a>
		
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
        echo '<tr><td colspan="'.($is_admin? 6: 5).'" class="empty_table">게시물이 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>	


	<div class="pages">
		<?=ST::get_paging($config['cf_write_pages'], $page, $total_page, "?mode=bbs&amp;gr_id=$gr_id&amp;view=$view&amp;page=")?>
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
</script>
