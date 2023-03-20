<script language='javascript'>
function Domain_insert_row(){

	html_content = '';

	oRow = DotblData.insertRow();

	oRow.onmouseover = function(){DotblData.clickedRowIndex = this.rowIndex};

	idx = oRow.rowIndex;





	html_content += "<tr><td height='10'>&nbsp;</td></tr>";

	html_content += "<tr><td>";
	html_content += "<table width='100%' border='1' cellspacing='0' cellpadding='5' style='border-collapse:collapse;' bordercolor='cccccc' frame='hsides' class='s'>";
	html_content += "<tr>";
	html_content += "<td width='17%' class='tab_tit30'>도메인명</td>";
	html_content += "<td width='33%' class='tab'><input type='text' name='doname[]' style='width:145px;' value=''></td>";
	html_content += "<td width='17%' class='tab_tit30'>도메인업체</td>";
	html_content += "<td width='33%' class='tab'><input type='text' name='docom[]' style='width:145px;' value=''></td>";
	html_content += "</tr>";



	html_content += "<tr>";
	html_content += "<td class='tab_tit' height='30'>도메인 만료일자</td>";
	html_content += "<td class='tab'>";

	html_content += "<select name='do_y[]'>";
	html_content += "<option value=''>===</option>";
<?
	for($i=2010; $i<=date('Y')+3; $i++){
?>
	html_content += "<option value='<?=$i?>'><?=$i?></option>";
<?
	}
?>
	html_content += "</select>년 ";



	html_content += "<select name='do_m[]'>";
	html_content += "<option value=''>==</option>";
<?
	for($i=1; $i<13; $i++){
		$no = sprintf('%2d',$i);
?>
	html_content += "<option value='<?=$no?>'><?=$no?></option>";
<?
	}
?>
	html_content += "</select>월 ";



	html_content += "<select name='do_d[]'>";
	html_content += "<option value=''>==</option>";
<?
	for($i=1; $i<32; $i++){
		$no = sprintf('%2d',$i);
?>
	html_content += "<option value='<?=$no?>'><?=$no?></option>";
<?
	}
?>
	html_content += "</select>일 ";


	html_content += "</td>";
	html_content += "<td class='tab_tit30'>업체 ID / PWD</td>";
	html_content += "<td class='tab'><input type='text' name='doid[]' style='width:100px;' value=''> / <input type='text' name='dopwd[]' style='width:100px;' value=''></td>";
	html_content += "</tr>";



	html_content += "</table>";
	html_content += "</td></tr>";




	oCell = oRow.insertCell();
    oCell.innerHTML = html_content;

}


function Domain_del(no){

	form = document.FRM;

	if(confirm('도메인정보를 삭제하시겠습니까?')){		
		form.did.value = no;
		form.type.value = 'domain_del'
		form.action = 'proc.php';
		form.submit();

	}else{
		return;

	}


}
</script>









<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='30' style='padding-top:30px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><b>3. 도메인정보</b></td>
					<td align='right'><a href="javascript:Domain_insert_row();"><img src='../img/common/btn_add.gif'></a></td>
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

		$sql = "select * from wo_ing01_domain where pid='$uid' order by dodate";
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
								<td width="33%" class='tab'>
									<table cellpadding='0' cellspacing='0' border='0'>	
										<tr>								
											<td><input type='text' name='doname[]' style='width:145px;' value='<?=$do01?>'></td>
								<?
									if($do01){
										$link_domain = str_replace('http://','',$do01);
								?>
											<td width='10'></td>
											<td><a href='http://<?=$link_domain?>' target='_blank'><img src='../img/ico_home.gif' valign='bottom'></a></td>
								<?
									}
								?>
										</tr>
									</table>
								</td>
								<td width="17%" class='tab_tit30'>도메인업체</td>
								<td width="33%" class='tab'><input type='text' name='docom[]' style='width:145px;' value='<?=$do02?>'></td>								
							</tr>
							<tr>
								<td class='tab_tit' height='30'>도메인 만료일자</td>
								<td class='tab'>
									<select name='do_y[]'>
										<option value=''>===</option>
									<?
										for($k=2010; $k<=date('Y')+3; $k++){
									?>
										<option value='<?=$k?>' <?if($do_yy==$k) echo 'selected';?>><?=$k?></option>
									<?
										}
									?>
									</select>년 

									<select name='do_m[]'>
										<option value=''>==</option>
									<?
										for($k=1; $k<13; $k++){
											$no = sprintf('%2d',$k);
									?>
										<option value='<?=$no?>' <?if($do_mm==$no) echo 'selected';?>><?=$no?></option>
									<?
										}
									?>
									</select>월 
									
									<select name='do_d[]'>
										<option value=''>==</option>
									<?
										for($k=1; $k<32; $k++){
											$no = sprintf('%2d',$k);
									?>
										<option value='<?=$no?>' <?if($do_dd==$no) echo 'selected';?>><?=$no?></option>
									<?
										}
									?>
									</select>일 
								</td>
								<td class='tab_tit30'>업체 ID / PWD</td>
								<td class='tab'><input type='text' name='doid[]' style='width:100px;' value='<?=$do03?>'> / <input type='text' name='dopwd[]' style='width:100px;' value='<?=$do04?>'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height='30' align='center'><a href="javascript:Domain_del('<?=$duid?>')"><img src='../img/common/delete.gif'></a></td>
				</tr>
<?			
		}
	}





	if(!$dtot){
?>
				<tr>
					<td>
						<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
							<tr>
								<td width="17%" class='tab_tit30'>도메인명</td>
								<td width="33%" class='tab'><input type='text' name='doname[]' style='width:145px;' value=''></td>
								<td width="17%" class='tab_tit30'>도메인업체</td>
								<td width="33%" class='tab'><input type='text' name='docom[]' style='width:145px;' value=''></td>								
							</tr>
							<tr>
								<td class='tab_tit' height='30'>도메인 만료일자</td>
								<td class='tab'>
									<select name='do_y[]'>
										<option value=''>===</option>
									<?
										for($k=2010; $k<=date('Y')+3; $k++){
									?>
										<option value='<?=$k?>'><?=$k?></option>
									<?
										}
									?>
									</select>년 

									<select name='do_m[]'>
										<option value=''>==</option>
									<?
										for($k=1; $k<13; $k++){
											$no = sprintf('%2d',$k);
									?>
										<option value='<?=$no?>'><?=$no?></option>
									<?
										}
									?>
									</select>월 
									
									<select name='do_d[]'>
										<option value=''>==</option>
									<?
										for($k=1; $k<32; $k++){
											$no = sprintf('%2d',$k);
									?>
										<option value='<?=$no?>'><?=$no?></option>
									<?
										}
									?>
									</select>일 
								</td>
								<td class='tab_tit30'>업체 ID / PWD</td>
								<td class='tab'><input type='text' name='doid[]' style='width:100px;' value=''> / <input type='text' name='dopwd[]' style='width:100px;' value=''></td>
							</tr>
						</table>
					</td>
				</tr>

<?
	}
?>





			</table>
		</td>
	</tr>
</table>