<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가?>


<?php
$st_slider_use = $ST->theme->get('st_slider_use');

if( $st_slider_use == 1 or (!is_mobile() and $st_slider_use==2) or (is_mobile() and $st_slider_use==3) ) { 
$st_slider_count = $ST->theme->get('st_slider_count');
$st_slider_bg_color = $ST->theme->get('st_slider_bg_color');
?>

<style>
#st-body .carousel-main .carousel-inner { background-color: <?=$st_slider_bg_color? $st_slider_bg_color: ''?>; }
#st-body .carousel-main .item { 
	height: <?=$ST->theme->get('st_slider_height_pc')?>;
	background-color: <?=$st_slider_bg_color? $st_slider_bg_color: ''?>; 
}
@media (max-width: 767px) {
	#st-body .carousel-main .item { 
		height: <?=$ST->theme->get('st_slider_height_m')?>;
		padding-bottom: 50%;
	}
}
@media (max-width: 480px) {
	#st-body .carousel-main .item { 
		padding-bottom: 0;
	}
}
<?php if( defined('_INDEX_') and !$ST->theme->get('st_layout_main') ) { // 메인 페이지 레이아웃이 컨테이너(.container) 없음 + 전체 폭 일 때, Navbar 와의 공간 제거?>
#st-body .carousel-wrapper { margin-top: -20px; }
<?php } ?>
</style>

<section class="carousel-wrapper">
	<div id="carousel-main" class="carousel carousel-main slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php for($i=0; $i<$st_slider_count; $i++) { ?>
			<li data-target="#carousel-main" data-slide-to="<?=$i?>" class="<?=$i==0? 'active': ''?>"></li>
			<?php } ?>
		</ol>
		<div class="carousel-inner" role="listbox">
			<?php for($i=1; $i<=$st_slider_count; $i++) { ?>
			<?php
			$img_name = $ST->theme->get('st_slider_img_'.$i);
			$background_image = ($img_name and file_exists($img_file = $ST->theme->get_file_path().'/'.$img_name))? 'background-image: url('.$ST->theme->get_file_url().'/'.$img_name.')': '';
			if( !$background_image ) {
				$st_slider_bg_img = $ST->theme->get('st_slider_bg_img');
				if( $st_slider_bg_img )
					$background_image = 'background-image: url('.$ST->theme->get_file_url().'/'.$st_slider_bg_img.'); background-repeat:repeat; -webkit-background-size:auto; -moz-background-size:auto; -o-background-size:auto; background-size:auto;';
			}
			?>
			<div class="item<?=$i==1? ' active': ''?>" style="<?=$background_image?>">
				<div class="carousel-caption">
					<h3><?=$ST->theme->get('st_slider_title_'.$i)?></h3>
					<p><?=$ST->theme->get('st_slider_desc_'.$i)?></p>
				</div>
			</div>
			<?php } //endfor?>
		</div>
		
		<a class="left carousel-control" href="#carousel-main" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">이전</span>
		</a>
		<a class="right carousel-control" href="#carousel-main" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">다음</span>
		</a>
	</div>
</section>
<?php } ?>
