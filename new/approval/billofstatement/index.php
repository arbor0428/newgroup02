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

<!DOCTYPE html>
<html lang="utf-8">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <title>���û����</title>
  </head>
  <body>
    <header>
      <img src="img/iwebLogo.gif" alt="iweblogo" />
      <span id="title"><strong>�ֽ�ȸ��</strong><strong>�� �� ��</strong></span>
    </header>
    <section id="title-under">
      <div id="title-under-section">
        <div id="receipt-section">
          <span id="receipt">�� ��</span> <span>�ѱ��������������</span>
        </div>

        <div id="stopover-section">
          <span id="stopover">(����)</span><span>Ȩ������ ����ڴ� ����</span>
        </div>

        <div id="section-title-section">
          <span id="sentence-title">�� ��</span>
          <span class="bold_sizeup">Ȩ������ ���ۿ� ���� ���ۺ���� �ȳ��帳�ϴ�</span>
        </div>
      </div>
    </div>
    </section>
    <section id="number-list">
      <ol>
        <li>�ͻ��� ����� ������ ������ ����մϴ�.</li>
        <li>�߽��ڴ� �ͻ簡 ��Ͻô� Ȩ������ ���ۺ���� �Ʒ��� ���� û���մϴ�</li>
      </ol>
      <span>- �� �� -</span>
    </section>
    <section id="bill-table-section">
        <table border="1" class="tableclass">
          <thead>
            <tr>
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
              <td  class="tfoot-won">\</td>
              <td></td>
            </tr>
            <tr>
              <td class="surtax">�ΰ���</td>
              <td></td>
              <td></td>
              <td  class="tfoot-won">\</td>
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
    <section id="section-bottom"> 
      <p>3. <a href="https://www.i-web.kr/free_payment/up_index.php">https://www.i-web.kr/free_payment/up_index.php</a> ī����� ���� ����Ʈ. <br>
      �������� 50.000�� �Է����ֽø�, �ΰ��� �ڵ� ��� �˴ϴ�.</p>
      
      <div id="depositor">
        <span>�������� ����: </span>
        <span>������: </span>
      </div>
      <div id="cardpay">
        <span>�������� Ȩ���������� [�߰���ݰ���]�� ���� ī��ε� ������ �����մϴ�.</span>
      </div>
      <div id="number-email">
        <span>��ȸ�ſ���ó: </span>
        <span class="person">�����: </span>
        <span class="email">�̸���: </span>
      </div>
      <div id="finish-section">
        <span>����:</span>
        <span class="finish">��.</span>
      </div>
      <div id="iwebrepresentative">
        <span class="company">�ֽ�ȸ��</span>
        <span class="iweb">������</span>
        <span class="repre">��ǥ�̻�</span>
      </div>
    </section>
    <footer>
      <img class="iwebstamp" width="100rem" src=".img/image2.png" alt="iwebstamp">
      
    <div id="footer-sentence">
      <div id="first-sentence">
        <span class="charge">��� :</span>
        <span>���� : </span>
        <span class="personalbest">��ǥ : </span>
      </div>
      <div id="sec-sentence">
        <span class="data">���� : </span>
        <span class="receiving">����</span>
        <span>( 255   )</span>
      </div>
      <div id="last-sentence">
        <span>�� 03736 / �ּ�</span>
        <span class="address">����Ư���� ������ �ź���� 37,<br> DMC�������¿������� 605ȣ</span>
        <span>/ http://www.i-web.kr</span>
      </div>
    </div>
    </footer>
  </body>
</html>
