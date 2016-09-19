<?php
$sub_menu = "950900";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$g5['title'] = "빌더정보";

include_once(G5_ADMIN_PATH.'/admin.head.php');
?>


<div id="st-adm">
	<section id="bd_info">
		<h2>빌더정보</h2>
		<ul class="anchor">
			<li><a href="#bd_info">빌더정보</a></li>
			<li><a href="#bd_user">사용자 지원</a></li>									
			<li><a href="#bd_oss">오픈소스 사용공지</a></li>
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
				<th scope="row">이름</th>
				<td>스마툴즈 빌더 for G5/YC5</td>					
				<th scope="row">버전</th>
				<td>v<?=ST_VER?></td>
			</tr>				
			<tr>
				<th scope="row">설명</th>
				<td>오픈소스 CMS/쇼핑몰인 그누보드5 및 영카트5 위에, 간단한 설치만으로도 부트스트랩 기반의 반응형 홈페이지를 손쉽게 구축하고 운영할 수 있도록 도와드리는 반응형 웹사이트 구축 솔루션입니다.</td>	
				<th scope="row">최근 업데이트</th>
				<td><?=ST_VER_DATE?></td>
			</tr>		
			<tr>
				<th scope="row">라이선스</th>
				<td><a href="https://www.olis.or.kr/ossw/license/license/detail.do?lid=1005" target="_blank">LGPL<a/></td>
				<th scope="row">제작사</th>
				<td><a href="https://smartools.co.kr" target="_blank">스마툴즈</a> (<a href="https://smartools.co.kr" target="_blank">https://smartools.co.kr</a>)</td>					
			</tr>					
			</tbody>
			</table>
		</div>	
	</section>

	
	<br><br><br>
	<section id="bd_user">
		<h2>사용자 지원</h2>
		<ul class="anchor">
			<li><a href="#bd_info">빌더정보</a></li>
			<li><a href="#bd_user">사용자 지원</a></li>									
			<li><a href="#bd_oss">오픈소스 사용공지</a></li>
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
				<th scope="row">저작권 안내</th>
				<td valign="top">
					본 소프트웨어의 저작권은 제작사에 있으며, 대한민국 저작권법에 의하여 보호를 받습니다. 사용자는 제공되는 라이선스에 따라 사용범위 및 방법을 준용하여야 하며, 본 페이지, 관련된 일체의 설명, 파일 등을 삭제하거나 변경하여 재배포할 수 없습니다.
					
					<br><br>
					단, 본 소프트웨어에 포함된 각종 오픈소스 소프트웨어 및 추가적인 테마 등은 각각의 제작자에게 저작권이 있으며, 개별적으로 제공되는 라이선스에 따라 사용범위 및 방법을 준용하여야 합니다.</td>
				<th scope="row">이용 안내</th>
				<td>
					사용자는 본 소프트웨어를 사용함으로써 제공되는 라이선스에 동의하는 것으로 간주됩니다. 만약, 그렇지 않을 경우 귀하의 컴퓨터 또는 서버에서 본 소프트웨어를 바로 삭제하여 주십시요.				
					
					<br><br>
					본 소프트웨어는 오픈소스 소프트웨어로써 사용자에게 어떠한 보증이나 기술지원을 제공하지 아니하므로, 사용자는 스스로의 책임과 권한으로 (라이선스를 준용하는 한) 본 소프트웨어를 자유롭게 이용하실 수 있습니다.					
				</td>			
			</tr>					
			<tr>		
				<th scope="row">기술지원 안내</th>
				<td>
					필요한 사용자를 위하여, 제작사에서는 유상으로 기술지원 창구를 제공하고 있습니다.
					
					<br><br>
					제작사 홈페이지에 방문하신 후 상담/개발의뢰 등의 메뉴를 이용하실 수 있으며, 보다 자세한 이용방법은 공지사항 게시판 등을 확인하여 주십시요.
				</td>
				<th scope="row"></th>
				<td></td>
			</tr>		
			</tbody>
			</table>
		</div>	
	</section>	
	
	
	<br><br><br>
	<section id="bd_oss">
		<h2>오픈소스 사용공지</h2>
		<ul class="anchor">
			<li><a href="#bd_info">빌더정보</a></li>
			<li><a href="#bd_user">사용자 지원</a></li>									
			<li><a href="#bd_oss">오픈소스 사용공지</a></li>
		</ul>		
		<div class="local_desc02 local_desc">
			<p>스마툴즈 빌더 for G5/YC5 에서는 다음과 같은 오픈소스 소프트웨어를 포함하고 있습니다.</p>
		</div>	
		
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
				<col>
			</colgroup>
			<tbody>
			<tr>
				<td valign="top">
					<p>- Bootstrap (<a href="http://getbootstrap.com/" target="_blank">홈페이지</a>, <a href="https://github.com/twbs/bootstrap/blob/master/LICENSE" target="_blank">라이선스</a>)</p>
					<p>- jQuery (<a href="https://jquery.com/" target="_blank">홈페이지</a>, <a href="https://jquery.org/license/" target="_blank">라이선스</a>)</p>
					<p>- jQuery UI (<a href="https://jqueryui.com/" target="_blank">홈페이지</a>, <a href="https://jquery.org/license/" target="_blank">라이선스</a>)</p>
					<p>- Font Awesome (<a href="http://fontawesome.io/" target="_blank">홈페이지</a>, <a href="http://fontawesome.io/license/" target="_blank">라이선스</a>)</p>
					<p>- Placeholders.js (<a href="https://jamesallardice.github.io/Placeholders.js/" target="_blank">홈페이지</a>, <a href="https://opensource.org/licenses/MIT" target="_blank">라이선스</a>)</p>
					<p>- FirePHP (<a href="https://github.com/firephp/firephp.org" target="_blank">홈페이지</a>, <a href="https://github.com/firephp/firephp.org/blob/master/LICENSE" target="_blank">라이선스</a>)</p>
				</td>			
			</tr>					
			</tbody>
			</table>
		</div>			
	</section>	
</div>

<?php
include_once(G5_ADMIN_PATH.'/admin.tail.php');
?>