<?
	$record_count = 20;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));


	$sort_ment = "order by uid desc";

	$query = "select * from wo_notice $sort_ment";


	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from wo_notice $sort_ment limit $record_start, $record_count";

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

function page(rs){
	form = document.form1;
	form.record_start.value = rs;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>



<form name='form1' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

</form>

<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides">
	<tr>
		<td class='tit02' height='30'>번호</td>
		<td class='tit02'>제목</td>
		<td class='tit02'>작성자</td>
		<td class='tit02'>작성일</td>
	</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$name = $row["name"];
		$title = $row["title"];
		$reg_date = $row["reg_date"];
		$reg_date = date('Y-m-d',$reg_date);


		if($GBL_USERID == $userid)	$java_link = 'reg_write';
		else	$java_link = 'reg_view';


		
?>

	<tr style='cursor:hand' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td class='tit04' height='30' onclick="<?=$java_link?>('<?=$uid?>');"><?=$i?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$title?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$name?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$reg_date?></td>

	</tr>

<?
		$line_num++;
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="4" align='center'>없습니다</td>
	</tr>
<?
}
?>
</table>






<!--페이지-->
<table border="0" align="center" cellpadding="1" cellspacing="0" style='margin-top:10px;'>
	<tr>
<?
if($total_record != '0'){
	if($total_record > $record_count){
		
		echo ("<td>");

		if($current_page * $record_count > $record_count * $link_count) {
			$pre_group_start = ($group * $record_count * $link_count) - $record_count;
			echo("<a href=javascript:page('$pre_group_start');><img src='../img/common/prev2.gif' width='22' height='13'></a>");
		}else{
			echo("<img src='../img/common/prev2.gif' width='22' height='13'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start !=0 )) {
			$pre_page_start = $record_start - $record_count;
			echo("<a href=javascript:page('$pre_page_start');><img src='../img/common/prev1.gif' width='39' height='13'></a>");
		}else{
			echo ("<img src='../img/common/prev1.gif' width='39' height='13'>");
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		for($i=0; $i<$link_count; $i++){
			$input_start = ($group * $link_count + $i) * $record_count; 

			$link = ($group * $link_count + $i) + 1;

			if($input_start < $total_record) {
				if($input_start != $record_start) {
					echo("<a href=javascript:page('$input_start');>$link</a>&nbsp;&nbsp;");
				} else {
					echo("<b>$link</b>&nbsp;&nbsp;");
				}
			}
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start != ($total_page * $record_count - $record_count))) {
			$next_page_start = $record_start + $record_count;
			echo("<a href=javascript:page('$next_page_start');><img src='../img/common/next1.gif' width='39' height='13'></a>");
		}else{
			echo ("<img src='../img/common/next1.gif' width='39' height='13'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_record > (($group + 1) * $record_count * $link_count)) {
			$next_group_start = ($group + 1) * $record_count* $link_count;
			echo("<a href=javascript:page('$next_group_start');><img src='../img/common/next2.gif' width='22' height='13'></a>");
		}else{
			echo ("<img src='../img/common/next2.gif' width='22' height='13'>");
		}

		echo ("</td>");



		  
	}else{
		echo "<td><b>1</b></td>";
	}
}
?>
	</tr>
</table>
<!--/페이지-->