<?
if (!$n_url)  $n_url = '../';

include "../module/class/class.DbCon.php";
include "../module/class/class.Util.php";

//�������ø��(����������)
$sql = "select uid, company from wo_ing02 where uid!=24 order by binary(company)";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

$arr_agencyid = array();
$arr_agencyname = array();

$arr_agencyid[0] = '24';
$arr_agencyname[0] = '������';

for ($i = 0; $i < $num; $i++) {
  $set_agencyid = mysql_result($result, $i, 0);
  $set_agencyname = mysql_result($result, $i, 1);

  $ano = $i + 1;

  $arr_agencyid[$ano] = $set_agencyid;
  $arr_agencyname[$ano] = $set_agencyname;
}

//ȸ�����
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

//�����
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

$arr_status = array('���(�ñ�)', '��(����)', '��(2~3��)', '��(1����)');
$arr_state = array('��û', '����', '����', 'ó�����', '�Ϸ�');
$stateArr = array("��û" => "bco02", "����" => "bco04", "����" => "bco06", "ó�����" => "bco10", "�Ϸ�" => "bco11");

## �������� �迭���� ##
$bank_list = array("�泲����", "��������", "��������", "�������", "����", "�뱸����", "�λ�����", "����", "�������ݰ�", "��Ƽ����", "��������", "��ȯ����", "�츮����", "��ü��", "��������", "��������", "�ϳ�����", "HSBC", "SC��������", "����");
sort($bank_list);

$bankimg_list = array("�泲����" => "kn.jpg", "��������" => "kj.jpg", "��������" => "kb.jpg", "�������" => "ibk.jpg", "����" => "nong.jpg", "�뱸����" => "dg.jpg", "�λ�����" => "bs.jpg", "����" => "suhyup.jpg", "�������ݰ�" => "sema.jpg", "��Ƽ����" => "citi.jpg", "��������" => "shinhan.jpg", "��ȯ����" => "keb.jpg", "�츮����" => "woori.jpg", "��ü��" => "post.jpg", "��������" => "jb.jpg", "��������" => "jj.jpg", "�ϳ�����" => "hana.jpg", "HSBC" => "hsbc.jpg", "SC��������" => "sc.jpg", "����" => "sinhyup.jpg");

?>

<!-- ���� ȸ������Ʈ ���� -->
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
<!-- /���� ȸ������Ʈ ���� -->