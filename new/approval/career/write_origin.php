<?
		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$actxt01 = $row["actxt01"]; // ȸ���
		$cmp_num = $row["cmp_num"]; // ����� ��ȣ
		$cmp_adr = $row["cmp_adr"]; // ������
		$ceo_nm = $row["ceo_nm"]; // ��ǥ�̻� ����

		$rDate = date('Y'); // ���糯¥ ��
		$rDate2 = date('m'); // ���糯¥ ��
		$rDate3 = date('d'); // ���糯¥ ��

		if($type == 'edit' && $uid){
			$sql = "select * from wo_proof where uid='$uid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$userid = $row['userid'];
		}


?>

  <style>
		:root {
		--main-bg-color: #e2e8f4;
		--main-border-color: #796C98;
		--sub-border-color: #f6f6f6;
		}
    .container {
      width: 950px;
      margin: 0 auto;
	  color:black;
    }
    main {
      position: relative;
    }
    header {
	  font-size:18px;
      text-align: center;
      position: relative;
      margin: 100px 0 50px;
    }
    .logo {
      position: absolute;
      top:-80px;
      left: 0;
    }
    .logo img {
      width: 120px;    
    }
	h1 {
	  font-size:50px;
	}
	h3 {
	  font-size:30px;
	}
    #print_wrap {
      position: absolute;
      top: 0;
      right: 0;
    }
    #printBtn {
      cursor: pointer;
      font-size: 15px;
      padding: 10px 20px;
      color: white;
      background-color: rgb(97, 105, 107);
      border-radius: 5px;
      border: none;
    }
    #printBtn:hover {
      background-color: rgb(51, 51, 51);;
    }
    .formTable {
      border-top: 2px solid var(--main-border-color);
      border-bottom: 2px solid var(--main-border-color);
      border-collapse: collapse;
      margin-bottom: 40px;
    }
    .formTable th, 
    .formTable td{
      border: 1px solid #dee1e6;
      line-height: 50px;
			border-right: none;
			border-left: none;
    }
    .formTable th {
	  font-size: 18px;
      width: 300px;
      text-align: center; 
      background-color: var( --main-bg-color);
    }
    .formTable td {
	  font-size:24px;
	  color:black;
      padding-left:25px;
      width: 32%;      
    }
    .formTable2 td {
	  font-size:18px;
      padding-left: 0;
      text-align: center;
      width: 15.5%;      
    }
	input {
		font-size:24px;
		color:black;
		border:none;
		outline:none;
	}
    select {
	  color:black;
	  font-size:35px;
      border: 1px solid rgb(177, 177, 177);
      border-radius: 5px;
      font-size: 20px;
      width: 180px;
      height: 34px;
      cursor: pointer;
      outline: none;
	  margin-right:10px;
	  text-align: center;
    }
	option {
	  font-size:20px;
	  color:brgb(51,51,51);
	}
    .no_print {
	  color:black;
      border: 2px dashed #ee0000;
    }
    .tailContent {
      text-align: center;
      margin-top: 90px;
    }
    .tailContent > p {
	  color:black;
      font-weight: bold;
      font-size: 24px;
      margin-bottom: 90px;
    }
    .datetime {
      font-size: 22px;
      line-height: 14px;
      padding-top: 0;
    }
    footer {
	  position:relative;
      font-size: 22px;
      color: rgb(37, 37, 37);
      text-align: center;
      margin-bottom: 60px;
    }
    #sign {
	  cursor:pointer;
	  display:inline-block;
	  width:75px;
	  height:75px;
	  background: url(/images/dojang2.png);
      font-size: 22px;
      font-weight: normal;
	  position:relative;
	  top:0;
	  line-height:75px;
	}
	.mt {
		margin-top: 100px;
	}

    @media print {
		body {background:none;}
	  .container {
		margin:0;
		padding-top:50px;
		padding-left:65px;
	  }
      .no_print, .none_print {
        display: none !important;
      }
      select {
        border: none;
      }
      select {
        -webkit-appearance:none; /* for chrome */
        -moz-appearance:none; /*for firefox*/
        appearance:none;
      }
      select::-ms-expand{
        display: none; /*for IE10,11*/
      }
	  #userid {
	  	font-size: 24px;
	  }
	  #useSpace > select {
	  	font-size: 24px;
	  }
	  #stamp {
		display: none;
	  }

	  footer {
        position: absolute;
		margin-top: 0px;
        bottom: 0;
		right: 160px;
	  }
	  footer > h3 {
	    font-size: 40px;
	  }
    }
  </style>

<script language='javascript'>

function setUserID() {
	
	userid = $("#userid option:selected").val(); // userid�� select������ �ۿ�

	$('#name').val(''); // ���� input value id�� name�� �� �����ͼ� �ʱ�ȭ ��Ű�� ���� ('') null�� ��Ƽ� ������ �ʱ�ȭ ��Ų��
	$('#securi').val(''); // �ֹε�Ϲ�ȣ ���ڸ�
	$('#securi2').val(''); // �ֹε�Ϲ�ȣ ���ڸ�
	$('#zipcode').val(''); // �����ȣ
	$('#addr01').val(''); // �ּ�1
	$('#addr02').val(''); // �ּ�2
	$('#team').val(''); // �Ҽ�
	$('#affil').val(''); // ����
	$('#idate01').val(''); // �����Ⱓ ��
	$('#idate02').val(''); // �����Ⱓ ��
	$('#idate03').val(''); // �����Ⱓ ��

	if(userid){
		$.post('./jsonUser.php',{'userid':userid}, function(req){ // json ������� �����Ͽ� ���ϰ� �ޱ�.
			
			parData = JSON.parse(req); // ���ڿ� ���� �м�, ��ü����
			
			name = parData['name']; // name�̶�� ��ü�� ����
			securi = parData['securi'];
			securi2 = parData['securi2'];
			//zipcode = parData['zipcode'];
			addr01 = parData['addr01'];
			addr02 = parData['addr02'];
			team = parData['team'];
			affil = parData['affil'];
			idate01 = parData['idate01'];
			idate02 = parData['idate02'];
			idate03 = parData['idate03'];
			pdate01 = parData['pdate01'];
			pdate02 = parData['pdate02'];
			pdate03 = parData['pdate03'];


			if(securi && securi2)			$('#regNumber').text(securi +' - '+ securi2); // �ֹε�Ϲ�ȣ ���ڸ�+���ڸ� �ؽ�Ʈ��.
			else									$('#regNumber').text(''); // �ֹε�Ϲ�ȣ ���ڸ�+���ڸ� �ؽ�Ʈ��.

			if(addr01 && addr02)			$('#addr').text(addr01+' '+addr02); // �ּ�1+�ּ�2 �ؽ�Ʈ��.
			else									$('#addr').text(''); // �ּ�1+�ּ�2 �ؽ�Ʈ��.
		
			$('#team').text(team); // �Ҽ�
			$('#affil').text(affil);
			if(pdate01 && pdate02)		$('#date').text(idate01+'�� '+idate02+'�� '+idate03+'�� ~ '+pdate01+'�� '+pdate02+'�� '+pdate03+'��');
			else									$('#date').text(idate01+'�� '+idate02+'�� '+idate03+'�� ~ '+<?=$rDate?>+'�� '+<?=$rDate2?>+'�� '+<?=$rDate3?>+'�� (���� ������)');
			
			$('#drafter').text(name);
/*
			$('#name').val(name); // ���� �ٽ� name�̶�� ������ ��´�.
			$('#securi').val(securi); // �ֹε�Ϲ�ȣ ���ڸ�
			$('#securi2').val(securi2); // �ֹε�Ϲ�ȣ ���ڸ�
			$('#zipcode').val(zipcode); // �����ȣ
			$('#addr01').val(addr02); // �ּ�1
			$('#addr02').val(addr02); // �ּ�2
			$('#team').val(team); // �Ҽ�
			$('#affil').val(affil); // ����
			$('#idate01').val(idate01); // �����Ⱓ ��
			$('#idate02').val(idate02); // �����Ⱓ ��
			$('#idate03').val(idate03); // �����Ⱓ ��
			$('#pdate01').val(pdate01); // �����Ⱓ ��
			$('#pdate02').val(pdate02); // �����Ⱓ ��
			$('#pdate03').val(pdate03); // �����Ⱓ ��

*/
		});
	}
}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='mtype' value='<?=$mtype?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='type' value='<?=$type?>'>


<!-- �˻����� -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>
<input type='hidden' name='f_site' value='<?=$f_site?>'>
<input type='hidden' name='f_naverID' value='<?=$f_naverID?>'>
<input type='hidden' name='f_daumID' value='<?=$f_daumID?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>

  <div class="container">
    <header>
      <h1>��&nbsp&nbsp&nbsp&nbsp��&nbsp&nbsp&nbsp&nbsp��&nbsp&nbsp&nbsp&nbsp��&nbsp&nbsp&nbsp&nbsp��</h1>
      <div class="logo">
        <img src="/images/iweblogo.jpg" alt="�ΰ�">
      </div>
      <div id="print_wrap">
        <button id="printBtn" class="no_print">�μ��ϱ�</button>
      </div>
    </header>
    <main>
      <h3 class="mt">1. ��������</h3>
      <table class="formTable">
        <tr>
          <th>��&nbsp;&nbsp; ��</th>
          <td id="nameSpace">
            <select name='userid' id="userid" onchange="setUserID()">
				<option value=''>::�������::</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_userid[$i]?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
          </td>
          <th>�ֹε�Ϲ�ȣ</th>
          <td id="regNumber"></td>
        </tr>
        <tr>
          <th>��&nbsp;&nbsp; ��</th>
          <td colspan="3" id="addr">
        </tr>
      </table>
      <h3 class="mt">2. ��������</h3>
      <table class="formTable">
        <tr>
          <th>ȸ���</th>
          <td id="comName"><input type="text" value="<?=$actxt01?>" readonly></td>
          <th>����ڹ�ȣ</th>
          <td id="comNumber"><input type="text" value="<?=$cmp_num?>" readonly></td>
        </tr>
        <tr>
          <th>������</th>
          <td colspan="3" id="comAddr"><input type="text" style='width:90%' value="<?=$cmp_adr?>" readonly></td>
        </tr>
        <tr>
          <th>��&nbsp;&nbsp; ��</th>
          <td id='team'></td>
          <th>����/����</th>
          <td id="affil"></td>
        </tr>
        <tr>
          <th>�����Ⱓ</th>
          <td colspan="3" id="date"></td>
        </tr>
        <tr>
          <th>���뵵</th>
          <td colspan="3" id="useSpace">
			<select name='puse'>
				<option value=''>::���뵵::</option>
				<option value='����Ȯ�ο�'<? echo $puse =='����Ȯ�ο�' ? 'selected':''?>>����Ȯ�ο�</option>
				<option value='���������'<? echo $puse =='���������' ? 'selected':''?>>���������</option>
				<option value='���������'<? echo $puse =='���������' ? 'selected':''?>>���������</option>
				<option value='��Ÿ'<? echo $puse =='��Ÿ' ? 'selected':''?>>��Ÿ</option>
			</select>
          </td>
        </tr>
      </table>
      <div class="no_print mt">
        <h3>3. ��������</h3>
        <table class="formTable formTable2">
          <tr>
            <th>������ȣ</th>
            <td><?=date('y').'-'.date('mdhis')?></td>
            <th>��������</th>
            <td>����</td>
            <th>��������</th>
            <td>3��</td>
          </tr>
          <tr>
            <th>���ȵ��</th>
            <td>L3</td>
            <th>����ó</th>
            <td>�λ���</td>
            <th>�����</th>
            <td id="drafter"></td>
          </tr>
        </table>
      </div>
    </main>
    <footer>
	
      <div class="tailContent">
        <p>������� ���� ���� �����ϰ� ������ �����մϴ�.</p>
        <p id="today"></p>
      </div>
      <h3>�ֽ�ȸ�� ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        ��ǥ�̻�&nbsp;&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;
        <span id="sign">(��)</span></h1>
    </footer>
  </div>
</form>

  <script>
    const printBtn = document.getElementById("printBtn");
    const today = document.getElementById("today");
	const sign = document.getElementById("sign");
//	const stamp = document.getElementById("stamp");

    const todayYear = new Date().getFullYear();
    let todayMonth = new Date().getMonth() + 1;
    let todayDate = new Date().getDate();

    if(todayMonth < 10) {
      todayMonth = "0" + todayMonth;
    }
    if(todayDate < 10){
      todayDate = "0" + todayDate;
    }
    today.textContent = `${todayYear}�� ${todayMonth}�� ${todayDate}��`

    printBtn.addEventListener("click", function(){
      window.print()
    })
	/*
	stamp.addEventListener("change", function(){
		if(stamp.value == '��������'){
			sign.style.background = 'url(/images/dojang2.png)';
		} else {
			sign.style.background = 'none';
		}
    })*/
  </script>