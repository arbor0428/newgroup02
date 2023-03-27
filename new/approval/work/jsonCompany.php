<?
	include "../../module/class/class.Msg.php";
	include "../../module/class/class.DbCon.php";

	error_reporting( E_ALL );
  ini_set( "display_errors", 1 );


	$company =  $_POST['company'];
	$company= iconv('utf-8','euc-kr',$company);
	$resArr = Array();
	

				


		$sql = "select * from wo_ing02 where company = '$company'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$encoded_rows = array_map('utf8_encode', $row);
		$status =$encoded_rows['status'];//구분		
		$cdate01 = $encoded_rows['cdate01'];//계약일자
		$cdate02 = $encoded_rows['cdate02'];//계약일자
		$cdate03 = $encoded_rows['cdate03'];//계약일자
		$edate01 = $encoded_rows['edate01'];//마감일자
		$edate02 = $encoded_rows['edate02'];//마감일자
		$edate03 = $encoded_rows['edate03'];//마감일자
	
		//echo json_encode($encoded_rows);

		$resArr['status'] =iconv('utf-8','euc-kr',$status); // 객체담기
		$resArr['cdate02'] = iconv('utf-8','euc-kr',$cdate02);
		$resArr['cdate03'] =iconv('utf-8','euc-kr',$cdate03);

		//$json = json_encode(preg_replace('/[\x00-\x1F\x7F]/u', '', $resArr), true);
		$json = json_encode($resArr);
		//$val = array(urlencode($json));
		//$output = json_encode($val);
		//echo urldecode($output)."\n";
		//$new_testArr = str_replace('\\/', '/', json_encode($json));
				
		echo iconv('utf-8','euc-kr',$json);
				
?>