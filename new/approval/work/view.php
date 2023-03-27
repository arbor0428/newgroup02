<?
	$sessionId = $_SESSION[ses_id];//현재 로그인중인 사람
	$sessionName = $_SESSION[ses_name];

	$uid = $_POST['uid'];
	$sql="select * from wo_member where uid = $uid";

	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);


function toWeekNum($timestamp) {
	$w = date('w', mktime(0,0,0, date('n',$timestamp), 1, date('Y',$timestamp)));
	return ceil(($w + date('j',$timestamp) -1) / 7);
}
$weekNo = toWeekNum(time());
//echo $weekNo;
	
?>
<style>
.wrap {
  width: 100%;
  padding: 30px 5%;
  box-sizing: border-box;
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
  border: 1px solid #647e7c;
  border-left: none;
  border-right: none;
}
.work__table tr:nth-child(even) {
  background-color: #eee;
}
.work__table td,
.work__table th {
  padding: 15px;
}
.work__table th {
  background-color: #afdad7;
}
.work__table td a {
  text-decoration: none;
  color: #000;
}
.team__name {
  writing-mode: vertical-lr;
}
input[type="text"],select,textarea {border: none;}

</style>

	<div class="wrap">
    <form class="work__form" id="frm" name="frm" method='post' action=''>
			<input type="hidden" name="type" />
			<input type="hidden" name="uid" value="<?=$uid?>"/>
			<input type="hidden" name="name" value="<?=$row['name']?>"/>
			<input type="hidden" name="userid" value="<?=$row['userid']?>"/>
			<input type="hidden" name="team" value="<?=$row['team']?>"/>
			<input type="hidden" name="date" value="<?=Date('Ymw')?>"/>

        <div class="work_week"><?=$weekNo?></div>
				<div class="work_week"><?=$row['team']." ".$row['name']?></div>
        <table class="work__table">
          <tr>            
            <th style="width: 10%;">상호</th>
            <th style="width: 5%;">구분</th>
            <th style="width: 5%;">경로</th>
            <th style="width: *">진행사항</th>
            <th style="width: 5%;">미수</th>
            <th style="width: 5%;">SW</th>           
            <th style="width: 5%;">스킨</th>
						<th style="width: 5%;"></th>
          </tr>
<?
	$name = $row['name'];	
	$query2 = "select * from wo_ing02 where name = '$name' and playing='진행' ";
	$result2 = mysql_query($query2);
	$arr = array();
	$arr2 = array();
	$arr3 = array();
	while( $row2 = mysql_fetch_array($result2)) {
		array_push($arr, $row2['company']);		
	}
	$sql3 = "select * from week_work where name='$name' ";
	$result3 = mysql_query($sql3);
	$row3 = mysql_fetch_array($result3);
?>

<?if($row3) { ?>
	<tr>                       
            <td>
							<input type="text" value="<?=$row3['company']?>" readonly />
						</td>
            <td>
							<input type="text" id="status" name="status" size="10" value="<?=$row3['status']?>"  readonly/>
						</td>
            <td>
							<input type="text" id="route" name="route" value="<?=$row3['route']?>" size="10" />
						</td>
            <td>
							<textarea id="ment" name="ment" style="width: 100%"><?=$row3['ment']?></textarea>
						</td>
            <td>
							<select id="money" name="money">
								<option value="" <?if($row3['money']=='') echo 'selected';?>>-</option>
								<option value="o" <?if($row3['money']=='o') echo 'selected';?>>O</option>
								<option value="x" <?if($row3['money']=='x') echo 'selected';?>>X</option>
							</select>
						</td>
            <td>
							<select id="sw" name="sw">
								<option value="" <?if($row3['software']=='') echo 'selected';?>>-</option>
								<option value="o" <?if($row3['software']=='o') echo 'selected';?>>O</option>
								<option value="x" <?if($row3['software']=='x') echo 'selected';?>>X</option>
							</select>
						</td>
            <td>
							<select id="skin" name="skin">
							<option value="" <?if($row3['skin']=='') echo 'selected';?>>-</option>
								<option value="o" <?if($row3['skin']=='o') echo 'selected';?>>O</option>
								<option value="x" <?if($row3['skin']=='x') echo 'selected';?>>X</option>
							</select>
						</td>
            <td>
							<a onclick="go_submit()"><span>확인</span></a>
						</td>
          </tr>

<?}else {?>
          <tr>                       
            <td>
							<select id="company" name="company">
								<option value="">업체선택</option>
								<option value="아이웹">아이웹</option>
						<?
								 for($i=0; $i<count($arr); $i++ ){
						?>
								<option value="<?=$arr[$i]?>"><?=$arr[$i]?></option>								
							<?}?>
							</select>
						</td>
            <td>
							<input type="text" id="status" name="status" size="10" readonly/>
						</td>
            <td>
							<input type="text" id="route" name="route" size="10" />
						</td>
            <td>
							<textarea id="ment" name="ment" style="width: 100%"></textarea>
						</td>
            <td>
							<select id="money" name="money">
								<option value="">-</option>
								<option value="o">O</option>
								<option value="x">X</option>
							</select>
						</td>
            <td>
							<select id="sw" name="sw">
								<option value="">-</option>
								<option value="o">O</option>
								<option value="x">X</option>
							</select>
						</td>
            <td>
							<select id="skin" name="skin">
								<option value="">-</option>
								<option value="o">O</option>
								<option value="x">X</option>
							</select>
						</td>
            <td>
							<a onclick="go_submit()"><span>확인</span></a>
						</td>
          </tr>
<?}?>
        </table>
      </form>
    </div>
<script>
function setCompany() {
	/*company = $("#company option:selected").val();
		$('#status').text("");
	if (company) {
			$.post('./jsonCompany.php', { company }, function(req){ // json 방식으로 전송하여 리턴값 받기.				
				var parData = JSON.parse(req) // 문자열 구문 분석, 객체생성
				status = parData['status'];
				 $('#status').text(status);		
			});
	}
*/
}
function go_submit() {
	var frm = document.frm;
	frm.type.value = 'write';
	frm.action = 'proc.php';
	frm.submit();
}


</script>
