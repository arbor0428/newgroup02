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


<div class="search_container">
	<div class="search_wrap">
		<div class="search_row">
			<div class="search_th">��ȣ</div>
			<div class="search_td">	<input type='text' name='f_company' style='width:75%' value='<?=$f_company?>'>	</div>
		</div>

		<div class="search_row">
			<div class="search_th">��ü �����</div>
			<div class="search_td"><input type='text' name='f_person' style='width:75%' value='<?=$f_person?>'>	</div>
		</div>

		<div class="search_row">
			<div class="search_th">�̸���</div>
			<div class="search_td"><input type='text' name='f_email' style='width:75%' value='<?=$f_email?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">��õ��</div>
			<div class="search_td"><input type='text' name='f_fax' style='width:75%' value='<?=$f_fax?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">�Ϲ���ȭ</div>
			<div class="search_td"><input type='text' name='f_tel' style='width:75%' value='<?=$f_tel?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">�޴���ȭ</div>
			<div class="search_td"><input type='text' name='f_hp' style='width:75%' value='<?=$f_hp?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">����Ʈ��</div>
			<div class="search_td"><input type='text' name='f_site_name' style='width:75%' value='<?=$f_site_name?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">����������</div>
			<div class="search_td"><input type='text' name='f_domain' style='width:75%' value='<?=$f_domain?>'></div>
		</div>

	</div>
</div>

<div class="serach_btn-wrap">
	<a href="javascript:set_search();" class='btn_primary03'>�˻�</a>
	<a href="javascript:set_reset();" class='btn_primary03'>�ʱ�ȭ</a>
</div>
