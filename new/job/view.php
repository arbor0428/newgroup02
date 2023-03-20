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
		$reg_date = $row["reg_date"];
		$reg_date = date('Y-m-d H:i',$reg_date);

		$ment = eregi_replace("&#8203;", "", $ment);


	}




?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>

function check_form(){
	form = document.FRM;
	form.type.value = 'update';

	oEditors.getById["coment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = 'proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function setMent(s){
	if('<?=$GBL_USERID?>' == 'korea'){
		if(s == '3'){
			oEditors.getById["coment"].exec("SET_CONTENTS", ["처리완료"]);
		}else if(s == '4'){
			check_form();
		}
	}
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

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

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




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2' style="word-wrap:break-word;word-break:break-all">
				<tr> 
					<th width="17%">프로젝트</th>
					<td width="33%">
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<?=$project?>
								<?
									if($set_project){
								?>
									<a href="javascript:agency('<?=$project?>','<?=$set_project?>');" class='small cbtn black'>업체정보</a> 
								<?
									}
								?>
								</td>
								<td width='20'></td>
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
						</table>
					</td>
					<th width="17%">요청자</th>
					<td width="33%"><?=$name?></td>
				</tr>

				<tr> 
					<th>담당팀</th>
					<td><?=$team?></td>
					<th>중요도</th>
					<td><?=$status?></td>
				</tr>

				<tr> 
					<th>진행상태</th>
					<td>
					<!--
					<?
						if($GBL_USERID == 'korea'){
					?>
						<select name='state' onchange='setMent(this.options[this.selectedIndex].value);'>
					<?
						}else{
					?>
						<select name='state'>
					<?
						}
					?>
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
											<input type="checkbox" value="<?=$stateTxt?>" id="pT<?=$f?>" name="state" <?if($state == $stateTxt){echo 'checked';}?> onclick="clickCheckBox('state','<?=$f?>');setMent(<?=$f?>);">
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
					<th>담당자</th>
					<td>
						<select name='re_name'>
							<option value=''>===</option>
						<?
							for($i=0; $i<count($arr_member); $i++){
						?>
							<option value='<?=$arr_member[$i]?>' <?if($re_name==$arr_member[$i]) echo 'selected';?>><?=$arr_member[$i]?></option>
						<?
							}
						?>
						</select>
					</td>
				</tr>

				<tr> 
					<th>제목</th>
					<td><?=$title?></td>
					<th>요청일시</th>
					<td><?=$reg_date?></td>
				</tr>



				<tr> 
					<th>첨부파일</th>
					<td colspan='3'>

<?
	if($realfile01){
?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td valign='bottom'><a href="javascript:file_down();"><img src='../img/common/down.gif'></a></td>
								<td style='padding-left:15px;'><?=$realfile01?></td>
							</tr>
						</table>
<?
	}
?>

					</td>
				</tr>

				<tr> 
					<th>작업내용</th>
					<td colspan='3' height='300'><div style='width:100%;'><?=$ment?></div></td>
				</tr>

				<tr> 
					<th>처리결과</th>
					<td colspan='3'><textarea name="coment" id="coment" style='width:100%;height:100px;'><?=$coment?></textarea></td>
				</tr>



			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td align='right'>
						<a href="javascript:check_form();"><img src="../img/board/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_list();"><img src="../img/board/list01.gif" border=0></a>
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

    elPlaceHolder: "coment",

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