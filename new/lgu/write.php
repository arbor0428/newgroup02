<?

	if($uid){

		$sql = "select * from wo_lgu where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row['userid'];
		$mtype = $row['mtype'];
		$status = $row['status'];
		$name = $row['name'];
		$cnum = $row['cnum'];
		$ceo = $row['ceo'];
		$zip01 = $row['zip01'];
		$zip02 = $row['zip02'];
		$addr01 = $row['addr01'];
		$addr02 = $row['addr02'];
		$phone01 = $row['phone01'];
		$phone02 = $row['phone02'];
		$phone03 = $row['phone03'];
		$mobile01 = $row['mobile01'];
		$mobile02 = $row['mobile02'];
		$mobile03 = $row['mobile03'];
		$email = $row['email'];
		$pname = $row['pname'];
		$pday = $row['pday'];
		$ptype = $row['ptype'];
		$pmode = $row['pmode'];
		$pemail = $row['pemail'];
		$pzip01 = $row['pzip01'];
		$pzip02 = $row['pzip02'];
		$paddr01 = $row['paddr01'];
		$paddr02 = $row['paddr02'];
		$pbank = $row['pbank'];
		$paccount = $row['paccount'];
		$pend = $row['pend'];
		$ment = $row['ment'];	
		$rDate = $row['rDate'];
		$staff = $row['staff'];
		$service01 = $row['service01'];
		$service02 = $row['service02'];
		$service03 = $row['service03'];
		$service04 = $row['service04'];
		$service05 = $row['service05'];
		$service06 = $row['service06'];
		$pnum = $row['pnum'];

	}else{
		$rDate = date('Y-m-d');
	}


	if(!$userid)	$userid = $GBL_USERID;

	$rTxt = explode('-',$rDate);
	$ry = $rTxt[0];
	$rm = $rTxt[1];
	$rd = $rTxt[2];



	//전국대표번호
	$sample1 = "<br><br><b>* 전국대표번호</b><br>전국대표번호 : <br>착신회선수 : <br>착신전화번호 : <br>신청일 : <br>약정일 : 1년/2년/3년<br>요금유형 : 기본형/분리과금형/정액형<br><br><br>";

	//기업070
	$sample2 = "<br><br><b>* 기업070 번호</b><br>기업070 번호 : <br>번호유형 : 신규/번호이동/추가<br>신청일 : <br>약정일 : 1년/2년/3년<br>센트릭스 : 고급형/IMS/일반형<br>모델명 : <br>단말할부 : 일시불/할부(할부개월수:  )<br>요금유형 : <br>설치주소 : <br><br><br>";

	//오피스넷
	$sample3 = "<br><br><b>* 오피스넷</b><br>오피스넷(회선정보) : <br>설치주소 : <br>단말장비 : <br>렉장비 : <br>신청일 : <br>약정일 : <br><br><br>";

?>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function openDaumPostcode(m) {
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
//			document.getElementById('sample6_postcode').value = data.zonecode; //5자리 새우편번호 사용

			if(m == 1){
				document.getElementById('zip01').value = data.postcode1;
				document.getElementById('zip02').value = data.postcode2;
				document.getElementById('addr01').value = fullAddr;
				document.getElementById('addr02').focus();
			}else if(m == 2){
				document.getElementById('pzip01').value = data.postcode1;
				document.getElementById('pzip02').value = data.postcode2;
				document.getElementById('paddr01').value = fullAddr;
				document.getElementById('paddr02').focus();
			}
		}
	}).open();
}


function check_form(){
	form = document.FRM;
	
	if(isFrmEmpty(form.name,"고객명 입력해 주십시오"))	return;	

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = 'proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(){
	
	if(confirm('해당 데이터를 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}

}

function chk_box(txt,no){
	obj = document.getElementsByName(txt);

	if(obj[no].checked == true){
		for(i=0; i<obj.length; i++){
			if(i != no)	obj[i].checked = false;
		}
	}
}

function addMent(m){
	if(m == 1){
		oEditors.getById["ment"].exec("PASTE_HTML", ["<?=$sample1?>"]);

	}else if(m == 2){
		oEditors.getById["ment"].exec("PASTE_HTML", ["<?=$sample2?>"]);

	}else if(m == 3){
		oEditors.getById["ment"].exec("PASTE_HTML", ["<?=$sample3?>"]);

	}
}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_mtype' value='<?=$f_mtype?>'>
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_ceo' value='<?=$f_ceo?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_service01' value='<?=$f_service01?>'>
<input type='hidden' name='f_service02' value='<?=$f_service02?>'>
<input type='hidden' name='f_service03' value='<?=$f_service03?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sy' value='<?=$f_sy?>'>
<input type='hidden' name='f_sm' value='<?=$f_sm?>'>
<input type='hidden' name='f_sd' value='<?=$f_sd?>'>
<input type='hidden' name='f_ey' value='<?=$f_ey?>'>
<input type='hidden' name='f_em' value='<?=$f_em?>'>
<input type='hidden' name='f_ed' value='<?=$f_ed?>'>
<!-- /검색관련 -->


<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><b>1. 명의자</b></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th>구분</th>
					<td colspan='3'>
						<input type='checkbox' name='mtype' value='법인' <?if($mtype == '법인'){echo 'checked';}?> onclick='chk_box(this.name,0);'>법인&nbsp;&nbsp;
						<input type='checkbox' name='mtype' value='개인사업자' <?if($mtype == '개인사업자'){echo 'checked';}?> onclick='chk_box(this.name,1);'>개인사업자&nbsp;&nbsp;
						<input type='checkbox' name='mtype' value='개인' <?if($mtype == '개인'){echo 'checked';}?> onclick='chk_box(this.name,2);'>개인
					</td>
				</tr>

				<tr>
					<th>상태</th>
					<td colspan='3'>
					<?
						for($i=0; $i<count($statusArr); $i++){
							$sTxt = $statusArr[$i];
							if($sTxt == $status)	$chk = 'checked';
							else						$chk = '';

							echo ("<input type='checkbox' name='status' value='$sTxt' $chk onclick='chk_box(this.name,$i);'>$sTxt&nbsp;&nbsp;");
						}
					?>
					</td>
				</tr>

				<tr> 
					<th width="17%">고객명(회사명)</th>
					<td width="33%"><input type='text' name='name' style='width:180px;' value='<?=$name?>'></td>
					<th width="17%">생년월일(사업자번호)</th>
					<td width="33%"><input type='text' name='cnum' style='width:180px;' value='<?=$cnum?>'></td>
				</tr>

				<tr> 
					<th>대표자명</th>
					<td><input type='text' name='ceo' style='width:180px;' value='<?=$ceo?>'></td>
					<th>대표번호</th>
					<td><input type='text' name='pnum' style='width:180px;' value='<?=$pnum?>'></td>
				</tr>

				<tr>
					<th>주소</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input name="zip01" id="zip01" type="text" style='width:50px;' value='<?=$zip01?>' maxlength='3'> - <input name="zip02" id="zip02" type="text" style='width:50px;' value='<?=$zip02?>' maxlength='3'>
								<a href="javascript:openDaumPostcode(1);"><img src='/images/member/order_add.gif' border='0' style='margin:5 0 -5 0' alt='우편번호' /></a></td>
							</tr>
							<tr>
								<td style='padding:3px 0px 0px 0px;'><input name='addr01' id='addr01' type='text' style='width:312px;' value='<?=$addr01?>'></td>
							</tr>
							<tr>
								<td style='padding:3px 0px 0px 0px;'><input name='addr02' id='addr02' type='text' style='width:312px;' value='<?=$addr02?>'></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<th>일반전화</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='phone01' style='width:40px;' value='<?=$phone01?>' maxlength='4'> - <input type='text' name='phone02' style='width:40px;' value='<?=$phone02?>' maxlength='4'>- <input type='text' name='phone03' style='width:40px;' value='<?=$phone03?>' maxlength='4'></td>
								<td style='padding-left:10px;'><a href="javascript:document.ifra_sms.getNum(FRM.phone01.value,FRM.phone02.value,FRM.phone03.value);"><img src='../img/ico_phone.gif'></a></td>
							</tr>
						</table>
					</td>
					<th>휴대전화</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='mobile01' style='width:40px;' value='<?=$mobile01?>'> - <input type='text' name='mobile02' style='width:40px;' value='<?=$mobile02?>'>- <input type='text' name='mobile03' style='width:40px;' value='<?=$mobile03?>'></td>
								<td style='padding-left:10px;'><a href="javascript:document.ifra_sms.getNum(FRM.mobile01.value,FRM.mobile02.value,FRM.mobile03.value);"><img src='../img/ico_phone.gif'></a></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<th>e-mail</th>
					<td colspan='3'><input type='text' name='email' style='width:180px;' value='<?=$email?>'></td>
				</tr>

				<tr> 
					<th>개통일자</th>
					<td colspan='3'>
						<select name='ry'>
						<?
							for($i=2015; $i<=date('Y')+10; $i++){
						?>
							<option value='<?=$i?>' <?if($ry==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>년 

						<select name='rm'>
						<?
							for($i=1; $i<=12; $i++){
								$no = sprintf('%02d',$i);
						?>
							<option value='<?=$no?>' <?if($rm==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>월 
						
						<select name='rd'>
						<?
							for($i=1; $i<=31; $i++){
								$no = sprintf('%02d',$i);
						?>
							<option value='<?=$no?>' <?if($rd==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>일 
					</td>
				</tr>
			</table>
		</td>
	</tr>


	<tr>
		<td style='padding:50px 0px 0px 0px;'><b>2. 납부방법</b></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">예금주</th>
					<td width="33%"><input type='text' name='pname' style='width:180px;' value='<?=$pname?>'></td>
					<th width="17%">납부일</th>
					<td width="33%">
						<input type='checkbox' name='pday' value='22일' <?if($pday == '22일'){echo 'checked';}?> onclick='chk_box(this.name,0);'>22일&nbsp;&nbsp;
						<input type='checkbox' name='pday' value='26일' <?if($pday == '26일'){echo 'checked';}?> onclick='chk_box(this.name,1);'>26일&nbsp;&nbsp;
						<input type='checkbox' name='pday' value='말일' <?if($pday == '말일'){echo 'checked';}?> onclick='chk_box(this.name,2);'>말일
					</td>
				</tr>

				<tr> 
					<th>구분</th>
					<td>
						<input type='checkbox' name='ptype' value='자동이체' <?if($ptype == '자동이체'){echo 'checked';}?> onclick='chk_box(this.name,0);'>자동이체&nbsp;&nbsp;
						<input type='checkbox' name='ptype' value='지로' <?if($ptype == '지로'){echo 'checked';}?> onclick='chk_box(this.name,1);'>지로
					</td>
					<th>청구서 수령방법</th>
					<td>
						<input type='checkbox' name='pmode' value='우편' <?if($pmode == '우편'){echo 'checked';}?> onclick='chk_box(this.name,0);'>우편&nbsp;&nbsp;
						<input type='checkbox' name='pmode' value='e-mail' <?if($pmode == 'e-mail'){echo 'checked';}?> onclick='chk_box(this.name,1);'>e-mail
					</td>
				</tr>

				<tr> 
					<th>이메일</th>
					<td colspan='3'><input type='text' name='pemail' style='width:180px;' value='<?=$pemail?>'></td>
				</tr>

				<tr>
					<th>청구서주소</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input name="pzip01" id="pzip01" type="text" style='width:50px;' value='<?=$pzip01?>' maxlength='3'> - <input name="pzip02" id="pzip02" type="text" style='width:50px;' value='<?=$pzip02?>' maxlength='3'>
								<a href="javascript:openDaumPostcode(2);"><img src='/images/member/order_add.gif' border='0' style='margin:5 0 -5 0' alt='우편번호' /></a></td>
							</tr>
							<tr>
								<td style='padding:3px 0px 0px 0px;'><input name='paddr01' id='paddr01' type='text' style='width:312px;' value='<?=$paddr01?>'></td>
							</tr>
							<tr>
								<td style='padding:3px 0px 0px 0px;'><input name='paddr02' id='paddr02' type='text' style='width:312px;' value='<?=$paddr02?>'></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<th>은행(카드사)명</th>
					<td colspan='3'><input type='text' name='pbank' style='width:180px;' value='<?=$pbank?>'></td>
				</tr>

				<tr> 
					<th>계좌(카드)번호</th>
					<td><input type='text' name='paccount' style='width:180px;' value='<?=$paccount?>'></td>
					<th>카드유효기간</th>
					<td><input type='text' name='pend' style='width:180px;' value='<?=$pend?>'></td>
				</tr>
			</table>
		</td>
	</tr>



	<tr>
		<td style='padding:50px 0px 0px 0px;'><b>3. 담당자</b></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">담당자</th>
					<td width="83%">
						<select name='staff'>
							<option value=''>===</option>
						<?
							for($i=0; $i<count($arr_member); $i++){
						?>
							<option value='<?=$arr_member[$i]?>' <?if($staff==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
						<?
							}
						?>
						</select>						
					</td>
				</tr>

				<tr> 
					<th>이용상품</th>
					<td colspan='3'>
					<?
						for($s=0; $s<count($serviceArr); $s++){
							$v = sprintf('%02d',$s+1);
							if(${'service'.$v})	$chk = 'checked';
							else						$chk = '';
					?>
						<input type='checkbox' name='service<?=$v?>' value='1' <?=$chk?>><?=$serviceArr[$s]?>&nbsp;&nbsp;
					<?
						}
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>



	<tr>
		<td style='padding:50px 0px 0px 0px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><b>4. LG U+ 서비스 신청사항 및 부가정보</b></td>
					<td align='right'>
						<input type='button' name='btn01' value='전국대표번호' onclick='addMent(1);' style='cursor:pointer;'>
						<input type='button' name='btn01' value='기업070' onclick='addMent(2);' style='cursor:pointer;'>
						<input type='button' name='btn01' value='오피스넷' onclick='addMent(3);' style='cursor:pointer;'>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style='padding:3px 0px 0px 0px;'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>

				<tr>				

					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form();"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="../img/board/delete1.gif" border=0></a>&nbsp;

<?
}
?>
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>&nbsp;

					</td>

				</tr>
			</table>
		</td>
	</tr>
</table>






</form>

<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>