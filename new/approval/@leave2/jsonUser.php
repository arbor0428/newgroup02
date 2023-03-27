<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	$userid = $_POST['userid'];
	$resArr = Array();

	if($userid){
		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$name = $row['name']; //이름
		$team = $row['team']; //소속
		$affil = $row['affil']; //직위
		$mobile = $row['mobile']; //연락처

	}

	$resArr['name'] = $name; // 객체담기
	$resArr['team'] = iconv ('euc-kr','utf-8',$team); //소속
	$resArr['affil'] = iconv ('euc-kr','utf-8',$affil); //직위
	$resArr['mobile'] = iconv ('euc-kr','utf-8',$mobile); // 연락처


	$json = json_encode($resArr);
	echo $json;
?>