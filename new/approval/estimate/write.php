<?

		$sql = "select * from wo_setup";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$actxt01 = $row["actxt01"]; // ȸ���
		$cmp_num = $row["cmp_num"]; // ����� ��ȣ
		$cmp_adr = $row["cmp_adr"]; // ������
		$ceo_nm = $row["ceo_nm"]; // ��ǥ�̻� ����

		$rDate = date('Y'); // ���糯¥ ��
		$rDate2 = date('m'); // ���糯¥ ��
		$rDate3 = date('d'); // ���糯¥ ��


		if($type == 'edit' && $uid){
			$sql = "select * from wo_proof where uid='$uid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$userid = $row['userid'];
		}


/*
		if($f_userid){
			$sql = "select * from wo_member where userid='$f_userid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$name = $row["name"]; // ����
			$securi = $row["securi"]; // �ֹε�Ϲ�ȣ ���ڸ�
			$securi2 = $row["securi2"]; // �ֹε�Ϲ�ȣ ���ڸ�
			$team = $row["team"]; // �Ҽ�
			$mname = $row["mname"]; // ����
			$idate01 = $row["idate01"]; // �Ի糯¥ ��
			$idate02 = $row["idate02"]; // �Ի糯¥ ��
			$idate03 = $row["idate03"]; // �Ի糯¥ ��
			$zipcode = $row["zipcode"]; // �����ȣ
			$addr01 = $row["addr01"]; // �ּ�1
			$addr02 = $row["addr02"]; // �ּ�2
		}
*/

?>

<style type='text/css'>
	input::-webkit-input-placeholder { font-size: 12px;color:#ccc; }
	input::-moz-placeholder { font-size: 12px;color:#ccc; }
	input:-ms-input-placeholder { font-size: 12px;color:#ccc; }
	input:-moz-placeholder { font-size: 12px;color:#ccc; }

	.gTable2 input {background-color:#eee;}
	.r_date_wrap input {width:50px;}
</style>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script language='javascript'>

//�ּ� �Լ�
function openDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {
			// �˾����� �˻���� �׸��� Ŭ�������� ������ �ڵ带 �ۼ��ϴ� �κ�.

			// �� �ּ��� ���� ��Ģ�� ���� �ּҸ� �����Ѵ�.
			// �������� ������ ���� ���� ��쿣 ����('')���� �����Ƿ�, �̸� �����Ͽ� �б� �Ѵ�.
			var fullAddr = ''; // ���� �ּ� ����
			var extraAddr = ''; // ������ �ּ� ����

			// ����ڰ� ������ �ּ� Ÿ�Կ� ���� �ش� �ּ� ���� �����´�.
			if (data.userSelectedType === 'R') { // ����ڰ� ���θ� �ּҸ� �������� ���
				fullAddr = data.roadAddress;

			} else { // ����ڰ� ���� �ּҸ� �������� ���(J)
				fullAddr = data.jibunAddress;
			}

			// ����ڰ� ������ �ּҰ� ���θ� Ÿ���϶� �����Ѵ�.
			if(data.userSelectedType === 'R'){
				//���������� ���� ��� �߰��Ѵ�.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// �ǹ����� ���� ��� �߰��Ѵ�.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// �������ּ��� ������ ���� ���ʿ� ��ȣ�� �߰��Ͽ� ���� �ּҸ� �����.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// �����ȣ�� �ּ� ������ �ش� �ʵ忡 �ִ´�.
			document.getElementById('zipcode').value = data.zonecode; //5�ڸ� �������ȣ ��� �ּҸ� �Ϸķ� ������ �� ��� VALUE���� �� ���غ���
			document.getElementById('addr01').value = fullAddr;
			document.getElementById('addr02').focus();
		}
	}).open();
}

function check_form(){

	form = document.FRM;
	
	if(isFrmEmpty(form.userid,"������ �Է��� �ֽʽÿ�"))	return;
	if(isFrmEmpty(form.puse,"���뵵�� ������ �ֽʽÿ�"))	return;

	//oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);
	 
	form.action = 'proc.php';
	form.submit();
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(){
	
	if(confirm('�ش� �����͸� �����Ͻðڽ��ϱ�?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}
}

function setUserID() {
	
	userid = $("#userid option:selected").val(); // userid�� select������ �ۿ�

//	$('#name').val(''); // ���� input value id�� name�� �� �����ͼ� �ʱ�ȭ ��Ű�� ���� ('') null�� ��Ƽ� ������ �ʱ�ȭ ��Ų��
	$('#securi').val(''); // �ֹε�Ϲ�ȣ ���ڸ�
	$('#securi2').val(''); // �ֹε�Ϲ�ȣ ���ڸ�
	$('#zipcode').val(''); // �����ȣ
	$('#addr01').val(''); // �ּ�1
	$('#addr02').val(''); // �ּ�2
	$('#team').val(''); // �Ҽ�
	$('#affil').val(''); // ����
	$('#idate01').val(''); // �����Ⱓ ��
	$('#idate02').val(''); // �����Ⱓ ��
	$('#idate03').val(''); // �����Ⱓ ��

	if(userid){
		$.post('./jsonUser.php',{'userid':userid}, function(req){ // json ������� �����Ͽ� ���ϰ� �ޱ�.
			
			parData = JSON.parse(req); // ���ڿ� ���� �м�, ��ü����
			
//			name = parData['name']; // name�̶�� ��ü�� ����
			securi = parData['securi'];
			securi2 = parData['securi2'];
			zipcode = parData['zipcode'];
			addr01 = parData['addr01'];
			addr02 = parData['addr02'];
			team = parData['team'];
			affil = parData['affil'];
			idate01 = parData['idate01'];
			idate02 = parData['idate02'];
			idate03 = parData['idate03'];
			pdate01 = parData['pdate01'];
			pdate02 = parData['pdate02'];
			pdate03 = parData['pdate03'];

//			$('#name').val(name); // ���� �ٽ� name�̶�� ������ ��´�.
			$('#securi').val(securi); // �ֹε�Ϲ�ȣ ���ڸ�
			$('#securi2').val(securi2); // �ֹε�Ϲ�ȣ ���ڸ�
			$('#zipcode').val(zipcode); // �����ȣ
			$('#addr01').val(addr01); // �ּ�1
			$('#addr02').val(addr02); // �ּ�2
			$('#team').val(team); // �Ҽ�
			$('#affil').val(affil); // ����
			$('#idate01').val(idate01); // �����Ⱓ ��
			$('#idate02').val(idate02); // �����Ⱓ ��
			$('#idate03').val(idate03); // �����Ⱓ ��
			$('#pdate01').val(pdate01); // �����Ⱓ ��
			$('#pdate02').val(pdate02); // �����Ⱓ ��
			$('#pdate03').val(pdate03); // �����Ⱓ ��

//			req = urldecode(req); // ������ ���ڵ� ��ü�� ����ؼ� URL�� ���ڵ��� ���ڿ��� ���ڵ��� ���ڿ��� ��ȯ �̰Ŵ� ANSI UTF8��ȯ
		});
	}
}

/*
function setUserID(){
	form = document.FRM;
	form.action = "<?=$_SERVER['PHP_SELFT']?>";
	form.submit();
}
*/

</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='mtype' value='<?=$mtype?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='type' value='<?=$type?>'>


<!-- �˻����� -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>
<input type='hidden' name='f_site' value='<?=$f_site?>'>
<input type='hidden' name='f_naverID' value='<?=$f_naverID?>'>
<input type='hidden' name='f_daumID' value='<?=$f_daumID?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sDate' value='<?=$f_sDate?>'>
<input type='hidden' name='f_eDate' value='<?=$f_eDate?>'>

<!-- /�˻����� -->
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
	<tr> 
		<th width="17%">��  ��</th>
		<td>
			<select name='userid' id="userid" onchange="setUserID()">
				<option value=''>::�������::</option>
			<?
				for($i=0; $i<count($arr_member); $i++){
			?>
				<option value='<?=$arr_userid[$i]?>' <?if($f_userid==$arr_userid[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
			<?
				}
			?>
			</select>
			
			<select name='puse'>
				<option value=''>::���뵵::</option>
				<option value='�������'<? echo $puse =='�������' ? 'selected':''?>>�������</option>
				<option value='������'<? echo $puse =='������' ? 'selected':''?>>������</option>
				<option value='��Ÿ'<? echo $puse =='��Ÿ' ? 'selected':''?>>��Ÿ</option>
			</select>
		</td>
	</tr>    
           
	<tr>
		<th>�ֹε�Ϲ�ȣ</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' id='securi' name='securi' style='width:60px;' value='<?=$securi?>' maxlength='6' readonly> - <input type='text'  id='securi2' name='securi2' style='width:70px;' value='<?=$securi2?>' maxlength='7' readonly></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>��  ��</th>
		<td>
			<span style='display:block; padding-top:3px;'>
				<input type='text' name='zipcode'  id="zipcode" style='width:180px;' value='<?=$zipcode?>' readonly>
				<input type='text' id="addr01" name='addr01' style='width:32%' value='<?=$addr01?>' readonly>
				<input type='text' id="addr02" name='addr02' style='width:30%' value='<?=$addr02?>' readonly>
			</span>
		</td>
	</tr>

	<tr>
		<th>ȸ �� ��</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='actxt01' name='actxt01' style='width:180px; background-color:#eee' value="<?=$actxt01?>" readonly></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>����� ��ȣ</th>
		<td>
			<input type='text' name='cmp_num' style='width:180px;' value='<?=$cmp_num?>' readonly>
		</td>
	</tr>

	<tr>
		<th>�� �� ��</th>
		<td>
			<input type='text' name='cmp_adr' style='width:350px;' value='<?=$cmp_adr?>' readonly>
		</td>
	</tr>

	<tr>
		<th>��  ��</th>
		<td>
			<input type='text' id="team" name='team' value='<?=$team?>' readonly>
		</td>
	</tr>

	<tr>
		<th>��  ��</th>
		<td>
			<input type='text' id="affil" name='affil' value='<?=$affil?>' readonly>
		</td>
	</tr>

	<tr>
		<th>�����Ⱓ</th>
		<td>
			<span class="r_date_wrap" readonly>
			<input type='text' id="idate01" name='idate01' value='<?=$idate01?>' readonly>��<input type='text' id="idate02" name='idate02' value='<?=$idate02?>' readonly>��<input type='text' id="idate03" name='idate03' value='<?=$idate03?>' readonly>��~			
				<input type='text' id="pdate01" name='pdate01' value='<?=$pdate01?>' readonly>��<input type='text' id="pdate02" name='pdate02' value='<?=$pdate02?>' readonly>��<input type='text' id="pdate03" name='pdate03' value='<?=$pdate03?>' readonly>��
			</span>
		</td>
	</tr>

	<tr>
		<th>��ǥ�̻� </th>
		<td><input type='text' name='team' style='width:50px;' value='<?=$ceo_nm?>' readonly></td>
	</tr>

</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<!-- <tr>
		<td style='padding:3px 0px 0111111111111111111111111111111111px 0px;'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></td>
	</tr> -->

	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>

				<tr>				

					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form();"><img src="../../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="../../img/board/delete1.gif" border=0></a>&nbsp;

<?
}
?>
						<a href="javascript:reg_list();"><img src="../../img/board/list01.gif" border=0></a>&nbsp;

					</td>

				</tr>
			</table>
		</td>
	</tr>
</table> 






</form>

<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* ������ ����� ���â ���ֱ� */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>


<link type='text/css' rel='stylesheet' href='/skins/js/placeholder.css'><!-- ��Ŷ�������� -->
<script src="/skins/js/jquery.placeholder.js"></script><!-- placeholder �±�ó���� -->
<script type="text/javascript">
$('input, textarea').placeholder();
</script>