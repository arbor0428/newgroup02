<?
	$n_url = "./";
	//include 경로 안먹어서 넣음
	include $_SERVER["DOCUMENT_ROOT"]."/module/class/class.DbCon.php";
	include $_SERVER["DOCUMENT_ROOT"]."/module/class/class.Util.php";

	include $_SERVER["DOCUMENT_ROOT"]."/new/header.php";

?>

<div class="wrap">
	<?
		include $_SERVER["DOCUMENT_ROOT"]."/new/top_header.php";
	?>
	<div class="content_wrap">
		<div class="sub"></div>
			<?
			include $_SERVER["DOCUMENT_ROOT"].'/new/rightContent.php';
		?>
	</div>

</div>



