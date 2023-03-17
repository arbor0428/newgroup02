<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Util.php";
include "../module/class/class.Msg.php";

function goMsg($msg, $url){
	echo "<script language=\"javascript\">";
	echo "	alert(\"" . $msg . "\");";
	echo "	location.href=\"" . $url . "\";";
	echo "</script>";
}


//error_reporting(E_ALL);
//ini_set("display_errors", 1);


if($userid){
	$userid = $_POST['userid'];

	$phoneName= $_POST['phoneName'];	
	$phoneNum= $_POST['phoneNum'];	


	$sql = "select userid from main_phone where userid = '$userid' ";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	switch($type) {
		case 'del':
			$sql = "delete from main_phone where uid = '$uid'";
			$result = mysql_query($sql);

			$msg='삭제완료';
			$nextUrl='/new';
				
			goMsg($msg, $nextUrl );

			break;

		case 'write':
			$sql = "select userid from main_phone where userid = '$userid' ";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			$sql = "insert into main_phone (userid, phoneName, phoneNum) 
			values ('$userid', '$phoneName' , '$phoneNum')";

			$result = mysql_query($sql);

			$msg='등록완료';
			$nextUrl='/new';

			goMsg($msg, $nextUrl );

			break;
	}
}




?>