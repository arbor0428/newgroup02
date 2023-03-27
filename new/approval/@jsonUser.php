<?
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Util.php";

	$userid = $_POST['userid'];
	$resArr = Array();

	if($userid){
		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$name = urlencode($row['name']);
		$securi = urlencode($row['securi']);
		$securi2 = urlencode($row['securi2']);
		$zipcode = urlencode($row['zipcode']);
		$addr01 = $row['addr01'];
		$addr02 = $row['addr02'];
		$team = $row['team'];
		$team = $row['affil'];
		$idate01 = $row['idate01'];
		$idate02 = $row['idate02'];
		$idate03 = $row['idate03'];
	}

	$resArr['name'] = $name; // °´Ã¼´ã±â
	$resArr['securi'] = $securi;
	$resArr['securi2'] = $securi2;
	$resArr['zipcode'] = $zipcode;
	$resArr['addr01'] = $addr01;
	$resArr['addr02'] = $addr02;
	$resArr['team'] = $team;
	$resArr['affil'] = $affil;
	$resArr['idate01'] = $idate01;
	$resArr['idate02'] = $idate02;
	$resArr['idate03'] = $idate03;

	$json = json_encode($resArr);
	echo $json;
?>