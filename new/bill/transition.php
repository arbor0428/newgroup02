 <?
	$n_url = "./";

	//include 경로 안먹어서 넣음
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";

?>
<style>

table.transition_table select {
	width: 100%;
}
@page {
	size:210mm 297mm; /*A4*/
	margin:0mm
 }
@media print {
		body { 
			font-size: 12px; 
		/* 	padding: 50px; */
			box-sizing: border-box;
		}
		.no_print, .none_print {
			display: none !important;
		}
		select {
			border :none !important;
			font-size: 12px !important;
			text-align: center !important;
		}
		select::-ms-expand {
			border:none;
			font-size: 12px;
		}
		input {
			font-size: 12px;
		}
		.header {
			display: none;
		}
		.bill {
			margin: -0px 0 0; 
			font-size: 12px;
		}		
		.bill_title input[type="text"]{
			font-size: 24px;
		}
		.bill_top_content table th,
		.bill_bottom_content table th,
		.bill_top_content table td,
		.bill_bottom_content table td{
				padding: 0px 10px !important;
				font-size: 12px !important;
		}

		.bill_table_modify input[type="text"],
		.bill_total,
		#bill_total_input{
			font-size: 12px;
		}
		table th {
			background-color:#e2e8f4 !important;
			-webkit-print-color-adjust:exact;
		}
		.bill_pay {
				width: 100%;
				margin-top:50px;
			}
			.bill_footer {
				margin: 50px auto 0;
			}
			#dojang {
				background: none;
			}
			textarea {
				font-size: 12px !important;
				text-align: center !important;
			}

	}
</style>

<div class="bill">
	<img src="/images/iweblogo.jpg" class="bill_logo" />
	<button class="print_btn no_print">인쇄</button>

	<div class="bill_title">
		<input
			type="text"
			name="biil_title"
			value="인수인계서"
			placeholder=""
		/>
	</div>

		<?
			include 'agree.php';
		?>


	<div class="row_add_wrap no_print">
		<button id="btn_row_add3" data-name="row_add3">행 추가 +</button>
	</div>
	<div class="bill_content">
		<div class="bill_top_content">
			<table class="transition_table" id="work_tbl">
				<tr>
					<th width="8%">구 분</th>
					<th width="15%">성 명</th>
					<th width="15%">부 서</th>
					<th width="15%">직 급</th>
					<th width="15%">확인날짜</th>
					<th width="*">비 고</th>
					<th width="10%">확 인</th>
					<th style="width: 0"></th>
				</tr>
				<tr id="work_tr">
					<th>
						<input
							type="text"
							placeholder=""
							value="인계자"
							name=""
							id="work_sort"
							style="text-align:center;"
						/>
					</th>
					<td>
						<select id="work_person_select1" onchange="setInfo(id)">
								<option value="">선택</option>
								<? for ($i = 0; $i < count($members); $i++) { ?>
								<option value="<?= $members[$i]['userid'] ?>"><?= $members[$i]['name'] ?></option>
								<? } ?>
						</select>
					</td>
					<td>
						<input type="text" name="work_team1" id="work_team1" class="work_team"/>
					</td>
					<td>
						<input type="text" name="work_affi1" id="work_affi1" class="work_affi"/>
					</td>
					<td>
						<input type="text" name="work_date1" id="work_date1" />
					</td>
					<td>
						<textarea id="work_etc1" name="work_etc1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1"></textarea>
					</td>
					<td>
						<div class="sign">(인)</div>
					</td>
					<td id="work_button1"></td>
				</tr>
			</table>
		</div>

		<div class="bill_bottom_content">
			<div class="row_add_wrap no_print">
				<button id="row_add5" data-name="row_add5">행 추가 +</button>
			</div>

			<table class="transition_table" id="work2_tbl">
				<tr>
					<th width="5%">번호</th>
					<th width="15%">구분</th>
					<th width="15%">업무 항목</th>
					<th width="*">주요진행 사항 및 전달 사항</th>
					<th width="*">관련 서류 (경로)</th>
					<th style="width: 0%"></th>
				</tr>

				<tr id="work2_tr">
					<td>
						<input
							type="number"
							value="1"
							id="work2_num1"
							name="work2_num1"
							style="text-align: center"
						/>
					</td>
					<td>
						<textarea id="work2_sort1" name="work2_sort1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1""></textarea>
					</td>
					<td>
						<textarea id="work2_work1" name="work2_work1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1"></textarea>
					</td>
					<td>
						<textarea id="work2_ment1" name="work2_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1"></textarea>
					</td>
					<td>
						<textarea id="work2_url1" name="work2_url1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1"></textarea>
					</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>

 <div class="bill_footer">
		<h1>
			주식회사 아이웹&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;대표이사&nbsp;&nbsp;&nbsp;조&nbsp;&nbsp;준&nbsp;&nbsp;&nbsp;
			<span id="dojang" style="">(인)</span>
		</h1>
	</div>
</div>


<script>
$('.print_btn').click(function () {
		window.print();
});
/*테이븦 열 추가*/
$(document).ready(function () {
  $(".row_add_wrap button").click(function () {
    const btnName = $(this).data("name");

    let elName = "";

    console.log(btnName);

    if (btnName == "row_add3") {
      elName = "work";
      var templateClone = $(`#${elName}_tr`).clone();
      let nameLen = $(`#${elName}_tbl tr`).length;
      let tdInput = templateClone.children("td").children("input, textarea");

      templateClone.attr("id", "");
      templateClone.attr("id", "work_tr" + nameLen);

      templateClone
        .children("td")
        .children("input, textarea")
        .attr("value", "");
      templateClone.children("td").children("input, textarea").text("");

      templateClone.children("th").children("input").attr("value", "");
      templateClone.children("th").children("input").text("");

      templateClone
        .children("td")
        .children("select")
        .attr("id", "work_person_select" + nameLen);

      tdInput.eq(0).attr("name", elName + "_team" + nameLen);
      tdInput.eq(0).attr("id", elName + "_team" + nameLen);
      tdInput.eq(0).val("");

      tdInput.eq(1).attr("name", elName + "_affi" + nameLen);
      tdInput.eq(1).attr("id", elName + "_affi" + nameLen);
      tdInput.eq(1).val("");

      tdInput.eq(2).attr("name", elName + "_date" + nameLen);
      tdInput.eq(2).attr("id", elName + "_date" + nameLen);
      tdInput.eq(2).val("");

      tdInput.eq(3).attr("name", elName + "_etc" + nameLen);
      tdInput.eq(3).attr("id", elName + "_etc" + nameLen);
      tdInput.eq(3).val("");

      templateClone
        .children("td")
        .last()
        .attr("name", elName + "_button" + nameLen);
      templateClone
        .children("td")
        .last()
        .attr("id", elName + "_button" + nameLen);
      templateClone
        .children("td")
        .last()
        .append('<button class="remove">삭제</button>');
      $(`#${elName}_tbl`).append(templateClone);

      $("#work_tr" + nameLen).on("click", ".remove", function () {
        $(this).parent().parent().remove();
      });
    } else if (btnName == "row_add5") {
      elName = "work2";

      var templateClone = $(`#${elName}_tr`).clone();
      let nameLen = $(`#${elName}_tbl tr`).length;
      let tdInput = templateClone.children("td").children("input, textarea");

      templateClone.attr("id", "");
      templateClone.attr("id", "work2_tr" + nameLen);

      templateClone
        .children("td")
        .children("input, textarea")
        .attr("value", "");
      templateClone.children("td").children("input, textarea").text("");

      tdInput.eq(0).attr("name", elName + "_num" + nameLen);
      tdInput.eq(0).attr("id", elName + "_num" + nameLen);
      tdInput.eq(0).val(nameLen);

      tdInput.eq(1).attr("name", elName + "_sort" + nameLen);
      tdInput.eq(1).attr("id", elName + "_sort" + nameLen);
      tdInput.eq(1).val("");

      tdInput.eq(2).attr("name", elName + "_work" + nameLen);
      tdInput.eq(2).attr("id", elName + "_work" + nameLen);
      tdInput.eq(2).val("");

      tdInput.eq(3).attr("name", elName + "_ment" + nameLen);
      tdInput.eq(3).attr("id", elName + "_ment" + nameLen);
      tdInput.eq(3).val("");

      tdInput.eq(4).attr("name", elName + "_url" + nameLen);
      tdInput.eq(4).attr("id", elName + "_url" + nameLen);
      tdInput.eq(4).val("");

      templateClone
        .children("td")
        .last()
        .attr("name", elName + "_button" + nameLen);
      templateClone
        .children("td")
        .last()
        .attr("id", elName + "_button" + nameLen);
      templateClone
        .children("td")
        .last()
        .append('<button class="remove">삭제</button>');
      $(`#${elName}_tbl`).append(templateClone);

      $("#work2_tr" + nameLen).on("click", ".remove", function () {
        $(this).parent().parent().remove();
      });
    }
  });
});
	// 이름선택시 직급/팀 추가하기
	function setInfo(id) {
		const userid = event.target.value;
		console.log(id)
		const workTeamEl = 	$('#'+id).parent().siblings().children('.work_team');
		const workAffiEl = 	$('#'+id).parent().siblings().children('.work_affi');
		$.post('./jsonUser.php', {
			'userid': userid
		}, function(req) {
			const data = JSON.parse(req);

			const workTeam = data['team'];
			const workAffil = data['affil'];
			
			
			workTeamEl.val(workTeam); 
			workAffiEl.val(workAffil); 

		});
	}

/*texarea height resize */
function resize(obj) {
  obj.style.height = "1px";
  obj.style.height = 12 + obj.scrollHeight + "px";
}
</script>