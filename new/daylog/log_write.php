<script language='javascript'>
function check_tb1(){
	form = document.frm_day;
	form.type.value = 'write';
	form.submit();
}


function onWriteFormHide(num){

	var get_ments = document.getElementsByName("ment[]");

	for(i=0; i<get_ments.length; i++){
		get_ments[i].value = '';
	}

	var Form_tr = document.getElementById("wr" + num);

	Form_tr.style.display='none';

}

function insert_row(){

	form = document.frm_day;
	var get_end_hours = document.getElementsByName("e_h[]");
	var get_end_min = document.getElementsByName("e_m[]");

	html_content = '';

	oRow = tblData.insertRow();

	oRow.onmouseover = function(){tblData.clickedRowIndex = this.rowIndex};

	idx = oRow.rowIndex;

	before = idx - 1;

	start_hours = get_end_hours[before].value;
	start_min = get_end_min[before].value;


	html_content += "<tr><td height=25>&nbsp;</td></tr><tr><td><table cellpadding=0 cellspacing=0 border=0 width=100%>";
	html_content += "<tr><td width=100>	<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td align=center>";
	html_content += "<select name='s_h[]'>";
	



	html_content += "<option value='09'";
	if(start_hours == '09')	html_content += " selected";
	html_content += ">09</option>";
	

	html_content += "<option value='10'";
	if(start_hours == '10')	html_content += " selected";
	html_content += ">10</option>";
	

	html_content += "<option value='11'";
	if(start_hours == '11')	html_content += " selected";
	html_content += ">11</option>";
	

	html_content += "<option value='12'";
	if(start_hours == '12')	html_content += " selected";
	html_content += ">12</option>";
	

	html_content += "<option value='13'";
	if(start_hours == '13')	html_content += " selected";
	html_content += ">13</option>";
	

	html_content += "<option value='14'";
	if(start_hours == '14')	html_content += " selected";
	html_content += ">14</option>";
	

	html_content += "<option value='15'";
	if(start_hours == '15')	html_content += " selected";
	html_content += ">15</option>";
	

	html_content += "<option value='16'";
	if(start_hours == '16')	html_content += " selected";
	html_content += ">16</option>";
	

	html_content += "<option value='17'";
	if(start_hours == '17')	html_content += " selected";
	html_content += ">17</option>";
	

	html_content += "<option value='18'";
	if(start_hours == '18')	html_content += " selected";
	html_content += ">18</option>";
	

	html_content += "<option value='19'";
	if(start_hours == '19')	html_content += " selected";
	html_content += ">19</option>";
	

	html_content += "<option value='20'";
	if(start_hours == '20')	html_content += " selected";
	html_content += ">20</option>";
	

	html_content += "<option value='21'";
	if(start_hours == '21')	html_content += " selected";
	html_content += ">21</option>";
	

	html_content += "<option value='22'";
	if(start_hours == '22')	html_content += " selected";
	html_content += ">22</option>";
	

	html_content += "<option value='23'";
	if(start_hours == '23')	html_content += " selected";
	html_content += ">23</option>";
	

	html_content += "<option value='24'";
	if(start_hours == '24')	html_content += " selected";
	html_content += ">24</option>";
	html_content += "</select> : ";
	html_content += "<select name='s_m[]'>";
	html_content += "<option value='00'";
	if(start_min == '00')	 html_content += "selected";
	html_content += ">00</option>";
	html_content += "<option value='30'";
	if(start_min == '30')	 html_content += "selected";
	html_content += ">30</option>";
	html_content += "</select></td></tr>";
	html_content += "<tr><td align=center>↓</td></tr><tr><td align=center><select name='e_h[]'>";
	html_content += "<option value='09'>09</option>";
	html_content += "<option value='10'>10</option>";
	html_content += "<option value='11'>11</option>";
	html_content += "<option value='12'>12</option>";
	html_content += "<option value='13'>13</option>";
	html_content += "<option value='14'>14</option>";
	html_content += "<option value='15'>15</option>";
	html_content += "<option value='16'>16</option>";
	html_content += "<option value='17'>17</option>";
	html_content += "<option value='18'>18</option>";
	html_content += "<option value='19'>19</option>";
	html_content += "<option value='20'>20</option>";
	html_content += "<option value='21'>21</option>";
	html_content += "<option value='22'>22</option>";
	html_content += "<option value='23'>23</option>";
	html_content += "<option value='24'>24</option>";
	html_content += "</select> : ";
	html_content += "<select name='e_m[]'><option value='00'>00</option><option value='30'>30</option></select></td></tr>";
	html_content += "</table></td><td align=center style='padding-left:5px;padding-right:5px;'>";
	html_content += "<textarea style='width:100%;height:55px;' name='ment[]'></textarea></td>";
	html_content += "<td width=80 align=center><select name='ping[]'><option value='완료'>완료</option><option value='진행'>진행</option>";
	html_content += "<option value='보류'>보류</option></select></td></tr></table></td></tr>";

	

	oCell = oRow.insertCell();
    oCell.innerHTML = html_content;

}

</script>




<table cellpadding=0 cellspacing=0 border=0 width=100%>
	<tr id="wr1" style="display:'none'">
		<td>
			<table cellpadding=0 cellspacing=0 border=0 width=100%>
				<tr>
					<td height=20></td>
				</tr>
				<tr>
					<td>
						<table cellpadding="5" cellspacing="0" style="border-collapse:collapse;border-top-color:#bcbcbc;border-bottom-color:#bcbcbc;" border="1" bordercolor="D7D7D4" frame="hsides" align=center width="100%">
							<tr height=60>
								<td align=center width=50><a href="javascript:onWriteFormHide('1');"><img src='/img/btn_passx.gif'></a></td>
								<td align=center width=130>
									<select name='db_y'>
								<?
									for($i=2010; $i<=$today_y; $i++){
										if($i == $today_y)	 $chk = 'selected';
										else	$chk = '';

										echo ("<option value='$i' $chk>$i</option>");
									}
								?>
									</select>년<br>

									<select name='db_m'>
									<?
									for($i=1; $i<=12; $i++){
										$no = sprintf("%02d",$i);
										if($today_m == $i)	$chk = 'selected';
										else	$chk = '';

										echo ("<option value='$no' $chk>$no</option>");
									}
									?>
									</select>월

									<select name='db_d'>
									<?
									for($i=1; $i<=31; $i++){
										$no = sprintf("%02d",$i);
										if($today_d == $i)	$chk = 'selected';
										else	$chk = '';

										echo ("<option value='$no' $chk>$no</option>");
									}
									?>
									</select>일
								</td>



								<td>
								<!-- 업무등록 추가 테이블 -->
									<table cellpadding=0 cellspacing=0 border=0 width=100% id='tblData'>
										<tr>
											<td>
												<table cellpadding=0 cellspacing=0 border=0 width=100%>
													<tr>
														<td width=100>											
															<table cellpadding=0 cellspacing=0 border=0 width=100%>
																<tr>
																	<td align=center style="display: flex;">

																		<select name='s_h[]'>
																		<?
																			for($i=9; $i<=24; $i++){
																				$no = sprintf("%02d",$i);

																				if($i==9)	$chk = 'selected';
																				else	$chk = '';

																				echo ("<option value='$no' $chk>$no</option>");
																			}
																		?>
																		</select> : 

																		<select name='s_m[]'>
																			<option value='00'>00</option>
																			<option value='30'>30</option>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td align=center>↓</td>
																</tr>
																<tr>
																	<td align=center style="display: flex;">
																		<select name='e_h[]'>
																		<?
																			for($i=9; $i<=24; $i++){
																				$no = sprintf("%02d",$i);

																				if($i==12)	$chk = 'selected';
																				else	$chk = '';

																				echo ("<option value='$no' $chk>$no</option>");
																			}
																		?>
																		</select> : 

																		<select name='e_m[]'>
																			<option value='00'>00</option>
																			<option value='30'>30</option>
																		</select>
																	</td>																	
																</tr>
															</table>
														</td>
														<td align=center style='padding-left:5px;padding-right:5px;'><textarea style='width:100%;height:55px;' name='ment[]'></textarea></td>
														<td width=80 align=center>
															<select name='ping[]'>
																<option value='완료'>완료</option>
																<option value='진행'>진행</option>
																<option value='보류'>보류</option>																
															</select>
														</td>
													</tr>
												</table>
											</td>
										</tr>

										<tr>
											<td style='padding:15px 0px 0px 0px;'>
												<table cellpadding=0 cellspacing=0 border=0 width=100%>
													<tr>
														<td width=100>											
															<table cellpadding=0 cellspacing=0 border=0 width=100%>
																<tr>
																	<td align=center style="display: flex;">

																		<select name='s_h[]'>
																		<?
																			for($i=9; $i<=24; $i++){
																				$no = sprintf("%02d",$i);

																				if($i==13)	$chk = 'selected';
																				else	$chk = '';

																				echo ("<option value='$no' $chk>$no</option>");
																			}
																		?>
																		</select> : 

																		<select name='s_m[]'>
																			<option value='00'>00</option>
																			<option value='30'>30</option>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td align=center>↓</td>
																</tr>
																<tr>
																	<td align=center style="display: flex;">
																		<select name='e_h[]'>
																		<?
																			for($i=9; $i<=24; $i++){
																				$no = sprintf("%02d",$i);

																				if($i==18)	$chk = 'selected';
																				else	$chk = '';

																				echo ("<option value='$no' $chk>$no</option>");
																			}
																		?>
																		</select> : 

																		<select name='e_m[]'>
																			<option value='00'>00</option>
																			<option value='30'>30</option>
																		</select>
																	</td>																	
																</tr>
															</table>
														</td>
														<td align=center style='padding-left:5px;padding-right:5px;'><textarea style='width:100%;height:55px;' name='ment[]'></textarea></td>
														<td width=80 align=center>
															<select name='ping[]'>
																<option value='완료'>완료</option>
																<option value='진행'>진행</option>
																<option value='보류'>보류</option>																
															</select>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								<!-- /업무등록 추가 테이블 -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height=5></td>
				</tr>
				<tr>
					<td align=right>
						<table cellpadding=0 cellspacing=0 border=0 width=100>
							<tr>
								<td align=center width=50%><a href='javascript:check_tb1();' class="btn_primary03">확인</a></td>
								<td align=center width=50%><a href='javascript:insert_row();' class="btn_primary03">추가</a></td>
							</tr>
						</table>
				</tr>
				<tr>
					<td height=20></td>
				</tr>
			</table>
		</td>
	</tr>
</table>