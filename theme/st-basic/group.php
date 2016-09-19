<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/group.php');
    return;
}

if(!$is_admin && $group['gr_device'] == 'mobile')
    alert($group['gr_subject'].' 그룹은 모바일에서만 접근할 수 있습니다.');

$g5['title'] = $group['gr_subject'];
include_once(G5_THEME_PATH.'/head.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
?>


<?php
//  최신글
$sql = " select bo_table, bo_subject
            from {$g5[board_table]}
            where gr_id = '{$gr_id}'
              and bo_list_level <= '{$member[mb_level]}'
              and bo_device <> 'mobile' ";
if(!$is_admin)
    $sql .= " and bo_use_cert = '' ";
$sql .= " order by bo_order ";
$result = sql_query($sql);
?>
<div class="row">
	<?php for ($i=0; $row=sql_fetch_array($result); $i++) { ?>
	<div class="col-md-4 col-xs-6 col-xs-v12">
		<?=latest('theme/basic', $row['bo_table'], 5, 70);?>
	</div>
	<?php } ?>
</div>


<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
