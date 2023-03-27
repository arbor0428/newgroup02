<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";

	session_start();

	$sql="select name,affil,userid from wo_member where enable = 1 "; //현재 근무중인 직원의 이름
	$result = mysql_query($sql);
	$arr = array();
	$arr2 = array();
	$arr3 = array();

	while( $row = mysql_fetch_array($result)) {
		array_push($arr, $row['name']);
		array_push($arr2, $row['affil']);
		array_push($arr3, $row['userid']);
	}

	$sql2 = "select name from wo_member where userid = '$_SESSION[ses_id]' "; //현재 로그인중인 사람의 이름
	$result2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($result2);


 ?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
 <style>
		 :root {
			--main-bg-color: #e2e8f4;
			--main-border-color: #796C98;
			--sub-border-color: #f6f6f6;
		}
    body {
      margin: 0;
      padding: 0;
    }
    .wrap {
      width: 100%;
      height: 100vh;
      margin: 0 auto;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .agreeForm {
      position: relative;
      margin: 0 auto;
    }
    .agreeTable,
    .dealTable {
      border-collapse: collapse;
      height: 100px;
      text-align: center;
      margin-bottom: 20px;
    }

    .agreeTable td,
    .dealTable td {
     border: 1px solid #f1f2f2;
    }
		 .agreeTable td,
		  .dealTable td {
			border-right: 1px solid #f1f2f2;
		 }

    .agreeTitle {
      width: 40px;
    }
    .agreeTable th,
    .dealTable th {
      height: 30px;
      background-color: var(--main-bg-color);
    }
    .agreeTable td,
    .dealTable td {
      width: 100px;
    }
    .agreeTable select,
    .dealTable select {
      width: 80px;
      height: 30px;
      border-radius: 5px;
			text-align: center;
    }

    .dealTable {
      display: none;
    }

   #tableAddBtn,
    .closeBtn,
    #dealAddBtn {
      background-color: rgb(97, 105, 107);
      border: none;
      border-radius: 5px;
      color: #fff;
      text-align: center;
    }

    .closeBtn {
      width: 60px;
      height: 20px;
      position: absolute;
      right: 0;
      top: 0px;
    }
    #tableAddBtn {
      display: block;
      width: 80px;
      height: 20px;


      margin-bottom: 10px;
      font-size: 14px;
      line-height: 20px;
    }
    #dealOk_text{
      text-align: center;
    }
    #dealOk1 {
      margin-right: 10px;
    }
    #dealAddBtn{
      width: 80px;
      height: 20px;
      margin-bottom: 10px;
      font-size: 14px;
      line-height: 20px;
			display: none;
    }
    #tableAddBtn:hover,
    #dealAddBtn:hover,
    .closeBtn:hover {
      background-color: #b7bebe;
      color: #000;
    }
		#tableAddBtn,
		#dealAddBtn,
		 .closeBtn {
			cursor: pointer;
		}

  </style>
</head>
<body onload="selectValue()">
  <div class="wrap">
    <form action="proc2.php" method="POST" name="FRM"  class="agreeForm">
		<span id="dealOk_text">합의</span><input type="checkbox" id="dealOk1" onclick="getCheckValue(event)"/>

		<!--post 형식으로 proc2에 보내서 insert할 예정-->
		<input type="hidden" name="num" id="pageNum"/>
      <table class="agreeTable" id="agreeTable-1">
        <tr id="tableHead">
          <th rowspan="3" class="agreeTitle">결재</th>
          <th >담당자</th>
          <th id="thClone1"></th>
        </tr>
        <tr id="tableTd">
          <td >
            <select  class="agreeSelect" id="agreeSelect1" name="agree1" onchange="setDrafter(event)">
								<option ></option>
								<!-- <option value="<?=$row2['name']?>" selected><?=$row2['name']?></option>-->
									<? 	for($i=0; $i<count($arr); $i++ ) {?>
									<option value="<?=$arr3[$i]?>"<?if($_SESSION[ses_id]===$arr3[$i]) echo 'selected';?>><?= $arr[$i] ?></option>
									<?
										}
									?>
						</select>
          </td>
          <td id="clone1">
           <select class="agreeSelect" id="agreeSelect2"  onchange="setValue(event)">
              <option value=""></option>
									<? 	for($i=0; $i<count($arr); $i++ ) {?>
									<option value="<?=$arr3[$i]?>"><?= $arr[$i] ?></option>
									<?
										}
									?>
            </select>
						<input type="hidden" id="agreeSelect2Hidden" name="agree2"/>
          </td>

        </tr>

      </table>
      <table class="dealTable" id="dealTable1">
        <tr id="dealHead">
          <th rowspan="3" class="agreeTitle" >합의</th>
          <th class="dealTh" id="dealClone1"></th>
        </tr>
        <tr id="deal_td">
          <td class="dTableTd" id="d_clone1">
            <select id="dealSelect1" onchange="setValue(event)">
              <option value=""></option>
									<? 	for($i=0; $i<count($arr); $i++ ) {?>
									<option value="<?=$arr3[$i]?>"><?= $arr[$i] ?></option>
									<?
										}
									?>
            </select>
						<input type="hidden" id="dealSelect1Hidden" name="deal1"/>
          </td>

        </tr>

      </table>
      <input type="button" value="확인" class="closeBtn" onclick="setAgree();" />
    </form>
  </div>


  <script>
	//담당자 교체시 기안자 교체
		function setDrafter(event) {
			const drafter = $('#agreeSelect1').val();
			$('#userid', opener.document).attr('value', drafter);
			$('#userid', opener.document).val(drafter).prop("selected", true);
			opener.setUserID();

		}

    // 팝업창 결재 에서 option선택시 th의 text 바꿈.
    function setValue(event) {
			const index = event.target.id;
			if(index.includes('agree')){
				const indexNum = index.substring(11,12);
				let userid = $(`#${index} option:selected`).val();
				$.post('./jsonUser.php', {'userid':userid}, function(req){ //아이디로 검색
					const parData = JSON.parse(req);
					const name = parData['name'];
					const affil = parData['affil'];
					if(name!=="" && affil ==''){
						alert('인사관리에서 직급을 추가하여 주세요.');
						$(`#tableHead th:eq(${indexNum})`).text("")
						return false;
					}
					if(name==""){
						alert('결재자를 선택해주세요');
						$(`#tableHead th:eq(${indexNum})`).text("")
						return false;
					}
					$(`#tableHead th:eq(${indexNum})`).text(affil);//th에 직급 표기

					//hidden으로 userid 넘김.
					$(`#agreeSelect${indexNum}Hidden`).attr('value', userid);
					const hiddenId =  $(`#agreeSelect${indexNum}Hidden`);


					//select시 다음테이블 추가
					const select = $(`#${index}`).is('select');
					if(indexNum > 1 && select && !$(`#${index}`).hasClass('selected') ){
							tableAdd(userid);
							$(`#${index}`).addClass('selected');
					}
				});


			}else if(index.includes('deal')){
				const indexNum = index.substring(10,11);

				const userid = $(`#${index} option:selected`).val();
					$.post('./jsonUser.php', {'userid':userid}, function(req){
							const parData = JSON.parse(req);
							const name = parData['name'];
							const affil = parData['affil'];
							$(`#dealHead th:eq(${indexNum})`).text(affil);
							//hidden으로 userid 넘김.
							$(`#dealSelect${indexNum}Hidden`).attr('value', userid);

							//select시 다음테이블 추가
							const select = $(`#${index}`).is('select');
							if(select && !$(`#${index}`).hasClass('selected') ){
									AddDeal(userid);
									$(`#${index}`).addClass('selected');
							}
					});
			}else {
				alert('오류입니다.');
			}


    }



    // 페이지의 값 팝업으로 받아오기 수정해야함.
    function selectValue () {
			const num = $('#num',opener.document).val();
      const selectClass = document.getElementsByClassName('agreeSelect');
      const th = document.querySelectorAll('th');
      const selectAgree = document.getElementsByClassName('selectAgree');

			$('#pageNum').attr('value',num);

      for( let i = 1; i<=selectClass.length; i++ ) {
        if(opener.document.getElementById(`selectAgree${i}`).value ) {

					$(`#agreeSelect${i+1}`)
						.attr('value', $(`#selectAgree${i+1}Hidden`,opener.document).val());

          th[i].innerText
          = opener.document.getElementById(`agreeth${i}`).innerText

        }
      }

	//deal 수정해야함.
      for(let i = 1; i<=selectAgree.length; i++) {
        if(opener.document.getElementById(`selectDeal${i}`).value ) {
          document.getElementById(`dealSelect${i}`).value
          = opener.document.getElementById(`selectDeal${i}`).value;
					$(`#dealSelect${i}`)
						.attr('value', $(`#dealAgree${i}Hidden`,opener.document).val());

          th[i].innerText
          = opener.document.getElementById(`dealth${i}`).innerText

        }
      }


      if($('#agreeTr2 .agreeWrap',opener.document).length>1) {
        const tableNum = $('#agreeTr2 .agreeWrap',opener.document).length;

        for(let i = 0; i<tableNum-2 ; i++) {
          getTable(i);
        }
				  for(let i = 0; i<tableNum-1 ; i++) {
          getTable2(i);
        }
      }

      const tableNum2 = $('#dealTr2 .agreeWrap',opener.document).length;

			if($('#dealTable_1', opener.document).css("display") === "none"){
				$('#dealTable1').css({"display": "none"});
			}

			if($('#dealTable_1', opener.document).css("display") === "table"){
				$('#dealOk1').attr('checked', 'checked');
				$('#dealTable1').css({"display": "table"});
			}
      if(tableNum2>0) {
        for(let i = 0; i<tableNum2-1 ; i++) {
          getDealTable(i);
        }
				for(let i = 0; i<tableNum2 ; i++) {
          getDealTable2(i);
        }
      }


    }
    // 추가한 테이블 만큼 다시 팝업창 띄울때 테이블 갯수 가져오기
    function getTable(i) {
			$('#thClone1').clone().appendTo('#tableHead').text("").attr('id', 'thClone'+(i+2));
			$('#thClone'+(i+2)).text($('#agreeth'+(i+3), opener.document).text());
			$('#clone1').clone().appendTo('#tableTd').attr("id", "clone"+(i+2));
			$('#clone'+(i+2)).children().eq(0).attr('id','agreeSelect'+(i+3));
			$('#clone'+(i+2)).children().eq(1).attr('id','agreeSelect'+(i+3)+'Hidden');

    }
		// 추가한 테이블 만큼 다시 팝업창 띄울때 select value 세팅
		  function getTable2(i){
			const selectVal = $(`#selectAgree${i+2}Hidden`,opener.document).val();

			$(`#agreeSelect${i+2}`).attr('value', selectVal);
			$(`#agreeSelect${i+2}`).val(selectVal).prop('selected', 'selected');

			}

    function getDealTable(i) {
      $('#dealClone1').clone().appendTo('#dealHead').text("").attr('id', 'dealClone'+(i+2));
      $('#d_clone1').clone().appendTo('#deal_td').attr("id", "d_clone"+(i+2));
      $('#d_clone'+(i+2)).children().eq(0).attr('id','dealSelect'+(i+2));
			$('#d_clone'+(i+2)).children().eq(1).attr('id','dealSelect'+(i+2)+'Hidden');



    }
		function getDealTable2(i) {//가져올때 값 고쳐야함
			const selectVal =	$(`#selectDeal${i+1}Hidden`,opener.document).val();
			$('#dealClone'+(i+1)).text($('#dealth'+(i+1), opener.document).text());
			$(`#dealSelect${i+1}`).attr('value', selectVal);
			$(`#dealSelect${i+1}`).val(selectVal).prop('selected', 'selected');
			$(`#dealSelect${i+2}`).addClass('selected');
		}


    // 값 선택후 submit!!
    function setAgree() {
      // 추가한 테이블유지 하기위한 값
      const elNum = $('#tableTd td').length;
      const elNum2 = $('#deal_td td').length;

      for( let i = 1; i<=elNum; i++ ) {
				$(`#selectAgree${i}`,opener.document)
        .attr('value', $(`#agreeSelect${i} option:checked`).text()); //팝업창에서 선택된 이름을 가져옴
				$(`#agreeth${i+1}`,opener.document).text( $(`#tableHead th:eq(${i+1})`).text()	);//팝업창에서 선택된 직급을 가져옴

				$(`#selectAgree${i+1}Hidden`,opener.document)
					.attr('value', $(`#agreeSelect${i+1}`).val() );

				const id = $(`#agreeSelect${i} option:selected`).val()
				if(elNum<2 || $('#agreeSelect2').val() == '' ) {
					alert('결재자는 한명이상이여야 합니다.');
					$('#agreeSelect2').focus();
					return false;
				}
				//선택값이 없으면 마지막 삭제
        if($(`#agreeSelect${i}`).val() == ''){
          removeTable();
        }
			}

      for( let i = 1; i<=elNum2; i++ ) {
        $(`#selectDeal${i}`,opener.document)
        .attr('value', $(`#dealSelect${i} option:checked`).text());
        $(`#dealth${i}`,opener.document).text($(`#dealHead th:eq(${i})`).text()	);
				$(`#selectDeal${i}Hidden`,opener.document)
					.attr('value', $(`#dealSelect${i}`).val() );

				//선택값이 없으면 마지막 삭제
        if($(`#dealSelect${i}`).val() == ''){
					if($('#dealSelect1').val()==''){
						$('.dealTable', opener.document).css({"display": "none"});
					}else {
          removeDealTable();
					}
        }
      }

			// 페이지 체크박스에 선택 값
			if($('#dealOk1').is(':checked') ) {
				 $('#dealTable_1', opener.document).css({"display": "table"});
			}else{
				 $('#dealTable_1', opener.document).css({"display": "none"});
			}
			if($('#dealSelect1').val()==""){
        $('#dealTable_1', opener.document).css({"display": "none"});
        $('#agreeTableWrap', opener.document).css({"float": "right"});
      }

			if(confirm("위 선택으로 기안 진행 하시겠습니까?")){
				document.FRM.action = "proc2.php";
      }else{
				return false;
			}
      window.close();
    }

    // 합의테이블
    function getCheckValue(event) {

      if(event.target.checked) {
        $('#dealTable1').css({"display": "table"});
				$('#dealTable_1', opener.document).css({"display": "table"});
      }else {

        $('#dealTable1').css({"display": "none"});
				$('#dealTable_1', opener.document).css({"display": "none"});
				$('#dealTable_1>tbody', opener.document).css({"width": "0px"});
				//합의 체크를 풀면 리셋
				const length = $('.dTableTd select').length;
				for(let i = 1; i<length; i++) {
					$('#dealSelect'+i).removeClass('selected');
					$('#dealSelect'+i).val('');
					$('#dealSelect'+i+'Hidden').val('');
					removeDealTable();
				}
      }

    }

    //결재 테이블 추가
    let num = 0;
    function tableAdd(userid) {
      num = $('#tableTd td').length-2;
			let dealWidth = $('.dealTable', opener.document).width();
      const agreeWidth = $('.agreeTable', opener.document).width();

			if(dealWidth+agreeWidth>800 || num+2 >4) {
        alert('최대 갯수를 초과하였습니다.');
      }else {
				const cloneTh = '<th></th>';
				const tableHead = $('#tableHead');
				const tableTd = $('#tableTd');
				const cloneTd = `<td>
				<select class="agreeSelect" id="agreeSelect${num+3}" onchange="setValue(event)">
				<option value=""></option>
				<? 	for($i=0; $i<count($arr); $i++ ) {?>
				<option value="<?=$arr3[$i]?>"><?= $arr[$i] ?></option>
				<?}?>
				</select>
				<input type="hidden" id="agreeSelect${num+3}Hidden" name="agree${num+3}" />
				</td>`;
				tableHead.append(cloneTh);
				tableTd.append(cloneTd);

				const agreeWrap = $('.agreeWrap:eq(1)',opener.document).clone();
				const  selectAgree = $('#agreeTr3 td:eq(1)',opener.document).clone();
				const test = $('#agreeth2',opener.document).clone().text("");

        test.attr('id','agreeth'+(num+3));
        $('#agreeTr', opener.document).append(test);
        $('#agreeTr2', opener.document).append(agreeWrap);
				$('#agreeTr3 td:eq(1)',opener.document).clone();
				selectAgree.children().eq(0).attr('id','selectAgree'+(num+3) );
				selectAgree.children().eq(0).attr('name','agree'+(num+3) );
				selectAgree.children().eq(1).attr('id','selectAgree'+(num+3)+'Hidden' );//Hidden아이디 설정
//			selectAgree.children().eq(1).attr('name','agree'+(num+3));
				$('#agreeTr3',opener.document).append(selectAgree);


      }
      num += 1;

    }

    //합의테이블 추가
    function AddDeal(userid) {

      num = $('#deal_td td').length;

      let dealWidth = $('.dealTable', opener.document).width();
      const agreeWidth = $('.agreeTable', opener.document).width();
			if($('.dealTable', opener.document).css("display") ==="none"){

			}
       if(dealWidth+agreeWidth>800 || num>4) {
        alert('최대 갯수를 초과하였습니다.');
      }else{
				const cloneTh = `<th class="dealTh" id="dealClone${num+1}"></th>`;
				const tableHead = $('#dealHead');
				const tableTd = $('#deal_td');
				const cloneTd = `<td class="dtableTd" id="d_clone${num+1}">
				<select class="agreeSelect" id="dealSelect${num+1}" onchange="setValue(event)">
				<option value=""></option>
				<? 	for($i=0; $i<count($arr); $i++ ) {?>
				<option value="<?=$arr3[$i]?>"><?= $arr[$i] ?></option>
				<?}?>
				</select>
				<input type="hidden" id="dealSelect${num+1}Hidden" name="deal${num+1}" />
				</td>`;
				tableHead.append(cloneTh);
				tableTd.append(cloneTd);

				const agreeWrap2 = $('#dealTr2 .agreeWrap:eq(0)',opener.document).clone();
				const selectDeal = $('#dealTr3 td:eq(0)',opener.document).clone();
        $('#dealTr2 ', opener.document).append(agreeWrap2);
        const test = $('#dealth1',opener.document).clone();

        test.attr('id','dealth'+(num+1));
        $('#dealTr', opener.document).append(test);

        selectDeal.children().eq(0).attr('id','selectDeal'+(num+1) );
				selectDeal.children().eq(0).attr('name', 'deal'+(num+1) );
				selectDeal.children().eq(1).attr('id','selectDeal'+(num+1)+'Hidden');
//				selectDeal.children().eq(1).attr('name','deal'+(num+1));
        $('#dealTr3',opener.document).append(selectDeal);

      }
			 num += 1;
    }

		//이것도 고쳐야함
     function removeTable() {
      if($('#tableHead th').length<4){
        return false;
      } else {
				/*
				let id = $('#tableTd input[value=""][type=hidden]').attr("id");
				console.log(id);
				let num = parseInt(id.substring(11,12));
				console.log(num);

				$('#tableHead th:nth-child('+ num +')').remove()
        $('#tableTd td:nth-child('+ num +')').remove();
        $('#agreeTr th:nth-child('+ num +')',opener.document).remove();
        $('#agreeTr2 td:nth-child('+ num +')',opener.document).remove();
        $('#agreeTr3 td:nth-child('+ num +')',opener.document).remove();
				*/
				$('#tableHead th:last').remove()
        $('#tableTd td:last').remove();
        $('#agreeTr th:last',opener.document).remove();
        $('#agreeTr2 td:last',opener.document).remove();
        $('#agreeTr3 td:last',opener.document).remove();

      }

    }
		function removeDealTable(){

			$('#dealHead th:last').remove();
      $('#deal_td td:last').remove();
      $('#dealTr th:last',opener.document).remove();
      $('#dealTr2 td:last',opener.document).remove();
      $('#dealTr3 td:last',opener.document).remove();
		}



  </script>