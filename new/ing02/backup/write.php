<?

	//������������
	$sql = "select max(sort) from wo_ing02";
	$result = mysql_query($sql);
	$max = mysql_result($result,0,0);

	if($max){
		if($type=='write')	$max = $max + 1;

	}else{
		$max = '1';

	}


	if($uid){

		if($play_sort)	$table = "wo_ing02e";	//�Ϸ� ���̺�
		else	$table = "wo_ing02";	 //���� ���̺�


		$sql = "select * from $table where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$sort = $row["sort"];
		$name = $row["name"];
		$company = $row["company"];
		$host_id = $row["host_id"];
		$host_pwd = $row["host_pwd"];
		$upjong = $row["upjong"];
		$person = $row["person"];
		$staff = $row["staff"];
		$status = $row["status"];
		$tel01 = $row["tel01"];
		$tel02 = $row["tel02"];
		$tel03 = $row["tel03"];
		$hp01 = $row["hp01"];
		$hp02 = $row["hp02"];
		$hp03 = $row["hp03"];
		$date01 = $row["date01"];
		$edate01 = $row["edate01"];
		$edate02 = $row["edate02"];
		$edate03 = $row["edate03"];
		$price01 = $row["price01"];
		$price02 = $row["price02"];
		$price03 = $row["price03"];
		$vat = $row["vat"];
		$domain = $row["domain"];
		$domain_com = $row["domain_com"];
		$domain_id = $row["domain_id"];
		$domain_pwd = $row["domain_pwd"];
		$site_id = $row["site_id"];
		$site_pwd = $row["site_pwd"];
		$domain_date = $row["domain_date"];
		$host_date = $row["host_date"];
		$virtualhost = $row["virtualhost"];
		$playing = $row["playing"];
		$ment = $row["ment"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		//�����θ�������
		if($domain_date){
			$d_yy = date('Y',$domain_date);
			$d_mm = date('m',$domain_date);
			$d_dd = date('d',$domain_date);

		}else{
			$d_yy = '';
			$d_mm = '';
			$d_dd = '';

		}

		//ȣ���ø�������
		if($host_date){
			$h_yy = date('Y',$host_date);
			$h_mm = date('m',$host_date);
			$h_dd = date('d',$host_date);

		}else{
			$h_yy = '';
			$h_mm = '';
			$h_dd = '';

		}

	}


	if(!$price01)	$price01 = '0';
	if(!$price02)	$price02 = '0';
	if(!$price03)	$price03 = '0';

	if(!$userid)	$userid = $GBL_USERID;
	if(!$name)	$name = $GBL_NAME;




?>


<script language='javascript' src='/html_editor/languages/euc-kr/java.lang.js'></script>
<script language='javascript' src='/html_editor/newEditor.js'></script>

<script language='javascript'>
var _editor_url = "/html_editor";
var _contentValue = "ment";
var _contentName = "FRM";
var _i_uploaded = "";
var _m_uploaded = "";


function check_form(cc){
	form = document.FRM;

	if(cc)	act = 'eproc.php';
	else	act = 'proc.php';

	chk01 = form.d_yy.selectedIndex;
	chk02 = form.d_mm.selectedIndex;
	chk03 = form.d_dd.selectedIndex;

	chk04 = form.h_yy.selectedIndex;
	chk05 = form.h_mm.selectedIndex;
	chk06 = form.h_dd.selectedIndex;

	playing = form.playing.value;	//�����

	
	if(isFrmEmpty(form.name,"����ڸ� �Է��� �ֽʽÿ�"))	return;

	if(chk01 || chk02 || chk03){
		if(isFrmEmpty(form.d_yy,"������ �������ڸ� ������ �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.d_mm,"������ �������ڸ� ������ �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.d_dd,"������ �������ڸ� ������ �ֽʽÿ�"))	return;
	}

	if(chk04 || chk05 || chk06){
		if(isFrmEmpty(form.h_yy,"ȣ���� �������ڸ� ������ �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.h_mm,"ȣ���� �������ڸ� ������ �ֽʽÿ�"))	return;
		if(isFrmEmpty(form.h_dd,"ȣ���� �������ڸ� ������ �ֽʽÿ�"))	return;
	}

	if(playing == '100%' && cc == ''){
		txt = form.company.value;
		if(confirm(txt+'��(��) �۾��Ϸ� ó���Ͻðڽ��ϱ�?')){
			form.ment.value = SubmitHTML();
			form.action = act
			form.submit();

		}else{
			return;
		}
	}

	form.ment.value = SubmitHTML();
	form.action = act
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(cc){
	
	if(confirm('�ش������ �����Ͻðڽ��ϱ�?')){
		if(cc)	act = 'eproc.php';
		else	act = 'proc.php';

		form = document.FRM;
		form.type.value = 'del'
		form.action = act;
		form.submit();
	}else{
		return;
	}

}


function total_price(){
	form = document.FRM;
	price01 = form.price01.value;
	price02 = form.price02.value;
	price03 = price01 - price02
	form.price03.value=price03;
	return;
}
 
function bugase(){
	form = document.FRM;
	price01 = form.price01.value;
	if(form.vat.checked){
		form.price01.value = Math.floor(parseInt(price01) * 1.1); //�ΰ�������
	}else{
		form.price01.value = Math.ceil(parseInt(price01) / 1.1); //�ΰ������̳ʽ�
	}
 
	if(form.price02.value){
			total_price();
	}
	return;
}


function reg_back(){
	
	if(confirm('��ຸ�� ó���Ͻðڽ��ϱ�?')){
		form = document.FRM;
		form.type.value = 'back'
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
<input type='hidden' name='old_sort' value='<?=$sort?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='play_sort' value='<?=$play_sort?>'>




<!--���-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="4"></td>
				</tr>

				<tr> 
					<td width="17%" class='tab_tit30'>����</td>
					<td width="33%" class='tab'>
						<select name='sort'>
						<?
							for($i=1; $i<=$max; $i++){
						?>
							<option value='<?=$i?>' <?if($sort==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>
					</td>
					<td width="17%" class='tab_tit30'>�����(����)</td>
					<td width="33%" class='tab'><input type='text' name='name' style='width:100px;' value='<?=$name?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>��ȣ</td>
					<td class='tab'><input type='text' name='company' style='width:145px;' value='<?=$company?>'></td>
					<td class='tab_tit30'>���������</td>
					<td class='tab'><input type='text' name='upjong' style='width:100px;' value='<?=$upjong?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>�߿䵵</td>
					<td class='tab'>
						<select name='status'>
						<?
							for($i=0; $i<count($arr_status); $i++){
						?>
							<option value='<?=$arr_status[$i]?>' <?if($status==$arr_status[$i]) echo 'selected';?>><?=$arr_status[$i]?></option>
						<?
							}
						?>
						</select>
					</td>
					<td class='tab_tit30'>�����(��ü)</td>
					<td class='tab'><input type='text' name='person' style='width:100px;' value='<?=$person?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>�Ϲ���ȭ</td>
					<td class='tab'><input type='text' name='tel01' style='width:40px;' value='<?=$tel01?>'> - <input type='text' name='tel02' style='width:40px;' value='<?=$tel02?>'>- <input type='text' name='tel03' style='width:40px;' value='<?=$tel03?>'></td>
					<td class='tab_tit30'>�޴���ȭ</td>
					<td class='tab'><input type='text' name='hp01' style='width:40px;' value='<?=$hp01?>'> - <input type='text' name='hp02' style='width:40px;' value='<?=$hp02?>'>- <input type='text' name='hp03' style='width:40px;' value='<?=$hp03?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>���۱Ⱓ</td>
					<td class='tab'><input type='text' name='date01' style='width:60px;' value='<?=$date01?>'> ��</td>
					<td class='tab_tit30'>��������</td>
					<td class='tab'><input type='text' name='edate01' style='width:60px;' value='<?=$edate01?>'> �� <input type='text' name='edate02' style='width:40px;' value='<?=$edate02?>'> �� <input type='text' name='edate03' style='width:40px;' value='<?=$edate03?>'> ��</td>
				</tr>


				<tr> 
					<td class='tab_tit' height='30'>�ѱݾ�</td>
					<td class='tab'><input type='text' name='price01' style='width:60px;' value='<?=$price01?>' onblur='total_price();'>��&nbsp;&nbsp;<input type='checkbox' name='vat' value='1' onclick='bugase();' <?if($vat) echo 'checked';?>> �ΰ�������</td>
					<td class='tab_tit30'>����������</td>
					<td class='tab'>
						<table cellpadding='0' cellspacing='0' border='0'>	
							<tr>
								<td><input type='text' name='domain' style='width:145px;' value='<?=$domain?>'></td>
					<?
						if($domain){
							$link_domain = str_replace('http://','',$domain);
					?>
								<td width='10'></td>
								<td><a href='http://<?=$link_domain?>' target='_blank'><img src='../img/ico_home.gif' valign='bottom'></a></td>
					<?
						}
					?>
							</tr>
						</table>
					</td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>����</td>
					<td class='tab'><input type='text' name='price02' style='width:60px;' value='<?=$price02?>' onblur='total_price();'>��</td>
					<td class='tab_tit30'>�����ξ�ü</td>
					<td class='tab'><input type='text' name='domain_com' style='width:145px;' value='<?=$domain_com?>'></td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>�̼���</td>
					<td class='tab'><input type='text' name='price03' style='width:60px;' value='<?=$price03?>'>��</td>
					<td class='tab_tit30'>��ü ID / PWD</td>
					<td class='tab'><input type='text' name='domain_id' style='width:100px;' value='<?=$domain_id?>'> / <input type='text' name='domain_pwd' style='width:100px;' value='<?=$domain_pwd?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>����Ʈ ID / PWD</td>
					<td class='tab'><input type='text' name='site_id' style='width:100px;' value='<?=$site_id?>'> / <input type='text' name='site_pwd' style='width:100px;' value='<?=$site_pwd?>'></td>
					<td class='tab_tit30'>�����</td>
					<td class='tab'>
						<select name='playing'>
							<option value=''>==</option>
							<option value='20%' <?if($playing=='20%') echo 'selected';?>>20%</option>
							<option value='40%' <?if($playing=='40%') echo 'selected';?>>40%</option>
							<option value='60%' <?if($playing=='60%') echo 'selected';?>>60%</option>
							<option value='80%' <?if($playing=='80%') echo 'selected';?>>80%</option>
							<option value='100%' <?if($playing=='100%') echo 'selected';?>>100%</option>
						</select>
					</td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>�۾������</td>
					<td class='tab'>
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
					<td class='tab_tit' height='30'>ȣ���� ID / PWD</td>
					<td class='tab'><input type='text' name='host_id' style='width:100px;' value='<?=$host_id?>'> / <input type='text' name='host_pwd' style='width:100px;' value='<?=$host_pwd?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>������ ��������</td>
					<td class='tab'>
						<select name='d_yy'>
							<option value=''>===</option>
						<?
							for($i=2010; $i<=date('Y')+3; $i++){
						?>
							<option value='<?=$i?>' <?if($d_yy==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>�� 

						<select name='d_mm'>
							<option value=''>==</option>
						<?
							for($i=1; $i<13; $i++){
								$no = sprintf('%2d',$i);
						?>
							<option value='<?=$no?>' <?if($d_mm==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>�� 
						
						<select name='d_dd'>
							<option value=''>==</option>
						<?
							for($i=1; $i<32; $i++){
								$no = sprintf('%2d',$i);
						?>
							<option value='<?=$no?>' <?if($d_dd==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>�� 
					</td>
					<td class='tab_tit' height='30'>ȣ���� ��������</td>
					<td class='tab'>
						<select name='h_yy'>
							<option value=''>===</option>
						<?
							for($i=2010; $i<=date('Y')+3; $i++){
						?>
							<option value='<?=$i?>' <?if($h_yy==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>�� 

						<select name='h_mm'>
							<option value=''>==</option>
						<?
							for($i=1; $i<13; $i++){
								$no = sprintf('%2d',$i);
						?>
							<option value='<?=$no?>' <?if($h_mm==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>�� 
						
						<select name='h_dd'>
							<option value=''>==</option>
						<?
							for($i=1; $i<32; $i++){
								$no = sprintf('%2d',$i);
						?>
							<option value='<?=$no?>' <?if($h_dd==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>�� 
						&nbsp;&nbsp;
						<input type='checkbox' name='virtualhost' value='����' <?if($virtualhost=='����') echo 'checked';?>>����
					</td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>÷������</td>
					<td class='tab' colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input type='file' name='upfile01' class='file03'><?if($userfile01){?><input type='checkbox' name='del_upfile01' value='Y'>���� (<?=$realfile01?>)<?}?></td>
								<td width='100' align='right' valign='bottom'>
<?
	if($realfile01){		
		echo ("<a href='../file_down.php?folder=ing02&rfile=$userfile01&sname=$realfile01'><img src='../img/common/down.gif'></a>");

	}
?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>Ư�̻���</td>
					<td class='tab' colspan='3'>

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
								<iframe id='gmEditor' width='100%' height='500' scrolling='auto' border='0' frameborder='0' framespacing='0' hspace='0' marginheight='0' marginwidth='0' vspace='0'></iframe>
								<textarea cols=0 rows=0 style='display:none;' wrap='physical' name='ment'><?=$ment?></textarea>
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



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>

					<td width='50%'><?if($uid){?><input type='button' name='btn' value='��ຸ��' onclick='reg_back();'><?}?></td>


					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form('<?=$play_sort?>');"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del('<?=$play_sort?>');"><img src="../img/board/delete1.gif" border=0></a>&nbsp;
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

