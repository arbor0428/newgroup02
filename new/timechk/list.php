<?

//수정
//$setTime = mktime(8,40,50,8,9,2021);
//$sql = "update wo_timechk set state='-', in_date='$setTime', in_ip='106.246.92.237' where uid=16121";
//$sql = "update wo_timechk set out_date='$setTime', out_ip='106.246.92.237', ment='' where uid=15845";
//$result = mysql_query($sql);


/*
//추가
$setTime01 = mktime(10,00,0,5,6,2021);
$setTime02 = mktime(18,00,0,5,6,2021);
$setTime03 = mktime(0,0,0,5,6,2021);
$sql = "insert into wo_timechk (userid,to_y,to_m,to_d,to_w,state,ment,in_date,out_date,in_ip,out_ip,reg_date,rTime) values ('dlwlswl00','2021','05','06','목','-','','$setTime01','$setTime02','106.246.92.237','106.246.92.237','$setTime01','$setTime03')";
$result = mysql_query($sql);
*/


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


	//접수된 연차신청내역
	$sql = "select count(*) from wo_dayoff_plz";
	$result = mysql_query($sql);
	$plzTot = mysql_result($result,0,0);
?>



<script language='javascript'>
function set_search(){
	form = document.form1;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function set_off(){
	form = document.form1;
	form.type.value = 'write';
	form.action = 'dayOff.php';
	form.submit();
}

function off_ok(uid){
	form = document.form1;
	form.uid.value = uid;
	form.type.value = 'ok';
	form.action = 'dayOff.php';
	form.submit();
}

function off_no(uid){
	form = document.form1;
	form.uid.value = uid;
	form.type.value = 'no';
	form.action = 'dayOff.php';
	form.submit();
}

function timeViewer(){
	f_year = $("#f_year").val();
	userID = $("#f_userid option:selected").val();
	userName = $("#f_userid option:selected").text();
	document.getElementById("multi_ttl").innerHTML = f_year+'년도 근태내역 - ['+userName+']';
	document.getElementById("multiFrame").innerHTML = "<iframe src='detail.php?userid="+userID+"&chkYear="+f_year+"' width='900' height='660' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
}

function daysViewer(){

	document.getElementById("multi_ttl").innerHTML = '일자별 상세내역';
	document.getElementById("multiFrame").innerHTML = "<iframe src='days.php' width='500' height='660' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
}

function offViewer(){
	f_year = $("#f_year").val();
	document.getElementById("multi_ttl").innerHTML = f_year+'년도 연차현황';
	document.getElementById("multiFrame").innerHTML = "<iframe src='detailOff.php?chkYear="+f_year+"' width='900' height='660' frameborder='0' scrolling='no'></iframe>";
	$(".multiBox_open").click();
}

function plzViewer(){
	document.getElementById("multi_ttl").innerHTML = '연차신청내역';
	document.getElementById("multiFrame").innerHTML = "<iframe src='plzOff.php' width='400' height='660' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
}

function popClose(){
	$(".multiBox_close").click();
}
</script>

<!-- 검색 -->
<form name='form1' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='sTime' value='<?=$sTime?>'>
<input type='hidden' name='eTime' value='<?=$eTime?>'>



<div class="search_container">
	<div class="search_wrap">
		<div class="search_row">
			<div class="search_th">조회일자</div>
			<div class="search_td">
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
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">연차수 (발생/사용)</div>
			<div class="search_td">
				<?=$DayOff?> / <?=$UseOff?>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">담당자</div>
			<div class="search_td">
				<select name='f_userid' id='f_userid' onchange='set_search();'>
					<?
						for($i=0; $i<count($arr_member); $i++){
					?>
						<option value='<?=$arr_userid[$i]?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
					<?
						}
					?>
				</select>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">남은 연차</div>
			<div class="search_td">	<?=$ModOff?>	</div>
		</div>

	</div>
</div>
<div class="serach_btn-wrap">
	<a href="javascript:timeViewer();" class='btn_primary02'>통계자료보기</a>
	<a href="javascript:daysViewer();" class='btn_primary02'>일자별보기</a>

	<a href="javascript:offViewer();" class='btn_primary02'>연차현황</a>
	<a href="javascript:plzViewer();" class='btn_primary02'>신청내역 (<?=$plzTot?>)</a>
</div>








<div style='margin-bottom:3px;'><a href="javascript:set_off();" class="btn_primary03">연차적용</a></div>

<div class="mobile_scroll">

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
		<th width='20%'>사유</th>
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
	$uid = '';

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

	$in_device = '';
	$out_device = '';

	if($chk_if && ($yoil>0 && $yoil<7)){	//해당월의 1일부터 오늘까지 평일만 쿼리문 실행
		$query_ment = "where userid='$f_userid' and to_y='$f_year' and to_m='$f_month' and to_d='$day'";

		$sort_ment = "order by to_d asc, userid asc";

		$sql = "select * from wo_timechk $query_ment $sort_ment";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);


		if($num){
			$row = mysql_fetch_array($result);
			$uid = $row['uid'];
			$state = $row['state'];
			$ment = $row['ment'];
			$in_date = $row['in_date'];
			$out_date = $row['out_date'];
			$in_ip = $row['in_ip'];
			$out_ip = $row['out_ip'];

			if($GBL_MTYPE == 'A'){
				$in_device = $row['in_device'];
				$out_device = $row['out_device'];
			}

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

/*
			//출퇴근 시간 모두 있는 평일에만 근무시간을 계산한다.
			if($yoil>0 && $yoil<6){
				if($in_date && $out_date){
					$onedate_time = $out_date - $in_date - 3600;	 //하루 근무시간 타임값(점심시간제외)
					$work_tot_time += $onedate_time;
					$work_date += 1;



					//하루 근무시간 계산
					$rest_hours = $onedate_time % 86400;

					$diff_in_hours = floor($rest_hours / 3600); 

					$rest_mins = $rest_hours % 3600; 
					$diff_in_mins = floor($rest_mins / 60); 
					$diff_in_secs = floor($rest_mins % 60);

					$onedate_chktime = $diff_in_hours.'시간 '.$diff_in_mins.'분';

				}
			}
*/


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
		$dayOffChk = 'checked';
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

	if($hollName == ''){
		if($OneFreeDay[$f_year.$f_month.$day]){
			$hollName = $OneFreeDay[$f_year.$f_month.$day];
			$state = "<span class='ico09'>$hollName</span>";
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
		<td width='40' align='center' style='line-height:30px;'>
		<?
			if($dayPlzChk){
		?>
			<span class='bco04' onclick="off_ok('<?=$wtime?>');">승인</span>
			<span class='bco08' onclick="off_no('<?=$wtime?>');">거절</span>

		<?
			}else{
		?>
			<div class="squaredBox">
				<input type="checkbox" value="<?=$wtime?>" id="chkBox<?=$wtime?>" name="chk[]" <?=$dayOffChk?>>
				<label for="chkBox<?=$wtime?>"></label>
			</div>
		<?
			}
		?>
		</td>
		<td class='tit04' height='30'><?=$date?><?if($GBL_USERID == 'korea'){echo '<br>'.$uid;}?></td>
		<td class='tit04'><?=$yoil_txt?></td>
		<td class='tit04'><?=$state?></td>
		<td class='tit04'><?=$in_txt?></td>
		<td class='tit04'><?=$in_ip?> <?if($in_device){echo "<span style='color:#de712e;'>(M)</span>";}?></td>
		<td class='tit04'><?=$out_txt?></td>
		<td class='tit04'><?=$out_ip?> <?if($out_device){echo "<span style='color:#de712e;'>(M)</span>";}?></td>
		<td class='tit04'><?=$ment?></td>

	</tr>


<?
}
?>
</table>

</div>

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

<?
	include $_SERVER["DOCUMENT_ROOT"].'/new/footer.php';
?>