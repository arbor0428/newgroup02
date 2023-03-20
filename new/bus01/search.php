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
		<th width="17%">분류</th>
		<td width="83%" colspan='3'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
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
					</td>
					<td style='padding-left:10px;'><a href="javascript:openCenterWin('config.php','cc','400','250','','');"><img src='/images/common/set_btn.jpg'></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<th width="17%">업체명</th>
		<td width="33%"><input type='text' name='f_company' style='width:75%' value='<?=$f_company?>' onkeypress='is_Key();'></td>
		<th width="17%">담당자</th>
		<td width="33%"><input type='text' name='f_name' style='width:75%' value='<?=$f_name?>' onkeypress='is_Key();'></td>
	</tr>
	<tr> 
		<th>홈페이지</td>
		<td><input type='text' name='f_homepage' style='width:75%' value='<?=$f_homepage?>' onkeypress='is_Key();'></td>
		<th>전화번호</td>
		<td><input type='text' name='f_telephone' style='width:75%' value='<?=$f_telephone?>' onkeypress='is_Key();'></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50' colspan='4' align='center'><a href="javascript:set_search();"><img src='/images/common/search.gif'></a>&nbsp;<a href="javascript:set_reset();"><img src='/images/common/reset.gif'></a></td>
	</tr>
</table>