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
		$price02_1 = $row["price02_1"];
		$price03 = $row["price03"];
		$price02_date = $row['price02_date'];
		$price02_1_date = $row["price02_1_date"];
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
		$reg_date = $row["reg_date"];

		if(!$cdate01)	$cdate01 = date('Y',$reg_date);
		if(!$cdate02)	$cdate02 = date('m',$reg_date);
		if(!$cdate03)	$cdate03 = date('d',$reg_date);

	}else{
		$cdate01 = date('Y');
		$cdate02 = date('m');
		$cdate03 = date('d');
	}


	if(!$price01)	$price01 = '0';
	if(!$price02)	$price02 = '0';
	if(!$price03)	$price03 = '0';

	if(!$userid)	$userid = $GBL_USERID;
	if(!$name)	$name = $GBL_NAME;




?>


<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>


function check_form(){
	form = document.FRM;
	
	if(isFrmEmpty(form.name,"담당자를 입력해 주십시오"))	return;

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
	price02_1 = form.price02_1.value;
	price03 = price01 - price02 - price02_1;
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

<input type='hidden' name='mid' value=''><!-- 특이사항 수정,삭제용 -->
<input type='hidden' name='did' value=''><!-- 도메인정보 삭제용 -->

<!-- 검색관련 -->
<input type='hidden' name='f_company' value='<?=$f_company?>'>
<input type='hidden' name='f_person' value='<?=$f_person?>'>
<input type='hidden' name='f_email' value='<?=$f_email?>'>
<input type='hidden' name='f_fax' value='<?=$f_fax?>'>
<input type='hidden' name='f_tel' value='<?=$f_tel?>'>
<input type='hidden' name='f_hp' value='<?=$f_hp?>'>
<input type='hidden' name='f_site_name' value='<?=$f_site_name?>'>
<input type='hidden' name='f_domain' value='<?=$f_domain?>'>
<!-- /검색관련 -->





<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='30'><b>1. 아이웹</b></td>
	</tr>

	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td width="17%" class='tab_tit30'>순위</td>
					<td width="33%" class='tab'>
						<select name='sort'>
						<?
							if(!$sort)	 $sort = $max;
							for($i=1; $i<=$max; $i++){
						?>
							<option value='<?=$i?>' <?if($sort==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>
					</td>
					<td width="17%" class='tab_tit30'>담당자</td>
					<td width="33%" class='tab'><input type='text' name='name' style='width:100px;' value='<?=$name?>'></td>
				</tr>
				<tr>
					<td class='tab_tit30'>상태</td>
					<td class='tab'>
						<input type='radio' name='playing' value='진행' <?if($playing=='진행'){echo 'checked';}?>>진행&nbsp;
						<input type='radio' name='playing' value='보류' <?if($playing=='보류'){echo 'checked';}?>>보류&nbsp;
						<input type='radio' name='playing' value='완료' <?if($playing=='완료'){echo 'checked';}?>>완료
					</td>
					<td class='tab_tit30'>추천자</td>
					<td class='tab'><input type='text' name='re_name' style='width:145px;' value='<?=$re_name?>'></td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>계약일자</td>
					<td class='tab'>
						<select name='cdate01'>
						<?
							for($i=2010; $i<=date('Y')+3; $i++){
						?>
							<option value='<?=$i?>' <?if($cdate01==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>년 

						<select name='cdate02'>
						<?
							for($i=1; $i<13; $i++){
								$no = sprintf('%2d',$i);
						?>
							<option value='<?=$no?>' <?if($cdate02==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>월 
						
						<select name='cdate03'>
						<?
							for($i=1; $i<32; $i++){
								$no = sprintf('%2d',$i);
						?>
							<option value='<?=$no?>' <?if($cdate03==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>일 
					</td>
					<td class='tab_tit30'>마감시한</td>
					<td class='tab'>
						<select name='edate01'>
							<option value=''>===</option>
						<?
							for($i=2010; $i<=date('Y')+3; $i++){
						?>
							<option value='<?=$i?>' <?if($edate01==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>년 

						<select name='edate02'>
							<option value=''>==</option>
						<?
							for($i=1; $i<13; $i++){
								$no = sprintf('%2d',$i);
						?>
							<option value='<?=$no?>' <?if($edate02==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>월 
						
						<select name='edate03'>
							<option value=''>==</option>
						<?
							for($i=1; $i<32; $i++){
								$no = sprintf('%2d',$i);
						?>
							<option value='<?=$no?>' <?if($edate03==$no) echo 'selected';?>><?=$no?></option>
						<?
							}
						?>
						</select>일 
					</td>
				</tr>
				<tr>
					<td class='tab_tit' height='30'>첨부파일</td>
					<td class='tab'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input type='file' name='upfile01' class='file03' style='width:213px'><?if($userfile01){?><br><input type='checkbox' name='del_upfile01' value='Y'>삭제 (<?=$realfile01?>)<?}?></td>
								<td width='100' align='right'>
<?
	if($realfile01){		
		echo ("<a href='../file_down.php?folder=ing01&rfile=$userfile01&sname=$realfile01'><img src='../img/common/down.gif'></a>");

	}
?>
								</td>
							</tr>
						</table>
					</td>
					<td class='tab_tit30'>제작기간</td>
					<td class='tab'><input type='text' name='date01' style='width:60px;' value='<?=$date01?>'> 일</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

















<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='30' style='padding-top:30px;'><b>2. 업체정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td width="17%" class='tab_tit30'>상호</td>
					<td width="33%" class='tab'><input type='text' name='company' style='width:98%;' value='<?=$company?>'></td>
					<td width="17%" class='tab_tit30'>사업의종류</td>
					<td width="33%" class='tab'><input type='text' name='upjong' style='width:100px;' value='<?=$upjong?>'></td>
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
					<td class='tab_tit30'>담당자</td>
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
					<td class='tab'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='tel01' style='width:40px;' value='<?=$tel01?>'> - <input type='text' name='tel02' style='width:40px;' value='<?=$tel02?>'>- <input type='text' name='tel03' style='width:40px;' value='<?=$tel03?>'></td>
								<td style='padding-left:10px;'><a href="javascript:document.ifra_sms.getNum(FRM.tel01.value,FRM.tel02.value,FRM.tel03.value);"><img src='../img/ico_phone.gif'></a></td>
							</tr>
						</table>						
					</td>
					<td class='tab_tit30'>휴대전화</td>
					<td class='tab'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='hp01' style='width:40px;' value='<?=$hp01?>'> - <input type='text' name='hp02' style='width:40px;' value='<?=$hp02?>'>- <input type='text' name='hp03' style='width:40px;' value='<?=$hp03?>'></td>
								<td style='padding-left:10px;'><a href="javascript:document.ifra_sms.getNum(FRM.hp01.value,FRM.hp02.value,FRM.hp03.value);"><img src='../img/ico_phone.gif'></a></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<td class='tab_tit30'>사이트명</td>
					<td class='tab'><input type='text' name='site_name' style='width:145px;' value='<?=$site_name?>'></td>
					<td class='tab_tit' height='30'>관리자 ID / PWD</td>
					<td class='tab'><input type='text' name='site_id' style='width:100px;' value='<?=$site_id?>'> / <input type='text' name='site_pwd' style='width:100px;' value='<?=$site_pwd?>'></td>
				</tr>


			</table>
		</td>
	</tr>
</table>













<?
	//도메인정보
	include 'form_domain.php';
?>











<!--
	<tr>
		<td height='30' style='padding-top:30px;'><b>3. 도메인정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr>
					<td width="17%" class='tab_tit30'>보유도메인</td>
					<td width="33%" class='tab'><input type='text' name='domain' style='width:145px;' value='<?=$domain?>'></td>
					<td width="17%" class='tab_tit30'>도메인업체</td>
					<td width="33%" class='tab'><input type='text' name='domain_com' style='width:145px;' value='<?=$domain_com?>'></td>
				</tr>
				<tr>
					<td class='tab_tit30'></td>
					<td class='tab'></td>
					<td class='tab_tit30'>업체 ID / PWD</td>
					<td class='tab'><input type='text' name='domain_id' style='width:100px;' value='<?=$domain_id?>'> / <input type='text' name='domain_pwd' style='width:100px;' value='<?=$domain_pwd?>'></td>
				</tr>
			</table>
		</td>
	</tr>
-->










<?
	//호스팅정보
	include 'form_host.php';
?>




<!--

	<tr>
		<td height='30' style='padding-top:30px;'><b>3. 결제정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td width="17%" class='tab_tit' height='30'>총금액</td>
					<td width="83%" class='tab' colspan='3'><input type='text' name='price01' style='width:60px;' value='<?=$price01?>' onblur='total_price();'>원&nbsp;&nbsp;<input type='checkbox' name='vat' value='1' onclick='bugase();' <?if($vat) echo 'checked';?>> 부가세포함</td>
				</tr>
				<tr> 
					<td width="17%" class='tab_tit' height='30'>계약금</td>
					<td width="33%" class='tab'>
						<input type='text' name='price02' style='width:60px;' value='<?=$price02?>' onblur='total_price();'>원&nbsp;&nbsp;&nbsp;&nbsp;
						(수금일) : <input type='text' name='price02_date' style='width:100px;' value='<?=$price02_date?>'>
					</td>
					<td width="17%" class='tab_tit' height='30'>중도금</td>
					<td width="33%" class='tab'>
						<input type='text' name='price02_1' style='width:60px;' value='<?=$price02_1?>' onblur='total_price();'>원&nbsp;&nbsp;&nbsp;&nbsp;
						(수금일) : <input type='text' name='price02_1_date' style='width:100px;' value='<?=$price02_1_date?>'>
					</td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>미수금</td>
					<td class='tab' colspan='3'><input type='text' name='price03' style='width:60px;' value='<?=$price03?>'>원</td>

				</tr>
			</table>
		</td>
	</tr>
-->

	<input type='hidden' name='price01' value='<?=$price01?>'>
	<input type='hidden' name='vat' value='<?=$vat?>'>
	<input type='hidden' name='price02' value='<?=$price02?>'>
	<input type='hidden' name='price02_date' value='<?=$price02_date?>'>
	<input type='hidden' name='price02_1' value='<?=$price02_1?>'>
	<input type='hidden' name='price02_1_date' value='<?=$price02_1_date?>'>
	<input type='hidden' name='price03' value='<?=$price03?>'>



















<?
	if($uid){
		$query = "select * from wo_ing01_ment where pid='$uid' order by uid desc";
		$query_result = mysql_query($query);
		$tot_ment = mysql_num_rows($query_result);

		$p01 = 0;
		$p02 = 0;
		$p03 = 0;
		$p04 = 0;

		if($tot_ment){
			for($i=0; $i<$tot_ment; $i++){
				$rows = mysql_fetch_array($query_result);
				$r_cost = $rows['cost'];
				$r_cost_vat = $rows['cost_vat'];
				$r_deposit = $rows['deposit'];


				$p01 += $r_cost;	//총금액
				if($r_cost_vat == '포함'){
					$r_vat = $r_cost / 1.1;
					$p02 += ($r_cost - $r_vat);	//부가세
				}
				$p03 += $r_deposit;	//수금액

			}

			$p04 = $p01 - $p03;
		}


		if($p01)	$p01_txt = number_format($p01).'원';
		else	$p01_txt = '';

		if($p02){
			$p02_txt = number_format($p02).'원';
		}else{
			if($p01)	$p02_txt = '없음';
			else	$p02_txt = '';
		}

		if($p03)	$p03_txt = number_format($p03).'원';
		else	$p03_txt = '';

		if($p04){
			$p04_txt = number_format($p04).'원';
		}else{
			if($p01)	$p04_txt = '없음';
			else	$p04_txt = '';
		}
	}
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='30' style='padding-top:30px;'><b>5. 결제정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td width="17%" class='tab_tit' height='30'>총금액</td>
					<td width="33%" class='tab'><?=$p01_txt?></td>
					<td width="17%" class='tab_tit' height='30'>부가세</td>
					<td width="33%" class='tab'><font color='#de712e'><?=$p02_txt?></font></td>
				</tr>
				<tr> 
					<td class='tab_tit' height='30'>수금액</td>
					<td class='tab'><?=$p03_txt?></td>
					<td class='tab_tit' height='30'>미수금</td>
					<td class='tab'><font color='#52809a'><?=$p04_txt?></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>












<?
	//특이사항 목록 & 등록
	include 'form_ment.php';
?>














<table width="100%" border="0" cellspacing="0" cellpadding="0">
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

