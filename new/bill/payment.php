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
		margin: 30px auto 0;
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
	.bill_total {    justify-content: space-between;}
	.bill_bottom_content table.bill_pay {border-top:none; border-bottom: none;}
	table.bill_pay th {background-color: none !important;}
	.bill_table_modify02 select {text-align: left;}
.bill_sort {border-bottom: none !important;}
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
					value="주식회사 아이웹"
					placeholder=""
				/>
			</div>

			<div class="bill_content">
				<div class="bill_top_content">
					<table class="bill_table_modify2">
						<tr>
							<th>수 신</th>
							<td>
								<input type="text" value="" placeholder="업체이름" />
							</td>
						</tr>
						<tr>
							<th>담당자</th>
							<td>
								<input type="text" placeholder="홈페이지 담당자님" />
							</td>
						</tr>
						<tr>
							<th>제 목</th>
							<td>
								<input
									type="text"
									placeholder="홈페이지(주소) 제작 잔금을 청구합니다."
								/>
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
					<table class="bill_table_modify2">
						<tr>
							<th style="width: 25%">홈페이지 만료일</th>
							<td style="width: 25%">
								<input type="text" placeholder="2024. 01. 01" />
							</td>
							<th style="width: 25%">도메인 만료일</th>
							<td style="width: 22%">
								<input type="text" />
							</td>
						</tr>
					</table>
				</div>

				<div class="bill_bottom_content">
					<table class="bill_pay"style="margin: 0; width: 48%; margin-left: auto">
						<tr class="bill_total">
							<th style="width: 25%">합계</th>
							<td style="text-align: right">
								<input type="text" id="bill_total_input" style="width: 63%" />
								<span>원 (부가세포함)</span>
							</td>
						</tr>
					</table>
					<div class="row_add_wrap no_print">
						<button id="btn_row_add" data-name="row_add">행 추가 +</button>
					</div>

					<table class="bill_table_modify02" id="bill_tbl">
						<tr>
							<th style="width: 20%">구분</th>
							<th style="width: 20%">비용(원)</th>
							<th style="width: 10%">기간</th>
							<th style="width: 20%">합계(원 /VAT 포함)</th>
							<th style="width: 20%">
								<input tyep="text" placeholder="비고 / 만료일" required style="text-align: center;"/>
							</th>
							<th style="width: 0%"></th>
						</tr>

						<tr id="bill_clone_tr">
							<td>
								<select id="bill_sort_select1" onchange="selectBox(value)">
									<option value="">선택</option>
									<option value="traffic">
										웹호스팅,트래픽관리, 백업관리,보안관리
									</option>
									<option value="domain">도메인</option>
									<option value="self">직접입력</option>
								</select>

								<textarea
									onkeydown="resize(this)"
									onkeyup="resize(this)"
									id="bill_sort1"
									class="bill_sort"
								></textarea>
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
								<input
									type="text"
									id="bill_period1"
									class="bill_period"
									onchange="changePeriod(value)"
								/>
							</td>

							<td>
								<input
									type="text"
									id="bill_total_price1 "
									class="bill_total_price price"
									onchange="total()"
								/>
							</td>
							<td>
								<input type="text" id="bill_etc1" class="bill_etc" />
							</td>
							<td id="bill_button1"></td>
						</tr>
					</table>
				</div>
			</div>

			<div class="bill_bottom_list">
				<ul>
					<li>
						<p>수취인 통장</p>
						국민은행 011201-04-131424
					</li>
					<li>
						<p>예금주</p>
						㈜아이웹
					</li>
					<li>
						<p style="width: 100%">
							아이웹 홈페이지에서 [추가요금결제]를 통해 카드로도 결제가
							가능합니다.
						</p>
					</li>
					<li>
						<p>담당자</p>
						<input type="text" placeholder="담당자입력" />
					</li>
					<li>
						<p>회신연락처</p>
						<textarea
							onkeydown="resize(this)"
							onkeyup="resize(this)"
							placeholder="회신 연락처를 입력해 주세요"
							required
							style="padding: 0;"
						></textarea>
					</li>
				</ul>
			</div>
		 <div class="bill_footer">
				<h1>
					주식회사 아이웹&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;대표이사&nbsp;&nbsp;&nbsp;조&nbsp;&nbsp;준&nbsp;&nbsp;&nbsp;
					<span id="dojang" style="">(인)</span>
				</h1>
			</div>
		</div>

		<div class="bank_img">
			<img src="/new/images/bank.png" />
		</div>
	</div>
</div>

<script>
	$('.print_btn').click(function () {
			window.print();
	});

	const domain = {
		name: "도메인",
		price: 22000,
		year: 1,
	};
	$(document).ready(function () {
		
		/*테이븦 열 추가*/
		$(".row_add_wrap button").click(function () {
			const btnName = $(this).data("name");

			let elName = "";

			if (btnName == "design") {
				elName = "design";
			} else if (btnName == "program") {
				elName = "program";
			} else if (btnName == "service") {
				elName = "service";
			} else if (btnName == "row_add") {
				//거래명세서
				elName = "bill";

				console.log(elName);

				var templateClone = $(`#${elName}_clone_tr`).clone();
				let nameLen = $(`#${elName}_tbl tr`).length;
				let tdInput = templateClone.children("td").children("input, textarea");

				templateClone.attr("id", "");
				templateClone.attr("id", "bill_" + nameLen);

				templateClone.children("td").children("input, textarea").attr("value", "");
				templateClone.children("td").children("input, textarea").text("");

				templateClone.children("td").children("select").attr("id", "bill_sort_select" + nameLen);
				templateClone.children("td").children("select").css("display", "inline-block");
				templateClone.children("td").children("textarea").css("display", "none");

				tdInput.eq(0).attr("name", elName + "_sort" + nameLen);
				tdInput.eq(0).attr("id", elName + "_sort" + nameLen);
				tdInput.eq(0).val("");

				tdInput.eq(1).attr("name", elName + "_price" + nameLen);
				tdInput.eq(1).attr("id", elName + "_price" + nameLen);
				tdInput.eq(1).val("");

				tdInput.eq(2).attr("name", elName + "_period" + nameLen);
				tdInput.eq(2).attr("id", elName + "_period" + nameLen);
				tdInput.eq(2).val("");

				tdInput.eq(3).attr("name", elName + "_total_price" + nameLen);
				tdInput.eq(3).attr("id", elName + "_total_price" + nameLen);
				tdInput.eq(3).val("");

				tdInput.eq(4).attr("name", elName + "_etc1" + nameLen);
				tdInput.eq(4).attr("id", elName + "_etc1" + nameLen);
				tdInput.eq(4).val("");

				tdInput.eq(5).attr("name", elName + "_total_price" + nameLen);
				tdInput.eq(5).attr("id", elName + "_total_price" + nameLen);
				tdInput.eq(5).val("");

				templateClone.children("td").last().attr("name", elName + "_button" + nameLen);
				templateClone.children("td").last().attr("id", elName + "_button" + nameLen);
				templateClone.children("td").last().append('<button class="remove">삭제</button>'); 

				$(`#${elName}_tbl`).append(templateClone);

				$("#bill_" + nameLen).on("click", ".remove", function () {
					$(this).parent().parent().remove();
					total();
				});

				return;
			}
			
		});

		$("#proposal_bill_input").change(function () {
			let proposalPrice = $(this).val();
			if (proposalPrice.includes("원")) {
				proposalPrice = proposalPrice.replace("");
			}
			$(this).val(comma(proposalPrice));
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
		let valName = "";

		let check = /^[0-9]+$/; //숫자인지 검사


			price = $("#" + id).val();

				price = $("#" + id).parent().siblings().children(".bill_price").val();
				valName = "bill";

				price = price.replace(/,/gi, "");
				// price = price.replace("원", "");
				price = Number(price);

				let period = $("#" + id).val();

				period = period.replace("년", "");

				period = Number(period);//기간

				let total = 0;

				let surtax = price * 0.1;//부가세

				console.log(surtax)

				let surtaxTotal =  surtax *period;//부가세 * 기간

				total = surtaxTotal + period;

				$("#" + id).parent().siblings().children(".bill_total_price").val(comma(total));
				
				total();

	}

	/*단가 수정시 */
	function priceChange(id) {
		let idNum = "";

		idNum = id.slice(-1, id.length);

		let value = $('#' + id).parent().siblings().children('.bill_period').val();

		console.log(value);

		changePeriod(value);
	}

	/**토탈계산 함수 */
	function total() {
		console.log("change");
		let totalPrice = 0;
		let check = /^[0-9]/g; //숫자인지 검사
		var regex = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;

		for (i = 0; i < $(".price").length; i++) {
			let prices = $(".price").eq(i).val();
			prices = prices.replace(/,/gi, "");
			// prices = prices.replace("원", "");
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



	

	function resizeInput(id_name) {
		let idName = id_name;
		let num = "";
		let parent = "";
		//console.log(idName);
		if (idName == "company_name1") {
			num = 4;
			parent = ".company_name_wrap";
		} else if (idName == "first_price1") {
			parent = ".list_row_inner .input_row";
		} else if (idName == "price_maintenance1") {
			num = 3;
			parent = ".list_row_inner .input_row";
		}

		var value = $("#" + idName).val();

		$(parent).append(
			`<div style="display: inline-block"id="virtual_dom${num}">` +
				value +
				"</div>"
		);

		var inputWidth = $("#virtual_dom" + num).width() + 16; // 글자 하나의 대략적인 크기

		$("#" + idName).css("width", inputWidth);

		$("#virtual_dom" + num).remove();
	}
	function autoInput(event) {
		const targetId = event.target.id;
		const companyName = $("#" + targetId).val();
		for (i = 0; i < $(".company_name").length; i++) {
			$(".company_name").eq(i).val(companyName);
		}
	}
	function selectBox(value) {
		let id = event.target.id;
		let textarea = $("#" + id).siblings("textarea");
		if (value == "self") {
			$("#" + id)
				.parent()
				.siblings()
				.children("input, textarea")
				.val("");
			$("#" + id)
				.parent()
				.siblings()
				.children("input, textarea")
				.text("");
			textarea.css({
				display: "inline-block",
				"border-bottom": "1px solid #ddd",
			});
			event.target.style.display = "none";

			total();
		} else if (value == "traffic") {
			$("#" + id)
				.parent()
				.siblings()
				.children("input, textarea")
				.val("");
			$("#" + id)
				.parent()
				.siblings()
				.children("input, textarea")
				.text("");

			total();
		} else if (value == "domain") {
			$("#" + id)
				.parent()
				.siblings()
				.children(".bill_price")
				.val(comma(domain.price));

			$("#" + id)
				.parent()
				.siblings()
				.children(".bill_total_price")
				.val(comma(domain.price * 0.1 + domain.price));

			$("#" + id)
				.parent()
				.siblings()
				.children(".bill_period")
				.val(domain.year + "년");

			total();
		}
	}
	function changePeriod(value) {

	
		let id = event.target.id;
let price ='';
		value = value.replace(/,/gi, "");
		value = value.replace("년", "");
		value = value.replace("개월", "");

		if(id.includes('price')){
			price = $("#" + id).val();
			
		}else {
			price = $("#" + id).parent().siblings().children(".bill_price").val();
		}

		price = price.replace(/,/gi, "");

		let surtax = price*0.1;//부가세
		console.log('surtax;'+surtax)
		let totalSurtax = surtax * value;//총부가세 (수량 * 부가세)

		let totalPrice = 0;

		totalPrice = value * price;

		totalPrice= totalPrice+totalSurtax;

		$("#" + id).parent().siblings().children(".bill_total_price").val(comma(totalPrice));

		total();
	}

</script>