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
		<th width="17%">����</th>
		<td width="33%">
			<select name='f_mtype'>
				<option value=''>===</option>
				<option value='����' <?if($f_mtype=='����'){echo 'selected';}?>>����</option>
				<option value='���λ����' <?if($f_mtype=='���λ����'){echo 'selected';}?>>���λ����</option>
				<option value='����' <?if($f_mtype=='����'){echo 'selected';}?>>����</option>
			</select>
		</td>
		<th width="17%">����</th>
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
		<th>����(ȸ���)</th>
		<td><input type='text' name='f_name' style='width:75%' value='<?=$f_name?>' onkeypress='is_Key();'></td>
		<th>��ǥ�ڸ�</th>
		<td><input type='text' name='f_ceo' style='width:75%' value='<?=$f_ceo?>' onkeypress='is_Key();'></td>
	</tr>

	<tr> 
		<th>�����</th>
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
					<td align='right'>�����Է� : <input type='text' name='f_sname' style='width:90px;' value='<?=$f_sname?>' onkeypress='is_Key();'></td>
				</tr>
			</table>
		</td>
		<th>�̿��ǰ</th>
		<td>
			<input type='checkbox' name='f_service01' value='1' <?if($f_service01){echo 'checked';}?>>��ǥ��ȣ&nbsp;&nbsp;
			<input type='checkbox' name='f_service02' value='1' <?if($f_service02){echo 'checked';}?>>���070&nbsp;&nbsp;
			<input type='checkbox' name='f_service03' value='1' <?if($f_service03){echo 'checked';}?>>���ǽ���&nbsp;&nbsp;
			<input type='checkbox' name='f_service04' value='1' <?if($f_service04){echo 'checked';}?>>������CCTV&nbsp;&nbsp;
			<input type='checkbox' name='f_service05' value='1' <?if($f_service05){echo 'checked';}?>>���ѽ�&nbsp;&nbsp;
			<input type='checkbox' name='f_service06' value='1' <?if($f_service06){echo 'checked';}?>>��ȣ���ͳ�
		</td>
	</tr>

	<tr>
		<th>�ΰ�����</th>
		<td><input type='text' name='f_ment' style='width:235px;' value='<?=$f_ment?>' onkeypress='is_Key();'></td>
		<th>��ǥ��ȣ</th>
		<td><input type='text' name='f_pnum' style='width:235px;' value='<?=$f_pnum?>' onkeypress='is_Key();'></td>
	</tr>

	<tr> 
		<th>������</td>
		<td colspan='3'>
		<?
			//��¥�� �˻� ��ũ��Ʈ
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