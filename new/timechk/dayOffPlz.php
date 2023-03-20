<?
include '../module/class/class.DbCon.php';

if($f_userid){

	if($type == 'write'){
		//조회일자기준 연차내역 초기화
		$sql = "delete from wo_dayoff_plz where userid='$f_userid' and rTime>=$sTime and rTime<=$eTime";
		$result = mysql_query($sql);

		for($i=0; $i<count($chk); $i++){
			$rTime = $chk[$i];
			$rYoil = date('w',$rTime);
			$rDate = date('Y-m-d',$rTime);

			$sql02 = "insert into wo_dayoff_plz (userid,rYoil,rDate,rTime) values ('$f_userid','$rYoil','$rDate','$rTime')";
			$result02 = mysql_query($sql02);
		}


	} elseif($type == 'no'){
		//신청내역삭제
		$sql = "delete from wo_dayoff_plz where userid='$f_userid' and rTime='$uid'";
		$result = mysql_query($sql);

	}
}
?>


<form name='frm' method='post' action='up_index.php'>
<input type='hidden' name='f_year' value='<?= $f_year ?>'>
<input type='hidden' name='f_month' value='<?= $f_month ?>'>
<input type='hidden' name='f_userid' value='<?= $f_userid ?>'>
</form>

<script language='javascript'>
document.frm.submit();
</script>