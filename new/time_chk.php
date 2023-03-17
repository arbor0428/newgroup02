<?
	include '../head.php';
	include "../module/class/class.Msg.php";
	include "../module/class/class.DbCon.php";
	include "../module/Mobile-Detect-master/Mobile_Detect.php";

	$detect = new Mobile_Detect;

	$UserOS = '';
	if($detect->isMobile()){
		$UserOS = "mobile";
	}

	$userid = $GBL_USERID;

	$user_ip = $_SERVER['REMOTE_ADDR'];


	$sql = "select * from wo_setup order by uid desc limit 1";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$row = mysql_fetch_array($result);
		$chktime01 = $row['time01'];
		$chktime02 = $row['time02'];
	}else{
		$chktime01 = '9';	//출근시간(시)
		$chktime02 = '0';	//출근시간(분)
	}


	if($mtype == 'in')	$txt01 = '출근';
	else	$txt01 = '퇴근';

	$to_y = date('Y');
	$to_m = date('m');
	$to_d = date('d');
	$to_w = date('w');

	if($to_w == '0')	$to_w = '일';
	elseif($to_w == '1')	$to_w = '월';
	elseif($to_w == '2')	$to_w = '화';
	elseif($to_w == '3')	$to_w = '수';
	elseif($to_w == '4')	$to_w = '목';
	elseif($to_w == '5')	$to_w = '금';
	elseif($to_w == '6')	$to_w = '토';


	


	$sql = "select * from wo_timechk where userid='$userid' and to_y='$to_y' and to_m='$to_m' and to_d='$to_d'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);





if($mtype == 'in'){	//출근일 경우

	if($num){
		$row = mysql_fetch_array($result);
		$reg_date = $row['reg_date'];
		$reg_date = date('Y-m-d H:i');

		$msg = '이미 출근 처리 되었습니다. 출근시간 ['.$reg_date.']';
		Msg::goMsg($msg);
		exit;

	}else{
		$in_date = mktime($chktime01,$chktime02,0,$to_m,$to_d,$to_y);
		$reg_date = mktime();
		$reg_date_msg = date('Y-m-d H:i');
		$rTime = mktime(0,0,0,$to_m,$to_d,$to_y);


		if($reg_date > $in_date)	$state = '지각';
		else	$state = '-';		


		$sql = "insert into wo_timechk (userid,to_y,to_m,to_d,to_w,state,in_date,in_ip,reg_date,rTime,in_device) values ('$userid','$to_y','$to_m','$to_d','$to_w','$state','$reg_date','$user_ip','$reg_date','$rTime','$UserOS')";
		$result = mysql_query($sql);

		

		if($state == '-'){
			$msg = '정상적으로 '.$txt01.' 처리 되었습니다. '.$txt01.'시간 ['.$reg_date_msg.']';
			Msg::goMsgReload($msg);
			exit;

		}else{	//지각일 경우 지각사유 팝업창을 띄운다.


			echo ("
				<script language='javascript'>
					var w = '120';
					var h = '150';
					var left = (screen.width)?(screen.width-w)/2:100;
					var top = (screen.height)?(screen.height-h)/2:100;					

					var TimeWindow = window.open('time_msg.php?reg_date=$reg_date&userid=$userid','time_msg','width='+w+', height='+h+', left='+left+', top='+top+',scrollbars=no,toolbar=no,status=no');

					if(TimeWindow == null ){
						alert('팝업 차단기능 혹은 팝업차단 프로그램이 동작중입니다.');
					}
				</script>");

			exit;
		}

	}





}else{	//퇴근일 경우
	$reg_date = mktime();

	if($num){
		$row = mysql_fetch_array($result);
		$uid = $row['uid'];
		$reg_date_msg = date('Y-m-d H:i');

		$sql = "update wo_timechk set out_date='$reg_date',out_ip='$user_ip',out_device='$UserOS' where uid='$uid'";
		$result = mysql_query($sql);

		$msg = '정상적으로 퇴근 처리 되었습니다. 퇴근시간 ['.$reg_date_msg.']';
		Msg::goMsgReload($msg);
		exit;

	}else{
		$sql = "insert into wo_timechk (userid,to_y,to_m,to_d,to_w,out_date,out_ip,reg_date,out_device) values ('$userid','$to_y','$to_m','$to_d','$to_w','$reg_date','$user_ip','$reg_date','$UserOS')";
		$result = mysql_query($sql);
	}

}
?>
