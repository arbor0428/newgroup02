<?
include "../../head.php";
include "./holidayApi.php";


$sql = "select * from wo_leave";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$sql2 = "select uid from wo_leave order by uid desc";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_array($result2);
$uid = $row2['uid'];

$sessionId = $_SESSION['ses_id']; //���� �α������� ���

if ($type == 'edit' && $uid) {
  $sql = "select * from wo_leave where uid='$uid'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);

  $userid = $row['userid'];
}


//////////////////
//// ������ ��� ////
//////////////////
$sql = "select * from wo_member where userid='$f_userid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$idate01 = $row['idate01'];

//�ٹ����
$wYear = $f_year - $idate01;

//�߻��� ������
if ($wYear <= 2)      $DayOff = 15;
elseif ($wYear <= 4)    $DayOff = 16;
elseif ($wYear <= 6)    $DayOff = 17;
elseif ($wYear <= 8)    $DayOff = 18;
elseif ($wYear <= 10)    $DayOff = 19;
elseif ($wYear <= 12)    $DayOff = 20;
elseif ($wYear <= 14)    $DayOff = 21;
elseif ($wYear <= 16)    $DayOff = 22;
elseif ($wYear <= 18)    $DayOff = 23;
elseif ($wYear <= 20)    $DayOff = 24;
else              $DayOff = 25;

//��ȸ���ڱ��� ����� ������
$sTime = mktime(0, 0, 0, $f_month, 1, $f_year);
$eTime = mktime(0, 0, 0, $f_month, $day_last, $f_year);

$syTime = mktime(0, 0, 0, 1, 1, $f_year);
$eyTime = mktime(0, 0, 0, 12, 31, $f_year);

$sql = "select * from wo_dayoff where userid='$f_userid' and rTime>=$syTime and rTime<=$eyTime";
$result = mysql_query($sql);
$UseOff = mysql_num_rows($result);


$OffArr = array();

for ($i = 0; $i < $UseOff; $i++) {
  $row = mysql_fetch_array($result);
  $OffArr[$i] = $row['rTime'];
}

//���� ������
$ModOff = $DayOff - $UseOff;
//------------------
$sql3 = "select name,affil,userid from wo_member where enable = 1 "; //���� �ٹ����� ������ �̸�
$result3 = mysql_query($sql3);
$arr = array();
$arr2 = array();
$arr3 = array();

while ($row3 = mysql_fetch_array($result3)) {
  array_push($arr, $row3['name']);
  array_push($arr2, $row3['affil']);
  array_push($arr3, $row3['userid']);
}
?>


<link rel="stylesheet" href="./leave.css"">


<div class=" container">
<header>
  <h1>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;û&nbsp;&nbsp;��</h1>
  <div class="logo">
    <img src="/images/iweblogo.jpg" alt="�ΰ�">
  </div>
  <div id="print_wrap">
    <button id="printBtn" class="no_print">�μ��ϱ�</button>
  </div>
</header>
<main>
  <form name="FRM" action="<?= $PHP_SELF ?>" method="post" enctype='multipart/form-data' id="frm">
    <input type='hidden' name='type' value='' />
    <input type='hidden' name='upfile01' value="<?= $upfile01 ?>" />
    <input type='hidden' name='realfile01' value="<?= $realfile01 ?>" />

    <div class="agreeForm">
      <table class="agreeTable" id="agreeTableWrap">
        <div class="dealCheckBox">
          ����<input type="checkbox" onclick="getCheckValue(event)" />
          <input type="button" onclick="removeTable();" value="����">
        </div>
        <tr id="agreeTr">
          <th rowspan="3" class="agreeTitle">��<br /><br />��</th>
          <th id="agreeth1">�����</th>
          <th id="agreeth2"></th>

        </tr>
        <tr id="agreeTr2">
          <td class="agreeWrap">
            <div class="sign">
            </div>
            <span>

            </span>
          </td>
          <td class="agreeWrap">
            <div class="sign" name="stauts"></div>
          </td>
        </tr>

        <tr id="agreeTr3">
          <td>
            <select class="agreeSelect" id="agreeSelect1" name="agree1" onchange="setDrafter(event)">
              <option></option>
              <? for ($i = 0; $i < count($arr); $i++) { ?>
                <option value="<?= $arr3[$i] ?>" <? if ($_SESSION['ses_id'] === $arr3[$i]) echo 'selected'; ?>><?= $arr[$i] ?></option>
              <?
              }
              ?>
            </select>
          </td>
          <td>
            <select class="agreeSelect" id="agreeSelect2" name="agree2" onchange="setValue(event)">
              <option value=""></option>
              <? for ($i = 0; $i < count($arr); $i++) { ?>
                <option value="<?= $arr3[$i] ?>"><?= $arr[$i] ?></option>
              <?
              }
              ?>
            </select>
            <input type="hidden" id="agreeSelect2Hidden" />
          </td>
        </tr>

      </table>
      <table class="dealTable" id="dealTable_1">
        <tr id="dealTr">
          <th rowspan="3" class="agreeTitle">��<br /><br />��</th>
          <th id="dealth1"></th>
        </tr>

        <tr id="dealTr2">
          <td class="agreeWrap">
            <div class="sign"></div>
            <span>

            </span>
          </td>

        <tr id="dealTr3">
          <td class="dTableTd">
            <select id="dealSelect1" name="deal1" onchange="setValue(event)">
              <option value=""></option>
              <? for ($i = 0; $i < count($arr); $i++) { ?>
                <option value="<?= $arr3[$i] ?>"><?= $arr[$i] ?></option>
              <?
              }
              ?>
            </select>
            <input type="hidden" id="dealSelect1Hidden" name="deal1" />
          </td>
        </tr>
      </table>
    </div>

    <div id="submitForm">
      <h2>1.&nbsp;&nbsp;��&nbsp;��&nbsp;��&nbsp;��</h2>
      <table class="formTable">
        <tr>
          <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;ȣ</th>
          <td>
            <input type='text' id="num" name='num' value='' readonly>
          </td>
        </tr>
        <tr>
          <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</th>
          <td>
            L2
          </td>
        </tr>
        <tr>
          <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</th>
          <td>
            5��
          </td>
        </tr>
        <tr>
          <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</th>
          <td>
            ����
          </td>
        </tr>
      </table>
      <table class="formTable2">
        <tr>
          <th>��&nbsp;&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;��</th>
          <td id="drafterWrap">
            <select name='userid' id="userid" class="drafter" onchange="setUserID()">
              <option value="">�������</option>
              <?
              for ($i = 0; $i < count($arr_member); $i++) {
              ?>
                <option value='<?= $arr_userid[$i] ?>' <? if ($sessionId == $arr_userid[$i]) echo 'selected'; ?>><?= $arr_member[$i] ?></option>
              <?
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <th>��&nbsp;��&nbsp;&nbsp;/&nbsp;&nbsp;��&nbsp;å</th>
          <td>
            <input type='text' id="affil" name='affil' value='<?= $affil ?>' readonly>
          </td>
        </tr>
        <tr>
          <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
          <td>
            <input type='text' id="team" name='team' value='<?= $team ?>' readonly>
          </td>
        </tr>
        <tr>
          <th>��&nbsp;&nbsp;&nbsp��&nbsp&nbsp;&nbsp;ó</th>
          <td>
            �������
          </td>
        </tr>
      </table>
      <h2>2.&nbsp;&nbsp;��&nbsp;��&nbsp;��&nbsp;��</h2>
      <table class="inputTable">
        <tr class="inputForm">
          <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
          <td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="title " placeholder="ex)�������� - 20220624"></textarea></td>
        </tr>
        <tr class="inputForm">
          <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
          <td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content" placeholder="ex)���� �������� ���Ͽ� �ް��� ��û�մϴ�."></textarea></td>
        </tr>
        <tr class="inputForm">
          <th>��&nbsp;��&nbsp;��&nbsp;��</th>
          <td id="dayoff_wrap">
            <select name="dayoff" id="dayoff" class="sort">
              <option value="">����</option>
              <option value="����">����</option>
              <option value="����">����</option>
              <option value="�����ް�">�����ް�</option>
              <option value="����ް�">����ް�</option>
              <option value="�����ް�">�����ް�</option>
              <option value="�ϰ��ް�">�ϰ��ް�</option>
              <option value="�����ް�">�����ް�</option>
              <option value="����">����</option>
              <option value="��Ÿ">��Ÿ</option>
            </select>
          </td>
        </tr>
        <tr class="inputForm">
          <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
          <td id="startdate_wrap">
            <input type="date" class="date " name="date1" id="startdate" max="9999-12-31">
            <select name="dayoff_sort1" id="dayoff_sort1" class="">
              <option value="">����</option>
              <option id="allOff" value="����">����</option>
              <option id="amOff" value="����">����</option>
              <option value="����">����</option>
            </select>
            <span id="hide">
              ~&nbsp;&nbsp;
              <input type="date" class="date " name="date2" id="enddate" max="9999-12-31">
              <select name="dayoff_sort2" id="dayoff_sort2" class="">
                <option value="">����</option>
                <option value="����">����</option>
                <option value="����">����</option>
              </select>
            </span>
            <span>(</span>
            <!--<span id="elapsed" name="elapsed">0</span>-->
            <input type="text" id="elapsed" name="elapsed" readonly />
            <span>�ϰ� )</span>
            <span class="no_print none_print" style="color:red;">
              <span>��������: </span>
              <span id="modOff"><?= $ModOff ?></span>
              <span>��</span>
            </span>
          </td>
        </tr>
      </table>
      <h2 id="etcTitle">3. ��Ÿ</h2>
      <table class="etcTable">
        <tr>
          <th>÷&nbsp;&nbsp; ��&nbsp;&nbsp; ��&nbsp;&nbsp; ��</th>
          <td>
            <input type="file" name="upfile01" class="searchfileInput">
          </td>
        </tr>
        <tr>
          <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�� </th>
          <td><textarea name="opinion" id="opinion" rows="1" class="title"></textarea></td>
        </tr>
      </table>
      <table class="submitTable">
        <tr>
          <td colspan="2">
            <div class="tailContent">
              <p>���� ���� ǰ���Ͽ��� �簡 �Ͽ� �ֽñ� �ٶ��ϴ�.</p>
              <p id="today"></p>
            </div>
          </td>
        </tr>
      </table>
      <div class="headline">
        <button type="submit" name="submit" id="submitBtn" class="no_print">���/����</button>
      </div>

    </div>
  </form>
</main>
<footer>
  <h1>��&nbsp;&nbsp;��&nbsp;&nbsp;ȸ&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</h1>
</footer>
</div>

<script src="./json/holiday1.json" type="text/javascript"></script>

<!-- pdf ���� ���̺귯�� -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script type="text/javascript" language='javascript'>
  //// ������ �ε�
  $(function() {
    setUserID();

    $('#today').text(getTodayStr());
  });


  //// ���� ����


  //// ���� �Լ�
  // userid ����
  function setUserID() {
    $('#userid').css({
      "text-align": "start"
    })
    userid = $("#userid option:selected").val(); // userid�� select������ �ۿ�

    $('#name').val(''); // ���� input value id�� name�� �� �����ͼ� �ʱ�ȭ ��Ű�� ���� ('') null�� ��Ƽ� ������ �ʱ�ȭ ��Ų��
    $('#team').val(''); // �Ҽ�
    $('#affil').val(''); // ����

    if (userid) {
      $.post('./jsonUser.php', {
        'userid': userid
      }, function(req) { // json ������� �����Ͽ� ���ϰ� �ޱ�.

        parData = JSON.parse(req); // ���ڿ� ���� �м�, ��ü����

        name = parData['name']; // name�̶�� ��ü�� ����

        team = parData['team'];
        affil = parData['affil'];

        $('#team').val(team); // �Ҽ�
        $('#affil').val(affil);
        $('#drafter').val(name);
        const teamName = $('#team').val(team).val();
        let teamNum = '0';
        if (teamName == '��ȹ��') {
          teamNum = '0101';
        }
        if (teamName == '������' || teamName == '1��') {
          teamNum = '0201';
        }
        if (teamName == '2��') {
          teamNum = '0202';
        }
        if (teamName == '�������') {
          teamNum = '0301';
        }
        if (teamNum == '') {
          teamNum = '0000';
        }

        pushDate(teamNum);
      });
    }
  }

  // ���� ��¥
  function getTodayStr() {
    const todayYear = new Date().getFullYear();
    let todayMonth = new Date().getMonth() + 1;
    let todayDate = new Date().getDate();
    let todayHour = new Date().getHours();
    let todayMin = new Date().getMinutes();

    if (todayMonth < 10) {
      todayMonth = "0" + todayMonth;
    }
    if (todayDate < 10) {
      todayDate = "0" + todayDate;
    }
    if (todayHour < 10) {
      todayHour = "0" + todayDate;
    }
    if (todayMin < 10) {
      todayMin = "0" + todayDate;
    }
    let str = `${todayYear} ��  ${todayMonth} �� ${todayDate} �� `;

    return str;
  }

  // option���ý� th�� text �ٲ�.
  function setValue(event) {
    const index = event.target.id;
    //������ onchange
    if (index.includes('agree')) {
      const indexNum = index.substring(11, 12);
      let userid = $(`#${index} option:selected`).val();
      $.post('./jsonUser.php', {
        'userid': userid
      }, function(req) { //���̵�� �˻�
        const parData = JSON.parse(req);
        const name = parData['name'];
        const affil = parData['affil'];
        if (name !== "" && affil == '') {
          alert('�λ�������� ������ �߰��Ͽ� �ּ���.');
          $(`#agreeTr th:eq(${indexNum})`).text("")
          return false;
        }
        if (name == "") {
          alert('�����ڸ� �������ּ���');
          $(`#agreeTr th:eq(${indexNum})`).text("")
          return false;
        }
        $(`#agreeTr th:eq(${indexNum})`).text(affil); //th�� ���� ǥ��

        //hidden���� userid �ѱ�.
        $(`#agreeSelect${indexNum}Hidden`).attr('value', userid);
        const hiddenId = $(`#agreeSelect${indexNum}Hidden`);


        //select�� �������̺� �߰�
        const select = $(`#${index}`).is('select');
        if (indexNum > 1 && select && !$(`#${index}`).hasClass('selected')) {
          tableAdd(userid);
          $(`#${index}`).addClass('selected');
        }

      });
      //������ onchange
    } else if (index.includes('deal')) {

      const indexNum = index.substring(10, 11);

      const userid = $(`#${index} option:selected`).val();
      $.post('./jsonUser.php', {
        'userid': userid
      }, function(req) {
        const parData = JSON.parse(req);
        const name = parData['name'];
        const affil = parData['affil'];
        if (name !== "" && affil == '') {
          alert('�λ�������� ������ �߰��Ͽ� �ּ���.');
          $(`#dealTr th:eq(${indexNum})`).text("")
          return false;
        }
        if (name == "") {
          alert('�����ڸ� �������ּ���');
          $(`#dealTr th:eq(${indexNum})`).text("")
          return false;
        }
        $(`#dealTr th:eq(${indexNum})`).text(affil);
        //hidden���� userid �ѱ�.
        $(`#dealSelect${indexNum}Hidden`).attr('value', userid);

        //select�� �������̺� �߰�
        const select = $(`#${index}`).is('select');
        if (select && !$(`#${index}`).hasClass('selected')) {
          AddDeal(userid);
          $(`#${index}`).addClass('selected');
        }
      });
    } else {
      alert('�����Դϴ�.');
    }
  }

  function tableAdd(userid) {
    let num = 0;

    num = $('#agreeTr3 td').length - 2;
    let dealWidth = $('.dealTable').width();
    const agreeWidth = $('.agreeTable').width();

    if (dealWidth + agreeWidth > 800 || num + 2 > 4) {
      alert('�ִ� ������ �ʰ��Ͽ����ϴ�.');
    } else {
      const agreeWrap = $('.agreeWrap:eq(1)').clone();
      const agreeSelect = $('#agreeTr3 td:eq(1)').clone();
      const test = $('#agreeth2').clone().text("");

      test.attr('id', 'agreeth' + (num + 3));
      $('#agreeTr').append(test);
      $('#agreeTr2').append(agreeWrap);
      $('#agreeTr3 td:eq(1)').clone();
      agreeSelect.children().eq(0).attr('id', 'agreeSelect' + (num + 3));
      agreeSelect.children().eq(0).attr('name', 'agree' + (num + 3));
      agreeSelect.children().eq(0).attr('class', '');
      agreeSelect.children().eq(1).attr('id', 'agreeSelect' + (num + 3) + 'Hidden'); //Hidden���̵� ����
      agreeSelect.children().eq(1).attr('name', 'agree' + (num + 3)); //
      $('#agreeTr3').append(agreeSelect);

    }
    num += 1;
  }

  // �������̺�
  function getCheckValue(event) {

    if (event.target.checked) {
      $('#dealTable1').css({
        "display": "table"
      });
      $('#dealTable_1').css({
        "display": "table"
      });
    } else {

      $('#dealTable1').css({
        "display": "none"
      });
      $('#dealTable_1').css({
        "display": "none"
      });
      $('#dealTable_1>tbody').css({
        "width": "0px"
      });
      //���� üũ�� Ǯ�� ����
      const length = $('.dTableTd select').length;
      for (let i = 1; i < length; i++) {
        $('#dealSelect' + i).removeClass('selected');
        $('#dealSelect' + i).val('');
        $('#dealSelect' + i + 'Hidden').val('');
        removeDealTable();
      }
    }

  }

  //�������̺� �߰�
  function AddDeal(userid) {

    num = $('#dealTr3 td').length;

    let dealWidth = $('.dealTable').width();
    const agreeWidth = $('.agreeTable').width();
    if ($('.dealTable').css("display") === "none") {

    }
    if (dealWidth + agreeWidth > 800 || num > 4) {
      alert('�ִ� ������ �ʰ��Ͽ����ϴ�.');
    } else {


      const agreeWrap2 = $('#dealTr2 .agreeWrap:eq(0)').clone();
      const selectDeal = $('#dealTr3 td:eq(0)').clone();
      $('#dealTr2 ').append(agreeWrap2);
      const test = $('#dealth1').clone().text("");

      test.attr('id', 'dealth' + (num + 1));
      $('#dealTr').append(test);

      selectDeal.children().eq(0).attr('id', 'dealSelect' + (num + 1));
      selectDeal.children().eq(0).attr('name', 'deal' + (num + 1));
      selectDeal.children().eq(0).attr('class', '');
      selectDeal.children().eq(1).attr('id', 'dealSelect' + (num + 1) + 'Hidden');
      selectDeal.children().eq(1).attr('name', 'deal' + (num + 1));
      $('#dealTr3').append(selectDeal);

    }
    num += 1;
  }

  function removeTable() {
    if ($('#agreeTr3 td').length < 3) {
      alert('�����ڴ� �Ѹ� �̻��̿��� �մϴ�.');
      return;
    } else {
      $('#agreeTr th:last').remove();
      $('#agreeTr2 td:last').remove();
      $('#agreeTr3 td:last').remove();
    }
  }

  function removeDealTable() {
    $('#dealTr th:last').remove();
    $('#dealTr2 td:last').remove();
    $('#dealTr3 td:last').remove();
  }

  // �ް� �Ⱓ
  function setLeaveDateRange(params) {

  }

  //// �̺�Ʈ
  // ��ư - �μ��ϱ�
  printBtn.addEventListener("click", function() {
    if ($('.searchfileInput').val() == '' && $('#opinion').val() == '') {
      $('#etcTitle').addClass('no_print none_print');
      $('.etcTable').addClass('no_print none_print');
      $('footer').css({
        "margin-top": "250px"
      });
    } else if ($('.searchfileInput').val() || $('#opinion').val()) {
      $('#etcTitle').removeClass('no_print none_print');
      $('.etcTable').removeClass('no_print none_print');
      $('footer').css({
        "margin-top": "60px"
      });
    }
    window.print()
  })
  // ��ư - ���/����
  frm.addEventListener("submit", function(e) {

    if (mainTitle.value == "") {
      alert("������ �Է��� �ּ���.")
      mainTitle.focus();
      e.preventDefault()
      return false;
    };

    if (content.value == "") {
      alert("������ �Է��� �ּ���.")
      content.focus();
      e.preventDefault()
      return false;
    };

    if (dayoff.value == "") {
      alert("�ް� ������ ������ �ּ���.")
      dayoff.focus();
      e.preventDefault()
      return false;
    };

    if (startDay.value == "") {
      alert("�Ⱓ�� �Է��� �ּ���.")
      startDay.focus();
      e.preventDefault()
      return false;
    };

    if (dayoff_sort1.value == "") {
      alert("���׸��� ������ �ּ���.")
      dayoff_sort1.focus();
      e.preventDefault()
      return false;
    };

    if (dayoff.value !== "����") {
      if (endDay.value == "") {
        alert("�Ⱓ�� �Է��� �ּ���.")
        endDay.focus();
        e.preventDefault()
        return false;
      };

      if (dayoff_sort2.value == "") {
        alert("���׸��� ������ �ּ���.")
        dayoff_sort2.focus();
        e.preventDefault()
        return false;
      };
    }



    if ($('#agreeTr th:last').text("")) {
      removeTable();
    }
    if ($('#dealTr th:last').text("")) {
      removeDealTable();
    }

    if (confirm("�ް� ��û�� �Ͻðڽ��ϱ�?")) {
      const FRM = document.FRM;
      FRM.type.value = 'write';
      FRM.action = 'proc2.php';
      FRM.submit();

    }


    //�Ѿ�� �����Ͱ�(���� ��� �ϼ��� ���ڿ�Ÿ������ ����. �ʿ信 ���� ���������� �����ؾ���.)
    let startYear = startDay.value.substr(0, 4);
    let startMonth = startDay.value.substr(5, 2);
    let startDate = startDay.value.substr(8, 2);
    let endYear = endDay.value.substr(0, 4);
    let endMonth = endDay.value.substr(5, 2);
    let endDate = endDay.value.substr(8, 2);
    const date1 = new Date(startYear, startMonth, startDate);
    const date2 = new Date(endYear, endMonth, endDate);
    const elapsedMSec = date2.getTime() - date1.getTime();
    const elapsedDay = elapsedMSec / 1000 / 60 / 60 / 24;


  });
</script>