<script language='javascript'>

//검색하기
function set_search(){
	form = document.form1;
	form.type.value='';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

//초기화
function set_reset(){

	if(confirm("초기화 하시겠습니까?")) {
	form = document.form1;
	
	form.f_puse.selectedIndex = 0;
	form.f_name.selectedIndex = 0;
	
	/*form.f_name.value = '';*/
	
	form.record_start.value = '';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
	}
}

function is_Key(){
	if(event.keyCode==13)	set_search();
}

</script>

<!-- 검색 테이블 -->
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr>
		<th width="17%">담당자</th>
		<td>
			<select name='f_name'>
				<option value=''>::직원목록::</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_member[$i]?>' <?if($f_name==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
		</td>
		<th width="17%">구분</th>
		<td width="33%">
			<select name='f_puse'>
				<option value=''>::구분::</option>
				<option value='유지보수' <?if($f_puse=='유지보수'){echo 'selected';}?>>유지보수</option>
				<option value='도메인' <?if($f_puse=='도메인'){echo 'selected';}?>>도메인</option>
				<option value='제작' <?if($f_puse=='기타'){echo 'selected';}?>>도메인</option>
				<!-- <option value='금융기관'<? echo $f_puse =='금융기관' ? 'selected':''?>>금융기관</option>
				<option value='관공서'<? echo $f_puse =='관공서' ? 'selected':''?>>관공서</option>
				<option value='기타'<? echo $f_puse =='기타' ? 'selected':''?>>기타</option> -->
			</select>
		</td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50' align='center'><a href="javascript:set_search();" class="small cbtn black">검색</a>&nbsp;<a href="javascript:set_reset();"class="small cbtn black">초기화</a></td>
	</tr>
</table>