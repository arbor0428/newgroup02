<?
	include '../module/class/class.DbCon.php';

	include "../array.php";

	if($pdate){
		$pArr = explode('-',$pdate);
		$f_year = $pArr[0];
		$f_month = $pArr[1];
		$f_day = $pArr[2];

	}else{
		$pdate = date('Y-m-d');
		$f_year = date('Y');
		$f_month = date('m');
		$f_day = date('d');
	}

	$pTime = mktime(0,0,0,$f_month,$f_day,$f_year);
	$pYoil = date('w',$pTime);
	if($pYoil == 0)			$pYoilTxt = '(일)';
	elseif($pYoil == 1)	$pYoilTxt = '(월)';
	elseif($pYoil == 2)	$pYoilTxt = '(화)';
	elseif($pYoil == 3)	$pYoilTxt = '(수)';
	elseif($pYoil == 4)	$pYoilTxt = '(목)';
	elseif($pYoil == 5)	$pYoilTxt = '(금)';
	elseif($pYoil == 6)	$pYoilTxt = '(토)';

	$pd01 = $pTime - 86400;
	$pd02 = $pTime + 86400;

	$pdate01 = date('Y-m-d',$pd01);
	$pdate02 = date('Y-m-d',$pd02);
?>


<title>아이웹-그룹웨어</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">

<script src="http://i-web.kr/skins/js/jquery.popupoverlay.js"></script>
<link type='text/css' rel='stylesheet' href='http://i-web.kr/skins/js/popupoverlay.css'>
<link type='text/css' rel='stylesheet' href='/css/button.css'>

<?
	//달력
	include '../module/Calendar.php';
?>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type='text' style='display:none;'>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable'>
	<tr> 
		<th width="16%">일자</td>
		<td width="84%">
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td style='padding:0px !important;border:0px !important;'><input type="text" name="pdate" id="fpicker1" value="<?=$pdate?>" style='width:120px;height:28px;' onchange="document.frm01.submit();"> <?=$pYoilTxt?></td>
					<td align='right' style='padding:0px !important;border:0px !important;'>
						<a href="<?=$PHP_SELF?>?pdate=<?=$pdate01?>" class="small cbtn blood">≪</a>
						<a href="<?=$PHP_SELF?>?pdate=<?=$pdate02?>" class="small cbtn blue">≫</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable'>
	<tr>
		<th width='16%'>성명</th>
		<th width='28%'>출근시간</th>
		<th width='28%'>퇴근시간</th>
		<th width='28%'>근무시간</th>
	<tr>

<?
	for($i=0; $i<count($arr_member); $i++){
		$userid = $arr_userid[$i];
		$name = $arr_member[$i];

		$sql = "select * from wo_timechk where userid='$userid' and to_y='$f_year' and to_m='$f_month' and to_d='$f_day'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		$in_txt = '';
		$out_txt = '';
		$onedate_chktime = '';

		if($num){
			$row = mysql_fetch_array($result);

			$state = $row['state'];
			$in_date = $row['in_date'];
			$out_date = $row['out_date'];

			if($in_date){
				$in_txt = date('H:i',$in_date);
				if($state == '지각')		$in_txt = "<font color='ff0000'><b>".$in_txt."</b></font>";
			}
			if($out_date)	$out_txt = date('H:i',$out_date);

			if($in_date && $out_date){
				$onedate_time = $out_date - $in_date;	 //하루 근무시간 타임값

				//하루 근무시간 계산
				$rest_hours = $onedate_time % 86400;

				$diff_in_hours = floor($rest_hours / 3600); 

				$rest_mins = $rest_hours % 3600; 
				$diff_in_mins = floor($rest_mins / 60); 
				$diff_in_secs = floor($rest_mins % 60);

				$onedate_chktime = $diff_in_hours.'시간 '.$diff_in_mins.'분';
			}
		}
?>
	<tr align='center'>
		<td><?=$name?></td>
		<td><?=$in_txt?></td>
		<td><?=$out_txt?></td>
		<td><?=$onedate_chktime?></td>
	</tr>
<?
	}
?>
</table>

</form>