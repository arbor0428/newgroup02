<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include "../../module/class/class.FileUpload.php";


$tot_num = '1';	//÷������ �ִ밹��

$UPLOAD_DIR = "./upfile";




switch($type){
	case 'write' :
	case 'edit' :


		//���ϰ���ó��

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



		if($type=='write'){

			$reg_date = mktime();

			$sql = "insert into wo_room  (userid,name,title,ment,reg_date,userfile01,realfile01) values ";
			$sql .= "('$userid','$name','$title','$ment','$reg_date','$arr_new_file[1]','$real_name[1]')";
			$result = mysql_query($sql);
			$msg = '��ϵǾ����ϴ�';

		}else{
			$sql = "update wo_room set ";
			$sql .= "name='$name', ";
			$sql .= "title='$title', ";
			$sql .= "ment='$ment' ";

			if($arr_new_file[1] || $del_upfile01=='Y'){
				$sql .= ", userfile01='$arr_new_file[1]' ";
				$sql .= ", realfile01='$real_name[1]' ";
			}

			$sql .= " where uid=$uid";
			$result = mysql_query($sql);

			$msg = '�����Ǿ����ϴ�';
			
		}

		break;


	case 'del' :

		$sql = "select * from wo_room where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for($i=1; $i<=$tot_num; $i++){
			$file_num = sprintf("%02d",$i);
			$del_file = $row["userfile".$file_num];

			if($del_file){
				unlink($UPLOAD_DIR."/".$del_file);
			}
		}

		$sql = "delete from wo_room where uid=$uid";
		$result = mysql_query($sql);

		$msg = '�����Ǿ����ϴ�';	

		break;

}


unset($objProc);
unset($dbconn);

Msg::goMsg($msg,$next_url);
?>
