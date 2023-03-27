<?
	$n_url = "./";

	//include 경로 안먹어서 넣음
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";


?>
<!-- 견적서만 적용되는 스크립트 (공통 X)-->
<script src="/new/js/bill.js"></script>


<style>
@page {
	size:210mm 297mm; /*A4*/
	margin:0mm
 }
	@media print {
	
		body { 
			background: #fff;
			font-size: 12px;
		}
		.no_print, .none_print {
			display: none !important;
		}
			.content_head {
				display: none;
			}
			.wrap {
				width: 100%;
				background: #fff !important;
			}
			.bill_content_wrap {
				width: 100%;
				box-shadow: none;
				margin: 0;
				padding: 0;
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
			margin: -80px 0 0;
			font-size: 12px;
		}
		.bill_pay {
			margin-bottom: 20px;
		  margin-top: 10px !important;
			gap: 0px;
		}
		.bill_top_content table th,
		.bill_bottom_content table th,
		.bill_top_content table td ,
		.am table th, .am table td{
			padding: 5px 10px;
			font-size: 12px;
		}
		.bill_bottom_content table td {
			font-size: 10px;
			padding: 5px; 
		}
		.bill_title input[type="text"]{
			font-size: 24px;
		}
		.bill_title {
			margin-bottom: 30px;
		}
		.bill_total, 
		.bill_discount,
		.bill_vat,
		.bill_custom ,
		.bill_total input[type="text"], 
		.bill_discount input[type="text"], 
		.bill_vat input[type="text"], 
		.bill_custom input[type="text"],
		.am input[type="text"],
		.bill_bottom_content input[type="text"],
		.bill_bottom_content textarea{
			font-size: 12px;
		}
		.bill_bottom_content input[type="text"]{
		text-align: left;
		}
		.bill_bottom_content {
			margin-top: 30px;
		}
		.bill_pay {
			width: 100%;
			margin-top:50px;
		}
		.bill_footer {
			margin:50px auto ;
			background-color: #fff;
		}
		#dojang {
			background: none;
		}
		.cutoff_btn {
			display: none;
		}
		.am table th, .am table th {
			padding: 10px !important;
		}
		.am table td {
			padding: 10px 0 !important;
		}
		.bill input[type="text"] {
			height: 25px;
		}
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
			<input type="text" name="biil_title" value="" placeholder="홈페이지 견적서(플랫폼)" />
		</div>

		<?
			include 'agree.php';
		?>

		<div class="bill_select_wrap none_print">
			<select class="bill_select">
				<option value="">선택</option>
				<option value="알뜰형">알뜰형</option>
				<option value="보급형">보급형</option>
				<option value="맞춤형">맞춤형</option>
				<option value="고급형">고급형</option>
				<option value="기타">기타</option>
			</select>
		</div>

		<div class="bill_content">
			<div class="bill_top_content">
				<table>
					<tr>
						<th width="100px">발행일</th>
						<td><?=date("Y m d")?></td>
					</tr>
					<tr>
						<th>담당자</th>
						<td>
							<input type="text" placeholder="담당자님 귀중" />
						</td>
					</tr>
					<tr>
						<th>프로젝트</th>
						<td><input type="text" placeholder="아이웹 홈페이지 제작" /></td>
					</tr>
				</table>

				<table>
					<tr>
						<th rowspan="5" style="writing-mode: vertical-lr; padding: 5px;">
							공급자
						</th>
					</tr>
					<tr style="border-top: none;">
						<th width="100px">등록번호</th>
						<td colspan="3"> <input type="text" id="bill_num" /></td>
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
				<div class="row_add_wrap none_print">
					<button id="btn_design" data-name="default">언어 +</button>
					<button id="btn_design" data-name="design">디자인 +</button>
					<button id="btn_program" data-name="program">프로그램 +</button>
					<button id="btn_service" data-name="service">부가서비스 +</button>
				</div>

				<table id="default_tbl" style="border-top: 2px solid #796c98">
					<tr>
						<th style="width: 10%;">시스템 구분</th>
						<th style="width: 17%;">기능</th>
						<th>내용</th>
						<th style="width: 5%;">수량</th>
						<th style="width: 15%;">단가(원)</th>
						<th style="width: 15%;">공급 단가(원)</th>
						<th style="width: 0%;"></th>
					</tr>
					<tr id="default_clone_tr">
						<td class="bold" style="width: 10%;">
							<input type="text" name="sort1" id="sort1" value="기획" />
						</td>
						<td style="width: 17%;">
							<input type="text" name="func1" id="func1" value="요청문서" />
						</td>
						<td>
							<input type="text" name="ment1" id="ment1" value="" />
						</td>
						<td style="width: 5%;">
							<input type="text" name="quantity1" id="quantity1" class="default_quantity" value="" onchange="quantityChange(id)"/>
						</td>
						<td style="width: 15%;">
							<input type="text" name="price1" id="price1" class="default_price" value=""  onchange="transComma(); priceChange(id);"/>
						</td>
						<td style="width: 15%;">
							<input type="text" name="sup_price1" id="sup_price1" class="default_sup_price " value="" />
						</td>
						<td style="width: 0%;" id="etc1"></td>
					</tr>

					<tr class="default_tr">
						<td class="bold">
							<input type="text" name="sort2" id="sort2" value="언어" />
						</td>
						<td>
							<input type="text" name="func2" id="func2" value="해당언어" />
						</td>
						<td>
							<textarea name="ment2" id="ment2" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">한국어 홈페이지</textarea>
						</td>
						<td>
							<input type="text" name="quantity2" id="quantity2" class="default_quantity" value="1" onchange="quantityChange(id)" />
						</td>
						<td>
							<input type="text" name="price2" id="price2" class="default_price" value="" onchange="transComma(); priceChange(id);" />
						</td>
						<td>
							<input type="text" name="sup_price2" id="sup_price2" class="default_sup_price price" value="" />
						</td>
						<td style="width: 0%;" id="etc2"></td>
					</tr>
				</table>

				<!-- 디자인 -->
				<table id="design_tbl">
					<tr id="design_clone_tr" class="design_tr">
						<td class="bold sort_td"  style="width: 10%;">
							<input type="text" name="design_sort1" id="design_sort1" value="디자인" />
						</td>
						<td  style="width: 17%;">
							<input type="text" name="design_func1" id="design_func1" value="메인 디자인" />
						</td>
						<td>
							<textarea name="design_ment1" id="design_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">메인 레이아웃 및 코딩</textarea>
						</td>
						<td  style="width: 5%;">
							<input type="text" name="design_quantity1" id="design_quantity1" value="" class="design_quantity" onchange="quantityChange(id)" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="design_price1" id="design_price1" class="design_price" value="" onchange="transComma(); priceChange(id);" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="design_sup_price1" id="design_sup_price1" class="design_sup_price" value="" />
						</td>
						<td style="width: 0%;" id="design_etc"></td>
					</tr>

					<tr class="design_tr">
						<td class="bold">
							<input type="text" name="design_sort2" id="design_sort2" value="" />
						</td>
						<td>
							<input type="text" name="design_func2" id="design_func2" value="서브 페이지" />
						</td>
						<td>
							<textarea name="design_ment2" id="design_ment2" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">이미지 및 텍스트, 비주얼 디자인</textarea>
						</td>
						<td>
							<input type="text" name="design_quantity2" id="design_quantity2" class="design_quantity" value="" onchange="quantityChange(id)" />
						</td>
						<td>
							<input type="text" name="design_price2" id="design_price2" class="design_price" value="" onchange="transComma(); priceChange(id);" />
						</td>
						<td>
							<input type="text" name="design_sup_price2" id="design_sup_price2" class="design_sup_price" value="" />
						</td>
						<td style="width: 0%;"  id="design_etc2"></td>
					</tr>
				</table>

				<!-- 프로그램 -->
				<table id="program_tbl">
					<tr id="program_clone_tr" class="program_tr">
						<td class="bold"  style="width: 10%;">
							<input type="text" name="program_sort1" id="program_sort1" value="프로그램" />
						</td>
						<td  style="width: 17%;">
							<input type="text" name="program_func1" id="program_func1" value="일반 게시판 " />
						</td>
						<td>
							<textarea name="program_ment1" id="program_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">공지사항 / Q&A / FAQ 등</textarea>
						</td>
						<td  style="width: 5%;">
							<input type="text" name="program_quantity1" id="program_quantity1" class="program_quantity" value="5" onchange="quantityChange(id)" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="program_price1" id="program_price1" class="program_price" value="" onchange="transComma(); priceChange(id);" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="program_sup_price1" id="program_sup_price1" class="program_sup_price" value="" />
						</td>
						<td style="width: 0%;"  id="program_etc1"></td>
					</tr>

					<tr class="program_tr">
						<td class="bold">
							<input type="text" name="program_sort2" id="program_sort2" value="" />
						</td>
						<td>
							<input type="text" name="program_func2" id="program_func2" value="관리자 페이지" />
						</td>
						<td>
							<textarea name="program_ment2" id="program_ment2" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">게시판(메뉴)관리 / 로그분석 / 회원가입 관리 </textarea>
						</td>
						<td>
							<input type="text" name="program_quantity2" id="program_quantity2" class="program_quantity" value="1" onchange="quantityChange(id)" />
						</td>
						<td>
							<input type="text" name="program_price2" id="program_price2" class="program_price" value="" onchange="transComma(); priceChange(id);" />
						</td>
						<td>
							<input type="text" name="program_sup_price2" id="program_sup_price2" class="program_sup_price" value=""  />
						</td>
						<td style="width: 0%;" id="program_etc2"></td>
					</tr>
				</table>

				<!-- 부가서비스 -->
				<table id="service_tbl">
					<tr id="service_clone_tr" class="service_tr">
						<td class="bold"  style="width: 10%;">
							<input type="text" name="service_sort1" id="service_sort1" value="부가서비스" />
						</td>
						<td  style="width: 17%;">
							<input type="text" name="service_func1" id="service_func1" value="도메인" />
						</td>
						<td>
							<textarea name="service_ment1" id="service_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">Com / Co.kr / Net</textarea>
						</td>
						<td style="width: 5%;">
							<input type="text" name="service_quantity1" id="service_quantity1" class="service_quantity" value="1" onchange="quantityChange(id)" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="service_price1" id="service_price1 " class="service_price"  value="22,000" onchange="transComma(); priceChange(id);" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="service_sup_price1" id="service_sup_price1" class="service_sup_price price" />
						</td>
						<td style="width: 0%;" id="service_etc1"></td>
					</tr>

					<tr class="service_tr">
						<td class="bold">
							<input type="text" name="service_sort2" id="service_sort2" value="" />
						</td>
						<td>
							<input type="text" name="service_func2" id="service_func2" value="유지비(호스팅포함)" />
						</td>
						<td>
							<textarea name="service_ment2" id="service_ment2" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">서버공간, DB 등의 백업, 트래픽관리, 보안 등 </textarea>
						</td>
						<td >
							<select class="bill_select1"  style="width: 100%;">
								<option value="">선택</option>
								<option value="100MB">100MB</option>
								<option value="500MB">500MB</option>
								<option value="1GB">1GB</option>
								<option value="3GB">3GB</option>
							</select>
						</td>
						<td>
							<input type="text" name="service_price2" id="service_price2 " class="service_price" onchange="transComma(); priceChange(id);"value="" />
						</td>
						<td>
							<input type="text" name="service_sup_price2" id="service_sup_price2" class="service_sup_price price" value="" />
						</td>
						<td style="width: 0%;"  id="service_etc2"></td>
					</tr>
				</table>
			</div>
		</div>
	
		<div class="bill_pay"  style="position: relative;">
		
			<div class="bill_total">
				<p>공급가액(부가세 미포함)</p>
				<input type="text" id="bill_total_input" style="width: 50%;"/>
			</div>
			<div class="bill_discount">
				<p>할인률</p>
				<input type="text" id="bill_discount_input" style="width: 49%;" value="0"/>%
			</div>
			<div class="bill_vat">
				<p>부가세</p>
				<input type="text" id="bill_vat_input" style="width: 50%;"/>
			</div>
			<div class="bill_custom">
				<p>Total제안가(부가세 포함)</p>
				<input type="text" id="proposal_bill_input" style="width: 50%;" data-val=""/>
			</div>
			<div  class="cutoff_btn" style="position: absolute; right: -180px; bottom: 0;">
				<select id="cutoff_btn">
					<option data-unit="0" value="" selected disabled>선택</option>
					<option data-unit="10" value="0">10 단위 절사</option>
					<option data-unit="100" value="1">100 단위 절사</option>
					<option data-unit="1000" value="2">1,000 단위 절사</option>
					<option data-unit="10000" value="3">10,000 단위 절사</option>
					<option data-unit="100000" value="4">100,000 단위 절사</option>
					<option data-unit="1000000" value="5">1,000,000 단위 절사</option>
				</select>
			</div>
		</div>
		<div class="am">
			
		<select name='userid' id="userid" class="no_print" onchange="setUserID()">
			<option value=''>직원목록</option>
			<?
				for ($i=0; $i<count($arr_member); $i++) {
			?>
			<option value='<?=$arr_userid[$i]?>' >
				<?=$arr_member[$i]?>
			</option>
			<?
				}
			?>
		</select>
		<table>
					<tr>
						<th>아이웹 담당자</th>
						<td>
							<input type="text" id="name" placeholder="담당자" style="text-align: left; padding: 0 20px;"/>
						</td>
					</tr>
					<tr>
						<th>직통 번호</th>
						<td><input type="text" id="tel" placeholder="직통 번호" style="text-align: left;padding: 0 20px;"/></td>
					</tr>
			</table>
			</div>
			<div class="bill_footer">
				<h1>
					주식회사 아이웹&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;대표이사&nbsp;&nbsp;&nbsp;조&nbsp;&nbsp;준&nbsp;&nbsp;&nbsp;
					<span id="dojang" style="">(인)</span>
				</h1>
			</div>

	</div>
</div>

</div>
<script>
	$('.print_btn').click(function () {
			window.print();
	});

	function setUserID() {					
		userid = $("#userid option:selected").val(); // userid가 select됐을때 작용					
		$('#name').val(''); 
		$('#tel').val('')

		if (userid) {
			$.post('./jsonTel.php',{'userid':userid}, function(req) { // json 방식으로 전송하여 리턴값 받기.							
				parData = JSON.parse(req); // 문자열 구문 분석, 객체생성						
				name = parData['name']; // name이라는 객체를 생성
				tel = parData['tel'];										

				$('#tel').val(tel); // 전화
				$('#name').val(name); 
			});
		}
	}
</script>
