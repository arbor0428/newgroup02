<?php
include "./holidayApi.php";
?>
<?
$sessionId = $_SESSION[ses_id]; //현재 로그인중인 사람
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

// 결재자 상태 가져오기
$sql4 = "select * from wo_leave_agree2 where num = '$num' and category ='a' order by uid asc ";
$result4 = mysql_query($sql4);

$rowNum = mysql_num_rows($result4);
$arr3 = array(); //결재자이름
$arr4 = array(); //결재 상태
$arr5 = array(); //날짜
while ($row4 = mysql_fetch_array($result4)) {
  array_push($arr3, $row4['member_name']);
  array_push($arr4, $row4['status']);
  array_push($arr5, $row4['date']);
}

// 합의자 상태 가져오기
$sql5 = "select * from wo_leave_agree2 where num = '$num' and category ='d' order by uid asc ";
$result5 = mysql_query($sql5);
$arr6 = array(); //결재자이름
$arr7 = array(); //결재 상태
$arr8 = array(); //날짜
while ($row5 = mysql_fetch_array($result5)) {
  array_push($arr6, $row5['member_name']);
  array_push($arr7, $row5['status']);
  array_push($arr8, $row5['date']);
}



// 날짜 형식 바꾸는 함수
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
    <h1>휴&nbsp;&nbsp;가&nbsp;&nbsp;신&nbsp;&nbsp;청&nbsp;&nbsp;서</h1>
    <div class="logo">
      <img src="/images/iweblogo.jpg" alt="로고">
    </div>

  </header>
  <main>
    <form name="FRM" action="" method="post" id="frm">
      <input type='hidden' name='type' value=''>
      <input type='hidden' name='uid' value=''>
      <div class="agreeForm" method="post">


        <table class="agreeTable" id="agreeTableWrap">
          <tr id="agreeTr">
            <th rowspan="3" class="agreeTitle">결<br /><br />재</th>
            <th id="agreeth1">담당자</th>
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
                if ($arr4[0] == '승인') {
                ?>
                  <!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
                  승인
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

                <? if (($arr4[1] == '대기' ||  $arr4[1] == '보류')) { ?>
                  <? if ($arr4[1] == '대기') {
                    echo "대기";
                  }
                  if ($arr4[1] == '보류') {
                    echo "보류";
                  } ?>
                <? } ?>
                <? if ($arr4[1] == '승인') { ?>
                  <!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
                  승인
                <? } ?>
              </div>
              <? if ($arr4[1] == '승인') { ?>
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

                    <? if (($arr4[$i] == '대기' ||  $arr4[$i] == '보류')) { ?>
                      <? if ($arr4[$i] == '대기') {
                        echo "대기";
                      }
                      if ($arr4[$i] == '보류') {
                        echo "보류";
                      } ?>
                    <? } ?>
                    <? if ($arr4[$i] == '승인') { ?>
                      <!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
                      승인
                    <? } ?>
                  </div>
                  <? if ($arr4[$i] == '승인') { ?>
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
              <th rowspan="3" class="agreeTitle">합<br /><br />의</th>
              <th id="dealth1"><?= $arr2[0]['affil'] ?></th>
              <? for ($i = 2; $i <= $dealNum; $i++) { ?>
                <th id="dealth<?= $i ?>"><?= $arr2[$i - 1]['affil'] ?></th>
              <? } ?>
            </tr>

            <tr id="dealTr2">
              <td class="agreeWrap">
                <div class="sign">
                  <? if ($arr7[0] == '승인') { ?>
                    <!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
                    승인
                  <? } ?>
                  <? if ($arr7[0] == '대기' || $arr7[0] == '보류') { ?>
                    <? if ($arr4[$i] == '대기') {
                      echo "대기";
                    }
                    if ($arr4[$i] == '보류') {
                      echo "보류";
                    } ?>
                  <? } ?>
                </div>
                <? if ($arr7[0] == '승인') { ?>
                  <span>
                    <input type="text" class="datetime" id="dateTime" value="<?= formatDate($arr8[0]); ?>" readonly />
                  </span>
                <? } else if ($arr7[0] == '대기' || $arr7[0] == '보류') { ?>
                  <span>
                    <input type="text" class="datetime" id="dateTime" value="" readonly />
                  </span>
                <? } ?>
              </td>
              <? for ($i = 2; $i <= $dealNum; $i++) { ?>
                <td class="agreeWrap">
                  <div class="sign">
                    <? if ($arr7[$i] == '승인') { ?>
                      <!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
                      승인
                    <? } ?>
                    <? if ($arr7[$i] == '대기' || $arr7[$i] == '보류') { ?>
                      <? if ($arr4[$i] == '대기') {
                        echo "대기";
                      }
                      if ($arr4[$i] == '보류') {
                        echo "보류";
                      } ?>
                    <? } ?>
                  </div>
                  <? if ($arr7[$i] == '승인') { ?>
                    <span>
                      <input type="text" class="datetime" id="dateTime" value="<?= formatDate($arr8[$i]); ?>" readonly />
                    </span>
                  <? } else if ($arr7[$i] == '대기') { ?>
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
        <h2>1.&nbsp;&nbsp;문&nbsp;서&nbsp;정&nbsp;보</h2>
        <table class="formTable">
          <tr>
            <th>문&nbsp;&nbsp;서&nbsp;&nbsp;번&nbsp;&nbsp;호</th>
            <td>
              <input type='text' id="num" name='num' value='<?= $num ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>보&nbsp;&nbsp;안&nbsp;&nbsp;등&nbsp;&nbsp;급</th>
            <td>
              L2
            </td>
          </tr>
          <tr>
            <th>보&nbsp;&nbsp;존&nbsp;&nbsp;연&nbsp;&nbsp;한</th>
            <td>
              5년
            </td>
          </tr>
          <tr>
            <th>문&nbsp;&nbsp;서&nbsp;&nbsp;종&nbsp;&nbsp;류</th>
            <td>
              결재
            </td>
          </tr>
        </table>
        <table class="formTable2">
          <tr>
            <th>기&nbsp;&nbsp;&nbsp;안&nbsp;&nbsp;&nbsp;자</th>
            <td id="drafterWrap">
              <input type="text" value=<?= $name ?> name="name" onclick="warning();">
            </td>
          </tr>
          <tr>
            <th>직&nbsp;급&nbsp;&nbsp;/&nbsp;&nbsp;직&nbsp;책</th>
            <td>
              <input type='text' id="affil" name='affil' value='<?= $affil ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>부&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;서</th>
            <td>
              <input type='text' id="team" name='team' value='<?= $team ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>수&nbsp;&nbsp;&nbsp신&nbsp&nbsp;&nbsp;처</th>
            <td>
              운영지원팀
            </td>
          </tr>
        </table>
        <h2>2.&nbsp;&nbsp;세&nbsp;부&nbsp;내&nbsp;용</h2>
        <table class="inputTable">
          <tr class="inputForm">
            <th>제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목</th>
            <td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="title "><?= $title ?></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;유</th>
            <td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content"><?= $text ?></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>휴&nbsp;가&nbsp;종&nbsp;류</th>
            <td id="dayoff_wrap">
              <select name="dayoff" id="dayoff" class="sort" value="">
                <option value="">선택</option>
                <option value="연차" <? if ($gubun == '연차') echo 'selected'; ?>>연차</option>
                <option value="반차" <? if ($gubun == '반차') echo 'selected'; ?>>반차</option>
                <option value="무급휴가" <? if ($gubun == '무급휴가') echo 'selected'; ?>>무급휴가</option>
                <option value="출산휴가" <? if ($gubun == '출산휴가') echo 'selected'; ?>>출산휴가</option>
                <option value="경조휴가" <? if ($gubun == '경조휴가') echo 'selected'; ?>>경조휴가</option>
                <option value="하계휴가" <? if ($gubun == '하계휴가') echo 'selected'; ?>>하계휴가</option>
                <option value="포상휴가" <? if ($gubun == '포상휴가') echo 'selected'; ?>>포상휴가</option>
                <option value="병가" <? if ($gubun == '병가') echo 'selected'; ?>>병가</option>
                <option value="기타" <? if ($gubun == '기타') echo 'selected'; ?>>기타</option>
              </select>
            </td>
          </tr>
          <tr class="inputForm">
            <th>기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;간</th>
            <td id="startdate_wrap">
              <input type="date" class="date " name="date1" id="startdate" max="9999-12-31" <? if ($date1) { ?>value="<?= $date1 ?>" <? } ?>>
              <select name="dayoff_sort1" id="dayoff_sort1" class="" value="">
                <option value="">선택</option>
                <option id="allOff" value="종일" <? if ($sort1 == '종일') echo 'selected'; ?>>종일</option>
                <option id="amOff" value="오전" <? if ($sort1 == '오전') echo 'selected'; ?>>오전</option>
                <option value="오후" <? if ($sort1 == '오후') echo 'selected'; ?>>오후</option>
              </select>

              <span id="hide">
                ~
                <input type="date" class="date " name="date2" id="enddate" max="9999-12-31" <? if ($date2) { ?>value="<?= $date2 ?>" <? } ?>>
                <select name="dayoff_sort2" id="dayoff_sort2" class="">
                  <option value="">선택</option>
                  <option value="종일" <? if ($sort2 == '종일') echo 'selected'; ?>>종일</option>
                  <option value="오전" <? if ($sort2 == '오전') echo 'selected'; ?>>오전</option>
                  <option value="오후" <? if ($sort2 == '오후') echo 'selected'; ?>>오후</option>
                </select>
              </span>

              <span>(</span>
              <!--<span id="elapsed" name="elapsed">0</span>-->
              <input type="text" id="elapsed" name="elapsed" readonly value="<?= $elapsed ?>" />
              <span>일간 )</span>
            </td>
          </tr>
        </table>

        <h2 id="etcTitle">3. 기타</h2>
        <table class="etcTable">
          <tr>
            <th>첨&nbsp;부&nbsp;자&nbsp;료</th>
            <td>
              <input type="file" name="file" class="searchfileInput" value="<?= $file ?>">
            </td>
          </tr>
          <tr>
            <th>의&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;견 </th>
            <td><textarea name="opinion" id="opinion" rows="1" class="title"><?= $opinion ?></textarea></td>
          </tr>
        </table>

        <table class="submitTable">
          <tr>
            <td colspan="2">
              <div class="tailContent">
                <p>위와 같이 품의하오니 재가 하여 주시기 바랍니다.</p>
                <p id="today"></p>
              </div>
            </td>
          </tr>
        </table>
        <div class="headline">
          <!--<span id="editBtn" class="no_print" onclick="getChekcValue(event);">결재자 수정</span>-->
          <span id="editBtn" class="no_print" onclick="go_edit(<?= $uid ?>);">신청서수정</span>
        </div>
      </div>
    </form>
  </main>
  <footer>
    <h1>주&nbsp;&nbsp;식&nbsp;&nbsp;회&nbsp;&nbsp;사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;아&nbsp;&nbsp;이&nbsp;&nbsp;웹</h1>
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
    // 듀얼모니터 기준
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

  //-------------------------------------------------------기간 계산------------------------------------------------
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
    if (dayoff.value == "반차") {
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

    // 휴가종류 미선택
    if (dayoff.value == '') {
      alert('휴가종류를 선택해주세요.');
      dayoff.focus();
      clearDateForm();

      return false;

      // 반차 선택
    } else if (dayoff.value == "반차") {
      if (!((isNaN(start_date)) || (dayoff_sort1.value == ""))) {
        start_date = new Date(startDay.value);
        elapsed_cnt = 0.5;
      }

      // 그외 선택
    } else {

      start_date = new Date(startDay.value);
      end_date = new Date(endDay.value);

      if (start_date.getTime() > end_date.getTime()) {
        alert('기간이 잘못 되었습니다.');
        clearDateForm();
        return false;
      }

      if (dayoff_sort1.value == "오후" && start_date.getTime() == end_date.getTime()) {
        alert('기간이 잘못 되었습니다.');
        clearDateForm();
        return false;
      }

      if (dayoff_sort2.value == "오전" && start_date.getTime() == end_date.getTime()) {
        alert('기간이 잘못 되었습니다.');
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

        if ((start_date.getDay() != 0 && start_date.getDay() != 6) && dayoff_sort1.value == "오후") elapsed_cnt -= 0.5
        if ((end_date.getDay() != 0 && end_date.getDay() != 6) && dayoff_sort2.value == "오전") elapsed_cnt -= 0.5
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
  //-------------------------------------------------------기간 계산------------------------------------------------//
  function warning() {
    alert('기안자는 수정할수 없습니다. 삭제후 다시 작성해주십시오.');
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