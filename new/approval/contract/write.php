<?

		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$actxt01 = $row["actxt01"]; // 회사명
		$cmp_num = $row["cmp_num"]; // 사업자 번호
		$cmp_adr = $row["cmp_adr"]; // 소재지
		$ceo_nm = $row["ceo_nm"]; // 대표이사 성함

		$rDate = date('Y'); // 현재날짜 년
		$rDate2 = date('m'); // 현재날짜 월
		$rDate3 = date('d'); // 현재날짜 일


		if($type == 'edit' && $uid){
			$sql = "select * from wo_proof where uid='$uid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$userid = $row['userid'];
		}


/*
		if($f_userid){
			$sql = "select * from wo_member where userid='$f_userid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$name = $row["name"]; // 성명
			$securi = $row["securi"]; // 주민등록번호 앞자리
			$securi2 = $row["securi2"]; // 주민등록번호 뒷자리
			$team = $row["team"]; // 소속
			$mname = $row["mname"]; // 직위
			$idate01 = $row["idate01"]; // 입사날짜 년
			$idate02 = $row["idate02"]; // 입사날짜 월
			$idate03 = $row["idate03"]; // 입사날짜 일
			$zipcode = $row["zipcode"]; // 우편번호
			$addr01 = $row["addr01"]; // 주소1
			$addr02 = $row["addr02"]; // 주소2
		}
*/

?>

<style type='text/css'>
	input::-webkit-input-placeholder { font-size: 12px;color:#ccc; }
	input::-moz-placeholder { font-size: 12px;color:#ccc; }
	input:-ms-input-placeholder { font-size: 12px;color:#ccc; }
	input:-moz-placeholder { font-size: 12px;color:#ccc; }

	.gTable2 input {background-color:#eee;}
	.r_date_wrap input {width:50px;}
</style>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
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
	
	if(isFrmEmpty(form.userid,"성명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.puse,"사용용도를 선택해 주십시오"))	return;

	//oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);
	 
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

function setUserID() {
	
	userid = $("#userid option:selected").val(); // userid가 select됐을때 작용

//	$('#name').val(''); // 성명 input value id가 name인 값 가져와서 초기화 시키기 값에 ('') null을 담아서 변수를 초기화 시킨다
	$('#securi').val(''); // 주민등록번호 앞자리
	$('#securi2').val(''); // 주민등록번호 뒷자리
	$('#zipcode').val(''); // 우편번호
	$('#addr01').val(''); // 주소1
	$('#addr02').val(''); // 주소2
	$('#team').val(''); // 소속
	$('#affil').val(''); // 직위
	$('#idate01').val(''); // 재직기간 년
	$('#idate02').val(''); // 재직기간 월
	$('#idate03').val(''); // 재직기간 일

	if(userid){
		$.post('./jsonUser.php',{'userid':userid}, function(req){ // json 방식으로 전송하여 리턴값 받기.
			
			parData = JSON.parse(req); // 문자열 구문 분석, 객체생성
			
//			name = parData['name']; // name이라는 객체를 생성
			securi = parData['securi'];
			securi2 = parData['securi2'];
			zipcode = parData['zipcode'];
			addr01 = parData['addr01'];
			addr02 = parData['addr02'];
			team = parData['team'];
			affil = parData['affil'];
			idate01 = parData['idate01'];
			idate02 = parData['idate02'];
			idate03 = parData['idate03'];
			pdate01 = parData['pdate01'];
			pdate02 = parData['pdate02'];
			pdate03 = parData['pdate03'];

//			$('#name').val(name); // 성명 다시 name이라는 변수를 담는다.
			$('#securi').val(securi); // 주민등록번호 앞자리
			$('#securi2').val(securi2); // 주민등록번호 뒷자리
			$('#zipcode').val(zipcode); // 우편번호
			$('#addr01').val(addr01); // 주소1
			$('#addr02').val(addr02); // 주소2
			$('#team').val(team); // 소속
			$('#affil').val(affil); // 직위
			$('#idate01').val(idate01); // 재직기간 년
			$('#idate02').val(idate02); // 재직기간 월
			$('#idate03').val(idate03); // 재직기간 일
			$('#pdate01').val(pdate01); // 재직기간 년
			$('#pdate02').val(pdate02); // 재직기간 월
			$('#pdate03').val(pdate03); // 재직기간 일

//			req = urldecode(req); // 지정된 인코딩 개체를 사용해서 URL로 인코딩된 문자열을 디코딩된 문자열로 변환 이거는 ANSI UTF8변환
		});
	}
}

/*
function setUserID(){
	form = document.FRM;
	form.action = "<?=$_SERVER['PHP_SELFT']?>";
	form.submit();
}
*/

</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='mtype' value='<?=$mtype?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='type' value='<?=$type?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>
<input type='hidden' name='f_site' value='<?=$f_site?>'>
<input type='hidden' name='f_naverID' value='<?=$f_naverID?>'>
<input type='hidden' name='f_daumID' value='<?=$f_daumID?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>

<!-- /검색관련 -->
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">성  명</th>
		<td>
			<select name='userid' id="userid" onchange="setUserID()">
				<option value=''>::직원목록::</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_userid[$i]?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
			
			<select name='puse'>
				<option value=''>::사용용도::</option>
				<option value='금융기관'<? echo $puse =='금융기관' ? 'selected':''?>>금융기관</option>
				<option value='관공서'<? echo $puse =='관공서' ? 'selected':''?>>관공서</option>
				<option value='기타'<? echo $puse =='기타' ? 'selected':''?>>기타</option>
			</select>
		</td>
	</tr>    
           
	<tr>
		<th>주민등록번호</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' id='securi' name='securi' style='width:60px;' value='<?=$securi?>' maxlength='6' readonly> - <input type='text'  id='securi2' name='securi2' style='width:70px;' value='<?=$securi2?>' maxlength='7' readonly></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>주  소</th>
		<td>
			<span style='display:block; padding-top:3px;'>
				<input type='text' name='zipcode'  id="zipcode" style='width:180px;' value='<?=$zipcode?>' readonly>
				<input type='text' id="addr01" name='addr01' style='width:32%' value='<?=$addr01?>' readonly>
				<input type='text' id="addr02" name='addr02' style='width:30%' value='<?=$addr02?>' readonly>
			</span>
		</td>
	</tr>

	<tr>
		<th>회 사 명</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>사업자 번호</th>
		<td>
			<input type='text' name='cmp_num' style='width:180px;' value='<?=$cmp_num?>' readonly>
		</td>
	</tr>

	<tr>
		<th>소 재 지</th>
		<td>
			<input type='text' name='cmp_adr' style='width:350px;' value='<?=$cmp_adr?>' readonly>
		</td>
	</tr>

	<tr>
		<th>소  속</th>
		<td>
			<input type='text' id="team" name='team' value='<?=$team?>' readonly>
		</td>
	</tr>

	<tr>
		<th>직  위</th>
		<td>
			<input type='text' id="affil" name='affil' value='<?=$affil?>' readonly>
		</td>
	</tr>

	<tr>
		<th>재직기간</th>
		<td>
			<span class="r_date_wrap" readonly>
			<input type='text' id="idate01" name='idate01' value='<?=$idate01?>' readonly>년<input type='text' id="idate02" name='idate02' value='<?=$idate02?>' readonly>월<input type='text' id="idate03" name='idate03' value='<?=$idate03?>' readonly>일~			
				<input type='text' id="pdate01" name='pdate01' value='<?=$pdate01?>' readonly>년<input type='text' id="pdate02" name='pdate02' value='<?=$pdate02?>' readonly>월<input type='text' id="pdate03" name='pdate03' value='<?=$pdate03?>' readonly>일
			</span>
		</td>
	</tr>

	<tr>
		<th>대표이사 </th>
		<td><input type='text' name='team' style='width:50px;' value='<?=$ceo_nm?>' readonly></td>
	</tr>

</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<!-- <tr>
		<td style='padding:3px 0px 0111111111111111111111111111111111px 0px;'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></td>
	</tr> -->

	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>

				<tr>				

					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form();"><img src="../../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="../../img/board/delete1.gif" border=0></a>&nbsp;

<?
}
?>
						<a href="javascript:reg_list();"><img src="../../img/board/list01.gif" border=0></a>&nbsp;

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


<link type='text/css' rel='stylesheet' href='/skins/js/placeholder.css'><!-- 웹킷브라우져용 -->
<script src="/skins/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
<script type="text/javascript">
$('input, textarea').placeholder();
</script>