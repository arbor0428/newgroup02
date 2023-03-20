<?
	//에이젼시 신규등록시 업무구분별 최종담당자확인
	if($type == 'write'){
		$sArr = Array('알뜰형','보급형','맞춤형','독립형','고급형','모바일','부분제작','기타');

		for($i=0; $i<count($sArr); $i++){
			$sTxt = $sArr[$i];
			$lsql = "select * from wo_ing02 where status='$sTxt' order by uid desc limit 1";
			$lresult = mysql_query($lsql);
			$lrow = mysql_fetch_array($lresult);

			$lastN = $lrow['name'];
			$lastName = $lastN;

			$cName = 'ico'.sprintf('%02d',$i+1);

			if($i == 0)	echo ("최종담당자 : ");

			echo "<span class='$cName'>".$sTxt."</span> → ".$lastName."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

/*
			if($lastN == '김미회' || $lastN == '정모아' || $lastN == '오수지')	$lastName = '장수정';
			else	$lastName = '김미회';
*/

			$no = $i + 1;

			${'sName'.$no} = $lastName;
		}

		$cdate01 = date('Y');
		$cdate02 = date('m');
		$cdate03 = date('d');

	}


	//순번가져오기
	$sql = "select max(sort) from wo_ing02 where playing!='완료'";
	$result = mysql_query($sql);
	$max = mysql_result($result,0,0);

	if($max){
		if($type=='write')	$max = $max + 1;

	}else{
		$max = '1';

	}


	if($uid){

		$sql = "select * from wo_ing02 where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$sort = $row["sort"];
		$name = $row["name"];
		$sales = $row["sales"];
		$company = $row["company"];
		$host_id = $row["host_id"];
		$host_pwd = $row["host_pwd"];
		$upjong = $row["upjong"];
		$person = $row["person"];
		$staff = $row["staff"];
		$status = $row["status"];
		$aloneChk = $row["aloneChk"];
		$mobile = $row["mobile"];
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
		$domain_date = $row["domain_date"];
		$host_date = $row["host_date"];
		$virtualhost = $row["virtualhost"];
		$playing = $row["playing"];
		$ment = $row["ment"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];
		$ending = $row["ending"];

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
		$ftpDate = $row["ftpDate"];

		if(!$cdate01)	$cdate01 = date('Y',$reg_date);
		if(!$cdate02)	$cdate02 = date('m',$reg_date);
		if(!$cdate03)	$cdate03 = date('d',$reg_date);

		//도메인만료일자
		if($domain_date){
			$d_yy = date('Y',$domain_date);
			$d_mm = date('m',$domain_date);
			$d_dd = date('d',$domain_date);

		}else{
			$d_yy = '';
			$d_mm = '';
			$d_dd = '';

		}

		//호스팅만료일자
		if($host_date){
			$h_yy = date('Y',$host_date);
			$h_mm = date('m',$host_date);
			$h_dd = date('d',$host_date);

		}else{
			$h_yy = '';
			$h_mm = '';
			$h_dd = '';

		}

	}else{
		$sort = $max;
	}

	if(!$playing)	 	$playing = '진행';

	if(!$price01)	$price01 = '0';
	if(!$price02)	$price02 = '0';
	if(!$price03)	$price03 = '0';

	if(!$userid)	$userid = $GBL_USERID;
	if(!$name)	$name = $GBL_NAME;




?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>




function check_form(cc){
	form = document.FRM;

	act = 'proc.php';

/*
	chk01 = form.d_yy.selectedIndex;
	chk02 = form.d_mm.selectedIndex;
	chk03 = form.d_dd.selectedIndex;

	chk04 = form.h_yy.selectedIndex;
	chk05 = form.h_mm.selectedIndex;
	chk06 = form.h_dd.selectedIndex;
*/
	playing = form.playing.value;	//진행률

	
	if(isFrmEmpty(form.name,"담당자를 입력해 주십시오"))	return;
/*
	if(chk01 || chk02 || chk03){
		if(isFrmEmpty(form.d_yy,"도메인 만료일자를 선택해 주십시오"))	return;
		if(isFrmEmpty(form.d_mm,"도메인 만료일자를 선택해 주십시오"))	return;
		if(isFrmEmpty(form.d_dd,"도메인 만료일자를 선택해 주십시오"))	return;
	}

	if(chk04 || chk05 || chk06){
		if(isFrmEmpty(form.h_yy,"호스팅 만료일자를 선택해 주십시오"))	return;
		if(isFrmEmpty(form.h_mm,"호스팅 만료일자를 선택해 주십시오"))	return;
		if(isFrmEmpty(form.h_dd,"호스팅 만료일자를 선택해 주십시오"))	return;
	}
*/

	if(isFrmEmpty(form.status,"업무구분을 선택해 주십시오"))	return;

	if(form.playing[2].checked == true && cc == '진행중'){
		txt = form.company.value;
		if(confirm(txt+'을(를) 작업완료 처리하시겠습니까?')){
			
			oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

			form.action = act
			form.submit();

		}else{
			return;
		}
	}



	ss = document.getElementsByName("ftpstate[]");

	for(i=0; i<ss.length; i++){
		if(ss[i].value == '보류')	 form.virtualhost.value = '보류';
	}





	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);
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
	
	if(confirm('해당업무를 삭제하시겠습니까?')){
		act = 'proc.php';

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


function reg_back(){
	
	if(confirm('계약보류 처리하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'back'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}

}


function setName(n){
	form = document.FRM;

	//최종담당자
	sN = form['sName'+n].value;

	if(sN == '정모아' || sN == '박수진')		no = 3;
	else	no = 4

	form.name.selectedIndex = no;
	return;

/*
	len = form.name.length;
	for(i=0; i<len; i++){
		no = i + 1;
		opt = form.name.options[i].text;
		if(opt == sN){
			if(no == len)	no = 4;
			form.name.selectedIndex = no;
			return;
		}
	}
*/
}
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$next_url?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='old_sort' value='<?=$sort?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='play_sort' value='<?=$play_sort?>'>

<input type='hidden' name='mid' value=''><!-- 특이사항 수정,삭제용 -->
<input type='hidden' name='did' value=''><!-- 도메인정보 삭제용 -->

<!-- 업무구분별 마지막 담당자 -->
<input type='hidden' name='sName1' value='<?=$sName1?>'>
<input type='hidden' name='sName2' value='<?=$sName2?>'>
<input type='hidden' name='sName3' value='<?=$sName3?>'>
<input type='hidden' name='sName4' value='<?=$sName4?>'>
<input type='hidden' name='sName5' value='<?=$sName5?>'>
<input type='hidden' name='sName6' value='<?=$sName6?>'>
<input type='hidden' name='sName7' value='<?=$sName7?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_mobile' value='<?=$f_mobile?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_sname' value='<?=$f_sname?>'>
<input type='hidden' name='f_company' value='<?=$f_company?>'>
<input type='hidden' name='f_person' value='<?=$f_person?>'>
<input type='hidden' name='f_email' value='<?=$f_email?>'>
<input type='hidden' name='f_fax' value='<?=$f_fax?>'>
<input type='hidden' name='f_tel' value='<?=$f_tel?>'>
<input type='hidden' name='f_hp' value='<?=$f_hp?>'>
<input type='hidden' name='f_domain' value='<?=$f_domain?>'>
<input type='hidden' name='f_ftpid' value='<?=$f_ftpid?>'>
<input type='hidden' name='f_site_name' value='<?=$f_site_name?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_total' value='<?=$f_total?>'>
<!-- /검색관련 -->


<input type='hidden' name='virtualhost' value=''>




<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height='30'><b>1. 아이웹</b></td>
	</tr>

	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td width="17%" class='tab_tit30'>순위</td>
					<td width="33%" class='tab'><input type='text' name='sort' value='<?=$sort?>'></td>
					<td width="17%" class='tab_tit30'>담당자</td>
					<td width="33%" class='tab'>
						<select name='name'>
							<option value=''>===</option>
						<?
							for($i=0; $i<count($arr_member); $i++){
						?>
							<option value='<?=$arr_member[$i]?>' <?if($name==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
						<?
							}

							if(!in_array($name,$arr_member))	 echo ("<option value='$name' selected>$name</option>");
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class='tab_tit30'>상태</td>
					<td class='tab'>
						<input type='radio' name='playing' value='진행' <?if($playing=='진행'){echo 'checked';}?>>진행&nbsp;
						<input type='radio' name='playing' value='보류' <?if($playing=='보류'){echo 'checked';}?>>보류&nbsp;
						<input type='radio' name='playing' value='유지보수' <?if($playing=='유지보수'){echo 'checked';}?>>유지보수&nbsp;
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
							for($i=date('Y')+5; $i>=2010; $i--){
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
							for($i=date('Y')+5; $i>=2010; $i--){
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
								<td><input type='file' name='upfile01' class='file03' style='width:213px;'><?if($userfile01){?><br><input type='checkbox' name='del_upfile01' value='Y'>삭제 (<?=$realfile01?>)<?}?></td>
								<td width='100' align='right'>
<?
	if($realfile01){		
		echo ("<a href='../file_down.php?folder=ing02&rfile=$userfile01&sname=$realfile01'><img src='../img/common/down.gif'></a>");

	}
?>
								</td>
							</tr>
						</table>
					</td>
					<td class='tab_tit30'>제작기간</td>
					<td class='tab'><input type='text' name='date01' style='width:60px;' value='<?=$date01?>'> 일</td>

				</tr>
				<tr>
					<td class='tab_tit30'>영업수당</td>
					<td class='tab'><input type='text' name='sales' style='width:200px;' value='<?=$sales?>'></td>
					
				</tr>
			</table>
		</td>
	</tr>
</table>




<?
	include '../module/Calendar.php';
?>





<table cellpadding='0' cellspacing='0' border='0' width='100%'>
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
					<td class='tab_tit30'>업무구분</td>
					<td class='tab'>
						<select name='status' onchange='setName(this.selectedIndex);'>
							<option value=''>==</option>
							<option value='알뜰형' <?if($status == '알뜰형'){echo 'selected';}?>>알뜰형</option>
							<option value='보급형' <?if($status == '보급형'){echo 'selected';}?>>보급형</option>
							<option value='맞춤형' <?if($status == '맞춤형'){echo 'selected';}?>>맞춤형</option>
							<option value='고급형' <?if($status == '고급형'){echo 'selected';}?>>고급형</option>							
							<option value='독립형' <?if($status == '독립형'){echo 'selected';}?>>독립형</option>
							<option value='모바일' <?if($status == '모바일'){echo 'selected';}?>>모바일</option>
							<option value='부분제작' <?if($status == '부분제작'){echo 'selected';}?>>부분제작</option>
							<option value='기타' <?if($status == '기타'){echo 'selected';}?>>기타</option>
						</select>&nbsp;&nbsp;&nbsp;
						<input type='checkbox' name='mobile' value='1' <?if($mobile == '1'){echo 'checked';}?>><font color='#de712e'><b>모바일</b></font>
							
				<!--
						<select name='status'>
						<?
							for($i=0; $i<count($arr_status); $i++){
						?>
							<option value='<?=$arr_status[$i]?>' <?if($status==$arr_status[$i]) echo 'selected';?>><?=$arr_status[$i]?></option>
						<?
							}
						?>
						</select>
				-->
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

				<tr> 
					<td class='tab_tit30'>FTP정보 공개일</td>
					<td class='tab'><input type='text' name='ftpDate' value='<?=$ftpDate?>' style='width:145px;' id='fpicker1'></td>
					<td class='tab_tit30'>결제청구목록</td>
					<td class='tab'>					
						<input type='radio' name='aloneChk' value='표시' <?if($aloneChk=='표시'){echo 'checked';}?>>표시&nbsp;
						<input type='radio' name='aloneChk' value='미표시' <?if($aloneChk=='미표시'){echo 'checked';}?>>미표시&nbsp;
					</td>
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
		<td height='30' style='padding-top:30px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><b>3. 도메인정보</b></td>
					<td align='right'><a href="javascript:winopen('domain.php','')">openCenterWin</a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr>
					<td width="17%" class='tab_tit30'>보유도메인</td>
					<td width="33%" class='tab'>
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
					<td width="17%" class='tab_tit30'>도메인업체</td>
					<td width="33%" class='tab'><input type='text' name='domain_com' style='width:145px;' value='<?=$domain_com?>'></td>								
				</tr>
				<tr>
					<td class='tab_tit' height='30'>도메인 만료일자</td>
					<td class='tab'>
						<select name='d_yy'>
							<option value=''>===</option>
						<?
							for($i=date('Y')+5; $i>=2010; $i--){
						?>
							<option value='<?=$i?>' <?if($d_yy==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>년 

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
						</select>월 
						
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
						</select>일 
					</td>
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

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='30' style='padding-top:30px;'><b>4. 호스팅정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>

				<tr> 
					<td width="17%" class='tab_tit' height='30'>호스팅 ID / PWD</td>
					<td width="33%" class='tab'><input type='text' name='host_id' style='width:100px;' value='<?=$host_id?>'> / <input type='text' name='host_pwd' style='width:100px;' value='<?=$host_pwd?>'></td>
					<td width="17%" class='tab_tit' height='30'>호스팅 만료일자</td>
					<td width="33%" class='tab'>
						<select name='h_yy'>
							<option value=''>===</option>
						<?
							for($i=date('Y')+5; $i>=2010; $i--){
						?>
							<option value='<?=$i?>' <?if($h_yy==$i) echo 'selected';?>><?=$i?></option>
						<?
							}
						?>
						</select>년 

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
						</select>월 
						
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
						</select>일 
						&nbsp;&nbsp;
						<input type='radio' name='virtualhost' value='별도' <?if($virtualhost=='별도') echo 'checked';?>>별도
						<input type='radio' name='virtualhost' value='만료' <?if($virtualhost=='만료') echo 'checked';?>>만료
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


-->







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
		$query = "select * from wo_ing02_ment where pid='$uid' order by uid desc";
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
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
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











<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>

					<td width='50%'><?if($uid && 	$play_sort == '진행중'){?><input type='button' name='btn' value='계약보류' onclick='reg_back();'><?}?></td>


					<td align='right'>
<?
if($type == 'write'){
?>	
						<a href="javascript:check_form();"><img src="../img/board/register.gif" border=0></a>&nbsp;
<?
}else{
?>
						<a href="javascript:check_form('<?=$play_sort?>');"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
				<?
					if($GBL_USERID == 'korea' || $GBL_USERID == 'cho3771'){
				?>
						<a href="javascript:reg_del('<?=$play_sort?>');"><img src="../img/board/delete1.gif" border=0></a>
				<?
					}
				?>
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