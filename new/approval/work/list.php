<?
	//사원목록
	$query = "select * from wo_member where enable = '1' ";
	$result = mysql_query($query);
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap');
  .wrap {
    width: 100%;
    padding: 30px 5%;
    box-sizing: border-box;
		font-family: 'Noto Sans KR', sans-serif;
  }
  .work_week {
    width: 100%;
    text-align: center;
    margin-bottom: 20px;
    font-size: 2rem;
    font-weight: bold;
  }
  .work__table {
    width: 100%;
    text-align: center;
    border-collapse: collapse;
    border: 1px solid #f1f2fc;
    border-left: none;
    border-right: none;
  }
  .work__table tr:nth-child(odd) {
    background-color: #eee;
  }
  .work__table td,
  .work__table th {
    padding: 15px;
		font-family: 'Noto Sans KR', sans-serif;
  }
  .work__table th {
    background-color: #f1f2f9;
  }
	.work__table td {
		font-family: 'Noto Sans KR', sans-serif;
		font-size: 1rem;
		color: #000;
	}
  .work__table td a {
    text-decoration: none;
		font-size: 1rem;
    color: #000;
  }
  .team__name {
    writing-mode: vertical-lr;
  }
</style>

<div class="wrap">
  <form class="work__form" name='form1' method='post' action=''>
    <div class="work_week"><?=Date('Y년 m월 w주차')?></div>
    <table class="work__table">
      <tr>
        <th width="10%">팀</th>
        <th width="10%">이름</th>
        <th width="*">진행내용</th>
        <th width="15%">등록일</th>
      </tr>
<?
					
	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$name = $row["name"];
		$team = $row["team"];
?>
      <tr>
        <th><?=$team?></th>
        <td><?=$name?></td>
<?
		//사원별 진행중인 담당 업체
		$query2 = "select company from wo_ing02 where name = '$name' and playing = '진행' ";
		$result2 = mysql_query($query2);

		//업체 갯수
		$num = mysql_num_rows($result2);
		$row2 = mysql_fetch_array($result2);
		$company = $row2['company'];			
?>
        <td>
				<? if($num<1){?>
          <a onclick="reg_view('<?=$uid?>')">담당 업체 없음</a>
				<?}else {?>
					<a onclick="reg_view('<?=$uid?>')"><?=$company.' 외 '.$num.'개'?></a>
				<?}?>
        </td>
        <td><?=Date('Y-m-d')?></td>
      </tr>
<?
	}	
?>
    </table>
		<input type='hidden' name='type' value=''>
		<input type='hidden' name='uid' value='<?=$row['uid']?>'>
		<input type='hidden' name='num' value='<?=$row['num']?>'>
  </form>
</div>
<script>
	function reg_view(uid){
		const form = document.form1;
		form.type.value = 'view';
		form.uid.value = uid;
		form.action = '<?=$PHP_SELF?>';
		form.submit();
	}
	function leaveDelete(uid) {
		const form = document.form1;
		form.type.value = 'del';
		form.uid.value = uid;
		form.action = 'proc2.php';
		form.submit();
	}
</script>