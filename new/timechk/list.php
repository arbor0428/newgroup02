<?

//����
//$setTime = mktime(8,40,50,8,9,2021);
//$sql = "update wo_timechk set state='-', in_date='$setTime', in_ip='106.246.92.237' where uid=16121";
//$sql = "update wo_timechk set out_date='$setTime', out_ip='106.246.92.237', ment='' where uid=15845";
//$result = mysql_query($sql);


/*
//�߰�
$setTime01 = mktime(10,00,0,5,6,2021);
$setTime02 = mktime(18,00,0,5,6,2021);
$setTime03 = mktime(0,0,0,5,6,2021);
$sql = "insert into wo_timechk (userid,to_y,to_m,to_d,to_w,state,ment,in_date,out_date,in_ip,out_ip,reg_date,rTime) values ('dlwlswl00','2021','05','06','��','-','','$setTime01','$setTime02','106.246.92.237','106.246.92.237','$setTime01','$setTime03')";
$result = mysql_query($sql);
*/


	if(!$f_userid)	$f_userid = $GBL_USERID;
	if(!$f_year)		$f_year = date('Y');
	if(!$f_month)	$f_month = date('m');
	$f_day = date('d');

	$day_last = Date("t",MkTime('0','0','0',$f_month,$f_day,$f_year));	//�ش���� ��������


	//��������
	include 'lun2sol.php';


	//�ش� ������ �Ի�⵵
	$sql = "select * from wo_member where userid='$f_userid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$idate01 = $row['idate01'];

	//�ٹ����
	$wYear = $f_year - $idate01;

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

	//��ȸ���ڱ��� ����� ������
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

	//���� ������
	$ModOff = $DayOff - $UseOff;






	//��ȸ���ڱ��� ��û�� ����
	$sql = "select * from wo_dayoff_plz where userid='$f_userid' and rTime>=$sTime and rTime<=$eTime";
	$result = mysql_query($sql);
	$PlzOff = mysql_num_rows($result);

	$PlzArr = Array();

	for($i=0; $i<$PlzOff; $i++){
		$row = mysql_fetch_array($result);
		$PlzArr[$i] = $row['rTime'];
	}


	//������ ������û����
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
	document.getElementById("multi_ttl").innerHTML = f_year+'�⵵ ���³��� - ['+userName+']';
	document.getElementById("multiFrame").innerHTML = "<iframe src='detail.php?userid="+userID+"&chkYear="+f_year+"' width='900' height='660' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
}

function daysViewer(){

	document.getElementById("multi_ttl").innerHTML = '���ں� �󼼳���';
	document.getElementById("multiFrame").innerHTML = "<iframe src='days.php' width='500' height='660' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
}

function offViewer(){
	f_year = $("#f_year").val();
	document.getElementById("multi_ttl").innerHTML = f_year+'�⵵ ������Ȳ';
	document.getElementById("multiFrame").innerHTML = "<iframe src='detailOff.php?chkYear="+f_year+"' width='900' height='660' frameborder='0' scrolling='no'></iframe>";
	$(".multiBox_open").click();
}

function plzViewer(){
	document.getElementById("multi_ttl").innerHTML = '������û����';
	document.getElementById("multiFrame").innerHTML = "<iframe src='plzOff.php' width='400' height='660' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
}

function popClose(){
	$(".multiBox_close").click();
}
</script>

<!-- �˻� -->
<form name='form1' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- �ؽ�Ʈ�ڽ� 1���̻� ó��.. �ڵ����۹��� -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='sTime' value='<?=$sTime?>'>
<input type='hidden' name='eTime' value='<?=$eTime?>'>



<div class="search_container">
	<div class="search_wrap">
		<div class="search_row">
			<div class="search_th">��ȸ����</div>
			<div class="search_td">
				<select name='f_year' id='f_year' onchange='set_search();'>
					<?
						for($i=2009; $i<=date('Y'); $i++){
							if($f_year == $i)	$sel = 'selected';
							else	$sel = '';

							echo ("<option value='$i' $sel>$i</option>");
						}
					?>
				</select>��&nbsp;

				<select name='f_month' onchange='set_search();'>
					<?
						for($i=1; $i<=12; $i++){
							if($f_month == $i)	$sel = 'selected';
							else	$sel = '';

							$var = sprintf('%02d',$i);

							echo ("<option value='$var' $sel>$i</option>");
						}
					?>
				</select>��
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">������ (�߻�/���)</div>
			<div class="search_td">
				<?=$DayOff?> / <?=$UseOff?>
			</div>
		</div>

		<div class="search_row">
			<div class="search_th">�����</div>
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
			<div class="search_th">���� ����</div>
			<div class="search_td">	<?=$ModOff?>	</div>
		</div>

	</div>
</div>
<div class="serach_btn-wrap">
	<a href="javascript:timeViewer();" class='btn_primary02'>����ڷẸ��</a>
	<a href="javascript:daysViewer();" class='btn_primary02'>���ں�����</a>

	<a href="javascript:offViewer();" class='btn_primary02'>������Ȳ</a>
	<a href="javascript:plzViewer();" class='btn_primary02'>��û���� (<?=$plzTot?>)</a>
</div>








<div style='margin-bottom:3px;'><a href="javascript:set_off();" class="btn_primary03">��������</a></div>

<div class="mobile_scroll">

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
	<tr>
		<th>
			<div class="squaredBox">
				<input type="checkbox" value="" id="all_chk" name="all_chk" onclick="All_chk('all_chk','chk[]');">
				<label for="all_chk"></label>
			</div>
		</th>
		<th>����</th>
		<th>����</th>
		<th>����</th>
		<th>��ٽð�</th>
		<th>���IP</th>
		<th>��ٽð�</th>
		<th>���IP</th>
		<th width='20%'>����</th>
	</tr>



<?

$late = 0;
$no = 0;
$to_y = date('Y');
$to_m = date('m');
$to_d = date('d');

$toTime = mktime(0,0,0,$to_m,$to_d,$to_y);

$onedate_time = 0;	//�Ϸ� �ٹ��ð� Ÿ�Ӱ�
$work_tot_time = 0;	//�� �ٹ��ð� Ÿ�Ӱ�
$work_date = 0;	//�ٹ��ð��� ���� �ϼ�


for($i=1; $i<=$day_last; $i++){
	$day = sprintf('%02d',$i);
	$date = $f_year.'-'.$f_month.'-'.$day;

	$onedate_chktime = '';	//�Ϸ�ٹ��ð�
	$uid = '';

	//����
	$wtime = mktime(0,0,0,$f_month,$i,$f_year);
	$yoil = date('w',$wtime);

	if($yoil == '0')	$yoil_txt = '<font color=#FF0000>��</font>';
	elseif($yoil == '1')	$yoil_txt = '��';
	elseif($yoil == '2')	$yoil_txt = 'ȭ';
	elseif($yoil == '3')	$yoil_txt = '��';
	elseif($yoil == '4')	$yoil_txt = '��';
	elseif($yoil == '5')	$yoil_txt = '��';
	elseif($yoil == '6')	$yoil_txt = '<font color=#0000FF>��</font>';

	if($to_y == $f_year && $to_m == $f_month && $i<=$f_day){	//�̹����� ��� 1�Ϻ��� �����ϱ����� ����
		$chk_if = '1';
	}elseif($to_y != $f_year || $to_m != $f_month){	//�̹����� �ƴѰ�� 1�Ϻ��� �������ϱ��� ���ν���
		$chk_if = '2';
	}else{
		$chk_if = '';
	}

	$in_device = '';
	$out_device = '';

	if($chk_if && ($yoil>0 && $yoil<7)){	//�ش���� 1�Ϻ��� ���ñ��� ���ϸ� ������ ����
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

			if($state == '����')	$late++;

			$no++;

			//�����ٽð�
			$cut_s = explode(':',$in_txt);
			$avr_mktime = mktime($cut_s[0],$cut_s[1],0,$to_m,$to_d,$to_y);
			$tot_mktime += $avr_mktime;

/*
			//����� �ð� ��� �ִ� ���Ͽ��� �ٹ��ð��� ����Ѵ�.
			if($yoil>0 && $yoil<6){
				if($in_date && $out_date){
					$onedate_time = $out_date - $in_date - 3600;	 //�Ϸ� �ٹ��ð� Ÿ�Ӱ�(���ɽð�����)
					$work_tot_time += $onedate_time;
					$work_date += 1;



					//�Ϸ� �ٹ��ð� ���
					$rest_hours = $onedate_time % 86400;

					$diff_in_hours = floor($rest_hours / 3600); 

					$rest_mins = $rest_hours % 3600; 
					$diff_in_mins = floor($rest_mins / 60); 
					$diff_in_secs = floor($rest_mins % 60);

					$onedate_chktime = $diff_in_hours.'�ð� '.$diff_in_mins.'��';

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


	//����Ȯ��
	if(in_array($wtime,$OffArr)){
		$dayOffChk = 'checked';
		$ment = " <span class='ico03'>����</span>";
	}else{
		$dayOffChk = '';
	}


	//������ûȮ��
	if(in_array($wtime,$PlzArr))		$dayPlzChk = '1';
	else									$dayPlzChk = '';


	$hollName = '';

	//����Ȯ��
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
			<span class='bco04' onclick="off_ok('<?=$wtime?>');">����</span>
			<span class='bco08' onclick="off_no('<?=$wtime?>');">����</span>

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
		if($no)	$tot_day = $no.'��';
		else	$tot_day = '-';

		if($late)	$tot_late = $late.'��';
		else	$tot_late = '-';

		$tot_time = $tot_mktime / $no;
		$tot_time = date('H:i',$tot_time);


		if($work_tot_time){

			$wwtime = $work_tot_time / $work_date;
			//�� �ٹ��ð� ���
			$rest_hours = $wwtime % 86400;

			$diff_in_hours = floor($rest_hours / 3600); 

			$rest_mins = $rest_hours % 3600; 
			$diff_in_mins = floor($rest_mins / 60); 
			$diff_in_secs = floor($rest_mins % 60);

			$totdate_chktime = $diff_in_hours.'�ð� '.$diff_in_mins.'��';
		}


?>

<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides">
	<tr>
		<td class='tit02' height='30' width='13%'>����ϼ�</td>
		<td class='tit04' width='20%'><?=$tot_day?></td>
		<td class='tit02' width='13%'>�����ϼ�</td>
		<td class='tit04' width='20%'><?=$tot_late?></td>
		<td class='tit02' width='14%'>�����ٽð�</td>
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