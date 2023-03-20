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
	
	if(isFrmEmpty(form.company,"업체명을 입력해 주십시오"))	return;	

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
	
	if(confirm('해당업체를 삭제하시겠습니까?')){
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

<!-- 검색관련 -->
<input type='hidden' name='f_mtype' value='<?=$f_mtype?>'>
<input type='hidden' name='f_company' value='<?=$f_company?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_homepage' value='<?=$f_homepage?>'>
<input type='hidden' name='f_telephone' value='<?=$f_telephone?>'>
<!-- /검색관련 -->


<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">분류</th>
					<td width="83%" colspan='3'>
						<select name='mtype'>
							<option value=''>===</option>
							<option value='구매처' <?if($mtype=='구매처'){echo 'selected';}?>>구매처</option>
							<option value='행정관련' <?if($mtype=='행정관련'){echo 'selected';}?>>행정관련</option>
							<option value='세무관련' <?if($mtype=='세무관련'){echo 'selected';}?>>세무관련</option>
							<option value='제휴업체' <?if($mtype=='제휴업체'){echo 'selected';}?>>제휴업체</option>
							<option value='마케팅관련' <?if($mtype=='마케팅관련'){echo 'selected';}?>>마케팅관련</option>
							<option value='기타' <?if($mtype=='기타'){echo 'selected';}?>>기타</option>
						</select>
					</td>
				</tr>

				<tr> 
					<th width="17%">업체명</th>
					<td width="33%"><input type='text' name='company' style='width:100%;' value='<?=$company?>'></td>
					<th width="17%">담당자</th>
					<td width="33%"><input type='text' name='name' style='width:100%;' value='<?=$name?>'></td>
				</tr>

				<tr> 
					<th>홈페이지</th>
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
					<th>이메일</th>
					<td><input type='text' name='email' style='width:100%;' value='<?=$email?>'></td>
				</tr>

				<tr> 
					<th>전화번호</th>
					<td><input type='text' name='telephone' style='width:100%;' value='<?=$telephone?>'></td>
					<th>팩스</th>
					<td><input type='text' name='fax' style='width:100%;' value='<?=$fax?>'></td>
				</tr>

				<tr> 
					<th>아이디</th>
					<td><input type='text' name='id' style='width:145px;' value='<?=$id?>'></td>
					<th>비밀번호</th>
					<td><input type='text' name='pwd' style='width:145px;' value='<?=$pwd?>'></td>
				</tr>


				<tr> 
					<th>계약기간</th>
					<td><input type='text' name='date01' style='width:100%;' value='<?=$date01?>'></td>
					<th>결제통장</th>
					<td><input type='text' name='account' style='width:100%;' value='<?=$account?>'></td>
				</tr>

				<tr> 
					<th>첨부파일</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><input type='file' name='upfile01' class='file03'><?if($userfile01){?><input type='checkbox' name='del_upfile01' value='Y'>삭제 (<?=$realfile01?>)<?}?></td>
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
					<th>기타사항</th>
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

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>