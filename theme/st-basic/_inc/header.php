<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가?>


<header>
	<nav class="topbar hidden-xs">
		<div class="container clearfix">
			<div class="btn-group btn-group-sm pull-left hidden-xs" role="group">
				<a href="<?=G5_URL?>" class="btn btn-nav"><i class="fa fa-home"></i></a>
				<a href="<?=G5_URL.'/bbs/board.php?bo_table=notice'?>" class="btn btn-nav">공지사항</a>
				<a href="<?=G5_URL.'/bbs/faq.php'?>" class="btn btn-nav">FAQ</a>
				<a href="<?=G5_URL.'/bbs/qalist.php'?>" class="btn btn-nav">1:1문의</a>
			</div>		
			
			<div class="btn-group btn-group-sm pull-right" role="group">
				<a href="https://twitter.com/" target="_blank" class="btn btn-nav"><i class="fa fa-twitter"></i></a>
				<a href="https://www.facebook.com/" target="_blank" class="btn btn-nav"><i class="fa fa-facebook-official"></i></a>
				<a href="<?=G5_URL.'/bbs/new.php'?>" class="btn btn-nav">새글</a>
				<a href="<?=G5_URL.'/bbs/current_connect.php'?>" class="btn btn-nav">접속자 <?=connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></a>
				<?php if( $is_admin ) { ?>
				<a href="<?=ST_ADMIN_URL?>" class="btn btn-nav" target="_blank">관리자 모드</a>
				<?php } ?>
				<?php if( $is_member ) { ?>
				<a href="<?=ST_MYPAGE_URL?>" class="btn btn-nav">마이페이지</a>
				<a href="<?=ST_SETTING_URL?>" class="btn btn-nav">정보수정</a>
				<a href="<?=ST_LOGOUT_URL?>" class="btn btn-nav">로그아웃</a>
				<?php } else { ?>
				<a href="<?=ST_JOIN_URL?>" class="btn btn-nav">회원가입</a>
				<a href="<?=ST_LOGIN_URL?>" class="btn btn-nav">로그인</a>
				<?php } ?>
			</div>
		</div>
	</nav>
	
	
	<aside class="pcbar hidden-xs">
		<div class="container">
			<div class="vmiddle-wrapper">
				<div class="vmiddle-section text-left">
					<?php
					$st_header_pc_logo = $ST->theme->get('st_header_pc_logo');
					$st_header_pc_text = $ST->theme->get('st_header_pc_text');
					$st_header_pc_style = $ST->theme->get('st_header_pc_style');
					?>				
					<div class="brand"<?=$st_header_pc_style? ' style="'.$st_header_pc_style.'"': ''?>>
						<a href="<?=G5_URL?>">
						<?php if( $st_header_pc_text ) { ?>
						<?=$config['cf_title']?>
						<?php } else { ?>
						<?php $logo_url = $st_header_pc_logo? $ST->theme->get_file_url().'/'.$st_header_pc_logo: G5_THEME_URL.'/img/logo_pc.png'?>				
							<img src="<?=$logo_url?>" alt="<?=$config['cf_title']?>">
						<?php } ?>
						</a>						
					</div>
				</div>			
				<div class="vmiddle-section text-right">
					<div class="search">					
						<form class="form-inline" method="get" action="<?=ST_SEARCH_URL?>" onsubmit="if(this.stx.value.length <= 1) {alert('검색어는 2자 이상 입력해 주세요'); return false;}">
							<input type="hidden" name="sfl" value="wr_subject||wr_content">
							<input type="hidden" name="sop" value="and">
							<div class="input-group">
								<input type="text" name="stx" class="form-control" value="<?=$stx?>" placeholder="통합검색" required>		
								<span class="input-group-btn">
									<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
								</span>							
							</div>
						</form>
					</div>			
				</div>			
			</div>		
		</div>	
	</aside>	


	<nav id="st-navbar" class="navbar navbar-<?=($ST->theme->get('st_navbar_color_set')=='inverse')? 'inverse': 'default'?>">
		<div class="container">
			<div class="navbar-header visible-xs-block">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php
				$st_navbar_brand_logo = $ST->theme->get('st_navbar_brand_logo');
				$st_navbar_brand_text = $ST->theme->get('st_navbar_brand_text');
				$st_navbar_brand_style = $ST->theme->get('st_navbar_brand_style');
				?>		
				<a class="navbar-brand" href="<?=G5_URL?>"<?=$st_navbar_brand_style? ' style="'.$st_navbar_brand_style.'"': ''?>>
				<?php if( $st_navbar_brand_text ) { ?>
					<?=$config['cf_title']?>
				<?php } else { ?>
				<?php $logo_url = $st_navbar_brand_logo? $ST->theme->get_file_url().'/'.$st_navbar_brand_logo: G5_THEME_URL.'/img/logo_m.png'?>				
					<img src="<?=$logo_url?>" alt="<?=$config['cf_title']?>">
				<?php } ?>
				</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-hover">
					<li<?=ST::is_active_url(G5_URL.'/')?>><a href="<?=G5_URL?>">홈</a></li>
					
					<?php foreach($g5['me'] as $row) { ?>
					<?php if( count($row['sub_menus']) ) { ?>
					<?php
					$is_active = '';
					if( $row['me_id'] == $g5['me_active']['me_id'] )
						$is_active = ' active';
					else {
						foreach($row['sub_menus'] as $row2) {
							if( $row2['me_id'] == $g5['me_active']['me_id'] ) {
								$is_active = ' active';
								break;
							}
							
							foreach($row2['sub_menus'] as $row3) {
								if( $row3['me_id'] == $g5['me_active']['me_id'] ) {
									$is_active = ' active';
									break;
								}
							}							
						}
					}
					?>				
					<li class="dropdown<?=$is_active? $is_active: ST::has_active_url($row['me_link'], ' active')?>">
						<a href="<?=$row['me_link']?>" target="_<?=$row['me_target']?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$row['me_name']?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
						<?php foreach($row['sub_menus'] as $row2) { ?>
						<?php
						$addinfo = ST::get_addinfo($row2['me_addinfo']);
						echo $addinfo['divider']? '<li class="divider" role="separator"></li>'.PHP_EOL: '';						
						echo $addinfo['header']? '<li class="dropdown-header">'.$addinfo['header'].'</li>'.PHP_EOL: '';
						?>						
							<?php if( count($row2['sub_menus']) ) { ?>
							<?php
							$is_active = '';
							if( $row2['me_id'] == $g5['me_active']['me_id'] )
								$is_active = ' active';
							else {
								foreach($row2['sub_menus'] as $row3) {
									if( $row3['me_id'] == $g5['me_active']['me_id'] ) {
										$is_active = ' active';
										break;
									}
								}
							}
							?>		
							<li class="dropdown-submenu<?=$is_active? $is_active: ST::has_active_url($row2['me_link'], ' active')?>">
								<a href="javascript:void(0)"><?=$row2['me_name']?></a>
								<ul class="dropdown-menu">
									<?php foreach($row2['sub_menus'] as $row3) { ?>				
									<?php
									$addinfo = ST::get_addinfo($row3['me_addinfo']);
									echo $addinfo['divider']? '<li class="divider" role="separator"></li>'.PHP_EOL: '';						
									echo $addinfo['header']? '<li class="dropdown-header">'.$addinfo['header'].'</li>'.PHP_EOL: '';
									?>						
									<li<?=($row3['me_id'] == $g5['me_active']['me_id'])? ' class="active"': ''?>>
										<a href="<?=$row3['me_link']?>" target="_<?=$row3['me_target']?>"><?=$row3['me_name']?></a>
									</li>							
									<?php } //endforeach?>						
								</ul>
							</li>
							<?php } else { ?>
							<li<?=($row2['me_id'] == $g5['me_active']['me_id'])? ' class="active"': ''?>>
								<a href="<?=$row2['me_link']?>" target="_<?=$row2['me_target']?>"><?=$row2['me_name']?></a>
							</li>					
							<?php } //endif?>						
						<?php } //endforeach?>
						</ul>
					</li>
					<?php } else { ?>
					<li<?=($row['me_id'] == $g5['me_active']['me_id'])? ' class="active"': ''?>>
						<a href="<?=$row['me_link']?>" target="_<?=$row['me_target']?>"><?=$row['me_name']?></a>
					</li>				
					<?php } //endif?>
					<?php } //endforeach?>
				</ul>

				<ul class="nav navbar-nav navbar-right navbar-hover">
					<?php
					$is_active = ST::has_active_url(ST_JOIN_URL, ' active');
					$is_active = (!$is_active)? ST::has_active_url(ST_LOGIN_URL, ' active'): $is_active;
					$is_active = (!$is_active)? ST::has_active_url(ST_MYPAGE_URL, ' active'): $is_active;
					$is_active = (!$is_active)? ST::has_active_url(ST_FINDPWD_URL, ' active'): $is_active;
					$is_active = (!$is_active)? ST::has_active_url(ST_SETTING_URL, ' active'): $is_active;
					?>
					<li class="dropdown visible-xs-block<?=$is_active?>">
					<!---<li class="dropdown<?=$is_active?>">--->
						<a href="<?=$is_member? ST_MYPAGE_URL: ST_LOGIN_URL?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-user"></i><span class="visible-xs-inline"> 회원 </span><?php if( $is_member ):?>&nbsp;&nbsp;<span class="label label-success label-logged-in">on</span><?php endif?> <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
						<?php if( $is_member ) { ?>
							<?php if( $is_admin ) { ?>
							<li><a href="<?=ST_ADMIN_URL?>" target="_blank">관리자 모드</a></li>
							<li role="separator" class="divider"></li>
							<?php } //endif?>
							<li<?=ST::has_active_url(ST_MYPAGE_URL)?>><a href="<?=ST_MYPAGE_URL?>">마이페이지</a></li>
							<li role="separator" class="divider"></li>
							<li<?=ST::has_active_url(ST_SETTING_URL)?><?=ST::has_active_url(ST_JOIN_URL)?>><a href="<?=ST_SETTING_URL?>">정보수정</a></li>
							<li><a href="<?=ST_LOGOUT_URL?>">로그아웃</a></li>			
						<?php } else { ?>
							<li<?=ST::has_active_url(ST_LOGIN_URL).ST::has_active_url(ST_FINDPWD_URL)?>><a href="<?=ST_LOGIN_URL?>">로그인</a></li>
							<li<?=ST::has_active_url(ST_JOIN_URL)?>><a href="<?=ST_JOIN_URL?>">회원가입</a></li>
						<?php } //endif?>
						</ul>
					</li>	
					<li class="search visible-xs-block">
						<form class="navbar-form" method="get" action="<?=ST_SEARCH_URL?>" onsubmit="if(this.stx.value.length <= 1) {alert('검색어는 2자 이상 입력해 주세요'); return false;}">
							<input type="hidden" name="sfl" value="wr_subject||wr_content">
							<input type="hidden" name="sop" value="and">
							<div class="form-group">
								<input type="text" name="stx" class="form-control" value="<?=$stx?>" placeholder="통합검색" required>			
							</div>			
						</form>
					</li>			
					<!---
					<li class="dropdown hidden-xs<?=ST::has_active_url(ST_SEARCH_URL, ' active')?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-search"></i> <span class="caret"></span>
						</a>
						<div class="dropdown-menu">
							<div class="panel panel-search">
								<form class="navbar-form" method="get" action="<?=ST_SEARCH_URL ?>" onsubmit="if(this.stx.value.length <= 1) {alert('검색어는 2자 이상 입력해 주세요'); return false;}">
									<input type="hidden" name="sfl" value="wr_subject||wr_content">
									<input type="hidden" name="sop" value="and">
									<div class="input-group">
										<input type="text" name="stx" class="form-control" value="<?=$stx?>" placeholder="통합검색" required>
										<div class="input-group-btn">
											<button class="btn btn-default" type="submit">
												<i class="glyphicon glyphicon-search"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</li>
					--->
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
</header>


