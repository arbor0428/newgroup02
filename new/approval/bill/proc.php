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
		$rDate = date('Y'); // ���糯¥ ��
		$rDate2 = date('m'); // ���糯¥ ��
		$rDate3 = date('d'); // ���糯¥ ��
		$userid = $row["userid"]; // $uid��� ������ DB�࿡ uid�� �������� ��
		$name = $row["name"]; // ����
		$securi = $row["securi"]; // �ֹι�ȣ ���ڸ�
		$securi2 = $row["securi2"]; // �ֹι�ȣ ���ڸ�
		$zipcode = $row["zipcode"]; // �����ȣ
		$addr01= $row["addr01"]; // ���ּ�1
		$addr02= $row["addr02"]; // ���ּ�2
		$affil = $row["affil"]; // ����
		$idate01 = $row["idate01"]; // �Ի��� ��
		$idate02 = $row["idate02"]; // �Ի��� ��
		$idate03 = $row["idate03"]; // �Ի��� ��
		$team = $row["team"]; // �Ҽ�
 
		$sql = "select * from wo_setup where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result); 
		
		$phone = $row["phone"]; // ȸ�� ��ǥ��ȣ
		$fax = $row["fax"]; // ȸ�� �ѽ���ȣ
		$bank01 = $row["bank01"]; // ������ ����
		$actxt01 = $row["actxt01"]; // ȸ���
		$account01 = $row["account01"]; // ���ΰ��¹�ȣ
		$cmp_num = $row["cmp_num"]; // ����� ��ȣ
		$cmp_adr = $row["cmp_adr"]; // ������
		$ceo_nm = $row["ceo_nm"]; // ��ǥ�̻� ����
		$i_mail = $row["i_mail"]; // �̸���
		$i_hpage = $row["i_hpage"]; // Ȩ������
		$i_ppage = $row["i_ppage"]; // ī����� ����Ʈ
		

		$sql = "select * from wo_proof where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$rDate = date('Y-m-d H:i:s');
		$rTime = time();
		$userip = $_SERVER['REMOTE_ADDR'];
		$status = "�̽���";
		$sql = "insert wo_proof (uid,userid, name, puse) values ('$uid','$userid','$name','$puse')";
		


/*
		$sql	 = "insert into wo_proof  (userid,name,status,securi,securi2,zipcode,addr01,addr02,actxt01,cmp_num,cmp_adr,team,mname,idate01,idate02,idate03,rArr,puse,ceo_nm,affil,rDate,rDate2,rDate3) values ";
		$sql	.= "('$userid','$name','$status','$securi','$securi2','$zipcode','$addr01','$addr02','$actxt01','$cmp_num','$cmp_adr','$team','$mname','$idate01','$idate02','$idate03','$rArr','$puse','$ceo_nm','$affil','$rDate','$rDate2','$rDate3')";
*/
		$result = mysql_query($sql);
		$msg = '��ϵǾ����ϴ�';
		$type = 'list';
		
		break;

	case 'edit' :
		
		$rDate = date('Y'); // ���糯¥ ��
		$rDate2 = date('m'); // ���糯¥ ��
		$rDate3 = date('d'); // ���糯¥ ��
		//$rArr = explode('-',$rDate);
		//$rTime = mktime(0,0,0,$rArr[1],$rArr[2],$rArr[0]);

		$sql = "update wo_proof set";
		$sql .= "userid = '$userid', "; // �������̵�
		$sql .= "name = '$name', "; // ����
		$sql .= "securi = '$securi', "; // �ֹι�ȣ ���ڸ�
		$sql .= "securi2 = '$securi2', "; // �ֹι�ȣ ���ڸ�
		$sql .= "zipcode = '$zipcode', "; // �����ȣ
		$sql .= "addr01 = '$addr01', "; // ���ּ�1
		$sql .= "addr02 = '$addr02', "; // ���ּ�2
		$sql .= "actxt01 ='$actxt01', "; // ȸ���
		$sql .= "cmp_num = '$cmp_num', "; // ����ڹ�ȣ
		$sql .= "cmp_adr = '$cmp_adr', "; // ������
		$sql .= "team = '$team', "; // �Ҽ�
		$sql .= "mname = '$mname', "; //
		$sql .= "idate01 = '$idate01', "; // �Ի��� ��
		$sql .= "idate02 = '$idate02', "; // �Ի��� ��
		$sql .= "idate03 = '$idate03', "; //�Ի��� ��
		$sql .= "rArr = '$rArr', "; // ���糯¥
		$sql .= "puse = '$puse', "; // ���뵵
		$sql .= "ceo_nm = '$ceo_nm', "; // ��ǥ�̻� ����
		$sql .= "affil = '$affil' "; //  ����
		$sql .= " where name=$name";
		$result = mysql_query($sql);

		$msg = '�����Ǿ����ϴ�';
		$type = 'list';

		break;

	case 'del' :

		$sql = "delete from wo_proof where uid=$uid";
		$result = mysql_query($sql);
		$uid = $row['uid'];
		$msg = '�����Ǿ����ϴ�';
		$type = 'list';

		break;

	case 'status' :

		$sql = "update wo_proof set ";
		$sql .= "status='����' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);


		$msg = '���εǾ����ϴ�';
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