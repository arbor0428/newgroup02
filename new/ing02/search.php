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

	if(mod == '완료')	form.field.options[1].selected = true;
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

<div class="search_container">
	<div class="search_wrap">
		<div class="search_row">
			<div class="search_th">정렬방식</div>
			<div class="search_td">
				<select name='field' onchange='list_sort(this.value);'>
					<option value='reg_date' <?if($field=='reg_date') echo 'selected';?>>계약일</option>
					<option value='company' <?if($field=='company') echo 'selected';?>>상호명</option>
					<option value='domain_date' <?if($field=='domain_date') echo 'selected';?>>도메인만료일</option>
					<option value='host_date' <?if($field=='host_date') echo 'selected';?>>호스팅만료일</option>
				</select>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">상태</div>
			<div class="search_td">
				<select name='play_sort' onchange='p_sort(this.value);'>
					<option value='전체'>=전체=</option>
					<option value='진행중' <?if($play_sort=='진행중') echo 'selected';?>>진행중</option>
					<option value='보류' <?if($play_sort=='보류') echo 'selected';?>>보류</option>
					<option value='유지보수' <?if($play_sort=='유지보수') echo 'selected';?>>유지보수</option>
					<option value='완료' <?if($play_sort=='완료') echo 'selected';?>>완료</option>
				</select>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">구분</div>
			<div class="search_td">
				<select name='f_status'>
					<option value=''>==</option>
					<option value='알뜰형' <?if($f_status == '알뜰형'){echo 'selected';}?>>알뜰형</option>
					<option value='보급형' <?if($f_status == '보급형'){echo 'selected';}?>>보급형</option>
					<option value='맞춤형' <?if($f_status == '맞춤형'){echo 'selected';}?>>맞춤형</option>
					<option value='고급형' <?if($f_status == '고급형'){echo 'selected';}?>>고급형</option>
					<option value='독립형' <?if($f_status == '독립형'){echo 'selected';}?>>독립형</option>
					<option value='모바일' <?if($f_status == '모바일'){echo 'selected';}?>>모바일</option>
					<option value='부분제작' <?if($f_status == '부분제작'){echo 'selected';}?>>부분제작</option>
					<option value='기타' <?if($f_status == '기타'){echo 'selected';}?>>기타</option>
				</select>&nbsp;&nbsp;&nbsp;
				<input type='checkbox' name='f_mobile' value='1' <?if($f_mobile == '1'){echo 'checked';}?>>
				<font color='#de712e'><b>모바일</b></font>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th" style="height: 100%;">담당자</div>
			<div class="search_td flex_row">
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
						<div>직접입력 : <input type='text' name='f_sname' style='width:90px;' value='<?=$f_sname?>' onkeypress='is_Key();'></div>
					</tr>
				</table>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">상호</div>
			<div class="search_td">
				<input type='text' name='f_company' style='width:75%' value='<?=$f_company?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">업체 담당자</div>
			<div class="search_td">
				<input type='text' name='f_person' style='width:75%' value='<?=$f_person?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">이메일</div>
			<div class="search_td">
				<input type='text' name='f_email' style='width:75%' value='<?=$f_email?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">추천자</div>
			<div class="search_td">
				<input type='text' name='f_fax' style='width:75%' value='<?=$f_fax?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">일반전화</div>
			<div class="search_td">
				<input type='text' name='f_tel' style='width:75%' value='<?=$f_tel?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">휴대전화</div>
			<div class="search_td">
				<input type='text' name='f_hp' style='width:75%' value='<?=$f_hp?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">도메인주소</div>
			<div class="search_td">
				<input type='text' name='f_domain' style='width:75%' value='<?=$f_domain?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">FTP 주소/ID</div>
			<div class="search_td">
				<input type='text' name='f_ftpid' style='width:75%' value='<?=$f_ftpid?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">사이트명</div>
			<div class="search_td">
				<input type='text' name='f_site_name' style='width:75%' value='<?=$f_site_name?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">특이사항</div>
			<div class="search_td">
				<input type='text' name='f_ment' style='width:75%' value='<?=$f_ment?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row ">
			<div class="search_th">영업담당</div>
			<div class="search_td">
				<input type='text' name='f_sales' style='width:75%' value='<?=$f_sales?>' onkeypress='is_Key();'>
			</div>
		</div>

		<div class="search_row ">
			<div class="search_th">호스팅</div>
			<div class="search_td">
				<input type='text' name='f_ftphost' style='width:75%' value='<?=$f_ftphost?>' onkeypress='is_Key();'>
			</div>
		</div>
	</div>
</div>

 <div class="serach_btn-wrap">
	 <a href="javascript:set_search();" class="btn_primary03">검색</a>
	 <a href="javascript:set_reset();" class="btn_primary03">초기화</a>
 </div>

