<?
	$n_url = "./";
	//include 경로 안먹어서 넣음
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";

?>

<div class="wrap">
	<?
		include "../top_header.php";
	?>
	<div class="content_wrap">
		<div class="main_content_left_sub">
				<div class="list_top">
					<p class="sub_title">프로필 관리</p>
				</div>
		</div>
		<?
			include '../rightContent.php';
		?>
	</div>

</div>

