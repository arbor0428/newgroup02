<?
	include '../module/class/class.DbCon.php';

	if(!$chkYear){
		echo ("<script language='javascript'>");
		echo ("alert('���ٿ���');");
		echo ("parent.popClose();");
		echo ("</script>");
	}

	$sTime = mktime(0,0,0,1,1,$chkYear);
	$eTime = mktime(0,0,0,12,31,$chkYear);

	//�ش�⵵ ������볻��
	$sql = "select * from wo_dayoff where rTime>=$sTime and rTime<=$eTime";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$OffArr = Array();
	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$userid = $row['userid'];
		$rTime = $row['rTime'];
		$r = date('n',$rTime);

		$oNum = $OffArr[$userid][$r];

		if($oNum == '')	$oNum = 1;
		else					$oNum += 1;

		$OffArr[$userid][$r] = $oNum;
	}
?>





<title>������-�׷����</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language='javascript' src='/module/js/common.js'></script>
<link type='text/css' rel='stylesheet' href='/css/button.css'>

<div style='float:right'>��Ȳ : (����/���/������)</div>
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable'>
	<tr>
		<th width='*'>����</th>
	<?
		for($i=1; $i<=12; $i++){
	?>
		<th width='6%'><?=$i?>��</th>
	<?
		}
	?>
		<th width='15%'>��Ȳ</th>
	<tr>

<?
	$sql = "select * from wo_member where enable='1' order by uid";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$userid = $row['userid'];
		$name = $row['name'];

		$idate01 = $row['idate01'];

		//�ٹ����
		$wYear = $chkYear - $idate01;

		//�߻��� ������
		if($wYear <= 2)			$DayOff = 15;
		elseif($wYear <= 4)		$DayOff = 16;
		elseif($wYear <= 6)		$DayOff = 17;
		elseif($wYear <= 8)		$DayOff = 18;
		elseif($wYear <= 10)		$DayOff = 19;
		elseif($wYear <= 12)		$DayOff = 20;
		elseif($wYear <= 14)		$DayOff = 21;
		elseif($wYear <= 16)		$DayOff = 22;
		elseif($wYear <= 18)		$DayOff = 23;
		elseif($wYear <= 20)		$DayOff = 24;
		else							$DayOff = 25;

		$totNum = 0;
?>
	<tr>
		<td align='center'><?=$name?></td>
	<?
		for($m=1; $m<=12; $m++){
			$offNum = $OffArr[$userid][$m];
			$totNum += $offNum;
	?>
		<td align='center'><?=$offNum?></td>
	<?
		}

		$modNum = $DayOff - $totNum;
	?>
		<td align='center' style='font-weight:800;'><?=$DayOff?> / <?=$totNum?> / <?=$modNum?></td>
	</tr>
<?
	}
?>
</table>