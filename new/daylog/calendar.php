<?
$s_font_color01 = 'de712e';	 //일요일 색상
$s_font_color02 = '52809a';	//토요일 색상
$s_bg_color01 = 'EBF4F8';	//오늘날짜 배경색
$pre_btn_icon = '/img/board/prev2.gif';	 //지난달 링크 이미지
$next_btn_icon = '/img/board/next2.gif';	//다음달 링크 이미지




//해당월의 총날짜수를 구한다.
function getTotaldays($y, $m) {
	$d = 1;
	while(checkdate($m, $d, $y)) {
		$d++;
	}

	$d = $d - 1;
	return $d;
}

//토,일요일을 색상으로 구분해준다.
function getDayColor($day, $date, $color01, $color02) {
	$cstr = "";

	switch($day) {
			case(0) :
							$cstr = "<font color='".$color01."'>$date</font>";
							break;

			case(6) :
							$cstr = "<font color='".$color02."'>$date</font>";
							break;

			default :
							$cstr = $date;
							break;
	}

	return $cstr;
}

//넘어오는 년월정보가 없으면 현재 년월을..
if(!$cur_y)	$cur_y = date(Y);
if(!$cur_m)	 $cur_m = date(m);

//해당 년월의 총 날짜수를 구한다.
$tot_days = getTotaldays($cur_y, $cur_m);

//해당 년월의 1일에 해당하는 timestamp값을 구한다.
$tstamp = mktime(0,0,0,$cur_m,1,$cur_y);

//timestamp값으로 날짜정보(요일)를 구한다.
$tinfo = getdate($tstamp);
$start_day = $tinfo["wday"];

$start_chk = false;
$week_end = false;
$dayno = 0;




?>


<style type='text/css'>
.chkData{
	background-image:url('/img/folder.png');
	background-repeat:no-repeat;
	background-position:center center;
}
</style>



<script language="javascript">
function Sel_date(y,m,d){
	form = document.frm_day;
	form.s_year.value = y;
	form.s_month.value = m;
	form.s_day.value = d;

	form.cur_y.value = y;
	form.cur_m.value = m;
	form.cur_d.value = d;

	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script> 






<table border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td align='center'>
		<!-- 년, 월 표기 -->
			<table width="170" border="0" align="center" cellpadding="2" cellspacing="0" style="text-align:center;">
				<tr>
					<!-- 이전달 링크-->
					<td>					
						<?if($cur_m-1=="0"){?>
						<a href="<?=$PHP_SELF?>?cur_y=<?=$cur_y-1?>&cur_m=12&s_name=<?=$s_name?>"><img src="<?=$pre_btn_icon?>"></a>
						<?}else{?>
						<a href="<?=$PHP_SELF?>?cur_y=<?=$cur_y?>&cur_m=<?=$cur_m-1?>&s_name=<?=$s_name?>"><img src="<?=$pre_btn_icon?>"></a>
						<?}?>
					</td>
					<!-- /이전달 링크 -->

					<td height="20"><strong><?=$cur_y?>년 <?=$cur_m?>월</b></strong></td>

					<!-- 다음달 링크 -->
					<td>
						<? if($cur_m+1=="13"){?>
						<a href="<?=$PHP_SELF?>?cur_y=<?=$cur_y+1?>&cur_m=1&s_name=<?=$s_name?>"><img src="<?=$next_btn_icon?>"></a>
						<?}else{?>
						<a href="<?=$PHP_SELF?>?cur_y=<?=$cur_y?>&cur_m=<?=$cur_m+1?>&s_name=<?=$s_name?>"><img src="<?=$next_btn_icon?>"></a>
						<?}?>
					</td>
					<!-- /다음달 링크 -->

				</tr>
			</table>
		<!-- /년, 월 표기 -->






			<table width="1200" style="border-collapse:collapse;text-align:center;margin:5px 0;" border="1" bordercolor="e7e7e7" frame="hsides" align="center" cellpadding="2" cellspacing="0" class="sc">
				<tr height='30'>
					<td style="color:<?=$s_font_color01?>;">일</td>
					<td>월</td>
					<td>화</td>
					<td>수</td>
					<td>목</td>
					<td>금</td>
					<td style="color:<?=$s_font_color02?>;">토</td>
				</tr>



						<?
						while(!$week_end) {
						?>
						  <tr align="center" height='120'>
						<?
						   for($j=0; $j<7; $j++) {


							  if(!$start_chk && $start_day==$j) {
								 $dayno = 1;
								 $start_chk = true;
							  }

							  $sy = sprintf('%02d',$cur_y);
							  $sm = sprintf('%02d',$cur_m);
							  $sd = sprintf('%02d',$dayno);

								### 해당날짜에 등록된 업무일지확인 ###
								$sql = "select * from wo_daylog where userid='$s_name' and db_y='$sy' and db_m='$sm' and db_d='$sd'"; 
								$result = mysql_query($sql);
								$date_tot = mysql_num_rows($result);


							  if($dayno>0 && $dayno<=$tot_days) {
								 $colorstr = getDayColor($j, $dayno, $s_font_color01, $s_font_color02);

								 if($date_tot){	//등록된 일정이 있을경우....
									$bg_icon = "class='chkData'";
								 }else{
									$bg_icon = "";
								 }

								 $job_link = " onClick='javascript:Sel_date(\"$sy\",\"$sm\",\"$sd\")' style='cursor:hand'";

								 if($yy==$sy && $mm==$sm && $dd==$sd){   //오늘날짜의 칸 색
						?>
									<td bgcolor='<?=$s_bg_color01?>' <?=$job_link?> valign='top' align='left' <?=$bg_icon?>>
										<table cellpadding='0' cellspacing='0' border='0' width='20' height='20'>
											<tr>
												<td><?=$colorstr?></td>
											</tr>
										</table>
						<?
								 }else{
									?>
									<td <?=$job_link?> valign='top' align='left' <?=$bg_icon?>>
										<table cellpadding='0' cellspacing='0' border='0' width='20' height='20'>
											<tr>
												<td><?=$colorstr?></td>
											</tr>
										</table>
									</td>
									<?
								 }
								 $dayno++;
							  }else {
						  ?>
								 <td>&nbsp;</td>
						  <?
							  }
						   }
						   if($dayno>$tot_days) {
						   $week_end = true;
						   }
						?>
					</tr>
					<?
					}
					?>






			</table>
		</td>
	</tr>
</table>