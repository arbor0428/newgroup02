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
		$rDate = $rDate01.'�� '.$rDate02.'�� '.$rDate03.'��';

		$sql = "select * from wo_member where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$name = $row["name"]; // ����
		$team = $row["team"]; // �Ҽ�
		$affil = $row["affil"]; // ����
		$mobile = $row["mobile"]; //����ó


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
	<input type='hidden' name='mname' value='<?=$mname?>'>

<!-- margin:0 auto�� block��ҿ��� �԰� inline���� �ȸ�����  -->
<div style='width:700px;margin:0 auto;text-align:right'>
<?
	if(($GBL_MTYPE == 'A') and !$status){
?>
<!-- <a class='big cbtn black' href='javascript:reg_apr();'>����</a> -->
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
    <h1 class="tableTitle">�ް�/����/����/��� ��û��</h1>
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
                    <th>����</th>
                    <td><?=$name?></td>
                    <th>�Ҽ�</th>
                    <td><?=$team?></td>
                </tr>
                <tr>
                    <th>����</th>
                    <td><?=$affil?></td>
					<th>����</th>
					<td><?=$gubun?></td>
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
                    <th>����ó</th>
                    <td><?=$mobile?></td>
                    <th>����������</th>
                    <td><?=$acting?></td>
                </tr>
                <tr>
                    <th>��¥(�Ⱓ)</th>
                    <td colspan="3"><?=$daterange?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="desText">���� ���� ��û�Ͽ���(����Ͽ�����) ����(����)�Ͽ� �ֽñ� �ٶ��ϴ�.</p>
    <em class="date"><?=$rDate?></em>
    <p class="officeName">
        <span>�ֽ�ȸ�� ������</span>
        <span>��ǥ�̻� �� ��</span>
		<!-- <span style="position:relative">
			(��)
			<?if($status){?>
			<span id="confirmArea" style="position:absolute; left:-20px; top:-22px; z-index: -1;"><img src="../../images/dojang2.png" alt="�����̹���"></span>
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
                    <th rowspan='2'>����</th>
                    <th>���</th>
                    <th>�̻�</th>
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
	                    <th rowspan='2'>����</th>
	                    <th>���</th>
	                    <th>����,����</th>
	                    <th>�̻�</th>
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