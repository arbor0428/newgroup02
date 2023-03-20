<script language='javascript'>
function set_vat(){
	form = document.FRM;
	cost = form.cost.value;

	if(form.cost_vat[1].checked){
		form.cost.value = Math.floor(parseInt(cost) * 1.1); //부가세포함
	}else{
		form.cost.value = Math.ceil(parseInt(cost) / 1.1); //부가세마이너스
	} 

}

function msg_modify(info_uid){
	if(info_uid){
		form = document.FRM;

		/* 견적가 및 수금액 관련 */
		form.cost.value = form['cost'+info_uid].value;
		form.deposit.value = form['deposit'+info_uid].value;
		form.deposit_date.value = form['deposit_date'+info_uid].value;

		if(form['cost_vat'+info_uid].value == '포함'){
			form.cost_vat[1].checked = true;

		}else{
			form.cost_vat[0].checked = true;

		}




		/* 특이사항내용관련 */
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

		//js파일 로드
		jsload();

	}

}



function msg_del(info_uid,obj){

	form = document.FRM;
	
	if(confirm('특이사항을 삭제하시겠습니까?')){		
		form.mid.value = info_uid;
		form.type.value = 'info_del'
		form.action = 'proc.php';
		form.submit();

	}else{
		obj.checked = false;

		/* 견적가 및 수금액 관련 */
		form.cost.value = '';
		form.deposit.value = '';
		form.cost_vat[0].checked = true;
		form.deposit_date.value = '';


		/* 특이사항내용관련 */
		form.mid.value = '';
		form.ment.value = '';

		//js파일 로드
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
		<td height='30' style='padding-top:30px;'><b>6. 특이사항</b></td>
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


			if($info_cost)	$cost_txt = number_format($info_cost).'원&nbsp;&nbsp;&nbsp;';
			else	$cost_txt = '';

			if($info_cost_vat == '포함')	 $cost_txt .= "(<font color='#de712e'>VAT포함</font>)";



			if($info_deposit)	$deposit_txt = number_format($info_deposit).'원&nbsp;&nbsp;&nbsp;';
			else	$deposit_txt = '';

			if($info_deposit_date)	$deposit_txt .= '수금일('.$info_deposit_date.')';

			
?>

				<tr height='30'> 
					<td width="17%" class='tab_tit'>등록일시</td>
					<td width="33%" class='tab'><?=$info_date?></td>
					<td width="17%" class='tab_tit'>편집</td>
					<td width="33%" class='tab'>
						<input type='radio' name='btn' onclick="msg_modify('<?=$info_uid?>');">수정&nbsp;&nbsp;&nbsp;
						<input type='radio' name='btn' onclick="msg_del('<?=$info_uid?>',this);">삭제
					</td>
				</tr>
				<tr height='30'> 
					<td class='tab_tit'>견적가</td>
					<td class='tab'><?=$cost_txt?></td>
					<td class='tab_tit'>수금액</td>
					<td class='tab'><?=$deposit_txt?></td>
				</tr>
				<tr>
					<td height='50' colspan='4' style='padding-bottom:30px;'><?=$info_ment?></td>
				</tr>

				<input type='hidden' name='msg<?=$info_uid?>' value='<?=$info_ment?>'><!-- 특이사항 내용 -->
				<input type='hidden' name='cost<?=$info_uid?>' value='<?=$info_cost?>'><!-- 견적가 -->
				<input type='hidden' name='cost_vat<?=$info_uid?>' value='<?=$info_cost_vat?>'><!-- 부가세 -->
				<input type='hidden' name='deposit<?=$info_uid?>' value='<?=$info_deposit?>'><!-- 수금액 -->
				<input type='hidden' name='deposit_date<?=$info_uid?>' value='<?=$info_deposit_date?>'><!-- 수금일 -->

<?
		}
	}else{
?>
				<tr>
					<td height='30'>특이사항을 등록해 주십시오</td>
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
		<td height='30' style='padding-top:30px;'><b>7. 특이사항등록</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr height='30'> 
					<td width='17%' class='tab_tit'>견적가</td>
					<td width='33%' class='tab'>
						<input type='text' name='cost' style='width:60px;' value=''>원&nbsp;&nbsp;&nbsp;&nbsp;
						부가세 : <input type='radio' name='cost_vat' value='별도' onclick="set_vat()" checked>별도&nbsp;<input type='radio' name='cost_vat' value='포함' onclick="set_vat()">포함
					</td>
					<td width='17%' class='tab_tit'>수금액</td>
					<td width='33%' class='tab'>
						<input type='text' name='deposit' style='width:60px;' value=''>원&nbsp;&nbsp;&nbsp;&nbsp;
						(수금일) : <input type='text' name='deposit_date' style='width:100px;' value=''>
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