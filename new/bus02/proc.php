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

//		if($ment)		$ment = addslashes($ment);


		if($type=='write'){


			$reg_date = mktime();

			$sql = "insert into wo_bus02  (mtype,userid,company,id,pwd,name,homepage,telephone,date01,account,ment,userfile01,realfile01,fax,email,reg_date) values ";
			$sql .= "('$mtype','$userid','$company','$id','$pwd','$name','$homepage','$telephone','$date01','$account','$ment','$arr_new_file[1]','$real_name[1]','$fax','$email','$reg_date')";
			$result = mysql_query($sql);
			$msg = '등록되었습니다';			
			

		}else{


			$sql = "update wo_bus02 set ";
			$sql .= "mtype='$mtype', ";
			$sql .= "company='$company', ";
			$sql .= "id='$id', ";
			$sql .= "pwd='$pwd', ";
			$sql .= "name='$name', ";
			$sql .= "homepage='$homepage', ";
			$sql .= "telephone='$telephone', ";
			$sql .= "date01='$date01', ";
			$sql .= "account='$account', ";
			$sql .= "fax='$fax', ";
			$sql .= "email='$email', ";
			$sql .= "ment='$ment' ";

			if($arr_new_file[1] || $del_upfile01=='Y'){
				$sql .= ", userfile01='$arr_new_file[1]' ";
				$sql .= ", realfile01='$real_name[1]' ";
			}

			$sql .= " where uid=$uid";
			$result = mysql_query($sql);

			$msg = '수정되었습니다';

			
			
		}

		break;



	case 'del' :

		$sql = "select * from wo_bus02 where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for($i=1; $i<=$tot_num; $i++){
			$file_num = sprintf("%02d",$i);
			$del_file = $row["userfile".$file_num];

			if($del_file){
				unlink($UPLOAD_DIR."/".$del_file);
			}
		}

		$sql = "delete from wo_bus02 where uid=$uid";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';	

		break;






}


unset($objProc);
unset($dbconn);

Msg::goMsg($msg,$next_url);
?>
