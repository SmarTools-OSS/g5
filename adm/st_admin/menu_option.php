<?php
$sub_menu = "950300";
include_once('./_common.php');

if ($is_admin != 'super')
    alert_close('최고관리자만 접근 가능합니다.');

$g5['title'] = '메뉴옵션 설정';
include_once(G5_PATH.'/head.sub.php');

$row = sql_fetch("SELECT * FROM {$g5['menu_table']} where me_id=".$me_id);
?>

<div id="menu_frm" class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <form name="fmenuform" id="fmenuform" method="post" action="./menu_option_update.php">
	<input type="hidden" name="me_id" value="<?=$me_id?>">
	
	<div class="tbl_frm01 tbl_wrap">
		<table>
		<colgroup>
			<col class="grid_2">
			<col>
		</colgroup>
		<tbody>
		<tr>
			<th scope="row" style="border-top:0"><label for="me_name">메뉴 이름</label></th>
			<td style="border-top:0"><?=$row['me_name']?></td>
		</tr>
		<tr>
			<th scope="row">메뉴 링크</th>
			<td><?=$row['me_link']?></td>
		</tr>
		<tr>
			<th scope="row">메뉴 추가정보</th>
			<td>
				<span class="frm_info">메뉴에 대한 추가정보를 자유롭게 설정할 수 있으며, ST 테마에 따라 메뉴의 출력방식 등을 제어하는데 사용됩니다.<br><br>예를 들어, divider==1|desc==안녕하세요 라고 입력할 경우 메뉴 상단에 구분선 추가되고, 서브헤더 영역에는 desc 값으로 설정된 문자열이 출력됩니다. (단, 해당 ST 테마가 이러한 메뉴 추가정보를 지원해야 함)</span>
				<textarea name="me_addinfo" id="me_addinfo" class="frm_input full_input"><?=$row['me_addinfo']?></textarea>
			</td>
		</tr>		
		<tr>
			<th scope="row">메뉴 제목<br>(title)</th>
			<td>
				<span class="frm_info">메뉴 링크 페이지의 제목을 별도로 설정할 수 있으며, 메타 태그에 적용됩니다. (미설정 시, 기본 제목이 적용)</span>
				<input type="text" name="me_meta_title" id="me_meta_title" value="<?=$row['me_meta_title']?>" class="frm_input full_input">			
			</td>
		</tr>
		<tr>
			<th scope="row">메뉴 설명 (description)</th>
			<td>
				<span class="frm_info">메뉴 링크 페이지의 설명을 별도로 설정할 수 있으며, 메타 태그에 적용됩니다. (미설정 시, ST 프레임워크 설정값 또는 출력없음)</span>
				<input type="text" name="me_meta_description" id="me_meta_description" value="<?=$row['me_meta_description']?>" class="frm_input full_input">			
			</td>
		</tr>		
		<tr>
			<th scope="row">메뉴 키워드 (keywords)</th>
			<td>
				<span class="frm_info">메뉴 링크 페이지의 키워드를 별도로 설정할 수 있으며, 메타 태그에 적용됩니다. (미설정 시, ST 프레임워크 설정값 또는 출력없음)</span>
				<input type="text" name="me_meta_keywords" id="me_meta_keywords" value="<?=$row['me_meta_keywords']?>" class="frm_input full_input">			
			</td>
		</tr>				
		<tr>
			<th scope="row">메뉴 크롤링 (robots)</th>
			<td>
				<span class="frm_info">메뉴 링크 페이지의 크롤링을 별도로 설정할 수 있으며, 메타 태그에 적용됩니다. (미설정 시, ST 프레임워크 설정값 또는 출력없음)</span>
				<input type="text" name="me_meta_robots" id="me_meta_robots" value="<?=$row['me_meta_robots']?>" class="frm_input full_input">			
			</td>
		</tr>
		<tr>
			<th scope="row">메뉴 이미지 (og:image)</th>
			<td>
				<span class="frm_info">메뉴 링크 페이지의 이미지를 별도로 설정할 수 있으며, 메타 태그에 적용됩니다. (미설정 시, 출력없음. 전체 URL 형식. 게시판 등은 비권장)</span>
				<input type="text" name="me_meta_image" id="me_meta_image" value="<?=$row['me_meta_image']?>" class="frm_input full_input">			
			</td>
		</tr>
		</tbody>
		</table>
	</div>	

	<div class="btn_win02 btn_win">
		<button type="submit" class="btn_submit">확인</button>
		<button type="button" class="btn_cancel" onclick="window.close();">창닫기</button>
	</div>
    </form>
</div>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>