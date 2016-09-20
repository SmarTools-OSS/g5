<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');

is_mobile()
?>


<?php if( defined('_INDEX_') ) {
	$st_layout_main = $ST->theme->get('st_layout_main');
	if( !$st_layout_main ) {
?>
	<div class="content">
		<?php include (is_mobile()? G5_MOBILE_PATH: G5_BBS_PATH).'/newwin.inc.php'; // 팝업레이어 (index에서만 실행)?>		
	
		<?php include_once G5_THEME_PATH.'/_inc/slider.php'?>
		<?php include_once G5_THEME_PATH.'/_inc/main.php'?>
	</div>		
	<?php } elseif( $st_layout_main==1 ) { ?>
	<div class="container content">
		<?php include (is_mobile()? G5_MOBILE_PATH: G5_BBS_PATH).'/newwin.inc.php'; // 팝업레이어 (index에서만 실행)?>		
		
		<?php include_once G5_THEME_PATH.'/_inc/slider.php'?>
		<?php include_once G5_THEME_PATH.'/_inc/main.php'?>
	</div>		
	<?php } else { ?>
	<div class="container content">
		<?php include (is_mobile()? G5_MOBILE_PATH: G5_BBS_PATH).'/newwin.inc.php'; // 팝업레이어 (index에서만 실행)?>		
	
		<div class="row">
			<div class="col-md-9<?=$st_layout_main==2? ' col-md-push-3': ''?>">
				<?php include_once G5_THEME_PATH.'/_inc/slider.php'?>
				<?php include_once G5_THEME_PATH.'/_inc/main.php'?>
			</div>
			<div class="col-md-3<?=$st_layout_main==2? ' col-md-pull-9': ''?>">
				<?php include_once G5_THEME_PATH.'/_inc/sidebar.php'?>
			</div>	
		</div>
	</div>
	<?php
	}
}

include_once(G5_THEME_PATH.'/tail.php');
?>
