<?

		$sql = "select * from wo_proof where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$rDate01 = date('Y');
		$rDate02 = date('m');
		$rDate03 = date('d');

		$userid = $row["userid"];
		$puse = $row["puse"];
		$status = $row["status"];

		$rDate = '';
		$rDate = $rDate01.'년 '.$rDate02.'월 '.$rDate03.'일';

		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$name = $row["name"];
		$securi = $row["securi"];
		$securi2 = $row["securi2"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$team = $row["team"];
		$affil = $row["affil"];
		$idate01 = $row["idate01"];
		$idate02 = $row["idate02"];
		$idate03 = $row["idate03"];
		$pdate01 = $row["pdate01"];
		$pdate02 = $row["pdate02"];
		$pdate03 = $row["pdate03"];

		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$actxt01 = $row["actxt01"];
		$cmp_num = $row["cmp_num"];
		$cmp_adr = $row["cmp_adr"];

?>
<script>
	
</script>
<style>

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

    .officeTable {margin-bottom: 100px;}
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

</style>

<div class="tableWrap">
    <h1 class="tableTitle">재직증명서</h1>
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
                    <th>성&nbsp;&nbsp;&nbsp;명</th>
                    <td><?=$name?></td>
                    <th>주민등록번호</th>
                    <td><?=$securi?>&nbsp;-&nbsp;<input type = 'password' style="width:90px; border:none;" value='<?=$securi2?>'></td>
                </tr>
                <tr>
                    <th>주&nbsp;&nbsp;&nbsp;소</th>
                    <td colspan="3">(<?=$zipcode?>) <?=$addr01?>&nbsp;<?=$addr02?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="officeTable tableStyle">
        <h2>2. 재직사항</h2>
        <table cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
                <tr>
                    <th>회사명</th>
                    <td><?=$actxt01?></td>
                    <th>사업자번호</th>
                    <td><?=$cmp_num?></td>
                </tr>
                <tr>
                    <th>소재지</th>
                    <td colspan="3"><?=$cmp_adr?></td>
                </tr>
                <tr>
                    <th>소&nbsp;&nbsp;&nbsp;속</th>
                    <td><?=$team?></td>
                    <th>직&nbsp;&nbsp;&nbsp;위</th>
                    <td><?=$affil?></td>
                </tr>
                <tr>
                    <th>재직기간</th>
                    <td colspan="3"><?=$idate01?>년<?=$idate02?>월<?=$idate03?>일&nbsp;~&nbsp;<?=$pdate01?>년<?=$pdate02?>월<?=$pdate03?>일</td>
                </tr>
                <tr>
                    <th>사용용도</th>
                    <td colspan="3"><?=$puse?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="desText">상기와 같이 재직하고 있음을 증명함</p>
    <em class="date"><?=$rDate?></em>
    <p class="officeName">
        <span>주식회사 아이웹</span>
        <span>대표이사 조 준</span>
		<span style="position:relative">
			(인)
			<?if($status){?>
			<span id="confirmArea" style="position:absolute; left:-20px; top:-22px; z-index: -1;"><img src="/images/dojang2.png" alt="도장이미지"></span>
			<?}?>
		</span>
    </p>
</div>


