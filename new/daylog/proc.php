<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";
include "../module/class/class.Util.php";




switch($type){
	case 'write' :
	case 'edit' :



		if($type=='write'){

			$reg_date = mktime();

			for($i=0; $i<count($ment); $i++){

				if($ment[$i]){	//업무내용이 있을경우 저장
					$ment[$i] = Util::textareaEncodeing($ment[$i]);


					$sql = "insert into wo_daylog  (userid,name,db_y,db_m,db_d,s_h,s_m,e_h,e_m,ping,ment,reg_date) values ";
					$sql .= "('$userid','$name','$db_y','$db_m','$db_d','$s_h[$i]','$s_m[$i]','$e_h[$i]','$e_m[$i]','$ping[$i]','$ment[$i]','$reg_date')";
					$result = mysql_query($sql);


				}


			}

			$msg = '등록되었습니다';


		}else{
			$sql = "update wo_daylog set ";
			$sql .= "name='$name', ";
			$sql .= "title='$title', ";
			$sql .= "ment='$ment' ";

			$sql .= " where uid=$uid";
			$result = mysql_query($sql);

			$msg = '수정되었습니다';
			
		}

		break;


	case 'del' :

		$sql = "delete from wo_daylog where userid='$userid' and db_y='$s_year' and db_m='$s_month' and db_d='$s_day'";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';	

		break;

}


unset($objProc);
unset($dbconn);

Msg::goMsg($msg,$next_url);
?>
