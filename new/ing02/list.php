<?
	$record_count = 40;  //�� �������� ��µǴ� ���ڵ��

	$link_count = 10; //�� �������� ��µǴ� ������ ��ũ��

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));


	if($play_sort == '������'){
		$query_ment = "where playing='����'";

	}elseif($play_sort == '����'){
		$query_ment = "where playing='����'";

	}elseif($play_sort == '��������'){
		$query_ment = "where playing='��������'";

	}elseif($play_sort == '�Ϸ�'){
		$query_ment = "where playing='�Ϸ�'";
		if($field == 'sort')	$field = 'company';

	}else{	//��ü
		$query_ment  = "where uid > 0";
		if($field == 'sort')	$field = 'company';

	}

	if($f_status)	 	$query_ment .= " and status='$f_status'";
	else	$query_ment .= " and status!='�κ�����'";

	if($f_mobile)	 	$query_ment .= " and mobile='$f_mobile'";

	if($f_name)			$query_ment .= " and name='$f_name'";
	if($f_sname)		$query_ment .= " and name like '%$f_sname%'";
	if($f_company)	$query_ment .= " and company like '%$f_company%'";
	if($f_person)		$query_ment .= " and person like '%$f_person%'";
	if($f_email)			$query_ment .= " and email like '%$f_email%'";
	if($f_sales)			$query_ment .= " and sales like '%$f_sales%'";
	if($f_fax){
		$query_ment .= " and (fax01 like '%$f_fax%' or fax02 like '%$f_fax%' or fax03 like '%$f_fax%')";
	}

	if($f_tel){
		$query_ment .= " and (tel01 like '%$f_tel%' or tel02 like '%$f_tel%' or tel03 like '%$f_tel%')";
	}

	if($f_hp){
		$query_ment .= " and (hp01 like '%$f_hp%' or hp02 like '%$f_hp%' or hp03 like '%$f_hp%')";
	}
	if($f_site_name)	$query_ment .= " and site_name like '%$f_site_name%'";





	//������ �˻���
	if($f_domain){
		$fsql = "select distinct pid from wo_ing02_domain where doname like '%$f_domain%'";
		$fresult = mysql_query($fsql);
		$dtot = mysql_num_rows($fresult);

		$f_arr01 = '';

		for($i=0; $i<$dtot; $i++){
			$frow = mysql_fetch_array($fresult);
			$dpid = $frow['pid'];

			if($f_arr01)	$f_arr01 .= ',';
			$f_arr01 .= $dpid;
		}

		if($f_arr01)	$query_ment .= " and uid in ($f_arr01)";
		else			$query_ment .= " and uid=0";
	}





	//ftp_id �˻���
	if($f_ftpid){
		$fsql = "select distinct pid from wo_ing02_host where (ftpid like '%$f_ftpid%' or ftpcapa like '%$f_ftpid%')";
		$fresult = mysql_query($fsql);
		$dtot = mysql_num_rows($fresult);

		$f_arr02 = '';

		for($i=0; $i<$dtot; $i++){
			$frow = mysql_fetch_array($fresult);
			$dpid = $frow['pid'];

			if($f_arr02)	$f_arr02 .= ',';
			$f_arr02 .= $dpid;
		}

		if($f_arr02)	$query_ment .= " and uid in ($f_arr02)";
		else			$query_ment .= " and uid=0";
	}





	//ȣ���� �˻���
	if($f_ftphost){
		$fsql = "select distinct pid from wo_ing02_host where hocom like '%$f_ftphost%'";
		$fresult = mysql_query($fsql);
		$dtot = mysql_num_rows($fresult);

		$f_arr02 = '';

		for($i=0; $i<$dtot; $i++){
			$frow = mysql_fetch_array($fresult);
			$dpid = $frow['pid'];

			if($f_arr02)	$f_arr02 .= ',';
			$f_arr02 .= $dpid;
		}

		if($f_arr02)	$query_ment .= " and uid in ($f_arr02)";
		else			$query_ment .= " and uid=0";
	}




	//Ư�̻��� �˻���
	if($f_ment){
		$fsql = "select distinct pid from wo_ing02_ment where ment like '%$f_ment%'";
		$fresult = mysql_query($fsql);
		$dtot = mysql_num_rows($fresult);

		$f_arr03 = '';

		for($i=0; $i<$dtot; $i++){
			$frow = mysql_fetch_array($fresult);
			$dpid = $frow['pid'];

			if($f_arr03)	$f_arr03 .= ',';
			$f_arr03 .= $dpid;
		}

		if($f_arr03)	$query_ment .= " and uid in ($f_arr03)";
		else			$query_ment .= " and uid=0";
	}





	if($field=='sort')					$sort_ment = "order by sort asc";
	elseif($field=='ctime')		$sort_ment = "order by ctime desc";
	elseif($field=='company')		$sort_ment = "order by binary(company) asc";
	elseif($field=='domain_date')	$sort_ment = "order by domain_date asc";
	elseif($field=='host_date')		$sort_ment = "order by host_date asc";
	else									$sort_ment = "order by ctime desc";




	$query = "select * from wo_ing02 $query_ment $sort_ment";

	$result = mysql_query($query) or die("�������");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_ing02 $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>



<script language='javascript'>

function reg_view(uid){
	form = document.form1;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_write(uid){
	form = document.form1;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>



<form name='form1' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- �ؽ�Ʈ�ڽ� 1���̻� ó��.. �ڵ����۹��� -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>


<?
	include 'search.php';
?>

<div class="mobile_scroll">
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
	<tr>
		
<?
	if($play_sort == '������................'){
?>
		<th>�����</th>
		<th>����</th>
<?
	}else{
?>
		<th>��ȣ</th>
		<th>�����</th>
<?
	}
?>
		<th>��ȣ</th>
		<th>����</th>
		<th>�����</th>
		<th>�����</th>
		<th>�Ϲ���ȭ</th>
		<th>���۴����</th>
		<th>��������</th>
		<th>�̼���</th>
		<th>������</th>
		<th>ȣ����</th>
		<th>����</th>
	</tr>

</form>	

<?

$today_time = mktime(0,0,0,date('m'),date('d'),date('Y'));

if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$sort = $row["sort"];
		$person = $row["person"];
		$name = $row["name"];
		$sales = $row["sales"];
		$company = $row["company"];
		$status = $row["status"];
		$mobile = $row["mobile"];
		$tel01 = $row["tel01"];
		$tel02 = $row["tel02"];
		$tel03 = $row["tel03"];
		$date01 = $row["date01"];
		$edate01 = $row["edate01"];
		$edate02 = $row["edate02"];
		$edate03 = $row["edate03"];
		$playing = $row["playing"];
		$domain_date = $row["domain_date"];
		$host_date = $row["host_date"];
		$virtualhost = $row["virtualhost"];
		$ftpDate = $row["ftpDate"];


		//FTP��������
		if($ftpDate)	$ftpDate = "<br><span style='color:#de712e'>FTP</span>";

		if($virtualhost == '����')	$bgimg = "style='background:url(/work/img/dot.gif);background-position:center center;background-repeat:repeat-x;'";
		else	$bgimg = '';

		if($mobile == '1')	$mobile_txt = "<font color='#de712e'><b>M</b></font>";
		else	$mobile_txt = '';


		$telephone = $tel01;

		if($tel02){
			if($telephone)	$telephone .= '-';
			$telephone .= $tel02;
		}

		if($tel03){
			if($telephone)	$telephone .= '-';
			$telephone .= $tel03;
		}


		if($date01)	$date01 = $date01.'��';

		$edate = '';

		if($edate01)	$edate = $edate01.'�� ';
		if($edate02)	$edate .= $edate02.'�� ';
		if($edate03)	$edate .= $edate03.'��';


		$ctime = $row["ctime"];
		$ctime = date('Y-m-d',$ctime);

		$date_diff = Util::dateDiff($SYSTEM_DATE,$ctime);

		if($date_diff <= 3)	 $new_icon = "<img src='../../images/common/new_file.gif'>";
		else	$new_icon = $ctime;


		$java_link = 'reg_write';

		$Dday01 = '';
		$Dday02 = '';

		if($domain_date)	$Dday01 = intval(($domain_date - $today_time) / 86400).'��';
		if($host_date)	$Dday02 = intval(($host_date - $today_time) / 86400).'��';

		if($status == '�˶���' || $status == '������' || $status == '������' || $status == '�����' || $status == '�κ�����')	$Dday01 = '';


		//ȣ���������� �����´�.
		$hsql = "select * from wo_ing02_host where pid='$uid'";
		$hresult = mysql_query($hsql);
		$hnum = mysql_num_rows($hresult);

		$iweb = '';
		$ftptype = '';

		for($h=0; $h<$hnum; $h++){
			$hrow = mysql_fetch_array($hresult);
			$ftptype = $hrow['ftptype'];
			if($ftptype == '�������̿�' || $ftptype == '������[�ڵ�û��]')	$iweb = $ftptype;
		}

		if($iweb)	 $iweb = "<img src='http://i-web.kr/_goldtower/images/icon_iweb.gif' align='absmiddle'>";


		//ȣ���ø��� ���ϰ�� �������̿��ڴ� ��Ͽ��� �����Ѵ�.
		if($field == 'host_date' && $iweb)	 $trh = false;
		else	$trh = true;




		//�̼���Ȯ��
		$msql = "select * from wo_ing02_ment where pid='$uid' order by uid desc";
		$mresult = mysql_query($msql);
		$tot_ment = mysql_num_rows($mresult);

		$p01 = 0;
		$p02 = 0;
		$p03 = 0;
		$p04 = 0;

		if($tot_ment){
			for($m=0; $m<$tot_ment; $m++){
				$mrows = mysql_fetch_array($mresult);
				$r_cost = $mrows['cost'];
				$r_cost_vat = $mrows['cost_vat'];
				$r_deposit = $mrows['deposit'];


				$p01 += $r_cost;	//�ѱݾ�
				if($r_cost_vat == '����'){
					$r_vat = $r_cost / 1.1;
					$p02 += ($r_cost - $r_vat);	//�ΰ���
				}
				$p03 += $r_deposit;	//���ݾ�

			}

			$p04 = $p01 - $p03;
		}

		if($p04)	$p04_txt = "<font color='#52809a'>".number_format($p04)."</font>";
		else		$p04_txt = '';

if($trh){

		
?>

	<tr style='cursor:hand' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'">


<?
	if($play_sort == '������.................'){
?>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$new_icon?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$sort?></td>
<?
	}else{
?>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$i?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$new_icon?></td>
<?
	}
?>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$company?></td>		
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$status?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$mobile_txt?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$person?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$telephone?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$name?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$sales?></td>

		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$p04_txt?></td>

		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$Dday01?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$iweb?><?=$Dday02?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');" <?=$bgimg?>><?=$playing?><?=$ftpDate?></td>


	</tr>

<?
}
		$line_num++;
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="12" align='center'>�����Ͱ� �����ϴ�.</td>
	</tr>
<?
}
?>
</table>

</div>


<?
	$fName = 'form1';
	include '../pageNum.php';
	include $_SERVER["DOCUMENT_ROOT"].'/new/footer.php';
?>