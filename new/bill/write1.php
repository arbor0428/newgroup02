<?
	$n_url = "./";

	//include 경로 안먹어서 넣음
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	include "../header.php";


?>
 <div class="content_wrap"> 
	<div class="bill">
		<img src="/images/iweblogo.jpg" class="bill_logo" />
		<div class="bill_title">
			<input type="text" name="biil_title" value="" placeholder="홈페이지 견적서(플랫폼)" />
		</div>
<?
include 'agree.php';
?>
		<div class="bill_select_wrap">
			<select class="bill_select">
				<option value="">선택</option>
				<option value="알뜰형">알뜰형</option>
				<option value="보급형">보급형</option>
				<option value="맞춤형">맞춤형</option>
				<option value="고급형">고급형</option>
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
				<div class="row_add_wrap">
					<button id="btn_design" data-name="design">디자인 +</button>
					<button id="btn_program" data-name="program">프로그램 +</button>
					<button id="btn_service" data-name="service">부가서비스 +</button>
				</div>

				<table>
					<tr>
						<th style="width: 10%;">시스템 구분</th>
						<th style="width: 15%;">기능</th>
						<th>내용</th>
						<th style="width: 5%;">수량</th>
						<th style="width: 15%;">단가(원)</th>
						<th style="width: 15%;">공급 단가(원)</th>
					</tr>
					<tr>
						<td class="bold" style="width: 10%;">
							<input type="text" name="sort1" id="sort1" value="기획" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="func1" id="func1" value="요청문서" />
						</td>
						<td>
							<input type="text" name="ment1" id="ment1" value="" />
						</td>
						<td style="width: 5%;">
							<input type="text" name="quantity1" id="quantity1" class="default_quantity" value="" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="price1" id="price1" class="default_price" value="" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="sup_price1" id="sup_price1" class="default_sup_price" value="" />
						</td>
					</tr>

					<tr>
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
							<input type="text" name="sup_price2" id="sup_price2" class="default_sup_price price" value="" readonly/>
						</td>
					</tr>
				</table>

				<!-- 디자인 -->
				<table id="design_tbl">
					<tr id="design_clone_tr" class="design_tr">
						<td class="bold sort_td"  style="width: 10%;">
							<input type="text" name="design_sort1" id="design_sort1" value="디자인" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="design_func1" id="design_func1" value="메인 디자인" />
						</td>
						<td>
							<textarea name="design_ment1" id="design_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">메인 레이아웃 및 코딩</textarea>
						</td>
						<td  style="width: 5%;">
							<input type="text" name="design_quantity1" id="design_quantity1" value="" class="design_quantity" onchange="quantityChange(id)" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="design_price1" id="design_price1" class="design_price" value="" onchange="transComma(); priceChange(id);" readonly/>
						</td>
						<td  style="width: 15%;">
							<input type="text" name="design_sup_price1" id="design_sup_price1" class="design_sup_price" value=""readonly />
						</td>
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
							<input type="text" name="design_price2" id="design_price2" class="design_price" value="" onchange="transComma(); priceChange(id);"readonly />
						</td>
						<td>
							<input type="text" name="design_sup_price2" id="design_sup_price2" class="design_sup_price" value="" readonly/>
						</td>
					</tr>
				</table>

				<!-- 프로그램 -->
				<table id="program_tbl">
					<tr id="program_clone_tr" class="program_tr">
						<td class="bold"  style="width: 10%;">
							<input type="text" name="program_sort1" id="program_sort1" value="프로그램" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="program_func1" id="program_func1" value="일반 게시판 " />
						</td>
						<td>
							<textarea name="program_ment1" id="program_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">공지사항 / Q&A / FAQ 등</textarea>
						</td>
						<td  style="width: 5%;">
							<input type="text" name="program_quantity1" id="program_quantity1" class="program_quantity" value="5" onchange="quantityChange(id)" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="program_price1" id="program_price1" class="program_price" value="" onchange="transComma(); priceChange(id);"readonly />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="program_sup_price1" id="program_sup_price1" class="program_sup_price" value="" readonly/>
						</td>
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
							<input type="text" name="program_price2" id="program_price2" class="program_price" value="" onchange="transComma(); priceChange(id);" readonly/>
						</td>
						<td>
							<input type="text" name="program_sup_price2" id="program_sup_price2" class="program_sup_price" value=""readonly />
						</td>
					</tr>
				</table>

				<!-- 부가서비스 -->
				<table id="service_tbl">
					<tr id="service_clone_tr" class="service_tr">
						<td class="bold"  style="width: 10%;">
							<input type="text" name="service_sort1" id="service_sort1" value="부가서비스" />
						</td>
						<td  style="width: 15%;">
							<input type="text" name="service_func1" id="service_func1" value="도메인" />
						</td>
						<td>
							<textarea name="service_ment1" id="service_ment1" onkeydown="resize(this)" onkeyup="resize(this)" rows="1">Com / Co.kr / Net</textarea>
						</td>
						<td style="width: 5%;">
							<input type="text" name="service_quantity1" id="service_quantity1" class="service_quantity" value="1" onchange="quantityChange(id)" />
						</td>
						<td style="width: 15%;">
							<input type="text" name="service_price1" id="service_price1 " class="service_price"  value="22,000" onchange="transComma(); priceChange(id);" readonly/>
						</td>
						<td style="width: 15%;">
							<input type="text" name="service_sup_price1" id="service_sup_price1" class="service_sup_price price"readonly/>
						</td>
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
						<td>
							<select class="bill_select1">
							<option value="">선택</option>
							<option value="100MB">100MB</option>
							<option value="500MB">500MB</option>
							<option value="1GB">1GB</option>
							<option value="3GB">3GB</option>
							</select>
							<!--<input type="text" name="service_quantity2" id="service_quantity2" class="service_quantity" value="매월" onchange="quantityChange(id)" />!-->
						</td>
						<td>
							<input type="text" name="service_price2" id="service_price2 " class="service_price" onchange="transComma(); priceChange(id);"value="" readonly/>
						</td>
						<td>
							<input type="text" name="service_sup_price2" id="service_sup_price2" class="service_sup_price price" value="" readonly/>
						</td>
					</tr>
				</table>
			</div>
		</div>
	
		<div class="bill_pay">
		
			<div class="bill_total">
				<p>total(부가세 별도)</p>
				<input type="text" id="bill_total_input" />
			</div>
			<div class="bill_custom">
				<p>제안가(부가세 포함)</p>
				<input type="text" id="proposal_bill_input" />
			</div>
		</div>
			<div class="am">
			<script>
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
			});
		}
	}
</script>
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
		<table>
					<tr>
						<th>아이웹 담당자</th>
						<td>
							<input type="text" placeholder="담당자" />
						</td>
					</tr>
					<tr>
						<th>직통 번호</th>
						<td><input type="text" placeholder="직통 번호" /></td>
					</tr>
			</table>
			</div>

	</div>
</div>