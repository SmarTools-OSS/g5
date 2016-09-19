<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>


<article id="st-basic">
	<?=$str; ?>
</article>


<?php if ($is_admin) { ?>
<script>
$(function() {
	$('.ctt_admin').css('margin-bottom', '15px');
	$('.ctt_admin .btn_admin').attr('target','_blank');
	$('.ctt_admin .btn_admin').addClass('btn btn-sm btn-danger');
	$('.ctt_admin .btn_admin').html('<i class="fa fa-cog" aria-hidden="true"></i> 내용 수정');
	$('.ctt_admin .btn_admin').removeClass('btn_admin');
});		
</script>
<?php } ?>