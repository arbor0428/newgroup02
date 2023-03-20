<?
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Msg.php";



	if($type=='write'){

		$rTime = mktime(0,0,0,$rm,$rd,$ry);
		$rDate = $ry.'-'.$rm.'-'.$rd;


		$sql = "insert into wo_lgu (userid,mtype,status,name,cnum,ceo,zip01,zip02,addr01,addr02,phone01,phone02,phone03,mobile01,mobile02,mobile03,email,pname,pday,ptype,pmode,pemail,pzip01,pzip02,paddr01,paddr02,pbank,paccount,pend,ment,rTime,rDate,staff,service01,service02,service03,service04,service05,service06,pnum) values ";
		$sql .= "('$userid','$mtype','$status','$name','$cnum','$ceo','$zip01','$zip02','$addr01','$addr02','$phone01','$phone02','$phone03','$mobile01','$mobile02','$mobile03','$email','$pname','$pday','$ptype','$pmode','$pemail','$pzip01','$pzip02','$paddr01','$paddr02','$pbank','$paccount','$pend','$ment','$rTime','$rDate','$staff','$service01','$service02','$service03','$service04','$service05','$service06','$pnum')";
		$result = mysql_query($sql);
		$msg = '등록되었습니다';


		

	}elseif($type == 'edit'){

		$rTime = mktime(0,0,0,$rm,$rd,$ry);
		$rDate = $ry.'-'.$rm.'-'.$rd;

		$sql = "update wo_lgu set ";
		$sql .= "mtype='$mtype', ";
		$sql .= "status='$status', ";
		$sql .= "name='$name', ";
		$sql .= "cnum='$cnum', ";
		$sql .= "ceo='$ceo', ";
		$sql .= "zip01='$zip01', ";
		$sql .= "zip02='$zip02', ";
		$sql .= "addr01='$addr01', ";
		$sql .= "addr02='$addr02', ";
		$sql .= "phone01='$phone01', ";
		$sql .= "phone02='$phone02', ";
		$sql .= "phone03='$phone03', ";
		$sql .= "mobile01='$mobile01', ";
		$sql .= "mobile02='$mobile02', ";
		$sql .= "mobile03='$mobile03', ";
		$sql .= "email='$email', ";
		$sql .= "pname='$pname', ";
		$sql .= "pday='$pday', ";
		$sql .= "ptype='$ptype', ";
		$sql .= "pmode='$pmode', ";
		$sql .= "pemail='$pemail', ";
		$sql .= "pzip01='$pzip01', ";
		$sql .= "pzip02='$pzip02', ";
		$sql .= "paddr01='$paddr01', ";
		$sql .= "paddr02='$paddr02', ";
		$sql .= "pbank='$pbank', ";
		$sql .= "paccount='$paccount', ";
		$sql .= "pend='$pend', ";		
		$sql .= "ment='$ment', ";
		$sql .= "rTime='$rTime', ";
		$sql .= "rDate='$rDate', ";
		$sql .= "staff='$staff', ";
		$sql .= "service01='$service01', ";
		$sql .= "service02='$service02', ";
		$sql .= "service03='$service03', ";
		$sql .= "service04='$service04', ";
		$sql .= "service05='$service05', ";
		$sql .= "service06='$service06', ";
		$sql .= "pnum='$pnum' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		$msg = '수정되었습니다';

		
		
	}elseif($type == 'del'){

		$sql = "delete from wo_lgu where uid=$uid";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';	


	}

	unset($dbconn);
?>


<form name='frm' method='post' action='up_index.php'>
<input type='hidden' name='type' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='f_mtype' value='<?=$f_mtype?>'>
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_ceo' value='<?=$f_ceo?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_service01' value='<?=$f_service01?>'>
<input type='hidden' name='f_service02' value='<?=$f_service02?>'>
<input type='hidden' name='f_service03' value='<?=$f_service03?>'>
<input type='hidden' name='f_service04' value='<?=$f_service04?>'>
<input type='hidden' name='f_service05' value='<?=$f_service05?>'>
<input type='hidden' name='f_service06' value='<?=$f_service06?>'>
<input type='hidden' name='f_pnum' value='<?=$f_pnum?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sy' value='<?=$f_sy?>'>
<input type='hidden' name='f_sm' value='<?=$f_sm?>'>
<input type='hidden' name='f_sd' value='<?=$f_sd?>'>
<input type='hidden' name='f_ey' value='<?=$f_ey?>'>
<input type='hidden' name='f_em' value='<?=$f_em?>'>
<input type='hidden' name='f_ed' value='<?=$f_ed?>'>
</form>

<script language='javascript'>
	alert('<?=$msg?>');
	document.frm.submit();
</script>