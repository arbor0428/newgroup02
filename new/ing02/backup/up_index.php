<?
	include '../head.php';
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.DbCon.php";
	include "../array.php";

	if(!$type)	$type = 'list';

	$subtit = '에이젼시현황';


?>

<script language='javascript'>
function list_sort(field){
	form = document.form1;
	form.field.value = field;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>

<script language='javascript' src='../../module/js/common.js'></script>
<link type='text/css' rel='stylesheet' href='../css/style.css'>

<table width="1000" border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td>
		<?	
			include '../menu.php';
		?>
		</td>
	</tr>
	<tr>
		<td style='padding-top:10px;padding-bottom:10px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
			<form name='frm_list' method='post'>
				<tr>
					<td width='50%'><a href='/work/'><img src='../img/home.gif'></a>&nbsp;&nbsp;<script language='javascript'>flash('200','35','../subtitle.swf?subtit=<?=$subtit?>');</script></td>
					<td width='50%' align='right' valign='bottom'>
					<?
						if($type=='list'){
					?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>								
								<td>
									<select name='field' onchange='list_sort(this.value);'>
									<?
										if($play_sort == ''){
									?>
										<option value='sort' <?if($field=='sort') echo 'selected';?>>순위</option>
									<?
										}
									?>
										<option value='company' <?if($field=='company') echo 'selected';?>>상호명</option>
										<option value='domain_date' <?if($field=='domain_date') echo 'selected';?>>도메인만료일</option>
										<option value='host_date' <?if($field=='host_date') echo 'selected';?>>호스팅만료일</option>
									</select>
								</td>
								<td width='10'></td>
								<td><a href='up_index.php?type=write'><img src="../img/board/register.gif" border=0></a></td>								
							</tr>
						</table>
					<?
						}
					?>
					</td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
	<tr>
		<td>

<?



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