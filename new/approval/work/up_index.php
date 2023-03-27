<?
	include '../../head.php';
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.DbCon.php";
	include "../../array.php";
	include '../../header2.php';

	if(!$type)	$type = 'list';
?>
<style>
.lnr-home {font-size:4rem;font-weight:800;color: #796C98;}
a:hover { text-decoration: none;}

</style>

<table width="1200" border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td style='padding: 10px 5%;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class="none_print">
				<tr>
					<td width='50%'><a href='/'><span class="lnr lnr-ome"></span></a><?=$subtit?></td>
					<td width='50%' align='right' valign='bottom'><?if($type=='list'){?><a href='up_index.php?type=write' class="big cbtn black">µî·Ï</a><?}?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>

		

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


		</td>
	</tr>					
</table>