<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-popup" class="st-mbr point">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-balance-scale" aria-hidden="true"></i> 내 포인트</h3>
	</div>
	<ul class="page-desc">
		<li>현재 회원님의 보유포인트는 <strong><?=number_format($member['mb_point'])?>P</strong> 입니다.
	</ul>
	
	
	<ul class="nav nav-tabs">
		<li class="active bold"><a href="javascript:void();">포인트 내역</a></li>
	</ul>	
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th scope="col" class="date">일시</th>
				<th scope="col">내용</th>
				<th scope="col" class="date">만료일</th>
				<th scope="col" class="point">적립포인트</th>
				<th scope="col" class="point">사용포인트</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sum_point1 = $sum_point2 = $sum_point3 = 0;

			$sql = " select *
						{$sql_common}
						{$sql_order}
						limit {$from_record}, {$rows} ";
			$result = sql_query($sql);
			for ($i=0; $row=sql_fetch_array($result); $i++) {
				$point1 = $point2 = 0;
				if ($row['po_point'] > 0) {
					$point1 = '+' .number_format($row['po_point']);
					$sum_point1 += $row['po_point'];
				} else {
					$point2 = number_format($row['po_point']);
					$sum_point2 += $row['po_point'];
				}

				$po_content = $row['po_content'];

				$expr = '';
				if($row['po_expired'] == 1)
					$expr = ' txt_expired';
			?>
			<tr>
				<td class="date"><?=$row['po_datetime']; ?></td>
				<td><?=$po_content; ?></td>
				<td class="date<?=$expr; ?>">
					<?php if ($row['po_expired'] == 1) { ?>
					만료<?=substr(str_replace('-', '', $row['po_expire_date']), 2); ?>
					<?php } else echo $row['po_expire_date'] == '9999-12-31' ? '&nbsp;' : $row['po_expire_date']; ?>
				</td>
				<td class="point"><?=$point1; ?></td>
				<td class="point"><?=$point2; ?></td>
			</tr>
			<?php
			}

			if ($i == 0)
				echo '<tr><td colspan="5" class="empty_table">자료가 없습니다.</td></tr>';
			else {
				if ($sum_point1 > 0)
					$sum_point1 = "+" . number_format($sum_point1);
				$sum_point2 = number_format($sum_point2);
			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th scope="row" colspan="3" class="text-center">소계</th>
				<td class="point"><?=$sum_point1; ?></td>
				<td class="point"><?=$sum_point2; ?></td>
			</tr>
			<tr>
				<th scope="row" colspan="3" class="text-center">보유포인트</th>
				<td colspan="2" class="text-right"><strong><?=number_format($member['mb_point']); ?></strong></td>
			</tr>
		</tfoot>
		</table>	
	</div>
	
	
	<?=ST::get_paging($config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
	
	
	<hr>
	<div class="text-right">
		<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>	
	</div>		
</div>
