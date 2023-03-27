<?

		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$phone = $row["phone"]; // 회사 대표번호
		$fax = $row["fax"]; // 회사 팩스번호
		$bank01 = $row["bank01"]; // 법인계좌 은행
		$actxt01 = $row["actxt01"]; // 회사명
		$account01 = $row["account01"]; // 법인계좌번호
		$cmp_num = $row["cmp_num"]; // 사업자 번호
		$cmp_adr = $row["cmp_adr"]; // 소재지
		$ceo_nm = $row["ceo_nm"]; // 대표이사 성함
		$i_mail = $row["i_mail"]; // 이메일
		$i_hpage = $row["i_hpage"]; // 홈페이지
		$i_ppage = $row["i_ppage"]; // 카드결제 사이트

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

function check_form(){

	form = document.FRM;
	
	if(isFrmEmpty(form.userid,"성명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.puse,"사용용도를 선택해 주십시오"))	return;

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
		form.type.value = 'del';
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}
}

	//학력사항
	function optAdd(no){

		var num = parseInt($('#num').val()); //문자를 숫자로 바꿔서 값을 가져온다
		num++;						

		if(num>4) {
			
			alert('5개까지만 가능합니다.');
			return false;

		}

		$('#num').val(num); // 아이디 num의 값을 가져온다.

		//추가할 html 소스들을 집어넣는다
		text='<tr class = "form" id = "bill'+num+'">';
		text+='<th>제품명</th>';
		text+='<td>';
		text+='<select name='prd[]'>';
		text+='<option value=''>::제품선택::</option>';
		text+='<option value='무료형'<? if($record_count=='0') echo 'selected';?>>무료형 홈페이지 제작</option>';
		text+='<option value='알뜰형'<? echo $prd1 =='알뜰형 홈페이지 제작' ? 'selected':''?>>알뜰형 홈페이지 제작</option>';
		text+='<option value='보급형'<? echo $prd1 =='보급형 홈페이지 제작' ? 'selected':''?>>보급형 홈페이지 제작</option>';
		text+='<option value='맞춤형'<? echo $prd1 =='맞춘형 홈페이지 제작' ? 'selected':''?>>맞춤형 홈페이지 제작</option>';
		text+='<option value='독립형'<? echo $prd1 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>';
		text+='<option value='도메인'<? echo $prd1 =='도메인(홈페이지 주소) 1년' ? 'selected':''?>>도메인(홈페이지 주소) 1년</option>';
		text+='<option value='SSL'<? echo $prd1 =='SSL 보안서버 1년' ? 'selected':''?>>SSL 보안서버 1년</option>';
		text+='<option value='전자결제'<? echo $prd1 =='전자결제 가입비용' ? 'selected':''?>>전자결제 가입비용</option>';
		text+='<option value='100MB'<? echo $prd1 =='웹용량 100MB 웹트래픽 400MB' ? 'selected':''?>>웹용량 100MB / 웹트래픽 400MB</option>';
		text+='<option value='500MB'<? echo $prd1 =='웹용량 500MB 웹트래픽 2GB' ? 'sel ected':''?>>웹용량 500MB / 웹트래픽 2GB</option>';
		text+='<option value='1GB'<? echo $prd1 =='웹용량 1GB 웹트래픽 5GB' ? 'selected':''?>>웹용량 1GB / 웹트래픽 5GB</option>';
		text+='<option value='2GB'<? echo $prd1 =='웹용량 2GB 웹트래픽 10GB' ? 'selected':''?>>웹용량 2GB / 웹트래픽 10GB</option>';
		text+='<option value='3GB'<? echo $prd1 =='웹용량 3GB 웹트래픽 15GB' ? 'selected':''?>>웹용량 3GB / 웹트래픽 15GB</option>';
		text+='<option value='5GB'<? echo $prd1 =='웹용량 5GB 웹트래픽 25GB' ? 'selected':''?>>웹용량 5GB / 웹트래픽 25GB</option>';
		text+='<option value='7GB'<? echo $prd1 =='웹용량 7GB 웹트래픽 35GB' ? 'selected':''?>>웹용량 7GB / 웹트래픽 35GB</option>';
		text+='<option value='10GB'<? echo $prd1 =='웹용량 10GB 웹트래픽 50GB' ? 'selected':''?>>웹용량 10GB / 웹트래픽 50GB</option>';
		text+='<option value='20GB'<? echo $prd1 =='웹용량 20GB 웹트래픽 무제한' ? 'selected':''?>>웹용량 20GB / 웹트래픽 무제한</option>';
		text+='<option value='30GB'<? echo $prd1 =='웹용량 30GB 웹트래픽 무제한' ? 'selected':''?>>웹용량 30GB / 웹트래픽 무제한</option>';
		text+='<option value='알뜰형+1P부분제작'<? echo $prd1 =='알뜰형+1P부분제작' ? 'selected':''?>>알뜰형+1P부분제작</option>';
		text+='<option value='1P부분제작'<? echo $prd1 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>';
		text+='<option value='다국어페이지'<? echo $prd1 =='다국어페이지' ? 'selected':''?>>다국어페이지</option>';
		text+='</select>';
		text+='<select name='prd1[]'>';
		text+='<option value=''>::수량선택::</option>';
		text+='<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>';
		text+='<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>';
		text+='<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>';
		text+='<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>';
		text+='<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>';
		text+='<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>';
		text+='<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>';
		text+='<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>';
		text+='<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>';
		text+='<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>';
		text+='<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>';
		text+='<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>';
		text+='<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>';
		text+='<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>';
		text+='<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>';
		text+='<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>';
		text+='<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>';
		text+='<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>';
		text+='<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>';
		text+='<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>';
		text+='<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>';
		text+='<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>';
		text+='<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>';
		text+='<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>';
		text+='</select>';
		text+='</td>';
		text+='<td>';
		//text+='<input type="text" name="yangta" id="yangta" value="<?=$reTotalPrice?>" class='numberOnly' onkeyup='totalPrice()'>';
		text+='</td>';
		text+='</tr>';
		
		//html소스와 클래스 또는 아이디를 플러스 플러스 한다
		$('.f-wrap').append(text);
		
		console.log(num);
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
/*
//콤마를 빼서 변수에 담고, 연산을 한 다음에 다시 콤마를 붙이는 제이쿼리.
	reTotal = $('#reTotal').val();
	reTotal = reTotal.replace(/,/g, '');

	tPrice = $('#tPrice').val();
	tPrice = tPrice.replace(/,/g, '');

	suPrice = $('#suPrice').val();
	suPrice = suPrice.replace(/,/g, '');

	suPrice2 = $('#suPrice2').val();
	suPrice2 = suPrice2.replace(/,/g, '');

	renPrice = $('#renPrice').val();
	renPrice = renPrice.replace(/,/g, '');

	renPrice2 = $('#renPrice2').val();
	renPrice2 = renPrice2.replace(/,/g, '');

	renPrice3 = $('#renPrice3').val();
	renPrice3 = renPrice3.replace(/,/g, '');

//곱하기 1을 하지 않으면 에러난다
	reTotalPrice = reTotal*1 - tPrice*1 - suPrice*1 - suPrice2*1 - renPrice*1 - renPrice2*1 - renPrice3*1;
	reTotalPrice = comma(uncomma(reTotalPrice))
	$('#reTotalPrice').val(reTotalPrice);

	function inputNumberFormat(obj) {
	     obj.value = comma(uncomma(obj.value));
	 }
	function comma(str) {
	   str = String(str);
	   return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
	}

	//콤마풀기
	function uncomma(str) {
	   str = String(str);
	   return str.replace(/[^\d]+/g, '');
	}

	$(function() {
	//직접입력 인풋박스 기존에는 숨어있다가
	$("#selboxDirect").hide();
	$("#selbox").change(function() {
		//직접입력을 누를 때 나타남
		if($("#selbox").val() == "direct") {
			$("#selboxDirect").show();?
		}	else {
				$("#selboxDirect").hide();
			}
		})
	});
*/
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
	<input type='hidden' name='mtype' value='<?=$mtype?>'>
	<input type='hidden' name='uid' value='<?=$uid?>'>
	<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
	<input type='hidden' name='type' value='<?=$type?>'>

	<!-- html 추가추가 할때 필요한 hidden값 문자 num id의 값 3 -->
	<input type='hidden' name='num' id='num' value="0">

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
		<th width="17%">담당자</th>
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
		</td>
	</tr>    
           
	<tr class = 'form' id = "bill1">
		<th>제품명1</th>
		<td class = "f-wrap">

			<!--추가되는 select-->
			<select name='prd[]'>
				<option value=''>::제품선택::</option>
				<option value='무료형'<? if($record_count=='0') echo 'selected';?>>무료형 홈페이지 제작</option>
				<option value='알뜰형'<? echo $prd1 =='알뜰형 홈페이지 제작' ? 'selected':''?>>알뜰형 홈페이지 제작</option>
				<option value='보급형'<? echo $prd1 =='보급형 홈페이지 제작' ? 'selected':''?>>보급형 홈페이지 제작</option>
				<option value='맞춤형'<? echo $prd1 =='맞춘형 홈페이지 제작' ? 'selected':''?>>맞춘형 홈페이지 제작</option>
				<option value='독립형'<? echo $prd1 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='도메인'<? echo $prd1 =='도메인(홈페이지 주소) 1년' ? 'selected':''?>>도메인(홈페이지 주소) 1년</option>
				<option value='SSL'<? echo $prd1 =='SSL 보안서버 1년' ? 'selected':''?>>SSL 보안서버 1년</option>
				<option value='전자결제'<? echo $prd1 =='전자결제 가입비용' ? 'selected':''?>>전자결제 가입비용</option>
				<option value='100MB'<? echo $prd1 =='웹용량 100MB / 웹트래픽 400MB' ? 'selected':''?>>웹용량 100MB / 웹트래픽 400MB</option>
				<option value='500MB'<? echo $prd1 =='웹용량 500MB / 웹트래픽 2GB' ? 'selected':''?>>웹용량 500MB / 웹트래픽 2GB</option>
				<option value='1GB'<? echo $prd1 =='웹용량 1GB / 웹트래픽 5GB' ? 'selected':''?>>웹용량 1GB / 웹트래픽 5GB</option>
				<option value='2GB'<? echo $prd1 =='웹용량 2GB / 웹트래픽 10GB' ? 'selected':''?>>웹용량 2GB / 웹트래픽 10GB</option>
				<option value='3GB'<? echo $prd1 =='웹용량 3GB / 웹트래픽 15GB' ? 'selected':''?>>웹용량 3GB / 웹트래픽 15GB</option>
				<option value='5GB'<? echo $prd1 =='웹용량 5GB / 웹트래픽 25GB' ? 'selected':''?>>웹용량 5GB / 웹트래픽 25GB</option>
				<option value='7GB'<? echo $prd1 =='웹용량 7GB / 웹트래픽 35GB' ? 'selected':''?>>웹용량 7GB / 웹트래픽 35GB</option>
				<option value='10GB'<? echo $prd1 =='웹용량 10GB / 웹트래픽 50GB' ? 'selected':''?>>웹용량 10GB / 웹트래픽 50GB</option>
				<option value='20GB'<? echo $prd1 =='웹용량 20GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 20GB / 웹트래픽 무제한</option>
				<option value='30GB'<? echo $prd1 =='웹용량 30GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 30GB / 웹트래픽 무제한</option>
				<option value='알뜰형+1P부분제작'<? echo $prd1 =='알뜰형+1P부분제작' ? 'selected':''?>>알뜰형+1P부분제작</option>
				<option value='1P부분제작'<? echo $prd1 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='다국어페이지'<? echo $prd1 =='다국어페이지' ? 'selected':''?>>다국어페이지</option>
				<!-- <option value="direct">직접입력</option> -->
			</select>

			<select name='prd1[]'>
				<option value=''>::수량선택::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<!-- <input type = "text" value = "<? echo $record_count * $prd2 ?>"> -->
			<!-- onkeyup을 하게 되면 input에 숫자가 올라갈때 바로 계산이 된다 -->
			<!-- <input type="text" name="yangta" id="yangta" value="<?=$reTotalPrice?>" class='numberOnly' onkeyup='totalPrice()'> -->
			<a href="javascript:optAdd('<?=$uid?>')" class='small cbtn black'>+추가</a>
		</td>
	</tr>

	<!-- <tr>
		<th>제품명2</th>
		<td>
			<select name='prd2'>
				<option value=''>::제품선택::</option>
				<option value='무료형'<? echo $prd2 =='무료형 홈페이지 제작' ? 'selected':''?>>무료형 홈페이지 제작</option>
				<option value='알뜰형'<? echo $prd2 =='알뜰형 홈페이지 제작' ? 'selected':''?>>알뜰형 홈페이지 제작</option>
				<option value='보급형'<? echo $prd2 =='보급형 홈페이지 제작' ? 'selected':''?>>보급형 홈페이지 제작</option>
				<option value='맞춤형'<? echo $prd2 =='맞춘형 홈페이지 제작' ? 'selected':''?>>맞춘형 홈페이지 제작</option>
				<option value='독립형'<? echo $prd2 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='도메인'<? echo $prd2 =='도메인(홈페이지 주소) 1년' ? 'selected':''?>>도메인(홈페이지 주소) 1년</option>
				<option value='SSL'<? echo $prd2 =='SSL 보안서버 1년' ? 'selected':''?>>SSL 보안서버 1년</option>
				<option value='전자결제'<? echo $prd2 =='전자결제 가입비용' ? 'selected':''?>>전자결제 가입비용</option>
				<option value='100MB'<? echo $prd2 =='웹용량 100MB / 웹트래픽 400MB' ? 'selected':''?>>웹용량 100MB / 웹트래픽 400MB</option>
				<option value='500MB'<? echo $prd2 =='웹용량 500MB / 웹트래픽 2GB' ? 'selected':''?>>웹용량 500MB / 웹트래픽 2GB</option>
				<option value='1GB'<? echo $prd2 =='웹용량 1GB / 웹트래픽 5GB' ? 'selected':''?>>웹용량 1GB / 웹트래픽 5GB</option>
				<option value='2GB'<? echo $prd2 =='웹용량 2GB / 웹트래픽 10GB' ? 'selected':''?>>웹용량 2GB / 웹트래픽 10GB</option>
				<option value='3GB'<? echo $prd2 =='웹용량 3GB / 웹트래픽 15GB' ? 'selected':''?>>웹용량 3GB / 웹트래픽 15GB</option>
				<option value='5GB'<? echo $prd2 =='웹용량 5GB / 웹트래픽 25GB' ? 'selected':''?>>웹용량 5GB / 웹트래픽 25GB</option>
				<option value='7GB'<? echo $prd2 =='웹용량 7GB / 웹트래픽 35GB' ? 'selected':''?>>웹용량 7GB / 웹트래픽 35GB</option>
				<option value='10GB'<? echo $prd2 =='웹용량 10GB / 웹트래픽 50GB' ? 'selected':''?>>웹용량 10GB / 웹트래픽 50GB</option>
				<option value='20GB'<? echo $prd2 =='웹용량 20GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 20GB / 웹트래픽 무제한</option>
				<option value='30GB'<? echo $prd2 =='웹용량 30GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 30GB / 웹트래픽 무제한</option>
				<option value='알뜰형+1P부분제작'<? echo $prd2 =='알뜰형+1P부분제작' ? 'selected':''?>>알뜰형+1P부분제작</option>
				<option value='1P부분제작'<? echo $prd2 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='다국어페이지'<? echo $prd2 =='다국어페이지' ? 'selected':''?>>다국어페이지</option>
			</select>
			<select name='prd2'>
				<option value=''>::수량선택::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<input type = "text" value = "<? echo $prd1 * $prd2 ?>">
		</td>
	</tr>
	
	<tr>
		<th>제품명3</th>
		<td>
			<select name='prd3'>
				<option value=''>::제품선택::</option>
				<option value='무료형'<? echo $prd3 =='무료형 홈페이지 제작' ? 'selected':''?>>무료형 홈페이지 제작</option>
				<option value='알뜰형'<? echo $prd3 =='알뜰형 홈페이지 제작' ? 'selected':''?>>알뜰형 홈페이지 제작</option>
				<option value='보급형'<? echo $prd3 =='보급형 홈페이지 제작' ? 'selected':''?>>보급형 홈페이지 제작</option>
				<option value='맞춤형'<? echo $prd3 =='맞춘형 홈페이지 제작' ? 'selected':''?>>맞춘형 홈페이지 제작</option>
				<option value='독립형'<? echo $prd3 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='도메인'<? echo $prd3 =='도메인(홈페이지 주소) 1년' ? 'selected':''?>>도메인(홈페이지 주소) 1년</option>
				<option value='SSL'<? echo $prd3 =='SSL 보안서버 1년' ? 'selected':''?>>SSL 보안서버 1년</option>
				<option value='전자결제'<? echo $prd3 =='전자결제 가입비용' ? 'selected':''?>>전자결제 가입비용</option>
				<option value='100MB'<? echo $prd3 =='웹용량 100MB / 웹트래픽 400MB' ? 'selected':''?>>웹용량 100MB / 웹트래픽 400MB</option>
				<option value='500MB'<? echo $prd3 =='웹용량 500MB / 웹트래픽 2GB' ? 'selected':''?>>웹용량 500MB / 웹트래픽 2GB</option>
				<option value='1GB'<? echo $prd3 =='웹용량 1GB / 웹트래픽 5GB' ? 'selected':''?>>웹용량 1GB / 웹트래픽 5GB</option>
				<option value='2GB'<? echo $prd3 =='웹용량 2GB / 웹트래픽 10GB' ? 'selected':''?>>웹용량 2GB / 웹트래픽 10GB</option>
				<option value='3GB'<? echo $prd3 =='웹용량 3GB / 웹트래픽 15GB' ? 'selected':''?>>웹용량 3GB / 웹트래픽 15GB</option>
				<option value='5GB'<? echo $prd3 =='웹용량 5GB / 웹트래픽 25GB' ? 'selected':''?>>웹용량 5GB / 웹트래픽 25GB</option>
				<option value='7GB'<? echo $prd3 =='웹용량 7GB / 웹트래픽 35GB' ? 'selected':''?>>웹용량 7GB / 웹트래픽 35GB</option>
				<option value='10GB'<? echo $prd3 =='웹용량 10GB / 웹트래픽 50GB' ? 'selected':''?>>웹용량 10GB / 웹트래픽 50GB</option>
				<option value='20GB'<? echo $prd3 =='웹용량 20GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 20GB / 웹트래픽 무제한</option>
				<option value='30GB'<? echo $prd3 =='웹용량 30GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 30GB / 웹트래픽 무제한</option>
				<option value='알뜰형+1P부분제작'<? echo $prd3 =='알뜰형+1P부분제작' ? 'selected':''?>>알뜰형+1P부분제작</option>
				<option value='1P부분제작'<? echo $prd3 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='다국어페이지'<? echo $prd3 =='다국어페이지' ? 'selected':''?>>다국어페이지</option>
			</select>
			<select name='prd2'>
				<option value=''>::수량선택::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<input type = "text" value = "<? echo $prd1 * $prd2 ?>">
		</td>
	</tr>
	<tr>
		<th>제품명4</th>
		<td>
			<select name='prd3'>
				<option value=''>::제품선택::</option>
				<option value='무료형'<? echo $prd3 =='무료형 홈페이지 제작' ? 'selected':''?>>무료형 홈페이지 제작</option>
				<option value='알뜰형'<? echo $prd3 =='알뜰형 홈페이지 제작' ? 'selected':''?>>알뜰형 홈페이지 제작</option>
				<option value='보급형'<? echo $prd3 =='보급형 홈페이지 제작' ? 'selected':''?>>보급형 홈페이지 제작</option>
				<option value='맞춤형'<? echo $prd3 =='맞춘형 홈페이지 제작' ? 'selected':''?>>맞춘형 홈페이지 제작</option>
				<option value='독립형'<? echo $prd3 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='도메인'<? echo $prd3 =='도메인(홈페이지 주소) 1년' ? 'selected':''?>>도메인(홈페이지 주소) 1년</option>
				<option value='SSL'<? echo $prd3 =='SSL 보안서버 1년' ? 'selected':''?>>SSL 보안서버 1년</option>
				<option value='전자결제'<? echo $prd3 =='전자결제 가입비용' ? 'selected':''?>>전자결제 가입비용</option>
				<option value='100MB'<? echo $prd3 =='웹용량 100MB / 웹트래픽 400MB' ? 'selected':''?>>웹용량 100MB / 웹트래픽 400MB</option>
				<option value='500MB'<? echo $prd3 =='웹용량 500MB / 웹트래픽 2GB' ? 'selected':''?>>웹용량 500MB / 웹트래픽 2GB</option>
				<option value='1GB'<? echo $prd3 =='웹용량 1GB / 웹트래픽 5GB' ? 'selected':''?>>웹용량 1GB / 웹트래픽 5GB</option>
				<option value='2GB'<? echo $prd3 =='웹용량 2GB / 웹트래픽 10GB' ? 'selected':''?>>웹용량 2GB / 웹트래픽 10GB</option>
				<option value='3GB'<? echo $prd3 =='웹용량 3GB / 웹트래픽 15GB' ? 'selected':''?>>웹용량 3GB / 웹트래픽 15GB</option>
				<option value='5GB'<? echo $prd3 =='웹용량 5GB / 웹트래픽 25GB' ? 'selected':''?>>웹용량 5GB / 웹트래픽 25GB</option>
				<option value='7GB'<? echo $prd3 =='웹용량 7GB / 웹트래픽 35GB' ? 'selected':''?>>웹용량 7GB / 웹트래픽 35GB</option>
				<option value='10GB'<? echo $prd3 =='웹용량 10GB / 웹트래픽 50GB' ? 'selected':''?>>웹용량 10GB / 웹트래픽 50GB</option>
				<option value='20GB'<? echo $prd3 =='웹용량 20GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 20GB / 웹트래픽 무제한</option>
				<option value='30GB'<? echo $prd3 =='웹용량 30GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 30GB / 웹트래픽 무제한</option>
				<option value='알뜰형+1P부분제작'<? echo $prd3 =='알뜰형+1P부분제작' ? 'selected':''?>>알뜰형+1P부분제작</option>
				<option value='1P부분제작'<? echo $prd3 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='다국어페이지'<? echo $prd3 =='다국어페이지' ? 'selected':''?>>다국어페이지</option>
			</select>
			<select name='prd2'>
				<option value=''>::수량선택::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<input type = "text" value = "<? echo $prd1 * $prd2 ?>">
		</td>
	</tr>
	<tr>
		<th>제품명5</th>
		<td>
			<select name='prd3'>
				<option value=''>::제품선택::</option>
				<option value='무료형'<? echo $prd3 =='무료형 홈페이지 제작' ? 'selected':''?>>무료형 홈페이지 제작</option>
				<option value='알뜰형'<? echo $prd3 =='알뜰형 홈페이지 제작' ? 'selected':''?>>알뜰형 홈페이지 제작</option>
				<option value='보급형'<? echo $prd3 =='보급형 홈페이지 제작' ? 'selected':''?>>보급형 홈페이지 제작</option>
				<option value='맞춤형'<? echo $prd3 =='맞춘형 홈페이지 제작' ? 'selected':''?>>맞춘형 홈페이지 제작</option>
				<option value='독립형'<? echo $prd3 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='도메인'<? echo $prd3 =='도메인(홈페이지 주소) 1년' ? 'selected':''?>>도메인(홈페이지 주소) 1년</option>
				<option value='SSL'<? echo $prd3 =='SSL 보안서버 1년' ? 'selected':''?>>SSL 보안서버 1년</option>
				<option value='전자결제'<? echo $prd3 =='전자결제 가입비용' ? 'selected':''?>>전자결제 가입비용</option>
				<option value='100MB'<? echo $prd3 =='웹용량 100MB / 웹트래픽 400MB' ? 'selected':''?>>웹용량 100MB / 웹트래픽 400MB</option>
				<option value='500MB'<? echo $prd3 =='웹용량 500MB / 웹트래픽 2GB' ? 'selected':''?>>웹용량 500MB / 웹트래픽 2GB</option>
				<option value='1GB'<? echo $prd3 =='웹용량 1GB / 웹트래픽 5GB' ? 'selected':''?>>웹용량 1GB / 웹트래픽 5GB</option>
				<option value='2GB'<? echo $prd3 =='웹용량 2GB / 웹트래픽 10GB' ? 'selected':''?>>웹용량 2GB / 웹트래픽 10GB</option>
				<option value='3GB'<? echo $prd3 =='웹용량 3GB / 웹트래픽 15GB' ? 'selected':''?>>웹용량 3GB / 웹트래픽 15GB</option>
				<option value='5GB'<? echo $prd3 =='웹용량 5GB / 웹트래픽 25GB' ? 'selected':''?>>웹용량 5GB / 웹트래픽 25GB</option>
				<option value='7GB'<? echo $prd3 =='웹용량 7GB / 웹트래픽 35GB' ? 'selected':''?>>웹용량 7GB / 웹트래픽 35GB</option>
				<option value='10GB'<? echo $prd3 =='웹용량 10GB / 웹트래픽 50GB' ? 'selected':''?>>웹용량 10GB / 웹트래픽 50GB</option>
				<option value='20GB'<? echo $prd3 =='웹용량 20GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 20GB / 웹트래픽 무제한</option>
				<option value='30GB'<? echo $prd3 =='웹용량 30GB / 웹트래픽 무제한' ? 'selected':''?>>웹용량 30GB / 웹트래픽 무제한</option>
				<option value='알뜰형+1P부분제작'<? echo $prd3 =='알뜰형+1P부분제작' ? 'selected':''?>>알뜰형+1P부분제작</option>
				<option value='1P부분제작'<? echo $prd3 =='독립형 홈페이지 제작' ? 'selected':''?>>독립형 홈페이지 제작</option>
				<option value='다국어페이지'<? echo $prd3 =='다국어페이지' ? 'selected':''?>>다국어페이지</option>
			</select>
			<select name='prd2'>
				<option value=''>::수량선택::</option>
				<option value='1'<? echo $prd2 =='1' ? 'selected':''?>>1</option>
				<option value='2'<? echo $prd2 =='2' ? 'selected':''?>>2</option>
				<option value='3'<? echo $prd2 =='3' ? 'selected':''?>>3</option>
				<option value='4'<? echo $prd2 =='4' ? 'selected':''?>>4</option>
				<option value='5'<? echo $prd2 =='5' ? 'selected':''?>>5</option>
				<option value='6'<? echo $prd2 =='6' ? 'selected':''?>>6</option>
				<option value='7'<? echo $prd2 =='7' ? 'selected':''?>>7</option>
				<option value='8'<? echo $prd2 =='8' ? 'selected':''?>>8</option>
				<option value='9'<? echo $prd2 =='9' ? 'selected':''?>>9</option>
				<option value='10'<? echo $prd2 =='10' ? 'selected':''?>>10</option>
				<option value='11'<? echo $prd2 =='11' ? 'selected':''?>>11</option>
				<option value='12'<? echo $prd2 =='12' ? 'selected':''?>>12</option>
				<option value='13'<? echo $prd2 =='13' ? 'selected':''?>>13</option>
				<option value='14'<? echo $prd2 =='14' ? 'selected':''?>>14</option>
				<option value='15'<? echo $prd2 =='15' ? 'selected':''?>>15</option>
				<option value='16'<? echo $prd2 =='16' ? 'selected':''?>>16</option>
				<option value='17'<? echo $prd2 =='17' ? 'selected':''?>>17</option>
				<option value='18'<? echo $prd2 =='18' ? 'selected':''?>>18</option>
				<option value='19'<? echo $prd2 =='19' ? 'selected':''?>>19</option>
				<option value='20'<? echo $prd2 =='20' ? 'selected':''?>>20</option>
				<option value='21'<? echo $prd2 =='21' ? 'selected':''?>>21</option>
				<option value='22'<? echo $prd2 =='22' ? 'selected':''?>>22</option>
				<option value='23'<? echo $prd2 =='23' ? 'selected':''?>>23</option>
				<option value='24'<? echo $prd2 =='24' ? 'selected':''?>>24</option>
			</select>
		</td>
		<td>
			<input type = "text" value = "<? echo $prd1 * $prd2 ?>">
		</td>
	</tr> -->

	<tr>
		<th>수  신</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>제 목</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
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
		<th>수취인 통장</th>
		<td>
			<input type='text' name='account01' style='width:180px;' value='<?=$account01?>' readonly>
		</td>
	</tr>

	<tr>
		<th>예금주</th>
		<td>
			<input type='text' name='actxt01' style='width:350px;' value='<?=$actxt01?>' readonly>
		</td>
	</tr>

	<tr>
		<th>회신연락처</th>
		<td>
			<input type='text' id="phone" name='phone' value='<?=$phone?>' readonly>
		</td>
	</tr>

	<tr>
		<th>이메일</th>
		<td>
			<input type='text' id="i_mail" name='i_mail' value='<?=$i_mail?>' readonly>
		</td>
	</tr>
	<tr>
		<th>붙임</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<th>대표이사 </th>
		<td><input type='text' name='team' style='width:50px;' value='<?=$ceo_nm?>' readonly></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
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
/*
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
*/
</script>


<link type='text/css' rel='stylesheet' href='/skins/js/placeholder.css'><!-- 웹킷브라우져용 -->
<script src="/skins/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
<script type="text/javascript">
$('input, textarea').placeholder();
</script>