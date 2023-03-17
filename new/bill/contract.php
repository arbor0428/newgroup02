<?
	$n_url = "./";

	//include 경로 안먹어서 넣음
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";


?>
<style>
/***********************
      계약서
************************/
.contract_content {
  width: 100%;
  margin-bottom: 50px;
}
.contract_content ul li {
  list-style: decimal;
  word-break: keep-all;
}
.list_row {
  display: flex;
}
.list_row p {
  margin: 0;
}
.list_row_inner p {
  width: 100%;
  display: flex;
}
.list_row_inner input[type="text"] {
  width: 100px;
  font-size: 16px;
}
.company_name_wrap input {
  width: 100px;
}
.underline {
  text-decoration: underline;
}
.bill_sub_title {
  font-size: 20px;
  font-weight: 700;
}
	.wrap {
	  width: calc(100% - 250px);
    min-height: 100vh;
    padding-bottom: 20px;
    margin-left: auto;
    background-color: #fff;
	}
	input[type="text"]{
		text-align: center;
		font-size:18px;
	}
</style>

<div class="wrap">
	<?
		include "../top_header.php";
	?>

	<div class="bill">
		<img src="/images/iweblogo.jpg" class="logo2" />
		<div class="bill_title">
			<input
				type="text"
				name="biil_title"
				value="홈페이지 제작 계약서"
				placeholder=""
			/>
		</div>
		<div class="contract_content">
			<ul>
				<li>
					<p>
						계약개요: “
						<span class="bold company_name_wrap">
							<input
								type="text"
								id=""
								class="bold company_name"
								placeholder="업체이름 입력"
								onkeydown="putCommpanyName(event)"
								onchange="putCommpanyName(event)"
							/>
						</span>
						” 의 홈페이지 제작
					</p>
				</li>

				<li>
					<div class="list_row">
						계약금액: 제작비 :
						<div class="list_row_inner">
							<p class="input_row">
								일금
								<input
									type="text"
									class="price_han"
									placeholder="자동변환"
								/>정 (\
								<input
									type="text"
									class="contract_price"
									placeholder="금액 입력"
									onchange="putPrice(event); transHanPrice(event)"
								/>
								/ 부가세포함)
							</p>
							<p class="bold">
								월 유지비용은
								<input
									type="text"
									id=""
									class="bold"
									placeholder="금액 입력"
								/>
								원 별도 청구예정(계약서 미 포함사항)
							</p>
						</div>
					</div>
				</li>

				<li>
					<div class="">
						<p>계약기간(제작기간)</p>
						<p>
							본 계약서의 계약 체결일로부터 30일(근무일 기준)간으로 하고,
							계약기간(제작기간)은 추후 협의하에 연장 혹은 단축될 수 있다.
							더불어 하자보수는 홈페이지 제작 완료 후 6개월로 한다. 단, 계약
							체결일은 기간에 포함시키지 않음.
						</p>
					</div>
					<div>
						위의 계약에 대하여 홈페이지 제작을 의뢰한 “
						<span class="bold">
							<input
								type="text"
								id=""
								class="bold company_name"
								placeholder="자동 입력"
							/>
						</span>

						” 홈페이지 제작, 설치 및 용역을 제공할 ‘(주)아이웹’은 별첨
						계약조건 및 수행계획서를 내용으로 하여 본 계약을 체결하고 쌍방
						기명 날인한 동일 원본 2부를 그 증거로 각각 1부씩 보관한다
					</div>
				</li>
			</ul>
		</div>

		<div class="contract_content">
			<div class="bill_title">계 약 조 건</div>
			<ul>
				<li>
					<div>
						<span class="bold input_parents">
							“<input
								type="text"
								class="bold company_name"
								placeholder="자동 입력"
							/>”
						</span>
						(이하 "갑"이라 한다)와 <span class="bold">“㈜아이웹”</span>(이하
						"을"이라 한다)은 아래와 같이 홈페 이지 제작 및 사용에 관한 계약을
						체결한다
					</div>
				</li>
			</ul>

			<p class="bill_sub_title">제 1 조 제작기간 및 계약기간</p>

			<ul>
				<li>
					<div>
						홈페이지 제작 기간은
						<span class="bold underline">계약일로부터 30日</span>로 하고,
						계약기간(제작기간)은 추후 협의하에 연장 혹은 단축될 수 있다. 단,
						“갑”이 “을”에게 자료를 제공하지 못하여 홈페이지 제작에 반영되지
						않아 누락된 내용에 대한 책임은 “갑”에게 있으며, 차후 추가 진행하는
						것을 원칙으로 한다.
					</div>
				</li>
				<li>
					<div>
						기타 사유로 인하여 홈페이지 제작이 다소 지연되는 경우, "을" 과
						"갑"은 협의 후에 기한을 변경할 수 있다.
					</div>
				</li>
			</ul>

			<p class="bill_sub_title">제 2 조 대금 지급 방법</p>
			<ul>
				<li>당사자간 거래는 현금결제 또는 카드결제를 원칙으로 한다.</li>
				<li>대금지불은 아래와 같이 지급한다.</li>
				<li>
					제작계약 선<input
						type="text"
						id=""
						class="price_per"
						onkeydown="price_per(event)"
						placeholder="% 입력"
					/>% 금액은 일금
					<input
						type="text"
						class="price_percent_han"
						placeholder="자동변환"
					/>정 (\
					<input type="text" class="price_percent" id="" placeholder="자동입력"/>
					/ 부가세포함) 으로 홈페이지 완료 검수 후 잔금
					<input
						type="text"
						id=""
						class="price_per2"
						onkeydown="price_per(event)"
						placeholder="% 입력"
					/>

					% 일금
					<input
						type="text"
						class="price_percent_han2"
						placeholder="자동변환"
					/>
					(\
					<input type="text" class="price_percent2" id="" placeholder="자동입력" />
					/부가세포함)을

					<input type="text" placeholder="일 입력" />일 이내에 결제한다.
				</li>
				<li>
					대금지급이 지연될 경우 연체료는 지불잔금의 1일 1/100씩 할증 된
					금액을 지불하여야 한다.
				</li>
				<li>
					“을”은 “갑”이 제공한 자료를 기반으로 홈페이지 작업에 최선을 다하여
					납품일정을 맞추며 만일 일정을 맞추지 못할 경우 지체보상금으로 잔금의
					1일 1/100씩을 차감한다.
				</li>
				<li>
					“을”의 명백한 실책으로 인하며 계약의 목적이 이루어지지 않았을 경우
					“을”은 “갑”에게 기지급된 금액을 반환한다.
				</li>
				<li>서버구축은 “을”이 구축대행하며 비용은 “갑”이 지불한다.</li>
			</ul>

			<p class="bill_sub_title">제 3 조 용역의 범위</p>
			<ul>
				<li>
					“갑”이 “을”에게 의뢰한 용역의 범위는 “갑”의 홈페이지 관리자페이지
					제작 및 사용에 관한 하자보수기간의 유지보수 및 그에 수반되는 제반
					업무로 한다.
				</li>
				<li>
					제작에 따른 검수는 코딩작업 진행 전 1회 수정을 하며 홈페이지
					전반적인 제작 후 1회 홈페이지 검수를 진행하여 보완/수정한다.
					일반게시물DATA(게시물에 등록되는 자료)와 컨텐츠 등록은 “갑”이 직접
					등록하도록 한다.
				</li>
				<li>
					홈페이지 제작 완료 후 수정 및 제작에 대해 “갑”의 별도 요청이 있는
					경우 상호협의 하에 별도의 비용을 지불한다.
				</li>
			</ul>
			<p class="bill_sub_title">제 4 조 기밀유지</p>
			<p>
				본 계약과 관련하여 상호간에 전달된 모든 정보는 계약체결 이전, 계약체결
				이후 혹은 계약 의무 가 완결된 이후에도 엄격히 비밀로 유지되어야 하고,
				본 계약의 목적 이외에는 계약 당사자의 사전 허락 없이 이용되어서는 안
				된다. 본 조항의 위반 시 “갑”과 “을”은 상대방에 대하여 서로 책임진다
			</p>

			<p class="bill_sub_title">제 5 조 중간 산출물에 대한 의무</p>
			<ul>
				<p>
					“을”은 “갑”에 만족스러운 홈페이지 제작 및 사용을 위하여 최선을
					다하며, 중간 산출물에 대한 중 요 결정사항에 대해서는 중간협의를
					통한다. 중간협의의 진행과정에서 상호 요구사항을 최대한 수용 할
					의무가 있다.
				</p>
			</ul>

			<p class="bill_sub_title">제 6 조 저작권</p>
			<ul>
				<li>
					홈페이지 제작에 사용된 솔루션 프로그램 및 소프트웨어에 대한 저작권은
					“을”에게 있다.
				</li>
				<li>
					완성된 홈페이지 및 프로그램에 대한 전속사용권한은 “갑”에게 있다.
				</li>
				<li>
					“을”의 프로그램 및 소프트웨어를 “갑”이 “을”의 협의 없이 제3자에게
					양도 매매 할 수 없으며 양도/매매 등 제3자에게 제공하였을 경우 “을”은
					“갑”에게 법적 조치를 취할 수 있다.
				</li>
				<li>
					홈페이지에 제작 적용된 디자인과 이미지는 해당 홈페이지에서만 사용
					가능하다.
				</li>
			</ul>

			<p class="bill_sub_title">제 7 조 계약 해지</p>
			<ul>
				<li>
					“갑”과 “을”은 상대방이 특별한 사유 없이 본 계약에서 규정한 제반
					의무를 다하지 아니하였 을 경우 본 계약을 해지할 수 있다.
				</li>
				<li>“갑”과 “을”은 상호협의에 의하여 본 계약을 해지할 수 있다.</li>
				<li>
					“갑”과 “을”은 상호협의에 의하여 계약을 해지하고자 하는 경우에는
					상대방에게 해지 의사를 내용증명으로 통보한다.
				</li>
			</ul>

			<p class="bill_sub_title">제 8 조 기타사항</p>
			<ul>
				<li>
					“갑”과 “을”은 홈페이지 제작을 위한 제작, 사용을 위하여 신의와 성실을
					원칙에 입각하여 최선의 노력을 경주한다.
				</li>
				<li>
					본 계약에 관한 소송이 제기되어야 하는 경우, “을”의 소재지를 관할하는
					법원을 관할 법원으로 한다
				</li>
			</ul>

			<p class="bill_sub_title">제 9 조 계약서 보관</p>
			<ul>
				<p>
					당사자는 이 계약서가 적법하게 성립되었음을 확인하고 증명하기 위하여
					계약서 2부를 작성하여 기명 날인한 후 각 한 통씩 소지하여야 한다.
				</p>
			</ul>
		</div>
	</div>
</div>

<script>

//처음 회사이름 입력시 자동 채움
function putCommpanyName(event) {
  const companyName = event.target.value;
  for (i = 0; i < $(".company_name").length; i++) {
    $(".company_name").eq(i).val(companyName);
  }
}

//첫 금액 입력시 자동 채움
function putPrice(event) {
  let contractPrice = event.target.value;
  contractPrice = comma(contractPrice);

  for (i = 0; i < $(".contract_price").length; i++) {
    $(".contract_price").eq(i).val(comma(contractPrice));
  }
}

// //숫자 한글로 변환
function num2han(num) {
  num = parseInt((num + "").replace(/[^0-9]/g, ""), 10) + ""; // 숫자/문자/돈 을 숫자만 있는 문자열로 변환
  if (num == "0") return "영";
  var number = ["영", "일", "이", "삼", "사", "오", "육", "칠", "팔", "구"];
  var unit = ["", "만", "억", "조"];
  var smallUnit = ["천", "백", "십", ""];
  var result = []; //변환된 값을 저장할 배열
  var unitCnt = Math.ceil(num.length / 4); //단위 갯수. 숫자 10000은 일단위와 만단위 2개이다.
  num = num.padStart(unitCnt * 4, "0"); //4자리 값이 되도록 0을 채운다
  var regexp = /[\w\W]{4}/g; //4자리 단위로 숫자 분리
  var array = num.match(regexp);
  //낮은 자릿수에서 높은 자릿수 순으로 값을 만든다(그래야 자릿수 계산이 편하다)
  for (var i = array.length - 1, unitCnt = 0; i >= 0; i--, unitCnt++) {
    var hanValue = _makeHan(array[i]); //한글로 변환된 숫자
    if (hanValue == "")
      //값이 없을땐 해당 단위의 값이 모두 0이란 뜻.
      continue;
    result.unshift(hanValue + unit[unitCnt]); //unshift는 항상 배열의 앞에 넣는다.
  }
  //여기로 들어오는 값은 무조건 네자리이다. 1234 -> 일천이백삼십사
  function _makeHan(text) {
    var str = "";
    for (var i = 0; i < text.length; i++) {
      var num = text[i];
      if (num == "0")
        //0은 읽지 않는다
        continue;
      str += number[num] + smallUnit[i];
    }
    return str;
  }
  return result.join("");
}

//금액 한글 변환
function transHanPrice(event) {
  let contractPrice = event.target.value;

  let hanPrice = num2han(contractPrice);

  for (i = 0; i < $(".price_han").length; i++) {
    $(".price_han").eq(i).val(comma(hanPrice));
  }
}
function price_per(event) {
  let percent = event.target.value;
  let className = event.target.className;
  let price = $(".contract_price").val();

  if (className.includes("2")) {
    price = price.replace(",", "");
    price = Number(price);
    percent = percent * 0.01;

    $(".price_percent2").val(comma(price * percent));
  } else {
    price = price.replace(",", "");
    price = Number(price);
    percent = percent * 0.01;

    $(".price_percent").val(comma(price * percent));
  }

  transHanPricePercent(event);
}

function transHanPricePercent(event) {
  let className = event.target.className;

  if (className.includes("2")) {
    let contractPrice = $(".price_percent2").val();
    contractPrice = contractPrice.replace(",", "");
    contractPrice = Number(contractPrice);
    let hanPrice = num2han(contractPrice);

    for (i = 0; i < $(".price_percent_han2").length; i++) {
      $(".price_percent_han2").eq(i).val(hanPrice);
    }
  } else {
    let contractPrice = $(".price_percent").val();
    contractPrice = contractPrice.replace(",", "");
    contractPrice = Number(contractPrice);
    let hanPrice = num2han(contractPrice);

    for (i = 0; i < $(".price_percent_han").length; i++) {
      $(".price_percent_han").eq(i).val(hanPrice);
    }
  }
}

</script>