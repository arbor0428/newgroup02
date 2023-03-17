<?
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
?>
<style>
/** up_index.php */
:root {
  --main-bg-color: #e2e8f4;
  --main-border-color: #796c98;
  --sub-border-color: #f6f6f6;
}
select,
.agreeTable input,
.dealTable input {
  font-size: 16px;
  border-radius: 5px;
  background-color: #fff;
  transition: all 0.3s;
}
.agreeForm .addBtn {
  border: none;

  width: 20px;
  height: 20px;
  color: #222;
  text-align: center;
  cursor: pointer;
  box-sizing: border-box;
  display: inline-block;
  vertical-align: middle;
  line-height: 1.2;
}
.container {
  width: 1200px;
  margin: 0 auto;
}
/** write.php */
.write-cont {
  width: 100%;
  margin: 0 auto;
}

.write-cont header {
  text-align: center;
  position: relative;
  margin: 100px 0px 50px;
}

/*/////////////////////////////////////////////////////////////*/
.agreeForm {
  width: 100%;
  height: 150px;
}

.sign-wrap {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 10px;
  align-items: center;
}

.sign-wrap .deal-sign {
  padding-right: 182px;
}

.sign {
  height: 70px;
  text-align: center;
  align-items: center;
}

.agreeTable,
.dealTable {
  height: 150px;
  border-collapse: collapse;
  text-align: center;
  position: relative;
  float: right;
  font-size: 1rem !important;
}

.agreeTable th,
.dealTable th {
  height: 22px;
  font-size: 1rem !important;
}

.write-cont .sign {
  width: 100px;
  height: 90px;
}

.dealTable {
  height: 150px;
  border-collapse: collapse;
  text-align: center;
  float: right;
  margin-right: 10px;
}




.write-cont select {
/*   width: 70px;
  height: 24px; */
  border: none;
}
.write-cont select:hover {
  box-shadow: 3px 3px 3px 3px #f1f2f2;
}
.style-none th,
.style-none td {
  border: none;
  background-color: #fff;
  height: 50px;
}


.agreeTable,
.dealTable {
  border-top: 2px solid var(--main-border-color);
  border-bottom: 2px solid var(--main-border-color);
}
.agreeTable td {
  border-right: 1px solid var(--sub-border-color);
}
.agreeTable td:last-child {
  border-right: none;
}
.agreeTable th {
  background-color: var(--main-bg-color);
}

.dealTable th {
  background-color: var(--main-bg-color);
  height: 20px;
}
.agreeTable td,
.dealTable td {
  border-right: 1px solid var(--sub-border-color);
}
.dealTable td:last-child {
  border-right: none;
}
#agreeTr3 td,
#dealTr3 td {
  border-top: 1px solid var(--sub-border-color);
}
.write-cont .dojang {
  width: 50px;
  margin-top: 15px;
}
/* =========================================================== */





@media print {
  @page { margin: 0 auto; }
  body {
    width: 100%;
    font-size: 14px;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -webkit-print-color-adjust: exact;
    box-sizing: border-box;
    padding-top: 30mm;
    background: none;
  }
  .container {
    width: 100%;
  }
  .no-print,
  .no_print,
  .none_print {
    display: none;
  }

  input[type='date']::-webkit-calendar-picker-indicator {
    display: none;
  }
  .dealCheckBox {
    display: none;
  }

}




.gTable2 select {
  width: 120px;
}
.dealTable,
.deal-sign {
  display: none;
}

.deal-sign-btn {
  margin-right: 10px;
  font-size: 0.8rem;
  color: #222;
  cursor: pointer;
  background-color: var(--main-bg-color);
  display: inline-block;
  padding: 2px 4px;
  border-radius: 2px;
}

</style>

<div class="write-cont none_print">
	<form name="frm" id="frm" method="POST">
		<input type='hidden' name='userid' value='<?= $sessionId ?>' />
		<input type='hidden' name='type' value='' />
		<input type='hidden' name='deal1' value="" />
		<input type='hidden' name='deal2' value="" />
		<input type='hidden' name='deal3' value="" />
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
						<td class="sign"></td>
						<td class="sign"></td>
					</tr>
					<tr>
						<td ><?= $name ?></td>
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
						<td class="sign"></td>
					</tr>
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

	</form>
</div>

<script>
	var numOfAgree = 1;
	var numOfDeal = 1;
	var sessionId = '<?= $sessionId ?>';
	var mtype = '<?= $mtype ?>';
	var modOff = '<?= $ModOff ?>';

function selectTel (event, table) {
	const userid = event.target.value;
	const name = event.target.name;
	$.post('./jsonTel.php', {
			'userid': userid
		}, function(req) {
			const data = JSON.parse(req);
			const tel = data['tel'];
			const name = data['name'];
		});
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

		if (confirm("견적서는 수정이 불가능합니다. 정말 제출 하시겠습니까? ")) {
			const frm = document.frm;
			frm.type.value = 'write';
			frm.action = 'proc.php';
			frm.submit();
		}
	}

	

	// 페이지 로드
	$(function() {
		
		$('.deal-sign-btn').click(function() {
			$('.dealTable').show();
			$('.deal-sign').show();
			$('.deal-sign-btn').hide();
		});


		$('.agreeTable').on('change', '.agree', (e) => {
			setValue(e, 'agreeTable');
		})
		$('.dealTable').on('change', '.deal', (e) => {
			setValue(e, 'dealTable');
		})


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
