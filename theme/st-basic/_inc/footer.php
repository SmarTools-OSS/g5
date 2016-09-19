<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가?>

<footer class="footer">
	<div class="container">
		<?=$ST->theme->get('st_footer_popular')? popular('theme/basic'): ''; // 인기검색어, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?>
		<?=$ST->theme->get('st_footer_visit')? visit('theme/basic'): ''; // 접속자집계, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
	</div>

	<nav class="footbar">
		<div class="container clearfix">
			<div class="btn-group btn-group-sm pull-left" role="group">
				<a href="<?=G5_BBS_URL?>/content.php?co_id=company" class="btn btn-nav">회사소개</a>
				<a href="<?=G5_BBS_URL?>/content.php?co_id=provision" class="btn btn-nav">서비스이용약관</a>
				<a href="<?=G5_BBS_URL?>/content.php?co_id=privacy" class="btn btn-nav">개인정보취급방침</a>
			</div>
			<div class="btn-group btn-group-sm pull-right" role="group">
				<a href="#st-body" class="btn btn-nav"><span class="glyphicon glyphicon-chevron-up"></span></a>
			</div>
		</div>
	</nav>
	
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 info">
					상호: <?=$default['de_admin_company_name']? $default['de_admin_company_name']: $config['cf_title']?><br class="visible-xs-v">
					<span class="divider hidden-xs-v">|</span>
					주소: <?=$default['de_admin_company_addr']? $default['de_admin_company_addr']: 'OOO OOO OOO OOO OOO 123-56'?>
					
					<br><br class="visible-xs-v">
					사업자등록번호: <?=$default['de_admin_company_saupja_no']? $default['de_admin_company_saupja_no']: '000-00-00000'?>
					<span class="divider">|</span>					
					대표자: <?=$default['de_admin_company_owner']? $default['de_admin_company_owner']: '홍길동'?>			
					<span class="divider">|</span>
					전화: <a href="tel:<?=$default['de_admin_company_tel']? $default['de_admin_company_tel']: '02-000-0001'?>"><?=$default['de_admin_company_tel']? $default['de_admin_company_tel']: '02-000-0001'?></a>
					
					<br class="hidden-xs-v">
					<span class="divider visible-xs-v-inline">|</span>	
					통신판매업신고번호: <?=$default['de_admin_tongsin_no']? $default['de_admin_tongsin_no']: '제 OO구 - 123호'?>
					<span class="divider">|</span>
					팩스: <?=$default['de_admin_company_fax']? $default['de_admin_company_fax']: '02-000-0002'?><br class="hidden-xs-v">
					
					<br class="visible-xs-v"><br class="visible-xs-v">
					개인정보관리책임자: <?=$default['de_admin_info_name']? $default['de_admin_info_name']: '홍길동'?>
					<span class="divider hidden-xs-v">|</span>
					<br class="visible-xs-v">
					이메일: <a href="mailto:<?=$config['cf_admin_email']?>"><?=$config['cf_admin_email']?></a>			
				</div>
				<div class="col-md-3 links">
					<hr class="visible-sm-block visible-xs-block">
					· <a href="<?=G5_BBS_URL?>/content.php?co_id=sitemap">사이트맵</a><br>
					· <a href="<?=G5_BBS_URL?>/content.php?co_id=point">포인트정책</a><br>
					· <a href="<?=G5_BBS_URL?>/content.php?co_id=location">찾아오시는길</a><br>
				</div>
			</div>		
		</div>
	</div>	
			
	<div class="copyright">
		<div class="container">
			Copyright © <?=date('Y')?> <?=$_SERVER['HTTP_HOST']?>.<br class="visible-xs-v"> All rights reserved.
			
			<?php if( $is_admin) { ?>
			<br>
			<a href="https://smartools.co.kr" target="_blank">스마툴즈 빌더</a>: v<?=defined('ST_VER')? ST_VER: '???'?> (<a href="https://sir.kr" target="_blank"><?=defined('G5_YOUNGCART_VER')? 'YC5': 'G5'?></a> based)
			/
			Runtime: <?=round(get_microtime()-$begin_time, 5)?>s
			<?php } ?>				
		</div>
	</div>	
</footer>