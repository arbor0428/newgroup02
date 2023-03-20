 <?
	$n_url = "./";

	//include 경로 안먹어서 넣음
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";


?>
<style>

@page {
	size:210mm 297mm; /*A4*/
	margin:0mm
 }
@media print {
		body { 
			font-size: 12px; 
			padding: 50px;
			box-sizing: border-box;
		}
		.no_print, .none_print {
			display: none !important;
		}
		select {
			border: none;
			-webkit-appearance: none; /* for chrome */
			-moz-appearance: none; /*for firefox*/
			appearance: none;
			text-align: left;
			font-size: 12px;
		}
		select::-ms-expand {
			display: none;/*for IE10,11*/
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
			padding: 5px 10px;
			font-size: 12px;
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
			margin: 30px auto 0;
		}
		#dojang {
			background: none;
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
			value="거래명세서"
			placeholder=""
		/>
	</div>

	<div class="bill_content">
		<div class="bill_top_content">
			<table class="bill_table_modify">
				<tr>
					<td>
						<input type="text" value="下記와 같이 去來합니다." />
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" placeholder="업체이름 담당자 貴下" />
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" placeholder="홈페이지 연장 대금" />
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<th rowspan="5" style="writing-mode: vertical-lr; padding: 5px">
						공급자
					</th>
				</tr>
				<tr style="border-top: none">
					<th width="100px">등록번호</th>
					<td colspan="3">
						<input type="text" id="bill_num" />
					</td>
				</tr>
				<tr>
					<th>상호</th>
					<td width="130px">아이웹</td>
					<th>성명</th>
					<td>조준</td>
				</tr>

				<tr>
					<th>사업장소재</th>
					<td colspan="3">
						서울시 마포구 매봉산로37, DMC산학협력연구센터 605호
					</td>
				</tr>

				<tr>
					<th>업태</th>
					<td>서비스업</td>
					<th>종목</th>
					<td>소프트웨어 개발</td>
				</tr>
			</table>
		</div>

		<div class="bill_bottom_content">
			<div class="row_add_wrap no_print">
				<button id="btn_row_add2" data-name="row_add2">행 추가 +</button>
			</div>

			<table class="bill_table_modify02" id="bill_tbl">
				<tr>
					<th style="width: 20%">품목</th>
					<th style="width: 5%">수량</th>
					<th style="width: 10%">단가(원)</th>
					<th style="width: 10%">부가세(원)</th>
					<th style="width: 15%">합계금액(원)</th>
					<th style="width: 0%"></th>
				</tr>

				<tr id="bill_clone_tr">
					<td>
						<textarea
							onkeydown="resize(this)"
							onkeyup="resize(this)"
							id="bill_sort1"
						></textarea>
					</td>
					<td>
						<input
							type="text"
							id="bill_quantity1"
							class="bill_quantity"
							onchange="quantityChange(id)"
						/>
					</td>
					<td>
						<input
							type="text"
							id="bill_price1"
							class="bill_price"
							onchange="transComma(); priceChange(id);"
						/>
					</td>
					<td>
						<input type="text" id="bill_surtax1" class="bill_surtax" />
					</td>
					<td>
						<input
							type="text"
							id="bill_total_price1"
							class="bill_total_price price"
						/>
					</td>
					<td id="bill_etc1"></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="bill_pay">
		<div class="bill_total">
			<p>합계</p>
			<input type="text" id="bill_total_input" style="width: 15%" />
			<p>(부가세포함)</p>
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
$(document).ready(function () {
 
  /*테이븦 열 추가*/
  $(".row_add_wrap button").click(function () {
    const btnName = $(this).data("name");

    let elName = "";
   
		if (btnName == "row_add2") {
      //거래명세서
      elName = "bill";

      console.log(elName);

      var templateClone = $(`#${elName}_clone_tr`).clone();
      let nameLen = $(`#${elName}_tbl tr`).length;
      let tdInput = templateClone.children("td").children("input, textarea");

      templateClone.attr("id", "");
      templateClone.attr("id", "bill_" + nameLen);

      templateClone
        .children("td")
        .children("input, textarea")
        .attr("value", "");
      templateClone.children("td").children("input, textarea").text("");

      templateClone
        .children("td")
        .children("select")
        .attr("id", "bill_sort_select" + nameLen);
      templateClone
        .children("td")
        .children("select")
        .css("display", "inline-block");

      tdInput.eq(0).attr("name", elName + "_sort" + nameLen);
      tdInput.eq(0).attr("id", elName + "_sort" + nameLen);
      tdInput.eq(0).val("");

      tdInput.eq(1).attr("name", elName + "_quantity" + nameLen);
      tdInput.eq(1).attr("id", elName + "_quantity" + nameLen);
      tdInput.eq(1).val("");

      tdInput.eq(2).attr("name", elName + "_price" + nameLen);
      tdInput.eq(2).attr("id", elName + "_price" + nameLen);
      tdInput.eq(2).val("");

      tdInput.eq(3).attr("name", elName + "_surtax" + nameLen);
      tdInput.eq(3).attr("id", elName + "_surtax" + nameLen);
      tdInput.eq(3).val("");

      tdInput.eq(4).attr("name", elName + "_total_price" + nameLen);
      tdInput.eq(4).attr("id", elName + "_total_price" + nameLen);
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

      $("#bill_" + nameLen).on("click", ".remove", function () {
        $(this).parent().parent().remove();
        total();
      });

      return;
    }
   
  });
  

  /***************문서 번호 조함 (년도 + 주차 )******************* */
  var result = getWeekNumber(new Date());
  let year = String(result[0]).substring(2, 4);
  //console.log("It's currently week " + result[1] + " of " + year);
  $("#bill_num").val("A" + year + "" + result[1] + "-" + "010101");
  /****************************************************************** */
});

//원 단위 정규식-------------------
function comma(num) {
  var regexp = /\B(?=(\d{3})+(?!\d))/g;
  num = num.toString().replace(regexp, ",");
  return num;
}
/**단가 콤마 찍기 */
function transComma() {
  let val = event.target.value;
  //console.log(val);
  val = val.replace(/,/gi, "");
  val = Number(val);

  event.target.value = comma(val);
}

/*texarea height resize */
function resize(obj) {
  obj.style.height = "1px";
  obj.style.height = 12 + obj.scrollHeight + "px";
}

/*수량 변경시 */
function quantityChange(id) {
  let price = 0;
	let num = $("#" + id).val();//수량
	 price = $("#" + id).parent().siblings().children(".bill_price").val(); //금액
	
	price = price.replace(/,/gi, "");
	price = Number(price);

	let totalPrice1 = price*num; //부가세 미포함 총금액(금액 *수량)
	
	let surtax = price*0.1;//부가세
	$("#" + id).parent().siblings().children(".bill_surtax").val(surtax);//부가세 입력	

	let totalSurtax = surtax*num;//총 부과세(부가세 * 수량)

	let totalPrice =totalPrice1 + totalSurtax;// 총금액 (총 단가 + 총 부가세)

	$("#" + id).parent().siblings().children(".bill_total_price").val(comma(totalPrice)); //합계금액 입력

	//토탈계산
	total();

	return;

}

/*단가 수정시 */
function priceChange(id) {
  let idNum = ""; 
	idNum = id.slice(-1, id.length);

	id = "bill_quantity" + idNum;
  quantityChange(id);
}

/**토탈계산 함수 */
function total() {

  let totalPrice = 0;
  let check = /^[0-9]/g; //숫자인지 검사
  var regex = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;

  for (i = 0; i < $(".price").length; i++) {
    let prices = $(".price").eq(i).val();
    prices = prices.replace(/,/gi, "");
    prices = Number(prices);

    totalPrice = totalPrice + prices;
  }
  $("#bill_total_input").val(comma(totalPrice));
}

//주차계산
function getWeekNumber(d) {
  // Copy date so don't modify original
  d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
  // Set to nearest Thursday: current date + 4 - current day number
  // Make Sunday's day number 7
  d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
  // Get first day of year
  var yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
  // Calculate full weeks to nearest Thursday
  var weekNo = Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
  // Return array of year and week number
  return [d.getUTCFullYear(), weekNo];
}









</script>