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

	form.f_company.value = '';
	form.f_name.value = '';
	form.f_homepage.value = '';
	form.f_telephone.value = '';

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
		<th width="17%">�з�</th>
		<td width="83%" colspan='3'>
			<select name='f_mtype'>
				<option value=''>===</option>
				<option value='����ó' <?if($f_mtype=='����ó'){echo 'selected';}?>>����ó</option>
				<option value='��������' <?if($f_mtype=='��������'){echo 'selected';}?>>��������</option>
				<option value='��������' <?if($f_mtype=='��������'){echo 'selected';}?>>��������</option>
				<option value='���޾�ü' <?if($f_mtype=='���޾�ü'){echo 'selected';}?>>���޾�ü</option>
				<option value='�����ð���' <?if($f_mtype=='�����ð���'){echo 'selected';}?>>�����ð���</option>
				<option value='��Ÿ' <?if($f_mtype=='��Ÿ'){echo 'selected';}?>>��Ÿ</option>
			</select>
		</td>
	</tr>
	<tr> 
		<th width="17%">��ü��</th>
		<td width="33%"><input type='text' name='f_company' style='width:75%' value='<?=$f_company?>' onkeypress='is_Key();'></td>
		<th width="17%">�����</th>
		<td width="33%"><input type='text' name='f_name' style='width:75%' value='<?=$f_name?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>Ȩ������</th>
		<td><input type='text' name='f_homepage' style='width:75%' value='<?=$f_homepage?>' onkeypress='is_Key();'></td>
		<th>��ȭ��ȣ</th>
		<td><input type='text' name='f_telephone' style='width:75%' value='<?=$f_telephone?>' onkeypress='is_Key();'></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50' colspan='4' align='center'><a href="javascript:set_search();"><img src='/images/common/search.gif'></a>&nbsp;<a href="javascript:set_reset();"><img src='/images/common/reset.gif'></a></td>
	</tr>
</table>