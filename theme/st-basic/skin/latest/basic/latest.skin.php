<?php if (!defined('_GNUBOARD_')) exit;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>


<div class="latest st-basic">
	<div class="header clearfix">
		<h4 class="title">
			<a href="<?=G5_BBS_URL ?>/board.php?bo_table=<?=$bo_table ?>"><?=$bo_subject; ?></a>
		</h4>
		<small class="more"><a href="<?=G5_BBS_URL ?>/board.php?bo_table=<?=$bo_table ?>">+ 더 보기</a></small>
	</div>
	<ul class="body">
		<?php for ($i=0; $i<count($list); $i++) {  ?>
		<li class="ellipsis-li">
			<?php if ($list[$i]['is_notice']) { // 공지 ?>
			<span class="label label-primary"><i class="fa fa-bell" aria-hidden="true" title="공지"></i></span>
			<?php } ?>
			<?php if ($list[$i]['icon_secret']) { // 비밀글?>
			<span class="label label-warning"><i class="fa fa-lock" aria-hidden="true" title="비밀글"></i></span>
			<?php } ?>		
		
			<?php
			//echo $list[$i]['icon_reply']." ";
			echo "<a href=\"".$list[$i]['href']."\">";
			if ($list[$i]['is_notice'])
				echo "<strong>".$list[$i]['subject']."</strong>";
			else
				echo $list[$i]['subject'];
			echo "</a>";

			if (!empty($list[$i]['icon_file'])) echo ' <span class="icon" title="첨부파일"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>';
			if (!empty($list[$i]['icon_link'])) echo ' <span class="icon" title="링크"><i class="fa fa-link" aria-hidden="true"></i></span>';
			if (!empty($list[$i]['icon_hot'])) echo ' <span class="icon icon-hot" title="이슈"><i class="fa fa-heart" aria-hidden="true"></i></span>';			
			 ?>
			<?php if ($list[$i]['comment_cnt']) { ?><small class="comment">[<?=$list[$i]['comment_cnt']; ?>]</small><?php } ?>
			<?php if ($list[$i]['icon_new']) { ?><small class="new">new</small><?php } ?>			 
		</li>
		<?php }  ?>
		
		<?php if (count($list) == 0) { //게시물이 없을 때  ?>
		<li>게시물이 없습니다.</li>
		<?php }  ?>		
		
		<?php for ($j=0; $j<(count($list)? $rows-$i: 4); $j++) {  // 빈 rows 채움?>
		<li>&nbsp;</li>
		<?php } ?>
	</ul>
</div>
