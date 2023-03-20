<?

	if($uid){

		$sql = "select * from wo_notice where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$name = $row["name"];
		$title = $row["title"];
		$ment = $row["ment"];
	}




?>



<script language='javascript'>


function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="4"></td>
				</tr>


				<tr> 
					<td width="17%" class='tab_tit30'>작성자</td>
					<td width="83%" class='tab'><?=$name?></td>
				</tr>


				<tr> 
					<td class='tab_tit' height='30'>제목</td>
					<td class='tab'><?=$title?></td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>작업내용</td>
					<td class='tab' height='300'><?=$ment?></td>
				</tr>



			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>


					<td align='right'>						
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>
					</td>

				</tr>
			</table>
		</td>
	</tr>
</table>






</form>

