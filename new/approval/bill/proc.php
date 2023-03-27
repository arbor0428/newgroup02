<?
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Msg.php";


switch($type){

	case 'write' :

		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		//$rArr = explode('-',$rDate);
		//$rTime = mktime(0,0,0,$rArr[1],$rArr[2],$rArr[0]);
		$rDate = date('Y'); // 현재날짜 년
		$rDate2 = date('m'); // 현재날짜 월
		$rDate3 = date('d'); // 현재날짜 일
		$userid = $row["userid"]; // $uid라는 변수가 DB행에 uid를 가져오는 것
		$name = $row["name"]; // 성명
		$securi = $row["securi"]; // 주민번호 앞자리
		$securi2 = $row["securi2"]; // 주민번호 뒷자리
		$zipcode = $row["zipcode"]; // 우편번호
		$addr01= $row["addr01"]; // 집주소1
		$addr02= $row["addr02"]; // 집주소2
		$affil = $row["affil"]; // 직위
		$idate01 = $row["idate01"]; // 입사일 년
		$idate02 = $row["idate02"]; // 입사일 월
		$idate03 = $row["idate03"]; // 입사일 일
		$team = $row["team"]; // 소속
 
		$sql = "select * from wo_setup where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result); 
		
		$phone = $row["phone"]; // 회사 대표번호
		$fax = $row["fax"]; // 회사 팩스번호
		$bank01 = $row["bank01"]; // 수취인 통장
		$actxt01 = $row["actxt01"]; // 회사명
		$account01 = $row["account01"]; // 법인계좌번호
		$cmp_num = $row["cmp_num"]; // 사업자 번호
		$cmp_adr = $row["cmp_adr"]; // 소재지
		$ceo_nm = $row["ceo_nm"]; // 대표이사 성함
		$i_mail = $row["i_mail"]; // 이메일
		$i_hpage = $row["i_hpage"]; // 홈페이지
		$i_ppage = $row["i_ppage"]; // 카드결제 사이트
		

		$sql = "select * from wo_proof where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$rDate = date('Y-m-d H:i:s');
		$rTime = time();
		$userip = $_SERVER['REMOTE_ADDR'];
		$status = "미승인";
		$sql = "insert wo_proof (uid,userid, name, puse) values ('$uid','$userid','$name','$puse')";
		


/*
		$sql	 = "insert into wo_proof  (userid,name,status,securi,securi2,zipcode,addr01,addr02,actxt01,cmp_num,cmp_adr,team,mname,idate01,idate02,idate03,rArr,puse,ceo_nm,affil,rDate,rDate2,rDate3) values ";
		$sql	.= "('$userid','$name','$status','$securi','$securi2','$zipcode','$addr01','$addr02','$actxt01','$cmp_num','$cmp_adr','$team','$mname','$idate01','$idate02','$idate03','$rArr','$puse','$ceo_nm','$affil','$rDate','$rDate2','$rDate3')";
*/
		$result = mysql_query($sql);
		$msg = '등록되었습니다';
		$type = 'list';
		
		break;

	case 'edit' :
		
		$rDate = date('Y'); // 현재날짜 년
		$rDate2 = date('m'); // 현재날짜 월
		$rDate3 = date('d'); // 현재날짜 일
		//$rArr = explode('-',$rDate);
		//$rTime = mktime(0,0,0,$rArr[1],$rArr[2],$rArr[0]);

		$sql = "update wo_proof set";
		$sql .= "userid = '$userid', "; // 유저아이디
		$sql .= "name = '$name', "; // 성명
		$sql .= "securi = '$securi', "; // 주민번호 앞자리
		$sql .= "securi2 = '$securi2', "; // 주민번호 뒷자리
		$sql .= "zipcode = '$zipcode', "; // 우편번호
		$sql .= "addr01 = '$addr01', "; // 집주소1
		$sql .= "addr02 = '$addr02', "; // 집주소2
		$sql .= "actxt01 ='$actxt01', "; // 회사명
		$sql .= "cmp_num = '$cmp_num', "; // 사업자번호
		$sql .= "cmp_adr = '$cmp_adr', "; // 소재지
		$sql .= "team = '$team', "; // 소속
		$sql .= "mname = '$mname', "; //
		$sql .= "idate01 = '$idate01', "; // 입사일 년
		$sql .= "idate02 = '$idate02', "; // 입사일 월
		$sql .= "idate03 = '$idate03', "; //입사일 일
		$sql .= "rArr = '$rArr', "; // 현재날짜
		$sql .= "puse = '$puse', "; // 사용용도
		$sql .= "ceo_nm = '$ceo_nm', "; // 대표이사 성함
		$sql .= "affil = '$affil' "; //  직위
		$sql .= " where name=$name";
		$result = mysql_query($sql);

		$msg = '수정되었습니다';
		$type = 'list';

		break;

	case 'del' :

		$sql = "delete from wo_proof where uid=$uid";
		$result = mysql_query($sql);
		$uid = $row['uid'];
		$msg = '삭제되었습니다';
		$type = 'list';

		break;

	case 'status' :

		$sql = "update wo_proof set ";
		$sql .= "status='승인' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);


		$msg = '승인되었습니다';
		$type = 'list';

		break;

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

<!-- <form name='frm' method='post' action='index.php'>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
	<input type='hidden' name='f_name' value='<?=$f_name?>'>
	<input type='hidden' name='f_securi' value='<?=$f_securi?>'>
	<input type='hidden' name='f_home_adr' value='<?=$f_home_adr?>'>
	<input type='hidden' name='f_cmp_nm' value='<?=$f_cmp_nm?>'>
	<input type='hidden' name='f_cmp_num' value='<?=$f_cmp_num?>'>
	<input type='hidden' name='f_cmp_adr' value='<?=$f_cmp_adr?>'>
	<input type='hidden' name='f_job' value='<?=$f_job?>'>
	<input type='hidden' name='f_affil' value='<?=$f_affil?>'>
	<input type='hidden' name='f_frm_date' value='<?=$f_frm_date?>'>
	<input type='hidden' name='f_now_date' value='<?=$f_now_date?>'>
	<input type='hidden' name='f_puse' value='<?=$f_puse?>'>
	<input type='hidden' name='type' value='<?=$type?>'>
</form> -->

<script language='javascript'>
	alert('<?=$msg?>');
	document.frm.submit();
</script>