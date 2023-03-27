<?
	$n_url = "./";

	//include ��� �ȸԾ ����
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
			<button class="print_btn no_print">�μ�</button>
			<div class="bill_title">
				<input
					type="text"
					name="biil_title"
					value="�ֽ�ȸ�� ������"
					placeholder=""
				/>
			</div>

			<div class="bill_content">
				<div class="bill_top_content">
					<table class="bill_table_modify2">
						<tr>
							<th>�� ��</th>
							<td>
								<input type="text" value="" placeholder="��ü�̸�" />
							</td>
						</tr>
						<tr>
							<th>�����</th>
							<td>
								<input type="text" placeholder="Ȩ������ ����ڴ�" />
							</td>
						</tr>
						<tr>
							<th>�� ��</th>
							<td>
								<input
									type="text"
									placeholder="Ȩ������(�ּ�) ���� �ܱ��� û���մϴ�."
								/>
							</td>
						</tr>
					</table>
					<table>
						<tr>
							<th rowspan="5" style="writing-mode: vertical-lr; padding: 5px">
								������
							</th>
						</tr>
						<tr style="border-top: none">
							<th width="100px">��Ϲ�ȣ</th>
							<td colspan="3">
								<input type="text" id="bill_num" />
							</td>
						</tr>
						<tr>
							<th>��ȣ</th>
							<td width="130px">������</td>
							<th>����</th>
							<td>����</td>
						</tr>

						<tr>
							<th>��������</th>
							<td colspan="3">
								����� ������ �ź����37, DMC�������¿������� 605ȣ
							</td>
						</tr>

						<tr>
							<th>����</th>
							<td>���񽺾�</td>
							<th>����</th>
							<td>����Ʈ���� ����</td>
						</tr>
					</table>
				</div>
				<div class="bill_bottom_content">
					<table class="bill_table_modify2">
						<tr>
							<th style="width: 25%">Ȩ������ ������</th>
							<td style="width: 25%">
								<input type="text" placeholder="2024. 01. 01" />
							</td>
							<th style="width: 25%">������ ������</th>
							<td style="width: 22%">
								<input type="text" />
							</td>
						</tr>
					</table>
				</div>

				<div class="bill_bottom_content">
					<table class="bill_pay"style="margin: 0; width: 48%; margin-left: auto">
						<tr class="bill_total">
							<th style="width: 25%">�հ�</th>
							<td style="text-align: right">
								<input type="text" id="bill_total_input" style="width: 63%" />
								<span>�� (�ΰ�������)</span>
							</td>
						</tr>
					</table>
					<div class="row_add_wrap no_print">
						<button id="btn_row_add" data-name="row_add">�� �߰� +</button>
					</div>

					<table class="bill_table_modify02" id="bill_tbl">
						<tr>
							<th style="width: 20%">����</th>
							<th style="width: 20%">���(��)</th>
							<th style="width: 10%">�Ⱓ</th>
							<th style="width: 20%">�հ�(�� /VAT ����)</th>
							<th style="width: 20%">
								<input tyep="text" placeholder="��� / ������" required style="text-align: center;"/>
							</th>
							<th style="width: 0%"></th>
						</tr>

						<tr id="bill_clone_tr">
							<td>
								<select id="bill_sort_select1" onchange="selectBox(value)">
									<option value="">����</option>
									<option value="traffic">
										��ȣ����,Ʈ���Ȱ���, �������,���Ȱ���
									</option>
									<option value="domain">������</option>
									<option value="self">�����Է�</option>
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
						<p>������ ����</p>
						�������� 011201-04-131424
					</li>
					<li>
						<p>������</p>
						�߾�����
					</li>
					<li>
						<p style="width: 100%">
							������ Ȩ���������� [�߰���ݰ���]�� ���� ī��ε� ������
							�����մϴ�.
						</p>
					</li>
					<li>
						<p>�����</p>
						<input type="text" placeholder="������Է�" />
					</li>
					<li>
						<p>ȸ�ſ���ó</p>
						<textarea
							onkeydown="resize(this)"
							onkeyup="resize(this)"
							placeholder="ȸ�� ����ó�� �Է��� �ּ���"
							required
							style="padding: 0;"
						></textarea>
					</li>
				</ul>
			</div>
		 <div class="bill_footer">
				<h1>
					�ֽ�ȸ�� ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ǥ�̻�&nbsp;&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;
					<span id="dojang" style="">(��)</span>
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
		name: "������",
		price: 22000,
		year: 1,
	};
	$(document).ready(function () {
		
		/*���̕� �� �߰�*/
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
				//�ŷ�����
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
				templateClone.children("td").last().append('<button class="remove">����</button>'); 

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
			if (proposalPrice.includes("��")) {
				proposalPrice = proposalPrice.replace("");
			}
			$(this).val(comma(proposalPrice));
		});

		/***************���� ��ȣ ���� (�⵵ + ���� )******************* */
		var result = getWeekNumber(new Date());
		let year = String(result[0]).substring(2, 4);
		//console.log("It's currently week " + result[1] + " of " + year);
		$("#bill_num").val("A" + year + "" + result[1] + "-" + "010101");
		/****************************************************************** */
	});

	//�� ���� ���Խ�-------------------
	function comma(num) {
		var regexp = /\B(?=(\d{3})+(?!\d))/g;
		num = num.toString().replace(regexp, ",");
		return num;
	}
	/**�ܰ� �޸� ��� */
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

	/*���� ����� */
	function quantityChange(id) {
		let price = 0;
		let valName = "";

		let check = /^[0-9]+$/; //�������� �˻�


			price = $("#" + id).val();

				price = $("#" + id).parent().siblings().children(".bill_price").val();
				valName = "bill";

				price = price.replace(/,/gi, "");
				// price = price.replace("��", "");
				price = Number(price);

				let period = $("#" + id).val();

				period = period.replace("��", "");

				period = Number(period);//�Ⱓ

				let total = 0;

				let surtax = price * 0.1;//�ΰ���

				console.log(surtax)

				let surtaxTotal =  surtax *period;//�ΰ��� * �Ⱓ

				total = surtaxTotal + period;

				$("#" + id).parent().siblings().children(".bill_total_price").val(comma(total));
				
				total();

	}

	/*�ܰ� ������ */
	function priceChange(id) {
		let idNum = "";

		idNum = id.slice(-1, id.length);

		let value = $('#' + id).parent().siblings().children('.bill_period').val();

		console.log(value);

		changePeriod(value);
	}

	/**��Ż��� �Լ� */
	function total() {
		console.log("change");
		let totalPrice = 0;
		let check = /^[0-9]/g; //�������� �˻�
		var regex = /[a-z0-9]|[ \[\]{}()<>?|`~!@#$%^&*-_+=,.;:\"'\\]/g;

		for (i = 0; i < $(".price").length; i++) {
			let prices = $(".price").eq(i).val();
			prices = prices.replace(/,/gi, "");
			// prices = prices.replace("��", "");
			prices = Number(prices);

			totalPrice = totalPrice + prices;
		}
		$("#bill_total_input").val(comma(totalPrice));
	}

	//�������
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

		var inputWidth = $("#virtual_dom" + num).width() + 16; // ���� �ϳ��� �뷫���� ũ��

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
				.val(domain.year + "��");

			total();
		}
	}
	function changePeriod(value) {

	
		let id = event.target.id;
let price ='';
		value = value.replace(/,/gi, "");
		value = value.replace("��", "");
		value = value.replace("����", "");

		if(id.includes('price')){
			price = $("#" + id).val();
			
		}else {
			price = $("#" + id).parent().siblings().children(".bill_price").val();
		}

		price = price.replace(/,/gi, "");

		let surtax = price*0.1;//�ΰ���
		console.log('surtax;'+surtax)
		let totalSurtax = surtax * value;//�Ѻΰ��� (���� * �ΰ���)

		let totalPrice = 0;

		totalPrice = value * price;

		totalPrice= totalPrice+totalSurtax;

		$("#" + id).parent().siblings().children(".bill_total_price").val(comma(totalPrice));

		total();
	}

</script>