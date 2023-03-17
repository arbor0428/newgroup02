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

	$siteName= $_POST['siteName'];	
	$url= $_POST['url'];	
	$id= $_POST['id'];	
	$pwd= $_POST['pwd'];	


	$sql = "select userid from site_set where userid = '$userid' ";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	switch($type) {
		case 'del':
			$sql = "delete from site_set where uid = '$uid'";
			$result = mysql_query($sql);

			$msg='삭제완료';
			$nextUrl='/new';
				
			goMsg($msg, $nextUrl );

			break;

		case 'write':
			$sql = "select userid from site_set where userid = '$userid' ";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			$sql = "insert into site_set (userid, siteName, url, id, pwd) 
			values ('$userid', '$siteName' , '$url' , '$id' , '$pwd' )";

			$result = mysql_query($sql);

			$msg='등록완료';
			$nextUrl='/new';

			goMsg($msg, $nextUrl );

			break;
	}
}




?>