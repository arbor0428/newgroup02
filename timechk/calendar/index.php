<?
	include '../../module/class/class.DbCon.php';

	if(!$calendarFile)	$calendarFile = 'calendar01.php';
	if(!$cellh)	$cellh = '30';	// date cell height
	if(!$tablew)	$tablew = '268';	// table width
	if(!$c_path) $c_path=".";



?>
<!-- 
/******************************************************************
* =======================================================
* Calendar
*
* �� ��: gubok kim (email : previl@hanmail.net,  homepage : http://previl.net)
*
* ������: 2005.06.01 
*
* ��Ÿ ���Ǵ� http://dev.previl.net �� ���ż� �Ͻñ� �ٶ��ϴ�.
*
* ������ȯ �κ��� �����ڷ�(lun2sol.php)�� �̿� �߽��ϴ�.
* �޷��� Ȩ�������� �����Ƕ���  <iframe>�� �̿� �Ͻñ� �ٶ��ϴ�.
* <iframe border='0' frameborder='0' framespacing='0' marginheight='0' marginwidth='0'  scrolling='no' src='(���/)calendar.php'  width='170' height='178' bgcolor=#ffffff></iframe>	
*
* =======================================================
******************************************************************/
-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>calendar</title>

<link href="/css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="/module/js/common.js" type="text/JavaScript"></script>

<script language='javascript'>
function SetPageName(){
	form = document.frm_cal;
	skin_num = form.skin_num.value;
	form.target = '_parent';
	form.action = '/skins/'+skin_num+'/subpage/sub02.php';
	form.submit();
}


function setCalendar(y,m){
	form = document.frm_cal;
	form.year.value = y;
	form.month.value = m;
	form.day.value = '1';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


<?
	if($chk_type == 'ok'){
		echo ("
			function setView(y,m,d){
				form = document.frm_cal;
				form.year.value = y;
				form.month.value = m;
				form.day.value = d;

				wschepop = window.open('about:blank', 'wschepop', 'scrollbars=yes,status=no,width=350,height=400,top=30,left=30');

				form.target = 'wschepop';
				form.action = 'view.php';
				form.submit();
			}");


	}else{
		echo ("
			function setView(y,m,d){
				alert('�б� ������ �����ϴ�');
				return;
			}");
	}

?>
</script>
</head>

<form name='frm_cal' method='post' action='<?=$PHP_SELF?>'>
<input type='hidden' name='GBL_MTYPE' value='<?=$GBL_MTYPE?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='calendarFile' value='<?=$calendarFile?>'>
<input type='hidden' name='cellh' value='<?=$cellh?>'>
<input type='hidden' name='tablew' value='<?=$tablew?>'>

<!-- �󼼺��� �������� �̵��� �ʿ��� ���� -->
<input type='hidden' name='SITE_ID' value='<?=$userid?>'>
<input type='hidden' name='skin_num' value='<?=$skin_num?>'>
<input type='hidden' name='mCade01' value='<?=$cade01?>'>
<input type='hidden' name='mCade02' value='<?=$cade02?>'>

<table cellpadding='0' cellspacing='0' border='0' width='100%' height='100%'>
	<tr>
		<td valign='top'>
		<?
			include $calendarFile;
		?>
		</td>
	</tr>
</table>

<input type='hidden' name='year' value='<?=$year?>'>
<input type='hidden' name='month' value='<?=$month?>'>
<input type='hidden' name='day' value=''>

</form>

<?
	//���������� ������ ����
/*
	if($ck_row==4) $height=178;
	else $height=198;

	echo ("<script>resizeTo(235,$height)</script>");
*/
?>

</body>
</html>
