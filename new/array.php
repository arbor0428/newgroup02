<?
if (!$n_url)  $n_url = '../';

include "../module/class/class.DbCon.php";
include "../module/class/class.Util.php";

//에이젼시목록(아이웹제외)
$sql = "select uid, company from wo_ing02 where uid!=24 order by binary(company)";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

$arr_agencyid = array();
$arr_agencyname = array();

$arr_agencyid[0] = '24';
$arr_agencyname[0] = '아이웹';

for ($i = 0; $i < $num; $i++) {
  $set_agencyid = mysql_result($result, $i, 0);
  $set_agencyname = mysql_result($result, $i, 1);

  $ano = $i + 1;

  $arr_agencyid[$ano] = $set_agencyid;
  $arr_agencyname[$ano] = $set_agencyname;
}

//회원목록
if ($teamChk && $GBL_MTYPE == 'S')  $qment = " and mtype!='A'";
else                        $qment = '';

$sql = "select name, userid, team from wo_member where enable='1' and (userid!='ii1982' and userid!='ussr1285' and userid!='tabby218') $qment order by uid";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

$arr_member = array();
$arr_userid = array();
$userArr = array();
$teamArr = array();

for ($i = 0; $i < $num; $i++) {
  $set_name = mysql_result($result, $i, 0);
  $set_id = mysql_result($result, $i, 1);
  $set_team = mysql_result($result, $i, 2);

  $arr_member[$i] = $set_name;
  $arr_userid[$i] = $set_id;
  $userArr[$set_id] = $set_name;
  $teamArr[$set_id] = $set_team;
}

//팀목록
$sql = "select * from wo_setup order by uid desc limit 1";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

if ($num) {
  $row = mysql_fetch_array($result);
  $team_list = $row["team_list"];
  if ($team_list) {
    $arr_team = split(',', $team_list);
  }
}

$arr_status = array('긴급(시급)', '상(금일)', '중(2~3일)', '하(1주일)');
$arr_state = array('요청', '접수', '진행', '처리결과', '완료');
$stateArr = array("요청" => "bco02", "접수" => "bco04", "진행" => "bco06", "처리결과" => "bco10", "완료" => "bco11");

## 은행종류 배열설정 ##
$bank_list = array("경남은행", "광주은행", "국민은행", "기업은행", "농협", "대구은행", "부산은행", "수협", "새마을금고", "시티은행", "신한은행", "외환은행", "우리은행", "우체국", "전북은행", "제주은행", "하나은행", "HSBC", "SC제일은행", "신협");
sort($bank_list);

$bankimg_list = array("경남은행" => "kn.jpg", "광주은행" => "kj.jpg", "국민은행" => "kb.jpg", "기업은행" => "ibk.jpg", "농협" => "nong.jpg", "대구은행" => "dg.jpg", "부산은행" => "bs.jpg", "수협" => "suhyup.jpg", "새마을금고" => "sema.jpg", "시티은행" => "citi.jpg", "신한은행" => "shinhan.jpg", "외환은행" => "keb.jpg", "우리은행" => "woori.jpg", "우체국" => "post.jpg", "전북은행" => "jb.jpg", "제주은행" => "jj.jpg", "하나은행" => "hana.jpg", "HSBC" => "hsbc.jpg", "SC제일은행" => "sc.jpg", "신협" => "sinhyup.jpg");

?>

<!-- 팀별 회원리스트 정의 -->
<script language='javascript'>
  function set_tmlist(form, team, re_name) {
    document.tm_list.location.href = '/set_tmlist.php?form=' + form + '&team=' + team + '&re_name=' + re_name;
  }

  function clickCheckBox(obj, chk) {
    eChk = document.getElementsByName(obj);

    for (var i = 0; i < eChk.length; i++) {
      if (i == chk) eChk[i].checked = true;
      else eChk[i].checked = false;
    }
  }
</script>
<iframe name='tm_list' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' class='none_print'></iframe>
<!-- /팀별 회원리스트 정의 -->