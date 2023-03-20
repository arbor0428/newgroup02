<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));


	$query_ment = "where uid > 0";

	if($f_mtype)		$query_ment .= " and mtype='$f_mtype'";
	if($f_status)		$query_ment .= " and status='$f_status'";
	if($f_name)		$query_ment .= " and name like '%$f_name%'";
	if($f_ceo)		$query_ment .= " and ceo like '%$f_ceo%'";
	if($f_staff)		$query_ment .= " and staff='$f_staff'";
	if($f_sname)	$query_ment .= " and staff like '%$f_sname%'";
	if($f_ment)		$query_ment .= " and ment like '%$f_ment%'";
	if($f_pnum)		$query_ment .= " and pnum like '%$f_pnum%'";

	//날짜검색
	if($f_sy){
		$start_date = mktime(0,0,0,$f_sm,$f_sd,$f_sy);
		$end_date = mktime(23,59,59,$f_em,$f_ed,$f_ey);

		$query_ment .= " and (rTime>='$start_date' and rTime<='$end_date')";
	}





	$sort_ment = "order by rTime desc, uid desc";

	$query = "select * from wo_lgu $query_ment $sort_ment";


	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_lgu $query_ment $sort_ment limit $record_start, $record_count";

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
		<th width='50'>번호</th>
		<th width='90'>담당자</th>
		<th width='90'>상태</th>
		<th width='150'>구분</th>
		<th width='150'>이용상품</th>
		<th>고객명(회사명)</th>
		<th>대표자명</th>
		<th>대표번호</th>
		<th width='120'>개통일</th>
	</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$staff = $row["staff"];
		$status = $row["status"];
		$mtype = $row["mtype"];
		$name = $row["name"];
		$ceo = $row["ceo"];
		$rDate = $row["rDate"];
		$service01 = $row["service01"];
		$service02 = $row["service02"];
		$service03 = $row["service03"];
		$service04 = $row["service04"];
		$service05 = $row["service05"];
		$service06 = $row["service06"];
		$pnum = $row["pnum"];

		$serviceTxt = '';

		for($s=0; $s<count($serviceArr); $s++){
			$v = sprintf('%02d',$s+1);
			if(${'service'.$v}){
				if($serviceTxt)	$serviceTxt .= '<br>';
				$serviceTxt .= $serviceArr[$s];
			}
		}

		if($status == '해지')	$bgimg = "style='cursor:pointer;background: url(/images/over_2line.gif);background-position:center center;background-repeat:repeat-x;'";
		else						$bgimg = "style='cursor:pointer;'";
		
?>

	<tr onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'" onclick="reg_edit('<?=$uid?>');" height='30' <?=$bgimg?>>
		<td><?=$i?></td>
		<td><?=$staff?></td>
		<td><?=$status?></td>
		<td><?=$mtype?></td>
		<td><?=$serviceTxt?></td>
		<td><?=$name?></td>
		<td><?=$ceo?></td>
		<td><?=$pnum?></td>
		<td><?=$rDate?></td>
	</tr>

<?
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="9" align='center'>등록된 자료가 없습니다</td>
	</tr>
<?
}
?>
</table>






<?
	$fName = 'form1';
	include '../pageNum.php';
?>