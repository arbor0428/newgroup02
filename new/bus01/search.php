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
			<div class="search_td dp_f dp_c">
				<select name='f_mtype'>
					<option value=''>===</option>

						<?
							//등록된 거래처분류를 가져온다.
							$sq = "select mtype from wo_bus01_config order by uid desc limit 1";
							$re = mysql_query($sq);
							$nu = mysql_num_rows($re);

							if($nu){
								$mtypelist = mysql_result($re,0,0);
								$mlist = explode(',',$mtypelist);

								for($i=0; $i<count($mlist); $i++){
									$mtxt = $mlist[$i];

									if($mtxt == $f_mtype)	$chk = 'selected';
									else	$chk = '';

									echo ("<option value='$mtxt' $chk>$mtxt</option>");
								}
							}
						?>

				</select>
				<a href="javascript:openCenterWin('config.php','cc','400','250','','');" class="btn_primary03">환경설정</a>
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
</div>

<div class="serach_btn-wrap dp_f dp_c dp_cc">
	<a href="javascript:set_search();" class="btn_primary03">검색</a>
		<a href="javascript:set_reset();" class="btn_primary03">초기화</a>
</div>
