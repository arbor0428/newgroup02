<?

	if($uid){

		$sql = "select * from wo_lgu where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row['userid'];
		$mtype = $row['mtype'];
		$status = $row['status'];
		$name = $row['name'];
		$cnum = $row['cnum'];
		$ceo = $row['ceo'];
		$zip01 = $row['zip01'];
		$zip02 = $row['zip02'];
		$addr01 = $row['addr01'];
		$addr02 = $row['addr02'];
		$phone01 = $row['phone01'];
		$phone02 = $row['phone02'];
		$phone03 = $row['phone03'];
		$mobile01 = $row['mobile01'];
		$mobile02 = $row['mobile02'];
		$mobile03 = $row['mobile03'];
		$email = $row['email'];
		$pname = $row['pname'];
		$pday = $row['pday'];
		$ptype = $row['ptype'];
		$pmode = $row['pmode'];
		$pemail = $row['pemail'];
		$pzip01 = $row['pzip01'];
		$pzip02 = $row['pzip02'];
		$paddr01 = $row['paddr01'];
		$paddr02 = $row['paddr02'];
		$pbank = $row['pbank'];
		$paccount = $row['paccount'];
		$pend = $row['pend'];
		$ment = $row['ment'];	
		$rDate = $row['rDate'];
		$staff = $row['staff'];
		$service01 = $row['service01'];
		$service02 = $row['service02'];
		$service03 = $row['service03'];
		$service04 = $row['service04'];
		$service05 = $row['service05'];
		$service06 = $row['service06'];
		$pnum = $row['pnum'];

	}else{
		$rDate = date('Y-m-d');
	}


	if(!$userid)	$userid = $GBL_USERID;

	$rTxt = explode('-',$rDate);
	$ry = $rTxt[0];
	$rm = $rTxt[1];
	$rd = $rTxt[2];



	//������ǥ��ȣ
	$sample1 = "<br><br><b>* ������ǥ��ȣ</b><br>������ǥ��ȣ : <br>����ȸ���� : <br>������ȭ��ȣ : <br>��û�� : <br>������ : 1��/2��/3��<br>������� : �⺻��/�и�������/������<br><br><br>";

	//���070
	$sample2 = "<br><br><b>* ���070 ��ȣ</b><br>���070 ��ȣ : <br>��ȣ���� : �ű�/��ȣ�̵�/�߰�<br>��û�� : <br>������ : 1��/2��/3��<br>��Ʈ���� : �����/IMS/�Ϲ���<br>�𵨸� : <br>�ܸ��Һ� : �Ͻú�/�Һ�(�Һΰ�����:  )<br>������� : <br>��ġ�ּ� : <br><br><br>";

	//���ǽ���
	$sample3 = "<br><br><b>* ���ǽ���</b><br>���ǽ���(ȸ������) : <br>��ġ�ּ� : <br>�ܸ���� : <br>����� : <br>��û�� : <br>������ : <br><br><br>";

?>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function openDaumPostcode(m) {
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
//			document.getElementById('sample6_postcode').value = data.zonecode; //5�ڸ� �������ȣ ���

			if(m == 1){
				document.getElementById('zip01').value = data.postcode1;
				document.getElementById('zip02').value = data.postcode2;
				document.getElementById('addr01').value = fullAddr;
				document.getElementById('addr02').focus();
			}else if(m == 2){
				document.getElementById('pzip01').value = data.postcode1;
				document.getElementById('pzip02').value = data.postcode2;
				document.getElementById('paddr01').value = fullAddr;
				document.getElementById('paddr02').focus();
			}
		}
	}).open();
}


function check_form(){
	form = document.FRM;
	
	if(isFrmEmpty(form.name,"���� �Է��� �ֽʽÿ�"))	return;	

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

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

function chk_box(txt,no){
	obj = document.getElementsByName(txt);

	if(obj[no].checked == true){
		for(i=0; i<obj.length; i++){
			if(i != no)	obj[i].checked = false;
		}
	}
}

function addMent(m){
	if(m == 1){
		oEditors.getById["ment"].exec("PASTE_HTML", ["<?=$sample1?>"]);

	}else if(m == 2){
		oEditors.getById["ment"].exec("PASTE_HTML", ["<?=$sample2?>"]);

	}else if(m == 3){
		oEditors.getById["ment"].exec("PASTE_HTML", ["<?=$sample3?>"]);

	}
}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>

<!-- �˻����� -->
<input type='hidden' name='f_mtype' value='<?=$f_mtype?>'>
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_ceo' value='<?=$f_ceo?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_service01' value='<?=$f_service01?>'>
<input type='hidden' name='f_service02' value='<?=$f_service02?>'>
<input type='hidden' name='f_service03' value='<?=$f_service03?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_sy' value='<?=$f_sy?>'>
<input type='hidden' name='f_sm' value='<?=$f_sm?>'>
<input type='hidden' name='f_sd' value='<?=$f_sd?>'>
<input type='hidden' name='f_ey' value='<?=$f_ey?>'>
<input type='hidden' name='f_em' value='<?=$f_em?>'>
<input type='hidden' name='f_ed' value='<?=$f_ed?>'>
<!-- /�˻����� -->


<!--���-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><b>1. ������</b></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th>����</th>
					<td colspan='3'>
						<input type='checkbox' name='mtype' value='����' <?if($mtype == '����'){echo 'checked';}?> onclick='chk_box(this.name,0);'>����&nbsp;&nbsp;
						<input type='checkbox' name='mtype' value='���λ����' <?if($mtype == '���λ����'){echo 'checked';}?> onclick='chk_box(this.name,1);'>���λ����&nbsp;&nbsp;
						<input type='checkbox' name='mtype' value='����' <?if($mtype == '����'){echo 'checked';}?> onclick='chk_box(this.name,2);'>����
					</td>
				</tr>

				<tr>
					<th>����</th>
					<td colspan='3'>
					<?
						for($i=0; $i<count($statusArr); $i++){
							$sTxt = $statusArr[$i];
							if($sTxt == $status)	$chk = 'checked';
							else						$chk = '';

							echo ("<input type='checkbox' name='status' value='$sTxt' $chk onclick='chk_box(this.name,$i);'>$sTxt&nbsp;&nbsp;");
						}
					?>
					</td>
				</tr>

				<tr> 
					<th width="17%">����(ȸ���)</th>
					<td width="33%"><input type='text' name='name' style='width:180px;' value='<?=$name?>'></td>
					<th width="17%">�������(����ڹ�ȣ)</th>
					<td width="33%"><input type='text' name='cnum' style='width:180px;' value='<?=$cnum?>'></td>
				</tr>

				<tr> 
					<th>��ǥ�ڸ�</th>
					<td><input type='text' name='ceo' style='width:180px;' value='<?=$ceo?>'></td>
					<th>��ǥ��ȣ</th>
					<td><input type='text' name='pnum' style='width:180px;' value='<?=$pnum?>'></td>
				</tr>

				<tr>
					<th>�ּ�</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input name="zip01" id="zip01" type="text" style='width:50px;' value='<?=$zip01?>' maxlength='3'> - <input name="zip02" id="zip02" type="text" style='width:50px;' value='<?=$zip02?>' maxlength='3'>
								<a href="javascript:openDaumPostcode(1);"><img src='/images/member/order_add.gif' border='0' style='margin:5 0 -5 0' alt='�����ȣ' /></a></td>
							</tr>
							<tr>
								<td style='padding:3px 0px 0px 0px;'><input name='addr01' id='addr01' type='text' style='width:312px;' value='<?=$addr01?>'></td>
							</tr>
							<tr>
								<td style='padding:3px 0px 0px 0px;'><input name='addr02' id='addr02' type='text' style='width:312px;' value='<?=$addr02?>'></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<th>�Ϲ���ȭ</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='phone01' style='width:40px;' value='<?=$phone01?>' maxlength='4'> - <input type='text' name='phone02' style='width:40px;' value='<?=$phone02?>' maxlength='4'>- <input type='text' name='phone03' style='width:40px;' value='<?=$phone03?>' maxlength='4'></td>
								<td style='padding-left:10px;'><a href="javascript:document.ifra_sms.getNum(FRM.phone01.value,FRM.phone02.value,FRM.phone03.value);"><img src='../img/ico_phone.gif'></a></td>
							</tr>
						</table>
					</td>
					<th>�޴���ȭ</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='mobile01' style='width:40px;' value='<?=$mobile01?>'> - <input type='text' name='mobile02' style='width:40px;' value='<?=$mobile02?>'>- <input type='text' name='mobile03' style='width:40px;' value='<?=$mobile03?>'></td>
								<td style='padding-left:10px;'><a href="javascript:document.ifra_sms.getNum(FRM.mobile01.value,FRM.mobile02.value,FRM.mobile03.value);"><img src='../img/ico_phone.gif'></a></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<th>e-mail</th>
					<td colspan='3'><input type='text' name='email' style='width:180px;' value='<?=$email?>'></td>
				</tr>

				<tr> 
					<th>��������</th>
					<td colspan='3'>
						<select name='ry'>
						<?
							for($i=2015; $i<=date('Y')+10; $i++){
						?>
							<option value='<?=$i?>' <?if($ry==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>�� 

						<select name='rm'>
						<?
							for($i=1; $i<=12; $i++){
								$no = sprintf('%02d',$i);
						?>
							<option value='<?=$no?>' <?if($rm==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>�� 
						
						<select name='rd'>
						<?
							for($i=1; $i<=31; $i++){
								$no = sprintf('%02d',$i);
						?>
							<option value='<?=$no?>' <?if($rd==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>�� 
					</td>
				</tr>
			</table>
		</td>
	</tr>


	<tr>
		<td style='padding:50px 0px 0px 0px;'><b>2. ���ι��</b></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">������</th>
					<td width="33%"><input type='text' name='pname' style='width:180px;' value='<?=$pname?>'></td>
					<th width="17%">������</th>
					<td width="33%">
						<input type='checkbox' name='pday' value='22��' <?if($pday == '22��'){echo 'checked';}?> onclick='chk_box(this.name,0);'>22��&nbsp;&nbsp;
						<input type='checkbox' name='pday' value='26��' <?if($pday == '26��'){echo 'checked';}?> onclick='chk_box(this.name,1);'>26��&nbsp;&nbsp;
						<input type='checkbox' name='pday' value='����' <?if($pday == '����'){echo 'checked';}?> onclick='chk_box(this.name,2);'>����
					</td>
				</tr>

				<tr> 
					<th>����</th>
					<td>
						<input type='checkbox' name='ptype' value='�ڵ���ü' <?if($ptype == '�ڵ���ü'){echo 'checked';}?> onclick='chk_box(this.name,0);'>�ڵ���ü&nbsp;&nbsp;
						<input type='checkbox' name='ptype' value='����' <?if($ptype == '����'){echo 'checked';}?> onclick='chk_box(this.name,1);'>����
					</td>
					<th>û���� ���ɹ��</th>
					<td>
						<input type='checkbox' name='pmode' value='����' <?if($pmode == '����'){echo 'checked';}?> onclick='chk_box(this.name,0);'>����&nbsp;&nbsp;
						<input type='checkbox' name='pmode' value='e-mail' <?if($pmode == 'e-mail'){echo 'checked';}?> onclick='chk_box(this.name,1);'>e-mail
					</td>
				</tr>

				<tr> 
					<th>�̸���</th>
					<td colspan='3'><input type='text' name='pemail' style='width:180px;' value='<?=$pemail?>'></td>
				</tr>

				<tr>
					<th>û�����ּ�</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input name="pzip01" id="pzip01" type="text" style='width:50px;' value='<?=$pzip01?>' maxlength='3'> - <input name="pzip02" id="pzip02" type="text" style='width:50px;' value='<?=$pzip02?>' maxlength='3'>
								<a href="javascript:openDaumPostcode(2);"><img src='/images/member/order_add.gif' border='0' style='margin:5 0 -5 0' alt='�����ȣ' /></a></td>
							</tr>
							<tr>
								<td style='padding:3px 0px 0px 0px;'><input name='paddr01' id='paddr01' type='text' style='width:312px;' value='<?=$paddr01?>'></td>
							</tr>
							<tr>
								<td style='padding:3px 0px 0px 0px;'><input name='paddr02' id='paddr02' type='text' style='width:312px;' value='<?=$paddr02?>'></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<th>����(ī���)��</th>
					<td colspan='3'><input type='text' name='pbank' style='width:180px;' value='<?=$pbank?>'></td>
				</tr>

				<tr> 
					<th>����(ī��)��ȣ</th>
					<td><input type='text' name='paccount' style='width:180px;' value='<?=$paccount?>'></td>
					<th>ī����ȿ�Ⱓ</th>
					<td><input type='text' name='pend' style='width:180px;' value='<?=$pend?>'></td>
				</tr>
			</table>
		</td>
	</tr>



	<tr>
		<td style='padding:50px 0px 0px 0px;'><b>3. �����</b></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">�����</th>
					<td width="83%">
						<select name='staff'>
							<option value=''>===</option>
						<?
							for($i=0; $i<count($arr_member); $i++){
						?>
							<option value='<?=$arr_member[$i]?>' <?if($staff==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
						<?
							}
						?>
						</select>						
					</td>
				</tr>

				<tr> 
					<th>�̿��ǰ</th>
					<td colspan='3'>
					<?
						for($s=0; $s<count($serviceArr); $s++){
							$v = sprintf('%02d',$s+1);
							if(${'service'.$v})	$chk = 'checked';
							else						$chk = '';
					?>
						<input type='checkbox' name='service<?=$v?>' value='1' <?=$chk?>><?=$serviceArr[$s]?>&nbsp;&nbsp;
					<?
						}
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>



	<tr>
		<td style='padding:50px 0px 0px 0px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><b>4. LG U+ ���� ��û���� �� �ΰ�����</b></td>
					<td align='right'>
						<input type='button' name='btn01' value='������ǥ��ȣ' onclick='addMent(1);' style='cursor:pointer;'>
						<input type='button' name='btn01' value='���070' onclick='addMent(2);' style='cursor:pointer;'>
						<input type='button' name='btn01' value='���ǽ���' onclick='addMent(3);' style='cursor:pointer;'>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style='padding:3px 0px 0px 0px;'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>

				<tr>				

					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form();"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="../img/board/delete1.gif" border=0></a>&nbsp;

<?
}
?>
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>&nbsp;

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