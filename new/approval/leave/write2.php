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

$sessionId = $_SESSION['ses_id']; //현재 로그인중인 사람

if ($type == 'edit' && $uid) {
  $sql = "select * from wo_leave where uid='$uid'";
  $result = mysql_query($sql);
  $row = mysql_fetch_array($result);

  $userid = $row['userid'];
}


//////////////////
//// 연차일 계산 ////
//////////////////
$sql = "select * from wo_member where userid='$f_userid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$idate01 = $row['idate01'];

//근무년수
$wYear = $f_year - $idate01;

//발생한 연차수
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

//조회일자기준 사용한 연차수
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

//남은 연차수
$ModOff = $DayOff - $UseOff;
//------------------
$sql3 = "select name,affil,userid from wo_member where enable = 1 "; //현재 근무중인 직원의 이름
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
  <h1>휴&nbsp;&nbsp;가&nbsp;&nbsp;신&nbsp;&nbsp;청&nbsp;&nbsp;서</h1>
  <div class="logo">
    <img src="/images/iweblogo.jpg" alt="로고">
  </div>
  <div id="print_wrap">
    <button id="printBtn" class="no_print">인쇄하기</button>
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
          합의<input type="checkbox" onclick="getCheckValue(event)" />
          <input type="button" onclick="removeTable();" value="삭제">
        </div>
        <tr id="agreeTr">
          <th rowspan="3" class="agreeTitle">결<br /><br />재</th>
          <th id="agreeth1">담당자</th>
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
          <th rowspan="3" class="agreeTitle">합<br /><br />의</th>
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
      <h2>1.&nbsp;&nbsp;문&nbsp;서&nbsp;정&nbsp;보</h2>
      <table class="formTable">
        <tr>
          <th>문&nbsp;&nbsp;서&nbsp;&nbsp;번&nbsp;&nbsp;호</th>
          <td>
            <input type='text' id="num" name='num' value='' readonly>
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
            <select name='userid' id="userid" class="drafter" onchange="setUserID()">
              <option value="">직원목록</option>
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
          <td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="title " placeholder="ex)연차사용건 - 20220624"></textarea></td>
        </tr>
        <tr class="inputForm">
          <th>사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;유</th>
          <td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content" placeholder="ex)개인 사정으로 인하여 휴가를 신청합니다."></textarea></td>
        </tr>
        <tr class="inputForm">
          <th>휴&nbsp;가&nbsp;종&nbsp;류</th>
          <td id="dayoff_wrap">
            <select name="dayoff" id="dayoff" class="sort">
              <option value="">선택</option>
              <option value="연차">연차</option>
              <option value="반차">반차</option>
              <option value="무급휴가">무급휴가</option>
              <option value="출산휴가">출산휴가</option>
              <option value="경조휴가">경조휴가</option>
              <option value="하계휴가">하계휴가</option>
              <option value="포상휴가">포상휴가</option>
              <option value="병가">병가</option>
              <option value="기타">기타</option>
            </select>
          </td>
        </tr>
        <tr class="inputForm">
          <th>기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;간</th>
          <td id="startdate_wrap">
            <input type="date" class="date " name="date1" id="startdate" max="9999-12-31">
            <select name="dayoff_sort1" id="dayoff_sort1" class="">
              <option value="">선택</option>
              <option id="allOff" value="종일">종일</option>
              <option id="amOff" value="오전">오전</option>
              <option value="오후">오후</option>
            </select>
            <span id="hide">
              ~&nbsp;&nbsp;
              <input type="date" class="date " name="date2" id="enddate" max="9999-12-31">
              <select name="dayoff_sort2" id="dayoff_sort2" class="">
                <option value="">선택</option>
                <option value="종일">종일</option>
                <option value="오전">오전</option>
              </select>
            </span>
            <span>(</span>
            <!--<span id="elapsed" name="elapsed">0</span>-->
            <input type="text" id="elapsed" name="elapsed" readonly />
            <span>일간 )</span>
            <span class="no_print none_print" style="color:red;">
              <span>남은연차: </span>
              <span id="modOff"><?= $ModOff ?></span>
              <span>일</span>
            </span>
          </td>
        </tr>
      </table>
      <h2 id="etcTitle">3. 기타</h2>
      <table class="etcTable">
        <tr>
          <th>첨&nbsp;&nbsp; 부&nbsp;&nbsp; 자&nbsp;&nbsp; 료</th>
          <td>
            <input type="file" name="upfile01" class="searchfileInput">
          </td>
        </tr>
        <tr>
          <th>의&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;견 </th>
          <td><textarea name="opinion" id="opinion" rows="1" class="title"></textarea></td>
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
        <button type="submit" name="submit" id="submitBtn" class="no_print">기안/결재</button>
      </div>

    </div>
  </form>
</main>
<footer>
  <h1>주&nbsp;&nbsp;식&nbsp;&nbsp;회&nbsp;&nbsp;사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;아&nbsp;&nbsp;이&nbsp;&nbsp;웹</h1>
</footer>
</div>

<script src="./json/holiday1.json" type="text/javascript"></script>

<!-- pdf 저장 라이브러리 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script type="text/javascript" language='javascript'>
  //// 페이지 로드
  $(function() {
    setUserID();

    $('#today').text(getTodayStr());
  });


  //// 전역 변수


  //// 전역 함수
  // userid 셋팅
  function setUserID() {
    $('#userid').css({
      "text-align": "start"
    })
    userid = $("#userid option:selected").val(); // userid가 select됐을때 작용

    $('#name').val(''); // 성명 input value id가 name인 값 가져와서 초기화 시키기 값에 ('') null을 담아서 변수를 초기화 시킨다
    $('#team').val(''); // 소속
    $('#affil').val(''); // 직위

    if (userid) {
      $.post('./jsonUser.php', {
        'userid': userid
      }, function(req) { // json 방식으로 전송하여 리턴값 받기.

        parData = JSON.parse(req); // 문자열 구문 분석, 객체생성

        name = parData['name']; // name이라는 객체를 생성

        team = parData['team'];
        affil = parData['affil'];

        $('#team').val(team); // 소속
        $('#affil').val(affil);
        $('#drafter').val(name);
        const teamName = $('#team').val(team).val();
        let teamNum = '0';
        if (teamName == '기획팀') {
          teamNum = '0101';
        }
        if (teamName == '개발팀' || teamName == '1팀') {
          teamNum = '0201';
        }
        if (teamName == '2팀') {
          teamNum = '0202';
        }
        if (teamName == '운영지원팀') {
          teamNum = '0301';
        }
        if (teamNum == '') {
          teamNum = '0000';
        }

        pushDate(teamNum);
      });
    }
  }

  // 현재 날짜
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
    let str = `${todayYear} 년  ${todayMonth} 월 ${todayDate} 일 `;

    return str;
  }

  // option선택시 th의 text 바꿈.
  function setValue(event) {
    const index = event.target.id;
    //결재자 onchange
    if (index.includes('agree')) {
      const indexNum = index.substring(11, 12);
      let userid = $(`#${index} option:selected`).val();
      $.post('./jsonUser.php', {
        'userid': userid
      }, function(req) { //아이디로 검색
        const parData = JSON.parse(req);
        const name = parData['name'];
        const affil = parData['affil'];
        if (name !== "" && affil == '') {
          alert('인사관리에서 직급을 추가하여 주세요.');
          $(`#agreeTr th:eq(${indexNum})`).text("")
          return false;
        }
        if (name == "") {
          alert('결재자를 선택해주세요');
          $(`#agreeTr th:eq(${indexNum})`).text("")
          return false;
        }
        $(`#agreeTr th:eq(${indexNum})`).text(affil); //th에 직급 표기

        //hidden으로 userid 넘김.
        $(`#agreeSelect${indexNum}Hidden`).attr('value', userid);
        const hiddenId = $(`#agreeSelect${indexNum}Hidden`);


        //select시 다음테이블 추가
        const select = $(`#${index}`).is('select');
        if (indexNum > 1 && select && !$(`#${index}`).hasClass('selected')) {
          tableAdd(userid);
          $(`#${index}`).addClass('selected');
        }

      });
      //합의자 onchange
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
          alert('인사관리에서 직급을 추가하여 주세요.');
          $(`#dealTr th:eq(${indexNum})`).text("")
          return false;
        }
        if (name == "") {
          alert('합의자를 선택해주세요');
          $(`#dealTr th:eq(${indexNum})`).text("")
          return false;
        }
        $(`#dealTr th:eq(${indexNum})`).text(affil);
        //hidden으로 userid 넘김.
        $(`#dealSelect${indexNum}Hidden`).attr('value', userid);

        //select시 다음테이블 추가
        const select = $(`#${index}`).is('select');
        if (select && !$(`#${index}`).hasClass('selected')) {
          AddDeal(userid);
          $(`#${index}`).addClass('selected');
        }
      });
    } else {
      alert('오류입니다.');
    }
  }

  function tableAdd(userid) {
    let num = 0;

    num = $('#agreeTr3 td').length - 2;
    let dealWidth = $('.dealTable').width();
    const agreeWidth = $('.agreeTable').width();

    if (dealWidth + agreeWidth > 800 || num + 2 > 4) {
      alert('최대 갯수를 초과하였습니다.');
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
      agreeSelect.children().eq(1).attr('id', 'agreeSelect' + (num + 3) + 'Hidden'); //Hidden아이디 설정
      agreeSelect.children().eq(1).attr('name', 'agree' + (num + 3)); //
      $('#agreeTr3').append(agreeSelect);

    }
    num += 1;
  }

  // 합의테이블
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
      //합의 체크를 풀면 리셋
      const length = $('.dTableTd select').length;
      for (let i = 1; i < length; i++) {
        $('#dealSelect' + i).removeClass('selected');
        $('#dealSelect' + i).val('');
        $('#dealSelect' + i + 'Hidden').val('');
        removeDealTable();
      }
    }

  }

  //합의테이블 추가
  function AddDeal(userid) {

    num = $('#dealTr3 td').length;

    let dealWidth = $('.dealTable').width();
    const agreeWidth = $('.agreeTable').width();
    if ($('.dealTable').css("display") === "none") {

    }
    if (dealWidth + agreeWidth > 800 || num > 4) {
      alert('최대 갯수를 초과하였습니다.');
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
      alert('결재자는 한명 이상이여야 합니다.');
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

  // 휴가 기간
  function setLeaveDateRange(params) {

  }

  //// 이벤트
  // 버튼 - 인쇄하기
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
  // 버튼 - 기안/결재
  frm.addEventListener("submit", function(e) {

    if (mainTitle.value == "") {
      alert("제목을 입력해 주세요.")
      mainTitle.focus();
      e.preventDefault()
      return false;
    };

    if (content.value == "") {
      alert("사유를 입력해 주세요.")
      content.focus();
      e.preventDefault()
      return false;
    };

    if (dayoff.value == "") {
      alert("휴가 종류를 선택해 주세요.")
      dayoff.focus();
      e.preventDefault()
      return false;
    };

    if (startDay.value == "") {
      alert("기간을 입력해 주세요.")
      startDay.focus();
      e.preventDefault()
      return false;
    };

    if (dayoff_sort1.value == "") {
      alert("상세항목을 선택해 주세요.")
      dayoff_sort1.focus();
      e.preventDefault()
      return false;
    };

    if (dayoff.value !== "반차") {
      if (endDay.value == "") {
        alert("기간을 입력해 주세요.")
        endDay.focus();
        e.preventDefault()
        return false;
      };

      if (dayoff_sort2.value == "") {
        alert("상세항목을 선택해 주세요.")
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

    if (confirm("휴가 신청을 하시겠습니까?")) {
      const FRM = document.FRM;
      FRM.type.value = 'write';
      FRM.action = 'proc2.php';
      FRM.submit();

    }


    //넘어가는 데이터값(연차 사용 일수는 문자열타입으로 저장. 필요에 따라 숫자형으로 변경해야함.)
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