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
<div class="search_container">
	<div class="search_wrap">

		<div class="search_row" style="width: 100%;">
			<div class="search_th wid15">분류</div>
				<div class="search_td ">	
					<select name='f_mtype'>
						<option value=''>===</option>
						<option value='구매처' <?if($f_mtype=='구매처'){echo 'selected';}?>>구매처</option>
						<option value='행정관련' <?if($f_mtype=='행정관련'){echo 'selected';}?>>행정관련</option>
						<option value='세무관련' <?if($f_mtype=='세무관련'){echo 'selected';}?>>세무관련</option>
						<option value='제휴업체' <?if($f_mtype=='제휴업체'){echo 'selected';}?>>제휴업체</option>
						<option value='마케팅관련' <?if($f_mtype=='마케팅관련'){echo 'selected';}?>>마케팅관련</option>
						<option value='기타' <?if($f_mtype=='기타'){echo 'selected';}?>>기타</option>
					</select>
			</div>
		</div>

		
			
		<div class="search_row">
			<div class="search_th">업체명</div>
			<div class="search_td">	
				<input type='text' name='f_company' style='width:75%' value='<?=$f_company?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">담당자</div>
			<div class="search_td">	
				<input type='text' name='f_name' style='width:75%' value='<?=$f_name?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">홈페이지</div>
			<div class="search_td">	
				<input type='text' name='f_homepage' style='width:75%' value='<?=$f_homepage?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">전화번호</div>
			<div class="search_td">	
				<input type='text' name='f_telephone' style='width:75%' value='<?=$f_telephone?>' onkeypress='is_Key();'>
			</div>
		</div>





	</div>
<div>
<div class="serach_btn-wrap">
	 <a href="javascript:set_search();" class="btn_primary03">검색</a>
	 <a href="javascript:set_reset();" class="btn_primary03">초기화</a>
 </div>

<!-- <table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">분류</th>
		<td width="83%" colspan='3'>
			<select name='f_mtype'>
				<option value=''>===</option>
				<option value='구매처' <?if($f_mtype=='구매처'){echo 'selected';}?>>구매처</option>
				<option value='행정관련' <?if($f_mtype=='행정관련'){echo 'selected';}?>>행정관련</option>
				<option value='세무관련' <?if($f_mtype=='세무관련'){echo 'selected';}?>>세무관련</option>
				<option value='제휴업체' <?if($f_mtype=='제휴업체'){echo 'selected';}?>>제휴업체</option>
				<option value='마케팅관련' <?if($f_mtype=='마케팅관련'){echo 'selected';}?>>마케팅관련</option>
				<option value='기타' <?if($f_mtype=='기타'){echo 'selected';}?>>기타</option>
			</select>
		</td>
	</tr>
	<tr> 
		<th width="17%">업체명</th>
		<td width="33%"><input type='text' name='f_company' style='width:75%' value='<?=$f_company?>' onkeypress='is_Key();'></td>
		<th width="17%">담당자</th>
		<td width="33%"><input type='text' name='f_name' style='width:75%' value='<?=$f_name?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>홈페이지</th>
		<td><input type='text' name='f_homepage' style='width:75%' value='<?=$f_homepage?>' onkeypress='is_Key();'></td>
		<th>전화번호</th>
		<td><input type='text' name='f_telephone' style='width:75%' value='<?=$f_telephone?>' onkeypress='is_Key();'></td>
	</tr>
</table> -->

<!-- <table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50' colspan='4' align='center'>
		<a href="javascript:set_search();"><img src='/images/common/search.gif'></a>&nbsp;<a href="javascript:set_reset();"><img src='/images/common/reset.gif'></a></td>
	</tr>
</table> -->