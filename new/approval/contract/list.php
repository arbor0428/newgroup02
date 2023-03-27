<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	$query_ment = "where uid > 0";

	if($f_name)			$query_ment .= " and name like '%$f_name%'"; // 성명
	if($f_puse)			$query_ment .= " and puse like '%$f_puse%'"; // 사용용도

	$sort_ment = "order by uid desc";

	$query = "select * from wo_proof  $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);		//총갯수

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_proof $query_ment $sort_ment limit $record_start, $record_count";
	$result = mysql_query($query2);
?>

<style>

	.titt tr td {
		font-size:12px;
		color:#000;
		text-align:center;
	}

</style>

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

	function page(uid){
		form = document.form1;
		form.record_start.value = uid;
		form.action = '<?=$PHP_SELF?>';
		form.submit();
	}

	function reg_del(uid){
		
		if(confirm('해당 결재내역을 삭제하시겠습니까?')){
			form = document.form1;
			form.type.value = 'del';
			form.uid.value = uid;
			form.action = 'proc.php';
			form.submit();

		}
	}

</script>

<form name='form1' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>


<?
	include 'search.php';
?>
<!-- 리스트에 보이는 테이블 화면 -->
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
		<tr>
		<th>No.</th>
		<th>담당자</th>
		<th>상호</th>
		<th>대표자</th>
		<th>계약자</th>
		<th>계약조건</th>
		<th>계약날짜</th>
		<th>합계</th>
		<th>삭제</th>
	</tr>

<?

	if($total_record != '0'){
		$i = $total_record - ($current_page - 1) * $record_count;

		$line_num = 0;

		while($row = mysql_fetch_array($result)){

			$uid = $row["uid"];
			$userid = $row["userid"];
			$puse= $row["puse"];
			$status= $row["status"];
			
			//인사정보
			$sql01 = "select * from wo_member where userid='$userid'";
			$result01 = mysql_query($sql01);
			$row01 = mysql_fetch_array($result01);
			$name = $row01["name"];
			$team = $row01["team"];
			$affil = $row01["affil"];
			
			$idate01 = $row01["idate01"];
			$idate02 = $row01["idate02"];
			$idate03 = $row01["idate03"];
			$pdate01 = $row01["pdate01"];
			$pdate02 = $row01["pdate02"];
			$pdate03 = $row01["pdate03"];

			$idate = '';
			$idate = $idate01.'년 '.$idate02.'월 '.$idate03.'일';

			$pdate = '';
			$pdate = $pdate01.'년 '.$pdate02.'월 '.$pdate03.'일';

			if($status)	$statusTxt='승인';
			else			$statusTxt='미승인';
			
?>

	<tr height='30' style="cursor:hand;<?=$bimg?>" onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'" >
		<td class='tit04' onclick="reg_view('<?=$uid?>');"><?=$uid?></td>
		<td class='tit04' onclick="reg_view('<?=$uid?>');"><?=$name?></td>
		<td class='tit04' onclick="reg_view('<?=$uid?>');"><?=$team?></td>
		<td class='tit04' onclick="reg_view('<?=$uid?>');"><?=$affil?></td>
		<td class='tit04' onclick="reg_view('<?=$uid?>');"><?=$idate?></td>
		<td class='tit04' onclick="reg_view('<?=$uid?>');"><?=$pdate?></td>
		<td class='tit04' onclick="reg_view('<?=$uid?>');"><?=$puse?></td>
		<td class='tit04' onclick="reg_view('<?=$uid?>');"><?=$statusTxt?></td>
		<td class='tit04'><a href="javascript:reg_del('<?=$uid?>')" class='small cbtn black'>삭제</a></td>
	</tr>

<?
		$line_num++;
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="8" align='center'>등록된 자료가 없습니다</td>
	</tr>
<?
}
?>
</table>


</form>


<?
	$fName = '../../form1';
	include '../../pageNum.php';
?>