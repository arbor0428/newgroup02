<?
	//서비스 기본정보
	$calendarFile = 'vaca.php';
	$cellh = '35';	// date cell height
	$tablew = 'mini_calendar';	// table width
	$c_path = "../module/calendar";
?>

<section id="wrap">
	<div id="left_area">
	<?
		//메뉴
		$sNum01 = 2;
		$sNum02 = 1;
		//include '../side_menu.php';
	?>
	</div>

	<form name='frm01' method='post' action=''>
	<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
	<input type='hidden' name='scode' value='<?=$GBL_SCODE?>'>
	<input type='text' name='' style='display:none;'>

	<div id="content">
	<?
		include $c_path.'/'.$calendarFile;
	?>
	</div>

	<input type='hidden' name='year' value='<?=$year?>'>
	<input type='hidden' name='month' value='<?=$month?>'>
	<input type='hidden' name='day' value=''>

	</form>

</section>

<style>
	.main_calendar_tit { margin-bottom: 10px;}
</style>