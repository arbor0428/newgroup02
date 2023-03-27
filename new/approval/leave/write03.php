<?
$sessionId = $_SESSION['ses_id']; //현재 로그인중인 사람

// 현재 로그인 중인 사람 정보
$sql = "select * from wo_member where userid='$sessionId'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

// $userid = $row['userid'];
$name = $row['name'];
$affil = $row['affil'];
$team = $row['team'];


$sql2 = "select userid, name, affil from wo_member where enable = 1 "; //현재 근무중인 직원의 이름
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




//// 연차일 계산 ////
// $sql = "select * from wo_member where userid='$f_userid'";
// $result = mysql_query($sql);
// $row = mysql_fetch_array($result);

// $idate01 = $row['idate01'];



//근무년수
// $wYear = $f_year - $idate01;

//발생한 연차수
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

//조회일자기준 사용한 연차수
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

//남은 연차수
// $ModOff = $DayOff - $UseOff;
// //------------------
// $sql3 = "select name,affil,userid from wo_member where enable = 1 "; //현재 근무중인 직원의 이름
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
    <a href='up_index.php?type=list' class="big cbtn black">목록</a>
  </div>
</div>
<div class="write-cont">
  <form name="FRM" action="<?= $PHP_SELF ?>" method="post" enctype='multipart/form-data' id="frm">
    <header>
      <h1>휴가신청서</h1>
      <div class="logo">
        <img src="/images/iweblogo.jpg" alt="로고">
      </div>
      <div class="submitWrap">
        <button class="submitBtn">기안/결재</button>
      </div>
    </header>

    <main>
      <input type='hidden' name='type' value='' />
      <input type='hidden' name='upfile01' value="<?= $upfile01 ?>" />
      <input type='hidden' name='realfile01' value="<?= $realfile01 ?>" />

      <div class="agreeForm">
        <div class="sign-wrap">
       

          <div class="deal-sign">
            <span>합의</span>
            <input type="button" id="addDealBtn" value="&#43;" onclick="addDeal()">
            <input type="button" id="removeDealBtn" value="&#45;" onclick="removeDeal()">
          </div>

          <div class="agree-sign">
            <span>결재</span>
            <input type="button" id="addAgreeBtn" value="&#43;" onclick="addAgree()">
            <input type="button" id="removeAgreeBtn" value="&#45;" onclick="removeAgree()">
          </div>
        </div>

        <table class="agreeTable">
          <tr>
            <th rowspan="3">결<br /><br />재</th>
            <th>담당자</th>
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
                <option value="">선택</option>
                <? for ($i = 0; $i < count($members); $i++) { ?>
                  <option value="<?= $members[$i]['userid'] ?>"><?= $members[$i]['name'] ?></option>
                <? } ?>
              </select>
             
            </td>
          </tr>
        </table>

        <table class="dealTable">
          <tr>
            <th rowspan="3">합<br /><br />의</th>
            <th></th>
          </tr>

          <tr>
            <td class="sign">
            </td>
          <tr>
            <td class="dealName">
              <select name="deal1" onchange="setValue('dealTable')">
                <option value="">선택</option>
                <? for ($i = 0; $i < count($members); $i++) { ?>
                  <option value="<?= $members[$i]['userid'] ?>"><?= $members[$i]['name'] ?></option>
                <? } ?>
              </select>
            
            </td>
          </tr>
        </table>
      </div>

      <div class="submitForm">
        <h2>1. 문서정보</h2>
        <table class="formTable">
          <tr>
            <th>문서번호</th>
            <td>
              <input type='text' id="num" name='num' value='' readonly>
            </td>
          </tr>
          <tr>
            <th>보안등급</th>
            <td>
              L2
            </td>
          </tr>
          <tr>
            <th>보존연한</th>
            <td>
              5년
            </td>
          </tr>
          <tr>
            <th>문서종류</th>
            <td>
              결재
            </td>
          </tr>
        </table>
        <table class="formTable2">
          <tr>
            <th>기안자</th>
            <td>
              <input type='text' id="name" name='name' value='<?= $name ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>직급 / 직책</th>
            <td>
              <input type='text' id="affil" name='affil' value='<?= $affil ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>부서</th>
            <td>
              <input type='text' id="team" name='team' value='<?= $team ?>' readonly>
            </td>
          </tr>
          <tr>
            <th>수신처</th>
            <td>
              운영지원팀
            </td>
          </tr>
        </table>
        
        <h2>2. 세부내용</h2>
        <table class="inputTable">
          <tr class="inputForm">
            <th>제목</th>
            <td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="mainTitle" placeholder=""></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>사유</th>
            <td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content" placeholder=""></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>휴가종류 </th>
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
            <th>기간</th>
            <td id="startdate_wrap">
              <input id="daterange" type="text" name="daterange" value="" />             
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
            <th>첨부자료</th>
            <td>
							<input type='file' name='upfile01' class='file03' style='width:213px;'><?if($userfile01){?><br><input type='checkbox' name='del_upfile01' value='Y'>삭제 (<?=$realfile01?>)<?}?>             
            </td>
          </tr>
          <tr>
            <th>의견 </th>
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
			
      </div>
    </main>
    <footer>
      <h1>주식회사 아이웹</h1>
    </footer>
  </form>
</div>


<!-- <script src="./json/holiday1.json" type="text/javascript"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
  
	// 페이지 로드
  $(function() {
    $('#today').text(getTodayStr());
  });



  //// 전역 변수
  var numOfAgree = 1;
  var numOfDeal = 1;

  //// 전역 함수
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
    let str = `${todayYear}년\u00a0\u00a0\u00a0\u00a0${todayMonth}월\u00a0\u00a0\u00a0\u00a0${todayDate}일`;

    return str;
  }

  // userid 셋팅
/* function setUserID() {
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

        // pushDate(teamNum);
       });
     }
   }

*/
  // 결재 테이블 추가, 제거
  function addAgree() {
    const agreeWidth = $('.agreeTable').width();
    const dealWidth = $('.dealTable').width();

    if (agreeWidth + dealWidth > 800 || numOfAgree + numOfDeal > 8) {
      console.log('최대 갯수를 초과하였습니다.');
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

      // 합의 추가, 제거 공간 조정
      let strPadding = $('.deal-sign').css('padding-right');
      $('.deal-sign').css('padding-right', parseInt(strPadding) + 103 + 'px');
    }
  }

  function removeAgree() {
    if (numOfAgree < 2) {
      console.log('결재자는 한명 이상이여야 합니다.');
      return;
    } else {
      $('.agreeTable tr:nth-child(1) th').last().remove();
      $('.agreeTable tr:nth-child(2) td').last().remove();
      $('.agreeTable tr:nth-child(3) td').last().remove();

      numOfAgree--;

      // 합의 추가, 제거 공간 조정
      let strPadding = $('.deal-sign').css('padding-right');
      $('.deal-sign').css('padding-right', parseInt(strPadding) - 103 + 'px');
    }
  }

  // 합의 테이블 추가, 제거
  function addDeal() {
    const agreeWidth = $('.agreeTable').width();
    const dealWidth = $('.dealTable').width();

    if (agreeWidth + dealWidth > 800 || numOfAgree + numOfDeal > 8) {
      console.log('최대 갯수를 초과하였습니다.');
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
      console.log('결재자는 한명 이상이여야 합니다.');
      return;
    } else {
      $('.dealTable tr:nth-child(1) th').last().remove();
      $('.dealTable tr:nth-child(2) td').last().remove();
      $('.dealTable tr:nth-child(3) td').last().remove();

      numOfDeal--;
    }
  }


  // 이름선택시 직급 추가하기
  function setValue(table) {
    const userid = event.target.value;
    const name = event.target.name;
    const index = parseInt(name.replace('agree', '').replace('deal', ''));

    if (userid === '') {
      console.log('선택 하세요');
      $('.' + table + ' tr th:nth-of-type(' + (index + 1) + ')').text('');
      return;
    }

    $.post('./jsonUser.php', {
      'userid': userid
    }, function(req) {
      const data = JSON.parse(req);
      const affil = data['affil'];

      if (affil == '') {
        console.log('인사관리에서 직급을 추가하여 주세요.');
        $('.' + table + ' tr th:nth-of-type(' + (index + 1) + ')').text('');
        return;
      } else {
        $('.' + table + ' tr th:nth-of-type(' + (index + 1) + ')').text(affil);
      }
     
    });
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
        $('#dealName' + i).removeClass('selected');
        $('#dealName' + i).val('');
        $('#dealName' + i + 'Hidden').val('');
        removeDeal();
      }
    }

  }



  // 휴가
  $('input[name="daterange"]').daterangepicker({
    "locale": {
      "format": "YYYY-MM-DD",
      "separator": " ~ ",
      "applyLabel": "확인",
      "cancelLabel": "취소",
      "fromLabel": "From",
      "toLabel": "To",
      "customRangeLabel": "Custom",
      "weekLabel": "W",
      "daysOfWeek": ["월", "화", "수", "목", "금", "토", "일"],
      "monthNames": ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
      "firstDay": 1
    },
    "drops": "down"
  }, function(start, end, label) {
    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  });

  //// 이벤트
  // 버튼 - 인쇄하기
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
      removeAgree();
    }
    if ($('#dealTr th:last').text("")) {
      removeDeal();
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