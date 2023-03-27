<?
	include "../../../module/class/class.DbCon.php";
	include "../../../module/class/class.Util.php";

	$userid = $_POST['userid'];
	$resArr = Array();

	if($userid){
		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$name = $row['name'];
		$securi = $row['securi'];
		$securi2 = $row['securi2'];
		$zipcode = $row['zipcode'];
		$addr01 = $row['addr01'];
		$addr02 = $row['addr02'];
		$team = $row['team'];
		$affil = $row['affil'];
		$idate01 = $row['idate01'];
		$idate02 = $row['idate02'];
		$idate03 = $row['idate03'];
		$pdate01 = $row['pdate01'];
		$pdate02 = $row['pdate02'];
		$pdate03 = $row['pdate03'];
	}

	$resArr['name'] = iconv('euc-kr','utf-8',$name);; // 객체담기
	$resArr['securi'] = $securi;
	$resArr['securi2'] = $securi2;
	$resArr['zipcode'] = $zipcode;
	$resArr['addr01'] = iconv('euc-kr','utf-8',$addr01);
	$resArr['addr02'] = iconv ('euc-kr','utf-8',$addr02);
	$resArr['team'] = iconv ('euc-kr','utf-8',$team);
	$resArr['affil'] = iconv ('euc-kr','utf-8',$affil);
	$resArr['idate01'] = $idate01;
	$resArr['idate02'] = $idate02;
	$resArr['idate03'] = $idate03;
	$resArr['pdate01'] = $pdate01;
	$resArr['pdate02'] = $pdate02;
	$resArr['pdate03'] = $pdate03;
	



	$json = json_encode($resArr);
	echo $json;
?>