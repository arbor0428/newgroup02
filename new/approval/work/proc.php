<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Msg.php";
	
	$type = $_POST['type'];

	switch($type){
		case 'write': 
			$uid = $_POST['uid'];
			//$num = $_POST['num'];
			$company = $_POST['company'];
			$name = $_POST['name'];
			$userid = $_POST['userid'];
			$ment = $_POST['ment'];
			$route = $_POST['route'];
			$money = $_POST['money'];
			$software = $_POST['sw'];
			$skin = $_POST['skin'];
			$date = $_POST['date'];



				$sql="select * from wo_ing02 where company = '$company' " ;
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				$status = $row['status'];//구분		
				$cdate01 = $row['cdate01'];//계약일자
				$cdate02 = $row['cdate02'];//계약일자
				$cdate03 = $row['cdate03'];//계약일자
				
				$sDate = $cdate01.$cdate02.$cdate03;
			

				


				$sql2 = "insert into week_work (userid, name, company, status, route, ment, money, software, skin, date, sDate ) 
				 values ('$userid', '$name', '$company', '$status', '$route', '$ment', '$money', '$software', '$skin', '$date', '$sDate')";
				
				$result2 = mysql_query($sql2);
				$row2 = mysql_fetch_array($result2);
			
				$url = '/approval/work/up_index.php';
				$msg = '등록되었습니다';
				break;
	
	} 

		Msg::goMsg($msg, $url);

?>