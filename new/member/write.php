<?

	if($uid){

		$sql = "select * from wo_member where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$pwd = $row["pwd"];
		$name = $row["name"];
		$securi = $row["securi"];
		$securi2 = $row["securi2"];
		$team = $row["team"];
		$mobile = $row["mobile"];
		$telephone = $row["telephone"];
		$email = $row["email"];
		$bir01 = $row["bir01"];
		$bir02 = $row["bir02"];
		$bir03 = $row["bir03"];
		$account = $row["account"];
		$mtype = $row["mtype"];
		$mname = $row["mname"];
		$idate01 = $row["idate01"];
		$idate02 = $row["idate02"];
		$idate03 = $row["idate03"];
		$itime = $row["itime"];
		$sex = $row["sex"];
		$enable = $row["enable"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$affil = $row["affil"];
		$pdate01 = $row["pdate01"];
		$pdate02 = $row["pdate02"];
		$pdate03 = $row["pdate03"];

		$birthday = '';
		if($bir01)	$birthday = $bir01.'년 ';
		if($bir02)	$birthday .= $bir02.'월 ';
		if($bir03)	$birthday .= $bir03.'일 ';

		$pdateday = '';
		if($pdate01)	$pdateday = $pdate01.'년 ';
		if($pdate02)	$pdateday .= $pdate02.'월 ';
		if($pdate03)	$pdateday .= $pdate03.'일 ';

		$type = 'edit';

	}else{
		$type = 'write';

	}
?>

<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script language='javascript'>

//주소 함수
function openDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;

			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용 주소를 일렬로 나오게 할 경우 VALUE값을 다 더해본다
			document.getElementById('addr01').value = fullAddr;
			document.getElementById('addr02').focus();
		}
	}).open();
}

function check_form(){
	form = document.FRM;

	if('<?=$type?>' == 'write'){
		
		if(isFrmEmpty(form.userid,"아이디를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.pwd,"비밀번호를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.name,"성명을 입력해 주십시오")) return;
		if(isFrmEmpty(form.securi,"주민번호 앞자리를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.securi2,"주민번호 뒷자리를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.bir01,"생일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.bir02,"생일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.bir03,"생일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.idate01,"입사일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.idate02,"입사일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.idate03,"입사일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.mobile,"휴대전화를 입력해 주십시오")) return;
		if(isFrmEmpty(form.telephone,"일반전화를 입력해 주십시오")) return;
		if(isFrmEmpty(form.email,"이메일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.account,"계좌번호를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.zipcode,"주소를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.addr01,"주소를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.addr02,"주소를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.team,"팀을 선택해 주십시오")) return;
		if(isFrmEmpty(form.mtype,"타입을 선택해 주십시오")) return;
		if(isFrmEmpty(form.affil," 직위를 선택해 주십시오")) return;
/*
		if(isFrmEmpty(form.pdate01,"생일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.pdate02,"생일을 입력해 주십시오"))	return;
		if(isFrmEmpty(form.pdate03,"생일을 입력해 주십시오"))	return;
*/
	}

/*
	if('<?=$GBL_MTYPE?>' == 'A'){
	    
		var code_list = form.mtype;
		var intPos = code_list.selectedIndex;
		var strText = code_list[intPos].text;
	
		form.mname.value = strText;

	}
*/

	form.action = 'proc.php';
	form.submit();
}

function check_del(){
	if(confirm('아이디를 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del';
		form.action = 'proc.php';
		form.submit();

	}else{
		return;

	}
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

// 주민등록번호 마스킹 설정
//도큐먼트 레디
$(function(){
	
	//securi3 아이디 속성, label 연동할때 for 사용, change는 표시, 미표시 여부
	$('#securi3').change(function(){
	
		//chk라는 변수를 선언해서 체크박스에 체크된 상태를 chk로 정의했다
		let chk = $('input:checkbox[id="securi3"]').is(":checked");
		
		//chk가 맞으면 타입을 텍스트로 변경, chk가 아니면 타입을 패스워드로 변경.
		if (chk == true) {
                    $('#securi2').attr('type','text');
                }else{
                    $('#securi2').attr('type','password');
                }
	});
});

</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
	<input type='hidden' name='type' value='<?=$type?>'>
	<input type='hidden' name='uid' value='<?=$uid?>'>
	<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>

<!--등록-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">아이디</th>
					<td width="33%">
					<?
						if($type=='write'){
					?>
						<input type='text' name='userid' style='width:150px;' value='<?=$userid?>'>
					<?
						}else{
					?>
						<?=$userid?>
					<?
						}
					?>
					</td>
					<th width="17%">비밀번호</th>
					<td width="33%"><input type='text' name='pwd' style='width:150px' value='<?=$pwd?>'></td>
				</tr>

				<tr> 
					<th width="17%">성명</th>
					<td width="33%">
						<input type='text' name='name' style='width:150px' value='<?=$name?>'>&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' id='sex1' name='sex' value='남' <?if($sex=='남' || $sex==''){echo 'checked';}?>><label for='sex1'>남&nbsp;&nbsp;</label>
						<input type='radio' id='sex2' name='sex' value='여' <?if($sex=='여'){echo 'checked';}?>><label for='sex2'>여</label>
					</td>
					<th width="17%">주민등록번호</th>
					<td width="33%">
						<input type='text' name='securi' style='width:60px;' value='<?=$securi?>' maxlength='6'> - <input type='password' id='securi2' name='securi2' style='width:90px;' value='<?=$securi2?>' maxlength='7'><input type = 'checkbox' id='securi3'><label for='securi3'>뒷자리표시</label>
					</td>
				</tr>

				<tr> 
					<th width="17%">생일</th>
					<td width="33%">
						<select name='bir01'>
							<option value=''>===</option>
					<?
						$myear = date('Y') - 10;
						for($i=$myear; $i>=1950; $i--){
					?>
							<option value='<?=$i?>' <?if($bir01==$i){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>년 

						<select name='bir02'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=12; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($bir02==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>월 

						<select name='bir03'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=31; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($bir03==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>일 						

					</td>
					<th>입사일</th>
					<td>
						<select name='idate01'>
							<option value=''>===</option>
					<?
						$myear = date('Y');
						for($i=$myear; $i>=2010; $i--){
					?>
							<option value='<?=$i?>' <?if($idate01==$i){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>년 

						<select name='idate02'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=12; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($idate02==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>월 

						<select name='idate03'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=31; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($idate03==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>일
					</td>
				</tr>

				<tr> 
					<th>휴대전화</th>
					<td><input type='text' name='mobile' style='width:100%' value='<?=$mobile?>'></td>
					<th>일반전화</th>
					<td><input type='text' name='telephone' style='width:100%' value='<?=$telephone?>'></td>
				</tr>

				<tr> 
					<th>이메일</th>
					<td><input type='text' name='email' style='width:100%' value='<?=$email?>'></td>
					<th>계좌번호</th>
					<td><input type='text' name='account' style='width:100%' value='<?=$account?>'></td>
				</tr>

				<tr>
					<th>주소</th>
					<td colspan='3' style='margin-right:2px;'>
						<input type='text' name='zipcode'  id="zipcode" style='width:100px; margin-right:10px;' value='<?=$zipcode?>'><a href = "javascript:openDaumPostcode();" style='cursor:pointer' class='small cbtn black'>주소찾기</a><span style='padding-left:10px;'><input type='text' id="addr01" name='addr01' style='width:35%' value='<?=$addr01?>'><input type='text' id="addr02" name='addr02' placeholder='상세주소입력' style='width:46%; margin-left:10px;' value='<?=$addr02?>'></span>
					</td>
				</tr>

				<tr>
					<th>팀</th>
					<td>
						<select name='team' id='team'>
						<?
							for($i=0; $i<count($arr_team); $i++){
						?>
							<option value='<?=$arr_team[$i]?>' <?if($team==$arr_team[$i]) echo 'selected';?>><?=$arr_team[$i]?></option>
						<?
							}
						?>
						</select>
					<?
						if($GBL_MTYPE == 'A'){
					?>
						<select name='mtype'>
							<option value='' <?if($mtype=='') echo '';?>>선택</option>
							<option value='M' <?if($mtype=='M') echo 'selected';?>>사원</option>
						<?
							for($i=0; $i<count($arr_team); $i++){
								$txt01 = $arr_team[$i].'장';
						?>
							<option value='S' <?if($mname==$txt01) echo 'selected';?>><?=$txt01?></option>
						<?
							}
						?>
							<option value='A' <?if($mtype=='A') echo 'selected';?>>관리자</option>
						</select>
					<?
						}
					?>
					</td>
					
					<th>직위</th>
					<td colspan='3'>
						<select name='affil' id="affil"> <!-- select값 고정시키기 -->
							<option value=''>==</option>
							<option value='사원'<? echo $affil =='사원' ? 'selected':''?>>사원</option>
							<option value='주임'<? echo $affil =='주임' ? 'selected':''?>>주임</option>
							<option value='대리'<? echo $affil =='대리' ? 'selected':''?>>대리</option>
							<option value='과장'<? echo $affil =='과장' ? 'selected':''?>>과장</option>
							<option value='차장'<? echo $affil =='차장' ? 'selected':''?>>차장</option>
							<option value='팀장'<? echo $affil =='팀장' ? 'selected':''?>>팀장</option>
							<option value='이사'<? echo $affil =='이사' ? 'selected':''?>>이사</option>
							<option value='대표'<? echo $affil =='대표' ? 'selected':''?>>대표</option>
						</select>
					</td>
				</tr>
					<th>상태</th>
					<td>
						<input type='radio' id='enable1' name='enable' value='1' <?if($enable == '1'){echo 'checked';}?>><label for='enable1'>근무&nbsp;</label>
						<input type='radio' id='enable2' name='enable' value='' <?if($enable == ''){echo 'checked';}?>><label for='enable2'>퇴사</label>
					</td>
					<th>근무기간</th>
					<td>
						<select name='pdate01'>
							<option value=''>===</option>
					<?
						$myear = date('Y');
						for($i=$myear; $i>=2010; $i--){
					?>
							<option value='<?=$i?>' <?if($pdate01==$i){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>년

						<select name='pdate02'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=12; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($pdate02==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>월 

						<select name='pdate03'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=31; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($pdate03==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>일
					</td>

			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>


					<td align='right'>
<?
	if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../img/board/register.gif" border=0></a>&nbsp;
<?
	}else{
?>
	<?
		if($GBL_MTYPE == 'A'){
	?>
						<a href="javascript:check_del();"><img src="../img/board/delete1.gif" border=0></a>&nbsp;
	<?
		}
	?>
	
						<a href="javascript:check_form();"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
<?
	}
?>
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>
					</td>

				</tr>
			</table>
		</td>
	</tr>
</table>

</form>

