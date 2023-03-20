<?
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Msg.php";



	if($type=='write'){

		$rArr = explode('-',$rDate);
		$rTime = mktime(0,0,0,$rArr[1],$rArr[2],$rArr[0]);

		$sql = "insert into wo_searchad (userid,name,phone01,phone02,phone03,email,homepage,naverID,naverPW,daumID,daumPW,manager,staff,ment,rTime,rDate) values ";
		$sql .= "('$userid','$name','$phone01','$phone02','$phone03','$email','$homepage','$naverID','$naverPW','$daumID','$daumPW','$manager','$staff','$ment','$rTime','$rDate')";
		$result = mysql_query($sql);
		$msg = '등록되었습니다';


		

	}elseif($type == 'edit'){

		$rArr = explode('-',$rDate);
		$rTime = mktime(0,0,0,$rArr[1],$rArr[2],$rArr[0]);

		$sql = "update wo_searchad set ";
		$sql .= "name='$name', ";
		$sql .= "phone01='$phone01', ";
		$sql .= "phone02='$phone02', ";
		$sql .= "phone03='$phone03', ";
		$sql .= "email='$email', ";
		$sql .= "homepage='$homepage', ";
		$sql .= "naverID='$naverID', ";
		$sql .= "naverPW='$naverPW', ";
		$sql .= "daumID='$daumID', ";
		$sql .= "daumPW='$daumPW', ";
		$sql .= "manager='$manager', ";
		$sql .= "staff='$staff', ";
		$sql .= "ment='$ment', ";
		$sql .= "rTime='$rTime', ";
		$sql .= "rDate='$rDate' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		$msg = '수정되었습니다';

		
		
	}elseif($type == 'del'){

		$sql = "delete from wo_searchad where uid=$uid";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';	


	}

	unset($dbconn);
?>


<form name='frm' method='post' action='up_index.php'>
<input type='hidden' name='type' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>
<input type='hidden' name='f_site' value='<?=$f_site?>'>
<input type='hidden' name='f_naverID' value='<?=$f_naverID?>'>
<input type='hidden' name='f_daumID' value='<?=$f_daumID?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>
</form>

<script language='javascript'>
	alert('<?=$msg?>');
	document.frm.submit();
</script>