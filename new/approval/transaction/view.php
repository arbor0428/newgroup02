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
		$rDate = $rDate01.'�� '.$rDate02.'�� '.$rDate03.'��';

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

		// ������ �� �ʿ䰡 ���� �����ʹ� ������ �ϳ��̱� ������ �׷��� where������ ���� �ʴ´� 
		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$actxt01 = $row["actxt01"];
		$cmp_num = $row["cmp_num"];
		$cmp_adr = $row["cmp_adr"];



		//���ι��ε� ���ι��� ����ϴ� ������ �����̾� 3���� ���̺������� ���߿� �������� ���ҽ��� ���� ��Ƹ԰� ���͵� �ʹ� ���� �׷��� join������ �ٿ��� �Ѵ�
//		$sql = "select p.*, m.name  from wo_proof as p left join wo_member as m on p.userid=m.userid where p.uid='$uid'";

		

?>

<script language='javascript'>

function reg_apr(){
	if(confirm('������ Ȯ���Ͻðڽ��ϱ�?')){
		form = document.FRM;
		form.type.value = 'status'
		form.action = 'proc.php';
		form.submit();
	}
	
}

	function reg_del(){
		
		if(confirm('���� �����Ͻðڽ��ϱ�?')){
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

	// $status �϶� addclass 'active'
	
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<!-- margin:0 auto�� block��ҿ��� �԰� inline���� �ȸ�����  -->
<div style='width:700px;margin:0 auto;text-align:right'>
<?
	if(($GBL_MTYPE == 'A') and !$status){
?>
<a class='big cbtn black' href='javascript:reg_apr();'>����</a>
<?
	}
// if(($GBL_USERID == $userid) or ($GBL_MTYPE == 'A'))	$java_link = 'reg_apr';
//		else	$java_link = 'reg_view'; 
?>
<a class='big cbtn black' href='javascript:reg_list();'>���</a>
<a class="big cbtn black" href="javascript://" onclick="window.open('/module/printSet.php?mod=1&uid=<?=$uid?>','ieprint','width=990,height=900,scrollbars=yes','_blank')">�μ��ϱ�</a>
</div>

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

	/* .stamp {position:relative;}
	.stamp.active::before {content:""; display:block; width: 76px; height: 76px;
		background: url(/images/dojang2.png) no-repeat 0 0;
		position:absolute; left:-20px; top:-22px; z-index: -1;
	} */

</style>

<div class="tableWrap">
    <h1 class="tableTitle">��������</h1>
    <div class="UserTable tableStyle">
        <h2>1. ��������</h2>
        <table cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>                                                                                                                                                                                                                                                                                                                                     
                <tr>
                    <th>��&nbsp;&nbsp;&nbsp;��</th>
                    <td><?=$name?></td>
                    <th>�ֹε�Ϲ�ȣ</th>
                    <td><?=$securi?>-<input type = 'password' style="width:90px; border:none;" value='<?=$securi2?>'></td>
                </tr>
                <tr>
                    <th>��&nbsp;&nbsp;&nbsp;��</th>
                    <td colspan="3">(<?=$zipcode?>) <?=$addr01?><?=$addr02?></td>
                </tr> 
            </tbody>
        </table>
    </div>
    <div class="officeTable tableStyle">
        <h2>2. ��������</h2>
        <table cellpadding="0" cellspacing="0">
            <colgroup>
                <col width="15%">
                <col width="35%">
                <col width="15%">
                <col width="35%">
            </colgroup>
            <tbody>
                <tr>
                    <th>ȸ���</th>
                    <td><?=$actxt01?></td>
                    <th>����ڹ�ȣ</th>
                    <td><?=$cmp_num?></td>
                </tr>
                <tr>
                    <th>������</th>
                    <td colspan="3"><?=$cmp_adr?></td>
                </tr>
                <tr>
                    <th>��&nbsp;&nbsp;&nbsp;��</th>
                    <td><?=$team?></td>
                    <th>��&nbsp;&nbsp;&nbsp;��</th>
                    <td><?=$affil?></td>
                </tr>
                <tr>
                    <th>�����Ⱓ</th>
                    <td colspan="3"><?=$idate01?>��&nbsp;<?=$idate02?>��&nbsp;<?=$idate03?>��&nbsp;~&nbsp;<?=$pdate01?>��&nbsp;<?=$pdate02?>��&nbsp;<?=$pdate03?>��&nbsp;</td>
                </tr>
                <tr>
                    <th>���뵵</th>
                    <td colspan="3"><?=$puse?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="desText">���� ���� �����ϰ� ������ ������</p>
    <em class="date"><?=$rDate?></em>
    <p class="officeName">
        <span>�ֽ�ȸ�� ������</span>
        <span>��ǥ�̻� �� ��</span>
		<span style="position:relative">
			(��)
			<?if($status){?>
			<span id="confirmArea" style="position:absolute; left:-20px; top:-22px; z-index: -1;"><img src="../../images/dojang2.png" alt="�����̹���"></span>
			<?}?>
		</span>
    </p>
<!-- 		<span class="stamp active">(��)</span> -->
<!-- if($status){ -->
	<!-- <a class='loanBtn' href='javascript:reg_list();'>���</a>
	<a class='loanBtn' href="javascript://" onclick="window.open('/module/printSet.php?mod=1&uid=<?=$uid?>','ieprint','width=990,height=900,scrollbars=yes','_blank')">�μ��ϱ�</a> -->
</form>