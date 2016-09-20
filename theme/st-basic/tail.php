<?php if (!defined('_GNUBOARD_')) exit?>


<?php if( !defined('_INDEX_') ) {
	$st_layout_sub = $ST->theme->get('st_layout_sub');
	$st_layout_auto_sidebar = $ST->theme->get('st_layout_auto_sidebar');
	if( $st_layout_auto_sidebar and !$g5['me_active'] and ($st_layout_sub==2 or $st_layout_sub==3) )
		$st_layout_sub = 1;
	
	if( !$st_layout_sub ) {
?>
	</div><!--/.container -->

	<?php } elseif( $st_layout_sub==1 ) { ?>
	</div><!--/.container -->

	<?php } else { ?>
			</div><!--/.col-* for content -->
			<div class="col-md-3<?=$st_layout_sub==2? ' col-md-pull-9': ''?>">
				<?php include_once G5_THEME_PATH.'/_inc/sidebar.php'; // 사이드바?>
			</div>
		</div><!--/.row -->
	</div><!--/.container -->

<?php
	}
}
?>


<?php include_once G5_THEME_PATH.'/_inc/footer.php'?>


<?php
// Back-to-top 메뉴
$st_layout_backtotop = $ST->theme->get('st_layout_backtotop');
if( $st_layout_backtotop ) {
?>
<div id="st-backtotop"><span class="glyphicon glyphicon-chevron-up"></span></div>

<script>
$(document).ready(function() {
    var offset = 200;
    var duration = <?=$st_layout_backtotop?>;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('#st-backtotop').fadeIn(duration);
        } else {
            $('#st-backtotop').fadeOut(duration);
        }
    });    
    $('#st-backtotop').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
		$(this).blur();
        return false;
    })
});
</script>
<?php } ?>
		
		
<script>
<?php
// Preloader
$st_layout_preloader = $ST->theme->get('st_layout_preloader');
if( $st_layout_preloader ) {
?>
$(window).ready(function() { // DOM 객체만 로드 되자마자 바로바로 처리 됨
    $('#st-preloader').fadeOut(<?=$st_layout_preloader?>);
})
<?php } ?>


$(function() {
<?php if( !is_mobile() ) { ?>		
	$('#st-body .navbar-hover li.dropdown').hover(function() {
		$(this).addClass('open');
	}, function() {
		$(this).removeClass('open');
	});
	$('#st-body .navbar-hover li.dropdown-submenu').hover(function() {
		$(this).addClass('open');
	}, function() {
		$(this).removeClass('open');
	});
	$('#st-body .navbar-hover li.dropdown > a').click(function() {
		$target = $(this).attr('target');
		if( typeof a == 'undefined' || $target == null ) 
			$target = '_self';
		window.open($(this).attr('href'), $target);
	});
<?php } else { ?>
    $('#st-body .navbar-hover li.dropdown-submenu').click(function(e) {
		e.stopPropagation();	
		
		if( $(this).find('.dropdown-menu').css('display')=='none' )		
			$(this).find('.dropdown-menu').show();		
		else
			$(this).find('.dropdown-menu').hide();	
    });	
<?php } ?>
});


<?php if( ST::isIE(9) and $ST->config->get('st_placeholders_ver') ) { ?>
// Re-define wrestTrim() function in wrest.js for validation error with IE8/9 in Placeholders.js 
function wrestTrim(fld)
{
	var value = fld.value;
	if( value == fld.getAttribute('placeholder') )
		value = '';	
	
	var pattern = /(^\s+)|(\s+$)/g; // \s 공백 문자
	return value.replace(pattern, '');
}
<?php } ?>
</script>


<?php
if ($config['cf_analytics']) {
	echo $config['cf_analytics'];
}
?>
		

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>