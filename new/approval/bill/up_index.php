<?

	include '../../head.php';
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.DbCon.php";
	include "../../array.php";
	include '../../menu2.php';

	if(!$type)	$type = 'list';

?>


<table width="1200" border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td style='padding-top:10px;padding-bottom:10px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='50%'><a href='/'><img src='../../img/home.gif'></a>&nbsp;&nbsp;<span style='font-size:20px;font-weight:800;'><?=$subtit?></td>
					<td width='50%' align='right' valign='bottom'><?if($type=='list'){?><a href='up_index.php?type=write' class="big cbtn black">등록</a><?}?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>

<?


	

	$calSize = 'medium';
	include '../../module/Calendar.php';

	switch($type){
		case 'list' :
							include 'list.php';
							break;

		case 'view' :
							include 'view.php';
							break;

		case 'write' :
		case 'edit' :
							include 'write.php';
							break;

	}

?>


		</td>
	</tr>					
</table>

<!-- 
<?

		$sql = "select * from wo_setup where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result); 
		
		$phone = $row["phone"]; // ȸ�� ��ǥ��ȣ
		$fax = $row["fax"]; // ȸ�� �ѽ���ȣ
		$bank01 = $row["bank01"]; // ������ ����
		$actxt01 = $row["actxt01"]; // ȸ���
		$account01 = $row["account01"]; // ���ΰ��¹�ȣ
		$cmp_num = $row["cmp_num"]; // ����� ��ȣ
		$cmp_adr = $row["cmp_adr"]; // ������
		$ceo_nm = $row["ceo_nm"]; // ��ǥ�̻� ����
		$i_mail = $row["i_mail"]; // �̸���
		$i_hpage = $row["i_hpage"]; // Ȩ������
		$i_ppage = $row["i_ppage"]; // ī����� ����Ʈ

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
	<a class='big cbtn black' href='javascript:reg_list();'>���</a>
	<a class="big cbtn black" href="javascript://" onclick="window.open('/module/printSet.php?mod=1&uid=<?=$uid?>','ieprint','width=990,height=900,scrollbars=yes','_blank')">�μ��ϱ�</a>
</div>


  <head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../bill/css/style.css" />
		<title>���û����</title>
  </head>
 <body>
    <div class="tableWrap">
      <h1 class="tableTitle">
        <img src="./img/iwebLogo.png" alt="iweblogo" />
        <span><strong>�ֽ�ȸ��</strong> ������</span>
      </h1>
      <div class="headerSentenceList">
        <ul>
          <li>��&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;&nbsp;�ѱ��������������</li>
          <li>(��&nbsp;��)&nbsp;&nbsp;&nbsp;Ȩ������ ����ڴ� ����</li>
          <li class="strong">
            ��&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;&nbsp;Ȩ������ ���ۿ� ����
            ���ۺ���� �ȳ� �帳�ϴ�.
          </li>
        </ul>
      </div>
      <div class="tableUpList">
        <ol>
          <li>&nbsp;�ͻ��� ����� ������ ������ ����մϴ�.</li>
          <li>
            &nbsp;�߽��ڴ� �ͻ簡 ��Ͻô� Ȩ������ ���ۺ���� �Ʒ��� ����
            û���մϴ�.
          </li>
        </ol>
      </div>
      <span class="next">-�� ��-</span>
      <section id="bill-table-section">
        <table border="1" class="tableclass">
          <thead>
            <tr style="font-size: 14px">
              <th class="product-name">��ǰ��</th>
              <th class="unit-price">���簡��</th>
              <th class="amount">����</th>
              <th class="total">�հ�</th>
              <th class="note">���</th>
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
              <td class="sum">�Ѱ�</td>
              <td></td>
              <td></td>
              <td class="tfoot-won">\</td>
              <td></td>
            </tr>
            <tr>
              <td class="surtax">�ΰ���</td>
              <td></td>
              <td></td>
              <td class="tfoot-won">\</td>
              <td></td>
            </tr>
            <tr>
              <td class="surtax-plus-price">�ΰ������� ����</td>
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
			  style="font-size: 1.2rem;"
              >www.i-web.kr/free_payment/up_index.php</a
            >
            ī����� ���� ����Ʈ.<br />�������� 50,000�� �Է����ֽø�, �ΰ���
            �ڵ� ��� �˴ϴ�.
          </li>
        </ol>
      </div>
      <div class="sentences">
        <div class="payeeDepositor">
          <span>��</span><span class="payee">���������� : </span
          ><span>������ : </span>
        </div>
        <div class="cardPayment">
          <span>��</span
          ><span class="pay"
            >������ Ȩ���������� [�߰���ݰ���]�� ���� ī��ε� ������
            �����մϴ�.</span
          >
        </div>
        <div class="numberChargeEmail">
          <span>��</span><span class="number">ȸ�ſ���ó : </span><br />
          <div class="totalpersonEmail">
            <span class="personInCharge">����� : </span><span>�̸���:</span>
          </div>
        </div>
      </div>
      <div class="totalfinish">
        <span>���� : ������ ����</span><span>��.</span>
      </div>
      <div class="totalFinishSpan">
        <div class="totalFinishSpanMiddle">
          <img style="margin-top: -21px; width: 73px; height: 68px" src="./img/image2.png" alt="">
          <span class="limitedCompany">�ֽ�ȸ��</span
          ><span class="iweb">������</span><span class="ceo">��ǥ�̻�</span>
        </div>
        
      </div>
      <div class="footer">
        
        <div class="footerFirstSpans">
          <span>��� : &nbsp;</span><span>���� : &nbsp;</span
          ><span>��ǥ : &nbsp;</span>
        </div>
        <div class="footerSecondSpans">
          <span>���� : &nbsp;</span><span>����</span
          ><span>( 255 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</span>
        </div>
        <div class="footerThirdSpans">
          <span>�� 03736 / �ּ�</span
          ><span>����Ư���� ������ �ź���� 37, DMC�������¿������� 605ȣ</span>
          <span>/ http://www.i-web.kr</a></span>
        </div>
      </div>
    </div>
    
  </body>
</form> -->
