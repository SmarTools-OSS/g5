<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// ST FAQ 스킨 옵션
$multi_expandable = false;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$faq_skin_url.'/style.css">', 0);

// 상단 HTML
if ($himg_src)
    echo '<div id="faq_himg" class="faq_img"><img src="'.$himg_src.'" alt=""></div>';

echo '<div id="faq_hhtml">'.conv_content($fm['fm_head_html'], 1).'</div>';
?>


<div id="st-faq">
	<?php if( !$himg_src and !$fm['fm_head_html'] ) { ?>
	<div class="page-header">
		<h3 class="title">자주하시는 질문 <small>FAQ</small></h3>
		<span class="sr-only">자주하시는 질문</span>
	</div>
	<?php } ?>	


	<div class="actions info">
		<div class="left">
			<span><?=$sca? $sca: '전체'?>: <?=($stx)? '"'.$stx.'" 검색결과 - ': ''?><?=number_format($total_count) ?>개 (<?=number_format($page).'/'.number_format($total_page? $total_page: 1)?>페이지)</span>	
		</div>
		<div class="right">
			<?php if ($admin_href) { ?><a href="<?=$admin_href ?>" class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-cog" aria-hidden="true"></i> 관리</a><?php } ?>
			<?php if( count($faq_master_list) > 1 ) { ?>
			<div class="btn-group">
				<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><?=$fm_id? $faq_master_list[$fm_id]['fm_subject']: '전체'?> <span class="caret"></span></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<?php
					foreach( $faq_master_list as $v ){
						$is_active = '';
						if($v['fm_id'] == $fm_id){ // 현재 선택된 카테고리라면
							$is_active = ' class="active"';
						}
					?>
					<li<?=$is_active?>><a href="<?=$category_href;?>?fm_id=<?=$v['fm_id'];?>" <?=$category_option;?> ><?=$category_msg.$v['fm_subject'];?></a></li>
					<?php
					}
					?>
				</ul>
			</div>	
			<?php } ?>	
		</div>	
	</div>


	<?php if( count($faq_list) ) { // FAQ 내용 ?>
	<div id="faqlist" class="panel-group" role="tablist" aria-multiselectable="true">
		<?php
		$i = 0;
		foreach($faq_list as $key=>$v){
			if(empty($v))
				continue;
		?>	
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading-<?=$i?>">
				<a role="button" data-toggle="collapse" data-parent="<?=($multi_expandable)? '#': '#faqlist'?>" href="#collapse-<?=$i?>" aria-expanded="true" aria-controls="collapse-<?=$i?>">
					<h5 class="panel-title">
						<span class="label label-default label-q">Q</span>
							<?=strip_tags(conv_content($v['fa_subject'], 1)); ?>
					</h5>
				</a>
			</div>
			<div id="collapse-<?=$i?>" class="panel-collapse collapse<?=(!$i)? ' in': ''?>" role="tabpanel" aria-labelledby="heading-<?=$i?>">
				<div class="panel-body">
					<span class="label label-info label-ans">A</span>
					<div class="faq-content"><?=conv_content($v['fa_content'], 1); ?></div>
				</div>
			</div>
		</div>
		<?php
			$i++;
		}
		?>	
	</div>
	
	
	<div class="pages">
		<?=ST::get_paging($page_rows, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>
	</div>
	
	
    <?php } else { ?>
	<div class="panel panel-default">
		<div class="panel-body text-center">
		<?php if( $stx ) { ?>
			<i class="fa fa-info-circle" aria-hidden="true"></i> 검색된 게시물이 없습니다.
		<?php } else { ?>
			<i class="fa fa-info-circle" aria-hidden="true"></i> 등록된 FAQ가 없습니다.
			<?php if($is_admin) { ?><br><a href="<?=G5_ADMIN_URL?>/faqmasterlist.php" target="_blank">FAQ를 새로 등록하시려면 FAQ관리</a> 메뉴를 이용하십시오.<?php } ?>
		<?php } ?>	
		</div>
	</div>
    <?php } ?>	
	
	<fieldset class="search">
		<form name="faq_search_form" method="get" class="form-inline">
			<input type="hidden" name="fm_id" value="<?=$fm_id;?>">
			<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
			<div class="input-group input-group-sm">
				<input type="text" name="stx" value="<?=$stx;?>" id="stx" class="form-control required" maxlength="15" placeholder="검색어" required>
				<span class="input-group-btn">
					<a href="<?=G5_BBS_URL.'/faq.php'?>" class="btn btn-sm btn-default btn-reset" title="리셋"><i class="fa fa-repeat" aria-hidden="true"></i></a>
					<button type="submit" value="검색" class="btn btn-sm btn-info" title="검색"><i class="fa fa-search" aria-hidden="true"></i> 검색</button>
				</span>
			</div>
		</form>	
	</fieldset>	
</div>


<?php
// 하단 HTML
echo '<div id="faq_thtml">'.conv_content($fm['fm_tail_html'], 1).'</div>';

if ($timg_src)
    echo '<div id="faq_timg" class="faq_img"><img src="'.$timg_src.'" alt=""></div>';
?>


<script src="<?=G5_JS_URL; ?>/viewimageresize.js"></script>
<script>
$(function() {
    $(".closer_btn").on("click", function() {
        $(this).closest(".con_inner").slideToggle();
    });
});

function faq_open(el)
{
    var $con = $(el).closest("li").find(".con_inner");

    if($con.is(":visible")) {
        $con.slideUp();
    } else {
        $("#faq_con .con_inner:visible").css("display", "none");

        $con.slideDown(
            function() {
                // 이미지 리사이즈
                $con.viewimageresize2();
            }
        );
    }

    return false;
}
</script>