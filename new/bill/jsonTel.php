<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	$userid = $_POST['userid'];
	$resArr = Array();

	if($userid){
		$sql = "select * from wo_tel where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$name = $row['name']; //이름
		$tel = $row['tel']; //연락처

	}



	$resArr['name'] = iconv ('euc-kr','utf-8',$name);// 객체담기
	$resArr['tel'] = iconv ('euc-kr','utf-8',$tel); // 연락처


	$json = json_encode($resArr);
	echo $json;
?>