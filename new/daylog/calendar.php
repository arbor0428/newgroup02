<?
$s_font_color01 = 'de712e';	 //�Ͽ��� ����
$s_font_color02 = '52809a';	//����� ����
$s_bg_color01 = 'EBF4F8';	//���ó�¥ ����
$pre_btn_icon = '/img/board/prev2.gif';	 //������ ��ũ �̹���
$next_btn_icon = '/img/board/next2.gif';	//������ ��ũ �̹���




//�ش���� �ѳ�¥���� ���Ѵ�.
function getTotaldays($y, $m) {
	$d = 1;
	while(checkdate($m, $d, $y)) {
		$d++;
	}

	$d = $d - 1;
	return $d;
}

//��,�Ͽ����� �������� �������ش�.
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

//�Ѿ���� ��������� ������ ���� �����..
if(!$cur_y)	$cur_y = date(Y);
if(!$cur_m)	 $cur_m = date(m);

//�ش� ����� �� ��¥���� ���Ѵ�.
$tot_days = getTotaldays($cur_y, $cur_m);

//�ش� ����� 1�Ͽ� �ش��ϴ� timestamp���� ���Ѵ�.
$tstamp = mktime(0,0,0,$cur_m,1,$cur_y);

//timestamp������ ��¥����(����)�� ���Ѵ�.
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
		<!-- ��, �� ǥ�� -->
			<table width="170" border="0" align="center" cellpadding="2" cellspacing="0" style="text-align:center;">
				<tr>
					<!-- ������ ��ũ-->
					<td>					
						<?if($cur_m-1=="0"){?>
						<a href="<?=$PHP_SELF?>?cur_y=<?=$cur_y-1?>&cur_m=12&s_name=<?=$s_name?>"><img src="<?=$pre_btn_icon?>"></a>
						<?}else{?>
						<a href="<?=$PHP_SELF?>?cur_y=<?=$cur_y?>&cur_m=<?=$cur_m-1?>&s_name=<?=$s_name?>"><img src="<?=$pre_btn_icon?>"></a>
						<?}?>
					</td>
					<!-- /������ ��ũ -->

					<td height="20"><strong><?=$cur_y?>�� <?=$cur_m?>��</b></strong></td>

					<!-- ������ ��ũ -->
					<td>
						<? if($cur_m+1=="13"){?>
						<a href="<?=$PHP_SELF?>?cur_y=<?=$cur_y+1?>&cur_m=1&s_name=<?=$s_name?>"><img src="<?=$next_btn_icon?>"></a>
						<?}else{?>
						<a href="<?=$PHP_SELF?>?cur_y=<?=$cur_y?>&cur_m=<?=$cur_m+1?>&s_name=<?=$s_name?>"><img src="<?=$next_btn_icon?>"></a>
						<?}?>
					</td>
					<!-- /������ ��ũ -->

				</tr>
			</table>
		<!-- /��, �� ǥ�� -->






			<table width="1200" style="border-collapse:collapse;text-align:center;margin:5px 0;" border="1" bordercolor="e7e7e7" frame="hsides" align="center" cellpadding="2" cellspacing="0" class="sc">
				<tr height='30'>
					<td style="color:<?=$s_font_color01?>;">��</td>
					<td>��</td>
					<td>ȭ</td>
					<td>��</td>
					<td>��</td>
					<td>��</td>
					<td style="color:<?=$s_font_color02?>;">��</td>
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

								### �ش糯¥�� ��ϵ� ��������Ȯ�� ###
								$sql = "select * from wo_daylog where userid='$s_name' and db_y='$sy' and db_m='$sm' and db_d='$sd'"; 
								$result = mysql_query($sql);
								$date_tot = mysql_num_rows($result);


							  if($dayno>0 && $dayno<=$tot_days) {
								 $colorstr = getDayColor($j, $dayno, $s_font_color01, $s_font_color02);

								 if($date_tot){	//��ϵ� ������ �������....
									$bg_icon = "class='chkData'";
								 }else{
									$bg_icon = "";
								 }

								 $job_link = " onClick='javascript:Sel_date(\"$sy\",\"$sm\",\"$sd\")' style='cursor:hand'";

								 if($yy==$sy && $mm==$sm && $dd==$sd){   //���ó�¥�� ĭ ��
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