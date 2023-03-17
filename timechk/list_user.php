<?
	if(!$f_userid)	$f_userid = $GBL_USERID;
	if(!$f_year)		$f_year = date('Y');
	if(!$f_month)	$f_month = date('m');
	$f_day = date('d');

	$day_last = Date("t",MkTime('0','0','0',$f_month,$f_day,$f_year));	//해당월의 마지막날


	//휴일정의
	include 'lun2sol.php';


	//해당 직원의 입사년도
	$sql = "select * from wo_member where userid='$f_userid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$idate01 = $row['idate01'];

	//근무년수
	$wYear = $f_year - $idate01;

	//발생한 연차수
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

	//조회일자기준 사용한 연차수
	$sTime = mktime(0,0,0,$f_month,1,$f_year);
	$eTime = mktime(0,0,0,$f_month,$day_last,$f_year);

	$syTime = mktime(0,0,0,1,1,$f_year);
	$eyTime = mktime(0,0,0,12,31,$f_year);

	$sql = "select * from wo_dayoff where userid='$f_userid' and rTime>=$syTime and rTime<=$eyTime";
	$result = mysql_query($sql);
	$UseOff = mysql_num_rows($result);


	$OffArr = Array();

	for($i=0; $i<$UseOff; $i++){
		$row = mysql_fetch_array($result);
		$OffArr[$i] = $row['rTime'];
	}

	//남은 연차수
	$ModOff = $DayOff - $UseOff;






	//조회일자기준 신청한 연차
	$sql = "select * from wo_dayoff_plz where userid='$f_userid' and rTime>=$sTime and rTime<=$eTime";
	$result = mysql_query($sql);
	$PlzOff = mysql_num_rows($result);

	$PlzArr = Array();

	for($i=0; $i<$PlzOff; $i++){
		$row = mysql_fetch_array($result);
		$PlzArr[$i] = $row['rTime'];
	}
?>



<script language='javascript'>
function set_search(uid){
	form = document.form1;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_off(){
    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('연차를 신청할 일자를 선택해 주세요.');
		return;
	}

	form = document.form1;
	form.type.value = 'write';
	form.action = 'dayOffPlz.php';
	form.submit();
}

function off_no(uid){
	form = document.form1;
	form.uid.value = uid;
	form.type.value = 'no';
	form.action = 'dayOffPlz.php';
	form.submit();
}
</script>

<!-- 검색 -->
<form name='form1' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='sTime' value='<?=$sTime?>'>
<input type='hidden' name='eTime' value='<?=$eTime?>'>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td width='48%' valign='top'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr>
					<th width='35%'>조회일자</th>
					<td width='65%'>
						<select name='f_year' id='f_year' onchange='set_search();'>
						<?
							for($i=2009; $i<=date('Y'); $i++){
								if($f_year == $i)	$sel = 'selected';
								else	$sel = '';

								echo ("<option value='$i' $sel>$i</option>");
							}
						?>
						</select>년&nbsp;

						<select name='f_month' onchange='set_search();'>
						<?
							for($i=1; $i<=12; $i++){
								if($f_month == $i)	$sel = 'selected';
								else	$sel = '';

								$var = sprintf('%02d',$i);

								echo ("<option value='$var' $sel>$i</option>");
							}
						?>
						</select>월
					</td>
				</tr>
			<?
				if($GBL_MTYPE == 'S'){
			?>
				<tr> 
					<th>담당자</th>
					<td>
						<select name='f_userid' id='f_userid' onchange='set_search();'>
						<?
							for($i=0; $i<count($arr_member); $i++){
						?>
							<option value='<?=$arr_userid[$i]?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
						<?
							}
						?>
						</select>
					</td>
				</tr>
			<?
				}else{
			?>
				<tr>
					<th>담당자</th>
					<td><?=$GBL_NAME?><input type='hidden' name='f_userid' value='<?=$f_userid?>'></td>
				</tr>
			<?
				}
			?>
			</table>
		</td>
		<td width='4%'></td>
		<td width='48%'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr>
					<th width='35%'>연차수 (발생/사용)</th>
					<td width='65%' style='font-size:18px;font-weight:800;'><?=$DayOff?> / <?=$UseOff?></td>
				</tr>
				<tr>
					<th>남은 연차</th>
					<td style='font-size:18px;font-weight:800;color:#ff0000;'><?=$ModOff?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br><br>

<div style='margin-bottom:3px;'><a href="javascript:set_off();" class="small cbtn green">연차신청</a></div>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
	<tr>
		<th>
			<div class="squaredBox">
				<input type="checkbox" value="" id="all_chk" name="all_chk" onclick="All_chk('all_chk','chk[]');">
				<label for="all_chk"></label>
			</div>
		</th>
		<th>일자</th>
		<th>요일</th>
		<th>구분</th>
		<th>출근시간</th>
		<th>출근IP</th>
		<th>퇴근시간</th>
		<th>퇴근IP</th>
		<th>사유</th>
	</tr>



<?

$late = 0;
$no = 0;
$to_y = date('Y');
$to_m = date('m');
$to_d = date('d');

$toTime = mktime(0,0,0,$to_m,$to_d,$to_y);

$onedate_time = 0;	//하루 근무시간 타임값
$work_tot_time = 0;	//총 근무시간 타임값
$work_date = 0;	//근무시간이 계산된 일수


for($i=1; $i<=$day_last; $i++){
	$day = sprintf('%02d',$i);
	$date = $f_year.'-'.$f_month.'-'.$day;

	$onedate_chktime = '';	//하루근무시간

	//요일
	$wtime = mktime(0,0,0,$f_month,$i,$f_year);
	$yoil = date('w',$wtime);

	if($yoil == '0')	$yoil_txt = '<font color=#FF0000>일</font>';
	elseif($yoil == '1')	$yoil_txt = '월';
	elseif($yoil == '2')	$yoil_txt = '화';
	elseif($yoil == '3')	$yoil_txt = '수';
	elseif($yoil == '4')	$yoil_txt = '목';
	elseif($yoil == '5')	$yoil_txt = '금';
	elseif($yoil == '6')	$yoil_txt = '<font color=#0000FF>토</font>';

	if($to_y == $f_year && $to_m == $f_month && $i<=$f_day){	//이번달일 경우 1일부터 현재일까지만 실행
		$chk_if = '1';
	}elseif($to_y != $f_year || $to_m != $f_month){	//이번달이 아닌경우 1일부터 마지막일까지 전부실행
		$chk_if = '2';
	}else{
		$chk_if = '';
	}

	if($chk_if && ($yoil>0 && $yoil<7)){	//해당월의 1일부터 오늘까지 평일만 쿼리문 실행
		$query_ment = "where userid='$f_userid' and to_y='$f_year' and to_m='$f_month' and to_d='$day'";

		$sort_ment = "order by to_d asc, userid asc";

		$sql = "select * from wo_timechk $query_ment $sort_ment";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);


		if($num){
			$row = mysql_fetch_array($result);
			$state = $row['state'];
			$ment = $row['ment'];
			$in_date = $row['in_date'];
			$out_date = $row['out_date'];
			$in_ip = $row['in_ip'];
			$out_ip = $row['out_ip'];

			if($in_date)	$in_txt = date('H:i',$in_date);
			else	$in_txt = '';

			if($out_date)	$out_txt = date('H:i',$out_date);
			else	$out_txt = '';

			if($state == '지각')	$late++;

			$no++;

			//평균출근시간
			$cut_s = explode(':',$in_txt);
			$avr_mktime = mktime($cut_s[0],$cut_s[1],0,$to_m,$to_d,$to_y);
			$tot_mktime += $avr_mktime;


			//출퇴근 시간 모두 있는 평일에만 근무시간을 계산한다.
			if($yoil>0 && $yoil<6){
				if($in_date && $out_date){
					$onedate_time = $out_date - $in_date;	 //하루 근무시간 타임값
					$work_tot_time += $onedate_time;
					$work_date += 1;


/*	
					//하루 근무시간 계산
					$rest_hours = $onedate_time % 86400;

					$diff_in_hours = floor($rest_hours / 3600); 

					$rest_mins = $rest_hours % 3600; 
					$diff_in_mins = floor($rest_mins / 60); 
					$diff_in_secs = floor($rest_mins % 60);

					$onedate_chktime = $diff_in_hours.'시간 '.$diff_in_mins.'분';
*/
				}
			}



		}else{
			$state = '';
			$in_txt = '';
			$out_txt = '';
			$in_ip = '';
			$out_ip = '';
			$ment = '';
		}

	}else{
		$state = '';
		$in_txt = '';
		$out_txt = '';
		$in_ip = '';
		$out_ip = '';
		$ment = '';
	}


	//연차확인
	if(in_array($wtime,$OffArr)){
		$dayOffChk = '1';
		$ment = " <span class='ico03'>연차</span>";
	}else{
		$dayOffChk = '';
	}

	//연차신청확인
	if(in_array($wtime,$PlzArr))		$dayPlzChk = '1';
	else									$dayPlzChk = '';


	$hollName = '';

	//휴일확인
	for($h=0; $h<count($HOLIDAY); $h++){
		if($HOLIDAY[$h][0] == $f_month.$day){
			$hollName = $HOLIDAY[$h][1];
			$state = "<span class='ico09'>$hollName</span>";
			break;
		}
	}


	if($yoil == '0' || $yoil == '6' || $hollName){
?>
	<tr bgcolor='#efefef'>
<?
	}else{
?>
	<tr onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'">
<?
	}
?>
		<td width='40' align='center'>
		<?
			if($dayOffChk){
				echo ("<span class='ico03'>연차</span>");

			}elseif($dayPlzChk){
				echo ("<span class='bco10' onclick=\"off_no('$wtime');\">취소</span>");

			}else{
		?>
			<div class="squaredBox">
				<input type="checkbox" value="<?=$wtime?>" id="chkBox<?=$wtime?>" name="chk[]">
				<label for="chkBox<?=$wtime?>"></label>
			</div>
		<?
			}
		?>
		</td>
		<td class='tit04' height='30'><?=$date?></td>
		<td class='tit04'><?=$yoil_txt?></td>
		<td class='tit04'><?=$state?></td>
		<td class='tit04'><?=$in_txt?></td>
		<td class='tit04'><?=$in_ip?></td>
		<td class='tit04'><?=$out_txt?></td>
		<td class='tit04'><?=$out_ip?></td>
		<td class='tit04'><?=$ment?></td>

	</tr>


<?
}
?>
</table>

<br>

<?
	if($tot_mktime && $no){
		if($no)	$tot_day = $no.'일';
		else	$tot_day = '-';

		if($late)	$tot_late = $late.'일';
		else	$tot_late = '-';

		$tot_time = $tot_mktime / $no;
		$tot_time = date('H:i',$tot_time);


		if($work_tot_time){

			$wwtime = $work_tot_time / $work_date;
			//총 근무시간 계산
			$rest_hours = $wwtime % 86400;

			$diff_in_hours = floor($rest_hours / 3600); 

			$rest_mins = $rest_hours % 3600; 
			$diff_in_mins = floor($rest_mins / 60); 
			$diff_in_secs = floor($rest_mins % 60);

			$totdate_chktime = $diff_in_hours.'시간 '.$diff_in_mins.'분';
		}


?>

<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides">
	<tr>
		<td class='tit02' height='30' width='13%'>출근일수</td>
		<td class='tit04' width='20%'><?=$tot_day?></td>
		<td class='tit02' width='13%'>지각일수</td>
		<td class='tit04' width='20%'><?=$tot_late?></td>
		<td class='tit02' width='14%'>평균출근시간</td>
		<td class='tit04' width='20%'><?=$tot_time?></td>
	</tr>
</table>

<?
	}
?>


</form>