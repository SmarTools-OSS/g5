<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 메인 페이지 레이아웃이 컨테이너(.container) 없음 + 전체 폭 일 때, 콘텐츠 영역에 .contaner 임의 적용여부 판단
// - 아래의 게시판 위젯 코드는 예제이며, 실제 메인페이지를 구현할 때 참고하세요.
$is_needs_container = (!$ST->theme->get('st_layout_main'))? true: false;
?>


<section<?=$is_needs_container? ' class="container"': ''?>>
	<?php
	//  최신글
	$sql = " select bo_table
				from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
				where a.bo_device <> '".(is_mobile()? 'pc': 'mobile')."' ";
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


<section>
	<p>
		내 홈페이지를 위한 메인 페이지를 꾸며보세요.<br>
		/theme/st-basic/_inc/main.php 파일을 직접 편집하시면 됩니다.
	</p>
</section>
