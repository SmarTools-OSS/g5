<?php if (!defined('_GNUBOARD_')) exit; ?>

<aside class="sidebar">
	<hr class="visible-sm-block visible-xs-block">
	<?=$ST->theme->get('st_sidebar_outlogin')? outlogin('theme/basic'): ''; // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>	

	
	<?php if( $ST->theme->get('st_sidebar_menu') and $g5['me'] ) { ?>
	<nav class="list-group">
		<?php foreach($g5['me'] as $row) { 
		
		if( $row['me_code'] != substr($g5['me_active']['me_code'], 0, 2) )
			continue;
		?>
		<a href="<?=$row['me_link']?>" target="_<?=$row['me_target']?>" class="list-group-item<?=($row['me_id'] == $g5['me_active']['me_id'])? ' active': ''?>">
			<?=$row['me_name']?>
		</a>
			<?php foreach($row['sub_menus'] as $row2) { ?>
			<a href="<?=$row2['me_link']?>" target="_<?=$row2['me_target']?>" class="list-group-item<?=($row2['me_id'] == $g5['me_active']['me_id'])? ' active': ''?>">
				- <?=$row2['me_name']?>
			</a>		
				<?php foreach($row2['sub_menus'] as $row3) { ?>						
				<a href="<?=$row3['me_link']?>" target="_<?=$row3['me_target']?>" class="list-group-item<?=($row3['me_id'] == $g5['me_active']['me_id'])? ' active': ''?>">
					&nbsp;&nbsp;· <?=$row3['me_name']?>
				</a>
				<?php 
				} //endforeach as $row3
			} //endforeach as $row2 
		?>
	</nav>
	<?php 
		} //endforeach as $row 
	} //endif of $g5['me'] 
	?>
	
	
	<?=$ST->theme->get('st_sidebar_poll')? poll('theme/basic'): ''; // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
	
	
	<?php for($i=1; $i<=$ST->theme->get('st_sidebar_banner_count'); $i++) { ?>
	<?php
	$img_name = $ST->theme->get('st_sidebar_banner_img_'.$i);
	
	if( !$img_name or !file_exists($ST->theme->get_file_path().'/'.$img_name) )
		continue;
	?>	
	<div class="banner">
		<?php if( $ST->theme->get('st_sidebar_banner_link_'.$i) ) { ?>
		<a href="<?=$ST->theme->get('st_sidebar_banner_link_'.$i)?>" target="<?=$ST->theme->get('st_sidebar_banner_target_'.$i)?>">
			<img src="<?=$ST->theme->get_file_url().'/'.$img_name?>" class="img-responsive">
		</a>
		<?php } else { ?>
		<img src="<?=$ST->theme->get_file_url().'/'.$img_name?>" class="img-responsive">
		<?php } //endif?>
	</div>	
	<?php } //endfor?>
</aside>
