<?
	include "../../module/class/class.DbCon.php";


	$sql = "select * from wo_bus01_config order by uid desc limit 1";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);


	if($num){
		$row = mysql_fetch_array($result);
		$mtype = $row['mtype'];
	}


?>


<script language='javascript' src='/module/js/common.js'></script>
<link type='text/css' rel='stylesheet' href='/css/style.css'>
<style type='text/css'>
body{margin:5px;}
</style>

<script language='javascript'>
function check_form(){
	form = document.frm01;
	if(isFrmEmpty(form.mtype,"�з��� �Է��� �ֽʽÿ�"))	return;
	form.action = 'config_proc.php';
	form.submit();
}
</script>


<form name='frm01' action="config_proc.php" method='post'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>


<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:20px;'>
	<tr>
		<td>* �ŷ�ó���� �з��� ����� �ֽʽÿ�.</td>
	</tr>
</table>




<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;margin-top:5px;" bordercolor="cccccc" frame="hsides" class='s'>
	<tr> 
		<td bgcolor="cccccc"  height="1"></td>
	</tr>
	<tr align='center' height='30'>
		<td bgcolor='#f9f9f9'>�з���</td>
	</tr>
	<tr>
		<td><input type='text' name='mtype' value='<?=$mtype?>' style='width:100%'></td>
	</tr>
	<tr>
		<td>�޸�(,)�� �������� �Է��� �ֽñ� �ٶ��ϴ� (��:����ó,����,�п�)</td>
	</tr>
</table>




<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:15px;'>
	<tr>
		<td align='right'><a href="javascript:check_form();"><img src='/images/common/register.gif'></a></td>
	</tr>
</table>

</form>


<?
	mysql_close($dbconn);
	unset($dbconn);
?>