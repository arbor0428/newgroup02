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


error_reporting(E_ALL);
ini_set("display_errors", 1);


if($userid){
	$userid = $_POST['userid'];
	$bookmark01 = $_POST['bookmark01'];
	$bookmark02 = $_POST['bookmark02'];
	$bookmark03 = $_POST['bookmark03'];
	$bookmark04 = $_POST['bookmark04'];

	$bookmark05 = $_POST['bookmark05'];
	$bookmark06 = $_POST['bookmark06'];
	$bookmark07 = $_POST['bookmark07'];
	$bookmark08 = $_POST['bookmark08'];

	$sql = "select userid from book_mark where userid = '$userid' ";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	if($num > 0) {
		$sql = "update book_mark set  book_mark01 = '$bookmark01' ,book_mark02 ='$bookmark02' , book_mark03 ='$bookmark03' , book_mark04 ='$bookmark04' ,
		book_mark05 = '$bookmark05' ,book_mark06 ='$bookmark06' , book_mark07 ='$bookmark07' , book_mark08 ='$bookmark08'  where userid = '$userid' ";

		$result = mysql_query($sql);
	}else {
		$sql = "insert into book_mark (userid, book_mark01, book_mark02, book_mark03, book_mark04, book_mark05, book_mark06, book_mark07, book_mark08) 
		values ('$userid', '$bookmark05' , '$bookmark06' , '$bookmark07' , '$bookmark08' )";

		$result = mysql_query($sql);

	}
	$msg='등록완료';
	$nextUrl='/new';
	goMsg($msg, $nextUrl );
}




?>