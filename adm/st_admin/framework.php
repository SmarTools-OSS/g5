<?php
$sub_menu = "950100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g5['title'] = "ST 프레임워크";

include_once(G5_ADMIN_PATH.'/admin.head.php');
?>


<form name="fconfig" id="fconfig" method="post" onsubmit="return framework_submit(this);">
<input type="hidden" name="token" value="" id="token">

<div id="st-adm">
	<section id="st_fw_basic">
		<h2>기본환경설정</h2>
		<ul class="anchor">
			<li><a href="#st_fw_basic">기본환경설정</a></li>
			<li><a href="#st_fw_wf">웹폰트 설정</a></li>									
			<li><a href="#st_fw_meta">메타설정 (SEO)</a></li>
			<li><a href="#st_fw_acc">접근제어 (기능설정)</a></li>
			<li><a href="#st_fw_dev">개발자 옵션</a></li>
		</ul>
		<div class="local_desc02 local_desc">
			<p>스마툴즈 빌더 프레임워크의 기본설정을 수행합니다. (올바르게 작성된 ST 테마라면 설정값에 따라 각각의 항목을 적절하게 로드/처리하여 줍니다.)</p>
		</div>
		
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
				<th scope="row">Bootstrap 버전</th>
				<td>
					<?php $ST->config->get('st_bootstrap_ver')?>
					<select name="st_bootstrap_ver">
						<option value="">사용 안 함</option>
						<?php 
						$st_bootstrap_ver = $ST->config->get('st_bootstrap_ver');
						$dirs = ST::scan_dir(ST_PATH.'/assets/bootstrap');
						foreach($dirs as $dir) {
						?>
						<option value="<?=$dir?>"<?=($dir==$st_bootstrap_ver)? ' selected="selected"': ''?>><?=$dir?></option>
						<?php 
						}
						?>
					</select>
					<div class="info">가장 많이 사랑받는 반응형 웹 프레임워크입니다. (필수)</div>					
				</td>					
				<th scope="row">jQuery 버전</th>
				<td>
					<select name="st_jquery_ver">
						<option value="">사용 안 함</option>
						<?php 
						$st_jquery_ver = $ST->config->get('st_jquery_ver');
						$dirs = ST::scan_dir(ST_PATH.'/assets/jquery');
						foreach($dirs as $dir) {
						?>
						<option value="<?=$dir?>"<?=($dir==$st_jquery_ver)? ' selected="selected"': ''?>><?=$dir?></option>
						<?php 
						}
						?>
					</select>
					<div class="info">빠르고, 작고, 기능이 풍부한 자바스크립트 라이브러리입니다. (필수)</div>					
				</td>
			</tr>
			<tr>
				<th scope="row">Font Awesome 버전</th>
				<td>
					<select name="st_fa_ver">
						<option value="">사용 안 함</option>
						<?php
						$st_fa_ver = $ST->config->get('st_fa_ver');
						$dirs = ST::scan_dir(ST_PATH.'/assets/font-awesome');
						foreach($dirs as $dir) {
						?>
						<option value="<?=$dir?>"<?=($dir==$st_fa_ver)? ' selected="selected"': ''?>><?=$dir?></option>
						<?php 
						}
						?>
					</select>
					<div class="info">가장 많이 사랑받는 Iconic Font 및 CSS 툴킷입니다. (필수)</div>
				</td>
				<th scope="row">jQuery UI 버전</th>
				<td>
					<select name="st_jquery_ui_ver">
						<option value="">사용 안 함</option>
						<?php
						$st_jquery_ui_ver = $ST->config->get('st_jquery_ui_ver');
						$dirs = ST::scan_dir(ST_PATH.'/assets/jquery-ui');
						foreach($dirs as $dir) {
						?>
						<option value="<?=$dir?>"<?=($dir==$st_jquery_ui_ver)? ' selected="selected"': ''?>><?=$dir?></option>
						<?php 
						}
						?>
					</select>
					<div class="info">jQuery 기반의 UI 기능 확장용 추가 라이브러리 입니다.</div>
				</td>
			</tr>				
			<tr>		
				<th scope="row">IE 하위버전 경고</th>
				<td>
					<?php
					$st_ie_warning = (int)$ST->config->get('st_ie_warning');
					$st_ie_warning_index = $ST->config->get('st_ie_warning_index');
					?>
					<select name="st_ie_warning">
						<option value="">사용 안 함</option>
						<option value="7"<?=($st_ie_warning == 7)? ' selected="selected"': ''?>>IE7 이하 (IE8 이상을 지원하는 경우)</option>
						<option value="8"<?=($st_ie_warning == 8)? ' selected="selected"': ''?>>IE8 이하 (IE9 이상을 지원하는 경우)</option>
						<option value="9"<?=($st_ie_warning == 9)? ' selected="selected"': ''?>>IE9 이하 (IE10 이상을 지원하는 경우)</option>
					</select>
					&nbsp;
					<label><input type="checkbox" name="st_ie_warning_index" value="1" id="st_ie_warning_index"<?php echo $st_ie_warning_index? ' checked="checked"': ''?>> 메인(홈) 페이지에서만</label>
					<div class="info">설정된 버전 이하의 Internet Explorer로 접속 시, 경고메시지를 띄워줍니다.</div>
				</td>		
				<th scope="row">Placeholders.js 버전</th>
				<td>
					<select name="st_placeholders_ver">
						<option value="">사용 안 함</option>
						<?php
						$st_placeholders_ver = $ST->config->get('st_placeholders_ver');
						$dirs = ST::scan_dir(ST_PATH.'/assets/Placeholders.js');
						foreach($dirs as $dir) {
						?>
						<option value="<?=$dir?>"<?=($dir==$st_placeholders_ver)? ' selected="selected"': ''?>><?=$dir?></option>
						<?php 
						}
						?>
					</select>
					<div class="info">Internet Explorer 8/9 에서 placeholder 속성값을 출력하여 줍니다.</div>
				</td>				
			</tr>					
			<tr>
				<th scope="row">모바일 확대/축소 금지</th>
				<td>
					<label><input type="checkbox" name="st_user_scalable" value="1" id="st_user_scalable"<?php echo $ST->config->get('st_user_scalable')? ' checked="checked"': ''?>> 사용</label>
					<div class="info">모바일에서 사용자가 임의로 웹페이지를 확대/축소할 수 없도록 합니다.<br>(단, 웹브라우저가 확대/축소 강제 사용을 지원하는 경우는 예외)</div>
				</td>
				<th scope="row"></th>
				<td>
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
	
	
	<section id="st_fw_wf">
		<h2>웹폰트 설정</h2>
		<ul class="anchor">
			<li><a href="#st_fw_basic">기본환경설정</a></li>
			<li><a href="#st_fw_wf">웹폰트 설정</a></li>									
			<li><a href="#st_fw_meta">메타설정 (SEO)</a></li>
			<li><a href="#st_fw_acc">접근제어 (기능설정)</a></li>
			<li><a href="#st_fw_dev">개발자 옵션</a></li>
		</ul>
		<div class="local_desc02 local_desc">
			<p>몇 가지 주요 웹폰트를 간편하게 로드하여, ST 테마에서 손쉽게 적용할 수 있도록 해줍니다. (font-family는 직접 설정하셔야 하며, 웹폰트를 많이 사용하면 페이지 로딩이 느려지므로 주의하십시요.)</p>
		</div>
		
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
				<th scope="row">나눔 고딕 (Nanum Gothic)</th>
				<td>
					<?php $st_wf_nanumG = $ST->config->get('st_wf_nanumG');?>				
					<select name="st_wf_nanumG">
						<option value="">사용 안 함</option>
						<option value="cdn-gf"<?=($st_wf_nanumG == 'cdn-gf')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
						<option value="cdn-jsd"<?=($st_wf_nanumG == 'cdn-jsd')? ' selected="selected"': ''?>>CDN(jsDelivr)에서 로딩</option>
					</select>
				</td>					
				<th scope="row">나눔 바른 고딕<br>(Nanum Barun Gothic)</th>
				<td>
					<?php $st_wf_nanumBG = $ST->config->get('st_wf_nanumBG');?>				
					<select name="st_wf_nanumBG">
						<option value="">사용 안 함</option>
						<option value="cdn-jsd"<?=($st_wf_nanumBG == 'cdn-jsd')? ' selected="selected"': ''?>>CDN(jsDelivr)에서 로딩</option>
					</select>
				</td>		
			</tr>
			<tr>						
				<th scope="row">나눔 고딕 코딩<br>(Nanum Gothic Coding)</th>
				<td>
					<?php $st_wf_nanumGC = $ST->config->get('st_wf_nanumGC');?>				
					<select name="st_wf_nanumGC">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_nanumGC == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>
				<th scope="row">나눔 명조 (Nanum Myeongjo)</th>
				<td>
					<?php $st_wf_nanumM = $ST->config->get('st_wf_nanumM');?>				
					<select name="st_wf_nanumM">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_nanumM == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>					
			</tr>
			<tr>							
				<th scope="row">나눔 펜 스크립트<br>(Nanum Pen Script)</th>
				<td>
					<?php $st_wf_nanumPS = $ST->config->get('st_wf_nanumPS');?>				
					<select name="st_wf_nanumPS">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_nanumPS == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>
				<th scope="row">제주 고딕 (Jeju Gothic)</th>
				<td>
					<?php $st_wf_jejuG = $ST->config->get('st_wf_jejuG');?>				
					<select name="st_wf_jejuG">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_jejuG == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>					
			</tr>		
			<tr>
				<th scope="row">제주 한라산 (Jeju Hallasan)</th>
				<td>
					<?php $st_wf_jejuH = $ST->config->get('st_wf_jejuH');?>				
					<select name="st_wf_jejuH">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_jejuH == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>	
				<th scope="row">제주 명조 (Jeju Myeongjo)</th>
				<td>
					<?php $st_wf_jejuM = $ST->config->get('st_wf_jejuM');?>				
					<select name="st_wf_jejuM">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_jejuM == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>							
			</tr>
			<tr>				
				<th scope="row">KoPub 바탕 (KoPub Batang)</th>
				<td>
					<?php $st_wf_kopubB = $ST->config->get('st_wf_kopubB');?>				
					<select name="st_wf_kopubB">
						<option value="">사용 안 함</option>
						<option value="cdn-gf"<?=($st_wf_kopubB == 'cdn-gf')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
						<option value="cdn-gf"<?=($st_wf_kopubB == 'cdn-jsd')? ' selected="selected"': ''?>>CDN(jsDelivr)에서 로딩</option>
					</select>
				</td>		
				<th scope="row">KoPub 돋움 (KoPub Dotum)</th>
				<td>
					<?php $st_wf_kopubD = $ST->config->get('st_wf_kopubD');?>				
					<select name="st_wf_kopubD">
						<option value="">사용 안 함</option>
						<option value="cdn-jsd"<?=($st_wf_kopubD == 'cdn-jsd')? ' selected="selected"': ''?>>CDN(jsDelivr)에서 로딩</option>
					</select>
				</td>					
			</tr>
			<tr>			
				<th scope="row">본고딕<br>(Noto Sans KR/NotoSansKR)</th>
				<td>
					<?php $st_wf_notosansKR = $ST->config->get('st_wf_notosansKR');?>				
					<select name="st_wf_notosansKR">
						<option value="">사용 안 함</option>
						<option value="cdn-gf"<?=($st_wf_notosansKR == 'cdn-gf')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
						<option value="cdn-jsd"<?=($st_wf_notosansKR == 'cdn-jsd')? ' selected="selected"': ''?>>CDN(jsDelivr)에서 로딩</option>
					</select>
					<div class="info">IE8 이하 적용불가</div>
				</td>				
				<th scope="row">한나체 (Hanna)</th>
				<td>
					<?php $st_wf_hanna = $ST->config->get('st_wf_hanna');?>				
					<select name="st_wf_hanna">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_hanna == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>		
			</tr>						
			
			<tr>			
				<th scope="row">Open Sans (Open Sans)</th>
				<td>
					<?php $st_wf_engOpenSans = $ST->config->get('st_wf_engOpenSans');?>				
					<select name="st_wf_engOpenSans">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_engOpenSans == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>				
				<th scope="row">Josefin Slab (Josefin Slab)</th>
				<td>
					<?php $st_wf_engJosefinS = $ST->config->get('st_wf_engJosefinS');?>				
					<select name="st_wf_engJosefinS">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_engJosefinS == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>		
			</tr>					
			<tr>			
				<th scope="row">Arvo (Arvo)</th>
				<td>
					<?php $st_wf_engArvo = $ST->config->get('st_wf_engArvo');?>				
					<select name="st_wf_engArvo">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_engArvo == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>				
				<th scope="row">Lato (Lato)</th>
				<td>
					<?php $st_wf_engLato = $ST->config->get('st_wf_engLato');?>				
					<select name="st_wf_engLato">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_engLato == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>		
			</tr>						
			<tr>			
				<th scope="row">Vollkorn (Vollkorn)</th>
				<td>
					<?php $st_wf_engVollkorn = $ST->config->get('st_wf_engVollkorn');?>				
					<select name="st_wf_engVollkorn">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_engVollkorn == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
				</td>				
				<th scope="row">Abril Fatface (Abril Fatface)</th>
				<td>
					<?php $st_wf_engAbril = $ST->config->get('st_wf_engAbril');?>				
					<select name="st_wf_engAbril">
						<option value="">사용 안 함</option>
						<option value="cdn"<?=($st_wf_engAbril == 'cdn')? ' selected="selected"': ''?>>CDN(구글 폰트)에서 로딩</option>
					</select>
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
	
	
	<section id="st_fw_meta">
		<h2>메타설정 (SEO)</h2>
		<ul class="anchor">
			<li><a href="#st_fw_basic">기본환경설정</a></li>
			<li><a href="#st_fw_wf">웹폰트 설정</a></li>			
			<li><a href="#st_fw_meta">메타설정 (SEO)</a></li>
			<li><a href="#st_fw_acc">접근제어 (기능설정)</a></li>
			<li><a href="#st_fw_dev">개발자 옵션</a></li>
		</ul>
		<div class="local_desc02 local_desc">
			<p>스마툴즈 빌더의 메타정보 및 검색엔진 최적화를 수행할 수 있습니다. (올바르게 작성된 ST 테마라면 메타설정 값을 각각의 웹페이지에 적용하여 줍니다.)</p>
		</div>
		
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
				<th scope="row"><label for="st_meta_title">웹사이트 제목 (title)</label></th>
				<td>
					<input type="text" name="st_meta_title" value="<?=$ST->config->get('st_meta_title')?>" class="frm_input" style="width:95%">
					<div class="info">홈페이지 제목 대신 출력할 웹사이트 제목 문자열을 설정할 수 있습니다.<br>(단, 이 값은 메인(홈) 페이지에서만 적용됨)</div>
				</td>
				<th scope="row"><label for="st_meta_description">웹사이트 설명 (description)</label></th>
				<td><input type="text" name="st_meta_description" value="<?=$ST->config->get('st_meta_description')?>" class="frm_input" style="width:95%"></td>
			</tr>			
			<tr>
				<th scope="row"><label for="st_meta_keywords">웹사이트 키워드 (keywords)</label></th>
				<td><input type="text" name="st_meta_keywords" value="<?=$ST->config->get('st_meta_keywords')?>" class="frm_input" style="width:95%"></td>
				<th scope="row"><label for="st_meta_author">웹사이트 저작자 (author)</label></th>
				<td><input type="text" name="st_meta_author" value="<?=$ST->config->get('st_meta_author')?>" id="st_meta_author" class="frm_input" size="40"></td>
			</tr>
			<tr>
				<th scope="row"><label for="st_meta_keyword">웹사이트 크롤링 (robots)</label></th>
				<td>
					<input type="text" name="st_meta_robots" value="<?=$ST->config->get('st_meta_robots')?>" id="st_meta_robots" class="frm_input" size="40">
					<div class="info">미설정 시, 기본값은 index, follow 입니다.</div>
				</td>
				<th scope="row"><label for="st_meta_image">썸네일 이미지 (og:image)</label></th>
				<td>
					<input type="text" name="st_meta_image" value="<?=$ST->config->get('st_meta_image')?>" id="st_meta_image" class="frm_input" style="width:95%">
					<div class="info">SNS 공유 시 사용되는 썸네일 이미지(200x200 px 이상)를 전제 URL 형식으로 설정할 수 있습니다.<br>(단, 이 값은 메인(홈) 페이지에서만 적용됨)</div>
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
	
	
	<section id="st_fw_acc">
		<h2>접근제어 (기능설정)</h2>
		<ul class="anchor">
			<li><a href="#st_fw_basic">기본환경설정</a></li>
			<li><a href="#st_fw_wf">웹폰트 설정</a></li>						
			<li><a href="#st_fw_meta">메타설정 (SEO)</a></li>
			<li><a href="#st_fw_acc">접근제어 (기능설정)</a></li>
			<li><a href="#st_fw_dev">개발자 옵션</a></li>
		</ul>
		<div class="local_desc02 local_desc">
			<p>웹사이트 운영정책에 따라 각각의 기능 페이지 별로 접근제어를 수행할 수 있습니다. (메시지를 설정할 경우 해당 메시지를 출력한 후 메인 페이지로 이동합니다.)</p>
		</div>
		
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
				<th scope="row">회원가입 페이지</th>
				<td>
					<?php $st_use_join = $ST->config->get('st_use_join')?>
					<select name="st_use_join">
						<option value="">제한 없음</option>
						<option value="-1"<?=($st_use_join == -1)? ' selected="selected"': ''?>>사용 안 함</option>
					</select>			
					&nbsp;&nbsp;메시지: 
					<input type="text" name="st_use_join_msg" value="<?=$ST->config->get('st_use_join_msg')?>" id="st_use_join_msg" class="frm_input" size="40">
				</td>
				<th scope="row">마이페이지</th>
				<td>
					<?php $st_use_mypage = $ST->config->get('st_use_mypage')?>
					<select name="st_use_mypage">
						<option value="">제한 없음</option>
						<option value="-1"<?=($st_use_mypage == -1)? ' selected="selected"': ''?>>사용 안 함</option>
					</select>	
					&nbsp;&nbsp;메시지: 
					<input type="text" name="st_use_mypage_msg" value="<?=$ST->config->get('st_use_mypage_msg')?>" id="st_use_mypage_msg" class="frm_input" size="40">					
				</td>		
			</tr>
			<tr>
				<th scope="row">새글 페이지</th>
				<td>
					<select name="st_use_new">
						<option value="">제한 없음</option>
						<?php
						$st_use_new = $ST->config->get('st_use_new');						
						for($i=2; $i<=10; $i++) {
						?>
						<option value="<?=$i?>"<?=($st_use_new == $i)? ' selected="selected"': ''?>>Lv <?=$i?> 이상</option>
						<?php 
						}
						?>
					</select>
					&nbsp;&nbsp;메시지: 
					<input type="text" name="st_use_new_msg" value="<?=$ST->config->get('st_use_new_msg')?>" id="st_use_new_msg" class="frm_input" size="40">										
				</td>				
				<th scope="row">접속자 페이지</th>
				<td>
					<select name="st_use_connect">
						<option value="">제한 없음</option>
						<?php
						$st_use_connect = $ST->config->get('st_use_connect');						
						for($i=2; $i<=10; $i++) {
						?>
						<option value="<?=$i?>"<?=($st_use_connect == $i)? ' selected="selected"': ''?>>Lv <?=$i?> 이상</option>
						<?php 
						}
						?>
					</select>	
					&nbsp;&nbsp;메시지: 
					<input type="text" name="st_use_connect_msg" value="<?=$ST->config->get('st_use_connect_msg')?>" id="st_use_connect_msg" class="frm_input" size="40">															
				</td>				
			</tr>			
			<tr>
				<th scope="row">FAQ</th>
				<td>
					<select name="st_use_faq">
						<option value="">제한 없음</option>
						<?php
						$st_use_faq = $ST->config->get('st_use_faq');						
						for($i=2; $i<=10; $i++) {
						?>
						<option value="<?=$i?>"<?=($st_use_faq == $i)? ' selected="selected"': ''?>>Lv <?=$i?> 이상</option>
						<?php 
						}
						?>
					</select>	
					&nbsp;&nbsp;메시지: 
					<input type="text" name="st_use_faq_msg" value="<?=$ST->config->get('st_use_faq_msg')?>" id="st_use_faq_msg" class="frm_input" size="40">																				
				</td>				
				<th scope="row">1:1 문의</th>
				<td>
					<select name="st_use_qa">
						<option value="">Lv 2 이상</option>
						<?php
						$st_use_qa = $ST->config->get('st_use_qa');						
						for($i=3; $i<=10; $i++) {
						?>
						<option value="<?=$i?>"<?=($st_use_qa == $i)? ' selected="selected"': ''?>>Lv <?=$i?> 이상</option>
						<?php 
						}
						?>
					</select>	
					&nbsp;&nbsp;메시지: 
					<input type="text" name="st_use_qa_msg" value="<?=$ST->config->get('st_use_qa_msg')?>" id="st_use_qa_msg" class="frm_input" size="40">																									
				</td>				
			</tr>
			<tr>
				<th scope="row">통합검색 페이지</th>
				<td>
					<select name="st_use_search">
						<option value="">제한 없음</option>
						<?php
						$st_use_search = $ST->config->get('st_use_search');						
						for($i=2; $i<=10; $i++) {
						?>
						<option value="<?=$i?>"<?=($st_use_search == $i)? ' selected="selected"': ''?>>Lv <?=$i?> 이상</option>
						<?php 
						}
						?>
					</select>	
					&nbsp;&nbsp;메시지: 
					<input type="text" name="st_use_search_msg" value="<?=$ST->config->get('st_use_search_msg')?>" id="st_use_search_msg" class="frm_input" size="40">																														
				</td>				
				<th scope="row"></th>
				<td>
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
	
	
	<section id="st_fw_dev">
		<h2>개발자 옵션</h2>
		<ul class="anchor">
			<li><a href="#st_fw_basic">기본환경설정</a></li>
			<li><a href="#st_fw_wf">웹폰트 설정</a></li>									
			<li><a href="#st_fw_meta">메타설정 (SEO)</a></li>
			<li><a href="#st_fw_acc">접근제어 (기능설정)</a></li>
			<li><a href="#st_fw_dev">개발자 옵션</a></li>
		</ul>
		<div class="local_desc02 local_desc">
			<p>개발과정에서의 디버깅을 위한 설정을 수행할 수 있습니다. (실 서비스에서는 모두 사용하지 않는 것이 좋습니다.)</p>
		</div>
		
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
				<th scope="row">display_errors</th>
				<td>
					<label><input type="checkbox" name="st_display_errors" value="1" id="st_display_errors"<?php echo $ST->config->get('st_display_errors')? ' checked="checked"': ''?>> 사용</label>
				</td>					
				<th scope="row">FirePHP</th>
				<td>
					<label><input type="checkbox" name="st_firephp" value="1" id="st_firephp"<?php echo $ST->config->get('st_firephp')? ' checked="checked"': ''?>> 사용</label>
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
</div>


<script>
function framework_submit(f)
{
    f.action = "./framework_update.php";
    return true;
}
</script>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
?>