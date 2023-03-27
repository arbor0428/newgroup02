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
			<div class="search_th">상호</div>
			<div class="search_td">	<input type='text' name='f_company' style='width:75%' value='<?=$f_company?>'>	</div>
		</div>

		<div class="search_row">
			<div class="search_th">업체 담당자</div>
			<div class="search_td"><input type='text' name='f_person' style='width:75%' value='<?=$f_person?>'>	</div>
		</div>

		<div class="search_row">
			<div class="search_th">이메일</div>
			<div class="search_td"><input type='text' name='f_email' style='width:75%' value='<?=$f_email?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">추천자</div>
			<div class="search_td"><input type='text' name='f_fax' style='width:75%' value='<?=$f_fax?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">일반전화</div>
			<div class="search_td"><input type='text' name='f_tel' style='width:75%' value='<?=$f_tel?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">휴대전화</div>
			<div class="search_td"><input type='text' name='f_hp' style='width:75%' value='<?=$f_hp?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">사이트명</div>
			<div class="search_td"><input type='text' name='f_site_name' style='width:75%' value='<?=$f_site_name?>'></div>
		</div>

		<div class="search_row">
			<div class="search_th">보유도메인</div>
			<div class="search_td"><input type='text' name='f_domain' style='width:75%' value='<?=$f_domain?>'></div>
		</div>

	</div>
</div>

<div class="serach_btn-wrap">
	<a href="javascript:set_search();" class='btn_primary03'>검색</a>
	<a href="javascript:set_reset();" class='btn_primary03'>초기화</a>
</div>
