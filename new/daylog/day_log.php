<?
	if($s_year)	$yy = sprintf('%02d',$s_year);
	else	$yy = $today_y;

	if($s_month)	$mm = sprintf('%02d',$s_month);
	else	$mm = $today_m;

	if($s_day)	$dd = sprintf('%02d',$s_day);
	else	$dd = $today_d;


	$sql = "select * from wo_daylog where userid='$s_name' and db_y='$yy' and db_m='$mm' and db_d='$dd' order by uid";
	$result = mysql_query($sql);
	$tot_log = mysql_num_rows($result);

?>



<?
if($tot_log){

	$query01 = "select * from wo_daylog where userid='$s_name' and db_y='$yy' and db_m='$mm' and db_d='$dd' order by uid limit 1";
	$query02 = mysql_query($query01);
	$rows = mysql_fetch_array($query02);
	$userid = $rows["userid"];
	$name = $rows["name"];
	$reg_date = $rows["reg_date"];
	$reg_date = date('Y-m-d H:i:s',$reg_date);

?>

<script language='javascript'>

function reg_del(y,m,d){
	
	if(confirm('해당업무일지를 삭제하시겠습니까?')){
		form = document.frm_day;
		form.s_year.value = y;
		form.s_month.value = m;
		form.s_day.value = d;
		form.type.value = 'del'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}

}

</script>





<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td width="17%" class='tit02_30'>작성자</td>
					<td class='tab' colspan='2'><?=$name?></td>
				</tr>
			
				<tr> 
					<td width="17%" class='tit02_30'>시간</td>
					<td width='73%' class='tit02_30'>업무내용</td>
					<td width='10%' class='tit02_30'>상태</td>
				</tr>

<?
	for($i=0; $i<$tot_log; $i++){
		$row = mysql_fetch_array($result);	
		$s_h = $row["s_h"];
		$s_m = $row["s_m"];
		$e_h = $row["e_h"];
		$e_m = $row["e_m"];
		$ment = $row["ment"];
		$ping = $row["ping"];

		$log_time = $s_h.':'.$s_m.' ~ '.$e_h.':'.$e_m;
/*

		if($ment){
			$ment = eregi_replace("&nbsp;", " ", $ment);
			$ment = eregi_replace("&lt;", "<", $ment);
			$ment = eregi_replace("&gt;", ">", $ment);
			$ment = eregi_replace("&quot;", "\"", $ment);
			$ment = eregi_replace("&#124;", "\|", $ment);
			$ment = eregi_replace("<br><br>", "\r\n\r\n", $ment);
			$ment = eregi_replace("<BR>", "\r\n", $ment);
		}
*/

?>
				<tr> 
					<td class='tit04' height='30'><?=$log_time?></td>
					<td class='tab'><!--<textarea name='album_list' style='width:99%;height:100%;overflow:visible;border:0px;'>--><?=$ment?></td>
					<td class='tit04'><?=$ping?></td>
				</tr>
<?
	}
?>

				<tr> 
					<td width="17%" class='tit02_30'>작성일</td>
					<td class='tab' colspan='2'><?=$reg_date?></td>
				</tr>
	

			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>


					<td align='right'>
					<?
					if($userid == $GBL_USERID){
					?>	
						<a href="javascript:reg_del('<?=$yy?>','<?=$mm?>','<?=$dd?>');"><img src="/img/board/delete1.gif" border=0></a>

					<?
					}
					?>
						
					</td>

				</tr>
			</table>
		</td>
	</tr>
</table>






<?
}
?>

