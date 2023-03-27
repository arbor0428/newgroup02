<?
	$record_count = 20;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));


	$query_ment = "where uid > 0";

	if($f_mtype)	$query_ment .= " and mtype='$f_mtype'";
	if($f_company)	$query_ment .= " and company like '%$f_company%'";
	if($f_name)	$query_ment .= " and name like '%$f_name%'";
	if($f_homepage)	$query_ment .= " and homepage like '%$f_homepage%'";
	if($f_telephone)	$query_ment .= " and telephone like '%$f_telephone%'";




	$sort_ment = "order by uid desc";

	$query = "select * from wo_bus02 $query_ment $sort_ment";


	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_bus02 $query_ment $sort_ment limit $record_start, $record_count";

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

<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
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
		<th>번호</th>
		<th>분류</th>
		<th>업체명</th>
		<th>담당자</th>
		<th>홈페이지</th>
		<th>전화번호</th>
	</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$mtype = $row["mtype"];
		$company = $row["company"];
		$name = $row["name"];
		$homepage = $row["homepage"];
		$telephone = $row["telephone"];
		$reg_date = $row["reg_date"];
		$reg_date = date('Y-m-d',$reg_date);

		$date_diff = Util::dateDiff($SYSTEM_DATE,$reg_date);

		if($date_diff < 3)	 $new_icon = "<img src='../../images/common/new_file.gif'>";
		else	$new_icon = $i;

		if($homepage)	 $homepage = "<a href='http://".$homepage."' target='_blank'>".$homepage."</a>";



		$java_link = 'reg_write';
		

		
?>

	<tr style='cursor:hand' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$new_icon?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$mtype?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$company?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$name?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$homepage?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$telephone?></td>
	</tr>

<?
		$line_num++;
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="6" align='center'>없습니다</td>
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