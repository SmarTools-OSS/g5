<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 게시물 복사/이동 URL 패치
if( $copy_href ) $copy_href = str_replace('move.php', 'adm_move.php', $copy_href);
if( $move_href ) $move_href = str_replace('move.php', 'adm_move.php', $move_href);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>


<script src="<?=G5_JS_URL; ?>/viewimageresize.js"></script>

<div id="st-view">
	<?php if( !$board['bo_content_head'] ) { ?>
	<div class="page-header">
		<h3 class="title"><?=$board['bo_subject']?> <small>읽기</small></h3>
		<span class="sr-only">읽기</span>
	</div>
	<?php } ?>

	
	<div class="info">
		<h4 class="subject">
			<?php
			if ($view['is_notice']) // 공지사항
				echo '<span class="label label-primary"><i class="fa fa-bell" aria-hidden="true" title="공지"></i></span>';	
			if ($view['icon_secret']) // 비밀글
				echo '<span class="label label-warning"><i class="fa fa-lock" aria-hidden="true" title="비밀글"></i></span>';					
			?>		
			<?php
			if ($category_name) echo '<span class="cat">'.$view['ca_name'].'</span>'; // 분류 출력 끝
			echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
			?>	
			<?php if ($view['comment_cnt']) { ?><small class="comment">[<?=$view['comment_cnt']; ?>]</small><?php } ?>
			<?php if ($view['icon_new']) { ?><small class="new">new</small><?php } ?>			
		</h4>
		<div class="desc">
			<?php $mb_menu = $board['bo_use_sideview']? ST::get_mb_menu($view['mb_id'], $view['wr_name']): ''; ?>
			<?php if( $mb_menu ) { ?>
			작성자: 
			<div class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">					
					<?=ST::get_mb_icon($view['mb_id'], $view['name'])?> <strong><?=$view['wr_name'] ?></strong>님<?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>
				</a>
				<?=$mb_menu?>
			</div>				
			&nbsp;&nbsp;&nbsp;
			<?php } else { ?>
			작성자: <?=ST::get_mb_icon($view['mb_id'], $view['name'])?> <strong><?=$view['wr_name'] ?></strong>님<?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?>&nbsp;&nbsp;&nbsp;
			<?php } ?>			
			작성일시: <span class="sound_only">작성일</span><strong><?=date("Y-m-d H:i:s", strtotime($view['wr_datetime'])) ?></strong>&nbsp;&nbsp;&nbsp;
			조회: <strong><?=number_format($view['wr_hit']) ?></strong>회&nbsp;&nbsp;&nbsp;
			댓글: <strong><?=number_format($view['wr_comment']) ?></strong>건
		</div>		
	</div>
	
	
    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
	?>
	<?php if($cnt) { // 첨부파일 시작 ?>
	<ul class="file">
	<?php
	// 가변 파일
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
	 ?>
		<li>
			<a href="<?=$view['file'][$i]['href'];  ?>" class="view_file_download">
				<span class="icon" title="첨부파일"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>
				<strong><?=$view['file'][$i]['source'] ?></strong>
				<?=$view['file'][$i]['content'] ?> <small>(<?=$view['file'][$i]['size'] ?>)</small>
			</a>
			<span class="count">다운로드: <strong><?=$view['file'][$i]['download'] ?></strong>회</span>&nbsp;&nbsp;&nbsp;
			<span>첨부일시: <strong><?=$view['file'][$i]['datetime'] ?></strong></span>
		</li>
	<?php
		}
	}
	 ?>
	</ul>
    <?php } ?>

	
    <?php if ($view['link']) { // 관련링크?>
	<ul class="link">
	<?php
	// 링크
	$cnt = 0;
	for ($i=1; $i<=count($view['link']); $i++) {
		if ($view['link'][$i]) {
			$cnt++;
			$link = cut_str($view['link'][$i], 70);
	 ?>
		<li>
			<a href="<?=$view['link_href'][$i] ?>" target="_blank">
				<span class="icon" title="링크"><i class="fa fa-link" aria-hidden="true"></i></span>
				<strong><?=$link ?></strong>
			</a>
			<span class="count">연결: <strong><?=$view['link_hit'][$i] ?></strong>회</span>
		</li>
	<?php
		}
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
			<?php if ($search_href) { ?><a href="<?=$search_href ?>" class="btn btn-sm btn-default">검색</a><?php } ?>
			<?php if ($copy_href) { ?><a href="<?=$copy_href ?>" class="btn btn-sm btn-danger" onclick="board_move(this.href); return false;">복사</a><?php } ?>
			<?php if ($move_href) { ?><a href="<?=$move_href ?>" class="btn btn-sm btn-danger" onclick="board_move(this.href); return false;">이동</a><?php } ?>
			<?php if ($delete_href) { ?><a href="<?=$delete_href ?>" class="btn btn-sm btn-danger" onclick="del(this.href); return false;">삭제</a><?php } ?>
		 </div>
		<div class="right">
			<button class="btn btn-sm btn-default" id="size_down" onclick="font_resize('down')"><i class="fa fa-font" aria-hidden="true"></i><small><i class="fa fa-minus" aria-hidden="true"></i></small></button>
			<button class="btn btn-sm btn-default" id="size_up" onclick="font_resize('up')"><i class="fa fa-font" aria-hidden="true"></i><small><i class="fa fa-plus" aria-hidden="true"></i></small></button>
			&nbsp;
		
			<?php if ($reply_href) { ?><a href="<?=$reply_href ?>" class="btn btn-sm btn-default">답변</a><?php } ?>
			<?php if ($update_href) { ?><a href="<?=$update_href ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> 수정</a><?php } ?>
			<?php if (!$update_href and $write_href) { ?><a href="<?=$write_href ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a><?php } ?>
		</div>	
		<?php
		$link_buttons = ob_get_contents();
		ob_end_flush();
		 ?>		
	</div>	
	
	
	<?php
	// 뷰 폰트사이즈
	$size = (int)($_COOKIE['st_view_font_size']? $_COOKIE['st_view_font_size']: 0);
	$style = $size? ' style="font-size:'.$size.'px;"': '';
	?>
    <section class="content"<?=$style?>>
        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div class=\"images\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
                }
            }
            echo "</div>\n";
        }
         ?>

        <!-- 본문 내용 시작 { -->
        <article class="text"><?=get_view_thumbnail($view['content']); ?></article>
        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?=$signature ?></p><?php } ?>

        <!-- 스크랩 추천 비추천 시작 { -->
        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
        <div class="votes">
            <?php if ($scrap_href) { ?><a href="<?=$scrap_href;  ?>" target="_blank" class="btn btn-sm btn-default" onclick="win_scrap(this.href); return false;">스크랩</a><?php } ?>
            <?php if ($good_href) { ?>
            <span>
                <a href="<?=$good_href.'&amp;'.$qstr ?>" id="good_button" class="btn btn-sm btn-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;추천 <strong><?=number_format($view['wr_good']) ?></strong></a>
                <b id="bo_v_act_good"></b>
            </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
            <span>
                <a href="<?=$nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn btn-sm btn-warning"><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;&nbsp;비추천 <strong><?=number_format($view['wr_nogood']) ?></strong></a>
                <b id="bo_v_act_nogood"></b>
            </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div class="votes">
            <?php if($board['bo_use_good']) { ?><span class="btn btn-sm btn-success disabled"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;추천 <strong><?=number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span class="btn btn-sm btn-warning disabled"><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;&nbsp;비추천 <strong><?=number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <!-- } 스크랩 추천 비추천 끝 -->
    </section>
	
	
    <?php
	// SNS 연동
    include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>

    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

    <!-- 링크 버튼 시작 { -->
    <div class="actions buttons bottom">
        <?=$link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->	
</div>


<script>
$(function() {
    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
		
	// 이미지 뷰어
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });
	
	// 다운로드
    $("a.view_file_download").click(function() {
		<?php if ($board['bo_download_point'] < 0) { ?>
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?=number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";
		<?php } else  { ?>
		
		var msg = "첨부파일을 다운로드 하시겠습니까?"
		<?php } ?>
        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }		
    });	
});

function font_resize(act) {
	var size = parseInt(get_cookie('st_view_font_size')? get_cookie('st_view_font_size'): $('#st-view .content').css('font-size'));
	if( act == 'up' && size < 20 ) size++;
	if( act == 'down' && size > 10 ) size--;
	
	$('#st-view .content').css({ 'font-size': size });
	set_cookie('st_view_font_size', size);
}

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>