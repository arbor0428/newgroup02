<?
	$record_count = 30;  //�� �������� ��µǴ� ���ڵ��

	$link_count = 10; //�� �������� ��µǴ� ������ ��ũ��

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));


	$query_ment = "where uid > 0";

	if($f_name)				$query_ment .= " and name like '%$f_name%'";
	if($f_manager)			$query_ment .= " and manager like '%$f_manager%'";
	if($f_site == 'naver')	$query_ment .= " and (naverID!='' or naverPW!='')";
	if($f_site == 'daum')	$query_ment .= " and (daumID!='' or daumPW!='')";
	if($f_naverID)			$query_ment .= " and naverID like '%$f_naverID%'";
	if($f_daumID)			$query_ment .= " and daumID like '%$f_daumID%'";
	if($f_staff)				$query_ment .= " and staff='$f_staff'";
	if($f_sname)			$query_ment .= " and staff like '%$f_sname%'";
	if($f_ment)				$query_ment .= " and ment like '%$f_ment%'";

	//��¥�˻�
	if($f_sDate){
		$sArr = explode('-',$f_sDate);
		$sTime = mktime(0,0,0,$sArr[1],$sArr[2],$sArr[0]);

		$query_ment .= " and rTime>='$sTime'";
	}

	if($f_eDate){
		$eArr = explode('-',$f_eDate);
		$eTime = mktime(23,59,59,$eArr[1],$eArr[2],$eArr[0]);

		$query_ment .= " and rTime<='$eTime'";
	}


	$sort_ment = "order by rTime desc, uid desc";

	$query = "select * from wo_searchad $query_ment $sort_ment";


	$result = mysql_query($query) or die("�������");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_searchad $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>



<script language='javascript'>
function reg_edit(uid){
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

<?
	include 'search.php';
?>

</form>

<div class="mobile_scroll">
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
	<tr>
		<th width='50'>��ȣ</th>
		<th>����(ȸ���)</th>
		<th>����ó</th>
		<th width='50'>���̹�</th>
		<th width='50'>����</th>
		<th>�����</th>
		<th width='120'>������ �����</th>
		<th width='120'>�����</th>
	</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$name = $row["name"];
		$phone01 = $row['phone01'];
		$phone02 = $row['phone02'];
		$phone03 = $row['phone03'];
		$naverID = $row['naverID'];
		$naverPW = $row['naverPW'];
		$daumID = $row['daumID'];
		$daumPW = $row['daumPW'];
		$manager = $row["manager"];
		$staff = $row["staff"];
		$rDate = $row["rDate"];

		$phone = '';
		if($phone01)	$phone = $phone01;
		if($phone02){
			if($phone)	$phone .= '-';
			$phone .= $phone02;
		}
		if($phone03){
			if($phone)	$phone .= '-';
			$phone .= $phone03;
		}

		$naver = '';
		if($naverID || $naverPW)	$naver = 'O';

		$daum = '';
		if($daumID || $daumPW)	$daum = 'O';
		
?>

	<tr style='cursor:pointer' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'" onclick="reg_edit('<?=$uid?>');">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td><?=$phone?></td>
		<td><?=$naver?></td>
		<td><?=$daum?></td>
		<td><?=$manager?></td>
		<td><?=$staff?></td>
		<td><?=$rDate?></td>
	</tr>

<?
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="8" align='center'>��ϵ� �ڷᰡ �����ϴ�</td>
	</tr>
<?
}
?>
</table>

</div>




<?
	$fName = 'form1';
	include '../pageNum.php';
	include $_SERVER["DOCUMENT_ROOT"].'/new/footer.php';
?>