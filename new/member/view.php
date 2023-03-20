<?

	if($uid){

		$sql = "select * from wo_member where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$name = $row["name"];
		$team = $row["team"];
		$mobile = $row["mobile"];
		$telephone = $row["telephone"];
		$email = $row["email"];
		$nate = $row["nate"];
		$addr = $row["addr"];
		$bir01 = $row["bir01"];
		$bir02 = $row["bir02"];
		$bir03 = $row["bir03"];
		$account = $row["account"];

		$birthday = '';
		if($bir01)	$birthday = $bir01.'년 ';
		if($bir02)	$birthday .= $bir02.'월 ';
		if($bir03)	$birthday .= $bir03.'일 ';
	}




?>



<script language='javascript'>
function reg_del(){
	
	if(confirm('글을 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_modify(){
	form = document.FRM;
	form.type.value = 'edit';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_reply(){
	form = document.FRM;
	form.type.value = 're_write';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}


</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">아이디</th>
					<td width="33%"><?=$userid?></td>
					<th width="17%">성명</th>
					<td width="33%"><?=$name?></td>
				</tr>

				<tr> 
					<th>팀</th>
					<td><?=$team?></td>
					<th>생일</th>
					<td><?=$birthday?></td>
				</tr>

				<tr> 
					<th>핸드폰</th>
					<td><?=$mobile?></td>
					<th>일반전화</th>
					<td><?=$telephone?></td>
				</tr>

				<tr> 
					<th>이메일</th>
					<td><?=$email?></td>
					<th>네이트</th>
					<td><?=$nate?></td>
				</tr>

				<tr> 
					<th>계좌번호</th>
					<td colspan='3'><?=$account?></td>
				</tr>

				<tr> 
					<th>주소</th>
					<td colspan='3'><?=$addr?></td>
				</tr>


			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>


					<td align='right'>
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>
					</td>

				</tr>
			</table>
		</td>
	</tr>
</table>






</form>

