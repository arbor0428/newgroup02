<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='30' style='padding-top:30px;'><b>6. 특이사항</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="666666" frame="hsides" class='s'>
<?
	if($uid){
		$query = "select * from wo_ing02_ment where pid='$uid' order by uid desc";
		$query_result = mysql_query($query);
		$tot_ment = mysql_num_rows($query_result);
	}


	if($tot_ment){
		for($i=0; $i<$tot_ment; $i++){
			$info = mysql_fetch_array($query_result);
			$info_uid = $info['uid'];
			$info_ment = $info['ment'];
			$info_date = date('Y-m-d H:i:s',$info['reg_date']);
			$info_cost = $info['cost'];
			$info_cost_vat = $info['cost_vat'];
			$info_deposit = $info['deposit'];
			$info_deposit_date = $info['deposit_date'];


			if($info_cost)	$cost_txt = number_format($info_cost).'원&nbsp;&nbsp;&nbsp;';
			else	$cost_txt = '';

			if($info_cost_vat == '포함')	 $cost_txt .= "(<font color='#de712e'>VAT포함</font>)";



			if($info_deposit)	$deposit_txt = number_format($info_deposit).'원&nbsp;&nbsp;&nbsp;';
			else	$deposit_txt = '';

			if($info_deposit_date)	$deposit_txt .= '수금일('.$info_deposit_date.')';

			
?>

				<tr height='30'> 
					<td width="17%" class='tab_tit'>등록일시</td>
					<td width="33%" class='tab'><?=$info_date?></td>
					<td width="17%" class='tab_tit'></td>
					<td width="33%" class='tab'></td>
				</tr>
				<tr height='30'> 
					<td class='tab_tit'>견적가</td>
					<td class='tab'><?=$cost_txt?></td>
					<td class='tab_tit'>수금액</td>
					<td class='tab'><?=$deposit_txt?></td>
				</tr>
				<tr>
					<td height='50' colspan='4' style='padding-bottom:30px;'><?=$info_ment?></td>
				</tr>

<?
		}
	}else{
?>
				<tr>
					<td height='30'>특이사항을 등록해 주십시오</td>
				</tr>
<?
	}
?>

			</table>
		</td>
	</tr>
</table>