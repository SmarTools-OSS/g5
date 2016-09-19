<?php if (!defined('_GNUBOARD_')) exit;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


<div id="st-popup" class="st-mbr st-memo">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-envelope" aria-hidden="true"></i> 내 쪽지함</h3>
	</div>
	
	<ul class="nav nav-tabs">
        <li class="bold<?=$kind=='recv'? ' active': ''?>"><a href="<?='./memo.php?kind=recv'?>">받은쪽지</a></li>
        <li class="bold<?=$kind=='send'? ' active': ''?>"><a href="<?='./memo.php?kind=send'?>">보낸쪽지</a></li>
        <li class="bold<?=$kind=='form'? ' active': ''?>"><a href="<?='./memo_form.php'?>">쪽지쓰기</a></li>
	</ul>
	
	<strong>전체 <?=$kind_title ?>쪽지: <?=$total_count ?>통</strong>	
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col"><?= ($kind == "recv") ? "보낸사람" : "받는사람";  ?></th>
            <th scope="col" class="date">보낸시간</th>
            <th scope="col" class="date">읽은시간</th>
            <th scope="col" class="mgr">관리</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i=0; $i<count($list); $i++) {  ?>
        <tr>
            <td>
				<?php 				
				$mb_id = ($kind=='recv')? $list[$i]['me_send_mb_id']: $list[$i]['me_recv_mb_id'];
				$mb_name = ST::get_mb_icon($mb_id).' '.$list[$i]['mb_nick'];
				$mb_menu = ST::get_mb_menu($mb_id, $list[$i]['mb_nick']); 
				?>
				<?php if( $mb_menu ) { ?>
				<div class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="text-decoration: none">					
						<?=$mb_name?>
					</a>
					<?=$mb_menu?>
				</div>				
				<?php } else { ?>
				<?=$mb_name ?>
				<?php } ?>
			</td>	
            <td class="date"><a href="<?=$list[$i]['view_href'] ?>"><?=$list[$i]['send_datetime'] ?></a></td>
            <td class="date"><a href="<?=$list[$i]['view_href'] ?>"><?=$list[$i]['read_datetime'] ?></a></td>
            <td class="mgr"><a href="<?=$list[$i]['del_href'] ?>" class="btn btn-sm btn-danger" onclick="del(this.href); return false;">삭제</a></td>			
        </tr>
        <?php }  ?>
        <?php if ($i==0) { echo '<tr><td colspan="4" class="text-center">자료가 없습니다.</td></tr>'; }  ?>
        </tbody>
        </table>
    </div>

    <p class="desc">
        ※ 쪽지 보관일수는 최장 <strong><?=$config['cf_memo_del'] ?></strong>일 입니다.
    </p>	
	
	
	<hr>
	<div class="text-right">
		<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>	
	</div>		
</div>
