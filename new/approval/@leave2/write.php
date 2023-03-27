<?
//달력
include $_SERVER["DOCUMENT_ROOT"].'/module/datepicker/Calendar.php';

$sessionId = $_SESSION['ses_id']; //현재 로그인중인 사람

// 현재 로그인 중인 사람 정보
$sql = "select * from wo_member where userid='$sessionId'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

// $userid = $row['userid'];
$name = $row['name'];
$affil = $row['affil'];
$team = $row['team'];
$mtype = $row['mtype'];

$S_userid = sqlRowOne("select userid from wo_member where team='$team' and mtype='S'");

$sql2 = "select userid, name, affil from wo_member where enable = 1 "; //현재 근무중인 직원의 이름
$result2 = mysql_query($sql2);

$members = array();

while ($row2 = mysql_fetch_array($result2)) {
	$data = array(
		'userid' => $row2['userid'],
		'name' => $row2['name'],
		'affil' => $row2['affil']
	);
	array_push($members, $data);
}




//연단위 연차/반차 사용수
if (!$f_userid)	$f_userid = $GBL_USERID;
if (!$f_year)		$f_year = date('Y');
if (!$f_month)	$f_month = date('m');
$f_day = date('d');

$day_last = Date("t", MkTime('0', '0', '0', $f_month, $f_day, $f_year));	//해당월의 마지막날

//휴일정의
// include 'lun2sol.php';

//해당 직원의 입사년도
$sql = "select * from wo_member where userid='$f_userid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$idate01 = $row['idate01'];	//년
$idate02 = $row['idate02'];	//월
$idate03 = $row['idate03'];	//일

//근무개월수
$d1 = $idate01 . '-' . $idate02 . '-' . $idate03;
$d2 = date('Y-m');
$tmpArr = Util::monthNum($d1, $d2);
$wMonth = ($tmpArr['y'] * 12) + $tmpArr['m'];

//입사일을 기준으로 근무개월 수를 수정
if ($f_day <= $idate03)	$wMonth -= 1;

//발생한 연차수
if ($wMonth < 12)				$DayOff = $wMonth;
elseif ($wMonth <= 36)		$DayOff = 15;
elseif ($wMonth <= 60)		$DayOff = 16;
elseif ($wMonth <= 84)		$DayOff = 17;
elseif ($wMonth <= 108)		$DayOff = 18;
elseif ($wMonth <= 132)		$DayOff = 19;
elseif ($wMonth <= 156)		$DayOff = 20;
elseif ($wMonth <= 180)		$DayOff = 21;
elseif ($wMonth <= 204)		$DayOff = 22;
elseif ($wMonth <= 228)		$DayOff = 23;
elseif ($wMonth <= 252)		$DayOff = 24;
else								$DayOff = 25;

//사용한 연차수
$sTime = mktime(0, 0, 0, $f_month, 1, $f_year);
$eTime = mktime(0, 0, 0, $f_month, $day_last, $f_year);

//연차사용내역
$sql = "select * from wo_dayoff where userid='$f_userid' and rTime>=$sTime and rTime<=$eTime";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

$OffArr = array();	//연차
$HalfArr = array();	//반차

for ($i = 0; $i < $num; $i++) {
	$row = mysql_fetch_array($result);
	$offType = $row['offType'];

	if ($offType == 'A') {
		$OffArr[] = $row['rTime'];
	}

	if ($offType == 'H') {
		$HalfArr[] = $row['rTime'];
	}
}

$tmpArr = Util::periodMonth($idate02, $idate03);

$syTime = $tmpArr['st'];
$eyTime = $tmpArr['et'];

//입사한 월인 경우 입사일을 기준으로 근무개월 수를 수정
if ($f_month == $idate02) {
	if ($f_day <= $idate03) {
		$syTime = strtotime('-1 year', $syTime);
		$eyTime = strtotime('-1 year', $eyTime);
	}
}

//연단위 연차/반차 사용수
$sql = "select * from wo_dayoff where userid='$f_userid' and rTime>=$syTime and rTime<=$eyTime";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

$OffNum = 0;
$HalfNum = 0;

for ($i = 0; $i < $num; $i++) {
	$row = mysql_fetch_array($result);
	$offType = $row['offType'];

	if ($offType == 'A') {
		$OffNum++;
	}

	if ($offType == 'H') {
		$HalfNum++;
	}
}

//사용 연차수
$UseOff = $OffNum + ($HalfNum * 0.5);


//남은 연차수
$ModOff = $DayOff - $UseOff;

?>

<div class="title">
	<div>
		<a href='up_index.php?type=list' class="big cbtn black">목록</a>
	</div>
</div>
<div class="write-cont">
	<form name="frm" id="frm" method="POST">
		<input type='hidden' name='userid' value='<?= $sessionId ?>' />
		<input type='hidden' name='type' value='' />
		<input type='hidden' name='upfile01' value="<?= $upfile01 ?>" />
		<input type='hidden' name='realfile01' value="<?= $realfile01 ?>" />
		<input type='hidden' name='deal1' value="" />
		<input type='hidden' name='deal2' value="" />
		<input type='hidden' name='deal3' value="" />
		<header>
			<h1>휴가신청서</h1>
			<div class="logo">
				<img src="/images/iweblogo.jpg" alt="로고">
			</div>
			<div class="submitWrap">
				<a href='javascript:submitBtn();' class="big cbtn blue">결재</a>
			</div>
		</header>

		<section>

			<div class="agreeForm">
				<div class="sign-wrap">

					<div class="deal-sign-btn">합의추가</div>

					<div class="deal-sign">

						<span id="addDealBtn" class="addBtn lnr lnr-plus-circle" onclick="addDeal()"></span>
						<span id="removeDealBtn" class="addBtn lnr lnr-circle-minus" onclick="removeDeal()"></span>
					</div>

					<div class="agree-sign">

						<span id="addAgreeBtn" class="addBtn lnr lnr-plus-circle" onclick="addAgree()"></span>
						<span id="removeAgreeBtn" class="addBtn lnr lnr-circle-minus" onclick="removeAgree()"></span>
					</div>
				</div>
				<table class="agreeTable">
					<tr>
						<th rowspan="3">결<br /><br />재</th>
						<th>담당자</th>
						<th></th>
					</tr>

					<tr>
						<td class="sign">
						</td>
						<td class="sign">
						</td>
					</tr>

					<tr>
						<td style="font-size: 16px;"><?= $name ?></td>
						<td class="agreeName">
							<select name="agree1" class="agree">
								<option value="">선택</option>
								<? for ($i = 0; $i < count($members); $i++) { ?>
									<option value="<?= $members[$i]['userid'] ?>"><?= $members[$i]['name'] ?></option>
								<? } ?>
							</select>

						</td>
					</tr>
				</table>

				<table class="dealTable">
					<tr>
						<th rowspan="3">합<br /><br />의</th>
						<th></th>
					</tr>

					<tr>
						<td class="sign">
						</td>
					<tr>
						<td class="dealName">
							<select name="deal1" class="deal">
								<option value="">선택</option>
								<? for ($i = 0; $i < count($members); $i++) { ?>
									<option value="<?= $members[$i]['userid'] ?>"><?= $members[$i]['name'] ?></option>
								<? } ?>
							</select>
						</td>
					</tr>
				</table>
			</div>

			<div class="submitForm">
				<h2>1. 문서정보</h2>
				<table class="formTable">
					<tr>
						<th>문서번호</th>
						<td>
							<!-- <input type='text' id="doc_num" name='doc_num' value= readonly> -->
						</td>
					</tr>
					<tr>
						<th>보안등급</th>
						<td>
							L2
						</td>
					</tr>
					<tr>
						<th>보존연한</th>
						<td>
							5년
						</td>
					</tr>
					<tr>
						<th>문서종류</th>
						<td>
							결재
						</td>
					</tr>
				</table>
				<table class="formTable2">
					<tr>
						<th>기안자</th>
						<td>
							<input type='text' id="name" name='name' value='<?= $name ?>' readonly>
						</td>
					</tr>
					<tr>
						<th>직급/직책 </th>
						<td>
							<input type='text' id="affil" name='affil' value='<?= $affil ?>' readonly>
						</td>
					</tr>
					<tr>
						<th style="letter-spacing: 2.5rem; text-align: right;">부서</th>
						<td>
							<input type='text' id="team" name='team' value='<?= $team ?>' readonly>
						</td>
					</tr>
					<tr>
						<th>수신처</th>
						<td>
							운영지원팀
						</td>
					</tr>
				</table>

				<h2>2. 세부내용</h2>
				<table class="inputTable">
					<tr class="inputForm">
						<th style="letter-spacing: 2.5rem; text-align: right;">제목</th>
						<td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="mainTitle" placeholder="제목"></textarea></td>
					</tr>
					<tr class="inputForm">
						<th style="letter-spacing: 2.5rem; text-align: right;">사유</th>
						<td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content" placeholder="사유"></textarea></td>
					</tr>
					<tr class="inputForm">
						<th>휴가종류 </th>
						<td id="dayoff_wrap">
							<select name="dayoff" id="dayoff" class="sort">
								<option value="" selected>선택</option>
								<option value="A">연차</option>
								<option value="H">반차</option>
								<option value="S">병가휴가</option>
								<option value="C">경조휴가</option>
								<option value="P">출산휴가</option>
								<option value="E">기타</option>
							</select>
						</td>
					</tr>
					<tr class="inputForm">
						<th style="letter-spacing: 2.5rem; text-align: right;">기간</th>
						<td id="startdate_wrap">
							<input type="text" name="date1" id="date1" class="form-control fpicker" value="" placeholder='시작 날짜'>
							<select name="sort1" id="sort1" class="form-control fpickerafter">
								<option value="">선택</option>
								<option value="연차" class="sort1-A">연차</option>
								<option value="오전">오전</option>
								<option value="오후">오후</option>
							</select>
							<span class="tilde"> ~ </span>
							<input type="text" name="date2" id="date2" class="form-control fpicker" value="" placeholder='종료 날짜'>
							<select name="sort2" id="sort2" class="form-control fpickerafter">
								<option value="">선택</option>
								<option value="연차">연차</option>
								<option value="오전">오전</option>
								<option value="오후">오후</option>
							</select>
							<!-- <input id="daterange" type="text" name="daterange" value="" /> -->
							<!-- <input type="text" name="datepicker" id="datepicker" value=""/> -->
							<span class="no_print" style="padding-left:10px;">
								<span>일 수 : </span>
								<span class="datepicker-count">0</span>
								<!-- <input type="text" class="form-control datepicker-count" name="date_cnt" value="0" style="padding: 0;"> -->
								<span style="margin-right:10px;">일</span>
								<span class="modOff"> (남은연차: </span>
								<span class="modOff" id="modOff"><?= $ModOff ?></span>
								<span class="modOff">일)</span>
							</span>
						</td>
					</tr>
					<tr class="inputForm">
						<th style="text-align: center;">직무대행자</th>
						<td id="acting_wrap">
							<select name="acting" id="acting">
								<option value="">선택</option>
								<? for ($i = 0; $i < count($members); $i++) { ?>
									<option value="<?= $members[$i]['userid'] ?>"><?= $members[$i]['name'] ?></option>
								<? } ?>
							</select>
						</td>
					</tr>
				</table>

				<h2 id="etcTitle">3. 기타</h2>
				<table class="etcTable">
					<tr>
						<th>첨부자료</th>
						<td>
							<!-- <input type='file' name='upfile01' class='file03' style='width:213px;'><? if ($userfile01) { ?><br><input type='checkbox' name='del_upfile01' value='Y'>삭제 (<?= $realfile01 ?>)<? } ?> -->
						</td>
					</tr>
					<tr>
						<th style="letter-spacing: 2.5rem; text-align: right;">의견 </th>
						<td><textarea name="opinion" id="opinion" rows="1" class="title" placeholder="의견(선택)"></textarea></td>
					</tr>
				</table>

				<table class="submitTable">
					<tr>
						<td colspan="2">
							<div class="tailContent">
								<p>위와 같이 품의하오니 재가 하여 주시기 바랍니다.</p>
								<p id="today">
									<select class="approval-date" name="approval-date1" id="approval-date1">
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
									</select>
									년
									<select class="approval-date" name="approval-date2" id="approval-date2">
										<? for ($i = 1; $i <= 12; $i++) {  ?>
											<option value="<?= $i ?>"><?= $i ?></option>
										<? } ?>
									</select>
									월
									<select class="approval-date" name="approval-date3" id="approval-date3">
										<? for ($i = 1; $i <= 31; $i++) {  ?>
											<option value="<?= $i ?>"><?= $i ?></option>
										<? } ?>
									</select>
									일
								</p>
							</div>
						</td>
					</tr>
				</table>

			</div>
		</section>

		<footer>
			<h1 style="letter-spacing: 2.5rem;">주식회사 아이웹</h1>
		</footer>
	</form>
</div>

<script>
	var numOfAgree = 1;
	var numOfDeal = 1;
	var sessionId = '<?= $sessionId ?>';
	var mtype = '<?= $mtype ?>';
	var modOff = <?= $ModOff ?>;

	// 현재 날짜
	function getTodayStr() {
		const todayYear = new Date().getFullYear();
		const todayMonth = new Date().getMonth() + 1;
		const todayDate = new Date().getDate();

		$('#approval-date1').val(todayYear).prop('selected', true);
		$('#approval-date2').val(todayMonth).prop('selected', true);
		$('#approval-date3').val(todayDate).prop('selected', true);
	}

	// 결재 테이블 추가, 제거
	function addAgree() {
		const agreeWidth = $('.agreeTable').width();
		const dealWidth = $('.dealTable').width();

		if ($('.agreeTable td.sign').length + $('.dealTable td.sign').length > 4) {
			// console.log('최대 갯수를 초과하였습니다.');
			return;

		} else {
			let th = $('.agreeTable th').last().clone();
			let sign = $('.agreeTable .sign').last().clone();
			let name = $('.agreeTable .agreeName').last().clone();

			let val = $(name[0]).children().attr('name');
			let index = parseInt(val.replace('agree', ''));

			$(th[0]).text('');
			$(name[0]).children().attr('name', 'agree' + (++index));
			$(name[0]).children().attr('class', 'agree');

			$('.agreeTable tr:nth-child(1)').append(th);
			$('.agreeTable tr:nth-child(2)').append(sign);
			$('.agreeTable tr:nth-child(3)').append(name);

			numOfAgree++;

			// 합의 추가, 제거 공간 조정
			let strPadding = $('.deal-sign').css('padding-right');
			$('.deal-sign').css('padding-right', parseInt(strPadding) + 103 + 'px');
		}
	}

	function removeAgree() {
		if (numOfAgree < 2) {
			// console.log('결재자는 한명 이상이여야 합니다.');
			return;
		} else {
			$('.agreeTable tr:nth-child(1) th').last().remove();
			$('.agreeTable tr:nth-child(2) td').last().remove();
			$('.agreeTable tr:nth-child(3) td').last().remove();

			numOfAgree--;

			// 합의 추가, 제거 공간 조정
			let strPadding = $('.deal-sign').css('padding-right');
			$('.deal-sign').css('padding-right', parseInt(strPadding) - 103 + 'px');
		}
	}

	// 합의 테이블 추가, 제거
	function addDeal() {
		const agreeWidth = $('.agreeTable').width();
		const dealWidth = $('.dealTable').width();

		if ($('.agreeTable td.sign').length + $('.dealTable td.sign').length > 4) {
			// console.log('최대 갯수를 초과하였습니다.');
			return;

		} else {
			const th = $('.dealTable th').last().clone();
			const sign = $('.dealTable .sign').last().clone();
			const name = $('.dealTable .dealName').last().clone();

			let val = $(name[0]).children().attr('name');
			let index = parseInt(val.replace('deal', ''));

			$(th[0]).text('');
			$(name[0]).children().attr('name', 'deal' + (++index));
			$(name[0]).children().attr('class', 'deal');

			$('.dealTable tr:nth-child(1)').append(th);
			$('.dealTable tr:nth-child(2)').append(sign);
			$('.dealTable tr:nth-child(3)').append(name);

			numOfDeal++;
		}
	}

	function removeDeal() {
		if ($('.dealTable td.sign').length == 1) {
			$('.dealTable').hide();
			$('.deal-sign').hide();
			$('.deal-sign-btn').show();
		}
		if (numOfDeal < 2) {
			// console.log('결재자는 한명 이상이여야 합니다.');
			return;
		} else {
			$('.dealTable tr:nth-child(1) th').last().remove();
			$('.dealTable tr:nth-child(2) td').last().remove();
			$('.dealTable tr:nth-child(3) td').last().remove();

			numOfDeal--;
		}
	}

	// 이름선택시 직급 추가하기
	function setValue(event, table) {
		const userid = event.target.value;
		const name = event.target.name;
		const index = parseInt(name.replace('agree', '').replace('deal', ''));
		const num = table === 'dealTable' ? 1 : 2;

		if (userid === '') {
			console.log('선택 하세요');
			$('.' + table + ' tr th:nth-of-type(' + (index + num) + ')').text('');
			return;
		}

		$.post('./jsonUser.php', {
			'userid': userid
		}, function(req) {
			const data = JSON.parse(req);
			const affil = data['affil'];

			if (affil == '') {
				console.log('인사관리에서 직급을 추가하여 주세요.');
				$('.' + table + ' tr th:nth-of-type(' + (index + num) + ')').text('');
				return;
			} else {
				$('.' + table + ' tr th:nth-of-type(' + (index + num) + ')').text(affil);
			}

		});
	}

	// 합의테이블
	function getCheckValue(event) {

		if (event.target.checked) {
			$('#dealTable1').css({
				"display": "table"
			});
			$('#dealTable_1').css({
				"display": "table"
			});
		} else {

			$('#dealTable1').css({
				"display": "none"
			});
			$('#dealTable_1').css({
				"display": "none"
			});
			$('#dealTable_1>tbody').css({
				"width": "0px"
			});

			//합의 체크를 풀면 리셋
			const length = $('.dTableTd select').length;
			for (let i = 1; i < length; i++) {
				$('#dealName' + i).removeClass('selected');
				$('#dealName' + i).val('');
				$('#dealName' + i + 'Hidden').val('');
				removeDeal();
			}
		}
	}

	// 결재 버튼
	function submitBtn() {

		if (mainTitle.value == "") {
			alert("제목을 입력해 주세요.")
			mainTitle.focus();
			return false;
		};

		if (content.value == "") {
			alert("사유를 입력해 주세요.")
			content.focus();
			return false;
		};

		if (dayoff.value == "") {
			alert("휴가 종류를 선택해 주세요.")
			dayoff.focus();
			return false;
		};

		if (dayoff.value == "H") {
			if ($('#date1').val() == "") {
				alert("시작 날짜를 선택해 주세요.")
				// $('#date1').focus();
				return false;
			};

			if (sort1.value == "") {
				alert("시작 날짜 시간을 선택해 주세요.")
				sort1.focus();
				return false;
			};

		} else if (dayoff.value == "A") {
			if ($('#date1').val() == "") {
				alert("시작 날짜를 선택해 주세요.")
				// $('#date1').focus();
				return false;
			};

			if (sort1.value == "") {
				alert("시작 날짜 시간을 선택해 주세요.")
				sort1.focus();
				return false;
			};

			if ($('#date2').val() == "") {
				alert("종료 날짜를 입력해 주세요.")
				// $('#date2').focus();
				return false;
			};

			if (sort2.value == "") {
				alert("종료 날짜 시간을 선택해 주세요.")
				sort2.focus();
				return false;
			};
		}

		if ($('#acting').val() == "") {
			alert("직무 대행자를 선택해 주세요.")
			$('#acting').focus();
			return false;
		};

		let agrees = $('select.agree');
		for (let i = 0; i < agrees.length; i++) {
			const agree = agrees[i];
			if ($(agree).val() == "") {
				alert("결재자를 선택해 주세요.")
				return false;
			}
		}

		let deals = $('select.deal');
		if ($('.dealTable').css('display') != "none") {
			for (let i = 0; i < deals.length; i++) {
				const deal = deals[i];
				if ($(deal).val() == "") {
					alert("합의자를 선택해 주세요.")
					return false;
				}
			}
		}

		if (confirm("휴가신청처는 수정이 불가능합니다. 정말 제출 하시겠습니까? ")) {
			const frm = document.frm;
			frm.type.value = 'write';
			frm.action = 'proc.php';
			frm.submit();
		}
	}

	function setDateSort() {
		let dayoff = $('#dayoff').val();
		if (dayoff == 'H') {
			$('#date1').show();
			$('#sort1').show();
			$('#date2').hide();
			$('#sort2').hide();
			$('.tilde').hide();
			$('#sort1').val('');
			$('#date2').val('');
			$('#sort2').val('');
			$('.sort1-A').hide();
			$('.datepicker-count').text('0');

		} else {
			$('#date1').show();
			$('#date2').show();
			$('#sort1').show();
			$('#sort2').show();
			$('.tilde').show();
			$('.sort1-A').show();
			$('.datepicker-count').text('0');
		}

		$('#modOff').text(modOff);
	}

	// 페이지 로드
	$(function() {
		$('#today').text(getTodayStr());
		$('.deal-sign-btn').click(function() {
			$('.dealTable').show();
			$('.deal-sign').show();
			$('.deal-sign-btn').hide();
		});
		setDateSort();

		// 이벤트
		$('#dayoff').on('change', () => {
			setDateSort();
		});

		$('.agreeTable').on('change', '.agree', (e) => {
			setValue(e, 'agreeTable');
		})
		$('.dealTable').on('change', '.deal', (e) => {
			setValue(e, 'dealTable');
		})

		$('#startdate_wrap').on('change', '.form-control', (e) => {
			const dayoff = $('#dayoff').val();
			const date1 = $('#startdate_wrap > #date1').val();
			const sort1 = $('#startdate_wrap > #sort1').val();
			const date2 = $('#startdate_wrap > #date2').val();
			const sort2 = $('#startdate_wrap > #sort2').val();

			/* 연차 일 계산기 */
			// 반차
			if (dayoff == 'H') {
				if (date1 != '' && sort1 != '') {
					$('.datepicker-count').text('0.5');
					$('#modOff').text(modOff - 0.5);
				}

				// 연차
			} else {
				if (date1 != '' && date2 != '') {
					const date1_y = date1.substr(0, 4);
					const date1_m = date1.substr(5, 2);
					const date1_d = date1.substr(8, 2);

					const date2_y = date2.substr(0, 4);
					const date2_m = date2.substr(5, 2);
					const date2_d = date2.substr(8, 2);

					const sDate = new Date(date1_y, date1_m - 1, date1_d);
					const eDate = new Date(date2_y, date2_m - 1, date2_d);

					if (sDate <= eDate) {
						if (sort1 != '' && sort2 != '') {
							let date_cnt = 0;
							const len = ((eDate.getTime() - sDate.getTime()) / 86400000) + 1;

							for (let i = 0; i < len; i++) {
								let rTime = sDate.getTime() + (i * 86400000);
								let rDate = new Date(rTime);

								let rDay = rDate.getDay();
								let strDate = rDate.getFullYear().toString() + ('0' + (rDate.getMonth() + 1)).slice(-2) + ('0' + rDate.getDate()).slice(-2);

								if (rDay == 0 || rDay == 6 || holidays[strDate] != undefined) {
									console.log(strDate + ' is holiday');
									continue;
								} else {
									if (i == 0) {
										date_cnt += sort1 == '연차' ? 1 : 0.5;
									} else if (i == len - 1) {
										date_cnt += sort2 == '연차' ? 1 : 0.5;
									} else {
										date_cnt += 1;
									}
								}
							}
							$('.datepicker-count').text(date_cnt);
							$('#modOff').text(modOff - date_cnt);
						} else {
							return;
						}

					} else {
						alert('날짜가 올바르지 않습니다.');
						$(e.target).val('').prop('selected', true);
						// $('#startdate_wrap > #date2').val('').prop('selected', true);
					}
				} else {
					return;
				}

			}

		});

		// 결재자 자동 설정
		if (mtype == 'M') {
			$('#addAgreeBtn').trigger('click');
			$('select[name=agree1]').val('<?= $S_userid ?>').trigger('change');
			$('select[name=agree2]').val('korea').trigger('change');
		} else {
			if (sessionId == 'korea') {
				$('select[name=agree1]').val('cho3771').trigger('change');
			} else {
				$('select[name=agree1]').val('korea').trigger('change');
			}
		}
	});
</script>
</div>