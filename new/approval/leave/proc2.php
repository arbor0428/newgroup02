<?
	include '../../head.php';
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.FileUpload.php";

	$sessionName = $_SESSION[ses_name];

switch($type){
	case 'write' :

		//파일처리
		$tot_num = '1';	//첨부파일 최대갯수
		$UPLOAD_DIR = "./upload";

		for($i=1; $i<=$tot_num; $i++){

				$file_num = sprintf("%02d",$i);
				$doc_name	= 'upfile'.$file_num;
				$db_set_file = ${'dbfile'.$file_num};
				$db_real_file = ${'realfile'.$file_num};

				if($_FILES[$doc_name][name]){
					$temp_doc = $_FILES[$doc_name][name];

					//자동번호 부여
					$ext = FileUpload::getFileExtension($_FILES[$doc_name][name]);
					$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'P');

					if($db_set_file){
						unlink($UPLOAD_DIR."/".$db_set_file);
					}

					if($fileUpload->uploadFile()){
						$arr_new_file[$i] = $fileUpload->fileInfo[rename];
					}else{
						Msg::backMsg("파일을 다시 선택해 주십시오");
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


		//agree1은 담당자여서 결재순간에 승인되어야함.
		$member_name = $row['agree1'];
		$sql2 = "select name from wo_member where userid = '$member_name' ";
		$result2 = mysql_query($sql2);
		$row2 = mysql_fetch_array($result2);
		$member_name = $row2['name'];

		$sql = "insert into wo_leave_agree2 (num, member_name, status, priority, category)
						values ('$num', '$member_name','승인' , '1', 'a')";
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


		$msg = '휴가신청이 완료되었습니다';

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
		$sql .= "title = '$title', "; // 제목
		$sql .= "text = '$text', "; // 내용
		$sql .= "gubun = '$gubun', "; // 사용용도
		$sql .= "date1 = '$date1', "; // 시작일
		$sql .= "sort1 = '$sort1', "; // 종일/오전/오후
		$sql .= "date2 = '$date2', "; // 마지막일
		$sql .= "sort2 = '$sort2', "; // 종일/오전/오후
		//$sql .= "file = '$file', "; // 파일이름
		$sql .= "opinion = '$opinion', "; // 의견
		$sql .= "agree1 = '$agree1', "; // 결재 담당자
		$sql .= "agree2 = '$agree2', "; //결재
		$sql .= "agree3 = '$agree3', ";
		$sql .= "agree4 = '$agree4', ";
		$sql .= "agree5 = '$agree5', ";
		$sql .= "status = '$status', "; // 작성일
		$sql .= "deal1 = '$deal1', ";
		$sql .= "deal2 = '$deal2', ";
		$sql .= "deal3 = '$deal3', ";
		$sql .= "deal4 = '$deal4', ";
		$sql .= "deal5 = '$deal5' ";
		$sql .= " where uid=$uid";


		$result = mysql_query($sql);
		$msg = '수정되었습니다.';

		break;

	case 'del' :
		$uid = $_POST['uid'];
		$sql = "update wo_leave set userid='',  name='', affil='', team='', title='삭제된 문서입니다.', text='삭제된 문서입니다.' , gubun='', date1='', sort1='', date2='', sort2='', elapsed='',  opinion='',
		agree1='', agree2='', agree3='', agree4='', agree5='', deal1='', deal2='', deal3='', deal4='', deal5='', status ='', upfile01='', realfile01='' where uid=$uid";
		$result = mysql_query($sql);

		$type='list';
		$msg = '삭제되었습니다.';
		break;


	case 'agree':
		$num = $_POST['num'];
		for($i = 2; $i <=5; $i++) {
				$agree.$i_status = $_POST['agree'.$i.'_status'];
				if($agree.$i_status =='승인') {
					$sql = "update wo_leave_agree2 set status = '승인'  where member_name = '$sessionName' and num='$num' and category ='a' " ;
				}
				if($agree.$i_status =='보류') {
					$sql = "update wo_leave_agree2 set status = '보류'  where member_name = '$sessionName' and num='$num' and category ='a' ";
				}
		}

		for($i = 1; $i <=5; $i++) {
				$deal.$i_status = $_POST['deal'.$i.'_status'];
				if($deal.$i_status =='승인') {
					$sql = "update wo_leave_agree2 set status = '승인'  where member_name = '$sessionName' and num='$num' and category ='d'";
				}
				if($deal.$i_status =='보류') {
					$sql = "update wo_leave_agree2 set status = '보류'  where member_name = '$sessionName' and num='$num' and category ='d'";
				}
		}





		$result = mysql_query($sql);

		$msg = '적용되었습니다.';

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