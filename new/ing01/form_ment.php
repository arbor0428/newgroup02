<script language='javascript'>
function set_vat(){
	form = document.FRM;
	cost = form.cost.value;

	if(form.cost_vat[1].checked){
		form.cost.value = Math.floor(parseInt(cost) * 1.1); //�ΰ�������
	}else{
		form.cost.value = Math.ceil(parseInt(cost) / 1.1); //�ΰ������̳ʽ�
	} 

}

function msg_modify(info_uid){
	if(info_uid){
		form = document.FRM;

		/* ������ �� ���ݾ� ���� */
		form.cost.value = form['cost'+info_uid].value;
		form.deposit.value = form['deposit'+info_uid].value;
		form.deposit_date.value = form['deposit_date'+info_uid].value;

		if(form['cost_vat'+info_uid].value == '����'){
			form.cost_vat[1].checked = true;

		}else{
			form.cost_vat[0].checked = true;

		}




		/* Ư�̻��׳������ */
		form.mid.value = info_uid;
		
		tmp = form['msg'+info_uid].value;
		oEditors.getById["ment"].exec("SET_CONTENTS", [tmp]);

	}

}



function msg_del(info_uid,obj){

	form = document.FRM;
	
	if(confirm('Ư�̻����� �����Ͻðڽ��ϱ�?')){		
		form.mid.value = info_uid;
		form.type.value = 'info_del'
		form.action = 'proc.php';
		form.submit();

	}else{
		obj.checked = false;

		/* ������ �� ���ݾ� ���� */
		form.cost.value = '';
		form.deposit.value = '';
		form.cost_vat[0].checked = true;
		form.deposit_date.value = '';


		/* Ư�̻��׳������ */
		form.mid.value = '';
		oEditors.getById["ment"].exec("SET_CONTENTS", ['']);

		return;

	}

}
</script>









<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='30' style='padding-top:30px;'><b>6. Ư�̻���</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
<?
	if($uid){
		$query = "select * from wo_ing01_ment where pid='$uid' order by uid desc";
		$query_result = mysql_query($query);
		$tot_ment = mysql_num_rows($query_result);
	}


	if($tot_ment){
		for($i=0; $i<$tot_ment; $i++){
			$info = mysql_fetch_array($query_result);
			$info_uid = $info['uid'];
			$info_ment = $info['ment'];
			$info_date = date('Y-m-d H:i:s',$info['reg_date']);
			$info_cost = $info['cost'];
			$info_cost_vat = $info['cost_vat'];
			$info_deposit = $info['deposit'];
			$info_deposit_date = $info['deposit_date'];


			if($info_cost)	$cost_txt = number_format($info_cost).'��&nbsp;&nbsp;&nbsp;';
			else	$cost_txt = '';

			if($info_cost_vat == '����')	 $cost_txt .= "(<font color='#de712e'>VAT����</font>)";



			if($info_deposit)	$deposit_txt = number_format($info_deposit).'��&nbsp;&nbsp;&nbsp;';
			else	$deposit_txt = '';

			if($info_deposit_date)	$deposit_txt .= '������('.$info_deposit_date.')';

			
?>

				<tr height='30'> 
					<td width="17%" class='tab_tit'>����Ͻ�</td>
					<td width="33%" class='tab'><?=$info_date?></td>
					<td width="17%" class='tab_tit'>����</td>
					<td width="33%" class='tab'>
						<input type='radio' name='btn' onclick="msg_modify('<?=$info_uid?>');">����&nbsp;&nbsp;&nbsp;
						<input type='radio' name='btn' onclick="msg_del('<?=$info_uid?>',this);">����
					</td>
				</tr>
				<tr height='30'> 
					<td class='tab_tit'>������</td>
					<td class='tab'><?=$cost_txt?></td>
					<td class='tab_tit'>���ݾ�</td>
					<td class='tab'><?=$deposit_txt?></td>
				</tr>
				<tr>
					<td height='50' colspan='4' style='padding-bottom:30px;'><?=$info_ment?></td>
				</tr>

				<input type='hidden' name='msg<?=$info_uid?>' value='<?=$info_ment?>'><!-- Ư�̻��� ���� -->
				<input type='hidden' name='cost<?=$info_uid?>' value='<?=$info_cost?>'><!-- ������ -->
				<input type='hidden' name='cost_vat<?=$info_uid?>' value='<?=$info_cost_vat?>'><!-- �ΰ��� -->
				<input type='hidden' name='deposit<?=$info_uid?>' value='<?=$info_deposit?>'><!-- ���ݾ� -->
				<input type='hidden' name='deposit_date<?=$info_uid?>' value='<?=$info_deposit_date?>'><!-- ������ -->

<?
		}
	}else{
?>
				<tr>
					<td height='30'>Ư�̻����� ����� �ֽʽÿ�</td>
				</tr>
<?
	}
?>

			</table>
		</td>
	</tr>
</table>






<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='30' style='padding-top:30px;'><b>7. Ư�̻��׵��</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr height='30'> 
					<td width='17%' class='tab_tit'>������</td>
					<td width='33%' class='tab'>
						<input type='text' name='cost' style='width:60px;' value=''>��&nbsp;&nbsp;&nbsp;&nbsp;
						�ΰ��� : <input type='radio' name='cost_vat' value='����' onclick="set_vat()" checked>����&nbsp;<input type='radio' name='cost_vat' value='����' onclick="set_vat()">����
					</td>
					<td width='17%' class='tab_tit'>���ݾ�</td>
					<td width='33%' class='tab'>
						<input type='text' name='deposit' style='width:60px;' value=''>��&nbsp;&nbsp;&nbsp;&nbsp;
						(������) : <input type='text' name='deposit_date' style='width:100px;' value=''>
					</td>
				</tr>
				<tr> 
					<td colspan='4'><textarea name="ment" id="ment" style='width:100%;height:300px;'></textarea></td>
				</tr>
			</table>
		</td>
	</tr>
</table>




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