<?
	include "../module/class/class.Msg.php";
	include "../module/class/class.DbCon.php";
	include "../array.php";
?>
<script language='javascript' src='/module/js/common.js'></script>
<link type='text/css' rel='stylesheet' href='/css/style.css'>
<style type='text/css'>
BODY{background:none !important;}
</style>
<?

	if($uid){

		$sql = "select * from wo_ing02 where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$sort = $row["sort"];
		$name = $row["name"];
		$company = $row["company"];
		$host_id = $row["host_id"];
		$host_pwd = $row["host_pwd"];
		$upjong = $row["upjong"];
		$person = $row["person"];
		$staff = $row["staff"];
		$status = $row["status"];
		$mobile = $row["mobile"];
		$tel01 = $row["tel01"];
		$tel02 = $row["tel02"];
		$tel03 = $row["tel03"];
		$hp01 = $row["hp01"];
		$hp02 = $row["hp02"];
		$hp03 = $row["hp03"];
		$date01 = $row["date01"];
		$edate01 = $row["edate01"];
		$edate02 = $row["edate02"];
		$edate03 = $row["edate03"];
		$price01 = $row["price01"];
		$price02 = $row["price02"];
		$price02_1 = $row["price02_1"];
		$price03 = $row["price03"];
		$price02_date = $row['price02_date'];
		$price02_1_date = $row["price02_1_date"];
		$vat = $row["vat"];
		$domain = $row["domain"];
		$domain_com = $row["domain_com"];
		$domain_id = $row["domain_id"];
		$domain_pwd = $row["domain_pwd"];
		$site_id = $row["site_id"];
		$site_pwd = $row["site_pwd"];
		$domain_date = $row["domain_date"];
		$host_date = $row["host_date"];
		$virtualhost = $row["virtualhost"];
		$playing = $row["playing"];
		$ment = $row["ment"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];
		$ending = $row["ending"];

		$email = $row["email"];
		$fax01 = $row["fax01"];
		$fax02 = $row["fax02"];
		$fax03 = $row["fax03"];
		$site_name = $row["site_name"];
		$re_name = $row["re_name"];
		$cdate01 = $row["cdate01"];
		$cdate02 = $row["cdate02"];
		$cdate03 = $row["cdate03"];
		$reg_date = $row["reg_date"];

		if(!$cdate01)	$cdate01 = date('Y',$reg_date);
		if(!$cdate02)	$cdate02 = date('m',$reg_date);
		if(!$cdate03)	$cdate03 = date('d',$reg_date);

		//�����θ�������
		if($domain_date){
			$d_yy = date('Y',$domain_date);
			$d_mm = date('m',$domain_date);
			$d_dd = date('d',$domain_date);

		}else{
			$d_yy = '';
			$d_mm = '';
			$d_dd = '';

		}

		//ȣ���ø�������
		if($host_date){
			$h_yy = date('Y',$host_date);
			$h_mm = date('m',$host_date);
			$h_dd = date('d',$host_date);

		}else{
			$h_yy = '';
			$h_mm = '';
			$h_dd = '';

		}

	}

	if(!$playing)	 	$playing = '����';

	if(!$price01)	$price01 = '0';
	if(!$price02)	$price02 = '0';
	if(!$price03)	$price03 = '0';

	if(!$userid)	$userid = $GBL_USERID;
	if(!$name)	$name = $GBL_NAME;




?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>




function check_form(cc){
	form = document.FRM;

	act = 'proc.php';

/*
	chk01 = form.d_yy.selectedIndex;
	chk02 = form.d_mm.selectedIndex;
	chk03 = form.d_dd.selectedIndex;

	chk04 = form.h_yy.selectedIndex;
	chk05 = form.h_mm.selectedIndex;
	chk06 = form.h_dd.selectedIndex;
*/
	playing = form.playing.value;	//�����

	
	if(isFrmEmpty(form.name,"����ڸ� �Է��� �ֽʽÿ�"))	return;
/*
	if(chk01 || chk02 || chk03){
		if(isFrmEmpty(form.d_yy,"������ �������ڸ� ������ �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.d_mm,"������ �������ڸ� ������ �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.d_dd,"������ �������ڸ� ������ �ֽʽÿ�"))	return;
	}

	if(chk04 || chk05 || chk06){
		if(isFrmEmpty(form.h_yy,"ȣ���� �������ڸ� ������ �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.h_mm,"ȣ���� �������ڸ� ������ �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.h_dd,"ȣ���� �������ڸ� ������ �ֽʽÿ�"))	return;
	}
*/

	if(isFrmEmpty(form.status,"���������� ������ �ֽʽÿ�"))	return;

	if(form.playing[2].checked == true && cc == '������'){
		txt = form.company.value;
		if(confirm(txt+'��(��) �۾��Ϸ� ó���Ͻðڽ��ϱ�?')){
			
			oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

			form.action = act
			form.submit();

		}else{
			return;
		}
	}



	ss = document.getElementsByName("ftpstate[]");

	for(i=0; i<ss.length; i++){
		if(ss[i].value == '����')	 form.virtualhost.value = '����';
	}





	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);
	form.action = act
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


function reg_del(cc){
	
	if(confirm('�ش������ �����Ͻðڽ��ϱ�?')){
		act = 'proc.php';

		form = document.FRM;
		form.type.value = 'del'
		form.action = act;
		form.submit();
	}else{
		return;
	}

}


function total_price(){
	form = document.FRM;
	price01 = form.price01.value;
	price02 = form.price02.value;
	price02_1 = form.price02_1.value;
	price03 = price01 - price02 - price02_1;
	form.price03.value=price03;
	return;
}
 
function bugase(){
	form = document.FRM;
	price01 = form.price01.value;
	if(form.vat.checked){
		form.price01.value = Math.floor(parseInt(price01) * 1.1); //�ΰ�������
	}else{
		form.price01.value = Math.ceil(parseInt(price01) / 1.1); //�ΰ������̳ʽ�
	}
 
	if(form.price02.value){
			total_price();
	}
	return;
}


function reg_back(){
	
	if(confirm('��ຸ�� ó���Ͻðڽ��ϱ�?')){
		form = document.FRM;
		form.type.value = 'back'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}

}


function setName(n){
	form = document.FRM;

	//���������
	sN = form['sName'+n].value;

	if(sN == '�����' || sN == '�ڼ���')		no = 3;
	else	no = 4

	form.name.selectedIndex = no;
	return;

/*
	len = form.name.length;
	for(i=0; i<len; i++){
		no = i + 1;
		opt = form.name.options[i].text;
		if(opt == sN){
			if(no == len)	no = 4;
			form.name.selectedIndex = no;
			return;
		}
	}
*/
}
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='old_sort' value='<?=$sort?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='play_sort' value='<?=$play_sort?>'>

<input type='hidden' name='mid' value=''><!-- Ư�̻��� ����,������ -->
<input type='hidden' name='did' value=''><!-- ���������� ������ -->

<!-- �������к� ������ ����� -->
<input type='hidden' name='sName1' value='<?=$sName1?>'>
<input type='hidden' name='sName2' value='<?=$sName2?>'>
<input type='hidden' name='sName3' value='<?=$sName3?>'>
<input type='hidden' name='sName4' value='<?=$sName4?>'>
<input type='hidden' name='sName5' value='<?=$sName5?>'>
<input type='hidden' name='sName6' value='<?=$sName6?>'>
<input type='hidden' name='sName7' value='<?=$sName7?>'>

<!-- �˻����� -->
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_mobile' value='<?=$f_mobile?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_company' value='<?=$f_company?>'>
<input type='hidden' name='f_person' value='<?=$f_person?>'>
<input type='hidden' name='f_email' value='<?=$f_email?>'>
<input type='hidden' name='f_fax' value='<?=$f_fax?>'>
<input type='hidden' name='f_tel' value='<?=$f_tel?>'>
<input type='hidden' name='f_hp' value='<?=$f_hp?>'>
<input type='hidden' name='f_domain' value='<?=$f_domain?>'>
<input type='hidden' name='f_ftpid' value='<?=$f_ftpid?>'>
<input type='hidden' name='f_site_name' value='<?=$f_site_name?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<!-- /�˻����� -->


<input type='hidden' name='virtualhost' value=''>




<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='30'><b>1. ������</b></td>
	</tr>

	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td width="17%" class='tab_tit30'>����</td>
					<td width="33%" class='tab'><?=$sort?></td>
					<td width="17%" class='tab_tit30'>�����</td>
					<td width="33%" class='tab'><?=$name?></td>
				</tr>
				<tr>
					<td class='tab_tit30'>����</td>
					<td class='tab'><?=$playing?></td>
					<td class='tab_tit30'>��õ��</td>
					<td class='tab'><?=$re_name?></td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>�������</td>
					<td class='tab'><?=$cdate01?>-<?=sprintf('%02d',$cdate02)?>-<?=sprintf('%02d',$cdate03)?></td>
					<td class='tab_tit30'>��������</td>
					<td class='tab'><?=$edate01?>-<?=$edate02?>-<?=$edate03?></td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>÷������</td>
					<td class='tab'>
<?
	if($realfile01){		
		echo ("<a href='../file_down.php?folder=ing02&rfile=$userfile01&sname=$realfile01'><img src='../img/common/down.gif'></a>");

	}
?>
					</td>
					<td class='tab_tit30'>���۱Ⱓ</td>
					<td class='tab'><?=$date01?></td>

				</tr>
			</table>
		</td>
	</tr>
</table>










<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='30' style='padding-top:30px;'><b>2. ��ü����</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>

				<tr> 
					<td width="17%" class='tab_tit30'>��ȣ</td>
					<td width="33%" class='tab'><?=$company?></td>
					<td width="17%" class='tab_tit30'>���������</td>
					<td width="33%" class='tab'><?=$upjong?></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>��������</td>
					<td class='tab'><?=$status?></td>
					<td class='tab_tit30'>�����</td>
					<td class='tab'><?=$person?></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>�̸���</td>
					<td class='tab'><?=$email?></td>
					<td class='tab_tit30'>�ѽ�</td>
					<td class='tab'><?=$fax01?>-<?=$fax02?>-<?=$fax03?></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>�Ϲ���ȭ</td>
					<td class='tab'><?=$tel01?>-<?=$tel02?>-<?=$tel03?></td>
					<td class='tab_tit30'>�޴���ȭ</td>
					<td class='tab'><?=$hp01?>-<?=$hp02?>-<?=$hp03?></td>
				</tr>
				<tr> 
					<td class='tab_tit30'>����Ʈ��</td>
					<td class='tab'><?=$site_name?></td>
					<td class='tab_tit' height='30'>������ ID / PWD</td>
					<td class='tab'><?=$site_id?> / <?=$site_pwd?></td>
				</tr>


			</table>
		</td>
	</tr>
</table>















	<?
		//����������
		include 'pop_domain.php';
	?>
		
	

	
	
	
	
	
	
	

	























<?
	//ȣ��������
	include 'pop_host.php';
?>










<?
	if($uid){
		$query = "select * from wo_ing02_ment where pid='$uid' order by uid desc";
		$query_result = mysql_query($query);
		$tot_ment = mysql_num_rows($query_result);

		$p01 = 0;
		$p02 = 0;
		$p03 = 0;
		$p04 = 0;

		if($tot_ment){
			for($i=0; $i<$tot_ment; $i++){
				$rows = mysql_fetch_array($query_result);
				$r_cost = $rows['cost'];
				$r_cost_vat = $rows['cost_vat'];
				$r_deposit = $rows['deposit'];


				$p01 += $r_cost;	//�ѱݾ�
				if($r_cost_vat == '����'){
					$r_vat = $r_cost / 1.1;
					$p02 += ($r_cost - $r_vat);	//�ΰ���
				}
				$p03 += $r_deposit;	//���ݾ�

			}

			$p04 = $p01 - $p03;
		}


		if($p01)	$p01_txt = number_format($p01).'��';
		else	$p01_txt = '';

		if($p02){
			$p02_txt = number_format($p02).'��';
		}else{
			if($p01)	$p02_txt = '����';
			else	$p02_txt = '';
		}

		if($p03)	$p03_txt = number_format($p03).'��';
		else	$p03_txt = '';

		if($p04){
			$p04_txt = number_format($p04).'��';
		}else{
			if($p01)	$p04_txt = '����';
			else	$p04_txt = '';
		}
	}
?>
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='30' style='padding-top:30px;'><b>5. ��������</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td width="17%" class='tab_tit' height='30'>�ѱݾ�</td>
					<td width="33%" class='tab'><?=$p01_txt?></td>
					<td width="17%" class='tab_tit' height='30'>�ΰ���</td>
					<td width="33%" class='tab'><font color='#de712e'><?=$p02_txt?></font></td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>���ݾ�</td>
					<td class='tab'><?=$p03_txt?></td>
					<td class='tab_tit' height='30'>�̼���</td>
					<td class='tab'><font color='#52809a'><?=$p04_txt?></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
















<?
	//Ư�̻��� ��� & ���
	include 'pop_ment.php';
?>








</form>