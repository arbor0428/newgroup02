<script language='javascript'>
function Host_insert_row(){

	html_content = '';

	oRow = HotblData.insertRow();

	oRow.onmouseover = function(){HotblData.clickedRowIndex = this.rowIndex};

	idx = oRow.rowIndex;





	html_content += "<tr><td height='10'>&nbsp;</td></tr>";

	html_content += "<tr><td>";
	html_content += "<table width='100%' border='1' cellspacing='0' cellpadding='5' style='border-collapse:collapse;' bordercolor='cccccc' frame='hsides' class='s'>";



	html_content += "<tr>";
	html_content += "<td width='17%' class='tab_tit30'>ȣ���û���</td>";
	html_content += "<td width='33%' class='tab'>";
	html_content += "<select name='ftpstate[]'>";
	html_content += "<option value='����'>����</option>";
	html_content += "<option value='����'>����</option>";
	html_content += "</select></td>";
	html_content += "<td width='17%' class='tab_tit30'>ȣ��������</td>";
	html_content += "<td width='33%' class='tab'>";
	html_content += "<select name='ftptype[]'>";
	html_content += "<option value=''>ȣ�����ش����</option>";
	html_content += "<option value='�������̿�'>�������̿�</option>";
	html_content += "<option value='������[�ڵ�û��]'>������[�ڵ�û��]</option>";
	html_content += "<option value='������[����û��]'>������[����û��]</option>";
	html_content += "</select>";
	html_content += "</td></tr>";




	html_content += "<tr>";
	html_content += "<td width='17%' class='tab_tit30'>�����ּ�</td>";
	html_content += "<td width='33%' class='tab'><input type='text' name='ftpcapa[]' style='width:215px;' value='<?=$ao02?>'></td>";
	html_content += "<td width='17%' class='tab_tit30'>û������</td>";
	html_content += "<td width='33%' class='tab'><input type='text' name='ftpprice[]' style='width:100px;' value='<?=$ao03?>'></td>";
	html_content += "</tr>";





	html_content += "<tr>";
	html_content += "<td class='tab_tit30'>FTP ID / PWD</td>";
	html_content += "<td class='tab'><input type='text' name='ftpid[]' style='width:100px;' value=''> / <input type='text' name='ftppwd[]' style='width:100px;' value=''></td>";
	html_content += "<td class='tab_tit30'>ȣ���þ�ü</td>";
	html_content += "<td class='tab'><input type='text' name='hocom[]' style='width:145px;' value=''></td>";
	html_content += "</tr>";



	html_content += "<tr>";
	html_content += "<td class='tab_tit' height='30'>ȣ���� ��������</td>";
	html_content += "<td class='tab'>";

	html_content += "<select name='ho_y[]'>";
	html_content += "<option value=''>===</option>";
<?
	for($i=2010; $i<=date('Y')+3; $i++){
?>
	html_content += "<option value='<?=$i?>'><?=$i?></option>";
<?
	}
?>
	html_content += "</select>�� ";



	html_content += "<select name='ho_m[]'>";
	html_content += "<option value=''>==</option>";
<?
	for($i=1; $i<13; $i++){
		$no = sprintf('%2d',$i);
?>
	html_content += "<option value='<?=$no?>'><?=$no?></option>";
<?
	}
?>
	html_content += "</select>�� ";



	html_content += "<select name='ho_d[]'>";
	html_content += "<option value=''>==</option>";
<?
	for($i=1; $i<32; $i++){
		$no = sprintf('%2d',$i);
?>
	html_content += "<option value='<?=$no?>'><?=$no?></option>";
<?
	}
?>
	html_content += "</select>�� ";


	html_content += "</td>";
	html_content += "<td class='tab_tit30'>��ü ID / PWD</td>";
	html_content += "<td class='tab'><input type='text' name='hoid[]' style='width:100px;' value=''> / <input type='text' name='hopwd[]' style='width:100px;' value=''></td>";
	html_content += "</tr>";



	html_content += "</table>";
	html_content += "</td></tr>";




	oCell = oRow.insertCell();
    oCell.innerHTML = html_content;

}


function Host_del(no){

	form = document.FRM;

	if(confirm('ȣ���������� �����Ͻðڽ��ϱ�?')){		
		form.did.value = no;
		form.type.value = 'host_del'
		form.action = 'proc.php';
		form.submit();

	}else{
		return;

	}


}
</script>





























<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='30' style='padding-top:30px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><b>4. ȣ��������</b></td>
					<td align='right'><a href="javascript:Host_insert_row();"><img src='../img/common/btn_add.gif'></a></td>
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

		$sql = "select * from wo_ing01_host where pid='$uid' order by hodate";
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
								<td width="33%" class='tab'>
									<select name='ftpstate[]'>
										<option value='����' <?if($ao01=='����'){echo 'selected';}?>>����</option>
										<option value='����' <?if($ao01=='����'){echo 'selected';}?>>����</option>
									</select>
								</td>
								<td width="17%" class='tab_tit30'>ȣ��������</td>
								<td width="33%" class='tab'>
									<select name='ftptype[]'>
										<option value=''>ȣ�����ش����</option>
										<option value='�������̿�' <?if($ao04=='�������̿�'){echo 'selected';}?>>�������̿�</option>
										<option value='������[�ڵ�û��]' <?if($ao04=='������[�ڵ�û��]'){echo 'selected';}?>>������[�ڵ�û��]</option>
										<option value='������[����û��]' <?if($ao04=='������[����û��]'){echo 'selected';}?>>������[����û��]</option>
									</select>
								</td>								
							</tr>
							<tr>
								<td width="17%" class='tab_tit30'>�����ּ�</td>
								<td width="33%" class='tab'><input type='text' name='ftpcapa[]' style='width:215px;' value='<?=$ao02?>'></td>
								<td width="17%" class='tab_tit30'>û������</td>
								<td width="33%" class='tab'><input type='text' name='ftpprice[]' style='width:100px;' value='<?=$ao03?>'></td>								
							</tr>
							<tr>
								<td class='tab_tit30'>FTP ID / PWD</td>
								<td class='tab'><input type='text' name='ftpid[]' style='width:100px;' value='<?=$ho01?>'> / <input type='text' name='ftppwd[]' style='width:100px;' value='<?=$ho02?>'></td>
								<td class='tab_tit30'>ȣ���þ�ü</td>
								<td class='tab'><input type='text' name='hocom[]' style='width:145px;' value='<?=$ho03?>'></td>								
							</tr>
							<tr>
								<td class='tab_tit' height='30'>ȣ���� ��������</td>
								<td class='tab'>
									<select name='ho_y[]'>
										<option value=''>===</option>
									<?
										for($k=2010; $k<=date('Y')+3; $k++){
									?>
										<option value='<?=$k?>' <?if($ho_yy==$k) echo 'selected';?>><?=$k?></option>
									<?
										}
									?>
									</select>�� 

									<select name='ho_m[]'>
										<option value=''>==</option>
									<?
										for($k=1; $k<13; $k++){
											$no = sprintf('%2d',$k);
									?>
										<option value='<?=$no?>' <?if($ho_mm==$no) echo 'selected';?>><?=$no?></option>
									<?
										}
									?>
									</select>�� 
									
									<select name='ho_d[]'>
										<option value=''>==</option>
									<?
										for($k=1; $k<32; $k++){
											$no = sprintf('%2d',$k);
									?>
										<option value='<?=$no?>' <?if($ho_dd==$no) echo 'selected';?>><?=$no?></option>
									<?
										}
									?>
									</select>�� 
								</td>
								<td class='tab_tit30'>��ü ID / PWD</td>
								<td class='tab'><input type='text' name='hoid[]' style='width:100px;' value='<?=$ho04?>'> / <input type='text' name='hopwd[]' style='width:100px;' value='<?=$ho05?>'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height='30' align='center'><a href="javascript:Host_del('<?=$huid?>')"><img src='../img/common/delete.gif'></a></td>
				</tr>
<?			
		}
	}





	if(!$htot){
?>
				<tr>
					<td>
						<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
							<tr>
								<td width="17%" class='tab_tit30'>ȣ���û���</td>
								<td width="83%" class='tab' colspan='3'>
									<select name='ftpstate[]'>
										<option value='����'>����</option>
										<option value='����'>����</option>
									</select>
								</td>
							</tr>
							<tr>
								<td width="17%" class='tab_tit30'>�����ּ�</td>
								<td width="33%" class='tab'><input type='text' name='ftpcapa[]' style='width:215px;' value=''></td>
								<td width="17%" class='tab_tit30'>û������</td>
								<td width="33%" class='tab'><input type='text' name='ftpprice[]' style='width:100px;' value=''></td>								
							</tr>
							<tr>
								<td class='tab_tit30'>FTP ID / PWD</td>
								<td class='tab'><input type='text' name='ftpid[]' style='width:100px;' value=''> / <input type='text' name='ftppwd[]' style='width:100px;' value=''></td>
								<td class='tab_tit30'>ȣ���þ�ü</td>
								<td class='tab'><input type='text' name='hocom[]' style='width:145px;' value=''></td>								
							</tr>
							<tr>
								<td class='tab_tit' height='30'>ȣ���� ��������</td>
								<td class='tab'>
									<select name='ho_y[]'>
										<option value=''>===</option>
									<?
										for($k=2010; $k<=date('Y')+3; $k++){
									?>
										<option value='<?=$k?>'><?=$k?></option>
									<?
										}
									?>
									</select>�� 

									<select name='ho_m[]'>
										<option value=''>==</option>
									<?
										for($k=1; $k<13; $k++){
											$no = sprintf('%2d',$k);
									?>
										<option value='<?=$no?>'><?=$no?></option>
									<?
										}
									?>
									</select>�� 
									
									<select name='ho_d[]'>
										<option value=''>==</option>
									<?
										for($k=1; $k<32; $k++){
											$no = sprintf('%2d',$k);
									?>
										<option value='<?=$no?>'><?=$no?></option>
									<?
										}
									?>
									</select>�� 
								</td>
								<td class='tab_tit30'>��ü ID / PWD</td>
								<td class='tab'><input type='text' name='hoid[]' style='width:100px;' value=''> / <input type='text' name='hopwd[]' style='width:100px;' value=''></td>
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