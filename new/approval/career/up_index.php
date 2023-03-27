<?
	include "../../../module/class/class.DbCon.php";
	include "../../../module/class/class.Util.php";

	include "../../header.php";

	if(!$type)	$type = 'list';
?>

<!-- <table width="1200" border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td style='padding-top:10px;padding-bottom:10px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class="none_print">
				<tr>
					<td width='50%'><a href='/'><img src='../../img/home.gif'></a>&nbsp;&nbsp;<span style='font-size:20px;font-weight:800;'><?=$subtit?></td>
					<td width='50%' align='right' valign='bottom'><?if($type=='list'){?><a href='up_index.php?type=write' class="big cbtn black">µî·Ï</a><?}?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td> -->
<div class="wrap">
	<?
		include $_SERVER["DOCUMENT_ROOT"]."/new/top_header.php";
	?>
		

<?

	

	$calSize = 'medium';
	include '../../module/Calendar.php';

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

<!-- 
		</td>
	</tr>					
</table> -->
</div>

			<?
		//	include '../../rightContent.php';
		?>

</div>
