<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$popular_skin_url.'/style.css">', 0);
?>


<section id="st-popular">
	<table border="0">
	<tr>
		<td class="title">인기검색어: </td>
		<td class="tags">
			<?php for ($i=0; $i<count($list); $i++) {  ?>
			<a href="<?=G5_BBS_URL ?>/search.php?sfl=wr_subject&amp;sop=and&amp;stx=<?=urlencode($list[$i]['pp_word']) ?>" class="label label-default"><?=get_text($list[$i]['pp_word']); ?></a>
			<?php }  ?>
		</td>	
	</tr>
	</table>
</section>