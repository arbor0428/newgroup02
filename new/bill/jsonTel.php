<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	$userid = $_POST['userid'];
	$resArr = Array();

	if($userid){
		$sql = "select * from wo_tel where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$name = $row['name']; //�̸�
		$tel = $row['tel']; //����ó

	}



	$resArr['name'] = iconv ('euc-kr','utf-8',$name);// ��ü���
	$resArr['tel'] = iconv ('euc-kr','utf-8',$tel); // ����ó


	$json = json_encode($resArr);
	echo $json;
?>