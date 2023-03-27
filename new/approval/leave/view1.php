<?
	$sessionId = $_SESSION[ses_id];//현재 로그인중인 사람
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

// 결재자 상태 가져오기
	$sql4 = "select * from wo_leave_agree2 where num = '$doc_num' and category ='a' order by uid asc ";
	$result4 = mysql_query($sql4);

	$rowNum = mysql_num_rows($result4);
	$arr3 = array();//결재자이름
	$arr4 = array();//결재 상태
	$arr5 = array();//날짜
	while($row4 = mysql_fetch_array($result4) ) {
		array_push($arr3, $row4['member_name']);
		array_push($arr4, $row4['status']);
		array_push($arr5, $row4['date']);
	}

// 합의자 상태 가져오기
	$sql5 = "select * from wo_leave_agree2 where num = '$doc_num' and category ='d' order by uid asc ";
	$result5 = mysql_query($sql5);
	$arr6 = array();//결재자이름
	$arr7 = array();//결재 상태
	$arr8 = array();//날짜
	while($row5 = mysql_fetch_array($result5) ) {
		array_push($arr6, $row5['member_name']);
		array_push($arr7, $row5['status']);
		array_push($arr8, $row5['date']);
	}



// 날짜 형식 바꾸는 함수
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
      <h1>휴&nbsp;&nbsp;가&nbsp;&nbsp;신&nbsp;&nbsp;청&nbsp;&nbsp;서</h1>
      <div class="logo">
        <img src="/images/iweblogo.jpg" alt="로고">
      </div>
      <div id="print_wrap">
				<button id="printBtn" class="no_print">인쇄하기</button>
				<? if( ($arr4[1] =='대기' ||  $arr4[1] =='보류' ) && $sessionId == $arr[1]['userid'] ) {?>
					<a class="agreeBtn no_print" onclick="javascript:go_agree(<?=$uid?>);">승인</a>
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
            <th rowspan="3" class="agreeTitle">결<br/><br/>재</th>
            <th id="agreeth1">담당자</th>
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
              if($arr4[0]=='승인') {
              ?>
							<!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
							승인
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

								<? if( ($arr4[1] =='대기' ||  $arr4[1] =='보류' ) && $sessionId == $arr[1]['userid'] ) {?>
											<select class="agreeBtn" id="" name="agree2_status">
												<option value="대기" <?if( $arr4[1] =='대기') echo 'selected';?>>대기</option>
												<option value="승인">승인</option>
												<option value="보류" <?if( $arr4[1] =='보류') echo 'selected';?>>보류</option>
											</select>
								<?}?>
									<?if($arr4[1] =='승인'){?>
											<!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
											승인
									<?}?>
							</div>
								<?if($arr4[1] =='승인'){?>
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

										<? if(($arr4[$i] =='대기' ||  $arr4[$i] =='보류' ) && $sessionId == $arr[$i]['userid'] ) { ?>
							 						<select class="agreeBtn" id="" name="agree<?=$i+1?>_status" >
														<option value="대기" <?if( $arr4[$i] =='대기') echo 'selected';?>>대기</option>
														<option value="승인">승인</option>
														<option value="보류" <?if( $arr4[$i] =='보류') echo 'selected';?>>보류</option>
													</select>
										<?}?>
										<?if($arr4[$i] =='승인'){?>
												<!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
												승인
										<?}?>
									</div>
										<?if($arr4[$i] =='승인'){?>
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
            <th rowspan="3" class="agreeTitle">합<br/><br/>의</th>
            <th id="dealth1"><?=$arr2[0]['affil']?></th>
           <?for($i = 2; $i<=$dealNum; $i++) { ?>
								<th id="dealth<?=$i?>"><?=$arr2[$i-1]['affil']?></th>
						<?}?>
          </tr>

          <tr id="dealTr2">
            <td class="agreeWrap">
              <div class="sign">
								<?if(($arr7[0] == '대기' || $arr7[0] == '보류') && $sessionId == $arr2[0]['userid']) { ?>
							 				<select class="agreeBtn" id="" name="deal1_status">
													<option value="대기" <?if( $arr7[0] =='대기') echo 'selected';?>>대기</option>
													<option value="승인">승인</option>
													<option value="보류" <?if( $arr7[0] =='보류') echo 'selected';?>>보류</option>
											</select>
									<?}?>
									<?if($arr7[0] == '승인'){?>
												<!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
												승인
									<?}?>
							</div>
							<?if($arr7[0] == '승인'){?>
										<span>
											<input type="text" class="datetime" id="dateTime" value="<?=formatDate ($arr8[0]);?>" readonly />
										</span>
							<?}else if($arr7[0] == '대기') {?>
										<span>
											<input type="text" class="datetime" id="dateTime" value="" readonly />
										</span>
							<?}?>
            </td>
						<?for($i = 2; $i<=$dealNum; $i++)  {?>
							<td class="agreeWrap">
              <div class="sign">
								<?if(($arr7[$i-1] == '대기' || $arr7[$i-1] == '보류') && $sessionId == $arr2[$i-1]['userid']) { ?>
							 				<select class="agreeBtn" id="" name="deal<?=$i?>_status">
													<option value="대기" <?if( $arr7[$i-1] =='대기') echo 'selected';?>>대기</option>
													<option value="승인">승인</option>
													<option value="보류" <?if( $arr7[$i-1] =='보류') echo 'selected';?>>보류</option>
											</select>
									<?}?>
									<?if($arr7[$i-1] =='승인'){?>
												<!--	<img src="/images/dojang2.png" alt="서명" class="dojang">	-->
												승인
									<?}?>
							</div>
							<?if($arr7[$i-1] == '승인'){?>
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
        <h2>1.&nbsp;&nbsp;문&nbsp;서&nbsp;정&nbsp;보</h2>
        <table class="formTable">
          <tr>
            <th>문&nbsp;&nbsp;서&nbsp;&nbsp;번&nbsp;&nbsp;호</th>
            <td>
							<input type='text' id="num" name='num' value='<?=$doc_num?>' readonly >
						</td>
          </tr>
          <tr>
            <th>보&nbsp;&nbsp;안&nbsp;&nbsp;등&nbsp;&nbsp;급</th>
            <td>
              L2
            </td>
          </tr>
          <tr>
            <th>보&nbsp;&nbsp;존&nbsp;&nbsp;연&nbsp;&nbsp;한</th>
            <td>
              5년
            </td>
          </tr>
          <tr>
            <th>문&nbsp;&nbsp;서&nbsp;&nbsp;종&nbsp;&nbsp;류</th>
            <td>
              결재
            </td>
          </tr>
        </table>
        <table class="formTable2">
          <tr>
            <th>기&nbsp;&nbsp;&nbsp;안&nbsp;&nbsp;&nbsp;자</th>
            <td id="drafterWrap">
              <input type="text" value=<?=$name?>>
            </td>
          </tr>
          <tr>
            <th>직&nbsp;급&nbsp;&nbsp;/&nbsp;&nbsp;직&nbsp;책</th>
            <td >
							<input type='text' id="affil" name='affil' value='<?=$affil?>' readonly>
						</td>
          </tr>
          <tr>
            <th>부&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;서</th>
            <td>
							<input type='text' id="team" name='team' value='<?=$team?>' readonly>
						</td>
          </tr>
          <tr>
            <th>수&nbsp;&nbsp;&nbsp신&nbsp&nbsp;&nbsp;처</th>
            <td>
              운영지원팀
            </td>
          </tr>
        </table>
        <h2>2.&nbsp;&nbsp;세&nbsp;부&nbsp;내&nbsp;용</h2>
        <table class="inputTable">
          <tr class="inputForm">
            <th>제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목</th>
            <td id="mainTitle_wrap"><textarea name="mainTitle" id="mainTitle" rows="1" class="title " readonly><?=$title?></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;유</th>
            <td id="content_wrap"><textarea name="content" id="content" cols="30" rows="4" class="content" readonly><?=$text?></textarea></td>
          </tr>
          <tr class="inputForm">
            <th>휴&nbsp;가&nbsp;종&nbsp;류</th>
            <td id="dayoff_wrap">
						<input type="text" name="dayoff" id="dayoff" class="sort" value="<?=$gubun?>">
            </td>
          </tr>
          <tr class="inputForm">
            <th>기&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;간</th>
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
              <span>일간 )</span>
            </td>
          </tr>
        </table>
				<?if($upfile01 || $opinion) {?>
        <h2 id="etcTitle">3. 기타</h2>
        <table class="etcTable">
          <tr>
            <th>첨&nbsp;&nbsp; 부&nbsp;&nbsp; 자&nbsp;&nbsp; 료</th>
            <td>
              <input type="text" name="file" class="searchfileInput"  value="<?=$upfile01?>" readonly>
            </td>
          </tr>
          <tr>
            <th>의&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;견 </th>
            <td><textarea name="opinion" id="opinion" rows="1" class="title" readonly><?=$opinion?></textarea></td>
          </tr>
        </table>
				<?}?>
				<table class="submitTable">
          <tr>
            <td colspan="2">
              <div class="tailContent">
                <p>위와 같이 품의하오니 재가 하여 주시기 바랍니다.</p>
                <p id="today"></p>
              </div>
            </td>
          </tr>
        </table>
        <div class="headline">
          <button id="editBtn" class="editBtn no_print" onclick="go_edit(<?=$uid?>)">수정</button>
        </div>
      </div>
		</form>
    </main>
    <footer>
      <h1>주&nbsp;&nbsp;식&nbsp;&nbsp;회&nbsp;&nbsp;사&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;아&nbsp;&nbsp;이&nbsp;&nbsp;웹</h1>
    </footer>
  </div>

<script>
	const sign2 = document.querySelector("#agreeTr2 > td:nth-child(2) > div");
	const sign3 = document.querySelector("#agreeTr2 > td:nth-child(3) > div");
	const sign4 = document.querySelector("#agreeTr2 > td:nth-child(4) > div");
	const sign5 = document.querySelector("#agreeTr2 > td:nth-child(5) > div");

	const priority = () => {
		if (sign2 != null && sign2.innerText != "승인") {
			if ($(sign2).children().val() == "승인") {
				return true;
			} else {
				return false;
			}
		} else if (sign3 != null && sign3.innerText != "승인") {
			if ($(sign3).children().val() == "승인") {
				return true;
			} else {
				return false;
			}
		} else if (sign4 != null && sign4.innerText != "승인") {
			if ($(sign4).children().val() == "승인") {
				return true;
			} else {
				return false;
			}
		} else if (sign5 != null && sign5.innerText != "승인") {
			if ($(sign5).children().val() == "승인") {
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
			alert("결재 대기 중입니다.");
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