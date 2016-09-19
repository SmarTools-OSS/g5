<?php if (!defined('_GNUBOARD_')) exit; 

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>


<style>
#st-popup .table .copymove_current {
    float: right;
    color: #ff3061;
}
</style>


<div id="st-popup" class="st-mbr st-memo">
	<div class="page-header">
		<h3 class="title"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo $g5['title'] ?></h3>
	</div>
	<ul class="page-desc">
		<li><?php echo $act ?>할 게시판을 한개 이상 선택하여 주십시오.</li>
	</ul>
	
	
    <form name="fboardmoveall" method="post" action="./move_update.php" onsubmit="return fboardmoveall_submit(this);">
    <input type="hidden" name="sw" value="<?php echo $sw ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id_list" value="<?php echo $wr_id_list ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="act" value="<?php echo $act ?>">
    <input type="hidden" name="url" value="<?php echo get_text(clean_xss_tags($_SERVER['HTTP_REFERER'])); ?>">
	
	
	<table class="table table-striped">
	<thead>
	<tr>
		<th scope="col">
			<label for="chkall" class="sound_only">현재 페이지 게시판 전체</label>
			<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
		</th>
		<th scope="col"><label for="chkall">전체 게시판</label></th>
	</tr>
	</thead>
	<tbody>	
        <?php for ($i=0; $i<count($list); $i++) {
            $atc_mark = '';
            $atc_bg = '';
            if ($list[$i]['bo_table'] == $bo_table) { // 게시물이 현재 속해 있는 게시판이라면
                $atc_mark = '<span class="copymove_current"><i class="fa fa-angle-double-left" aria-hidden="true"></i> 현재<span class="sound_only">게시판</span></span>';
                $atc_bg = 'copymove_currentbg';
            }
        ?>
        <tr class="<?php echo $atc_bg; ?>">
            <td class="td_chk">
                <label for="chk<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['bo_table'] ?></label>
                <input type="checkbox" value="<?php echo $list[$i]['bo_table'] ?>" id="chk<?php echo $i ?>" name="chk_bo_table[]">
            </td>
            <td>
                <label for="chk<?php echo $i ?>">
                    <?php
                    echo $list[$i]['gr_subject'] . ' &gt; ';
                    $save_gr_subject = $list[$i]['gr_subject'];
                    ?>
                    <?php echo $list[$i]['bo_subject'] ?> (<?php echo $list[$i]['bo_table'] ?>)
                </label>
				<?php echo $atc_mark; ?>
            </td>
        </tr>
        <?php } ?>	
       </tbody>
	</table>

	
	<hr>
	<div class="text-right">
		<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>	
		<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> <?=$act ?></button>	
	</div>
    </form>	
</div>


<script>
$(function() {
    $(".win_btn").append("<button type=\"button\" class=\"btn_cancel\">창닫기</button>");

    $(".win_btn button").click(function() {
        window.close();
    });
});

function all_checked(sw) {
    var f = document.fboardmoveall;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_bo_table[]")
            f.elements[i].checked = sw;
    }
}

function fboardmoveall_submit(f)
{
    var check = false;

    if (typeof(f.elements['chk_bo_table[]']) == 'undefined')
        ;
    else {
        if (typeof(f.elements['chk_bo_table[]'].length) == 'undefined') {
            if (f.elements['chk_bo_table[]'].checked)
                check = true;
        } else {
            for (i=0; i<f.elements['chk_bo_table[]'].length; i++) {
                if (f.elements['chk_bo_table[]'][i].checked) {
                    check = true;
                    break;
                }
            }
        }
    }

    if (!check) {
        alert('게시물을 '+f.act.value+'할 게시판을 한개 이상 선택해 주십시오.');
        return false;
    }

    document.getElementById('btn_submit').disabled = true;

    f.action = './move_update.php';
    return true;
}
</script>
