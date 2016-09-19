<?php if (!defined('_GNUBOARD_')) exit;

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>


<?php include G5_THEME_PATH.'/_inc/preloader.php'?>
<?php include G5_THEME_PATH.'/_inc/header.php'?>

<?php if( !defined('_INDEX_') ) {
	$st_layout_sub = $ST->theme->get('st_layout_sub');
	$st_layout_auto_sidebar = $ST->theme->get('st_layout_auto_sidebar');
	if( $st_layout_auto_sidebar and !$g5['me_active'] and ($st_layout_sub==2 or $st_layout_sub==3) )
		$st_layout_sub = 1;
	
	if( !$st_layout_sub ) {
?>
	<div class="content">
	
	<?php } elseif( $st_layout_sub==1 ) { ?>
	<div class="container content">
	
	<?php } else { ?>
	<div class="container content">
		<div class="row">
			<div class="col-md-9<?=$st_layout_sub==2? ' col-md-push-3': ''?>">

<?php
	}
}
?>
