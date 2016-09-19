<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);
?>


<script src="<?=G5_JS_URL; ?>/viewimageresize.js"></script>

<div id="st-view">
	<?php if( !$qaconfig['qa_include_head'] and !$qaconfig['qa_content_head'] ):?>
	<div class="page-header">
		<h3 class="title">1:1 문의 <small>읽기</small></h3>
		<span class="sr-only">읽기</span>
	</div>
	<?php endif?>
	
	
	<div class="info">
		<h4 class="subject">
			<span class="cat"><?=$view['category']?></span>
			<?=$view['subject']?>
		</h4>
		<div class="desc">
			작성자: <?=ST::get_mb_icon($view['mb_id'])?> <strong><?=$view['qa_name'] ?></strong>님<?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>&nbsp;&nbsp;&nbsp;		
			작성일시: <span class="sound_only">작성일</span><strong><?=date("Y-m-d H:i:s", strtotime($view['datetime'])) ?></strong>
		</div>		
	</div>

	
	<?php if($view['download_count']) { ?>
	<ul class="file">
		<?php
		// 가변 파일
		for ($i=0; $i<$view['download_count']; $i++) {
		 ?>
		<li>
			<a href="<?=$view['download_href'][$i];  ?>" class="view_file_download">
				<span class="icon" title="첨부파일"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>
				<strong><?=$view['download_source'][$i] ?></strong>
			</a>
		</li>
        <?php
        }
         ?>	 
	</ul>
	<?php } ?>
	

	<div class="actions buttons">
		<?php ob_start()?>	
		 <div class="left">
			<a href="<?=$list_href ?>" class="btn btn-sm btn-default">목록</a>
			<?php if ($prev_href) { ?><a href="<?=$prev_href ?>" class="btn btn-sm btn-default">이전글</a><?php } ?>
			<?php if ($next_href) { ?><a href="<?=$next_href ?>" class="btn btn-sm btn-default">다음글</a><?php } ?>
			<?php if ($delete_href) { ?><a href="<?=$delete_href ?>" class="btn btn-sm btn-danger" onclick="del(this.href); return false;">삭제</a><?php } ?>
		 </div>
		<div class="right">
			<?php if ($update_href) { ?><a href="<?=$update_href ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> 수정</a><?php } ?>
		</div>	
		<?php
		$link_buttons = ob_get_contents();
		ob_end_flush();
		 ?>		
	</div>	
	
	
    <section class="content">
        <?php
        // 파일 출력
        if($view['img_count']) {
            echo "<div class=\"images\">\n";

            for ($i=0; $i<$view['img_count']; $i++) {
                //echo $view['img_file'][$i];
                echo get_view_thumbnail($view['img_file'][$i], $qaconfig['qa_image_width']);
            }

            echo "</div>\n";
        }
         ?>
		 

        <!-- 본문 내용 시작 { -->
        <div class="text"><?=get_view_thumbnail($view['content'], $qaconfig['qa_image_width']); ?></div>
        <!-- } 본문 내용 끝 -->

		
        <?php if($view['qa_type']) { ?>
        <div id="bo_v_addq"><a href="<?=$rewrite_href; ?>" class="btn_b01">추가질문</a></div>
        <?php } ?>
    </section>
	

   <?php
    // 질문글에서 답변이 있으면 답변 출력, 답변이 없고 관리자이면 답변등록폼 출력
    if(!$view['qa_type']) {
        if($view['qa_status'] && $answer['qa_id'])
            include_once($qa_skin_path.'/view.answer.skin.php');
        else
            include_once($qa_skin_path.'/view.answerform.skin.php');
    }
    ?>
	
	
    <?php if($view['rel_count']) { ?>
	<div id="st-basic">
		<h4 style="margin-top: 20px"><i class="fa fa-link" aria-hidden="true"></i> 연관질문</h4>
		
		<table class="table table-hover">
			<thead>
			<tr>
				<th scope="col" class="sbj">제목</th>
				<th scope="col" class="name hidden-xs-v">글쓴이</th>
				<th scope="col" class="status">상태</a></th>
				<th scope="col" class="date hidden-xs-v">등록일</a></th>
			</tr>
			</thead>
			<tbody>
			<?php for($i=0; $i<$view['rel_count']; $i++) { ?>
			<tr onclick="return onRowClick(event, '<?=$rel_list[$i]['view_href'] ?>');">
				<td class="sbj">
					<span class="cat"><?=get_text($rel_list[$i]['category']); ?></span>

					<a href="<?=$rel_list[$i]['view_href'] ?>"><?=$rel_list[$i]['subject'] ?></a>
					<?php
					if (!empty($rel_list[$i]['icon_file'])) echo '<span class="icon" title="첨부파일"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>';
					 ?>
					
					<div class="desc visible-xs-v">
						<i class="fa fa-<?=$rel_list[$i]['mb_id']? 'user': 'tint'?>" title="<?=$rel_list[$i]['mb_id']? '회원': '비회원'?>" aria-hidden="true"></i> <?=$list[$i]['name'] ?>
						&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> <?=$rel_list[$i]['date'] ?>
					</div>
				</td>
				<td class="hidden-xs-v">
					<div class="name ellipsis">
						<i class="fa fa-<?=$rel_list[$i]['mb_id']? 'user': 'tint'?>" title="<?=$rel_list[$i]['mb_id']? '회원': '비회원'?>" aria-hidden="true"></i>
						<?=$rel_list[$i]['name'] ?>
					</div>
				</td>
				<td class="status"><?=($rel_list[$i]['qa_status'] ? '<span class="label label-success">답변완료</span>' : '<span class="label label-default">답변대기</span>'); ?></td>
				<td class="hidden-xs-v"><?=$rel_list[$i]['date']; ?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<hr style="margin: 25px 0 0">	
    <?php } ?>


    <!-- 링크 버튼 시작 { -->
    <div class="actions buttons">
        <?=$link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->	
</div>


<script>
function onRowClick (e, href) {	
	document.location.href = href;
}
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});
</script>