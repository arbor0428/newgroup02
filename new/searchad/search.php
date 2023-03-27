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

	form.f_name.value = '';
	form.f_manager.value = '';
	form.f_site.selectedIndex = 0;
	form.f_staff.selectedIndex = 0;
	form.f_sname.value = '';
	form.f_ment.value = '';
	form.f_sDate.value = '';
	form.f_eDate.value = '';

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
		<div class="search_row">
			<div class="search_th">고객명(회사명)</div>
			<div class="search_td"><input type='text' name='f_name' style='width:75%' value='<?=$f_name?>' onkeypress='is_Key();'></div>
		</div>
		<div class="search_row">
			<div class="search_th">담당자</div>
			<div class="search_td"><input type='text' name='f_manager' style='width:75%' value='<?=$f_manager?>' onkeypress='is_Key();'></div>
		</div>

		<div class="search_row">
			<div class="search_th">이용광고</div>
			<div class="search_td">
				<input type='radio' name='f_site' value='' <?if($f_site == ''){echo 'checked';}?>>전체&nbsp;&nbsp;
				<input type='radio' name='f_site' value='naver' <?if($f_site == 'naver'){echo 'checked';}?>>네이버
				<input type='radio' name='f_site' value='daum' <?if($f_site == 'daum'){echo 'checked';}?>>다음
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">이용아이디</div>
			<div class="search_td">
				<input type='text' name='f_naverID' style='width:40%' value='<?=$f_naverID?>' onkeypress='is_Key();' placeholder='네이버 아이디'>
				<input type='text' name='f_daumID' style='width:40%' value='<?=$f_daumID?>' onkeypress='is_Key();' placeholder='다음 아이디'>
			</div>
		</div>


		<div class="search_row" style="width: 100%;">
			<div class="search_th wid15">아이웹 담당자</div>
			<div class="search_td">
				<div class="dp_f dp_c">
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

					<div>직접입력 : <input type='text' name='f_sname' style='width:90px;' value='<?=$f_sname?>' onkeypress='is_Key();'></div>
				</div>
			</div>
		</div>
		<div class="search_row">
			<div class="search_th">부가정보</div>
			<div class="search_td"><input type='text' name='f_ment' style='width:100%;' value='<?=$f_ment?>' onkeypress='is_Key();'></div>
		</div>

		<div class="search_row">
			<div class="search_th">등록일</div>
			<div class="search_td">
				<input type='text' name='f_sDate' id='fpicker1' style='width:100px;' value='<?=$f_sDate?>'> ~ 
				<input type='text' name='f_eDate' id='fpicker2' style='width:100px;' value='<?=$f_eDate?>'>
			</div>
		</div>


	</div>
</div>

<div class="serach_btn-wrap dp_f dp_c dp_cc">
	<a href="javascript:set_search();" class="btn_primary03">검색</a>
	<a href="javascript:set_reset();" class="btn_primary03">초기화</a>
</div>
