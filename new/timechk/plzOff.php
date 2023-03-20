<?
	include '../module/class/class.DbCon.php';

	$sql = "select * from wo_member order by uid";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$userName = Array();

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$userid = $row['userid'];
		$name = $row['name'];

		$userName[$userid] = $name;
	}




	//연차신청내역
	$sql = "select * from wo_dayoff_plz order by rTime";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>





<title>아이웹-그룹웨어</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language='javascript' src='/module/js/common.js'></script>
<link type='text/css' rel='stylesheet' href='/css/button.css'>
<style type='text/css'>
body{background:none;}
</style>

<script language='javascript'>
function set_off(m){
    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('신청내역을 선택해 주세요.');
		return;
	}

	form = document.frm;
	form.type.value = m;
	form.action = 'plzOffProc.php';
	form.submit();
}
</script>

<form name='frm' method='post' action=''>
<input type='text' style='display:none;'>
<input type='hidden' name='type' value=''>


<?
	if($num){
?>
<div style='margin:10px 0;'>
	<span class='bco04' onclick="set_off('ok');">선택승인</span>
	<span class='bco08' onclick="set_off('no');">선택거절</span>
</div>
<?
	}
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable'>
	<tr>
		<th width='15%'>
			<div class="squaredBox">
				<input type="checkbox" value="" id="all_chk" name="all_chk" onclick="All_chk('all_chk','chk[]');">
				<label for="all_chk"></label>
			</div>
		</th>
		<th width='*'>성명</th>
		<th width='40%'>신청일</th>
	<tr>

<?
if($num){
	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$uid = $row['uid'];
		$userid = $row['userid'];
		$rDate = $row['rDate'];
		$rTime = $row['rTime'];
		$name = $userName[$userid];

		$yoil = date('w',$rTime);

		if($yoil == '0')			$yoil_txt = '<font color=#FF0000>일</font>';
		elseif($yoil == '1')	$yoil_txt = '월';
		elseif($yoil == '2')	$yoil_txt = '화';
		elseif($yoil == '3')	$yoil_txt = '수';
		elseif($yoil == '4')	$yoil_txt = '목';
		elseif($yoil == '5')	$yoil_txt = '금';
		elseif($yoil == '6')	$yoil_txt = '<font color=#0000FF>토</font>';
?>
	<tr>
		<td align='center'>
			<div class="squaredBox">
				<input type="checkbox" value="<?=$uid?>" id="chkBox<?=$uid?>" name="chk[]">
				<label for="chkBox<?=$uid?>"></label>
			</div>
		</td>
		<td align='center'><?=$name?></td>
		<td align='center'><?=$rDate?> (<?=$yoil_txt?>)</td>
	</tr>
<?
	}

}else{
?>
	<tr>
		<td align='center' colspan='3'>신청내역이 없습니다</td>
	</tr>
<?
}
?>
</table>

</form>