<?
//--------------------------------------------------------------------
//  PREVIL Calendar
//
//  - calendar.php / lun2sil.php(open source)
//
//  - Programmed by previl(previl@hanmail.net, http://dev.previl.net)
//  
//--------------------------------------------------------------------

?>

<style>
.all { border-width:1; border-color:#cccccc; border-style:solid; }
font {font-family:����ü; font-size: 12px; color:#505050;}
font.title {font-family: ����ü; font-size: 12px; font-weight: bold; color:#2579CF;}


.week {font-family:����,����ü;background-color:#eeeeee;color:#464646;font-size:12px;font-weight:bold;letter-spacing:-1;height:30px;}


.sholy{font-family:tahoma; font-size:12px; color:#FF6C21;text-decoration: none;}
.sholy:link{font-family:tahoma; font-size:12px; color:#FF6C21;text-decoration: none;}
.sholy:hover{font-family:tahoma; font-size:12px; color:#FF6C21;text-decoration: none;font-weight:bold;}
.sholy:visited{font-family:tahoma; font-size:12px; color:#FF6C21;text-decoration: none;}
.sholy:active{font-family:tahoma; font-size:12px; color:#FF6C21;text-decoration: none;}

.ssat{font-family:tahoma; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}
.ssat:link{font-family:tahoma; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}
.ssat:hover{font-family:tahoma; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}
.ssat:visited{font-family:tahoma; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}
.ssat:active{font-family:tahoma; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}

.snum{font-family:tahoma; font-size:12px;color:#505050;text-decoration: none;}
.snum:link{font-family:tahoma; font-size:12px;color:#505050;text-decoration: none;}
.snum:hover{font-family:tahoma; font-size:12px;color:#505050;text-decoration: none;font-weight:bold;}
.snum:visited{font-family:tahoma; font-size:12px;color:#505050;text-decoration: none;}
.snum:active{font-family:tahoma; font-size:12px;color:#505050;text-decoration: none;}

.snum2{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;}
.snum2:link{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;}
.snum2:hover{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.snum2:visited{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;}
.snum2:active{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;}

.sover{font-family:tahoma; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}


.sover2{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;;font-weight:bold;}
.sover2:link{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;;font-weight:bold;}
.sover2:hover{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.sover2:visited{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;;font-weight:bold;}
.sover2:active{font-family:tahoma; font-size:12px; color:#bbbbbb;text-decoration: none;;font-weight:bold;}



</style>

<?
//--------------------------------------------------------------------
//  FUNCTION
//--------------------------------------------------------------------
include "lun2sol.php";   //������ȯ ��Ŭ���

function ErrorMsg($msg)
{
  echo " <script>                ";
  echo "   window.alert('$msg'); ";
  echo "   history.go(-1);       ";
  echo " </script>               ";
  exit;
}

function SkipOffset($no,$sdate='',$edate='')
{  
  for($i=1;$i<=$no;$i++) { 
    $ck = $no-$i+1;
    if($sdate) $num = date('d',$sdate-((3600*24)*$ck));
	if($edate) $num=$i;
    echo "  <TD align=center><a href='/' class=snum2>$num</a></TD> \n";	
  }
}

//---- ���� ��¥
$thisyear  = date('Y');  // 2000
$thismonth = date('n');  // 1, 2, 3, ..., 12
$today     = date('j');  // 1, 2, 3, ..., 31

//------ $year, $month ���� ������ ���� ��¥
if (!$year=$HTTP_POST_VARS['year']) $year = $thisyear;
if (!$month=$HTTP_POST_VARS['month']) $month = $thismonth;
if (!$day=$HTTP_POST_VARS['day']) $day = $today;

//------ ��¥�� ���� üũ
if (($year > 2038) or ($year < 1900)) ErrorMsg("������ 1900~2038�⸸ �����մϴ�.");
if (($month > 12) or ($month < 0)) ErrorMsg("���� 1~12�� �����մϴ�.");
/*
while (checkdate($month,$day,$year)): 
    $date++; 
endwhile; 
$maxdate = date-1;
*/
$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));   // the final date of $month

if ($day>$maxdate) ErrorMsg("$month �� ���� $lastday ���� ������ ���Դϴ�.");

$prevmonth = $month - 1;
$nextmonth = $month + 1;
$prevyear = $nextyear=$year;
if ($month == 1) {
  $prevmonth = 12;
  $prevyear = $year - 1;
} elseif ($month == 12) {
  $nextmonth = 1;
  $nextyear = $year + 1;
}

/****************** ���� ���� ************************/
$HOLIDAY = Array();
$HOLIDAY[] = array(0=>'1-1',1=>'����'); 
$HOLIDAY[] = array(0=>'3-1',1=>'������');
//$HOLIDAY[] = array(0=>'4-5',1=>'�ĸ���');
$HOLIDAY[] = array(0=>'5-5',1=>'��̳�');
$HOLIDAY[] = array(0=>'6-6',1=>'������');
//$HOLIDAY[] = array(0=>'7-17',1=>'������');
$HOLIDAY[] = array(0=>'8-15',1=>'������');
$HOLIDAY[] = array(0=>'10-3',1=>'��õ��');
$HOLIDAY[] = array(0=>'10-9',1=>'�ѱ۳�');
$HOLIDAY[] = array(0=>'12-25',1=>'��ź��');

$tmp = lun2sol($year."0101");   //����
$HOLIDAY[] = array(0=>date("n-j",($tmp-(3600*24))),1=>'������');
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'����');
$HOLIDAY[] = array(0=>date("n-j",($tmp+(3600*24))),1=>'������');;

$tmp = lun2sol($year."0408");   //��ź��
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'��ź��');

$tmp = lun2sol($year."0815");   //�߼�
$HOLIDAY[] = array(0=>date("n-j",($tmp-(3600*24))),1=>'�߼�����');;
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'�߼�');;
$HOLIDAY[] = array(0=>date("n-j",($tmp+(3600*24))),1=>'�߼�����');;

unset($tmp);

/****************** ���� ���� ************************/

?>

<table cellSpacing='0' cellPadding='0' width='<?=$tablew?>' border='0'>
	<tr>
		<td style='padding-top:9px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>	
				<tr>
					<td width='35'></td>
					<td align='center'>
						<table cellSpacing='0' cellPadding='0' border='0'>
							<tr>
								<td><a href="javascript:setCalendar('<?=$prevyear?>','<?=$prevmonth?>');" onfocus='this.blur()'><img src='../../board/img/prev2.gif' border='0' onfocus='this.blur();' align='absmiddle'></a></td>
								<td style='padding:0 10 0 10;' align='center'><font class='title'><?=$year?>�� <?=$month?>��</font></td>
								<td><a href="javascript:setCalendar('<?=$nextyear?>','<?=$nextmonth?>');" onfocus='this.blur()'><img src='../../board/img/next2.gif' border='0' onfocus='this.blur();' align='absmiddle'></a></td>
							</tr>
						</table>
					</td>
					<td width='35' align='right' style='padding:0px 3px 0px 0px;'><a href="javascript:SetPageName();"><img src='./img/more01.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height='5'></td>
	</tr>
	<tr>
		<td align='center'>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides" class='s'>
				<tr align='center'>
					<td width='14%' class='week'>��</td>            
					<td width='14%' class='week'>��</td>
					<td width='14%' class='week'>ȭ</td>
					<td width='14%' class='week'>��</td>
					<td width='14%' class='week'>��</td>
					<td width='14%' class='week'>��</td>
					<td width='14%' class='week'>��</td>
				</tr>

				<tr height=<?=$cellh?>>


        <!-- ��¥ ���̺� -->


<?

$date   = 1;
$offset = 0;
$ck_row=0; //������ ������ ������ ���� üũ����

while ($date <= $maxdate) {   
   if ($date < 10) $date2 = "&nbsp;".$date;
   else $date2 = $date;
   if($date == '1') {
    $offset = date('w', mktime(0, 0, 0, $month, $date, $year));  // 0: sunday, 1: monday, ..., 6: saturday
//	SkipOffset($offset,mktime(0, 0, 0, $month, $date, $year));
	$no = $offset;
	$sdate = mktime(0, 0, 0, $month, $date, $year);
	$edate = '';
	include $c_path.'/SkipOffset.php';

   }
   if($offset == 0) $style ="sholy";
   else $style = "snum";

   $date_title = '';
   
   for($i=0;$i<count($HOLIDAY);$i++){	   
       if($HOLIDAY[$i][0] =="$month-$date") {
		   $style="sholy"; 
		   $date_title = "title='{$month}�� {$date}���� ".$HOLIDAY[$i][1]." �Դϴ�'";    
		   break;
       }	   
   }


   if($date == $today  &&  $year == $thisyear &&  $month == $thismonth){
	   $style = 'snum';
	   $tdgcolor = "bgcolor='#ededed'";

   }else{
	   $tdgcolor = '';
   }


	//�����쵥���͸� �����´�
//	$sql = "select * from ks_board_list where table_id='$table_id' and data01='$year' and data02='$month' and data03='$date' order by uid";
//	$result = mysql_query($sql);
//	$num = mysql_num_rows($result);

	if($num){
		$style = 'ssat';
		$date2_txt = "<a href=javascript:setView('$year','$month','$date'); class=$style>$date2</a>";
	}else{
		$date2_txt = "<span class=$style>$date2</span>";
	}


   //��¥���
	echo ("<td $tdgcolor align='center' $date_title>$date2_txt</td>");



  
  $date++;
  $offset++;

  if($offset == 7){
	  echo ("</tr>");
	  if($date <= $maxdate){
		  echo ("<tr height=$cellh>");
		  $ck_row++;
	  }
	  $offset = 0;
  }
} // end of while

if($offset != 0){
//  SkipOffset((7-$offset),'',mktime(0, 0, 0, $month, $date, $year));
  $no = 7-$offset;
  $sdate = '';
  $edate = mktime(0, 0, 0, $month, $date, $year);
  include $c_path.'/SkipOffset.php';
  echo ("</tr>");
}

?>
<!-- ��¥ ���̺� �� -->


				</td>
			</tr>
		</table>
	<tr>
		<td height=3></td>
	</tr>
</table>