<?
	include '../../head.php';
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.FileUpload.php";

	$sessionName = $_SESSION[ses_name];

switch($type){
	case 'write' :

		//����ó��
		$tot_num = '1';	//÷������ �ִ밹��
		$UPLOAD_DIR = "./upload";

		for($i=1; $i<=$tot_num; $i++){

				$file_num = sprintf("%02d",$i);
				$doc_name	= 'upfile'.$file_num;
				$db_set_file = ${'dbfile'.$file_num};
				$db_real_file = ${'realfile'.$file_num};

				if($_FILES[$doc_name][name]){
					$temp_doc = $_FILES[$doc_name][name];

					//�ڵ���ȣ �ο�
					$ext = FileUpload::getFileExtension($_FILES[$doc_name][name]);
					$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'P');

					if($db_set_file){
						unlink($UPLOAD_DIR."/".$db_set_file);
					}

					if($fileUpload->uploadFile()){
						$arr_new_file[$i] = $fileUpload->fileInfo[rename];
					}else{
						Msg::backMsg("������ �ٽ� ������ �ֽʽÿ�");
						exit();
					}


					$real_name[$i] = $temp_doc;


				}else{
					if($_POST["del_".$doc_name]=='Y'){
						unlink($UPLOAD_DIR."/".$db_set_file);
						$arr_new_file[$i] = '';
						$real_name[$i] = '';
					}else{
						$arr_new_file[$i] = $db_set_file;
						$real_name[$i] = $db_real_file;
					}
				}


		}

		$num = $_POST['num'];
		$userid =$_POST['userid'];
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
		$upfile01 = $arr_new_file[1];
		$realfile01 = $real_name[1];
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
		$deal2= $_POST['deal2'];
		$deal3 = $_POST['deal3'];
		$deal4= $_POST['deal4'];
		$deal5 = $_POST['deal5'];

		$sql = "select name from wo_member where userid = '$name'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$name = $row['name'];

		$sql="insert into wo_leave
		(num,userid,name,affil,team,title,text,gubun,date1,sort1,date2,sort2,elapsed,opinion,agree1,agree2,agree3,agree4,agree5,agree6,status,deal1,deal2,deal3,deal4,deal5,upfile01,realfile01)
		values ('$num','$userid','$name','$affil','$team','$title','$text','$gubun','$date1','$sort1','$date2','$sort2','$elapsed','$opinion','$agree1','$agree2','$agree3','$agree4','$agree5','$agree6','$status','$deal1','$deal2','$deal3','$deal4','$deal5','$upfile01','$realfile01')";

		$result = mysql_query($sql);



		$sql = "select agree1, agree2, agree3, agree4, agree5
				from wo_leave
				where num='$num'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);


		//agree1�� ����ڿ��� ��������� ���εǾ����.
		$member_name = $row['agree1'];
		$sql2 = "select name from wo_member where userid = '$member_name' ";
		$result2 = mysql_query($sql2);
		$row2 = mysql_fetch_array($result2);
		$member_name = $row2['name'];

		$sql = "insert into wo_leave_agree2 (num, member_name, status, priority, category)
						values ('$num', '$member_name','����' , '1', 'a')";
		$result = mysql_query($sql);

		for ($i=2; $i<=5; $i++) {
			$member_name = $row['agree'.$i];

			$sql2 = "select name from wo_member where userid = '$member_name' ";
			$result2 = mysql_query($sql2);
			$row2 = mysql_fetch_array($result2);

			$member_name = $row2['name'];

			if ($member_name != ""){
				$sql = "insert into wo_leave_agree2 (num, member_name, priority, category)
						values ('$num', '$member_name', '".$i."', 'a')";
				$result = mysql_query($sql);
			} else {
				break;
			}
		}


		$sql = "select deal1, deal2, deal3, deal4, deal5
				from wo_leave
				where num='$num'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for ($i=1; $i<=5; $i++) {
			$member_name = $row['deal'.$i];

			$sql3 = "select name from wo_member where userid = '$member_name' ";
			$result3 = mysql_query($sql3);
			$row3 = mysql_fetch_array($result3);

			$member_name = $row3['name'];

			if ($member_name != ""){
				$sql = "insert into wo_leave_agree2 (num, member_name, priority, category)
						values ('$num', '$member_name', '".$i."', 'd')";
				$result = mysql_query($sql);

			} else {
				break;
			}
		}


		$msg = '�ް���û�� �Ϸ�Ǿ����ϴ�';

		break;

	case 'edit' :
		$num = $_POST['num'];
		$userid =$_POST['userid'];
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
		$deal2= $_POST['deal2'];
		$deal3 = $_POST['deal3'];
		$deal4= $_POST['deal4'];
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

	case 'del' :
		$uid = $_POST['uid'];
		$sql = "update wo_leave set userid='',  name='', affil='', team='', title='������ �����Դϴ�.', text='������ �����Դϴ�.' , gubun='', date1='', sort1='', date2='', sort2='', elapsed='',  opinion='',
		agree1='', agree2='', agree3='', agree4='', agree5='', deal1='', deal2='', deal3='', deal4='', deal5='', status ='', upfile01='', realfile01='' where uid=$uid";
		$result = mysql_query($sql);

		$type='list';
		$msg = '�����Ǿ����ϴ�.';
		break;


	case 'agree':
		$num = $_POST['num'];
		for($i = 2; $i <=5; $i++) {
				$agree.$i_status = $_POST['agree'.$i.'_status'];
				if($agree.$i_status =='����') {
					$sql = "update wo_leave_agree2 set status = '����'  where member_name = '$sessionName' and num='$num' and category ='a' " ;
				}
				if($agree.$i_status =='����') {
					$sql = "update wo_leave_agree2 set status = '����'  where member_name = '$sessionName' and num='$num' and category ='a' ";
				}
		}

		for($i = 1; $i <=5; $i++) {
				$deal.$i_status = $_POST['deal'.$i.'_status'];
				if($deal.$i_status =='����') {
					$sql = "update wo_leave_agree2 set status = '����'  where member_name = '$sessionName' and num='$num' and category ='d'";
				}
				if($deal.$i_status =='����') {
					$sql = "update wo_leave_agree2 set status = '����'  where member_name = '$sessionName' and num='$num' and category ='d'";
				}
		}





		$result = mysql_query($sql);

		$msg = '����Ǿ����ϴ�.';

		break;
}

?>


<form name='frm' method='post' action='up_index.php'>
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
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
</form>


<script language='javascript'>
	alert('<?=$msg?>');
	document.frm.submit();
</script>