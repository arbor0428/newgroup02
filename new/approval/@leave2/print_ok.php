<?

		$sql = "select * from wo_leave where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$rDate01 = date('Y');
		$rDate02 = date('m');
		$rDate03 = date('d');
		
		$userid = $row["userid"];
		$acting = $row["acting"];
		$gubun = $row["gubun"];
		$vdate01 = $row["vdate01"];
		$vdate02 = $row["vdate02"];
		$vdate03 = $row["vdate03"];
		$vdate04 = $row["vdate04"];
		$vdate05 = $row["vdate05"];
		$vdate06 = $row["vdate06"];
		$daterange = $row["daterange"];
		$mname = $row["mname"];

		$rDate = '';
		$rDate = $rDate01.'년 '.$rDate02.'월 '.$rDate03.'일';

		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$name = $row["name"]; // 성함
		$team = $row["team"]; // 소속
		$affil = $row["affil"]; // 직위
		$mobile = $row["mobile"]; //연락처


		// 조건을 걸 필요가 없다 데이터는 어차피 하나이기 때문에 그래서 where조건이 붙지 않는다 
		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$actxt01 = $row["actxt01"];
		$cmp_num = $row["cmp_num"];
		$cmp_adr = $row["cmp_adr"];

		



		//조인문인데 조인문을 사용하는 이유는 지금이야 3개의 테이블이지만 나중에 많아지면 리소스도 많이 잡아먹고 쓸것도 너무 많다 그래서 join문으로 줄여야 한다
//		$sql = "select p.*, m.name  from wo_proof as p left join wo_member as m on p.userid=m.userid where p.uid='$uid'";

		

?>

<script language='javascript'>

function reg_apr(){
	if(confirm('승인을 확정하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'status'
		form.action = 'proc.php';
		form.submit();
	}
	
}

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

	/*$(function(){
		if($status){
			$(".stamp").addclass('active');
		}
	})*/

	// $status 일때 addclass 'active'
	
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
	<input type='hidden' name='type' value='<?=$type?>'>
	<input type='hidden' name='uid' value='<?=$uid?>'>
	<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
	<input type='hidden' name='mname' value='<?=$mname?>'>

<!-- margin:0 auto는 block요소에만 먹고 inline에는 안먹힌다  -->
<div style='width:700px;margin:0 auto;text-align:right'>
<?
	if(($GBL_MTYPE == 'A') and !$status){
?>
<!-- <a class='big cbtn black' href='javascript:reg_apr();'>승인</a> -->
<?
	}
if(($GBL_USERID == $userid) or ($GBL_MTYPE == 'A'))	$java_link = 'reg_apr';
		else	$java_link = 'reg_view'; 
?>
</div>

<style>
	body {background:none !important;}

    /* http://meyerweb.com/eric/tools/css/reset/ 
   v2.0 | 20110126
   License: none (public domain)
    */
   
    .tableWrap table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    .tableWrap td {
		font-size:17px;
		color:#000;
    }

    .tableWrap {width: 700px; margin: 0 auto;}
    .tableTitle {
		padding: 60px 0 40px 0;
        text-align:center; 
		font-weight: bold; 
		font-size: 28px;
		letter-spacing:15px;
		color:#000000;
    }
    .UserTable h2 {
		margin-bottom: 30px;
        font-weight: bold; 
		color:#000000;
		
    }
    .officeTable h2 {
		margin-bottom: 30px;
        font-weight:bold; 
		color:#000000;
    }

    .UserTable {margin-bottom: 50px;}
    .tableStyle table {
		width: 100%;
        border: 1px solid #333;
        border-top: 2px solid #333;
		color:#000000;
		text-align:center;
    }
    .tableStyle table tr {border-bottom: 1px solid #333;}
    .tableStyle table th {
		padding: 15px 0;
        font-weight: bold;
        background-color: #e1ebf7;
        border-right: 1px solid #333;
        border-left: 1px solid #333;
		color:#000000;
		text-align:center;
    }
    .officeTable {margin-bottom: 100px; }
    .desText {
		margin-bottom: 60px;
        text-align: center;
		color:#000000;
		text-align:center;
		font-size:20px;
    }
    .date {
		display: block;
		margin-bottom: 60px;
        text-align: center;
		color:#000000;
		text-align:center;
		font-size:20px;
    }
    .officeName {
        text-align: center;
		color:#000000;
		text-align:center;
		font-size:20px;
    }
    .officeName span+span {margin-left: 30px;}

	.br-r {border-right:1px solid #333;}
	.pd30 {padding:30px 0;}

	/* .stamp {position:relative;}
	.stamp.active::before {content:""; display:block; width: 76px; height: 76px;
		background: url(/images/dojang2.png) no-repeat 0 0;
		position:absolute; left:-20px; top:-22px; z-index: -1;
	} */

</style>

<div class="tableWrap">
    <h1 class="tableTitle">휴가/조퇴/지각/결근 신청서</h1>
    <div class="UserTable tableStyle">
        <h2>1. 인적사항</h2>
        <table cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>                                                                                                                                                                                                                                    
                <tr>
                    <th>성명</th>
                    <td><?=$name?></td>
                    <th>소속</th>
                    <td><?=$team?></td>
                </tr>
                <tr>
                    <th>직위</th>
                    <td><?=$affil?></td>
					<th>구분</th>
					<td><?=$gubun?></td>
                </tr> 
            </tbody>
        </table>
    </div>
    <div class="officeTable tableStyle">
        <h2>2. 업무관련</h2>
        <table cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
                <tr>
                    <th>연락처</th>
                    <td><?=$mobile?></td>
                    <th>직무대행자</th>
                    <td><?=$acting?></td>
                </tr>
                <tr>
                    <th>날짜(기간)</th>
                    <td colspan="3"><?=$daterange?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="desText">위와 같이 신청하오니(사용하였으니) 승인(수리)하여 주시기 바랍니다.</p>
    <em class="date"><?=$rDate?></em>
    <p class="officeName">
        <span>주식회사 아이웹</span>
        <span>대표이사 조 준</span>
		<!-- <span style="position:relative">
			(인)
			<?if($status){?>
			<span id="confirmArea" style="position:absolute; left:-20px; top:-22px; z-index: -1;"><img src="../../images/dojang2.png" alt="도장이미지"></span>
			<?}?>
		</span> -->
    </p>

<?
	$S = Array('cho3771','korea','ziziwlgh','psw2222','aeulb','ussr1285');
	if(in_array($GBL_USERID,$S)) {
?>
	<div class="officeTable tableStyle">
        <h2></h2>
        <table cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="10%">
                <col width="25%">
                <col width="25%">
            </colgroup>
            <tbody>
                <tr>
                    <th rowspan='2'>결재</th>
                    <th>담당</th>
                    <th>이사</th>
                </tr>
                <tr>
                    <td class="br-r pd30"></td>
                    <td class="br-r"></td>
                </tr>
            </tbody>
        </table>
    </div>
<?
	} else {
?>
	<div class="officeTable tableStyle">
	        <table cellpadding="0" cellspacing="0">
	            <colgroup>
	                <col width="10%">
	                <col width="25%">
	                <col width="25%">
	                <col width="25%">
	            </colgroup>
	            <tbody>
	                <tr>
	                    <th rowspan='2'>결재</th>
	                    <th>담당</th>
	                    <th>팀장,차장</th>
	                    <th>이사</th>
	                </tr>
	                <tr>
	                    <td class="br-r pd30"></td>
	                    <td class="br-r"></td>
	                    <td class="br-r"></td>
	                </tr>
	            </tbody>
	        </table>
	</div>
<?
	}
?>
</form>