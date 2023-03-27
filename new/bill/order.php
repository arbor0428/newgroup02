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
				box-sizing: border-box;
				padding: 50px 0 ;
			}
			.content_head {
				display: none;
			}
			.wrap {
				width: 100%;
			}
			.bill_content_wrap {
				width: 100%;
				box-shadow: none;
				margin: 0;
				padding: 0;
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
				font-size: 12px !important;
				height: auto !important;
			}
			.header {
				display: none;
			}
			.bill {
				width: 90%;
				margin: 0 auto; 
				font-size: 12px;
			}		
			.bill_title input[type="text"]{
				font-size: 24px !important;
				
			}
		.bill_top_content table th,
		.bill_bottom_content table th,
		.bill_top_content table td,
		.bill_bottom_content table td,
		table.order_top_tbl th,
		table.order_top_tbl td{
				padding: 5px 10px;
				font-size: 12px;
		}

		.bill_table_modify input[type="text"],
		.bill_table_modify2 input[type="text"],
		.bill_table_modify02 input[type="text"],
		.bill_bottom_content input[type="text"],
		.bill_total,
		#bill_total_input,
		.bill_bottom_content textarea{
			font-size: 12px;
			border:none;

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
			margin: 10px auto 0;
		}
		#dojang {
			background: none;
		}
		.bill_bottom_content {
			margin:20px 0;
		}
		.bill_bottom_content table.bill_table_modify02 ,
		.bill_bottom_list{
			margin-top:20px;
		}
		.bill_table_modify02 select {border:none;}
		.bill_bottom_list ul li {font-size: 12px;}
		.bill_bottom_list ul li textarea{
			padding: 0;
			font-size:12px;
			
		}
		.bank_img img {width: 80%; padding-top: 50px;}
		.bill_total {    justify-content: end;     align-items: center;}
		.bill_total input {text-align: end;}
		.bill_bottom_content table.bill_pay {border-top:none; border-bottom: none;}
		table.bill_pay th {background-color: none !important;}
		.bill_table_modify02 select {text-align: left;}
		.bill_sort {border-bottom: none !important;}
		#bill_total_input {width: 20%;}
	}
</style>
<div class="wrap bill_wrap">
	<?
		include $_SERVER["DOCUMENT_ROOT"]."/new/top_header.php";
	?>

	<div class="bill_content_wrap"> 
		<div class="bill">
			<img src="/images/iweblogo.jpg" class="bill_logo" />
			<button class="print_btn no_print">인쇄</button>

			<div class="bill_title">
				<input
					type="text"
					name="biil_title"
					value=""
					placeholder="구매품의서"
				/>
			</div>
			

			<div class="bill_content">
				<div class="bill_top_content">
					<table>
						<tr style="border-top: none">
							<th width="100px">문서번호</th>
							<td colspan="3">
								<input type="text" id="bill_num" />
							</td>
						</tr>
						<tr>
							<th>부서</th>
							<td>
								<input type="text" id=""/>
							</td>
						</tr>
						<tr>
							<th>기안일</th>
							<td><input type="text" id=""/></td>
						</tr>
						<tr>
							<th>기안자</th>
							<td><input type="text" id=""/></td>
						</tr>
					</table>
				</div>

				<div class="order_wrap">
					<table class="order_top_tbl">
						<tr>
							<th>제목</th>
							<td colspan="7">
								<input type="text" id="" name="" style="text-align: left;"/>
							</td>
						</tr>
						<tr>
							<th rowspan="2">구매요청부서</th>
							<td rowspan="2">
								<input type="text" id="" name="" />
							</td>
							<th rowspan="2">납품요청기한</th>
							<td rowspan="2">
								<input type="text" id="" name="" />
							</td>

							<th rowspan="2" style="writing-mode: vertical-lr">발주</th>
							<th>연락처</th>
							<td colspan="2">
								<input type="text" id="" name="" />
							</td>
						</tr>
						<tr>
							<th>일자</th>
							<td colspan="2"> 
								<input type="text" id="" name="" />
							</td>
						</tr>
						<tr>
							<th>대금지불방법</th>
							<td>
								<input type="text" id="" name="" />
							</td>
							<th>남품기간</th>
							<td colspan="4">
								<input type="text" id="" name="" />
							</td>
						</tr>

						<tr>
							<th>사용목적</th>
							<td colspan="7">
								<textarea onkeydown="resize(this)" onkeyup="resize(this)" style="border:none; text-align: left; resize: none;"></textarea>
							</td>
						</tr>
					</table>
				</div>

				<div class="bill_bottom_content ">
					<div class="row_add_wrap no_print">
						<button id="btn_order" data-name="order">행 추가 +</button>
					</div>

					<table id="order_list_tbl">
						<tr>
							<th width="5%">번호</th>
							<th width="*">품명</th>
							<th width="10%">규격</th>
							<th width="10%">수량</th>
							<th width="20%">단가(원)</th>
							<th width="20%">비고</th>
							<th style="width: 0;"></th>
						</tr>

						<tr id="order_list_tr">
							<td>
								<input type="text" id="order_list_num1" name="order_list_num1" value="1" />
							</td>
							<td>
								<input type="text" id="order_list_name1" name="order_list_name1" />
							</td>
							<td>
								<input type="text" id="order_list_standard1" name="order_list_standard1" />
							</td>
							<td>
								<input type="text" id="order_list_quantity1" name="order_list_quantity1" class="order_list_quantity" onchange="quantityChange(id)" />
							</td>
							<td>
								<input type="text" id="order_list_price1" name="order_list_price1" class="order_list_price" onchange="transComma(); quantityChange(id);" />
								<input type="hidden" id="order_list_total1" name="order_list_total1" class="order_list_total price" />
							</td>
							<td>
								<textarea type="text" id="order_list_etc1" name="order_list_etc1" onkeydown="resize(this)" onkeyup="resize(this)"></textarea>
							</td>
							<td id="order_list_button1"></td>
						</tr>
					</table>

				</div>
			</div>

			<div class="note_wrap">
				<p>특이사항</p>
				<textarea onkeydown="resize(this)" onkeyup="resize(this)" style="margin-top: 10px;"></textarea>
			</div>

			<div class="bill_pay">
				<div class="bill_total">
					<p>합계</p>
					<input type="text" id="bill_total_input" style="width: 50%"/>
				</div>
			</div>
		</div>
		 <div class="bill_footer">
			<h1>
				주식회사 아이웹&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;대표이사&nbsp;&nbsp;&nbsp;조&nbsp;&nbsp;준&nbsp;&nbsp;&nbsp;
				<span id="dojang" style="">(인)</span>
			</h1>
		</div>
	</div>
</div>
<script>
	$('.print_btn').click(function () {
			window.print();
	});
	/*테이블 행 추가*/
	$(document).ready(function () {
	$(".row_add_wrap button").click(function () {
		//const btnName = $(this).data("name");

		let elName = "order_list";

		var templateClone = $(`#${elName}_tr`).clone();
		let nameLen = $(`#${elName}_tbl tr`).length;
		let tdInput = templateClone.children("td").children("input, textarea");

		templateClone.attr("id", "");
		templateClone.attr("id", "order_list_tr" + nameLen);

		templateClone.children("td").children("input, textarea").attr("value", "");
		templateClone.children("td").children("input, textarea").text("");

		tdInput.eq(0).attr("name", elName + "_num" + nameLen);
		tdInput.eq(0).attr("id", elName + "_num" + nameLen);
		tdInput.eq(0).val(nameLen);

		tdInput.eq(1).attr("name", elName + "_name" + nameLen);
		tdInput.eq(1).attr("id", elName + "_name" + nameLen);
		tdInput.eq(1).val("");

		tdInput.eq(2).attr("name", elName + "_standard" + nameLen);
		tdInput.eq(2).attr("id", elName + "_standard" + nameLen);
		tdInput.eq(2).val("");

		tdInput.eq(3).attr("name", elName + "_quantity" + nameLen);
		tdInput.eq(3).attr("id", elName + "_quantity" + nameLen);
		tdInput.eq(3).val("");

		tdInput.eq(4).attr("name", elName + "_list_price" + nameLen);
		tdInput.eq(4).attr("id", elName + "_list_price" + nameLen);
		tdInput.eq(4).val("");

		tdInput.eq(5).attr("name", elName + "_list_etc" + nameLen);
		tdInput.eq(5).attr("id", elName + "_list_etc" + nameLen);
		tdInput.eq(5).val("");

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

		$(`#order_list_tbl`).append(templateClone);

		$("#order_list_tr" + nameLen).on("click", ".remove", function () {
			$(this).parent().parent().remove();

			total();
		});
	});
	});

	/*texarea height resize */
	function resize(obj) {
	obj.style.height = "1px";
	obj.style.height = 12 + obj.scrollHeight + "px";
	}
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
	/*단가 수정시 */
	// function priceChange(id) {
	//   quantityChange(id);
	// }
	/*수량 변경시 */
	function quantityChange(id) {
	let price = 0;
	let quantity = 0;

	if (id.includes("quantity")) {
		quantity = $("#" + id).val();

		quantity = Number(quantity);

		price = $("#" + id)
			.parent()
			.siblings()
			.children(".order_list_price")
			.val();

		price = price.replace(/,/gi, "");
		price = Number(price);

		let totalPrice = quantity * price;

		$("#" + id)
			.parent()
			.siblings()
			.children(".order_list_total")
			.val(totalPrice);
		total();
		return;
	}
	if (id.includes("price")) {
		price = $("#" + id).val();

		price = price.replace(/,/gi, "");
		price = Number(price);

		quantity = $("#" + id)
			.parent()
			.siblings()
			.children(".order_list_quantity")
			.val();
		quantity = Number(quantity);

		let totalPrice = quantity * price;

		$("#" + id)
			.siblings(".order_list_total")
			.val(totalPrice);
		total();
		return;
	}

	console.log(totalPrice);

	// console.log(
	//   $("#" + id)
	//     .parent()
	//     .siblings()
	//     .children(".order_list_total")
	//     .val()
	// );

	// total();
	}
	/**토탈계산 함수 */
	function total() {
	let totalPrice = 0;

	for (i = 0; i < $(".price").length; i++) {
		let prices = $(".price").eq(i).val();
		prices = prices.replace(/,/gi, "");

		prices = Number(prices);

		totalPrice = totalPrice + prices;
		//console.log(prices);
	}

	$("#bill_total_input").val(comma(totalPrice));
	}

</script>