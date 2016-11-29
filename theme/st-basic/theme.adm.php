<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가?>


<form name="fmenulist" id="fmenulist" method="post" enctype="multipart/form-data" onsubmit="return st_theme_submit(this);">

<div id="st-adm">
	<section id="st_theme_layout">
		<h2>레이아웃 설정</small></h2>
		<ul class="anchor">
			<li><a href="#st_theme_layout">레이아웃 설정</a></li>
			<li><a href="#st_theme_header">헤더영역 설정</a></li>
			<li><a href="#st_theme_slider">슬라이더(carousel) 설정</a></li>
			<li><a href="#st_theme_sidebar">사이드바 설정</a></li>
			<li><a href="#st_theme_footer">푸터 설정</a></li>
		</ul>	
		
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
				<col class="grid_4">
				<col>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>		
			<tr>
				<th scope="row">메인 페이지</th>
				<td>
					<?php $st_layout_main = $ST->theme->get('st_layout_main')?>
					<select name="st_layout_main">
						<option value="">컨테이너(.container) 없음 + 전체 폭</option>
						<option value="1"<?=$st_layout_main==1? ' selected="selected"': ''?>>컨테이너(.container) 내부 + 전체 폭</option>
						<option value="2"<?=$st_layout_main==2? ' selected="selected"': ''?>>컨테이너(.container) 내부 + 좌측 사이드바</option>
						<option value="3"<?=$st_layout_main==3? ' selected="selected"': ''?>>컨테이너(.container) 내부 + 우측 사이드바</option>
					</select>
				</td>
				<th scope="row">서브 페이지</th>
				<td>
					<?php $st_layout_sub = $ST->theme->get('st_layout_sub')?>
					<select name="st_layout_sub">
						<option value="">컨테이너(.container) 없음 + 전체 폭</option>
						<option value="1"<?=$st_layout_sub==1? ' selected="selected"': ''?>>컨테이너(.container) 내부 + 전체 폭</option>
						<option value="2"<?=$st_layout_sub==2? ' selected="selected"': ''?>>컨테이너(.container) 내부 + 좌측 사이드바</option>
						<option value="3"<?=$st_layout_sub==3? ' selected="selected"': ''?>>컨테이너(.container) 내부 + 우측 사이드바</option>
					</select>
					
					<div style="margin-top: 5px;">
						<?php $st_layout_auto_sidebar = $ST->theme->get('st_layout_auto_sidebar')?>
						<label><input type="checkbox" name="st_layout_auto_sidebar" value="1" id="st_layout_auto_sidebar"<?=$st_layout_auto_sidebar? ' checked="checked"': ''?>> 사이드바는 메뉴 연동된 페이지에서만 출력</label>
					</div>
				</td>
			</tr>	
			<tr>
				<th scope="row">Preloader (페이지 로딩효과)</th>
				<td>
					<?php $st_layout_preloader = $ST->theme->get('st_layout_preloader')?>
					<select name="st_layout_preloader">
						<option value="">사용 안 함</option>
						<option value="100"<?=$st_layout_preloader==100? ' selected="selected"': ''?>>100</option>
						<option value="200"<?=$st_layout_preloader==200? ' selected="selected"': ''?>>200</option>
						<option value="300"<?=$st_layout_preloader==300? ' selected="selected"': ''?>>300</option>
						<option value="400"<?=$st_layout_preloader==400? ' selected="selected"': ''?>>400</option>
						<option value="500"<?=$st_layout_preloader==500? ' selected="selected"': ''?>>500</option>
						<option value="600"<?=$st_layout_preloader==600? ' selected="selected"': ''?>>600</option>
						<option value="700"<?=$st_layout_preloader==700? ' selected="selected"': ''?>>700</option>
						<option value="800"<?=$st_layout_preloader==800? ' selected="selected"': ''?>>800</option>
						<option value="900"<?=$st_layout_preloader==900? ' selected="selected"': ''?>>900</option>
						<option value="1000"<?=$st_layout_preloader==1000? ' selected="selected"': ''?>>1000</option>
					</select>
					<div class="info">애니메이션 실행 시간값(ms)으로, 클수록 로딩이 느려지는 효과가 발생합니다.</div>	
				</td>
				<th scope="row">Back-to-top 메뉴</th>
				<td>
					<?php $st_layout_backtotop = $ST->theme->get('st_layout_backtotop')?>
					<select name="st_layout_backtotop">
						<option value="">사용 안 함</option>					
						<option value="200"<?=$st_layout_backtotop==200? ' selected="selected"': ''?>>200</option>
						<option value="400"<?=$st_layout_backtotop==400? ' selected="selected"': ''?>>400</option>
						<option value="600"<?=$st_layout_backtotop==600? ' selected="selected"': ''?>>600</option>
						<option value="800"<?=$st_layout_backtotop==800? ' selected="selected"': ''?>>800</option>
						<option value="1000"<?=$st_layout_backtotop==1000? ' selected="selected"': ''?>>1000</option>
					</select>
					<div class="info">애니메이션 실행 시간값(ms)으로, 클수록 로딩이 느려지는 효과가 발생합니다.</div>	
				</td>
			</tr>				
			<tr>
				<th scope="row">메인 페이지 소스코드</th>
				<td>
					<div class="info">필요한 경우, <strong>/theme/st-basic/_inc/main.php</strong> 파일을 직접 수정하세요.</div>		
				</td>		
				<th scope="row"></th>
				<td></td>		
			</tr>				
			</tbody>
			</table>
		</div>			
	</section>
	<div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey="s">
		<a href="<?=G5_URL?>">메인으로</a>
	</div>	
	
	
	<section id="st_theme_header">
		<h2>헤더영역 설정</small></h2>
		<ul class="anchor">
			<li><a href="#st_theme_layout">레이아웃 설정</a></li>
			<li><a href="#st_theme_header">헤더영역 설정</a></li>
			<li><a href="#st_theme_slider">슬라이더(carousel) 설정</a></li>
			<li><a href="#st_theme_sidebar">사이드바 설정</a></li>
			<li><a href="#st_theme_footer">푸터 설정</a></li>
		</ul>	
		
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
				<col class="grid_4">
				<col>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>		
			<tr>				
				<th scope="row">PC용 헤더 로고 이미지</th>
				<td>
					<?php $st_header_pc_logo = $ST->theme->get('st_header_pc_logo')?>
					<?php if( $st_header_pc_logo ) { ?>
					<?php $logo_url = $ST->theme->get_file_url().'/'.$st_header_pc_logo?>
					<img src="<?=$logo_url?>">&nbsp;&nbsp;
					<label><input type="checkbox" id="del_st_header_pc_logo" name="del_st_header_pc_logo" value="1"> 삭제</label>
					<input type="hidden" name="st_header_pc_logo" value="<?=$st_header_pc_logo?>">
					<?php } else { ?>
					<input type="file" name="st_header_pc_logo" id="st_header_pc_logo">
					<div class="info">이미지는 <strong>155x50 픽셀(넓이 x 높이)</strong> 크기의 .png 파일을 권장합니다.</div>		
					<div class="info">사용자 로고 이미지 미설정 시, 디폴트로 스마툴즈 빌더 로고가 출력됩니다.</div>					
					<?php } ?>
					<div style="margin-top:10px">
						<label><input type="checkbox" name="st_header_pc_text" id="st_header_pc_text"<?=$ST->theme->get('st_header_pc_text')? ' checked="checked"': ''?>> 홈페이지 제목(텍스트)으로 출력</label>
					</div>
				</td>		
				<th scope="row">PC용 헤더 .brand 스타일</th>
				<td>
					<input type="text" name="st_header_pc_style" value="<?=$ST->theme->get('st_header_pc_style')?>" class="frm_input" size="80">
					<div class="info">로고 이미지 또는 홈페이지 제목(텍스트)에 대한 style 값을 간편하게 적용할 수 있습니다.</div>
				</td>							
			</tr>				
			<tr>				
				<th scope="row">모바일용 .navbar-brand<br>로고 이미지</th>
				<td>
					<?php $st_navbar_brand_logo = $ST->theme->get('st_navbar_brand_logo')?>
					<?php if( $st_navbar_brand_logo ) { ?>
					<?php $logo_url = $ST->theme->get_file_url().'/'.$st_navbar_brand_logo?>
					<img src="<?=$logo_url?>">&nbsp;&nbsp;
					<label><input type="checkbox" id="del_st_navbar_brand_logo" name="del_st_navbar_brand_logo" value="1"> 삭제</label>
					<input type="hidden" name="st_navbar_brand_logo" value="<?=$st_navbar_brand_logo?>">
					<?php } else { ?>
					<input type="file" name="st_navbar_brand_logo" id="st_navbar_brand_logo">
					<div class="info">이미지는 <strong>110x30 픽셀(넓이 x 높이)</strong> 크기의 .png 파일을 권장합니다.</div>
					<div class="info">사용자 로고 이미지 미설정 시, 디폴트로 스마툴즈 빌더 로고가 출력됩니다.</div>						
					<?php } ?>
					<div style="margin-top:10px">
						<label><input type="checkbox" name="st_navbar_brand_text" id="st_navbar_brand_text"<?=$ST->theme->get('st_navbar_brand_text')? ' checked="checked"': ''?>> 홈페이지 제목(텍스트)으로 출력</label>
					</div>
				</td>		
				<th scope="row">모바일용 .navbar-brand<br>스타일</th>
				<td>
					<input type="text" name="st_navbar_brand_style" value="<?=$ST->theme->get('st_navbar_brand_style')?>" class="frm_input" size="80">
					<div class="info">로고 이미지 또는 홈페이지 제목(텍스트)에 대한 style 값을 간편하게 적용할 수 있습니다.</div>
				</td>							
			</tr>	
			<tr>
				<th scope="row">공통 .navbar 컬러셋</th>
				<td>
					<?php $st_navbar_color_set = $ST->theme->get('st_navbar_color_set')?>
					<select name="st_navbar_color_set">
						<option value="default">default</option>
						<option value="inverse"<?=($st_navbar_color_set=='inverse')? ' selected="selected"': ''?>>inverse</option>
						<?php foreach(ST::scan_files(G5_THEME_PATH.'/css/colors/', '.css') as $css_file) {
						$css_name = basename($css_file, '.css'); ?>
						<option value="<?=$css_name?>"<?=($st_navbar_color_set==$css_name)? ' selected="selected"': ''?>><?=$css_name?></option>
						<?php } ?>
					</select>				
					<div class="info">테마에 내장된 몇몇 컬러셋으로 손쉽게 .navbar 의 색상과 분위기를 바꿀 수 있습니다.</div>
				</td>		
				<th scope="row">헤더영역 소스코드</th>
				<td>
					<div class="info">필요한 경우, <strong>/theme/st-basic/_inc/header.php</strong> 파일을 직접 수정하세요.</div>
				</td>										
			</tr>
			</tbody>
			</table>
		</div>			
	</section>
	<div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey="s">
		<a href="<?=G5_URL?>">메인으로</a>
	</div>		
		
	
	<section id="st_theme_slider">
		<h2>슬라이더(carousel) 설정</small></h2>
		<ul class="anchor">
			<li><a href="#st_theme_layout">레이아웃 설정</a></li>
			<li><a href="#st_theme_header">헤더영역 설정</a></li>
			<li><a href="#st_theme_slider">슬라이더(carousel) 설정</a></li>
			<li><a href="#st_theme_sidebar">사이드바 설정</a></li>
			<li><a href="#st_theme_footer">푸터 설정</a></li>
		</ul>	
		
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
				<col class="grid_4">
				<col>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
			<tr>		
				<th scope="row">슬라이더 출력</th>
				<td>
					<?php $st_slider_use = $ST->theme->get('st_slider_use')?>
					<select name="st_slider_use">
						<option value="">아니오</option>
						<option value="1"<?=$st_slider_use==1? ' selected="selected"': ''?>>항상</option>
						<option value="2"<?=$st_slider_use==2? ' selected="selected"': ''?>>PC Only</option>
						<option value="3"<?=$st_slider_use==3? ' selected="selected"': ''?>>모바일 Only</option>
					</select>
				</td>					
				<th scope="row">슬라이더 개수</th>
				<td>
					<input type="text" name="st_slider_count" value="<?=$ST->theme->get('st_slider_count')?>" class="frm_input"> 개
				</td>					
			</tr>				
			<tr>						
				<th scope="row">슬라이더 높이 (PC)</th>
				<td>
					<input type="text" name="st_slider_height_pc" value="<?=$ST->theme->get('st_slider_height_pc')?>" class="frm_input">
					<div class="info">PC에서의 슬라이더 높이</div>
				</td>				
				<th scope="row">슬라이더 높이 (모바일)</th>
				<td>
					<input type="text" name="st_slider_height_m" value="<?=$ST->theme->get('st_slider_height_m')?>" class="frm_input">
					<div class="info">모바일에서의 슬라이더 높이</div>
				</td>						
			</tr>				
			<tr>							
				<th scope="row">슬라이더 배경색</th>
				<td>
					<input type="text" name="st_slider_bg_color" value="<?=$ST->theme->get('st_slider_bg_color')?>" class="frm_input">
					<div class="info">슬라이더 이미지가 없는 경우 슬라이더의 기본 배경색을 설정할 수 있습니다.</div>
				</td>		
				<th scope="row">슬라이더 배경이미지</th>
				<td>
					<?php $st_slider_bg_img = $ST->theme->get('st_slider_bg_img')?>
					<?php if( $st_slider_bg_img ) { ?>
					<?php $img_url = $ST->theme->get_file_url().'/'.$st_slider_bg_img?>
					<img src="<?=$img_url?>" style="max-width:250px">&nbsp;&nbsp;
					<label><input type="checkbox" id="del_st_slider_bg_img" name="del_st_slider_bg_img" value="1"> 삭제</label>
					<input type="hidden" name="st_slider_bg_img" value="<?=$st_slider_bg_img?>">
					<?php } else { ?>
					<input type="file" name="st_slider_bg_img" id="st_slider_bg_img">
					<div class="info">슬라이더 이미지가 없는 경우 슬라이더의 기본 배경이미지를 설정할 수 있습니다.</div>
					<div class="info">이미지는 <strong>150x150 픽셀(넓이 x 높이)</strong> 크기 등 투명한 배경의 .png 파일(패턴형식)을 권장합니다.</div>
					<?php } ?>
				</td>						
			</tr>	
			<?php for($i=1; $i<=$ST->theme->get('st_slider_count'); $i++) { ?>
			<tr>		
				<th scope="row">슬라이더 이미지-<?=$i?></th>
				<td>
					<?php $st_slider_img = $ST->theme->get('st_slider_img_'.$i)?>
					<?php if( $st_slider_img ) { ?>
					<?php $img_url = $ST->theme->get_file_url().'/'.$st_slider_img?>
					<img src="<?=$img_url?>" style="max-width:250px">&nbsp;&nbsp;
					<label><input type="checkbox" id="del_st_slider_img_<?=$i?>" name="del_st_slider_img_<?=$i?>" value="1"> 삭제</label>
					<input type="hidden" name="st_slider_img_<?=$i?>" value="<?=$st_slider_img?>">
					<?php } else { ?>
					<input type="file" name="st_slider_img_<?=$i?>" id="st_slider_img_<?=$i?>">
					<div class="info">이미지는 <strong>850x320 픽셀(넓이 x 높이)</strong> 등 균일한 크기의 .jpg 파일을 권장합니다.</div>
					<?php } ?>
				</td>					
				<th scope="row">슬라이더 라벨-<?=$i?></th>
				<td>
					<p>타이틀:&nbsp;&nbsp;<input type="text" name="st_slider_title_<?=$i?>" value="<?=$ST->theme->get('st_slider_title_'.$i)?>" class="frm_input" size="50"></p>
					<p style="padding-bottom:0">설&nbsp;&nbsp;명:&nbsp;&nbsp;<input type="text" name="st_slider_desc_<?=$i?>" value="<?=$ST->theme->get('st_slider_desc_'.$i)?>" class="frm_input" size="50"></p>
				</td>					
			</tr>				
			<?php } ?>
			<tr>
				<th scope="row">슬라이더 소스코드</th>
				<td>
					<div class="info">필요한 경우, <strong>/theme/st-basic/_inc/slider.php</strong> 파일을 직접 수정하세요.</div>		
				</td>		
				<th scope="row"></th>
				<td></td>				
			</tr>			
			</tbody>
			</table>
		</div>			
	</section>
	<div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey="s">
		<a href="<?=G5_URL?>">메인으로</a>
	</div>				
	
	
	<section id="st_theme_sidebar">
		<h2>사이드바 설정</small></h2>
		<ul class="anchor">
			<li><a href="#st_theme_layout">레이아웃 설정</a></li>
			<li><a href="#st_theme_header">헤더영역 설정</a></li>
			<li><a href="#st_theme_slider">슬라이더(carousel) 설정</a></li>
			<li><a href="#st_theme_sidebar">사이드바 설정</a></li>
			<li><a href="#st_theme_footer">푸터 설정</a></li>
		</ul>	
		
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
				<col class="grid_4">
				<col>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>		
			<tr>
				<th scope="row">외부로그인 출력</th>
				<td>
					<select name="st_sidebar_outlogin">
						<option value="">아니오</option>
						<option value="1"<?=$ST->theme->get('st_sidebar_outlogin')? ' selected="selected"': ''?>>예</option>
					</select>
				</td>
				<th scope="row">사이드메뉴 출력</th>
				<td>
					<select name="st_sidebar_menu">
						<option value="">아니오</option>
						<option value="1"<?=$ST->theme->get('st_sidebar_menu')? ' selected="selected"': ''?>>예</option>
					</select>
				</td>
			</tr>	
			<tr>
				<th scope="row">설문조사 출력</th>
				<td>
					<select name="st_sidebar_poll">
						<option value="">아니오</option>
						<option value="1"<?=$ST->theme->get('st_sidebar_poll')? ' selected="selected"': ''?>>예</option>
					</select>
				</td>
				<th scope="row">이미지배너 개수</th>
				<td>
					<input type="text" name="st_sidebar_banner_count" value="<?=$ST->theme->get('st_sidebar_banner_count')?>" class="frm_input"> 개
				</td>			
			</tr>				
			
			<?php for($i=1; $i<=$ST->theme->get('st_sidebar_banner_count'); $i++) { ?>
			<tr>		
				<th scope="row">이미지배너-<?=$i?></th>
				<td>
					<?php $st_sidebar_banner_img = $ST->theme->get('st_sidebar_banner_img_'.$i)?>
					<?php if( $st_sidebar_banner_img ) { ?>
					<?php $img_url = $ST->theme->get_file_url().'/'.$st_sidebar_banner_img?>
					<img src="<?=$img_url?>" style="max-width:250px">&nbsp;&nbsp;
					<label><input type="checkbox" id="del_st_sidebar_banner_img_<?=$i?>" name="del_st_sidebar_banner_img_<?=$i?>" value="1"> 삭제</label>
					<input type="hidden" name="st_sidebar_banner_img_<?=$i?>" value="<?=$st_sidebar_banner_img?>">
					<?php } else { ?>
					<input type="file" name="st_sidebar_banner_img_<?=$i?>" id="st_sidebar_banner_img_<?=$i?>">
					<div class="info">이미지는 <strong>300x60 픽셀(넓이 x 높이)</strong> 등 적절한 크기의 .jpg 파일을 권장합니다.</div>
					<?php } ?>
				</td>					
				<th scope="row">링크 및 타켓-<?=$i?></th>
				<td>
					<p>링크:&nbsp;&nbsp;<input type="text" name="st_sidebar_banner_link_<?=$i?>" value="<?=$ST->theme->get('st_sidebar_banner_link_'.$i)?>" class="frm_input" size="50"></p>
					<p style="padding-bottom:0">타켓:&nbsp;&nbsp;<input type="text" name="st_sidebar_banner_target_<?=$i?>" value="<?=$ST->theme->get('st_sidebar_banner_target_'.$i)?>" class="frm_input" size="50"></p>
				</td>					
			</tr>				
			<?php } ?>
			<tr>
				<th scope="row">사이드바 소스코드</th>
				<td>
					<div class="info">필요한 경우, <strong>/theme/st-basic/_inc/sidebar.php</strong> 파일을 직접 수정하세요.</div>		
				</td>		
				<th scope="row"></th>
				<td></td>						
			</tr>			
			</tbody>
			</table>
		</div>			
	</section>
	<div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey="s">
		<a href="<?=G5_URL?>">메인으로</a>
	</div>		
	
	
	<section id="st_theme_footer">
		<h2>푸터 설정</small></h2>
		<ul class="anchor">
			<li><a href="#st_theme_layout">레이아웃 설정</a></li>
			<li><a href="#st_theme_header">헤더영역 설정</a></li>
			<li><a href="#st_theme_slider">슬라이더(carousel) 설정</a></li>
			<li><a href="#st_theme_sidebar">사이드바 설정</a></li>
			<li><a href="#st_theme_footer">푸터 설정</a></li>
		</ul>	
		
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
				<col class="grid_4">
				<col>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>		
			<tr>
				<th scope="row">인기검색어 출력</th>
				<td>
					<select name="st_footer_popular">
						<option value="">아니오</option>
						<option value="1"<?=$ST->theme->get('st_footer_popular')? ' selected="selected"': ''?>>예</option>
					</select>
				</td>
				<th scope="row">접속자집계 출력</th>
				<td>
					<select name="st_footer_visit">
						<option value="">아니오</option>
						<option value="1"<?=$ST->theme->get('st_footer_visit')? ' selected="selected"': ''?>>예</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">푸터 소스코드</th>
				<td>
					<div class="info">필요한 경우, <strong>/theme/st-basic/_inc/footer.php</strong> 파일을 직접 수정하세요.</div>		
				</td>		
				<th scope="row"></th>
				<td></td>							
			</tr>
			</tbody>
			</table>
		</div>			
	</section>
	<div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey="s">
		<a href="<?=G5_URL?>">메인으로</a>
	</div>			
</div>

</form>


<script>
function st_theme_submit(f)
{
    f.action = "./theme_update_var.php";
    return true;
}
</script>

