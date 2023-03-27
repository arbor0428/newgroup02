<?

$sql = "select * from wo_setup where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result); 
		
		$phone = $row["phone"]; // 회사 대표번호
		$fax = $row["fax"]; // 회사 팩스번호
		$bank01 = $row["bank01"]; // 수취인 통장
		$actxt01 = $row["actxt01"]; // 회사명
		$account01 = $row["account01"]; // 법인계좌번호
		$cmp_num = $row["cmp_num"]; // 사업자 번호
		$cmp_adr = $row["cmp_adr"]; // 소재지
		$ceo_nm = $row["ceo_nm"]; // 대표이사 성함
		$i_mail = $row["i_mail"]; // 이메일
		$i_hpage = $row["i_hpage"]; // 홈페이지
		$i_ppage = $row["i_ppage"]; // 카드결제 사이트

?>

<!DOCTYPE html>
<html lang="utf-8">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <title>대금청구서</title>
  </head>
  <body>
    <header>
      <img src="img/iwebLogo.gif" alt="iweblogo" />
      <span id="title"><strong>주식회사</strong><strong>아 이 웹</strong></span>
    </header>
    <section id="title-under">
      <div id="title-under-section">
        <div id="receipt-section">
          <span id="receipt">수 신</span> <span>한국열린평생교육원</span>
        </div>

        <div id="stopover-section">
          <span id="stopover">(경유)</span><span>홈페이지 담당자님 귀중</span>
        </div>

        <div id="section-title-section">
          <span id="sentence-title">제 목</span>
          <span class="bold_sizeup">홈페이지 제작에 대한 제작비용을 안내드립니다</span>
        </div>
      </div>
    </div>
    </section>
    <section id="number-list">
      <ol>
        <li>귀사의 사업에 무궁한 발전을 기원합니다.</li>
        <li>발신자는 귀사가 운영하시는 홈페이지 제작비용을 아래와 같이 청구합니다</li>
      </ol>
      <span>- 다 음 -</span>
    </section>
    <section id="bill-table-section">
        <table border="1" class="tableclass">
          <thead>
            <tr>
              <th class="product-name">제품명</th>
              <th class="unit-price">개당가격</th>
              <th class="amount">수량</th>
              <th class="total">합계</th>
              <th class="note">비고</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td class="sum">총계</td>
              <td></td>
              <td></td>
              <td  class="tfoot-won">\</td>
              <td></td>
            </tr>
            <tr>
              <td class="surtax">부가세</td>
              <td></td>
              <td></td>
              <td  class="tfoot-won">\</td>
              <td></td>
            </tr>
            <tr>
              <td class="surtax-plus-price">부가세포함 가격</td>
              <td></td>
              <td></td>
              <td class="tfoot-won">\</td>
              <td></td>
            </tr>
          </tfoot>
        </table>
    </section>
    <section id="section-bottom"> 
      <p>3. <a href="https://www.i-web.kr/free_payment/up_index.php">https://www.i-web.kr/free_payment/up_index.php</a> 카드결제 진행 사이트. <br>
      결제정보 50.000원 입력해주시면, 부가세 자동 계산 됩니다.</p>
      
      <div id="depositor">
        <span>▶수취인 통장: </span>
        <span>예금주: </span>
      </div>
      <div id="cardpay">
        <span>▶아이웹 홈페이지에서 [추가요금결제]를 통해 카드로도 결제가 가능합니다.</span>
      </div>
      <div id="number-email">
        <span>▶회신연락처: </span>
        <span class="person">담당자: </span>
        <span class="email">이메일: </span>
      </div>
      <div id="finish-section">
        <span>붙임:</span>
        <span class="finish">끝.</span>
      </div>
      <div id="iwebrepresentative">
        <span class="company">주식회사</span>
        <span class="iweb">아이웹</span>
        <span class="repre">대표이사</span>
      </div>
    </section>
    <footer>
      <img class="iwebstamp" width="100rem" src=".img/image2.png" alt="iwebstamp">
      
    <div id="footer-sentence">
      <div id="first-sentence">
        <span class="charge">담당 :</span>
        <span>차장 : </span>
        <span class="personalbest">대표 : </span>
      </div>
      <div id="sec-sentence">
        <span class="data">시행 : </span>
        <span class="receiving">접수</span>
        <span>( 255   )</span>
      </div>
      <div id="last-sentence">
        <span>우 03736 / 주소</span>
        <span class="address">서울특별시 마포구 매봉산로 37,<br> DMC산학협력연구센터 605호</span>
        <span>/ http://www.i-web.kr</span>
      </div>
    </div>
    </footer>
  </body>
</html>
