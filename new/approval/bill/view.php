
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

<script language='javascript'>

	function reg_list(){
		form = document.FRM;
		form.type.value = 'list';
		form.action = '<?=$PHP_SELF?>';
		form.submit();

	}

</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
	<input type='hidden' name='type' value='<?=$type?>'>
	<input type='hidden' name='uid' value='<?=$uid?>'>
	<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>

<div style='width:700px;margin:0 auto;text-align:right'>
	<a class='big cbtn black' href='javascript:reg_list();'>목록</a>
	<a class="big cbtn black" href="javascript://" onclick="window.open('/module/printSet.php?mod=1&uid=<?=$uid?>','ieprint','width=990,height=900,scrollbars=yes','_blank')">인쇄하기</a>
</div>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../bill/css/style.css" />
    <title>대금청구서</title>
  </head>
  <body>
    <div class="tableWrap">
      <h1 class="tableTitle">
        <img src="./img/iwebLogo.png" alt="iweblogo" />
        <span><strong>주식회사</strong> 아이웹</span>
      </h1>
      <div class="headerSentenceList">
        <ul>
          <li>수&nbsp;&nbsp;신&nbsp;&nbsp;&nbsp;&nbsp;한국열린평생교육원</li>
          <li>(경&nbsp;유)&nbsp;&nbsp;&nbsp;홈페이지 담당자님 귀중</li>
          <li class="strong">
            제&nbsp;&nbsp;목&nbsp;&nbsp;&nbsp;&nbsp;홈페이지 제작에 대한
            제작비용을 안내 드립니다.
          </li>
        </ul>
      </div>
      <div class="tableUpList">
        <ol>
          <li>&nbsp;귀사의 사업에 무궁한 발전을 기원합니다.</li>
          <li>
            &nbsp;발신자는 귀사가 운영하시는 홈페이지 제작비용을 아래와 같이
            청구합니다.
          </li>
        </ol>
      </div>
      <span class="next">-다 음-</span>
      <section id="bill-table-section">
        <table border="1" class="tableclass">
          <thead>
            <tr style="font-size: 14px">
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
              <td class="tfoot-won">\</td>
              <td></td>
            </tr>
            <tr>
              <td class="surtax">부가세</td>
              <td></td>
              <td></td>
              <td class="tfoot-won">\</td>
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

      
      <div class="tableUpList">
        <ol start="3">
          <li>
            &nbsp;https://<a
              href="https://www.i-web.kr/free_payment/up_index.php"
              >www.i-web.kr/free_payment/up_index.php</a
            >
            카드결제 진행 사이트.<br />결제정보 50,000원 입력해주시면, 부가세
            자동 계산 됩니다.
          </li>
        </ol>
      </div>
      <div class="sentences">
        <div class="payeeDepositor">
          <span>▶</span><span class="payee">수취인통장 : </span
          ><span>예금주 : </span>
        </div>
        <div class="cardPayment">
          <span>▶</span
          ><span class="pay"
            >아이웹 홈페이지에서 [추가요금결제]를 통해 카드로도 결제가
            가능합니다.</span
          >
        </div>
        <div class="numberChargeEmail">
          <span>▶</span><span class="number">회신연락처 : </span><br />
          <div class="totalpersonEmail">
            <span class="personInCharge">담당자 : </span><span>이메일:</span>
          </div>
        </div>
      </div>
      <div class="totalfinish">
        <span>붙임 : 아이웹 통장</span><span>끝.</span>
      </div>
      <div class="totalFinishSpan">
        <div class="totalFinishSpanMiddle">
          <img style="margin-top: -10px; width: 73px; height: 68px" src="./img/image2.png" alt="">
          <span class="limitedCompany">주식회사</span
          ><span class="iweb">아이웹</span><span class="ceo">대표이사</span>
        </div>
        
      </div>
      <div class="footer">
        
        <div class="footerFirstSpans">
          <span>담당 : &nbsp;</span><span>차장 : &nbsp;</span
          ><span>대표 : &nbsp;</span>
        </div>
        <div class="footerSecondSpans">
          <span>시행 : &nbsp;</span><span>접수</span
          ><span>( 255 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</span>
        </div>
        <div class="footerThirdSpans">
          <span>우 03736 / 주소</span
          ><span>서울특별시 마포구 매봉산로 37, DMC산학협력연구센터 605호</span>
          <span>/ http://www.i-web.kr</a></span>
        </div>
      </div>
    </div>
    
  </body>
</html>
