<?
	$sessionId = $_SESSION[ses_id];//���� �α������� ���
	$sessionName = $_SESSION[ses_name];

	$uid = $_POST['uid'];
	$sql="select * from wo_leave where uid = $uid";

	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$doc_num = $row['doc_num'];
	$userid =$row['userid'];
	$name = $row['name'];
	$affil = $row['affil'];
	$team = $row['team'];
	$title = $row['title'];
	$text = $row['text'];
	$gubun = $row['gubun'];
	$date1 = $row['date1'];
	$sort1 = $row['sort1'];
	$date2 = $row['date2'];
	$sort2 = $row['sort2'];
	$elapsed = $row['elapsed'];
	$upfile01 =$row['upfile01'];
	$realfile01 =$row['realfile01'];
	$opinion  = $row['opinion'];
	$agree1 = $row['agree1'];
	$agree2 = $row['agree2'];
	$agree3 = $row['agree3'];
	$agree4 = $row['agree4'];
	$agree5 = $row['agree5'];
	$deal1 = $row['deal1'];
	$deal2= $row['deal2'];
	$deal3 = $row['deal3'];
	$deal4= $row['deal4'];
	$deal5 = $row['deal5'];
	$status = $row['status'];

	$valNum = 0;
	if($agree3 !== '') { $valNum = 3;	}
	if($agree4 !== '') {	$valNum = 4;	}
	if($agree5 !== '') {	$valNum = 5;	}

	$dealNum = 0;
	if($deal1 !== '') {	$dealNum = 1;	}
	if($deal2 !== '') {	$dealNum = 2;	}
	if($deal3 !== '') {	$dealNum = 3;	}
	if($deal4 !== '') {	$dealNum = 4;	}
	if($deal5 !== '') {	$dealNum = 5;	}


	$arr = array();
	$arr2 = array();

	for($i = 1; $i <=5; $i++) {
		$str = ${"agree".$i};
		$sql2 = "select * from wo_member where userid='$str' ";
		$result2 = mysql_query($sql2);
		$row2 = mysql_fetch_array($result2);

		$arr_unit = array(
				"userid" =>$row2['userid'],
				"name" => $row2['name'],
				"affil" => $row2['affil'],
				"team" => $row2['team']
		);
		array_push($arr,  $arr_unit);
	}


	for($i = 1; $i <=5; $i++) {
		$str = ${"deal" .$i};
		$sql3 = "select * from wo_member where userid='$str' ";
		$result3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($result3);
		$arr_unit2 = array(
				"userid" =>$row3['userid'],
				"name" => $row3['name'],
				"affil" => $row3['affil'],
				"team" => $row3['team']
		);
		array_push($arr2,  $arr_unit2);

	}

// ������ ���� ��������
	$sql4 = "select * from wo_leave_agree2 where num = '$doc_num' and category ='a' order by uid asc ";
	$result4 = mysql_query($sql4);

	$rowNum = mysql_num_rows($result4);
	$arr3 = array();//�������̸�
	$arr4 = array();//���� ����
	$arr5 = array();//��¥
	while($row4 = mysql_fetch_array($result4) ) {
		array_push($arr3, $row4['member_name']);
		array_push($arr4, $row4['status']);
		array_push($arr5, $row4['date']);
	}

// ������ ���� ��������
	$sql5 = "select * from wo_leave_agree2 where num = '$doc_num' and category ='d' order by uid asc ";
	$result5 = mysql_query($sql5);
	$arr6 = array();//�������̸�
	$arr7 = array();//���� ����
	$arr8 = array();//��¥
	while($row5 = mysql_fetch_array($result5) ) {
		array_push($arr6, $row5['member_name']);
		array_push($arr7, $row5['status']);
		array_push($arr8, $row5['date']);
	}



// ��¥ ���� �ٲٴ� �Լ�
	function formatDate ($sqlDate) {
		$phpdate = strtotime($sqlDate);
		$dateFormat = date("y.m.d.H:i", $phpdate);
		return $dateFormat;
	}

?>

<style>
<? include "./leave.css";?>
.dealTable {
  height: 150px;
  border-collapse: collapse;
  text-align: center;
  float: right;
  display: table;
  margin-right: 10px;
}
</style>

<div class="container">
    <header>
      <h1>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;û&nbsp;&nbsp;��</h1>
      <div class="logo">
        <img src="/images/iweblogo.jpg" alt="�ΰ�">
      </div>
      <div id="print_wrap">
				<button id="printBtn" class="no_print">�μ��ϱ�</button>
				<? if( ($arr4[1] =='���' ||  $arr4[1] =='����' ) && $sessionId == $arr[1]['userid'] ) {?>
					<a class="agreeBtn no_print" onclick="javascript:go_agree(<?=$uid?>);">����</a>
				<?}?>
      </div>
    </header>
  <main>
	<form  name="FRM" action="" method="post" id="frm">
			<input type="hidden" name="uid" value="<?=$uid?>" />
			<input type="hidden" name="type" value="" />
      <div class="agreeForm">
				<table class="agreeTable" id="agreeTableWrap">
          <tr id="agreeTr">
            <th rowspan="3" class="agreeTitle">��<br/><br/>��</th>
            <th id="agreeth1">�����</th>
            <th id="agreeth2"><?=$arr[1]['affil']?></th>
						<?
            if($agree3){
              for($i =2; $i<$valNum; $i++) {
            ?>
						<th id="agreeth<?=$i+1?>"><?=$arr[$i]['affil']?></th>
						<?
              }
            }
            ?>
          </tr>
          <tr id="agreeTr2">
            <td class="agreeWrap">
              <div class="sign">
							<?
              if($arr4[0]=='����') {
              ?>
							<!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
							����
              <?
              }
              ?>
							</div>
							<span>
								<input type="text" class="datetime" id="dateTime" name="status" value="<?=formatDate ($arr5[0]);?>" readonly />
							</span>
            </td>

            <td class="agreeWrap">
              <div class="sign" name="stauts">

								<? if( ($arr4[1] =='���' ||  $arr4[1] =='����' ) && $sessionId == $arr[1]['userid'] ) {?>
											<select class="agreeBtn" id="" name="agree2_status">
												<option value="���" <?if( $arr4[1] =='���') echo 'selected';?>>���</option>
												<option value="����">����</option>
												<option value="����" <?if( $arr4[1] =='����') echo 'selected';?>>����</option>
											</select>
								<?}?>
									<?if($arr4[1] =='����'){?>
											<!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
											����
									<?}?>
							</div>
								<?if($arr4[1] =='����'){?>
										<span>
											<input type="text" class="datetime" id="dateTime" value="<?=formatDate ($arr5[1]);?>" readonly />
										</span>
								<?}?>
            </td>

						<?
								if($agree3){
									for($i =2; $i<$valNum; $i++) {
						 ?>
								<td class="agreeWrap">
									<div class="sign" name="stauts">

										<? if(($arr4[$i] =='���' ||  $arr4[$i] =='����' ) && $sessionId == $arr[$i]['userid'] ) { ?>
							 						<select class="agreeBtn" id="" name="agree<?=$i+1?>_status" >
														<option value="���" <?if( $arr4[$i] =='���') echo 'selected';?>>���</option>
														<option value="����">����</option>
														<option value="����" <?if( $arr4[$i] =='����') echo 'selected';?>>����</option>
													</select>
										<?}?>
										<?if($arr4[$i] =='����'){?>
												<!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
												����
										<?}?>
									</div>
										<?if($arr4[$i] =='����'){?>
										<span>
											<input type="text" class="datetime" id="dateTime" value="<?=formatDate ($arr5[$i]);?>" readonly />
										</span>
										<?}?>
								</td>
							<?	}
								}
							 ?>
          </tr>
          <tr id="agreeTr3">
            <td>
              <input type="text" id="selectAgree1" class="selectAgree" name="agree1"value="<?=$arr[0]['name']?>" readonly  />
							<input type="hidden" id="selectAgree1Hidden"  class="hiddenSelect" name="userid1"  value="<?=$arr[0]['userid']?>" readonly  />
            </td>
            <td>
              <input type="text" id="selectAgree2" class="selectAgree" name="agree2" value="<?=$arr[1]['name']?>"readonly  />
							<input type="hidden" id="selectAgree2Hidden" class="hiddenSelect" name="userid2" value="<?=$arr[1]['userid']?>" />
            </td>
						<?
								if($agree3){
									for($i =2; $i<$valNum; $i++) {
						 ?>
							<td>
								<input type="text" id="selectAgree<?=$i+1?>" class="selectAgree" name="agree<?=$i+1?>" value="<?=$arr[$i]['name']?>"readonly  />
								<input type="hidden" id="selectAgree<?=$i+1?>Hidden" class="hiddenSelect" name="userid<?=$i+1?>" value="<?=$arr[$i]['userid']?>" />
							</td>
							<?	}
								}
							 ?>
          </tr>
        </table>
				<?if($deal1) { ?>
				<table class="dealTable" id="dealTable_1">
          <tr id="dealTr">
            <th rowspan="3" class="agreeTitle">��<br/><br/>��</th>
            <th id="dealth1"><?=$arr2[0]['affil']?></th>
           <?for($i = 2; $i<=$dealNum; $i++) { ?>
								<th id="dealth<?=$i?>"><?=$arr2[$i-1]['affil']?></th>
						<?}?>
          </tr>

          <tr id="dealTr2">
            <td class="agreeWrap">
              <div class="sign">
								<?if(($arr7[0] == '���' || $arr7[0] == '����') && $sessionId == $arr2[0]['userid']) { ?>
							 				<select class="agreeBtn" id="" name="deal1_status">
													<option value="���" <?if( $arr7[0] =='���') echo 'selected';?>>���</option>
													<option value="����">����</option>
													<option value="����" <?if( $arr7[0] =='����') echo 'selected';?>>����</option>
											</select>
									<?}?>
									<?if($arr7[0] == '����'){?>
												<!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
												����
									<?}?>
							</div>
							<?if($arr7[0] == '����'){?>
										<span>
											<input type="text" class="datetime" id="dateTime" value="<?=formatDate ($arr8[0]);?>" readonly />
										</span>
							<?}else if($arr7[0] == '���') {?>
										<span>
											<input type="text" class="datetime" id="dateTime" value="" readonly />
										</span>
							<?}?>
            </td>
						<?for($i = 2; $i<=$dealNum; $i++)  {?>
							<td class="agreeWrap">
              <div class="sign">
								<?if(($arr7[$i-1] == '���' || $arr7[$i-1] == '����') && $sessionId == $arr2[$i-1]['userid']) { ?>
							 				<select class="agreeBtn" id="" name="deal<?=$i?>_status">
													<option value="���" <?if( $arr7[$i-1] =='���') echo 'selected';?>>���</option>
													<option value="����">����</option>
													<option value="����" <?if( $arr7[$i-1] =='����') echo 'selected';?>>����</option>
											</select>
									<?}?>
									<?if($arr7[$i-1] =='����'){?>
												<!--	<img src="/images/dojang2.png" alt="����" class="dojang">	-->
												����
									<?}?>
							</div>
							<?if($arr7[$i-1] == '����'){?>
										<span>
											<input type="text" class="datetime" id="dateTime" value="<?=formatDate ($arr8[$i-1]);?>" readonly />
										</span>
							<?}?>
            </td>
						<?}?>
					</tr>
          <tr id="dealTr3">
            <td>
              <input type="text" id="selectDeal1" class="selectAgree" name="deal1" value="<?=$arr2[0]['name']?>" readonly />
							<input type="hidden" id="selectDeal1Hidden" class="selectAgree" value="<?=$arr2[0]['userid']?>" />
            </td>
           <?for($i = 2; $i<=$dealNum; $i++) { ?>
						<td>
              <input type="text" id="selectDeal<?=$i?>" class="selectAgree" name="deal<?=$i?>" value="<?=$arr2[$i-1]['name']?>" readonly />
							<input type="hidden" id="selectDeal<?=$i?>Hidden" class="selectAgree" value="<?=$arr2[$i-1]['userid']?>" />
            </td>
						<?}?>
          </tr>
        </table>
				<?}?>
      </div>

      <div id="submitForm" >
        <h2>1.&nbsp;&nbsp;��&nbsp;��&nbsp;��&nbsp;��</h2>
        <table class="formTable">
          <tr>
            <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;ȣ</th>
            <td>
							<input type='text' id="num" name='num' value='<?=$doc_num?>' readonly >
						</td>
          </tr>
          <tr>
            <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</th>
            <td>
              L2
            </td>
          </tr>
          <tr>
            <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</th>
            <td>
              5��
            </td>
          </tr>
          <tr>
            <th>��&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</th>
            <td>
              ����
            </td>
          </tr>
        </table>
        <table class="formTable2">
          <tr>
            <th>��&nbsp;&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;��</th>
            <td id="drafterWrap">
              <input type="text" value=<?=$name?>>
            </td>
          </tr>
          <tr>
            <th>��&nbsp;��&nbsp;&nbsp;/&nbsp;&nbsp;��&nbsp;å</th>
            <td >
							<input type='text' id="affil" name='affil' value='<?=$affil?>' readonly>
						</td>
          </tr>
          <tr>
            <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
            <td>
							<input type='text' id="team" name='team' value='<?=$team?>' readonly>
						</td>
          </tr>
          <tr>
            <th>��&nbsp;&nbsp;&nbsp��&nbsp&nbsp;&nbsp;ó</th>
            <td>
              �������
            </td>
          </tr>
        </table>
        <h2>2.&nbsp;&nbsp;��&nbsp;��&nbsp;��&nbsp;��</h2>
        <table class="inputTable">
          <tr class="inputForm">
            <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
            <td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="title " readonly><?=$title?></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
            <td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content" readonly><?=$text?></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>��&nbsp;��&nbsp;��&nbsp;��</th>
            <td id="dayoff_wrap">
						<input type="text" name="dayoff" id="dayoff" class="sort" value="<?=$gubun?>">
            </td>
          </tr>
          <tr class="inputForm">
            <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��</th>
            <td id="startdate_wrap">
						<input type="text" name="date1" id="date1" class="date " value="<?=$date1?>">
						<input type="text" name="sort1" id="sort1" class="readonly" value="<?=$sort1?>">
							<?if($date2) {?>
              <span id="hide">
                 ~
								 <input type="text" name="date2" id="date2" class="date" value="<?=$date2?>">
								 <input type="text" name="sort2" id="sort2" class="readonly" value="<?=$sort2?>">
              </span>
							<?}?>
							<span>(</span>
							<input type="text" id="elapsed" name="elapsed" value="<?=$elapsed?>" readonly />
              <span>�ϰ� )</span>
            </td>
          </tr>
        </table>
				<?if($upfile01 || $opinion) {?>
        <h2 id="etcTitle">3. ��Ÿ</h2>
        <table class="etcTable">
          <tr>
            <th>÷&nbsp;&nbsp; ��&nbsp;&nbsp; ��&nbsp;&nbsp; ��</th>
            <td>
              <input type="text" name="file" class="searchfileInput"  value="<?=$upfile01?>" readonly>
            </td>
          </tr>
          <tr>
            <th>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�� </th>
            <td><textarea name="opinion" id="opinion" rows="1" class="title" readonly><?=$opinion?></textarea></td>
          </tr>
        </table>
				<?}?>
				<table class="submitTable">
          <tr>
            <td colspan="2">
              <div class="tailContent">
                <p>���� ���� ǰ���Ͽ��� �簡 �Ͽ� �ֽñ� �ٶ��ϴ�.</p>
                <p id="today"></p>
              </div>
            </td>
          </tr>
        </table>
        <div class="headline">
          <button id="editBtn" class="editBtn no_print" onclick="go_edit(<?=$uid?>)">����</button>
        </div>
      </div>
		</form>
    </main>
    <footer>
      <h1>��&nbsp;&nbsp;��&nbsp;&nbsp;ȸ&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��&nbsp;&nbsp;��&nbsp;&nbsp;��</h1>
    </footer>
  </div>

<script>
	const sign2 = document.querySelector("#agreeTr2 > td:nth-child(2) > div");
	const sign3 = document.querySelector("#agreeTr2 > td:nth-child(3) > div");
	const sign4 = document.querySelector("#agreeTr2 > td:nth-child(4) > div");
	const sign5 = document.querySelector("#agreeTr2 > td:nth-child(5) > div");

	const priority = () => {
		if (sign2 != null && sign2.innerText != "����") {
			if ($(sign2).children().val() == "����") {
				return true;
			} else {
				return false;
			}
		} else if (sign3 != null && sign3.innerText != "����") {
			if ($(sign3).children().val() == "����") {
				return true;
			} else {
				return false;
			}
		} else if (sign4 != null && sign4.innerText != "����") {
			if ($(sign4).children().val() == "����") {
				return true;
			} else {
				return false;
			}
		} else if (sign5 != null && sign5.innerText != "����") {
			if ($(sign5).children().val() == "����") {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}


	function go_agree(uid) {
		if (priority()) {
			const form = document.FRM;
			form.uid.value = uid;
			form.type.value = 'agree';
			form.action = 'proc2.php';
			form.submit();
		} else {
			alert("���� ��� ���Դϴ�.");
			return false;
		}

	}
	function go_edit(uid) {
		const form = document.FRM;
		form.uid.value = uid;
		form.type.value = 'edit';
		form.action = '<?=$PHP_SELF?>';
		form.submit();
	}
</script>