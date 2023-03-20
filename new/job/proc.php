<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";
include "../module/class/class.FileUpload.php";


$tot_num = '1';	//첨부파일 최대갯수

$UPLOAD_DIR = "./upfile";


switch($type){
	case 'write' :
	case 'edit' :



		//파일관련처리

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


//		if($title)		$title = addslashes($title);
//		if($ment)		$ment = addslashes($ment);


		if($type=='write'){

			$reg_date = mktime();
			$userfile01 = $arr_new_file[1];
			$realfile01 = $real_name[1];

			$reNum = count($reList);

			for($i=0; $i<$reNum; $i++){
				$reArr = explode('/',$reList[$i]);
				$team = $reArr[0];
				$re_name = $reArr[1];

				if($arr_new_file[1] && $i > 0){
					$_file_name = explode('.',$arr_new_file[1]);
					$newName = $_file_name[0].'-'.$i.'.'.$_file_name[1];

					copy($UPLOAD_DIR."/".$userfile01, $UPLOAD_DIR."/".$newName);
					$userfile01 = $newName;
				}

				$sql = "insert into wo_job  (userid,name,project,set_project,team,status,title,ment,state,reg_date,re_name,userfile01,realfile01) values ";
				$sql .= "('$userid','$name','$project','$set_project','$team','$status','$title','$ment','$state','$reg_date','$re_name','$userfile01','$realfile01')";
				$result = mysql_query($sql);
			}

			$msg = '등록되었습니다';

		}else{

			$sql = "select * from wo_job where uid='$uid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$db_date = $row['end_date'];

			$sql = "update wo_job set ";
			$sql .= "name='$name', ";
			$sql .= "project='$project', ";
			$sql .= "set_project='$set_project', ";
			$sql .= "team='$team', ";
			$sql .= "status='$status', ";
			$sql .= "title='$title', ";
			$sql .= "ment='$ment', ";
			$sql .= "re_name='$re_name', ";
			if($state == '완료' && $db_date != '완료'){
				$end_date = mktime();
				$sql .= "end_date='$end_date', ";
			}elseif($state !=' 완료'){
				$end_date = '';
				$sql .= "end_date='$end_date', ";
			}

			$sql .= "state='$state' ";

			if($arr_new_file[1] || $del_upfile01=='Y'){
				$sql .= ", userfile01='$arr_new_file[1]' ";
				$sql .= ", realfile01='$real_name[1]' ";
			}

			$sql .= " where uid=$uid";
			$result = mysql_query($sql);

			$msg = '수정되었습니다';
			
		}

		break;



	case 'update' :

//		if($coment)		$coment = addslashes($coment);

		$sql = "select * from wo_job where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$db_date = $row['end_date'];


		$sql = "update wo_job set ";
		$sql .= "state='$state', ";

		if($state == '완료' && $db_date != '완료'){
			$end_date = mktime();
			$sql .= "end_date='$end_date', ";
		}elseif($state !=' 완료'){
			$end_date = '';
			$sql .= "end_date='$end_date', ";
		}

		$sql .= "re_name='$re_name', ";
		$sql .= "coment='$coment' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		$msg = '수정되었습니다';
		break;


	case 'del' :

		$sql = "select * from wo_job where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for($i=1; $i<=$tot_num; $i++){
			$file_num = sprintf("%02d",$i);
			$del_file = $row["userfile".$file_num];

			if($del_file){
				unlink($UPLOAD_DIR."/".$del_file);
			}
		}


		$sql = "delete from wo_job where uid=$uid";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';	

		$sql = "select * from wo_job order by uid desc limit 1";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$sql = "update wo_job set push='' where uid='$row[uid]'";
		$result = mysql_query($sql);

		break;








	case 'chk_end' :

		$end_date = mktime();


		for($i=0; $i<count($chk); $i++){
			$uid = $chk[$i];

			$sql = "update wo_job set ";
			$sql .= "state='완료', ";
			$sql .= "end_date='$end_date' ";
			$sql .= " where uid=$uid";
			$result = mysql_query($sql);
		}








		$msg = '수정되었습니다';
		break;

}


unset($objProc);
unset($dbconn);
?>



<form name='frm' method='post' action='<?=$next_url?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_search' value='<?=$f_search?>'>
<input type='hidden' name='f_project' value='<?=$f_project?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_re_name' value='<?=$f_re_name?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_state01' value='<?=$f_state01?>'>
<input type='hidden' name='f_state02' value='<?=$f_state02?>'>
<input type='hidden' name='f_state03' value='<?=$f_state03?>'>
<input type='hidden' name='f_state04' value='<?=$f_state04?>'>
<input type='hidden' name='f_state05' value='<?=$f_state05?>'>
<!-- /검색관련 -->
</form>

<script language='javascript'>
if('<?=$type?>' != 'chk_end'){
	alert('<?=$msg?>');
}
document.frm.submit();
</script>