<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='30' style='padding-top:30px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><b>3. 도메인정보</b></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id='DotblData'>


<?
	$dtot = '';

	if($uid){

		$sql = "select * from wo_ing02_domain where pid='$uid' order by dodate";
		$result = mysql_query($sql);
		$dtot = mysql_num_rows($result);

		for($i=0; $i<$dtot; $i++){
			$info = mysql_fetch_array($result);
			$duid = $info['uid'];
			$do01 = $info['doname'];
			$do02 = $info['docom'];
			$do03 = $info['doid'];
			$do04 = $info['dopwd'];

			$dbdate = $info['dodate'];



			//도메인만료일자
			if($dbdate){
				$do_yy = date('Y',$dbdate);
				$do_mm = date('m',$dbdate);
				$do_dd = date('d',$dbdate);

			}else{
				$do_yy = '';
				$do_mm = '';
				$do_dd = '';

			}


			if($i > 0)	 echo ("<tr><td height='10'>&nbsp;</td></tr>");

?>
				<tr>
					<td>
						<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
							<tr>
								<td width="17%" class='tab_tit30'>도메인명</td>
								<td width="33%" class='tab'><?=$do01?></td>
								<td width="17%" class='tab_tit30'>도메인업체</td>
								<td width="33%" class='tab'><?=$do02?></td>								
							</tr>
							<tr>
								<td class='tab_tit' height='30'>도메인 만료일자</td>
								<td class='tab'><?=$do_yy?>-<?=$do_mm?>-<?=$do_dd?></td>
								<td class='tab_tit30'>업체 ID / PWD</td>
								<td class='tab'><?=$do03?> / <?=$do04?></td>
							</tr>
						</table>
					</td>
				</tr>
<?			
		}
	}
?>





			</table>
		</td>
	</tr>
</table>