<?

	if($uid){

		$sql = "select * from wo_bus02 where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$mtype = $row["mtype"];
		$company = $row["company"];
		$id = $row["id"];
		$pwd = $row["pwd"];
		$name = $row["name"];
		$homepage = $row["homepage"];
		$telephone = $row["telephone"];
		$date01 = $row["date01"];
		$account = $row["account"];
		$ment = $row["ment"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];
		$fax = $row["fax"];
		$email = $row["email"];
		


	}


	if(!$userid)	$userid = $GBL_USERID;



?>


<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>


function check_form(){
	form = document.FRM;
	
	if(isFrmEmpty(form.company,"��ü���� �Է��� �ֽʽÿ�"))	return;	

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
	
	if(confirm('�ش��ü�� �����Ͻðڽ��ϱ�?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}

}



</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>

<!-- �˻����� -->
<input type='hidden' name='f_mtype' value='<?=$f_mtype?>'>
<input type='hidden' name='f_company' value='<?=$f_company?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_homepage' value='<?=$f_homepage?>'>
<input type='hidden' name='f_telephone' value='<?=$f_telephone?>'>
<!-- /�˻����� -->


<!--���-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">�з�</th>
					<td width="83%" colspan='3'>
						<select name='mtype'>
							<option value=''>===</option>
							<option value='����ó' <?if($mtype=='����ó'){echo 'selected';}?>>����ó</option>
							<option value='��������' <?if($mtype=='��������'){echo 'selected';}?>>��������</option>
							<option value='��������' <?if($mtype=='��������'){echo 'selected';}?>>��������</option>
							<option value='���޾�ü' <?if($mtype=='���޾�ü'){echo 'selected';}?>>���޾�ü</option>
							<option value='�����ð���' <?if($mtype=='�����ð���'){echo 'selected';}?>>�����ð���</option>
							<option value='��Ÿ' <?if($mtype=='��Ÿ'){echo 'selected';}?>>��Ÿ</option>
						</select>
					</td>
				</tr>

				<tr> 
					<th width="17%">��ü��</th>
					<td width="33%"><input type='text' name='company' style='width:100%;' value='<?=$company?>'></td>
					<th width="17%">�����</th>
					<td width="33%"><input type='text' name='name' style='width:100%;' value='<?=$name?>'></td>
				</tr>

				<tr> 
					<th>Ȩ������</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='homepage' style='width:145px;' value='<?=$homepage?>'></td>
					<?
						if($homepage){
							$link_domain = str_replace('http://','',$homepage);
					?>
								<td width='10'></td>
								<td><a href='http://<?=$link_domain?>' target='_blank'><img src='../img/ico_home.gif' valign='bottom'></a></td>
					<?
						}
					?>
							</tr>
						</table>
					</td>
					<th>�̸���</th>
					<td><input type='text' name='email' style='width:100%;' value='<?=$email?>'></td>
				</tr>

				<tr> 
					<th>��ȭ��ȣ</th>
					<td><input type='text' name='telephone' style='width:100%;' value='<?=$telephone?>'></td>
					<th>�ѽ�</th>
					<td><input type='text' name='fax' style='width:100%;' value='<?=$fax?>'></td>
				</tr>

				<tr> 
					<th>���̵�</th>
					<td><input type='text' name='id' style='width:145px;' value='<?=$id?>'></td>
					<th>��й�ȣ</th>
					<td><input type='text' name='pwd' style='width:145px;' value='<?=$pwd?>'></td>
				</tr>


				<tr> 
					<th>���Ⱓ</th>
					<td><input type='text' name='date01' style='width:100%;' value='<?=$date01?>'></td>
					<th>��������</th>
					<td><input type='text' name='account' style='width:100%;' value='<?=$account?>'></td>
				</tr>

				<tr> 
					<th>÷������</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input type='file' name='upfile01' class='file03'><?if($userfile01){?><input type='checkbox' name='del_upfile01' value='Y'>���� (<?=$realfile01?>)<?}?></td>
								<td width='100' align='right' valign='bottom'>
<?
	if($realfile01){		
		echo ("<a href='../file_down.php?folder=job&rfile=$userfile01&sname=$realfile01'><img src='../img/common/down.gif'></a>");

	}
?>
								</td>
							</tr>
						</table>
					</td>
				</tr>


				<tr> 
					<th>��Ÿ����</th>
					<td colspan='3'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
				</tr>


			</table>


		</td>
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