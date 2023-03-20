<?
	include '../head.php';
	include "../module/class/class.Msg.php";
	include "../module/class/class.DbCon.php";	

	//팀장급(mtype = S)인 경우 본인 팀원 목록만설정
	$teamChk = true;
	include "../array.php";
?>



<script language='javascript'>
function job_search(job){
	form01 = document.form1;
	form01.f_search.value = job;
	form01.record_start.value = '';
	
	form02 = document.frm01;
	form02.submit();
}
</script>


<?	
	//include '../menu.php';
?>

<table width="1200" border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td style='padding-top:10px;padding-bottom:10px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='50%'><a href='/'><img src='../img/home.gif'></a>&nbsp;&nbsp;<span style='font-size:20px;font-weight:800;'>근태현황</td>
					<td width='50%' align='right' valign='bottom'></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<?
				include 'calendar.php';
			?>
		</td>
	</tr>					
</table>

<br><br>

<?
	include '../foot.php';
?>