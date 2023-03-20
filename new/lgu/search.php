<script language='javascript'>
function set_search(){
	form = document.form1;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_reset(){
	form = document.form1;

	form.f_mtype.selectedIndex = 0;
	form.f_status.selectedIndex = 0;

	form.f_name.value = '';
	form.f_ceo.value = '';

	form.f_staff.selectedIndex = 0;
	form.f_sname.value = '';
	form.f_ment.value = '';
	form.f_pnum.value = '';

	form.f_sy.value = '';
	form.f_sm.value = '';
	form.f_sd.value = '';
	form.f_ey.value = '';
	form.f_em.value = '';
	form.f_ed.value = '';

	form.type.value = ''
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function is_Key(){
	if(event.keyCode==13)	set_search();
}
</script>



<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">구분</th>
		<td width="33%">
			<select name='f_mtype'>
				<option value=''>===</option>
				<option value='법인' <?if($f_mtype=='법인'){echo 'selected';}?>>법인</option>
				<option value='개인사업자' <?if($f_mtype=='개인사업자'){echo 'selected';}?>>개인사업자</option>
				<option value='개인' <?if($f_mtype=='개인'){echo 'selected';}?>>개인</option>
			</select>
		</td>
		<th width="17%">상태</th>
		<td width="33%">
			<select name='f_status'>
				<option value=''>===</option>
			<?
				for($i=0; $i<count($statusArr); $i++){
					$sTxt = $statusArr[$i];
					if($sTxt == $f_status)	$chk = 'checked';
					else							$chk = '';

					echo ("<option value='$sTxt' $chk>$sTxt</option>");
				}
			?>
			</select>
		</td>
	</tr>

	<tr> 
		<th>고객명(회사명)</th>
		<td><input type='text' name='f_name' style='width:75%' value='<?=$f_name?>' onkeypress='is_Key();'></td>
		<th>대표자명</th>
		<td><input type='text' name='f_ceo' style='width:75%' value='<?=$f_ceo?>' onkeypress='is_Key();'></td>
	</tr>

	<tr> 
		<th>담당자</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='75%'>
				<tr>
					<td>
						<select name='f_staff'>
							<option value=''>===</option>
						<?
							for($i=0; $i<count($arr_member); $i++){
						?>
							<option value='<?=$arr_member[$i]?>' <?if($f_staff==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
						<?
							}
						?>
						</select>
					</td>
					<td align='right'>직접입력 : <input type='text' name='f_sname' style='width:90px;' value='<?=$f_sname?>' onkeypress='is_Key();'></td>
				</tr>
			</table>
		</td>
		<th>이용상품</th>
		<td>
			<input type='checkbox' name='f_service01' value='1' <?if($f_service01){echo 'checked';}?>>대표번호&nbsp;&nbsp;
			<input type='checkbox' name='f_service02' value='1' <?if($f_service02){echo 'checked';}?>>기업070&nbsp;&nbsp;
			<input type='checkbox' name='f_service03' value='1' <?if($f_service03){echo 'checked';}?>>오피스넷&nbsp;&nbsp;
			<input type='checkbox' name='f_service04' value='1' <?if($f_service04){echo 'checked';}?>>지능형CCTV&nbsp;&nbsp;
			<input type='checkbox' name='f_service05' value='1' <?if($f_service05){echo 'checked';}?>>웹팩스&nbsp;&nbsp;
			<input type='checkbox' name='f_service06' value='1' <?if($f_service06){echo 'checked';}?>>소호인터넷
		</td>
	</tr>

	<tr>
		<th>부가정보</th>
		<td><input type='text' name='f_ment' style='width:235px;' value='<?=$f_ment?>' onkeypress='is_Key();'></td>
		<th>대표번호</th>
		<td><input type='text' name='f_pnum' style='width:235px;' value='<?=$f_pnum?>' onkeypress='is_Key();'></td>
	</tr>

	<tr> 
		<th>개통일</td>
		<td colspan='3'>
		<?
			//날짜별 검색 스크립트
			$SearchDateForm = 'form1';
			include '../module/SearchDate.php';
		?>
		</td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50' align='center'><a href="javascript:set_search();"><img src='/images/common/search.gif'></a>&nbsp;<a href="javascript:set_reset();"><img src='/images/common/reset.gif'></a></td>
	</tr>
</table>