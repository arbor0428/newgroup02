<script language='javascript'>
function is_Key(){
	if(event.keyCode==13)	set_search();
}

function list_sort(field){
	form = document.form1;
	form.field.value = field;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function p_sort(mod){
	form = document.form1;

	if(mod == '�Ϸ�')	form.field.options[1].selected = true;
	else form.field.options[0].selected = true;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_search(){
	form = document.form1;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_reset(){
	form = document.form1;

	form.f_status.value = '';
	form.f_name.value = '';
	form.f_sname.value = '';
	form.f_company.value = '';
	form.f_person.value = '';
	form.f_email.value = '';
	form.f_fax.value = '';
	form.f_tel.value = '';
	form.f_hp.value = '';
	form.f_domain.value = '';
	form.f_ftpid.value = '';
	form.f_site_name.value = '';
	form.f_ment.value = '';
	form.f_sales.value = '';

	form.type.value = ''
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>



<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">���Ĺ��</th>
		<td width="33%">
			<select name='field' onchange='list_sort(this.value);'>
				<option value='reg_date' <?if($field=='reg_date') echo 'selected';?>>�����</option>
				<option value='company' <?if($field=='company') echo 'selected';?>>��ȣ��</option>
				<option value='domain_date' <?if($field=='domain_date') echo 'selected';?>>�����θ�����</option>
				<option value='host_date' <?if($field=='host_date') echo 'selected';?>>ȣ���ø�����</option>
			</select>
		</td>
		<th width="17%">����</th>
		<td width="33%">
			<select name='play_sort' onchange='p_sort(this.value);'>
				<option value='��ü'>=��ü=</option>
				<option value='������' <?if($play_sort=='������') echo 'selected';?>>������</option>
				<option value='����' <?if($play_sort=='����') echo 'selected';?>>����</option>
				<option value='��������' <?if($play_sort=='��������') echo 'selected';?>>��������</option>
				<option value='�Ϸ�' <?if($play_sort=='�Ϸ�') echo 'selected';?>>�Ϸ�</option>
			</select>
		</td>
	</tr>
	<tr> 
		<th>����</th>
		<td>
			<select name='f_status'>
				<option value=''>==</option>
				<option value='�˶���' <?if($f_status == '�˶���'){echo 'selected';}?>>�˶���</option>
				<option value='������' <?if($f_status == '������'){echo 'selected';}?>>������</option>
				<option value='������' <?if($f_status == '������'){echo 'selected';}?>>������</option>
				<option value='�����' <?if($f_status == '�����'){echo 'selected';}?>>�����</option>
				<option value='������' <?if($f_status == '������'){echo 'selected';}?>>������</option>
				<option value='�����' <?if($f_status == '�����'){echo 'selected';}?>>�����</option>
				<option value='�κ�����' <?if($f_status == '�κ�����'){echo 'selected';}?>>�κ�����</option>
				<option value='��Ÿ' <?if($f_status == '��Ÿ'){echo 'selected';}?>>��Ÿ</option>
			</select>&nbsp;&nbsp;&nbsp;
			<input type='checkbox' name='f_mobile' value='1' <?if($f_mobile == '1'){echo 'checked';}?>><font color='#de712e'><b>�����</b></font>
		</td>
		<th>�����</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='75%'>
				<tr>
					<td>
						<select name='f_name'>
							<option value=''>===</option>
						<?
							for($i=0; $i<count($arr_member); $i++){
						?>
							<option value='<?=$arr_member[$i]?>' <?if($f_name==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
						<?
							}
						?>
						</select>
					</td>
					<td align='right'>�����Է� : <input type='text' name='f_sname' style='width:90px;' value='<?=$f_sname?>' onkeypress='is_Key();'></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<th>��ȣ</th>
		<td><input type='text' name='f_company' style='width:75%' value='<?=$f_company?>' onkeypress='is_Key();'></td>
		<th>��ü �����</th>
		<td><input type='text' name='f_person' style='width:75%' value='<?=$f_person?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>�̸���</th>
		<td><input type='text' name='f_email' style='width:75%' value='<?=$f_email?>' onkeypress='is_Key();'></td>
		<th>��õ��</th>
		<td><input type='text' name='f_fax' style='width:75%' value='<?=$f_fax?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>�Ϲ���ȭ</th>
		<td><input type='text' name='f_tel' style='width:75%' value='<?=$f_tel?>' onkeypress='is_Key();'></td>
		<th>�޴���ȭ</th>
		<td><input type='text' name='f_hp' style='width:75%' value='<?=$f_hp?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>�������ּ�</th>
		<td><input type='text' name='f_domain' style='width:75%' value='<?=$f_domain?>' onkeypress='is_Key();'></td>
		<th>FTP �ּ�/ID</th>
		<td><input type='text' name='f_ftpid' style='width:75%' value='<?=$f_ftpid?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>����Ʈ��</th>
		<td><input type='text' name='f_site_name' style='width:75%' value='<?=$f_site_name?>' onkeypress='is_Key();'></td>
		<th>Ư�̻���</th>
		<td><input type='text' name='f_ment' style='width:75%' value='<?=$f_ment?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>�������</th>
		<td><input type='text' name='f_sales' style='width:75%' value='<?=$f_sales?>' onkeypress='is_Key();'></td>
		<th>ȣ����</th>
		<td><input type='text' name='f_ftphost' style='width:75%' value='<?=$f_ftphost?>' onkeypress='is_Key();'></td></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50' colspan='4' align='center'><a href="javascript:set_search();"><img src='/images/common/search.gif'></a>&nbsp;<a href="javascript:set_reset();"><img src='/images/common/reset.gif'></a></td>
	</tr>
</table>