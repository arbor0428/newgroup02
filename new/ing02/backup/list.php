<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));


	if($play_sort){	//완료목록
		$table = "wo_ing02e";
		$cols = '10';

	}else{	//진행목록
		$table = "wo_ing02";
		$cols = '11';
	}



	if($field=='sort')	$sort_ment = "order by sort asc";
	elseif($field=='company')	$sort_ment = "order by binary(company) asc";
	elseif($field=='domain_date')	$sort_ment = "order by domain_date asc";
	elseif($field=='host_date')	$sort_ment = "order by host_date asc";
	else	$sort_ment = "order by sort asc";




	$query = "select * from $table $query_ment $sort_ment";


	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from $table $query_ment $sort_ment limit $record_start, $record_count";

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

function p_sort(mod){
	if(mod == '1')	fx = 'company';
	else	fx = 'sort';

	form = document.form1;
	form.type.value = '';
	form.field.value = fx;
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>



<form name='form1' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>





<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides">
	<tr>
		<td class='tit02' height='30'>접수일</td>
<?
	if($play_sort == ''){
?>
		<td class='tit02'>순위</td>
<?
	}
?>
		<td class='tit02'>상호</td>
		<td class='tit02'>중요도</td>
		<td class='tit02'>담당자</td>
		<td class='tit02'>일반전화</td>
		<td class='tit02'>제작기간</td>
		<td class='tit02'>마감시한</td>
		<td class='tit02'>도메인</td>
		<td class='tit02'>호스팅</td>
		<td class='tit02'>
			<select name='play_sort' onchange='p_sort(this.value);'>
				<option value=''>진행중</option>
				<option value='1' <?if($play_sort) echo 'selected';?>>완료</option>
			</select>
		</td>
	</tr>

</form>	

<?

$today_time = mktime(0,0,0,date('m'),date('d'),date('Y'));

if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$sort = $row["sort"];
		$person = $row["person"];
		$staff = $row["staff"];
		$company = $row["company"];
		$status = $row["status"];
		$tel01 = $row["tel01"];
		$tel02 = $row["tel02"];
		$tel03 = $row["tel03"];
		$date01 = $row["date01"];
		$edate01 = $row["edate01"];
		$edate02 = $row["edate02"];
		$edate03 = $row["edate03"];
		$playing = $row["playing"];
		$domain_date = $row["domain_date"];
		$host_date = $row["host_date"];
		$virtualhost = $row["virtualhost"];

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

		$Dday01 = '';
		$Dday02 = '';

		if($domain_date)	$Dday01 = intval(($domain_date - $today_time) / 86400).'일';
		if($host_date)	$Dday02 = intval(($host_date - $today_time) / 86400).'일';

		
?>

	<tr style='cursor:hand' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td class='tit04' height='30' onclick="<?=$java_link?>('<?=$uid?>');"><?=$new_icon?></td>
<?
	if($play_sort == ''){
?>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$sort?></td>
<?
	}
?>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$company?></td>		
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$status?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$person?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$telephone?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$date01?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$edate?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$Dday01?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$Dday02?><?if($virtualhost) echo "($virtualhost)";?></td>
		<td class='tit04' onclick="<?=$java_link?>('<?=$uid?>');"><?=$playing?></td>


	</tr>

<?
		$line_num++;
		$i--;
	}
}else{
?>
	<tr> 
		<td colspan="<?=$cols?>" align='center'>데이터가 없습니다.</td>
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