<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가?>


<section>
	<?php
	//  최신글
	$sql = " select bo_table
				from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
				where a.bo_device <> 'mobile' ";
	if(!$is_admin)
		$sql .= " and a.bo_use_cert = '' ";
	$sql .= " order by b.gr_order, a.bo_order ";
	$result = sql_query($sql);
	?>
	<div class="row">
		<?php for ($i=0; $row=sql_fetch_array($result); $i++) { ?>
		<div class="col-md-4 col-xs-6 col-xs-v12">
			<?=latest('theme/basic', $row['bo_table'], 5, 25);?>
		</div>
		<?php } ?>
	</div>		
</section>