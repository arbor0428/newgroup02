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

if ($type == 'edit' && $uid) {
	$sql = "select * from wo_proof where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$userid = $row['userid'];
}

?>
<style>
	:root {
		--main-bg-color: #e2e8f4;
		--main-border-color: #796C98;
		--sub-border-color: #f6f6f6;
	}
	.container {
		width: 100%;
		max-width: 950px;
		margin: 0 auto;
		color: #000;
    }
	.career main {
		position: relative;
    }
   .career header {
		font-size: 18px;
		text-align: center;
		position: relative;
		margin: 100px 0 50px;
    }
    .career_logo {
		position: absolute;
		top: -80px;
		left: 0;
    }
    .career_logo img {
		width: 120px;
    }
	h1 {
		font-size: 50px;
	}
	h3 {
		font-size: 30px;
		letter-spacing: 2px;
	}
    #print_wrap {
		position: absolute;
		top: 0;
		right: 0;
    }
    #printBtn {
		cursor: pointer;
		font-size: 16px;
		padding: 10px 20px;
		color: white;
		background-color: rgb(97, 105, 107);
		border-radius: 5px;
		border: none;
    }
    #printBtn:hover {
		background-color: rgb(51, 51, 51);;
    }
    .formTable {
		border-top: 2px solid var(--main-border-color);
		border-bottom: 2px solid var(--main-border-color);
		border-collapse: collapse;
		margin-bottom: 40px;
    }
    .formTable th, 
    .formTable td {
		font-size: 16px;
		border: 1px solid #dee1e6;
		line-height: 50px;
		border-right: none;
		border-left: none;
    }
	.formTable th {
		letter-spacing:2px;
		width: 300px;
		text-align: center; 
		background-color: var( --main-bg-color);
    }
    .formTable td {
		font-size: 18px;
		color:black;
		padding-left:25px;
		width: 32%;
    }
    .formTable2 td {
		font-size: 16px;
		padding-left: 0;
		text-align: center;
		width: 15.5%;
    }
	input {
		font-size:18px;
		color:black;
		border:none;
		outline:none;
	}
    select {
		color:black;
		font-size:35px;
		border: 1px solid rgb(177, 177, 177);
		border-radius: 5px;
		font-size: 18px;
		text-align: center;
		width: 180px;
		height: 34px;
		cursor: pointer;
		outline: none;
		margin-right:10px;
    }
	option {
		font-size: 18px;
		color: brgb(51,51,51);
	}
    .no_print {
		color:black;
		border: 2px dashed #ee0000;
    }
	.no_print > h3 > span {
		color:#ee0000;
		font-size:15px;
		font-weight :normal;
	}
    .tailContent {
		text-align: center;
		margin-top: 90px;
    }
    .tailContent > p {
		font-size: 24px;
		letter-spacing:2px;
		color:black;
		font-weight: bold;
		margin-bottom: 90px;
    }
    .datetime {
		font-size: 22px;
		line-height: 14px;
		padding-top: 0;
    }
    footer {
		position:relative;
		font-size: 30px;
		color: rgb(37, 37, 37);
		text-align: center;
		margin-bottom: 60px;
    }
    #sign {
		cursor:pointer;
		display:inline-block;
		width:75px;
		height:75px;
		background: url(/images/dojang2.png);
		font-size: 18px;
		font-weight: normal;
		position:relative;
		top:0;
		line-height:75px;
	}
	.mt-100 {
		margin-top: 120px;
	}
	#num {
		text-align:center;
	}
	@media print {
		@page { margin: 0; }
		body { background: none; }
		.container {
			width: 100%;
			margin: 0;
		
		}
		.wrap,
		.approval_container{
			width: 100vw;
			margin:0;
		}
		
		.no_print, .none_print {
			display: none !important;
		}
		.content_head,
		.main_content_right_wrap{
			display: none;
		}
		.mt-100 {
			margin-top:50px;
		}
		.career h1 {
			font-size: 24px;
		}
		.career h3 ,
		.tailContent > p{
			font-size: 16px;
		}
		.tailContent > p{
			margin-bottom: 20px;
		}
		select {
			border: none;
			-webkit-appearance: none; /* for chrome */
			-moz-appearance: none; /*for firefox*/
			appearance: none;
			text-align: left;
			font-size: 14px !important;
		}
		select::-ms-expand {
			display: none;/*for IE10,11*/
			font-size: 14px;
		}
		input {
			font-size: 14px;
		}
		.formTable td {
			font-size: 14px;
		}
		#userid {
			font-size: 14px;
		}
		#useSpace > select {
			font-size: 14px;
		}
		#stamp {
			display: none;
		}
		footer {
			position: absolute;
			margin: 0;
			bottom: 210px;
			right: 160px;
		}
		footer > h1 {
			font-size: 40px;
		}
		.tailContent {
		 margin: 0 !important;
		}
	}
</style>

<script language='javascript'>

	function setUserID() {
		
		userid = $("#userid option:selected").val(); // userid가 select됐을때 작용

		$('#name').val(''); // 성명 input value id가 name인 값 가져와서 초기화 시키기 값에 ('') null을 담아서 변수를 초기화 시킨다
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

		if (userid) {
			$.post('./jsonUser.php',{'userid':userid}, function(req){ // json 방식으로 전송하여 리턴값 받기.
				
				parData = JSON.parse(req); // 문자열 구문 분석, 객체생성
				
				name = parData['name']; // name이라는 객체를 생성
				securi = parData['securi'];
				securi2 = parData['securi2'];
				//zipcode = parData['zipcode'];
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
				
				const teamName = $('#team').val(team).val();
				let teamNum = '0';
				if(teamName =='기획팀' ) {
						teamNum ='0101';
				}
				if(teamName =='개발팀' || teamName =='1팀') {
					teamNum ='0201';
				}
				if(teamName =='2팀') {
					teamNum ='0202';
				}
				if(teamName =='운영지원팀'){
					teamNum ='0301';
				}
				if(teamNum == '') {
					teamNum = '0000';
				}
				
			pushDate(teamNum);


				if(securi && securi2)			$('#regNumber').text(securi +' - '+ securi2.substr(0, 1)+'******'); // 주민등록번호 앞자리+뒷자리 텍스트로.
				else									$('#regNumber').text(''); // 주민등록번호 앞자리+뒷자리 텍스트로.

				if(addr01 && addr02)			$('#addr').text(addr01+' '+addr02); // 주소1+주소2 텍스트로.
				else									$('#addr').text(''); // 주소1+주소2 텍스트로.
			
				$('#team').text(team); // 소속
				$('#affil').text(affil);
				if(pdate01 && pdate02)		$('#date').text(idate01+'년 '+idate02+'월 '+idate03+'일 ~ '+pdate01+'년 '+pdate02+'월 '+pdate03+'일');
				else									$('#date').text(idate01+'년 '+idate02+'월 '+idate03+'일 ~ <?=$rDate?>년 <?=$rDate2?>월 <?=$rDate3?>일 (현재 재직중)');
				
				$('#drafter').text(name);

/*				$('#name').val(name); // 성명 다시 name이라는 변수를 담는다.
				$('#securi').val(securi); // 주민등록번호 앞자리
				$('#securi2').val(securi2); // 주민등록번호 뒷자리
				$('#zipcode').val(zipcode); // 우편번호
				$('#addr01').val(addr02); // 주소1
				$('#addr02').val(addr02); // 주소2
				$('#team').val(team); // 소속
				$('#affil').val(affil); // 직위
				$('#idate01').val(idate01); // 재직기간 년
				$('#idate02').val(idate02); // 재직기간 월
				$('#idate03').val(idate03); // 재직기간 일
				$('#pdate01').val(pdate01); // 재직기간 년
				$('#pdate02').val(pdate02); // 재직기간 월
				$('#pdate03').val(pdate03); // 재직기간 일 */	
			});
		}
	}
</script>
<div style="background-color: #fff; padding: 20px; box-sizing: border-box; margin: 20px;">
<form name='FRM' action="<?=$PHP_SELF?>" method='post'style="background-color: #fff;">
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


 <div class="container career">
    <header>
		<h1>경&nbsp&nbsp&nbsp&nbsp력&nbsp&nbsp&nbsp&nbsp증&nbsp&nbsp&nbsp&nbsp명&nbsp&nbsp&nbsp&nbsp서</h1>
		<div class="career_logo">
			<img src="/images/iweblogo.jpg" alt="로고">
		</div>
		<div id="print_wrap">
			<button id="printBtn" class="no_print">인쇄하기</button>
		</div>
    </header>
    <main>
		<h3 class="mt-100">1. 인적사항</h3>
		<table class="formTable">
			<tr>
				<th>성&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;명</th>
				<td id="nameSpace">
					<select name='userid' id="userid" onchange="setUserID()">
						<option value=''>::직원목록::</option>
					<?
						for ($i=0; $i<count($arr_member); $i++) {
					?>
						<option value='<?=$arr_userid[$i]?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>>
							<?=$arr_member[$i]?>
						</option>
					<?
						}
					?>
					</select>
				</td>
				<th>주민등록번호</th>
				<td id="regNumber"></td>
			</tr>
			<tr>
				<th>주&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;소</th>
				<td colspan="3" id="addr">
			</tr>
		</table>
		<h3 class="mt-100">2. 경력사항</h3>
		<table class="formTable">
			<tr>
				<th>회&nbsp;사&nbsp;명</th>
				<td id="comName"><input type="text" value="<?=$actxt01?>" readonly></td>
				<th>사업자번호</th>
				<td id="comNumber"><input type="text" value="<?=$cmp_num?>" readonly></td>
			</tr>
			<tr>
				<th>소&nbsp;재&nbsp;지</th>
				<td colspan="3" id="comAddr"><input type="text" style='width:90%' value="<?=$cmp_adr?>" readonly></td>
			</tr>
			<tr>
				<th>소&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;속</th>
				<td id='team'></td>
				<th>직위/직급</th>
				<td id="affil"></td>
			</tr>
			<tr>
				<th>경력기간</th>
				<td colspan="3" id="date"></td>
			</tr>
			<tr>
				<th>사용용도</th>
				<td colspan="3" id="useSpace">
				<select name='puse'>
					<option value=''>::사용용도::</option>
					<option value='개인확인용'<? echo $puse =='개인확인용' ? 'selected':''?>>개인확인용</option>
					<option value='금융기관용'<? echo $puse =='금융기관용' ? 'selected':''?>>금융기관용</option>
					<option value='공공기관용'<? echo $puse =='공공기관용' ? 'selected':''?>>공공기관용</option>
					<option value='기타'<? echo $puse =='기타' ? 'selected':''?>>기타</option>
					</select>
					<select id='stamp'>
					<option value='도장있음'>도장있음</option>
					<option value='도장없음'>도장없음</option>
				</select>
				</td>
			</tr>
		</table>
		<div class="no_print mt-100">
			<h3>
				3. 문서관리
				<span> (출력되지 않는 항목입니다.) <span>
			</h3>
			<table class="formTable formTable2">
				<tr>
					<th>문서번호</th>
					<td><input type="text" name="num" id="num" readonly/></td>
					<th>문서종류</th>
					<td>결재</td>
					<th>보존연한</th>
					<td>3년</td>
				</tr>
				<tr>
					<th>보안등급</th>
					<td>L3</td>
					<th>수신처</th>
					<td>인사팀</td>
					<th>기안자</th>
					<td id="drafter"></td>
				</tr>
			</table>
		</div>
	</main>
	<footer>
		<div class="tailContent">
			<p>상기인은 위와 같이 경력이 있음을 증명합니다.</p>
		<p id="today"></p>
		</div>
		<h1>
			주식회사 아이웹&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;대표이사&nbsp;&nbsp;&nbsp;조&nbsp;&nbsp;준&nbsp;&nbsp;&nbsp;
			<span id="sign">(인)</span>
		</h1>
	</footer>
</div>
</form>
</div>
<script>
	const printBtn = document.getElementById("printBtn");
	const today = document.getElementById("today");
	const stamp = document.getElementById("stamp");
	const sign = document.getElementById("sign");

	const todayYear = new Date().getFullYear();
	let todayMonth = new Date().getMonth() + 1;
	let todayDate = new Date().getDate();

	if (todayMonth < 10) {
		todayMonth = "0" + todayMonth;
	}
	if (todayDate < 10){
		todayDate = "0" + todayDate;
	}
	today.textContent = `${todayYear}년 ${todayMonth}월 ${todayDate}일`;

	printBtn.addEventListener("click", function() {
		window.print();
	});

	stamp.addEventListener("change", function() {
		if (stamp.value == '도장있음') {
			sign.style.background = 'url(/images/dojang2.png)';
		} else {
			sign.style.background = 'none';
		}
	});
		//주차계산
    function getWeekNumber(d) {
      // Copy date so don't modify original
      d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
      // Set to nearest Thursday: current date + 4 - current day number
      // Make Sunday's day number 7
      d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay()||7));
      // Get first day of year
      var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
      // Calculate full weeks to nearest Thursday
      var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
      // Return array of year and week number
      return [d.getUTCFullYear(), weekNo];
    }
		
		function pushDate (teamNum) {
			const result = getWeekNumber(new Date());
			const year = String(result[0]).substring(2,4);

			$('#num').val( 'A'+year+''+result[1]+'-'+teamNum+'<?=str_pad($uid+1, 3, 0,STR_PAD_LEFT);?>' );
				
		}
</script>