<?
	$record_count = 20;  //�� �������� ��µǴ� ���ڵ��

	$link_count = 10; //�� �������� ��µǴ� ������ ��ũ��

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	if($GBL_MTYPE == 'A')		$qment = "where uid>0";
	else								$qment = "where enable='1'";		//�ٹ�

	$sort_ment = "order by enable desc, uid desc";

	$query = "select * from wo_member $qment $sort_ment";

	$result = mysql_query($query) or die("�������");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_member $qment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>

<script language='javascript'>

function reg_view(uid){
	form = document.form1;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_write(uid){
	form = document.form1;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>

<form name='form1' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- �ؽ�Ʈ�ڽ� 1���̻� ó��.. �ڵ����۹��� -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

</form>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
	<tr>
		<th>��ȣ</th>
		<th>���̵�</th>
		<th>����</th>
		<th>��</th>
		<th>�޴���ȭ</th>
		<th>�̸���</th>
		<th>�Ի���</th>
		<th>����</th>
	</tr>

<?
//�󿩱� ���
function bonusAmt($nDate){
	$nTime = strtotime($nDate);

	$jjambab = -1;

	while($nTime < time()){
		$nTime = strtotime("$nDate +12 month");
		$nDate = date('Ymd',$nTime);

		$jjambab++;
	}

	$bonus = 20 + (5 * $jjambab);
	$bonus *= 10000;

	return $bonus;
}


if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$name = $row["name"];
		$team = $row["team"];
		$mobile = $row["mobile"];
		$email = $row["email"];
		$idate01 = $row["idate01"];
		$idate02 = $row["idate02"];
		$idate03 = $row["idate03"];
		$bir01 = $row["bir01"];
		$bir02 = $row["bir02"];
		$bir03 = $row["bir03"];
		$enable = $row['enable'];

		$bonus = '';

		if(!$enable){
			$bg = "style=background:url('../img/bg_dot.gif');background-repeat:repeat-x;background-position:center center;";
		}else{
			$bg = '';
			if($GBL_MTYPE == 'A')		$bonus = "<br> +".number_format(bonusAmt($idate01.$idate02.$idate03));
		}

		$indate = '';
		if($idate01)		$indate = $idate01.'�� ';
		if($idate02)		$indate .= $idate02.'�� ';
		if($idate03)		$indate .= $idate03.'�� ';

		$birthday = '';
		if($bir01)	$birthday = $bir01.'�� ';
		if($bir02)	$birthday .= $bir02.'�� ';
		if($bir03)	$birthday .= $bir03.'�� ';

		if(($GBL_USERID == $userid) or ($GBL_MTYPE == 'A'))	$java_link = 'reg_write';
		else	$java_link = 'reg_view';		
?>

	<tr style='cursor:hand' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'" onclick="<?=$java_link?>('<?=$uid?>');">
		<td <?=$bg?>><?=$i?></td>
		<td <?=$bg?>><?=$userid?></td>
		<td <?=$bg?>><?=$name?></td>
		<td <?=$bg?>><?=$team?></td>
		<td <?=$bg?>><?=$mobile?></td>
		<td <?=$bg?>><?=$email?></td>
		<td <?=$bg?>><?=$indate?><?=$bonus?></td>
		<td <?=$bg?>><?=$birthday?></td>
	</tr>

<?
		$line_num++;
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="7" align='center'>�����ϴ�</td>
	</tr>
<?
}
?>
</table>






<?
	$fName = 'form1';
	include '../pageNum.php';
?>