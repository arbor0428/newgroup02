<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='30' style='padding-top:30px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><b>4. ȣ��������</b></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id='HotblData'>


<?
	$htot = '';

	if($uid){

		$sql = "select * from wo_ing02_host where pid='$uid' order by hodate";
		$result = mysql_query($sql);
		$htot = mysql_num_rows($result);

		for($i=0; $i<$htot; $i++){
			$info = mysql_fetch_array($result);
			$huid = $info['uid'];
			$ho01 = $info['ftpid'];
			$ho02 = $info['ftppwd'];
			$ho03 = $info['hocom'];
			$ho04 = $info['hoid'];
			$ho05 = $info['hopwd'];

			$ao01 = $info['ftpstate'];
			$ao02 = $info['ftpcapa'];
			$ao03 = $info['ftpprice'];
			$ao04 = $info['ftptype'];


			$dbdate = $info['hodate'];



			//ȣ���� ��������
			if($dbdate){
				$ho_yy = date('Y',$dbdate);
				$ho_mm = date('m',$dbdate);
				$ho_dd = date('d',$dbdate);

			}else{
				$ho_yy = '';
				$ho_mm = '';
				$ho_dd = '';

			}


			if($i > 0)	 echo ("<tr><td height='10'>&nbsp;</td></tr>");

?>
				<tr>
					<td>
						<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
							<tr>
								<td width="17%" class='tab_tit30'>ȣ���û���</td>
								<td width="33%" class='tab'><?=$ao01?></td>
								<td width="17%" class='tab_tit30'>ȣ��������</td>
								<td width="33%" class='tab'><?=$ao04?></td>
							</tr>
							<tr>
								<td class='tab_tit30'>�����ּ�</td>
								<td class='tab'><?=$ao02?></td>
								<td class='tab_tit30'>û������</td>
								<td class='tab'><?=$ao03?></td>								
							</tr>
							<tr>
								<td class='tab_tit30'>FTP ID / PWD</td>
								<td class='tab'><?=$ho01?> / <?=$ho02?></td>
								<td class='tab_tit30'>ȣ���þ�ü</td>
								<td class='tab'><?=$ho03?></td>								
							</tr>
							<tr>
								<td class='tab_tit' height='30'>ȣ���� ��������</td>
								<td class='tab'><?=$ho_yy?>-<?=$ho_mm?>-<?=$ho_dd?></td>
								<td class='tab_tit30'>��ü ID / PWD</td>
								<td class='tab'><?=$ho04?> / <?=$ho05?></td>
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