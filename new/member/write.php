<?

	if($uid){

		$sql = "select * from wo_member where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$pwd = $row["pwd"];
		$name = $row["name"];
		$securi = $row["securi"];
		$securi2 = $row["securi2"];
		$team = $row["team"];
		$mobile = $row["mobile"];
		$telephone = $row["telephone"];
		$email = $row["email"];
		$bir01 = $row["bir01"];
		$bir02 = $row["bir02"];
		$bir03 = $row["bir03"];
		$account = $row["account"];
		$mtype = $row["mtype"];
		$mname = $row["mname"];
		$idate01 = $row["idate01"];
		$idate02 = $row["idate02"];
		$idate03 = $row["idate03"];
		$itime = $row["itime"];
		$sex = $row["sex"];
		$enable = $row["enable"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$affil = $row["affil"];
		$pdate01 = $row["pdate01"];
		$pdate02 = $row["pdate02"];
		$pdate03 = $row["pdate03"];

		$birthday = '';
		if($bir01)	$birthday = $bir01.'�� ';
		if($bir02)	$birthday .= $bir02.'�� ';
		if($bir03)	$birthday .= $bir03.'�� ';

		$pdateday = '';
		if($pdate01)	$pdateday = $pdate01.'�� ';
		if($pdate02)	$pdateday .= $pdate02.'�� ';
		if($pdate03)	$pdateday .= $pdate03.'�� ';

		$type = 'edit';

	}else{
		$type = 'write';

	}
?>

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

	if('<?=$type?>' == 'write'){
		
		if(isFrmEmpty(form.userid,"���̵� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.pwd,"��й�ȣ�� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.name,"������ �Է��� �ֽʽÿ�")) return;
		if(isFrmEmpty(form.securi,"�ֹι�ȣ ���ڸ��� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.securi2,"�ֹι�ȣ ���ڸ��� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.bir01,"������ �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.bir02,"������ �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.bir03,"������ �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.idate01,"�Ի����� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.idate02,"�Ի����� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.idate03,"�Ի����� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.mobile,"�޴���ȭ�� �Է��� �ֽʽÿ�")) return;
		if(isFrmEmpty(form.telephone,"�Ϲ���ȭ�� �Է��� �ֽʽÿ�")) return;
		if(isFrmEmpty(form.email,"�̸����� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.account,"���¹�ȣ�� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.zipcode,"�ּҸ� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.addr01,"�ּҸ� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.addr02,"�ּҸ� �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.team,"���� ������ �ֽʽÿ�")) return;
		if(isFrmEmpty(form.mtype,"Ÿ���� ������ �ֽʽÿ�")) return;
		if(isFrmEmpty(form.affil," ������ ������ �ֽʽÿ�")) return;
/*
		if(isFrmEmpty(form.pdate01,"������ �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.pdate02,"������ �Է��� �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.pdate03,"������ �Է��� �ֽʽÿ�"))	return;
*/
	}

/*
	if('<?=$GBL_MTYPE?>' == 'A'){
	    
		var code_list = form.mtype;
		var intPos = code_list.selectedIndex;
		var strText = code_list[intPos].text;
	
		form.mname.value = strText;

	}
*/

	form.action = 'proc.php';
	form.submit();
}

function check_del(){
	if(confirm('���̵� �����Ͻðڽ��ϱ�?')){
		form = document.FRM;
		form.type.value = 'del';
		form.action = 'proc.php';
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

// �ֹε�Ϲ�ȣ ����ŷ ����
//��ť��Ʈ ����
$(function(){
	
	//securi3 ���̵� �Ӽ�, label �����Ҷ� for ���, change�� ǥ��, ��ǥ�� ����
	$('#securi3').change(function(){
	
		//chk��� ������ �����ؼ� üũ�ڽ��� üũ�� ���¸� chk�� �����ߴ�
		let chk = $('input:checkbox[id="securi3"]').is(":checked");
		
		//chk�� ������ Ÿ���� �ؽ�Ʈ�� ����, chk�� �ƴϸ� Ÿ���� �н������ ����.
		if (chk == true) {
                    $('#securi2').attr('type','text');
                }else{
                    $('#securi2').attr('type','password');
                }
	});
});

</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
	<input type='hidden' name='type' value='<?=$type?>'>
	<input type='hidden' name='uid' value='<?=$uid?>'>
	<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>

<!--���-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">���̵�</th>
					<td width="33%">
					<?
						if($type=='write'){
					?>
						<input type='text' name='userid' style='width:150px;' value='<?=$userid?>'>
					<?
						}else{
					?>
						<?=$userid?>
					<?
						}
					?>
					</td>
					<th width="17%">��й�ȣ</th>
					<td width="33%"><input type='text' name='pwd' style='width:150px' value='<?=$pwd?>'></td>
				</tr>

				<tr> 
					<th width="17%">����</th>
					<td width="33%">
						<input type='text' name='name' style='width:150px' value='<?=$name?>'>&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' id='sex1' name='sex' value='��' <?if($sex=='��' || $sex==''){echo 'checked';}?>><label for='sex1'>��&nbsp;&nbsp;</label>
						<input type='radio' id='sex2' name='sex' value='��' <?if($sex=='��'){echo 'checked';}?>><label for='sex2'>��</label>
					</td>
					<th width="17%">�ֹε�Ϲ�ȣ</th>
					<td width="33%">
						<input type='text' name='securi' style='width:60px;' value='<?=$securi?>' maxlength='6'> - <input type='password' id='securi2' name='securi2' style='width:90px;' value='<?=$securi2?>' maxlength='7'><input type = 'checkbox' id='securi3'><label for='securi3'>���ڸ�ǥ��</label>
					</td>
				</tr>

				<tr> 
					<th width="17%">����</th>
					<td width="33%">
						<select name='bir01'>
							<option value=''>===</option>
					<?
						$myear = date('Y') - 10;
						for($i=$myear; $i>=1950; $i--){
					?>
							<option value='<?=$i?>' <?if($bir01==$i){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>�� 

						<select name='bir02'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=12; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($bir02==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>�� 

						<select name='bir03'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=31; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($bir03==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>�� 						

					</td>
					<th>�Ի���</th>
					<td>
						<select name='idate01'>
							<option value=''>===</option>
					<?
						$myear = date('Y');
						for($i=$myear; $i>=2010; $i--){
					?>
							<option value='<?=$i?>' <?if($idate01==$i){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>�� 

						<select name='idate02'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=12; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($idate02==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>�� 

						<select name='idate03'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=31; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($idate03==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>��
					</td>
				</tr>

				<tr> 
					<th>�޴���ȭ</th>
					<td><input type='text' name='mobile' style='width:100%' value='<?=$mobile?>'></td>
					<th>�Ϲ���ȭ</th>
					<td><input type='text' name='telephone' style='width:100%' value='<?=$telephone?>'></td>
				</tr>

				<tr> 
					<th>�̸���</th>
					<td><input type='text' name='email' style='width:100%' value='<?=$email?>'></td>
					<th>���¹�ȣ</th>
					<td><input type='text' name='account' style='width:100%' value='<?=$account?>'></td>
				</tr>

				<tr>
					<th>�ּ�</th>
					<td colspan='3' style='margin-right:2px;'>
						<input type='text' name='zipcode'  id="zipcode" style='width:100px; margin-right:10px;' value='<?=$zipcode?>'><a href = "javascript:openDaumPostcode();" style='cursor:pointer' class='small cbtn black'>�ּ�ã��</a><span style='padding-left:10px;'><input type='text' id="addr01" name='addr01' style='width:35%' value='<?=$addr01?>'><input type='text' id="addr02" name='addr02' placeholder='���ּ��Է�' style='width:46%; margin-left:10px;' value='<?=$addr02?>'></span>
					</td>
				</tr>

				<tr>
					<th>��</th>
					<td>
						<select name='team' id='team'>
						<?
							for($i=0; $i<count($arr_team); $i++){
						?>
							<option value='<?=$arr_team[$i]?>' <?if($team==$arr_team[$i]) echo 'selected';?>><?=$arr_team[$i]?></option>
						<?
							}
						?>
						</select>
					<?
						if($GBL_MTYPE == 'A'){
					?>
						<select name='mtype'>
							<option value='' <?if($mtype=='') echo '';?>>����</option>
							<option value='M' <?if($mtype=='M') echo 'selected';?>>���</option>
						<?
							for($i=0; $i<count($arr_team); $i++){
								$txt01 = $arr_team[$i].'��';
						?>
							<option value='S' <?if($mname==$txt01) echo 'selected';?>><?=$txt01?></option>
						<?
							}
						?>
							<option value='A' <?if($mtype=='A') echo 'selected';?>>������</option>
						</select>
					<?
						}
					?>
					</td>
					
					<th>����</th>
					<td colspan='3'>
						<select name='affil' id="affil"> <!-- select�� ������Ű�� -->
							<option value=''>==</option>
							<option value='���'<? echo $affil =='���' ? 'selected':''?>>���</option>
							<option value='����'<? echo $affil =='����' ? 'selected':''?>>����</option>
							<option value='�븮'<? echo $affil =='�븮' ? 'selected':''?>>�븮</option>
							<option value='����'<? echo $affil =='����' ? 'selected':''?>>����</option>
							<option value='����'<? echo $affil =='����' ? 'selected':''?>>����</option>
							<option value='����'<? echo $affil =='����' ? 'selected':''?>>����</option>
							<option value='�̻�'<? echo $affil =='�̻�' ? 'selected':''?>>�̻�</option>
							<option value='��ǥ'<? echo $affil =='��ǥ' ? 'selected':''?>>��ǥ</option>
						</select>
					</td>
				</tr>
					<th>����</th>
					<td>
						<input type='radio' id='enable1' name='enable' value='1' <?if($enable == '1'){echo 'checked';}?>><label for='enable1'>�ٹ�&nbsp;</label>
						<input type='radio' id='enable2' name='enable' value='' <?if($enable == ''){echo 'checked';}?>><label for='enable2'>���</label>
					</td>
					<th>�ٹ��Ⱓ</th>
					<td>
						<select name='pdate01'>
							<option value=''>===</option>
					<?
						$myear = date('Y');
						for($i=$myear; $i>=2010; $i--){
					?>
							<option value='<?=$i?>' <?if($pdate01==$i){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>��

						<select name='pdate02'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=12; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($pdate02==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>�� 

						<select name='pdate03'>
							<option value=''>==</option>
					<?
						for($i=1; $i<=31; $i++){
							$no = sprintf('%02d',$i);
					?>
							<option value='<?=$no?>' <?if($pdate03==$no){echo 'selected';}?>><?=$i?></option>

					<?
						}
					?>
						</select>��
					</td>

			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>


					<td align='right'>
<?
	if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../img/board/register.gif" border=0></a>&nbsp;
<?
	}else{
?>
	<?
		if($GBL_MTYPE == 'A'){
	?>
						<a href="javascript:check_del();"><img src="../img/board/delete1.gif" border=0></a>&nbsp;
	<?
		}
	?>
	
						<a href="javascript:check_form();"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
<?
	}
?>
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>
					</td>

				</tr>
			</table>
		</td>
	</tr>
</table>

</form>

