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

			//����Ϸ��� ������ ������ ���ų� ���������� �Ѵܰ辿 ������Ų��.
			$sql = "select * from wo_ing02 where sort >= $sort order by sort asc";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			for($i=0; $i<$num; $i++){
				$row = mysql_fetch_array($result);
				$set_uid = $row['uid'];
				$set_sort = $row['sort'];
				$set_sort += 1;

				mysql_query("update wo_ing02 set sort=$set_sort where uid=$set_uid");
			}








			$reg_date = mktime();

			if($d_yy && $d_mm && $d_dd)	$domain_date = mktime(0,0,0,$d_mm,$d_dd,$d_yy);
			else	$domain_date = '';

			if($h_yy && $h_mm && $h_dd)	$host_date = mktime(0,0,0,$h_mm,$h_dd,$h_yy);
			else	$host_date = '';

			$sql = "insert into wo_ing02  (sort,userid,name,company,host_id,host_pwd,upjong,person,staff,status,tel01,tel02,tel03,hp01,hp02,hp03,date01,edate01,edate02,edate03,price01,price02,price03,vat,domain,domain_com,domain_id,domain_pwd,site_id,site_pwd,domain_date,host_date,virtualhost,playing,ment ,reg_date,userfile01,realfile01) values ";
			$sql .= "('$sort','$userid','$name','$company','$host_id','$host_pwd','$upjong','$person','$staff','$status','$tel01','$tel02','$tel03','$hp01','$hp02','$hp03','$date01','$edate01','$edate02','$edate03','$price01','$price02','$price03','$vat','$domain','$domain_com','$domain_id','$domain_pwd','$site_id','$site_pwd','$domain_date','$host_date','$virtualhost','$playing','$ment ','$reg_date','$arr_new_file[1]','$real_name[1]')";
			$result = mysql_query($sql);
			$msg = '��ϵǾ����ϴ�';

			

		}else{



			if($old_sort < $sort){	 //���������� �����...
				//���������� ������ ������ ���̿� �ִ� �������� ������ �Ѵܰ辿 ���ҽ�Ų��.
				$sql = "select * from wo_ing02 where sort > $old_sort and sort <= $sort order by sort asc";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);

				for($i=0; $i<$num; $i++){
					$row = mysql_fetch_array($result);
					$set_uid = $row['uid'];
					$set_sort = $row['sort'];
					$set_sort -= 1;

					mysql_query("update wo_ing02 set sort=$set_sort where uid=$set_uid");
				}

			}elseif($old_sort > $sort){	 //���������� �����...
				//���������� ������ ������ ���̿� �ִ� �������� ������ �Ѵܰ辿 ������Ų��.
				$sql = "select * from wo_ing02 where sort < $old_sort and sort >= $sort order by sort asc";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);

				for($i=0; $i<$num; $i++){
					$row = mysql_fetch_array($result);
					$set_uid = $row['uid'];
					$set_sort = $row['sort'];
					$set_sort += 1;

					mysql_query("update wo_ing02 set sort=$set_sort where uid=$set_uid");
				}

			}







			if($d_yy && $d_mm && $d_dd)	$domain_date = mktime(0,0,0,$d_mm,$d_dd,$d_yy);
			else	$domain_date = '';

			if($h_yy && $h_mm && $h_dd)	$host_date = mktime(0,0,0,$h_mm,$h_dd,$h_yy);
			else	$host_date = '';



			$sql = "update wo_ing02 set ";
			$sql .= "sort='$sort', ";
			$sql .= "name='$name', ";
			$sql .= "company='$company', ";
			$sql .= "host_id='$host_id', ";
			$sql .= "host_pwd='$host_pwd', ";
			$sql .= "upjong='$upjong', ";
			$sql .= "person='$person', ";
			$sql .= "staff='$staff', ";
			$sql .= "status='$status', ";
			$sql .= "tel01='$tel01', ";
			$sql .= "tel02='$tel02', ";
			$sql .= "tel03='$tel03', ";
			$sql .= "hp01='$hp01', ";
			$sql .= "hp02='$hp02', ";
			$sql .= "hp03='$hp03', ";
			$sql .= "date01='$date01', ";
			$sql .= "edate01='$edate01', ";
			$sql .= "edate02='$edate02', ";
			$sql .= "edate03='$edate03', ";
			$sql .= "price01='$price01', ";
			$sql .= "price02='$price02', ";
			$sql .= "price03='$price03', ";
			$sql .= "vat='$vat', ";
			$sql .= "domain='$domain', ";
			$sql .= "domain_com='$domain_com', ";
			$sql .= "domain_id='$domain_id', ";
			$sql .= "domain_pwd='$domain_pwd', ";
			$sql .= "site_id='$site_id', ";
			$sql .= "site_pwd='$site_pwd', ";
			$sql .= "domain_date='$domain_date', ";
			$sql .= "host_date='$host_date', ";
			$sql .= "virtualhost='$virtualhost', ";
			$sql .= "playing='$playing', ";
			$sql .= "ment='$ment' ";

			if($arr_new_file[1] || $del_upfile01=='Y'){
				$sql .= ", userfile01='$arr_new_file[1]' ";
				$sql .= ", realfile01='$real_name[1]' ";
			}

			$sql .= " where uid=$uid";
			$result = mysql_query($sql);

			$msg = '�����Ǿ����ϴ�';



			if($playing == '100%'){

				//������� 100%�� ���
				$sql = "select sort from wo_ing02 where uid=$uid";
				$result = mysql_query($sql);
				$sort = mysql_result($result,0,0);

				//�������� ���������� �Ѵܰ辿 ���ҽ�Ų��.
				$sql = "select * from wo_ing02 where sort > $sort order by sort asc";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);


				for($i=0; $i<$num; $i++){
					$row = mysql_fetch_array($result);
					$set_uid = $row['uid'];
					$set_sort = $row['sort'];
					$set_sort -= 1;

					mysql_query("update wo_ing02 set sort=$set_sort where uid=$set_uid");
				}





				//�Ϸ� ���̺� �����Ѵ�.
				$sql = "select max(sort) from wo_ing02e";
				$result = mysql_query($sql);
				$max = mysql_result($result,0,0);

				if($max)	$max = $max + 1;
				else	$max = '1';


				$sql = "select * from wo_ing02 where uid='$uid'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);

				$sort = $row["sort"];
				$userid = $row["userid"];
				$name = $row["name"];
				$company = $row["company"];
				$host_id = $row["host_id"];
				$host_pwd = $row["host_pwd"];
				$upjong = $row["upjong"];
				$person = $row["person"];
				$staff = $row["staff"];
				$status = $row["status"];
				$tel01 = $row["tel01"];
				$tel02 = $row["tel02"];
				$tel03 = $row["tel03"];
				$hp01 = $row["hp01"];
				$hp02 = $row["hp02"];
				$hp03 = $row["hp03"];
				$date01 = $row["date01"];
				$edate01 = $row["edate01"];
				$edate02 = $row["edate02"];
				$edate03 = $row["edate03"];
				$price01 = $row["price01"];
				$price02 = $row["price02"];
				$price03 = $row["price03"];
				$vat = $row["vat"];
				$domain = $row["domain"];
				$domain_com = $row["domain_com"];
				$domain_id = $row["domain_id"];
				$domain_pwd = $row["domain_pwd"];
				$site_id = $row["site_id"];
				$site_pwd = $row["site_pwd"];
				$domain_date = $row["domain_date"];
				$host_date = $row["host_date"];
				$playing = $row["playing"];
				$ment = $row["ment"];
				$reg_date = $row["reg_date"];
				$userfile01 = $row["userfile01"];
				$realfile01 = $row["realfile01"];
				
				$sql = "insert into wo_ing02e  (sort,userid,name,company,host_id,host_pwd,upjong,person,staff,status,tel01,tel02,tel03,hp01,hp02,hp03,date01,edate01,edate02,edate03,price01,price02,price03,vat,domain,domain_com,domain_id,domain_pwd,site_id,site_pwd,domain_date,host_date,playing,ment ,reg_date,userfile01,realfile01) values ";
				$sql .= "('$max','$userid','$name','$company','$host_id','$host_pwd','$upjong','$person','$staff','$status','$tel01','$tel02','$tel03','$hp01','$hp02','$hp03','$date01','$edate01','$edate02','$edate03','$price01','$price02','$price03','$vat','$domain','$domain_com','$domain_id','$domain_pwd','$site_id','$site_pwd','$domain_date','$host_date','$playing','$ment ','$reg_date','$userfile01','$realfile01')";

				$result = mysql_query($sql);



				//�������̺��� �����Ѵ�
				$sql = "delete from wo_ing02 where uid=$uid";
				$result = mysql_query($sql);

			}

			
			
		}

		break;



	case 'del' :

		$sql = "select sort from wo_ing02 where uid=$uid";
		$result = mysql_query($sql);
		$sort = mysql_result($result,0,0);

		//�����ϴ� �������� ���������� �Ѵܰ辿 ���ҽ�Ų��.
		$sql = "select * from wo_ing02 where sort > $sort order by sort asc";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);


		for($i=0; $i<$num; $i++){
			$row = mysql_fetch_array($result);
			$set_uid = $row['uid'];
			$set_sort = $row['sort'];
			$set_sort -= 1;

			mysql_query("update wo_ing02 set sort=$set_sort where uid=$set_uid");
		}



		$sql = "select * from wo_ing02 where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for($i=1; $i<=$tot_num; $i++){
			$file_num = sprintf("%02d",$i);
			$del_file = $row["userfile".$file_num];

			if($del_file){
				unlink($UPLOAD_DIR."/".$del_file);
			}
		}




		$sql = "delete from wo_ing02 where uid=$uid";
		$result = mysql_query($sql);

		$msg = '�����Ǿ����ϴ�';	

		break;







	case 'back' :

		$sql = "select * from wo_ing02 where uid=$uid";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$sort = $row["sort"];
		$userid = $row["userid"];
		$name = $row["name"];
		$company = $row["company"];
		$host_id = $row["host_id"];
		$host_pwd = $row["host_pwd"];
		$upjong = $row["upjong"];
		$person = $row["person"];
		$staff = $row["staff"];
		$status = $row["status"];
		$tel01 = $row["tel01"];
		$tel02 = $row["tel02"];
		$tel03 = $row["tel03"];
		$hp01 = $row["hp01"];
		$hp02 = $row["hp02"];
		$hp03 = $row["hp03"];
		$date01 = $row["date01"];
		$edate01 = $row["edate01"];
		$edate02 = $row["edate02"];
		$edate03 = $row["edate03"];
		$price01 = $row["price01"];
		$price02 = $row["price02"];
		$price03 = $row["price03"];
		$vat = $row["vat"];
		$domain = $row["domain"];
		$domain_com = $row["domain_com"];
		$domain_id = $row["domain_id"];
		$domain_pwd = $row["domain_pwd"];
		$site_id = $row["site_id"];
		$site_pwd = $row["site_pwd"];
		$domain_date = $row["domain_date"];
		$host_date = $row["host_date"];
		$playing = $row["playing"];
		$ment = $row["ment"];
		$reg_date = $row["reg_date"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		//������Ȳ ���̺� ���������� �����Ѵ�..
		//���Ϻ���
		if($userfile01){
			$file_path = './upfile/';
			$copy_file = copy($file_path.$userfile01, '../ing01/upfile/'.$userfile01);

			//�������ϻ���
			unlink($UPLOAD_DIR."/".$userfile01);
			
		}

		//������������
		$sql = "select max(sort) from wo_ing01";
		$result = mysql_query($sql);
		$max = mysql_result($result,0,0);

		if($max)	$max = $max + 1;
		else	$max = '1';

		$reg_date = mktime();

		$sql = "insert into wo_ing01  (sort,userid,name,company,host_id,host_pwd,upjong,person,staff,status,tel01,tel02,tel03,hp01,hp02,hp03,date01,edate01,edate02,edate03,price01,price02,price03,vat,domain,domain_com,domain_id,domain_pwd,site_id,site_pwd,domain_date,host_date,playing,ment ,reg_date,userfile01,realfile01) values ";
		$sql .= "('$max','$userid','$name','$company','$host_id','$host_pwd','$upjong','$person','$staff','$status','$tel01','$tel02','$tel03','$hp01','$hp02','$hp03','$date01','$edate01','$edate02','$edate03','$price01','$price02','$price03','$vat','$domain','$domain_com','$domain_id','$domain_pwd','$site_id','$site_pwd','$domain_date','$host_date','$playing','$ment ','$reg_date','$userfile01','$realfile01')";
		$result = mysql_query($sql);











		//�Ϸ�ó���ϴ� �������� ���������� �Ѵܰ辿 ���ҽ�Ų��.
		$sql = "select * from wo_ing02 where sort > $sort order by sort asc";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);


		for($i=0; $i<$num; $i++){
			$row = mysql_fetch_array($result);
			$set_uid = $row['uid'];
			$set_sort = $row['sort'];
			$set_sort -= 1;

			mysql_query("update wo_ing02 set sort=$set_sort where uid=$set_uid");
		}




		$sql = "delete from wo_ing02 where uid=$uid";
		$result = mysql_query($sql);

		$msg = 'ó���Ǿ����ϴ�';	

		break;


}


unset($objProc);
unset($dbconn);

Msg::goMsg($msg,$next_url.'?play_sort='.$play_sort);
?>
