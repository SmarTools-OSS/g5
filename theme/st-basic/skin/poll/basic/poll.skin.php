<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$poll_skin_url.'/style.css">', 0);
?>


<div id="st-poll">
	<div class="head page-header">
		<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 설문조사</h4>
	</div>
	<div class="subject"><?=$po['po_subject'] ?></div>

	<form name="fpoll" action="<?=G5_BBS_URL ?>/poll_update.php" onsubmit="return fpoll_submit(this);" method="post">
	<input type="hidden" name="po_id" value="<?=$po_id ?>">
	<input type="hidden" name="skin_dir" value="<?=urlencode($skin_dir); ?>">
	
    <ul class="items">
        <?php for ($i=1; $i<=9 && $po["po_poll{$i}"]; $i++) {  ?>
        <li><label class="input"><input type="radio" name="gb_poll" value="<?=$i ?>" id="gb_poll_<?=$i ?>"> <?=$po['po_poll'.$i] ?></label></li>
        <?php }  ?>
    </ul>	
	
	<hr style="margin: 5px 0 10px">
	<div class="actions">
		<?php if ($is_admin == "super") {  ?>
		<div class="left">
			<a href="<?=G5_ADMIN_URL ?>/poll_form.php?w=u&amp;po_id=<?=$po_id ?>" class="btn btn-sm btn-danger"><i class="fa fa-cog" aria-hidden="true"></i> 관리</a>
		</div>
		<?php }  ?>
		<div class="right">
			<a href="<?=G5_BBS_URL."/poll_result.php?po_id=$po_id&amp;skin_dir=".urlencode($skin_dir); ?>" target="_blank" onclick="poll_result(this.href); return false;" class="btn btn-sm btn-default">결과보기</a>	
			<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> 투표하기</button>
		</div>
	</div>
	</form>
</div>


<script>
function fpoll_submit(f)
{
    <?php
    if ($member['mb_level'] < $po['po_level'])
        echo " alert('권한 {$po['po_level']} 이상의 회원만 투표에 참여하실 수 있습니다.'); return false; ";
     ?>

    var chk = false;
    for (i=0; i<f.gb_poll.length;i ++) {
        if (f.gb_poll[i].checked == true) {
            chk = f.gb_poll[i].value;
            break;
        }
    }

    if (!chk) {
        alert("투표하실 설문항목을 선택하세요");
        return false;
    }

    var new_win = window.open("about:blank", "win_poll", "width=616,height=500,scrollbars=yes,resizable=yes");
    f.target = "win_poll";

    return true;
}

function poll_result(url)
{
    <?php
    if ($member['mb_level'] < $po['po_level'])
        echo " alert('권한 {$po['po_level']} 이상의 회원만 결과를 보실 수 있습니다.'); return false; ";
     ?>

    win_poll(url);
}
</script>