<?php
include "./holidayApi.php";
?>
<?
$sessionId = $_SESSION[ses_id]; //���� �α������� ���
$sessionName = $_SESSION[ses_name];

$uid = $_POST['uid'];
$sql = "select * from wo_leave where uid = $uid";

$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$num = $row['num'];
$userid = $row['userid'];
$name = $row['name'];
$affil = $row['affil'];
$team = $row['team'];
$title = $row['title'];
$text = $row['text'];
$gubun = $row['gubun'];
$date1 = $row['date1'];
$sort1 = $row['sort1'];
$date2 = $row['date2'];
$sort2 = $row['sort2'];
$elapsed = $row['elapsed'];
$upfile01 = $row['upfile01'];
$realfile01 = $row['realfile01'];
$opinion  = $row['opinion'];
$agree1 = $row['agree1'];
$agree2 = $row['agree2'];
$agree3 = $row['agree3'];
$agree4 = $row['agree4'];
$agree5 = $row['agree5'];
$deal1 = $row['deal1'];
$deal2 = $row['deal2'];
$deal3 = $row['deal3'];
$deal4 = $row['deal4'];
$deal5 = $row['deal5'];
$status = $row['status'];

$valNum = 0;
if ($agree3 !== '') {
  $valNum = 3;
}
if ($agree4 !== '') {
  $valNum = 4;
}
if ($agree5 !== '') {
  $valNum = 5;
}

$dealNum = 0;
if ($deal1 !== '') {
  $dealNum = 1;
}
if ($deal2 !== '') {
  $dealNum = 2;
}
if ($deal3 !== '') {
  $dealNum = 3;
}
if ($deal4 !== '') {
  $dealNum = 4;
}
if ($deal5 !== '') {
  $dealNum = 5;
}


$arr = array();
$arr2 = array();

for ($i = 1; $i <= 5; $i++) {
  $str = ${"agree" . $i};
  $sql2 = "select * from wo_member where userid='$str' ";
  $result2 = mysql_query($sql2);
  $row2 = mysql_fetch_array($result2);

  $arr_unit = array(
    "userid" => $row2['userid'],
    "name" => $row2['name'],
    "affil" => $row2['affil'],
    "team" => $row2['team']
  );
  array_push($arr,  $arr_unit);
}


for ($i = 1; $i <= 5; $i++) {
  $str = ${"deal" . $i};
  $sql3 = "select * from wo_member where userid='$str' ";
  $result3 = mysql_query($sql3);
  $row3 = mysql_fetch_array($result3);
  $arr_unit2 = array(
    "userid" => $row3['userid'],
    "name" => $row3['name'],
    "affil" => $row3['affil'],
    "team" => $row3['team']
  );
  array_push($arr2,  $arr_unit2);
}

// ������ ���� ��������
$sql4 = "select * from wo_leave_agree2 where num = '$num' and category ='a' order by uid asc ";
$result4 = mysql_query($sql4);

$rowNum = mysql_num_rows($result4);
$arr3 = array(); //�������̸�
$arr4 = array(); //���� ����
$arr5 = array(); //��¥
while ($row4 = mysql_fetch_array($result4)) {
  array_push($arr3, $row4['member_name']);
  array_push($arr4, $row4['status']);
  array_push($arr5, $row4['date']);
}

// ������ ���� ��������
$sql5 = "select * from wo_leave_agree2 where num = '$num' and category ='d' order by uid asc ";
$result5 = mysql_query($sql5);
$arr6 = array(); //�������̸�
$arr7 = array(); //���� ����
$arr8 = array(); //��¥
while ($row5 = mysql_fetch_array($result5)) {
  array_push($arr6, $row5['member_name']);
  array_push($arr7, $row5['status']);
  array_push($arr8, $row5['date']);
}



// ��¥ ���� �ٲٴ� �Լ�
function formatDate($sqlDate)
{
  $phpdate = strtotime($sqlDate);
  $dateFormat = date("y.m.d.H:i", $phpdate);
  return $dateFormat;
}

?>
<style>
  <? include "./leave.css"; ?>
</style>
<div class="container">
  <header>
    <h1>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;û&nbsp;&nbsp;��</h1>
    <div class="logo">
      <img src="/images/iweblogo.jpg" alt="�ΰ�">
    </div>

  </header>
  <main>
    <form name="FRM" action="" method="post" id="frm">
      <input type='hidden' name='type' value=''>
      <input type='hidden' name='uid' value=''>
      <div class="agreeForm" method="post">


        <table class="agreeTable" id="agreeTableWrap">
          <tr id="agreeTr">
            <th rowspan="3" class="agreeTitle">��<br /><br />��</th>
            <th id="agreeth1">�����</th>
            <th id="agreeth2"><?= $arr[1]['affil'] ?></th>
            <?
            if ($agree3) {
              for ($i = 2; $i < $valNum; $i++) {
            ?>
                <th id="agreeth<?= $i + 1 ?>"><?= $arr[$i]['affil'] ?></th>
            <?  }
            }
            ?>
          </tr>
          <tr id="agreeTr2">
            <td class="agreeWrap">
              <div class="sign">
                <?
                if ($arr4[0] == '����') {
                ?>
                  <!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
                  ����
                <?
                }
                ?>
              </div>
              <span>
                <input type="text" class="datetime" id="dateTime" name="status" value="<?= formatDate($arr5[0]); ?>" readonly />
              </span>
            </td>
            <td class="agreeWrap">
              <div class="sign" name="stauts">

                <? if (($arr4[1] == '���' ||  $arr4[1] == '����')) { ?>
                  <? if ($arr4[1] == '���') {
                    echo "���";
                  }
                  if ($arr4[1] == '����') {
                    echo "����";
                  } ?>
                <? } ?>
                <? if ($arr4[1] == '����') { ?>
                  <!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
                  ����
                <? } ?>
              </div>
              <? if ($arr4[1] == '����') { ?>
                <span>
                  <input type="text" class="datetime" id="dateTime" value="<?= formatDate($arr5[1]); ?>" readonly />
                </span>
              <? } ?>
            </td>
            <?
            if ($agree3) {
              for ($i = 2; $i < $valNum; $i++) {
            ?>
                <td class="agreeWrap">
                  <div class="sign" name="stauts">

                    <? if (($arr4[$i] == '���' ||  $arr4[$i] == '����')) { ?>
                      <? if ($arr4[$i] == '���') {
                        echo "���";
                      }
                      if ($arr4[$i] == '����') {
                        echo "����";
                      } ?>
                    <? } ?>
                    <? if ($arr4[$i] == '����') { ?>
                      <!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
                      ����
                    <? } ?>
                  </div>
                  <? if ($arr4[$i] == '����') { ?>
                    <span>
                      <input type="text" class="datetime" id="dateTime" value="<?= formatDate($arr5[$i]); ?>" readonly />
                    </span>
                  <? } ?>
                </td>
            <?  }
            }
            ?>
          </tr>
          <tr id="agreeTr3">
            <td>
              <input type="text" id="selectAgree1" class="selectAgree" name="agree1" value="<?= $arr[0]['name'] ?>" readonly />
              <input type="hidden" id="selectAgree1Hidden" class="hiddenSelect" value="<?= $arr[0]['userid'] ?>" readonly />
            </td>
            <td>
              <input type="text" id="selectAgree2" class="selectAgree" name="agree2" value="<?= $arr[1]['name'] ?>" readonly />
              <input type="hidden" id="selectAgree2Hidden" class="hiddenSelect" value="<?= $arr[1]['userid'] ?>" />
            </td>
            <?
            if ($agree3) {
              for ($i = 2; $i < $valNum; $i++) {
            ?>
                <td>
                  <input type="text" id="selectAgree<?= $i + 1 ?>" class="selectAgree" name="agree<?= $i + 1 ?>" value="<?= $arr[$i]['name'] ?>" readonly />
                  <input type="hidden" id="selectAgree<?= $i + 1 ?>Hidden" class="hiddenSelect" value="<?= $arr[$i]['userid'] ?>" />
                </td>
            <?  }
            }
            ?>
          </tr>
        </table>
        <? if ($deal1) { ?>
          <table class="dealTable" id="dealTable_1" style="display: table">
            <tr id="dealTr">
              <th rowspan="3" class="agreeTitle">��<br /><br />��</th>
              <th id="dealth1"><?= $arr2[0]['affil'] ?></th>
              <? for ($i = 2; $i <= $dealNum; $i++) { ?>
                <th id="dealth<?= $i ?>"><?= $arr2[$i - 1]['affil'] ?></th>
              <? } ?>
            </tr>

            <tr id="dealTr2">
              <td class="agreeWrap">
                <div class="sign">
                  <? if ($arr7[0] == '����') { ?>
                    <!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
                    ����
                  <? } ?>
                  <? if ($arr7[0] == '���' || $arr7[0] == '����') { ?>
                    <? if ($arr4[$i] == '���') {
                      echo "���";
                    }
                    if ($arr4[$i] == '����') {
                      echo "����";
                    } ?>
                  <? } ?>
                </div>
                <? if ($arr7[0] == '����') { ?>
                  <span>
                    <input type="text" class="datetime" id="dateTime" value="<?= formatDate($arr8[0]); ?>" readonly />
                  </span>
                <? } else if ($arr7[0] == '���' || $arr7[0] == '����') { ?>
                  <span>
                    <input type="text" class="datetime" id="dateTime" value="" readonly />
                  </span>
                <? } ?>
              </td>
              <? for ($i = 2; $i <= $dealNum; $i++) { ?>
                <td class="agreeWrap">
                  <div class="sign">
                    <? if ($arr7[$i] == '����') { ?>
                      <!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
                      ����
                    <? } ?>
                    <? if ($arr7[$i] == '���' || $arr7[$i] == '����') { ?>
                      <? if ($arr4[$i] == '���') {
                        echo "���";
                      }
                      if ($arr4[$i] == '����') {
                        echo "����";
                      } ?>
                    <? } ?>
                  </div>
                  <? if ($arr7[$i] == '����') { ?>
                    <span>
                      <input type="text" class="datetime" id="dateTime" value="<?= formatDate($arr8[$i]); ?>" readonly />
                    </span>
                  <? } else if ($arr7[$i] == '���') { ?>
                    <span>
                      <input type="text" class="datetime" id="dateTime" value="" readonly />
                    </span>
                  <? } ?>
                </td>
              <? } ?>
            <tr id="dealTr3">
              <td>
                <input type="text" id="selectDeal1" class="selectAgree" name="deal1" value="<?= $arr2[0]['name'] ?>" readonly />
                <input type="hidden" id="selectDeal1Hidden" class="selectAgree" value="<?= $arr2[0]['userid'] ?>" />
              </td>
              <? for ($i = 2; $i <= $dealNum; $i++) { ?>
                <td>
                  <input type="text" id="selectDeal<?= $i ?>" class="selectAgree" name="deal<?= $i ?>" value="<?= $arr2[$i - 1]['name'] ?>" readonly />
                  <input type="hidden" id="selectDeal<?= $i ?>Hidden" class="selectAgree" value="<?= $arr2[$i - 1]['userid'] ?>" />
                </td>
              <? } ?>
            </tr>
          </table>
        <? } ?>

      </div>

      <div id="submitForm">
        <h2>1.&nbsp;&nbsp;��&nbsp;��&nbsp;��&nbsp;��</h2>
        <table class="formTable">
          <tr>
            <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;ȣ</th>
            <td>
              <input type='text' id="num" name='num' value='<?= $num ?>' readonly>
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
              <input type="text" value=<?= $name ?> name="name" onclick="warning();">
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
            <td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="title "><?= $title ?></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
            <td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content"><?= $text ?></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>��&nbsp;��&nbsp;��&nbsp;��</th>
            <td id="dayoff_wrap">
              <select name="dayoff" id="dayoff" class="sort" value="">
                <option value="">����</option>
                <option value="����" <? if ($gubun == '����') echo 'selected'; ?>>����</option>
                <option value="����" <? if ($gubun == '����') echo 'selected'; ?>>����</option>
                <option value="�����ް�" <? if ($gubun == '�����ް�') echo 'selected'; ?>>�����ް�</option>
                <option value="����ް�" <? if ($gubun == '����ް�') echo 'selected'; ?>>����ް�</option>
                <option value="�����ް�" <? if ($gubun == '�����ް�') echo 'selected'; ?>>�����ް�</option>
                <option value="�ϰ��ް�" <? if ($gubun == '�ϰ��ް�') echo 'selected'; ?>>�ϰ��ް�</option>
                <option value="�����ް�" <? if ($gubun == '�����ް�') echo 'selected'; ?>>�����ް�</option>
                <option value="����" <? if ($gubun == '����') echo 'selected'; ?>>����</option>
                <option value="��Ÿ" <? if ($gubun == '��Ÿ') echo 'selected'; ?>>��Ÿ</option>
              </select>
            </td>
          </tr>
          <tr class="inputForm">
            <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
            <td id="startdate_wrap">
              <input type="date" class="date " name="date1" id="startdate" max="9999-12-31" <? if ($date1) { ?>value="<?= $date1 ?>" <? } ?>>
              <select name="dayoff_sort1" id="dayoff_sort1" class="" value="">
                <option value="">����</option>
                <option id="allOff" value="����" <? if ($sort1 == '����') echo 'selected'; ?>>����</option>
                <option id="amOff" value="����" <? if ($sort1 == '����') echo 'selected'; ?>>����</option>
                <option value="����" <? if ($sort1 == '����') echo 'selected'; ?>>����</option>
              </select>

              <span id="hide">
                ~
                <input type="date" class="date " name="date2" id="enddate" max="9999-12-31" <? if ($date2) { ?>value="<?= $date2 ?>" <? } ?>>
                <select name="dayoff_sort2" id="dayoff_sort2" class="">
                  <option value="">����</option>
                  <option value="����" <? if ($sort2 == '����') echo 'selected'; ?>>����</option>
                  <option value="����" <? if ($sort2 == '����') echo 'selected'; ?>>����</option>
                  <option value="����" <? if ($sort2 == '����') echo 'selected'; ?>>����</option>
                </select>
              </span>

              <span>(</span>
              <!--<span id="elapsed" name="elapsed">0</span>-->
              <input type="text" id="elapsed" name="elapsed" readonly value="<?= $elapsed ?>" />
              <span>�ϰ� )</span>
            </td>
          </tr>
        </table>

        <h2 id="etcTitle">3. ��Ÿ</h2>
        <table class="etcTable">
          <tr>
            <th>÷&nbsp;��&nbsp;��&nbsp;��</th>
            <td>
              <input type="file" name="file" class="searchfileInput" value="<?= $file ?>">
            </td>
          </tr>
          <tr>
            <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�� </th>
            <td><textarea name="opinion" id="opinion" rows="1" class="title"><?= $opinion ?></textarea></td>
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
          <!--<span id="editBtn" class="no_print" onclick="getChekcValue(event);">������ ����</span>-->
          <span id="editBtn" class="no_print" onclick="go_edit(<?= $uid ?>);">��û������</span>
        </div>
      </div>
    </form>
  </main>
  <footer>
    <h1>��&nbsp;&nbsp;��&nbsp;&nbsp;ȸ&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</h1>
  </footer>
</div>

<script script type="text/javascript" language='javascript'>
  const dayoff = document.getElementById("dayoff");
  const startDay = document.getElementById("startdate");
  const dayoff_sort1 = document.getElementById("dayoff_sort1");
  const endDay = document.getElementById("enddate");
  const dayoff_sort2 = document.getElementById("dayoff_sort2");
  const elapsed = document.getElementById("elapsed");
  const today = document.getElementById("today");
  const datetime = document.getElementsByClassName("datetime");


  function showPopup() {
    // ������� ����
    let width = (window.screen.width - 800) / 2;
    let top = (window.screen.height - 400) / 2;
    let left = (screen.availWidth - 800) / 2;
    if (window.screenLeft < 0) {
      left += window.screen.width * -1;
    } else if (window.screenLeft > window.screen.width) {
      left += window.screen.width;
    }
    window.open('popup.php', 'test', `width=800, height=400, top=${top}, left=${left}`);
  }


  //status
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

  //-------------------------------------------------------�Ⱓ ���------------------------------------------------
  //	Jonah's code

  const formatDate = (date) => {
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    let day = date.getDate();

    month = month >= 10 ? month : '0' + month;
    day = day >= 10 ? day : '0' + day;

    return year + '' + month + '' + day;
  };

  const clearDateForm = () => {
    startDay.value = '';
    dayoff_sort1.value = '';
    endDay.value = '';
    dayoff_sort2.value = '';

    elapsed.innerText = '0';
  };

  const changeDayOffSort = () => {
    if (dayoff.value == "����") {
      $('#hide').hide();
      $('#allOff').hide();
      $('#amOff').show();
    } else {
      $('#hide').show();
      $('#allOff').show();
      $('#amOff').hide();
    }
    clearDateForm();
  };

  const getHoliday = () => {
    let arr = [];
    <?
    $holiday = getHoliday();
    $holiday_arr = $holiday["body"]["items"]["item"];

    foreach ($holiday_arr as $arr) {
    ?>
      arr.push("<?= $arr["locdate"] ?>");
    <?
    }
    ?>
    return arr;
  };
  const holiday_arr = getHoliday();

  const countElapseDay = () => {

    let elapsed_cnt = 0;
    let start_date = new Date();
    let end_date = new Date();

    // �ް����� �̼���
    if (dayoff.value == '') {
      alert('�ް������� �������ּ���.');
      dayoff.focus();
      clearDateForm();

      return false;

      // ���� ����
    } else if (dayoff.value == "����") {
      if (!((isNaN(start_date)) || (dayoff_sort1.value == ""))) {
        start_date = new Date(startDay.value);
        elapsed_cnt = 0.5;
      }

      // �׿� ����
    } else {

      start_date = new Date(startDay.value);
      end_date = new Date(endDay.value);

      if (start_date.getTime() > end_date.getTime()) {
        alert('�Ⱓ�� �߸� �Ǿ����ϴ�.');
        clearDateForm();
        return false;
      }

      if (dayoff_sort1.value == "����" && start_date.getTime() == end_date.getTime()) {
        alert('�Ⱓ�� �߸� �Ǿ����ϴ�.');
        clearDateForm();
        return false;
      }

      if (dayoff_sort2.value == "����" && start_date.getTime() == end_date.getTime()) {
        alert('�Ⱓ�� �߸� �Ǿ����ϴ�.');
        clearDateForm();
        return false;
      }

      if (!(isNaN(start_date) || isNaN(end_date) || (dayoff_sort1.value == "") || (dayoff_sort2.value == ""))) {
        const elapsedMSec = end_date.getTime() - start_date.getTime();
        elapsed_cnt = elapsedMSec / 1000 / 60 / 60 / 24;
        elapsed_cnt += 1;

        let holi_cnt = 0;
        let tmp_date = start_date;

        while (tmp_date.getTime() <= end_date.getTime()) {

          let tmp_day = tmp_date.getDay();
          if (tmp_day == 0 || tmp_day == 6 || holiday_arr.includes(formatDate(tmp_date))) {
            holi_cnt++;
          }
          tmp_date.setDate(tmp_date.getDate() + 1)
        }

        elapsed_cnt -= holi_cnt;
        start_date = new Date(startDay.value);

        if ((start_date.getDay() != 0 && start_date.getDay() != 6) && dayoff_sort1.value == "����") elapsed_cnt -= 0.5
        if ((end_date.getDay() != 0 && end_date.getDay() != 6) && dayoff_sort2.value == "����") elapsed_cnt -= 0.5
      }
    }
    console.log(elapsed_cnt);
    elapsed.value = elapsed_cnt.toString();
    return elapsed_cnt;
  };

  dayoff.addEventListener("change", changeDayOffSort);

  startDay.addEventListener("change", countElapseDay);
  endDay.addEventListener("change", countElapseDay);

  dayoff_sort1.addEventListener("change", countElapseDay);
  dayoff_sort2.addEventListener("change", countElapseDay);
  //-------------------------------------------------------�Ⱓ ���------------------------------------------------//
  function warning() {
    alert('����ڴ� �����Ҽ� �����ϴ�. ������ �ٽ� �ۼ����ֽʽÿ�.');
    return false;
  }

  function go_edit(uid) {
    const form = document.FRM;
    form.type.value = 'edit';
    form.uid.value = uid;
    form.action = 'proc2.php';
    form.submit();
  }
</script>