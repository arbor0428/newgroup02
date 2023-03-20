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

	form.f_company.value = '';
	form.f_person.value = '';
	form.f_email.value = '';
	form.f_fax.value = '';
	form.f_tel.value = '';
	form.f_hp.value = '';
	form.f_site_name.value = '';
	form.f_domain.value = '';

	form.type.value = ''
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>



<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">상호</th>
		<td width="33%"><input type='text' name='f_company' style='width:75%' value='<?=$f_company?>'></td>
		<th width="17%">업체 담당자</th>
		<td width="33%"><input type='text' name='f_person' style='width:75%' value='<?=$f_person?>'></td>
	</tr>
	<tr> 
		<th>이메일</th>
		<td><input type='text' name='f_email' style='width:75%' value='<?=$f_email?>'></td>
		<th>추천자</th>
		<td><input type='text' name='f_fax' style='width:75%' value='<?=$f_fax?>'></td>
	</tr>
	<tr> 
		<th>일반전화</th>
		<td><input type='text' name='f_tel' style='width:75%' value='<?=$f_tel?>'></td>
		<th>휴대전화</th>
		<td><input type='text' name='f_hp' style='width:75%' value='<?=$f_hp?>'></td>
	</tr>
	<tr> 
		<th>사이트명</th>
		<td><input type='text' name='f_site_name' style='width:75%' value='<?=$f_site_name?>'></td>
		<th>보유도메인</th>
		<td><input type='text' name='f_domain' style='width:75%' value='<?=$f_domain?>'></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50' colspan='4' align='center'><a href="javascript:set_search();"><img src='/images/common/search.gif'></a>&nbsp;<a href="javascript:set_reset();"><img src='/images/common/reset.gif'></a></td>
	</tr>
</table>