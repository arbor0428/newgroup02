<?
	include "../../../module/class/class.DbCon.php";
	include "../../../module/class/class.Util.php";

	include "../../header.php";

	if(!$type)	$type = 'list';
?>
<div class="wrap">
	<?
		include $_SERVER["DOCUMENT_ROOT"]."/new/top_header.php";
	?>

	

<?

	

	$calSize = 'medium';
	include '../../../module/Calendar.php';

	switch($type){
		case 'list' :
							include 'list.php';
							break;

		case 'view' :
							include 'view.php';
							break;

		case 'write' :
		case 'edit' :
							include 'write.php';
							break;

	}
?>




	
	</div>

			<?
		//	include '../../rightContent.php';
		?>

</div>
