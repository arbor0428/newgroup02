<?
$sessionId = $_SESSION['ses_id']; //���� �α������� ���

// ���� �α��� ���� ��� ����
$sql = "select * from wo_member where userid='$sessionId'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

// $userid = $row['userid'];
$name = $row['name'];
$affil = $row['affil'];
$team = $row['team'];


$sql2 = "select userid, name, affil from wo_member where enable = 1 "; //���� �ٹ����� ������ �̸�
$result2 = mysql_query($sql2);

$members = array();

while ($row2 = mysql_fetch_array($result2)) {
  $data = array(
    'userid' => $row2['userid'],
    'name' => $row2['name'],
    'affil' => $row2['affil']
  );
  array_push($members, $data);
}

// $sql = "select * from wo_leave";
// $result = mysql_query($sql);
// $row = mysql_fetch_array($result);

// $sql2 = "select uid from wo_leave order by uid desc";
// $result2 = mysql_query($sql2);
// $row2 = mysql_fetch_array($result2);
// $uid = $row2['uid'];


// if ($type == 'edit' && $uid) {
//   $sql = "select * from wo_leave where uid='$uid'";
//   $result = mysql_query($sql);
//   $row = mysql_fetch_array($result);

//   $userid = $row['userid'];
// }




//// ������ ��� ////
// $sql = "select * from wo_member where userid='$f_userid'";
// $result = mysql_query($sql);
// $row = mysql_fetch_array($result);

// $idate01 = $row['idate01'];



//�ٹ����
// $wYear = $f_year - $idate01;

//�߻��� ������
// if ($wYear <= 2) $DayOff = 15;
// elseif ($wYear <= 4) $DayOff = 16;
// elseif ($wYear <= 6) $DayOff = 17;
// elseif ($wYear <= 8) $DayOff = 18;
// elseif ($wYear <= 10) $DayOff = 19;
// elseif ($wYear <= 12) $DayOff = 20;
// elseif ($wYear <= 14) $DayOff = 21;
// elseif ($wYear <= 16) $DayOff = 22;
// elseif ($wYear <= 18) $DayOff = 23;
// elseif ($wYear <= 20) $DayOff = 24;
// else $DayOff = 25;

//��ȸ���ڱ��� ����� ������
// $sTime = mktime(0, 0, 0, $f_month, 1, $f_year);
// $eTime = mktime(0, 0, 0, $f_month, $day_last, $f_year);

// $syTime = mktime(0, 0, 0, 1, 1, $f_year);
// $eyTime = mktime(0, 0, 0, 12, 31, $f_year);

// $sql = "select * from wo_dayoff where userid='$f_userid' and rTime>=$syTime and rTime<=$eyTime";
// $result = mysql_query($sql);
// $UseOff = mysql_num_rows($result);


// $OffArr = array();

// for ($i = 0; $i < $UseOff; $i++) {
//   $row = mysql_fetch_array($result);
//   $OffArr[$i] = $row['rTime'];
// }

//���� ������
// $ModOff = $DayOff - $UseOff;
// //------------------
// $sql3 = "select name,affil,userid from wo_member where enable = 1 "; //���� �ٹ����� ������ �̸�
// $result3 = mysql_query($sql3);
// $arr = array();
// $arr2 = array();
// $arr3 = array();

// while ($row3 = mysql_fetch_array($result3)) {
//   array_push($arr, $row3['name']);
//   array_push($arr2, $row3['affil']);
//   array_push($arr3, $row3['userid']);
// }
?>

<div class="title">
  <div>
    <a href='up_index.php?type=list' class="big cbtn black">���</a>
  </div>
</div>
<div class="write-cont">
  <form name="FRM" action="<?= $PHP_SELF ?>" method="post" enctype='multipart/form-data' id="frm">
    <header>
      <h1>�ް���û��</h1>
      <div class="logo">
        <img src="/images/iweblogo.jpg" alt="�ΰ�">
      </div>
      <div class="submitWrap">
        <button class="submitBtn">���/����</button>
      </div>
    </header>

    <main>
      <input type='hidden' name='type' value='' />
      <input type='hidden' name='upfile01' value="<?= $upfile01 ?>" />
      <input type='hidden' name='realfile01' value="<?= $realfile01 ?>" />

      <div class="agreeForm">
        <div class="sign-wrap">
       

          <div class="deal-sign">
            <span>����</span>
            <input type="button" id="addDealBtn" value="&#43;" onclick="addDeal()">
            <input type="button" id="removeDealBtn" value="&#45;" onclick="removeDeal()">
          </div>

          <div class="agree-sign">
            <span>����</span>
            <input type="button" id="addAgreeBtn" value="&#43;" onclick="addAgree()">
            <input type="button" id="removeAgreeBtn" value="&#45;" onclick="removeAgree()">
          </div>
        </div>

        <table class="agreeTable">
          <tr>
            <th rowspan="3">��<br /><br />��</th>
            <th>�����</th>
            <th></th>
          </tr>

          <tr>
            <td class="sign">
            </td>
            <td class="sign">
            </td>
          </tr>

          <tr>
            <td style="font-size: 16px;"><?= $name ?></td>
            <td class="agreeName">
              <select name="agree2" onchange="setValue('agreeTable')">
                <option value="">����</option>
                <? for ($i = 0; $i < count($members); $i++) { ?>
                  <option value="<?= $members[$i]['userid'] ?>"><?= $members[$i]['name'] ?></option>
                <? } ?>
              </select>
             
            </td>
          </tr>
        </table>

        <table class="dealTable">
          <tr>
            <th rowspan="3">��<br /><br />��</th>
            <th></th>
          </tr>

          <tr>
            <td class="sign">
            </td>
          <tr>
            <td class="dealName">
              <select name="deal1" onchange="setValue('dealTable')">
                <option value="">����</option>
                <? for ($i = 0; $i < count($members); $i++) { ?>
                  <option value="<?= $members[$i]['userid'] ?>"><?= $members[$i]['name'] ?></option>
                <? } ?>
              </select>
            
            </td>
          </tr>
        </table>
      </div>

      <div class="submitForm">
        <h2>1. ��������</h2>
        <table class="formTable">
          <tr>
            <th>������ȣ</th>
            <td>
              <input type='text' id="num" name='num' value='' readonly>
            </td>
          </tr>
          <tr>
            <th>���ȵ��</th>
            <td>
              L2
            </td>
          </tr>
          <tr>
            <th>��������</th>
            <td>
              5��
            </td>
          </tr>
          <tr>
            <th>��������</th>
            <td>
              ����
            </td>
          </tr>
        </table>
        <table class="formTable2">
          <tr>
            <th>�����</th>
            <td>
              <input type='text' id="name" name='name' value='<?= $name ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>���� / ��å</th>
            <td>
              <input type='text' id="affil" name='affil' value='<?= $affil ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>�μ�</th>
            <td>
              <input type='text' id="team" name='team' value='<?= $team ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>����ó</th>
            <td>
              �������
            </td>
          </tr>
        </table>
        
        <h2>2. ���γ���</h2>
        <table class="inputTable">
          <tr class="inputForm">
            <th>����</th>
            <td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="mainTitle" placeholder=""></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>����</th>
            <td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content" placeholder=""></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>�ް����� </th>
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
            <th>�Ⱓ</th>
            <td id="startdate_wrap">
              <input id="daterange" type="text" name="daterange" value="" />             
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
            <th>÷���ڷ�</th>
            <td>
							<input type='file' name='upfile01' class='file03' style='width:213px;'><?if($userfile01){?><br><input type='checkbox' name='del_upfile01' value='Y'>���� (<?=$realfile01?>)<?}?>             
            </td>
          </tr>
          <tr>
            <th>�ǰ� </th>
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
			
      </div>
    </main>
    <footer>
      <h1>�ֽ�ȸ�� ������</h1>
    </footer>
  </form>
</div>


<!-- <script src="./json/holiday1.json" type="text/javascript"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
  
	// ������ �ε�
  $(function() {
    $('#today').text(getTodayStr());
  });



  //// ���� ����
  var numOfAgree = 1;
  var numOfDeal = 1;

  //// ���� �Լ�
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
    let str = `${todayYear}��\u00a0\u00a0\u00a0\u00a0${todayMonth}��\u00a0\u00a0\u00a0\u00a0${todayDate}��`;

    return str;
  }

  // userid ����
/* function setUserID() {
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

        // pushDate(teamNum);
       });
     }
   }

*/
  // ���� ���̺� �߰�, ����
  function addAgree() {
    const agreeWidth = $('.agreeTable').width();
    const dealWidth = $('.dealTable').width();

    if (agreeWidth + dealWidth > 800 || numOfAgree + numOfDeal > 8) {
      console.log('�ִ� ������ �ʰ��Ͽ����ϴ�.');
      return;

    } else {
      let th = $('.agreeTable th').last().clone();
      let sign = $('.agreeTable .sign').last().clone();
      let name = $('.agreeTable .agreeName').last().clone();

      let val = $(name[0]).children().attr('name');
      let index = parseInt(val.replace('agree', ''));

      $(th[0]).text('');
      $(name[0]).children().attr('name', 'agree' + (++index));

      $('.agreeTable tr:nth-child(1)').append(th);
      $('.agreeTable tr:nth-child(2)').append(sign);
      $('.agreeTable tr:nth-child(3)').append(name);

      numOfAgree++;

      // ���� �߰�, ���� ���� ����
      let strPadding = $('.deal-sign').css('padding-right');
      $('.deal-sign').css('padding-right', parseInt(strPadding) + 103 + 'px');
    }
  }

  function removeAgree() {
    if (numOfAgree < 2) {
      console.log('�����ڴ� �Ѹ� �̻��̿��� �մϴ�.');
      return;
    } else {
      $('.agreeTable tr:nth-child(1) th').last().remove();
      $('.agreeTable tr:nth-child(2) td').last().remove();
      $('.agreeTable tr:nth-child(3) td').last().remove();

      numOfAgree--;

      // ���� �߰�, ���� ���� ����
      let strPadding = $('.deal-sign').css('padding-right');
      $('.deal-sign').css('padding-right', parseInt(strPadding) - 103 + 'px');
    }
  }

  // ���� ���̺� �߰�, ����
  function addDeal() {
    const agreeWidth = $('.agreeTable').width();
    const dealWidth = $('.dealTable').width();

    if (agreeWidth + dealWidth > 800 || numOfAgree + numOfDeal > 8) {
      console.log('�ִ� ������ �ʰ��Ͽ����ϴ�.');
      return;

    } else {
      const th = $('.dealTable th').last().clone();
      const sign = $('.dealTable .sign').last().clone();
      const name = $('.dealTable .dealName').last().clone();

      let val = $(name[0]).children().attr('name');
      let index = parseInt(val.replace('deal', ''));

      $(th[0]).text('');
      $(name[0]).children().attr('name', 'deal' + (++index));

      $('.dealTable tr:nth-child(1)').append(th);
      $('.dealTable tr:nth-child(2)').append(sign);
      $('.dealTable tr:nth-child(3)').append(name);

      numOfDeal++;
    }
  }

  function removeDeal() {
    if (numOfDeal < 2) {
      console.log('�����ڴ� �Ѹ� �̻��̿��� �մϴ�.');
      return;
    } else {
      $('.dealTable tr:nth-child(1) th').last().remove();
      $('.dealTable tr:nth-child(2) td').last().remove();
      $('.dealTable tr:nth-child(3) td').last().remove();

      numOfDeal--;
    }
  }


  // �̸����ý� ���� �߰��ϱ�
  function setValue(table) {
    const userid = event.target.value;
    const name = event.target.name;
    const index = parseInt(name.replace('agree', '').replace('deal', ''));

    if (userid === '') {
      console.log('���� �ϼ���');
      $('.' + table + ' tr th:nth-of-type(' + (index + 1) + ')').text('');
      return;
    }

    $.post('./jsonUser.php', {
      'userid': userid
    }, function(req) {
      const data = JSON.parse(req);
      const affil = data['affil'];

      if (affil == '') {
        console.log('�λ�������� ������ �߰��Ͽ� �ּ���.');
        $('.' + table + ' tr th:nth-of-type(' + (index + 1) + ')').text('');
        return;
      } else {
        $('.' + table + ' tr th:nth-of-type(' + (index + 1) + ')').text(affil);
      }
     
    });
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
        $('#dealName' + i).removeClass('selected');
        $('#dealName' + i).val('');
        $('#dealName' + i + 'Hidden').val('');
        removeDeal();
      }
    }

  }



  // �ް�
  $('input[name="daterange"]').daterangepicker({
    "locale": {
      "format": "YYYY-MM-DD",
      "separator": " ~ ",
      "applyLabel": "Ȯ��",
      "cancelLabel": "���",
      "fromLabel": "From",
      "toLabel": "To",
      "customRangeLabel": "Custom",
      "weekLabel": "W",
      "daysOfWeek": ["��", "ȭ", "��", "��", "��", "��", "��"],
      "monthNames": ["1��", "2��", "3��", "4��", "5��", "6��", "7��", "8��", "9��", "10��", "11��", "12��"],
      "firstDay": 1
    },
    "drops": "down"
  }, function(start, end, label) {
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  });

  //// �̺�Ʈ
  // ��ư - �μ��ϱ�
  // printBtn.addEventListener("click", function() {
  //   if ($('.searchfileInput').val() == '' && $('#opinion').val() == '') {
  //     $('#etcTitle').addClass('no_print none_print');
  //     $('.etcTable').addClass('no_print none_print');
  //     $('footer').css({
  //       "margin-top": "250px"
  //     });
  //   } else if ($('.searchfileInput').val() || $('#opinion').val()) {
  //     $('#etcTitle').removeClass('no_print none_print');
  //     $('.etcTable').removeClass('no_print none_print');
  //     $('footer').css({
  //       "margin-top": "60px"
  //     });
  //   }
  //   window.print()
  // });

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
      removeAgree();
    }
    if ($('#dealTr th:last').text("")) {
      removeDeal();
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