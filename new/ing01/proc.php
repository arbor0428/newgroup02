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



		if($ment == '<p>&nbsp;</p>')		$ment = '';
//		if($ment)		$ment = addslashes($ment);

/************************************************* 등록 **********************************************************/



		if($type=='write'){

			//등록하려는 업무의 순위와 같거나 높은순위는 한단계씩 증가시킨다.
			$sql = "select * from wo_ing01 where sort >= $sort order by sort asc";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			for($i=0; $i<$num; $i++){
				$row = mysql_fetch_array($result);
				$set_uid = $row['uid'];
				$set_sort = $row['sort'];
				$set_sort += 1;

				mysql_query("update wo_ing01 set sort=$set_sort where uid=$set_uid");
			}








			$reg_date = mktime();

			$ctime = mktime(date('H'),date('i'),date('s'),$cdate02,$cdate03,$cdate01);

			$sql = "insert into wo_ing01  (sort,userid,name,company,upjong,person,status,tel01,tel02,tel03,hp01,hp02,hp03,date01,edate01,edate02,edate03,price01,price02,price02_1,price03,price02_date,price02_1_date,vat,domain,domain_com,domain_id,domain_pwd,site_id,site_pwd,playing,ment ,reg_date,userfile01,realfile01,email,fax01,fax02,fax03,site_name,re_name,cdate01,cdate02,cdate03,ctime) values ";
			$sql .= "('$sort','$userid','$name','$company','$upjong','$person','$status','$tel01','$tel02','$tel03','$hp01','$hp02','$hp03','$date01','$edate01','$edate02','$edate03','$price01','$price02','$price02_1','$price03','$price02_date','$price02_1_date','$vat','$domain','$domain_com','$domain_id','$domain_pwd','$site_id','$site_pwd','$playing','$ment ','$reg_date','$arr_new_file[1]','$real_name[1]','$email','$fax01','$fax02','$fax03','$site_name','$re_name','$cdate01','$cdate02','$cdate03','$ctime')";
			$result = mysql_query($sql);





			//방금등록한 영업현황의 uid값
			$sql = "select uid from wo_ing01 where reg_date='$reg_date' order by uid desc limit 1";
			$result = mysql_query($sql);
			$pid = mysql_result($result,0,0);






			//내용등록
			if($ment || $cost || $deposit || $deposit_date){
				$sql = "insert into wo_ing01_ment (pid,reg_date,ment,cost,cost_vat,deposit,deposit_date) values ('$pid','$reg_date','$ment','$cost','$cost_vat','$deposit','$deposit_date')";
				$result = mysql_query($sql);
			}





			//도메인정보등록
			$dfast = '9999999999';
			$dlist = '';


			$donum = count($doname);

			for($i=0; $i<$donum; $i++){
				$in_doname = $doname[$i];
				$in_docom = $docom[$i];
				$in_doid = $doid[$i];
				$in_dopwd = $dopwd[$i];

				$in_do_y = $do_y[$i];
				$in_do_m = $do_m[$i];
				$in_do_d = $do_d[$i];

				if($in_do_y && $in_do_m && $in_do_d){
					$in_dodate = mktime(0,0,0,$in_do_m,$in_do_d,$in_do_y);
					if($in_dodate < $dfast)	$dfast = $in_dodate;

				}else{
					$in_dodate = '';

				}

				if($in_doname){
					if($dlist)	$dlist .= ',';

					$dlist .= $in_doname;
				}



				if($in_doname || $in_docom || $in_doid || $in_dopwd || $in_dodate){
					$sql = "insert into wo_ing01_domain (pid,doname,docom,dodate,doid,dopwd) values ('$pid','$in_doname','$in_docom','$in_dodate','$in_doid','$in_dopwd')";
					$result = mysql_query($sql);
				}
			}

			if($dfast == '9999999999')	$dfast = '';



			//에이젼시현황 테이블에 만료일이 가장빠른 날을 저장한다.
			$sql = "update wo_ing01 set domain_date='$dfast', domain='$dlist' where uid='$pid'";
			$result = mysql_query($sql);









			//호스팅정보등록
			$hfast = '9999999999';


			$honum = count($hocom);

			for($i=0; $i<$honum; $i++){
				$in_ftpstate = $ftpstate[$i];
				$in_ftptype = $ftptype[$i];
				$in_ftpcapa = $ftpcapa[$i];
				$in_ftpprice = $ftpprice[$i];
				$in_ftpid = $ftpid[$i];
				$in_ftppwd = $ftppwd[$i];
				$in_hocom = $hocom[$i];
				$in_hoid = $hoid[$i];
				$in_hopwd = $hopwd[$i];

				$in_ho_y = $ho_y[$i];
				$in_ho_m = $ho_m[$i];
				$in_ho_d = $ho_d[$i];

				if($in_ho_y && $in_ho_m && $in_ho_d){
					$in_hodate = mktime(0,0,0,$in_ho_m,$in_ho_d,$in_ho_y);
					if($in_hodate < $hfast)	$hfast = $in_hodate;

				}else{
					$in_hodate = '';

				}



				if($in_ftpcapa || $in_ftptype || $in_ftpprice || $in_ftpid || $in_ftppwd || $in_hocom || $in_hoid || $in_hopwd || $in_hodate){
					$sql = "insert into wo_ing01_host (pid,ftpstate,ftptype,ftpid,ftppwd,hocom,hodate,hoid,hopwd,ftpcapa,ftpprice) values ('$pid','$in_ftpstate','$in_ftptype','$in_ftpid','$in_ftppwd','$in_hocom','$in_hodate','$in_hoid','$in_hopwd','$in_ftpcapa','$in_ftpprice')";
					$result = mysql_query($sql);
				}
			}

			if($hfast == '9999999999')	$hfast = '';



			//에이젼시현황 테이블에 만료일이 가장빠른 날을 저장한다.
			$sql = "update wo_ing01 set host_date='$hfast' where uid='$pid'";
			$result = mysql_query($sql);








			$class = 'goMsg';
			$msg = '등록되었습니다';
			


/************************************************* /등록 **********************************************************/




			

		}else{






/************************************************* 수정 **********************************************************/

			if($old_sort < $sort){	 //높은순위로 변경시...
				//기존순위와 수정한 순위의 사이에 있는 업무들의 순위를 한단계씩 감소시킨다.
				$sql = "select * from wo_ing01 where sort > $old_sort and sort <= $sort order by sort asc";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);

				for($i=0; $i<$num; $i++){
					$row = mysql_fetch_array($result);
					$set_uid = $row['uid'];
					$set_sort = $row['sort'];
					$set_sort -= 1;

					mysql_query("update wo_ing01 set sort=$set_sort where uid=$set_uid");
				}

			}elseif($old_sort > $sort){	 //낮은순위로 변경시...
				//기존순위와 수정한 순위의 사이에 있는 업무들의 순위를 한단계씩 증가시킨다.
				$sql = "select * from wo_ing01 where sort < $old_sort and sort >= $sort order by sort asc";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);

				for($i=0; $i<$num; $i++){
					$row = mysql_fetch_array($result);
					$set_uid = $row['uid'];
					$set_sort = $row['sort'];
					$set_sort += 1;

					mysql_query("update wo_ing01 set sort=$set_sort where uid=$set_uid");
				}

			}




			$ctime = mktime(date('H'),date('i'),date('s'),$cdate02,$cdate03,$cdate01);



			$sql = "update wo_ing01 set ";
			$sql .= "sort='$sort', ";
			$sql .= "name='$name', ";
			$sql .= "company='$company', ";
			$sql .= "upjong='$upjong', ";
			$sql .= "person='$person', ";
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
			$sql .= "price02_1='$price02_1', ";
			$sql .= "price03='$price03', ";
			$sql .= "price02_date='$price02_date', ";
			$sql .= "price02_1_date='$price02_1_date', ";
			$sql .= "vat='$vat', ";
			$sql .= "domain='$domain', ";
			$sql .= "domain_com='$domain_com', ";
			$sql .= "domain_id='$domain_id', ";
			$sql .= "domain_pwd='$domain_pwd', ";
			$sql .= "site_id='$site_id', ";
			$sql .= "site_pwd='$site_pwd', ";
			$sql .= "playing='$playing', ";
			$sql .= "ment='$ment', ";
			$sql .= "email='$email', ";
			$sql .= "fax01='$fax01', ";
			$sql .= "fax02='$fax02', ";
			$sql .= "fax03='$fax03', ";
			$sql .= "site_name='$site_name', ";
			$sql .= "re_name='$re_name', ";
			$sql .= "cdate01='$cdate01', ";
			$sql .= "cdate02='$cdate02', ";
			$sql .= "cdate03='$cdate03', ";
			$sql .= "ctime='$ctime' ";



			if($arr_new_file[1] || $del_upfile01=='Y'){
				$sql .= ", userfile01='$arr_new_file[1]' ";
				$sql .= ", realfile01='$real_name[1]' ";
			}

			$sql .= " where uid=$uid";
			$result = mysql_query($sql);






			//내용수정 또는 등록
			if($ment || $cost || $deposit || $deposit_date){
				$reg_date = mktime();

				if($mid)	$sql = "update wo_ing01_ment set ment='$ment',cost='$cost',cost_vat='$cost_vat',deposit='$deposit',deposit_date='$deposit_date' where uid='$mid'";
				else	$sql = "insert into wo_ing01_ment (pid,reg_date,ment,cost,cost_vat,deposit,deposit_date) values ('$uid','$reg_date','$ment','$cost','$cost_vat','$deposit','$deposit_date')";

				$result = mysql_query($sql);
			}








			//기존에 등록된 도메인 정보는 삭제한다.
			$sql = "delete from wo_ing01_domain where pid='$uid'";
			$result = mysql_query($sql);



			//도메인 정보등록
			$dfast = '9999999999';
			$dlist = '';

			$donum = count($doname);

			for($i=0; $i<$donum; $i++){
				$in_doname = $doname[$i];
				$in_docom = $docom[$i];
				$in_doid = $doid[$i];
				$in_dopwd = $dopwd[$i];

				$in_do_y = $do_y[$i];
				$in_do_m = $do_m[$i];
				$in_do_d = $do_d[$i];

				if($in_do_y && $in_do_m && $in_do_d){
					$in_dodate = mktime(0,0,0,$in_do_m,$in_do_d,$in_do_y);
					if($in_dodate < $dfast)	$dfast = $in_dodate;

				}else{
					$in_dodate = '';

				}

				if($in_doname){
					if($dlist)	$dlist .= ',';

					$dlist .= $in_doname;
				}



				if($in_doname || $in_docom || $in_doid || $in_dopwd || $in_dodate){
					$sql = "insert into wo_ing01_domain (pid,doname,docom,dodate,doid,dopwd) values ('$uid','$in_doname','$in_docom','$in_dodate','$in_doid','$in_dopwd')";
					$result = mysql_query($sql);
				}
			}



			if($dfast == '9999999999')	$dfast = '';



			//에이젼시현황 테이블에 만료일이 가장빠른 날을 저장한다.
			$sql = "update wo_ing01 set domain_date='$dfast', domain='$dlist' where uid='$uid'";
			$result = mysql_query($sql);













			//기존에 등록된 호스팅 정보는 삭제한다.
			$sql = "delete from wo_ing01_host where pid='$uid'";
			$result = mysql_query($sql);



			//호스팅 인정보등록
			$hfast = '9999999999';


			$honum = count($hocom);

			for($i=0; $i<$honum; $i++){
				$in_ftpstate = $ftpstate[$i];
				$in_ftptype = $ftptype[$i];
				$in_ftpcapa = $ftpcapa[$i];
				$in_ftpprice = $ftpprice[$i];
				$in_ftpid = $ftpid[$i];
				$in_ftppwd = $ftppwd[$i];
				$in_hocom = $hocom[$i];
				$in_hoid = $hoid[$i];
				$in_hopwd = $hopwd[$i];

				$in_ho_y = $ho_y[$i];
				$in_ho_m = $ho_m[$i];
				$in_ho_d = $ho_d[$i];

				if($in_ho_y && $in_ho_m && $in_ho_d){
					$in_hodate = mktime(0,0,0,$in_ho_m,$in_ho_d,$in_ho_y);
					if($in_hodate < $hfast)	$hfast = $in_hodate;

				}else{
					$in_hodate = '';

				}



				if($in_ftpcapa || $in_ftptype || $in_ftpprice || $in_ftpid || $in_ftppwd || $in_hocom || $in_hoid || $in_hopwd || $in_hodate){
					$sql = "insert into wo_ing01_host (pid,ftpstate,ftptype,ftpid,ftppwd,hocom,hodate,hoid,hopwd,ftpcapa,ftpprice) values ('$uid','$in_ftpstate','$in_ftptype','$in_ftpid','$in_ftppwd','$in_hocom','$in_hodate','$in_hoid','$in_hopwd','$in_ftpcapa','$in_ftpprice')";
					$result = mysql_query($sql);
				}


			}

			if($hfast == '9999999999')	$hfast = '';



			//에이젼시현황 테이블에 만료일이 가장빠른 날을 저장한다.
			$sql = "update wo_ing01 set host_date='$hfast' where uid='$uid'";
			$result = mysql_query($sql);






			$class = '';

/************************************************* /수정 **********************************************************/			
			
		}

		break;


















/************************************************* 삭제 **********************************************************/

	case 'del' :

		$sql = "select sort from wo_ing01 where uid=$uid";
		$result = mysql_query($sql);
		$sort = mysql_result($result,0,0);

		//삭제하는 순위보다 높은순위를 한단계씩 감소시킨다.
		$sql = "select * from wo_ing01 where sort > $sort order by sort asc";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);


		for($i=0; $i<$num; $i++){
			$row = mysql_fetch_array($result);
			$set_uid = $row['uid'];
			$set_sort = $row['sort'];
			$set_sort -= 1;

			mysql_query("update wo_ing01 set sort=$set_sort where uid=$set_uid");
		}


		$sql = "select * from wo_ing01 where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for($i=1; $i<=$tot_num; $i++){
			$file_num = sprintf("%02d",$i);
			$del_file = $row["userfile".$file_num];

			if($del_file){
				unlink($UPLOAD_DIR."/".$del_file);
			}
		}




		$sql = "delete from wo_ing01 where uid=$uid";
		$result = mysql_query($sql);







		//등록된 내용 삭제
		$sql = "delete from wo_ing01_ment where pid=$uid";
		$result = mysql_query($sql);





		//등록된 도메인 삭제
		$sql = "delete from wo_ing01_domain where pid='$uid'";
		$result = mysql_query($sql);






		//등록된 호스팅정보 삭제
		$sql = "delete from wo_ing01_host where pid='$uid'";
		$result = mysql_query($sql);






		$class = 'goMsg';
		$msg = '삭제되었습니다';	

		break;


/************************************************* /삭제 **********************************************************/







	case 'info_del' :

		//등록된 내용 삭제
		$sql = "delete from wo_ing01_ment where uid=$mid";
		$result = mysql_query($sql);

		$class = '';

		break;






	case 'domain_del' :

		//해당 도메인정보 삭제
		$sql = "delete from wo_ing01_domain where uid=$did";
		$result = mysql_query($sql);

		$class = '';

		break;





	case 'host_del' :

		//해당 도메인정보 삭제
		$sql = "delete from wo_ing01_host where uid=$did";
		$result = mysql_query($sql);

		$class = '';

		break;






/************************************************* 계약완료 **********************************************************/


	case 'end' :

		$sql = "select * from wo_ing01 where uid=$uid";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$sort = $row["sort"];
		$userid = $row["userid"];
		$name = $row["name"];
		$company = $row["company"];
		$upjong = $row["upjong"];
		$person = $row["person"];
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
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		$email = $row["email"];
		$fax01 = $row["fax01"];
		$fax02 = $row["fax02"];
		$fax03 = $row["fax03"];
		$site_name = $row["site_name"];
		$re_name = $row["re_name"];
		$cdate01 = $row["cdate01"];
		$cdate02 = $row["cdate02"];
		$cdate03 = $row["cdate03"];
		$ctime = $row["ctime"];

		//에이젼시현황 테이블에 같은정보를 저장한다..
		//파일복사
		if($userfile01){
			$file_path = './upfile/';
			$copy_file = copy($file_path.$userfile01, '../ing02/upfile/'.$userfile01);

			//기존파일삭제
			unlink($UPLOAD_DIR."/".$userfile01);
			
		}

		//순번가져오기
		$sql = "select max(sort) from wo_ing02 where playing!='완료'";
		$result = mysql_query($sql);
		$max = mysql_result($result,0,0);

		if($max)	$max = $max + 1;
		else	$max = '1';

		$reg_date = mktime();

		$sql = "insert into wo_ing02  (sort,userid,name,company,upjong,person,staff,status,tel01,tel02,tel03,hp01,hp02,hp03,date01,edate01,edate02,edate03,price01,price02,price03,vat,domain,domain_com,domain_id,domain_pwd,site_id,site_pwd,domain_date,host_date,playing,ment ,reg_date,userfile01,realfile01,email,fax01,fax02,fax03,site_name,re_name,cdate01,cdate02,cdate03,ctime) values ";
		$sql .= "('$max','$userid','$name','$company','$upjong','$person','$staff','$status','$tel01','$tel02','$tel03','$hp01','$hp02','$hp03','$date01','$edate01','$edate02','$edate03','$price01','$price02','$price03','$vat','$domain','$domain_com','$domain_id','$domain_pwd','$site_id','$site_pwd','$domain_date','$host_date','$playing','$ment ','$reg_date','$userfile01','$realfile01','$email','$fax01','$fax02','$fax03','$site_name','$re_name','$cdate01','$cdate02','$cdate03','$ctime')";
		$result = mysql_query($sql);











		//내용등록관련

		//위에서 등록한 에이젼시현황의 uid값을 가져온다.
		$sql = "select uid from wo_ing02 where reg_date='$reg_date' order by uid desc limit 1";
		$result = mysql_query($sql);
		$pid = mysql_result($result,0,0);


		//영업현황에 등록된 내용db를 가져온다.
		$sql = "select * from wo_ing01_ment where pid='$uid' order by uid asc";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		for($i=0; $i<$num; $i++){
			$info = mysql_fetch_array($result);
			$info_reg_date = $info['reg_date'];
			$info_ment = $info['ment'];
			$info_cost = $info['cost'];
			$info_cost_vat = $info['cost_vat'];
			$info_deposit = $info['deposit'];
			$info_deposit_date = $info['deposit_date'];

			$qu01 = "insert into wo_ing02_ment (pid,reg_date,ment,cost,cost_vat,deposit,deposit_date) values ('$pid','$info_reg_date','$info_ment','$info_cost','$info_cost_vat','$info_deposit','$info_deposit_date')";
			$qu02 = mysql_query($qu01);

		}


		//영업현황에 등록된 내용db를 삭제한다.
		$sql = "delete from wo_ing01_ment where pid='$uid'";
		$result = mysql_query($sql);












		//영업현황에 등록된 도메인db를 가져온다.
		$sql = "select * from wo_ing01_domain where pid='$uid' order by uid asc";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		for($i=0; $i<$num; $i++){
			$info = mysql_fetch_array($result);
			$info_doname = $info['doname'];
			$info_docom = $info['docom'];
			$info_dodate = $info['dodate'];
			$info_doid = $info['doid'];
			$info_dopwd = $info['dopwd'];

			$qu01 = "insert into wo_ing02_domain (pid,doname,docom,dodate,doid,dopwd) values ('$pid','$info_doname','$info_docom','$info_dodate','$info_doid','$info_dopwd')";
			$qu02 = mysql_query($qu01);
		}


		//영업현황에 등록된 도메인db를 삭제한다.
		$sql = "delete from wo_ing01_domain where pid='$uid'";
		$result = mysql_query($sql);










		//영업현황에 등록된 호스팅db를 가져온다.
		$sql = "select * from wo_ing01_host where pid='$uid' order by uid asc";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		for($i=0; $i<$num; $i++){
			$info = mysql_fetch_array($result);
			$info_ftpstate = $info['ftpstate'];
			$info_ftptype = $info['ftptype'];
			$info_ftpcapa = $info['ftpcapa'];
			$info_ftpprice = $info['ftpprice'];
			$info_ftpid = $info['ftpid'];
			$info_ftppwd = $info['ftppwd'];
			$info_hocom = $info['hocom'];
			$info_hodate = $info['hodate'];
			$info_hoid = $info['hoid'];
			$info_hopwd = $info['hopwd'];

			$qu01 = "insert into wo_ing02_host (pid,ftpstate,ftptype,ftpid,ftppwd,hocom,hodate,hoid,hopwd,ftpcapa,ftpprice) values ('$pid','$info_ftpstate','$info_ftptype','$info_ftpid','$info_ftppwd','$info_hocom','$info_hodate','$info_hoid','$info_hopwd','$info_ftpcapa','$info_ftpprice')";
			$qu02 = mysql_query($qu01);
		}


		//영업현황에 등록된 호스팅db를 삭제한다.
		$sql = "delete from wo_ing01_host where pid='$uid'";
		$result = mysql_query($sql);













		//완료처리하는 순위보다 높은순위를 한단계씩 감소시킨다.
		$sql = "select * from wo_ing01 where sort > $sort order by sort asc";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);


		for($i=0; $i<$num; $i++){
			$row = mysql_fetch_array($result);
			$set_uid = $row['uid'];
			$set_sort = $row['sort'];
			$set_sort -= 1;

			mysql_query("update wo_ing01 set sort=$set_sort where uid=$set_uid");
		}




		$sql = "delete from wo_ing01 where uid=$uid";
		$result = mysql_query($sql);

		$class = 'goMsg';
		$msg = '처리되었습니다';	

		break;


/************************************************* /계약완료 **********************************************************/

}


unset($objProc);
unset($dbconn);





if($class == 'goMsg'){
	Msg::goMsg($msg,$next_url);


}else{
?>




<form name='frm' method='post' action='up_index.php'>
<input type='hidden' name='type' value='edit'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>


<input type='hidden' name='f_company' value='<?=$f_company?>'>
<input type='hidden' name='f_person' value='<?=$f_person?>'>
<input type='hidden' name='f_email' value='<?=$f_email?>'>
<input type='hidden' name='f_fax' value='<?=$f_fax?>'>
<input type='hidden' name='f_tel' value='<?=$f_tel?>'>
<input type='hidden' name='f_hp' value='<?=$f_hp?>'>
<input type='hidden' name='f_site_name' value='<?=$f_site_name?>'>
<input type='hidden' name='f_domain' value='<?=$f_domain?>'>
</form>

<script language='javascript'>
	document.frm.submit();
</script>


<?
}
?>