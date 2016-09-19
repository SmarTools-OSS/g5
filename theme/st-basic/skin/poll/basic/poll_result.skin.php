<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$poll_skin_url.'/style.css">', 0);


// G5 코어에서 코멘트 목록에 mb_id를 넘겨주지 않으므로, 이를 다시 구성한다.
$list2 = array();

// 기타의견 리스트
$sql = " select a.*, b.mb_open
           from {$g5['poll_etc_table']} a
           left join {$g5['member_table']} b on (a.mb_id = b.mb_id)
          where po_id = '{$po_id}' order by pc_id desc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list2[$i]['mb_id']  = $row['mb_id'];
    $list2[$i]['pc_name']  = get_text($row['pc_name']);
    $list2[$i]['name']     = get_sideview($row['mb_id'], get_text(cut_str($row['pc_name'],10)), '', '', $row['mb_open']);
    $list2[$i]['idea']     = get_text(cut_str($row['pc_idea'], 255));
    $list2[$i]['datetime'] = $row['pc_datetime'];
    $list2[$i]['del'] = '';
    if ($is_admin == 'super' || ($row['mb_id'] == $member['mb_id'] && $row['mb_id']))
        $list2[$i]['del'] = '<a href="'.G5_BBS_URL.'/poll_etc_update.php?w=d&amp;pc_id='.$row['pc_id'].'&amp;po_id='.$po_id.'&amp;skin_dir='.$skin_dir.'" class="poll_delete">';
}
?>


<div id="st-popup">
	<div class="head page-header">
		<h3><i class="fa fa-check-square" aria-hidden="true"></i> <?=$g5['title'] ?></h3>
	</div>
	<p class="subject"><strong><?=$po_subject ?></strong></p>

	
	<div class="result box">
		<div class="total">전체 <?=$nf_total_po_cnt ?>표</div>
		
		<?php for ($i=1; $i<=count($list); $i++) {  ?>
		<div class="item">
			<div class="sbj clearfix">
				<div class="left"><div class="num"><?=$i?>.</div><?=$list[$i]['content'] ?></div>
				<small class="right"><span class="count"><?=$list[$i]['cnt'] ?>표</span>&nbsp;&nbsp;<div class="rate">(<?=number_format($list[$i]['rate'], 1) ?>%)</div></small>			
			</div>			
			<div class="graph">
				<span style="width:<?=number_format($list[$i]['rate'], 1) ?>%"></span>
			</div>
		</div>
		<?php }  ?>
	</div>

	
	<?php if ($is_etc) {  ?>
	<div class="head page-header">
		<h3><i class="fa fa-comments" aria-hidden="true" style="position:relative; top:-2px;"></i> 이 설문에 대한 기타의견</h3>
	</div>

	<div class="comment box">
		<?php for ($i=0; $i<count($list2); $i++) {  ?>
        <article class="item"<?=($i==0)? ' style="padding-top:0"': ''?>>
            <div class="header">
				<span class="mb_name"><?=ST::get_mb_icon($list2[$i]['mb_id'], $list2[$i]['name']).' '.$list2[$i]['pc_name']; ?></span>
                <span class="datetime">(<?=$list2[$i]['datetime'] ?>)</span>
            </div>
            <p>
                <?=$list2[$i]['idea'] ?>
            </p>
            <footer class="text-right">
                <span class="del"><?php if ($list2[$i]['del']) { echo $list2[$i]['del']."삭제</a>"; }  ?></span>
            </footer>
        </article>
		<?php }  ?>
        <?php if (count($list2) < 1) {  ?>
        <article class="item text-center" style="padding-bottom:20px">
			<i class="fa fa-info-circle" aria-hidden="true"></i> 등록된 의견이 없습니다.
        </article>		
		<?php }  ?>
		
        <?php if ($member['mb_level'] >= $po['po_level']) {  ?>
        <form name="fpollresult" action="./poll_etc_update.php" onsubmit="return fpollresult_submit(this);" method="post" autocomplete="off" style="padding-top:10px">
        <input type="hidden" name="po_id" value="<?=$po_id ?>">
        <input type="hidden" name="w" value="">
        <input type="hidden" name="skin_dir" value="<?=urlencode($skin_dir); ?>">
        <?php if ($is_member) {  ?><input type="hidden" name="pc_name" value="<?=get_text(cut_str($member['mb_nick'],255)) ?>"><?php }  ?>
        
		<p><strong><?=$po_etc ?></strong></p>

		<?php if ($is_guest) {  ?>
		<div class="input-group input-group-sm" style="margin-bottom: 5px;">
			<span class="input-group-addon input-group-addon-sm">이&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;름</span>
			<input type="text" name="pc_name" id="pc_name" class="form-control input-sm required" maxlength="20" placeholder="이름을 입력해 주세요" required>
		</div>		
		<?php }  ?>
		<div class="input-group input-group-sm">
			<span class="input-group-addon input-group-addon-sm">의&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;견</span>
			<input type="text" name="pc_idea" id="pc_idea" class="form-control input-sm required" maxlength="100" placeholder="의견을 입력해 주세요" required>
		</div>		
		<?php if ($is_guest) {  ?>
		<div style="margin-top: 10px;"><?=captcha_html(); ?></div>
		<?php }  ?>		
		
		<hr>
		<div class="text-right">
			<button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 의견남기기</button>	
		</div>	
        </form>
        <?php }  ?>		
	</div>	
	<?php }  ?>
	
	

	<div class="head page-header">
		<h3><i class="fa fa-check-square-o" aria-hidden="true"></i> 다른 설문조사 결과</h3>
	</div>

	<div class="others box">
        <ul class="item">
            <?php for ($i=0; $i<count($list3); $i++) {  ?>
            <li><a href="./poll_result.php?po_id=<?=$list3[$i]['po_id'] ?>&amp;skin_dir=<?=urlencode($skin_dir); ?>">[<?=$list3[$i]['date'] ?>] <?=$list3[$i]['subject'] ?></a></li>
            <?php }  ?>
        </ul>	
	</div>		
	
	<hr>
	<div class="text-right">
		<button type="button" class="btn btn-default" onclick="window.close();">창닫기</button>	
	</div>	
</div>


<script>
$(function() {
    $(".poll_delete").click(function() {
        if(!confirm("해당 기타의견을 삭제하시겠습니까?"))
            return false;
    });
});

function fpollresult_submit(f)
{
    <?php if ($is_guest) { echo chk_captcha_js(); }  ?>
    return true;
}
</script>