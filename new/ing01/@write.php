<?

	//순번가져오기
	$sql = "select max(sort) from wo_ing01";
	$result = mysql_query($sql);
	$max = mysql_result($result,0,0);

	if($max){
		if($type=='write')	$max = $max + 1;

	}else{
		$max = '1';

	}


	if($uid){

		$sql = "select * from wo_ing01 where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$sort = $row["sort"];
		$name = $row["name"];
		$company = $row["company"];
		$upjong = $row["upjong"];
		$person = $row["person"];
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
		$playing = $row["playing"];
		$ment = $row["ment"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		$email = $row["email"];
		$fax01 = $row["fax01"];
		$fax02 = $row["fax02"];
		$fax03 = $row["fax03"];
		$site_name = $row["site_name"];
		$re_name = $row["re_name"];
		$cdate01 = $row["cdate01"];
		$cdate02 = $row["cdate02"];
		$cdate03 = $row["cdate03"];

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


function check_form(){
	form = document.FRM;
	
	if(isFrmEmpty(form.name,"담당자를 입력해 주십시오"))	return;
	form.ment.value = SubmitHTML();
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
	
	if(confirm('해당업무를 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = 'proc.php';
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
		form.price01.value = Math.floor(parseInt(price01) * 1.1); //부가세포함
	}else{
		form.price01.value = Math.ceil(parseInt(price01) / 1.1); //부가세마이너스
	}
 
	if(form.price02.value){
			total_price();
	}
	return;
}


function reg_end(){
	
	if(confirm('계약완료 처리하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'end'
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
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="4"></td>
				</tr>

				<tr> 
					<td width="17%" class='tab_tit30'>순위</td>
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
					<td width="17%" class='tab_tit30'>담당자(본사)</td>
					<td width="33%" class='tab'><input type='text' name='name' style='width:100px;' value='<?=$name?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>상호</td>
					<td class='tab'><input type='text' name='company' style='width:145px;' value='<?=$company?>'></td>
					<td class='tab_tit30'>사업의종류</td>
					<td class='tab'><input type='text' name='upjong' style='width:100px;' value='<?=$upjong?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>중요도</td>
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
					<td class='tab_tit30'>담당자(업체)</td>
					<td class='tab'><input type='text' name='person' style='width:100px;' value='<?=$person?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>이메일</td>
					<td class='tab'><input type='text' name='email' style='width:145px;' value='<?=$email?>'></td>
					<td class='tab_tit30'>팩스</td>
					<td class='tab'><input type='text' name='fax01' style='width:40px;' value='<?=$fax01?>'> - <input type='text' name='fax02' style='width:40px;' value='<?=$fax02?>'>- <input type='text' name='fax03' style='width:40px;' value='<?=$fax03?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>일반전화</td>
					<td class='tab'><input type='text' name='tel01' style='width:40px;' value='<?=$tel01?>'> - <input type='text' name='tel02' style='width:40px;' value='<?=$tel02?>'>- <input type='text' name='tel03' style='width:40px;' value='<?=$tel03?>'></td>
					<td class='tab_tit30'>휴대전화</td>
					<td class='tab'><input type='text' name='hp01' style='width:40px;' value='<?=$hp01?>'> - <input type='text' name='hp02' style='width:40px;' value='<?=$hp02?>'>- <input type='text' name='hp03' style='width:40px;' value='<?=$hp03?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>제작기간</td>
					<td class='tab'><input type='text' name='date01' style='width:60px;' value='<?=$date01?>'> 일</td>
					<td class='tab_tit30'>마감시한</td>
					<td class='tab'><input type='text' name='edate01' style='width:60px;' value='<?=$edate01?>'> 년 <input type='text' name='edate02' style='width:40px;' value='<?=$edate02?>'> 월 <input type='text' name='edate03' style='width:40px;' value='<?=$edate03?>'> 일</td>
				</tr>


				<tr> 
					<td class='tab_tit' height='30'>총금액</td>
					<td class='tab'><input type='text' name='price01' style='width:60px;' value='<?=$price01?>' onblur='total_price();'>원&nbsp;&nbsp;<input type='checkbox' name='vat' value='1' onclick='bugase();' <?if($vat) echo 'checked';?> > 부가세포함</td>
					<td class='tab_tit30'>보유도메인</td>
					<td class='tab'><input type='text' name='domain' style='width:145px;' value='<?=$domain?>'></td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>계약금</td>
					<td class='tab'><input type='text' name='price02' style='width:60px;' value='<?=$price02?>' onblur='total_price();'>원</td>
					<td class='tab_tit30'>도메인업체</td>
					<td class='tab'><input type='text' name='domain_com' style='width:145px;' value='<?=$domain_com?>'></td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>미수금</td>
					<td class='tab'><input type='text' name='price03' style='width:60px;' value='<?=$price03?>'>원</td>
					<td class='tab_tit30'>업체 ID / PWD</td>
					<td class='tab'><input type='text' name='domain_id' style='width:100px;' value='<?=$domain_id?>'> / <input type='text' name='domain_pwd' style='width:100px;' value='<?=$domain_pwd?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit30'>사이트명</td>
					<td class='tab'><input type='text' name='site_name' style='width:145px;' value='<?=$site_name?>'></td>
					<td class='tab_tit30'>추천자</td>
					<td class='tab'><input type='text' name='re_name' style='width:145px;' value='<?=$re_name?>'></td>
				</tr>

				<tr> 
					<td class='tab_tit' height='30'>사이트 ID / PWD</td>
					<td class='tab'><input type='text' name='site_id' style='width:100px;' value='<?=$site_id?>'> / <input type='text' name='site_pwd' style='width:100px;' value='<?=$site_pwd?>'></td>
					<td class='tab_tit30'>진행률</td>
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
					<td class='tab_tit' height='30'>첨부파일</td>
					<td class='tab'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input type='file' name='upfile01' class='file03' style='width:280px'><?if($userfile01){?><input type='checkbox' name='del_upfile01' value='Y'>삭제 (<?=$realfile01?>)<?}?></td>
								<td width='100' align='right' valign='bottom'>
<?
	if($realfile01){		
		echo ("<a href='../file_down.php?folder=ing01&rfile=$userfile01&sname=$realfile01'><img src='../img/common/down.gif'></a>");

	}
?>
								</td>
							</tr>
						</table>
					</td>
					<td class='tab_tit' height='30'>계약일자</td>
					<td class='tab'><input type='text' name='cdate01' style='width:60px;' value='<?=$cdate01?>'> 년 <input type='text' name='cdate02' style='width:40px;' value='<?=$cdate02?>'> 월 <input type='text' name='cdate03' style='width:40px;' value='<?=$cdate03?>'> 일</td>
				</tr>


				<tr> 
					<td class='tab_tit' height='30'>특이사항</td>
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
					<td width='50%'><?if($uid){?><input type='button' name='btn' value='계약완료' onclick='reg_end();'><?}?></td>

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

