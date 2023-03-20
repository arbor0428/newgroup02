<?
	$record_count = 20;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));




	$query_ment = "where uid > 0";
	if($f_company)	$query_ment .= " and company like '%$f_company%'";
	if($f_person)	$query_ment .= " and person like '%$f_person%'";
	if($f_email)	$query_ment .= " and email like '%$f_email%'";
	if($f_fax){
		$query_ment .= " and (fax01 like '%$f_fax%' or fax02 like '%$f_fax%' or fax03 like '%$f_fax%')";
	}

	if($f_tel){
		$query_ment .= " and (tel01 like '%$f_tel%' or tel02 like '%$f_tel%' or tel03 like '%$f_tel%')";
	}

	if($f_hp){
		$query_ment .= " and (hp01 like '%$f_hp%' or hp02 like '%$f_hp%' or hp03 like '%$f_hp%')";
	}
	if($f_site_name)	$query_ment .= " and site_name like '%$f_site_name%'";
	if($f_domain)	$query_ment .= " and domain like '%$f_domain%'";







	$sort_ment = "order by sort desc";

	$query = "select * from wo_ing01 $query_ment $sort_ment";


	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_ing01 $query_ment $sort_ment limit $record_start, $record_count";

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

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
	<tr>
		<th>접수일</th>
		<th>순위</th>
		<th>상호</th>
		<th>업종</th>
		<th>중요도</th>
		<th>담당자</th>
		<th>일반전화</th>
		<th>제작기간</th>
		<th>마감시한</th>
		<th>진행률</th>
	</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$sort = $row["sort"];
		$person = $row["person"];
		$company = $row["company"];
		$upjong = $row["upjong"];
		$status = $row["status"];
		$tel01 = $row["tel01"];
		$tel02 = $row["tel02"];
		$tel03 = $row["tel03"];
		$date01 = $row["date01"];
		$edate01 = $row["edate01"];
		$edate02 = $row["edate02"];
		$edate03 = $row["edate03"];
		$playing = $row["playing"];

		$telephone = $tel01.'-'.$tel02.'-'.$tel03;
		if($date01)	$date01 = $date01.'일';

		$edate = '';

		if($edate01)	$edate = $edate01.'년 ';
		if($edate02)	$edate .= $edate02.'월 ';
		if($edate03)	$edate .= $edate03.'일';


		$reg_date = $row["reg_date"];
		$reg_date = date('Y-m-d',$reg_date);

		$date_diff = Util::dateDiff($SYSTEM_DATE,$reg_date);

		if($date_diff < 3)	 $new_icon = "<img src='../../images/common/new_file.gif'>";
		else	$new_icon = $reg_date;


		$java_link = 'reg_write';
		

		
?>

	<tr style='cursor:hand' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$new_icon?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$sort?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$company?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$upjong?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$status?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$person?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$telephone?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$date01?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$edate?></td>
		<td onclick="<?=$java_link?>('<?=$uid?>');"><?=$playing?></td>


	</tr>

<?
		$line_num++;
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="10" align='center'>없습니다</td>
	</tr>
<?
}
?>
</table>






<?
	$fName = 'form1';
	include '../pageNum.php';
?>