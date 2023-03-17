<?
include '../module/class/class.DbCon.php';



for($i=0; $i<count($chk); $i++){
	$uid = $chk[$i];

	//신청내역삭제
	if($type == 'no'){		
		$sql = "delete from wo_dayoff_plz where uid='$uid'";
		$result = mysql_query($sql);

	//연차승인
	}elseif($type == 'ok'){
		$sql = "select * from wo_dayoff_plz where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row['userid'];
		$rTime = $row['rTime'];
		$rYoil = date('w',$rTime);
		$rDate = date('Y-m-d',$rTime);

		$sql = "insert into wo_dayoff (userid,rYoil,rDate,rTime) values ('$userid','$rYoil','$rDate','$rTime')";
		$result = mysql_query($sql);

		//신청내역삭제
		$sql = "delete from wo_dayoff_plz where uid='$uid'";
		$result = mysql_query($sql);
	}
}
?>


<script language='javascript'>
parent.set_search();
</script>