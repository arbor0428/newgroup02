<?
	if($uid){

		$sql = "select * from wo_job where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$project = $row["project"];
		$set_project = $row["set_project"];
		$name = $row["name"];
		$team = $row["team"];
		$status = $row["status"];
		$state = $row["state"];
		$title = $row["title"];
		$ment = $row["ment"];
		$coment = $row["coment"];
		$re_name = $row["re_name"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];


	}


	if(!$name)	$name = $GBL_NAME;
	if(!$userid)	$userid = $GBL_USERID;
?>

<style type='text/css'>
.ss01:link { color:#ff0000; font-family :'nanum gothic'; text-decoration: underline; font-weight:bold;font-size:14px;}
.ss01:visited { color:#ff0000; font-family :'nanum gothic'; text-decoration: underline; font-weight:bold;}
.ss01:hover { color:#ff0000; font-family :'nanum gothic'; text-decoration: underline; font-weight:bold;}
.ss01:active { color:#ff0000; font-family :'nanum gothic'; text-decoration: underline; font-weight:bold;}

.ss02:link { color:#0000ff; font-family :'nanum gothic'; text-decoration: none; font-weight:bold;}
.ss02:visited { color:#0000ff; font-family :'nanum gothic'; text-decoration: none; font-weight:bold;}
.ss02:hover { color:#0000ff; font-family :'nanum gothic'; text-decoration: none; font-weight:bold;}
.ss02:active { color:#0000ff; font-family :'nanum gothic'; text-decoration: none; font-weight:bold;}
</style>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>


function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.project,"프로젝트명을 입력해 주십시오"))	return;	
	if(isFrmEmpty(form.name,"요청자명을 입력해 주십시오"))	return;

	type = form.type.value;
	if(type == 'write'){
		c = $('input:checkbox[class=reList]:checked').length;
		if(c == 0){
			alert('담당자를 선택해 주십시오');
			return;
		}

	}else if(type == 'write'){
		if(isFrmEmpty(form.team,"담당팀을 선택해 주십시오"))	return;
		if(isFrmEmpty(form.re_name,"담당자를 선택해 주십시오"))	return;
	}

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;

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

function projectName(idx){
	form = document.FRM;

	if(idx == 0)	setname = '';
	else	setname = form.set_project.options[idx].text;

	form.project.value = setname;
}

function projectSet(m){
	pArr = new Array('','a','ㄱ','ㄴ','ㄷ','ㄹ','ㅁ','ㅂ','ㅅ','ㅇ','ㅈ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ');
	for(i=0; i<=15; i++){
		if(i == m)		$('#m'+i).addClass('ss01');
		else			$('#m'+i).removeClass('ss01');
	}

	txt = pArr[m];
	$('#pnum').val(m);

	form = document.FRM;
	
	form.set_project.options.length = 1;
	form.set_project.options[0].selected = true; 
	form.set_project.options[0].text = "===";

	if($('#py').is(":checked"))	playing = '1';
	else								playing = '';
	
	document.ifra_set.location = "set_project.php?txt="+txt+"&playing="+playing;
}

function projectSet2(){
	m = $('#pnum').val();
	txt = pArr[m];

	form = document.FRM;
	
	form.set_project.options.length = 1;
	form.set_project.options[0].selected = true; 
	form.set_project.options[0].text = "===";

	if($('#py').is(":checked"))	playing = '1';
	else								playing = '';
	
	document.ifra_set.location = "set_project.php?txt="+txt+"&playing="+playing;
}

function agency(tit,pid){
	document.getElementById("multi_ttl").innerHTML = tit;
	document.getElementById("multiFrame").innerHTML = "<iframe src='../ing02/pop_view.php?uid="+pid+"' width='1030' height='600' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
}

function file_down(){
	form02 = document.frm_down;
	form02.submit();
}
</script>

<form name='frm_down' method='post' action='../download.php'><!-- 다운로드 폼 -->
<input type='hidden' name='path' value='job'>
<input type='hidden' name='file_name' value="<?=$userfile01?>">
<input type='hidden' name='file_rename' value="<?=$realfile01?>">
</form>


<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>

<input type='hidden' name='pnum' id='pnum' value=''>

<!-- 검색관련 -->
<input type='hidden' name='f_search' value='<?=$f_search?>'>
<input type='hidden' name='f_project' value='<?=$f_project?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<input type='hidden' name='f_ment' value='<?=$f_ment?>'>
<input type='hidden' name='f_re_name' value='<?=$f_re_name?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_state01' value='<?=$f_state01?>'>
<input type='hidden' name='f_state02' value='<?=$f_state02?>'>
<input type='hidden' name='f_state03' value='<?=$f_state03?>'>
<input type='hidden' name='f_state04' value='<?=$f_state04?>'>
<input type='hidden' name='f_state05' value='<?=$f_state05?>'>
<!-- /검색관련 -->


<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">프로젝트</th>
					<td width="83%" colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<input type='text' name='project' style='width:120px;' value='<?=$project?>'>
								<?
									if($set_project){
								?>
								<!--
									<a href="javascript:agency('<?=$project?>','<?=$set_project?>');" class='small cbtn black'>업체정보</a> 
								-->
								<?
									}
								?>
								</td>
								<td width='170' style='padding-left:10px;'>
									<select name='set_project' style='width:160px;' onchange="projectName(this.selectedIndex)">
										<option value=''>===</option>
									<?
										for($i=0; $i<count($arr_agencyid); $i++){
											$agency = $arr_agencyname[$i];

											if($agency == '아이웹')	 $cls = "style='color:#ff0000;'";
											else	$cls = '';
									?>
										<option value='<?=$arr_agencyid[$i]?>' <?if($set_project==$arr_agencyid[$i]) echo 'selected';?> <?=$cls?>><?=$agency?></option>
									<?
										}
									?>
									</select>
								</td>
<?
	if($set_project){
		$sql = "select * from wo_ing02_domain where pid='$set_project' order by dodate";
		$result = mysql_query($sql);
		$dtot = mysql_num_rows($result);

		for($i=0; $i<$dtot; $i++){
			$info = mysql_fetch_array($result);
			$link_domain = $info['doname'];

			if($link_domain){
				$link_site = str_replace('http://','',$link_domain);
?>

								<td width='25' align='center'><a href='http://<?=$link_site?>' target='_blank'><img src='../img/ico_home.gif' valign='bottom' alt='<?=$link_site?>'></a></td>
<?
			}
		}
	}
?>
								<td style='padding:0px 0px 0px 20px;'>
									<a href="javascript:projectSet(0);" id='m0' class='ss01'>전체</a> | 
									<a href="javascript:projectSet(1);" id='m1'>a~z</a> | 
									<a href="javascript:projectSet(2);" id='m2'>ㄱ</a> | 
									<a href="javascript:projectSet(3);" id='m3'>ㄴ</a> | 
									<a href="javascript:projectSet(4);" id='m4'>ㄷ</a> | 
									<a href="javascript:projectSet(5);" id='m5'>ㄹ</a> | 
									<a href="javascript:projectSet(6);" id='m6'>ㅁ</a> | 
									<a href="javascript:projectSet(7);" id='m7'>ㅂ</a> | 
									<a href="javascript:projectSet(8);" id='m8'>ㅅ</a> | 
									<a href="javascript:projectSet(9);" id='m9'>ㅇ</a> | 
									<a href="javascript:projectSet(10);" id='m10'>ㅈ</a> | 
									<a href="javascript:projectSet(11);" id='m11'>ㅊ</a> | 
									<a href="javascript:projectSet(12);" id='m12'>ㅋ</a> | 
									<a href="javascript:projectSet(13);" id='m13'>ㅌ</a> | 
									<a href="javascript:projectSet(14);" id='m14'>ㅍ</a> | 
									<a href="javascript:projectSet(15);" id='m15'>ㅎ</a>
								</td>

								<td style='padding:0 0 0 20px;'>
									<div class="squaredThree">
										<input type="checkbox" value="1" id="py" name="py" checked onclick="projectSet2();">
										<label for="py"></label>
									</div>
									<p style='margin:0 0 0 25px;'><span style='font-size:14px;'>진행중</span></p>
								</td>
							</tr>
						</table>
					</td>
				</tr>



				<tr> 
					<th width="17%">제목</th>
					<td width="33%"><input type='text' name='title' style='width:100%' value='<?=$title?>'></td>
					<th width="17%">요청자</th>
					<td width="33%"><input type='text' name='name' style='width:120px' value='<?=$name?>'></td>
				</tr>
			<?
				if($type == 'write'){
			?>
				<tr>
					<th>담당자 <span style='font-size:0.8em;'>(다중선택가능)</span></th>
					<td colspan='3'>
					<?
						$f=0;
						foreach($userArr as $k => $v){
							if($f == 0)	$pStyle = "";
							else			$pStyle = "style='padding:0 0 0 10px;'";
					?>
						<li style='width:10%;float:left;margin:5px 0;'>
							<div class="squaredThree blues">
								<input type="checkbox" value="<?=$teamArr[$k]?>/<?=$v?>" id="rU<?=$f?>" name="reList[]" class='reList'>
								<label for="rU<?=$f?>"></label>
							</div>
							<p style='margin:-13px 0 0 25px;'><?=$v?></p>
						</li>
					<?
							$f++;
						}
					?>
					</td>
				</tr>
			<?
				}else{
			?>
				<tr> 
					<th>담당팀</th>
					<td>
						<select name='team' onchange="set_tmlist('FRM',this.value,'');">
							<option value=''>===</option>
						<?
							for($i=0; $i<count($arr_team); $i++){
						?>
							<option value='<?=$arr_team[$i]?>' <?if($team==$arr_team[$i]) echo 'selected';?>><?=$arr_team[$i]?></option>
						<?
							}
						?>
						</select>

					</td>
					<th>담당자</th>
					<td>
					<?
						if($re_name)	echo ("<script language='javascript'>set_tmlist('FRM','$team','$re_name');</script>");
					?>
						<select name='re_name'>
							<option value=''>===</option>
						</select>
					</td>
				</tr>
			<?
				}
			?>

				<tr> 
					<th>진행상태</th>
					<td>
						<!--
						<select name='state'>
						<?
							for($i=0; $i<count($arr_state); $i++){
						?>
							<option value='<?=$arr_state[$i]?>' <?if($state==$arr_state[$i]) echo 'selected';?>><?=$arr_state[$i]?></option>
						<?
							}
						?>
						</select>
						-->
						<table>
							<tr>
								<?
									$f=0;
									foreach($stateArr as $k => $v){
										$stateTxt = $k;
										$cName = $v;

										if($f == 0)	$pStyle = "";
										else			$pStyle = "style='padding:0 0 0 10px;'";
								?>
									<td <?=$pStyle?>>
										<div class="squaredThree">
											<input type="checkbox" value="<?=$stateTxt?>" id="pT<?=$f?>" name="state" <?if($state == $stateTxt){echo 'checked';}?> onclick="clickCheckBox('state','<?=$f?>');">
											<label for="pT<?=$f?>"></label>
										</div>
										<p style='margin:3px 0 0 25px;'><span style='font-size:14px;' class='<?=$cName?>'><?=$stateTxt?></span></p>
									</td>
								<?
										$f++;
									}
								?>
							</tr>
						</table>
					</td>
					<th>중요도</th>
					<td>
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
		echo ("<a href='javascript:file_down();'><img src='../img/common/down.gif'></a>");

	}
?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

<?
	if($state == '처리결과'){
?>

				<tr> 
					<th>처리결과</th>
					<td colspan='3' height='100'><?=$coment?></td>
				</tr>
<?
	}
?>

				<tr> 
					<th>작업내용</th>
					<td colspan='3'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
				</tr>




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
						<a href="javascript:check_form();"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="../img/board/delete1.gif" border=0></a>&nbsp;
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









<iframe src="about:blank" name="ifra_set" width="0" height="0" frameborder='0' scrolling='no'></iframe>





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



<?
	if($type == 'write'){
?>
<script>
$(document).ready(function() {
	projectSet(0);
});
</script>
<?
	}
?>