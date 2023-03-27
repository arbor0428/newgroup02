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

	if(isFrmEmpty(form.name,"성명을 입력해 주십시오"))	return;

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = 'proc.php';
	form.submit();
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?= $PHP_SELF ?>';
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

	userid = $("#userid option:selected").val();


	if(userid){
		$.post('./jsonUser.php',{'userid':userid}, function(req){

			//req = urldecode(req);
			parData = JSON.parse(req);

			name = parData['name'];
			securi = parData['securi'];
			securi2 = parData['securi2'];
			zipcode = parData['zipcode'];
			addr01 = parData['addr01'];
			addr02 = parData['addr02'];
			team = parData['team'];
			team = parData['affil'];
			idate01 = parData['idate01'];
			idate02 = parData['idate02'];
			idate03 = parData['idate03'];

			$('#name').val(name); // 성명
			$('#securi').val(securi); // 주민등록번호 앞자리
			$('#securi2').val(securi2); // 주민등록번호 뒷자리
			$('#zipcode').val(zipcode); // 우편번호
			$('#addr01').val(addr01); // 주소1
			$('#addr02').val(addr02); // 주소2
			$('#team').val(team); // 소속
			$('#affil').val(affil); // 소속
			$('#idate01').val(idate01); // 재직기간 년
			$('#idate02').val(idate02); // 재직기간 월
			$('#idate03').val(idate03); // 재직기간 일
		});
	}
}

/*
function setUserID(){
	form = document.FRM;
	form.action = "<?= $_SERVER['PHP_SELFT'] ?>";
	form.submit();
}
*/

</script>

<form name='FRM' action="<?= $PHP_SELF ?>" method='post'>
<input type='hidden' name='mtype' value='<?= $mtype ?>'>
<input type='hidden' name='uid' value='<?= $uid ?>'>
<input type='hidden' name='next_url' value='<?= $PHP_SELF ?>'>
<input type='hidden' name='record_start' value='<?= $record_start ?>'>
<input type='hidden' name='userid' value='<?= $userid ?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?= $f_name ?>'>
<input type='hidden' name='f_manager' value='<?= $f_manager ?>'>
<input type='hidden' name='f_site' value='<?= $f_site ?>'>
<input type='hidden' name='f_naverID' value='<?= $f_naverID ?>'>
<input type='hidden' name='f_daumID' value='<?= $f_daumID ?>'>
<input type='hidden' name='f_staff' value='<?= $f_staff ?>'>
<input type='hidden' name='f_sname' value='<?= $f_sname ?>'>
<input type='hidden' name='f_ment' value='<?= $f_ment ?>'>
<input type='hidden' name='f_sDate' value='<?= $f_sDate ?>'>
<input type='hidden' name='f_eDate' value='<?= $f_eDate ?>'>

<!-- /검색관련 -->
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr>
		<th width="17%">성명</th>
		<td>
			<select name='userid' id='userid' onchange="setUserID()">
				<option value=''>===</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?= $arr_userid[$i] ?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>><?= $arr_member[$i] ?></option>
			<?
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<th>주민등록번호</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' id='securi' name='securi' style='width:60px;' value='<?= $securi ?>' maxlength='6'> - <input type='text' id='securi2' name='securi2' style='width:70px;' value='<?= $securi2 ?>' maxlength='7'></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>주소</th>
		<td>
			<input type='text' name='zipcode'  id="zipcode" style='width:180px; margin-right:10px;' value='<?= $zipcode ?>'><a href = "javascript:openDaumPostcode();" style='cursor:pointer' class='small cbtn black'>주소찾기</a>
			<span style='display:block; padding-top:3px;'><input type='text' id="addr01" name='addr01' style='width:32%' value='<?= $addr01 ?>'>
			<input type='text' id="addr02" name='addr02' style='width:30%' value='<?= $addr02 ?>'></span>
		</td>
	</tr>

	<tr>
		<th>회사명</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?= $actxt01 ?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>사업자번호</th>
		<td>
			<input type='text' name='cmp_num' style='width:180px; background-color:#eee' value='<?= $cmp_num ?>' readonly>
		</td>
	</tr>

	<tr>
		<th>소재지</th>
		<td>
			<input type='text' name='cmp_adr' style='width:350px; background-color:#eee' value='<?= $cmp_adr ?>' readonly>
		</td>
	</tr>

	<tr>
		<th>소속</th>
		<td>
			<select name='team' id='team'>
						<?
							for($i=0; $i<count($arr_team); $i++){
						?>
							<option value='<?= $arr_team[$i] ?>' <?if($team==$arr_team[$i]) echo 'selected';?>><?= $arr_team[$i] ?></option>
						<?
							}
						?>
						</select>
					<?
						if($GBL_MTYPE == 'A'){
					?>
						<select name='mtype'>
							<option value='M' <?if($mtype=='M') echo 'selected';?>>사원</option>
						<?
							for($i=0; $i<count($arr_team); $i++){
								$txt01 = $arr_team[$i].'장';
						?>
							<option value='S' <?if($mname==$txt01) echo 'selected';?>><?= $txt01 ?></option>
						<?
							}
						?>
							<option value='A' <?if($mtype=='A') echo 'selected';?>>관리자</option>
						</select>
					<?
						}
					?>
		</td>
	</tr>

	<tr>
		<th>직위</th>
		<td>
			<select name='affil' id="affil"> <!-- select값 고정시키기 -->
				<option value='=='<? echo $affil =='==' ? 'selected':''?>>==</option>
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

	<tr>
		<th>재직기간</th>
		<td>
			<select name='idate01' id='idate01'>
							<option value=''>===</option>
					<?
						$myear = date('Y');
						for($i=$myear; $i>=2010; $i--){
					?>
							<option value='<?= $i ?>' <?if($idate01==$i){echo 'selected';}?>><?= $i ?></option>

					<?
						}
					?>
						</select>년

						<select name='idate02' id='idate02'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=12; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?= $no ?>' <?if($idate02==$no){echo 'selected';}?>><?= $i ?></option>

					<?
						}
					?>
						</select>월

						<select name='idate03' id='idate03'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=31; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?= $no ?>' <?if($idate03==$no){echo 'selected';}?>><?= $i ?></option>

					<?
						}
					?>
						</select>일~
			<input type = "text" value='<?= $rDate ?>' style='width:50px; background-color:#eee' readonly>년<input type = "text" value='<?= $rDate2 ?>'style='width:50px; background-color:#eee' readonly>월<input type = "text" value='<?= $rDate3 ?>' style='width:50px; background-color:#eee' readonly>일
		</td>
	</tr>

	<tr>
		<th>사용용도</th>
		<td>
			<select name='puse'>
				<option value='<?= $puse ?>' selected>===</option>
				<option value='<?= $puse ?>' >금융기관</option>
				<option value='<?= $puse ?>' >관공서</option>
				<option value='<?= $puse ?>' >기타</option>
			</select>
		</td>
	</tr>

	<tr>
		<th>대표이사 </th>
		<td><input type='text' name='team' style='width:50px; background-color:#eee' value='<?= $ceo_nm ?>'></td>
	</tr>

</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<!-- <tr>
		<td style='padding:3px 0px 0111111111111111111111111111111111px 0px;'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?= $ment ?></textarea></td>
	</tr> -->

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


<link type='text/css' rel='stylesheet' href='/skins/js/placeholder.css'><!-- 웹킷브라우져용 -->
<script src="/skins/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
<script type="text/javascript">
$('input, textarea').placeholder();
</script>