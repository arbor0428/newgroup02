<?
	include '../module/class/class.DbCon.php';

	if(!$userid || !$chkYear){
		echo ("<script language='javascript'>");
		echo ("alert('���ٿ���');");
		echo ("parent.popClose();");
		echo ("</script>");
	}

	$sTime = mktime(0,0,0,1,1,$chkYear);
	$eTime = mktime(0,0,0,12,31,$chkYear);

	//�ش�⵵ ������볻��
	$sql = "select * from wo_dayoff where userid='$userid' and rTime>=$sTime and rTime<=$eTime";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$OffArr = Array();
	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$rTime = $row['rTime'];
		$r = date('n',$rTime);

		$oNum = $OffArr[$r];

		if($oNum == '')	$oNum = 1;
		else					$oNum += 1;

		$OffArr[$r] = $oNum;
	}
?>





<title>������-�׷����</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language='javascript' src='/module/js/common.js'></script>
<link type='text/css' rel='stylesheet' href='/css/button.css'>


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable'>
	<tr>
		<th width='10%'>��</th>
		<th width='15%'>�������</th>
		<th width='15%'>����ϼ�</th>
		<th width='15%'>�����ٽð�</th>
		<th width='15%'>�����ٽð�</th>
		<th width='15%'>�ѱٹ��ð�</th>
		<th width='15%'>�����ϼ�</th>
	<tr>
<?	
	$onumTotal = 0;
	$cnumTotal = 0;
	$sTimeTotal = 0;
	$eTimeTotal = 0;
	$wTimeTotal = 0;
	$lateTotal = 0;

	$chkTot01 = 0;	//�����ٽð� ����
	$chkTot02 = 0;	//�����ٽð� ����
	$chkTot03 = 0;	//�ѱٹ��ð� ����

	for($i=1; $i<=12; $i++){
		$chkMonth = sprintf('%02d',$i);


		//����ϼ�
		$sql = "select count(*) from wo_timechk where userid='$userid' and to_y='$chkYear' and to_m='$chkMonth'";
		$result = mysql_query($sql);
		$cnum = mysql_result($result,0,0);





		$sql = "select * from wo_timechk where userid='$userid' and to_y='$chkYear' and to_m='$chkMonth'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		$chkNo01 = 0;	//�����ٽð� ����
		$chkNo02 = 0;	//�����ٽð� ����
		$chkNo03 = 0;	//�ѱٹ��ð� ����

		$sTimeChk = 0;
		$eTimeChk = 0;
		$wTimeChk = 0;
		$late = 0;

		for($c=0; $c<$num; $c++){
			$row = mysql_fetch_array($result);
			$state = $row['state'];
			$in_date = $row['in_date'];
			$out_date = $row['out_date'];
			$to_y = $row['to_y'];
			$to_m = $row['to_m'];
			$to_d = $row['to_d'];

			//�����ٽð�
			if($in_date){
				$chkNo01 += 1;

				$in_txt = date('H:i',$in_date);			
				$cut_s = explode(':',$in_txt);
				$avr_mktime = mktime($cut_s[0],$cut_s[1],0,$chkMonth,1,$chkYear);
				$sTimeChk += $avr_mktime;
			}

			//�����ٽð�
			if($out_date){
				$chkNo02 += 1;

				$out_txt = date('H:i',$out_date);			
				$cut_e = explode(':',$out_txt);
				$avr_mktime = mktime($cut_e[0],$cut_e[1],0,$chkMonth,1,$chkYear);
				$eTimeChk += $avr_mktime;
			}

			//�ѱٹ��ð�
			if($in_date && $out_date){
				$chkNo03 += 1;

				$onedate_time = $out_date - $in_date;	 //�Ϸ� �ٹ��ð� Ÿ�Ӱ�

				//�ش����� 13��Ÿ�Ӱ�
				$lunchTime = mktime(13,0,0,$to_m,$to_d,$to_y);

				//13������ ��ٽ� ���ɽð� ����
				if($in_date < $lunchTime)	$onedate_time -= 3600;

				$wTimeChk += $onedate_time;
			}

			//�����ϼ�
			if($state == '����')	$late++;
		}


		$sTimeTot = 0;
		$eTimeTot = 0;
		$wTimeTot = 0;

		$sTimeTotTxt = '';
		$eTimeTotTxt = '';
		$wTimeTotTxt = '';

		if($sTimeChk){
			$sTimeTot = $sTimeChk / $chkNo01;
			$sTimeTotTxt = date('H:i',$sTimeTot);

			//�հ����
			$chkTot01 += 1;
			$sTimeTotal += mktime(date('H',$sTimeTot),date('i',$sTimeTot),0,1,1,$chkYear);
		}

		if($eTimeChk){
			$eTimeTot = $eTimeChk / $chkNo02;
			$eTimeTotTxt = date('H:i',$eTimeTot);

			//�հ����
			$chkTot02 += 1;
			$eTimeTotal += mktime(date('H',$eTimeTot),date('i',$eTimeTot),0,1,1,$chkYear);
		}

/*
		//��ձٹ��ð���갪
		if($wTimeChk){
			$wwtime = $wTimeChk / $chkNo03;

			$rest_hours = $wwtime % 86400;

			$diff_in_hours = floor($rest_hours / 3600); 

			$rest_mins = $rest_hours % 3600; 
			$diff_in_mins = floor($rest_mins / 60); 
			$diff_in_secs = floor($rest_mins % 60);

			$wTimeTotTxt = $diff_in_hours.'�ð� '.$diff_in_mins.'��';

			//�հ����
			$chkTot03 += 1;
			$wTimeTotal += $wwtime;
		}
*/

		//�ѱٹ��ð���갪
		if($wTimeChk){
			$diff_in_hours = floor($wTimeChk / 3600); 

			$rest_mins = $wTimeChk % 3600; 
			$diff_in_mins = floor($rest_mins / 60); 
			$diff_in_secs = floor($rest_mins % 60);

			$wTimeTotTxt = $diff_in_hours.'�ð� '.$diff_in_mins.'��';

			//�հ����
			$chkTot03 += 1;
			$wTimeTotal += $wTimeChk;
		}


		//��뿬����
		$onum = $OffArr[$i];

		$onumTotal += $onum;
		$cnumTotal += $cnum;
		$lateTotal += $late;

		if($sTimeTotTxt == ''){
			$cnum = '';
			$late = '';
		}
?>

	<tr align='center'>
		<th><?=$i?>��</th>
		<td><?=$onum?></td>
		<td><?=$cnum?></td>
		<td><?=$sTimeTotTxt?></td>
		<td><?=$eTimeTotTxt?></td>
		<td><?=$wTimeTotTxt?></td>
		<td><?=$late?></td>
	</tr>

<?
	}









	if($sTimeTotal){
		$sTT = $sTimeTotal / $chkTot01;
		$sTimeTotalTxt = date('H:i',$sTT);
	}

	if($eTimeTotal){
		$eTT = $eTimeTotal / $chkTot02;
		$eTimeTotalTxt = date('H:i',$eTT);
	}

/*
	//��ձٹ��ð���갪
	if($wTimeTotal){
		$wwtime = $wTimeTotal / $chkTot03;

		$rest_hours = $wwtime % 86400;

		$diff_in_hours = floor($rest_hours / 3600); 

		$rest_mins = $rest_hours % 3600; 
		$diff_in_mins = floor($rest_mins / 60); 
		$diff_in_secs = floor($rest_mins % 60);

		$wTimeTotalTxt = $diff_in_hours.'�ð� '.$diff_in_mins.'��';
	}
*/

	//�ѱٹ��ð���갪
	if($wTimeTotal){
		$diff_in_hours = floor($wTimeTotal / 3600); 

		$rest_mins = $wTimeTotal % 3600; 
		$diff_in_mins = floor($rest_mins / 60); 
		$diff_in_secs = floor($rest_mins % 60);

		$wTimeTotalTxt = $diff_in_hours.'�ð� '.$diff_in_mins.'��';
	}
?>

	<tr align='center'>
		<th>-</th>
		<th><?=$onumTotal?></th>
		<th><?=$cnumTotal?></th>
		<th><?=$sTimeTotalTxt?></th>
		<th><?=$eTimeTotalTxt?></th>
		<th><?=$wTimeTotalTxt?></th>
		<th><?=$lateTotal?></th>
	</tr>
</table>