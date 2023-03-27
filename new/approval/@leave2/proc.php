<?
include '../../head.php';
include "../../module/class/class.DbCon.php";
include '../../module/class/class.Msg.php';
include "../../module/class/class.FileUpload.php";
include '/home/workgroup/www/module/class/class.Holiday.php';

$sessionName = $_SESSION['ses_name'];

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

$type = $_GET['type'];
if (!$type) {
	$type = $_POST['type'];
	if(!$type) {
		echo "type is wrong";
		var_dump($type);
		exit;
	}
}

function nvl($str)
{
	if ($str == "") {
		return 'NULL';
	} else {
		return 0;
	}
}

function getName($userid){
	return sqlRowOne("select name from wo_member where userid='$userid'");
}


switch ($type) {
	case 'write':

		//����ó��
		$tot_num = '1';	//÷������ �ִ밹��
		$UPLOAD_DIR = "./upload";

		$doc_num = 'A';
		$doc_num .= date('Y', time());
		$doc_num .= date('W', time());
		$doc_num .= '-';
		if ($GBL_TEAM == '�������') {
			$doc_num .= '0101';
		} else if ($GBL_TEAM == '����������') {
			$doc_num .= '0102';
		} else if ($GBL_TEAM == '1��') {
			$doc_num .= '0201';
		} else if ($GBL_TEAM == '2��') {
			$doc_num .= '0202';
		}
		$row = sqlRowOne("select doc_num from wo_leave2 where doc_num like '$doc_num%' order by doc_num desc");
		if ($row == NULL) {
			$doc_num .= '001';
		} else {
			$doc_index = substr($row, 12, 3);
			$new_index = intval($doc_index) + 1;
			$quot = intval($new_index / 10);
			if ($quot == 0) {
				$doc_num .= '00' . $new_index;
			} else if ($quot == 1) {
				$doc_num .= '0' . $new_index;
			} else if ($quot == 2) {
				$doc_num .= '' . $new_index;
			} else {
				// ���� 1000�� �̻�Ѿ
			}
		}

		$userid = $_POST['userid'];
		// $doc_num = "L" . time();
		$name = $_POST['name'];
		$affil = $_POST['affil'];
		$team = $_POST['team'];
		$title = $_POST['mainTitle'];
		$text = $_POST['content'];
		$gubun = $_POST['dayoff'];
		$date1 = $_POST['date1'];
		$sort1 = $_POST['sort1'];
		$date2 = $_POST['date2'];
		$sort2 = $_POST['sort2'];
		$date_cnt = $_POST['date_cnt'];
		$acting = $_POST['acting'];
		$upfile01 = $_POST['upfile01'];
		$realfile01 = $_POST['realfile01'];
		// $upfile01 = $arr_new_file[1];
		// $realfile01 = $real_name[1];
		$opinion  = $_POST['opinion'];
		$agree1 = $_POST['agree1'];
		$agree2 = $_POST['agree2'];
		$agree3 = $_POST['agree3'];
		$deal1 = $_POST['deal1'];
		$deal2 = $_POST['deal2'];
		$deal3 = $_POST['deal3'];

		$agree1_s = nvl($agree1);
		$agree2_s = nvl($agree2);
		$agree3_s = nvl($agree3);
		$deal1_s = nvl($deal1);
		$deal2_s = nvl($deal2);
		$deal3_s = nvl($deal3);
		$status = "���δ��";
		$approval_date = $_POST['approval-date1'] . '�� ' . $_POST['approval-date2'] . '�� ' . $_POST['approval-date3'] . '��';
		$reg_time = time();

		$sql = "insert into wo_leave2 
		(userid, doc_num, name, affil, team, title, text, gubun, date1, sort1, date2, sort2, date_cnt, acting, upfile01, realfile01, opinion, 
		agree1, agree2, agree3, deal1, deal2, deal3, agree1_status, agree2_status, agree3_status, deal1_status, deal2_status, deal3_status, status, approval_date, reg_time) 
		values ('$userid', '$doc_num','$name','$affil','$team','$title','$text','$gubun','$date1','$sort1','$date2','$sort2','$date_cnt','$acting','$upfile01','$realfile01','$opinion',
		'$agree1', '$agree2', '$agree3', '$deal1', '$deal2', '$deal3', $agree1_s, $agree2_s, $agree3_s, $deal1_s, $deal2_s, $deal3_s, '$status', '$approval_date', $reg_time)";
		$result = sqlExe($sql);

		if ($result != 1) {
			$msg = "���� �߻� - result: $result";
			$url = "up_index.php?type=list";
			break;
		}
		$leave_uid = sqlRowOne("select uid from wo_leave2 where doc_num='$doc_num'");
		$ment = "<p style=\"font-size: 14pt;\">�ް� ��û�� Ȯ�� �� ���� ��Ź �帳�ϴ�.</p><br/>";
		$ment .= "<p><a href=\"http://i-work.kr/approval/leave2/up_index.php?type=view&uid=$leave_uid\" target=\"_blank\"><span style=\"font-size: 16pt; text-decoration:underline; color:#00f;\">�ٷΰ���</span></a></p>";

		$userid_arr = Array($agree1, $agree2, $agree3, $deal1, $deal2, $deal3);

		foreach ($userid_arr as $val) {
			if ($val != '') {
				$re_name = getName($val);
				$sql2 = "insert into wo_job (userid,name,project,set_project,team,status,title,ment,state,reg_date,re_name) values ";
				$sql2 .= "('$userid','$name','������','24','$team','���(�ñ�)','�ް���û�� ���� ����','$ment','��û','$reg_time','$re_name')";
				$result2 = sqlExe($sql2);
				if ($result2 != 1) {
					$msg = "���� �߻� - result2: $result2, �����: $re_name";
					$url = "up_index.php?type=list";
					break;
				}
			}
		}

		if ($result == 1 && $result2 == 1) {
		} else {
			$msg = "���� �߻� - result: $result, result2: $result2";
		}

		$msg = '�ް���û�� �Ϸ�Ǿ����ϴ�';
		$url = "up_index.php?type=list";
		break;

	case 'edit':
		$num = $_POST['num'];
		$userid = $_POST['userid'];
		$name = $_POST['userid'];
		$affil = $_POST['affil'];
		$team = $_POST['team'];
		$title = $_POST['mainTitle'];
		$text = $_POST['content'];
		$gubun = $_POST['dayoff'];
		$date1 = $_POST['date1'];
		$sort1 = $_POST['dayoff_sort1'];
		$date2 = $_POST['date2'];
		$sort2 = $_POST['dayoff_sort2'];
		$elapsed = $_POST['elapsed'];
		//$file = $_POST['file'];
		$opinion  = $_POST['opinion'];
		$agree1 = $_POST['agree1'];
		$agree2 = $_POST['agree2'];
		$agree3 = $_POST['agree3'];
		$agree3 = $_POST['agree3'];
		$agree4 = $_POST['agree4'];
		$agree5 = $_POST['agree5'];
		$agree6 = $_POST['agree6'];
		$status = $_POST['status'];
		$deal1 = $_POST['deal1'];
		$deal2 = $_POST['deal2'];
		$deal3 = $_POST['deal3'];
		$deal4 = $_POST['deal4'];
		$deal5 = $_POST['deal5'];

		$sql = "update wo_leave set ";
		$sql .= "title = '$title', "; // ����
		$sql .= "text = '$text', "; // ����
		$sql .= "gubun = '$gubun', "; // ���뵵
		$sql .= "date1 = '$date1', "; // ������
		$sql .= "sort1 = '$sort1', "; // ����/����/����
		$sql .= "date2 = '$date2', "; // ��������
		$sql .= "sort2 = '$sort2', "; // ����/����/����
		//$sql .= "file = '$file', "; // �����̸�
		$sql .= "opinion = '$opinion', "; // �ǰ�
		$sql .= "agree1 = '$agree1', "; // ���� �����
		$sql .= "agree2 = '$agree2', "; //����
		$sql .= "agree3 = '$agree3', ";
		$sql .= "agree4 = '$agree4', ";
		$sql .= "agree5 = '$agree5', ";
		$sql .= "status = '$status', "; // �ۼ���
		$sql .= "deal1 = '$deal1', ";
		$sql .= "deal2 = '$deal2', ";
		$sql .= "deal3 = '$deal3', ";
		$sql .= "deal4 = '$deal4', ";
		$sql .= "deal5 = '$deal5' ";
		$sql .= " where uid=$uid";


		$result = mysql_query($sql);
		$msg = '�����Ǿ����ϴ�.';

		break;

	case 'del':
		$uid = $_GET['uid'];
		// $sql = "update wo_leave2 set userid='', name='', affil='', team='', title='������ �����Դϴ�.', text='������ �����Դϴ�.', gubun='', date1='', sort1='', date2='', sort2='', date3='', sort3='', date_cnt='', opinion='',
		// agree1='', agree2='', agree3='', deal1='', deal2='', deal3='', status ='����', upfile01='', realfile01='' where uid=$uid";
		$sql = "delete from wo_leave2 where uid=$uid";
		$result = sqlExe($sql);

		if ($result == 1) {
			$msg = '�����Ǿ����ϴ�.';
		} else {
			$msg = '�����߻� delete';
		}

		$type = 'list';
		$url = "up_index.php?type=$type";

		break;

	case 'agree':
		$uid = $_GET['uid'];
		$target = $_GET['target'];
		$target_val = $_GET[$target];
		$msg = '';

		$result = sqlExe("update wo_leave2 set $target=$target_val where uid=$uid");

		if ($result != 1) {
			$msg .= '���� �߻� 11!';
		}

		// status update
		$sql = "select userid, gubun, date1, sort1, date2, sort2, date_cnt, status, IFNULL(agree1_status, 2) a1, IFNULL(agree2_status, 2) a2, IFNULL(agree3_status, 2) a3, IFNULL(deal1_status, 2) d1, IFNULL(deal2_status, 2) d2, IFNULL(deal3_status, 2) d3 from wo_leave2 where uid=$uid";
		$row = sqlRow($sql);

		$userid = $row['userid'];
		$gubun = $row['gubun'];
		$date1 = $row['date1'];
		$sort1 = $row['sort1'];
		$date2 = $row['date2'];
		$sort2 = $row['sort2'];
		$date_cnt = $row['date_cnt'];
		$status = $row['status'];
		$agree1_status = intval($row['a1']);
		$agree2_status = intval($row['a2']);
		$agree3_status = intval($row['a3']);
		$deal1_status = intval($row['d1']);
		$deal2_status = intval($row['d2']);
		$deal3_status = intval($row['d3']);

		$procDelete = false;
		if ($status == '����') {
			$procDelete = true;
		}

		if ($agree1_status == 1 || $agree2_status == 1 || $agree3_status == 1 || $deal1_status == 1 || $deal2_status == 1 || $deal3_status == 1) {
			$status = '�ݷ�';
		} else if ($agree1_status !== 0 && $agree2_status !== 0 && $agree3_status !== 0 && $deal1_status !== 0 && $deal2_status !== 0 && $deal3_status !== 0) {
			$status = '����';
		} else {
			$status = '���';
		}

		$result2 = sqlExe("update wo_leave2 set status='$status' where uid=$uid");

		if ($result2 != 1) {
			$msg .= '���� �߻� 22!';
		}

		if ($status == '����') {
			$rTime = strtotime($date1);
			$rYoil = date('w', $rTime);
			if ($gubun == 'H') {
				$result3 = sqlExe("insert into wo_dayoff (leave_uid, userid, offType, rYoil, rDate, rTime) values ($uid, '$userid', '$gubun', '$rYoil', '$date1', $rTime)");
				if ($result3 != 1) {
					$msg .= '���� �߻� 33!';
				}
			} else {

				$time1 = strtotime($date1);
				$time2 = strtotime($date2);
				$len = intval(($time2 - $time1) / 86400) + 1;
				$HOLIDAY = Holiday(date('Y', $time1), date('Y', $time2));
				// var_dump($HOLIDAY['20220130']);
				for ($i = 0; $i < $len; $i++) {
					$rTime = $time1 + ($i * 86400);
					$rYoil = date('w', $rTime);

					if ($rYoil == 0 || $rYoil == 6 || $HOLIDAY[date('Ymd', $rTime)] != NULL) {
						continue;
					} else {
						if ($i == 0) {
							$gubun = $sort1 == '����' ? 'A' : 'H';
						} else if ($i == $len - 1) {
							$gubun = $sort2 == '����' ? 'A' : 'H';
						} else {
							$gubun = 'A';
						}

						$rDate = date('Y-m-d', $rTime);
						$result3 = sqlExe("insert into wo_dayoff (leave_uid, userid, offType, rYoil, rDate, rTime) values ($uid, '$userid', '$gubun', '$rYoil', '$rDate', $rTime)");
						if ($result3 != 1) {
							$msg .= '���� �߻� 33!';
						}
					}
				}
			}

			$msg = '�ް��� ���� �Ǿ����ϴ�.';
		} else {
			if ($procDelete) {
				$result4 = sqlExe("delete from wo_dayoff where leave_uid='$uid'");
				if ($result4 != 1) {
					$msg .= '���� �߻� 44!';
				}
				$msg .= '�ݷ� �Ǿ����ϴ�';
			} else {
				$msg .= '���� �Ǿ����ϴ�';
			}
		}

		$url = "up_index.php?type=view&uid=$uid";
		break;
}

Msg::goMsg($msg, $url);
?>

<!-- <form name='frm' method='post' action='up_index.php'>
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='record_start' value='<?= $record_start ?>'>
	<input type='hidden' name='f_name' value='<?= $f_name ?>'>
	<input type='hidden' name='f_manager' value='<?= $f_manager ?>'>
	<input type='hidden' name='f_site' value='<?= $f_site ?>'>
	<input type='hidden' name='f_naverID' value='<?= $f_naverID ?>'>
	<input type='hidden' name='f_daumID' value='<?= $f_daumID ?>'>
	<input type='hidden' name='f_staff' value='<?= $f_staff ?>'>
	<input type='hidden' name='f_sname' value='<?= $f_sname ?>'>
	<input type='hidden' name='f_ment' value='<?= $f_ment ?>'>
	<input type='hidden' name='f_sDate' value='<?= $f_sDate ?>'>
	<input type='hidden' name='f_eDate' value='<?= $f_eDate ?>'>
</form> -->


<!-- <script language='javascript'> -->
<!-- </script> -->