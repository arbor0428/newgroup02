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
		tmp_content = '';
		tmp_content = tmp.replace(/<(\/?)p>/gi,"");
		tmp_content = tmp_content.replace(/<br>/gi,"");
		tmp_content = tmp_content.replace(/ /gi,"");
		tmp_content = tmp_content.replace(/&nbsp;/gi,"");
		tmp_content = tmp_content.replace(/<head>(.*?)<(\/?)head>/gi,"");
		tmp_content = tmp_content.replace(/<style>(.*?)<(\/?)style>/gi,"");
		tmp_content = tmp_content.replace(/<(\/?)body>/gi,"");

		if(tmp_content==0)	tmp = '';

		form.ment.value = tmp;

		//js���� �ε�
		jsload();

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
		form.ment.value = '';

		//js���� �ε�
		jsload();

		return;

	}

}


function jsload(){
	var head= document.getElementsByTagName('head')[0];
	var script= document.createElement('script');
	script.type= 'text/javascript';
	script.src= '/html_editor/gmEditor.js';
	head.appendChild(script);
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
					<td colspan='4'>

						<!-- html_editor -->
						<table border='0' cellpadding='1' cellspacing='1' width='100%'>

							<tr>
								<td>
								<?
									include '../../html_editor/btn_tool.php';
								?>			
								</td>
							</tr>

							<tr>
								<td>
									<table border='1' width='100%' cellspacing='0' bordercolor='#EFEFEF' bordercolordark='white' bordercolorlight='#DBDBDB'>
										<tr>
											<td>
											<iframe id='gmEditor' width='100%' height='200' scrolling='auto' border='0' frameborder='0' framespacing='0' hspace='0' marginheight='0' marginwidth='0' vspace='0'></iframe>
											<textarea cols=0 rows=0 style='display:none;' wrap='physical' name='ment'></textarea>
											<input type='hidden' name='editor_url' id='editor_url' value='/html_editor'>
											<input type='hidden' name='editor_stom' id='editor_stom' value='euc-kr'>
											<script language='javascript' src='/html_editor/gmEditor.js'></script>
											</td>
										</td>
									</table>
								</td>
							</tr>
						</table>
						<!-- html_editor -->


					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>